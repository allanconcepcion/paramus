import { useState, useEffect, useRef, useContext } from 'react'
import Script from 'next/script'
import getConfig from 'next/config'
import styled from 'styled-components'
import { Formik, Form, Field } from 'formik'
import * as Yup from 'yup'
import find from 'lodash/find'
import reduce from 'lodash/reduce'
import map  from 'lodash/map'
import filter from 'lodash/filter'
import get from 'lodash/get'
import compact from 'lodash/compact'

import { Rte } from 'components/Typography'
import { Row, Col } from 'components/Grid'
import FieldGroup from 'components/form/FieldGroup'
import Input from 'components/form/Input'
import Textarea from 'components/form/Textarea'
import Radio from 'components/form/Radio'
import Select from 'components/form/Select'
import Checkboxes from 'components/form/Checkboxes'
import Date from 'components/form/Date'
import FileUpload from 'components/form/FileUpload'
import Error from 'components/form/Error'
import { Cta as Submit } from 'components/Button'
import AppContext from 'contexts/App'
import { nl2br } from 'utils/dom'
import cms from 'lib/cms'

const FormComponent = ({
  id, 
  onSuccess
}) => {  
  const { 
    mounted, 
    forms, 
    formsSettings, 
    customize
  } = useContext(AppContext)
  
  const formikRef = useRef()
  const formRef = useRef()
  const [isLoading, setIsLoading] = useState(false)
  const [success, setSuccess] = useState(false)
  const [confirmationMessage, setConfirmationMessage] = useState(false)
  const [submittedValues, setSubmittedValues] = useState()
  const { publicRuntimeConfig } = getConfig()  

  const form = find(forms, f => f.databaseId === parseInt(id))
    
  useEffect(() => {    
    if ( !formRef.current ) {
      return
    }            


    const captcha = formRef.current.querySelector('.g-recaptcha')
  
    if ( window.grecaptcha && captcha ) {      
      try {
        window.grecaptcha.render(captcha)
      } catch ( e ) {
        console.error(e.message)
      }
    }

    const queryString = formRef.current.querySelector('input[label="query_string"]')

    if ( queryString ) {
      formikRef.current.setFieldValue(
        queryString.name, 
        window.location.search.replace('?', '')
      )
    }        
  }, [mounted, formRef.current])

  useEffect(() => {
    if ( !success ) return

    let confirmation = find(
      form.confirmations,
      c => c.isDefault && c.isActive
    )

    const addlConfimations = filter(
      form.confirmations,
      c => !c.isDefault && c.isActive
    )

    const matchRule = ( r ) => {
      switch ( r.operator ) {
        case 'IS':
          return submittedValues[r.fieldId] === r.value
        case 'IS_NOT':
          return submittedValues[r.fieldId] !== r.value
        case 'GREATER_THAN':
          return submittedValues[r.fieldId] > r.value
        case 'LESS_THAN':
          return submittedValues[r.fieldId] < r.value
        case 'CONTAINS':
          var regex = new RegExp(r.value, 'i')
          return regex.test(submittedValues[r.fieldId])
        case 'STARTS_WITH':
          var regex = new RegExp(`^${r.value}`, 'i')
          return regex.test(submittedValues[r.fieldId])
        case 'ENDS_WITH':
          var regex = new RegExp(`${r.value}$`, 'i')
          return regex.test(submittedValues[r.fieldId])                
        default:
          return false
      }
    }
    
    confirmation = find(addlConfimations, c => {
      if ( c.conditionalLogic ) {
        const matches = c.conditionalLogic.rules.map(matchRule)
        
        if ( c.conditionalLogic.logicType === 'ALL' ) {                  
          return matches.indexOf(false) === -1
        }

        if ( c.conditionalLogic.logicType === 'ANY' ) {
          return matches.indexOf(true) !== -1
        }
      }
    }) || confirmation

    formikRef.current?.resetForm()
    
    switch ( confirmation?.type ) {
      case 'MESSAGE':
        setConfirmationMessage(confirmation.message)
        break        
      case 'REDIRECT':
        let url = confirmation.url

        // Struggling to understand why i ever did this...
        /* try { 
          const confirmationUrl = new URL(confirmation.url)
          const apiUrl = new URL(publicRuntimeConfig.apiUrl)
            
          url = url.replace(confirmationUrl.hostname, apiUrl.hostname)
          url = url.replace(confirmationUrl.port, apiUrl.port)          
        } catch (e) {
          console.error(e)
        } */
                                
        window.open(url, '_blank')
        break
    }

    if ( onSuccess ) {
      onSuccess()
    }
  }, [success])
  
  const fieldKey = ( field ) => {    
    return field.id
  }
  
  const initialValues = reduce(form?.formFields.nodes, (result, field) => {    
    switch ( field.type ) {
      case 'EMAIL':
      case 'PHONE':
      case 'TEXT':
      case 'TEXTAREA':
      case 'FILEUPLOAD':
      case 'HIDDEN':
      case 'CAPTCHA':            
        result[fieldKey(field)] = field.defaultValue || ''
      break
      case 'DATE':
        result[fieldKey(field)] = field.inputs?.map(i => i.defaultValue).join('/')
      break
      case 'RADIO':
      case 'SELECT':      
        const singleSelected = find(field.choices, c => c.isSelected)
        result[fieldKey(field)] = singleSelected?.value || ''        
      break      
      case 'CHECKBOX':
        const selected = filter(field.choices, c => c.isSelected)
        result[fieldKey(field)] = selected.map(c => c.value)        
      break
    }
        
    return result
  }, {})  
      
  const validationSchema = Yup.object(
    reduce(form?.formFields.nodes, (result, field) => {
      var validate
      
      switch ( field.type ) {
        case 'EMAIL':
        case 'PHONE':
        case 'RADIO':
        case 'SELECT':
        case 'TEXT':       
        case 'TEXTAREA':
        case 'NUMBER':   
        case 'CAPTCHA':
        case 'DATE':
          validate = Yup.string()
          break
        case 'CHECKBOX':
          validate = Yup.array()
          break
        case 'FILEUPLOAD':
          validate = Yup.mixed()

          if ( field.maxFileSize ) {
            const message = `Please keep the file size under ${field.maxFileSize}MB`
            validate = validate.test('is-big-file', message, file => {
              let valid = true
              if ( file ) {
                const size = file.size / 1024 / 1024
                if ( size > field.maxFileSize ) {
                  valid = false
                }
              }
              
              return valid
            })
          }

          if ( field.allowedExtensions && field.allowedExtensions.length > 0 ) {
            const message = `Valid file types are: ${field.allowedExtensions.join(', ')}`            
            validate = validate.nullable().test('is-correct-file', message, file => {
              const regex = new RegExp(`\.(${field.allowedExtensions.join('|')})$`)
              
              return file ? regex.test(file.name) : true
            })
          }          
          break
      }
      
      if ( field.isRequired && validate ) {        
        if ( field.type === 'CHECKBOX' ) {
          validate = validate.min(1, field.errorMessage || 'Field is required')
        }         
        validate = validate.required(field.errorMessage || 'Field is required')        
      }

      if ( validate ) {
        result[fieldKey(field)] = validate
      }    
      
      return result
    }, {})
  )

  const onSubmit = async ( values ) => {    
    setIsLoading(true)  

    const fieldValues = map(values, (value, k) => {
      const id = parseInt(k)
      const field = find(form.formFields.nodes, field => field.id === id)    
      switch ( field.type ) {
        case 'PHONE':
        case 'RADIO':          
        case 'SELECT':
        case 'TEXT':
        case 'TEXTAREA':        
        case 'NUMBER':
        case 'HIDDEN': 
        case 'DATE':       
          return { id, value }          
        case 'CAPTCHA':
          return {
            id, 
            value: grecaptcha.getResponse()
          }          
        case 'CHECKBOX':          
          return { 
            id, 
            checkboxValues: field.choices.map((c, k) => ({
              inputId: parseFloat(`${id}.${k+1}`), 
              value: c.value
            })).filter(v => value.indexOf(v.value) !== -1)
          }
        case 'EMAIL':
          return {
            id,
            emailValues: {
              value
            }
          }
        case 'FILEUPLOAD':
          if ( value ) {
            return {
              id,
              fileUploadValues: [value]
            }
          }
          break
      }
    })  
    
    const submitResponse = await cms(`
      mutation(
        $input: SubmitGfFormInput!
      ) {
        submitGfForm(
          input: $input
        ) {
          errors {
            id
            message
          } 
        }
      }
    `, {
      input: {
        id: form.databaseId,
        fieldValues: compact(fieldValues)
      }
    })

    const response = get(submitResponse, 'data.submitGfForm')

    if ( response.errors ) {
      response.errors.forEach(error => {
        formikRef.current.setFieldError(error.id, error.message)
      })      
    } else {
      setSuccess(true)
      setSubmittedValues(values)
      const event = new CustomEvent('submit', { 
        detail: { 
          id: form.databaseId 
        }
      })
      document.dispatchEvent(event)
    }

    setIsLoading(false)              
  }

  const renderField = ( field ) => {
    switch ( field.type ) {
      case 'TEXT':
        return (
          <Field
              name={fieldKey(field)}
              placeholder={field.label}
              component={Input}
          />                    
        )
      case 'EMAIL':
        return (
          <Field
              name={fieldKey(field)}
              placeholder={field.label}
              type='email'
              component={Input}
          />                              
        )
      case 'PHONE':
        return (
          <Field
              name={fieldKey(field)}
              placeholder={field.label}
              type='tel'
              component={Input}
          />                              
        )
        case 'NUMBER':
          return (
            <Field
                name={fieldKey(field)}
                placeholder={field.label}
                type='number'
                component={Input}
            />                              
          )        
      case 'RADIO':
        return (
          <Radio
              name={fieldKey(field)}
              label={field.label}
              options={
                field.choices.map(c => ({
                  label: c.text, value: c.value
                }))
              }
          />
        )
      case 'SELECT':      
        const selected = field.choices.find(c => c.isSelected)  
        return (
          <Field
            instanceId={fieldKey(field)}
            label={field.label}
            name={fieldKey(field)}
            placeholder={field.placeholder}
            defaultValue={selected ? {label: selected.text, value: selected.value} : null}
            component={Select}
            options={field.choices.map(c => ({ label: c.text, value: c.value }))}
          />
        )
      case 'TEXTAREA':
        return (
          <Field
              name={fieldKey(field)}
              placeholder={field.label}
              component={Textarea}
              rows={5}
          />
        )
      case 'CHECKBOX':
        return (
          <Checkboxes
            name={fieldKey(field)}
            label={field.label}
            options={
              field.choices.map(c => ({
                label: c.text, value: c.value
              }))
            }
          />
        )
      case 'FILEUPLOAD':
        return (
          <Field
              name={fieldKey(field)}
              label={field.label}
              description={field.description}
              accept={field.allowedExtensions}
              component={FileUpload}
          />                    
        )
      case 'HIDDEN':
        return (
          <Field 
            name={fieldKey(field)}
            label={field.label}
            type='hidden'
            component={Input}
          />
        )
      case 'HTML':
        return (          
          <Html             
            dangerouslySetInnerHTML={{ __html: field.content }} 
          />
        )
      case 'CAPTCHA':
        return (
          <>
            <Script src='https://www.google.com/recaptcha/api.js?render=explicit' />
            <div 
              className='g-recaptcha' 
              data-sitekey={formsSettings?.recaptcha?.publicKey}
            />
          </>
        )   
      case 'DATE':        
        return (
          <Field 
            name={fieldKey(field)}
            label={field.label}
            inputs={field.inputs || []}
            component={Date}
          />
        )     
    }
  }
  
  return (
    mounted ? (
      <>                  
      <S_Form $isLoading={isLoading} key={form.databaseId}>
        {confirmationMessage ? (
           <ConfirmationMessage
               dangerouslySetInnerHTML={{ __html: nl2br(confirmationMessage) }}
           />
         ) : (
           <Formik
               innerRef={formikRef}
               initialValues={initialValues}
               validationSchema={validationSchema}
               onSubmit={onSubmit}
           >
             {() => (
                <Form 
                  id={`form-${form?.databaseId}`}
                  ref={formRef}
                >
                  <Row>
                    {form?.formFields.nodes.map((field, k) => (
                      field.type !== 'HIDDEN' ? (
                        <Col dk={field.layoutGridColumnSpan * 2} key={k}>
                          <FieldGroup
                            zindex={form?.formFields.nodes.length - k}
                          >
                            {renderField(field)}
                            <Error name={fieldKey(field)} />
                          </FieldGroup>
                        </Col>
                      ) : (
                        <div key={k}>
                          {renderField(field)}
                        </div>                        
                      )
                     ))}
                  
                    <Col dk={form?.submitButton.layoutGridColumnSpan * 2}>
                      <Submit 
                        type='submit'
                        iconColor={customize?.components.form.submitButtonColor}
                        iconBackground={customize?.components.form.submitButtonBackground}
                        iconBorder={customize?.components.form.submitButtonBorder}
                        iconColorHover={customize?.components.form.submitButtonColorHover}
                        iconBackgroundHover={customize?.components.form.submitButtonBackgroundHover}
                        iconBorderHover={customize?.components.form.submitButtonBorderHover}
                      >
                        {form?.submitButton.text}
                      </Submit>
                    </Col>
                  </Row>
                </Form>
              )}
           </Formik>
         )}         
      </S_Form>
      </>
    ) : <></>
  )
}

const S_Form = styled.div`
  ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};
  cursor: ${p => p.$isLoading ? 'wait' : 'auto'};
  opacity: ${p => p.$isLoading ? '.5' : '1'};
  text-align: left;

  > * {
    pointer-events: ${p => p.$isLoading ? 'none' : 'all'};
  }

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
  }

  font-size: 1.8rem;
`

const Html = styled(Rte)`
  font-size: 85%;
  
  > * {
    font-size: 85%;
  }
`

const ConfirmationMessage = styled(Rte)`
  margin: 0 0 50px 0;
`

export const GQL_CUSTOMIZE_FORM = `
  fragment CustomizeForm on Customize_Components {
    form {
      submitButtonBackground
      submitButtonBackgroundHover
      submitButtonBorder      
      submitButtonBorderHover
      submitButtonColor            
      submitButtonColorHover      
    }    
  }
`

export default FormComponent
