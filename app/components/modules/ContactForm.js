import { useState, useEffect } from 'react'
import styled from 'styled-components'

import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import { Container, Row, Col } from 'components/Grid'
import Select from 'components/Select'
import Form from 'components/Form'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'

const ContactForm = ({
  selectLabel,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  mediaPositionDesktop,
  forms, 
  visibleOnDesktop,
  visibleOnMobile
}) => {      
  const [activeForm, setActiveForm] = useState(forms && forms[0])  
  const [success, setSuccess] = useState(false)    
  
  const options = forms?.map(f => ({
    label: f.name, 
    value: f.formId
  }))

  const onSelectFormChange = ( option ) => {
    setActiveForm(forms.find(f => option.value === f.formId))
  }

  const onFormSuccess = () => {
    setSuccess(true)
  }

  useEffect(() => {
    if ( forms?.length > 0 ) {
      setActiveForm(forms[0])
    }    
  }, [])

  return (
    <S_ContactForm
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
    >
      <Container>        
        <Row 
          gutter={{ tb: 0 }} 
          flexDirection={{ 
            mb: 'column-reverse', 
            dk: mediaPositionDesktop === 'left' ? 'row' : 'row-reverse'
          }}
        >
          <Col dk={12}>  
            {activeForm && activeForm.mediaType === 'map' && (
              <Map>            
                <div 
                  dangerouslySetInnerHTML={{ 
                    __html: activeForm.map 
                  }}
                />                          
              </Map>                      
            )}  

            {activeForm && activeForm.mediaType === 'image' && (
              <ImageWrapper>
                <WPImage
                  image={activeForm.image}
                  layout='responsive'
                />
              </ImageWrapper>
            )}                              
          </Col>
          <Col dk={12}>
            <FormContainer
              $mediaPosition={mediaPositionDesktop}
            >
              {eyebrowEnabled && eyebrow && (
                <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
              )}
              {headline && (
                <Headline
                  text={headline}
                  align='left'
                  as={headlineTag}
                />
              )}              
              {forms?.length > 1 && (
                !success && (
                  <SelectWrapper>
                    <SelectTitle>
                      {selectLabel}
                    </SelectTitle>
                    <Select       
                      instanceId={`form-select`}
                      options={options}
                      defaultValue={options[0]}
                      onChange={onSelectFormChange}
                    />  
                  </SelectWrapper>                
                )
              )}              
              {activeForm && (
                <>
                {activeForm.formType === 'custom' ? (
                  <div dangerouslySetInnerHTML={{ __html: activeForm.html }} />
                ) : (
                  <Form id={activeForm.formId} onSuccess={onFormSuccess} key={activeForm.formId} />
                )}                
                </>                
              )}  

              {activeForm?.footnote && (
                <Footnote 
                  dangerouslySetInnerHTML={{ __html: activeForm.footnote }}
                />
              )}            
            </FormContainer>
          </Col>
        </Row>
      </Container>
    </S_ContactForm>
  )
}

const S_ContactForm = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  position: relative;
  border-top: solid 1px ${p => p.theme.colors.ltgray};
  padding: 50px 0;

  ${Container} {
    ${p => p.theme.media.maxWidth('tablet')} {
      padding: 0;
    }
  }

  &:before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 1px;
    height: 100%;
    background-color: ${p => p.theme.colors.ltgray};
    display: none;

    ${p => p.theme.media.minWidth('desktop')} {
      display: block;
    }
  }

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    padding: 75px 0;
  }
`

const Map = styled.div`
  position: relative;
  margin-top: 30px;
  padding-top: 80%;  
  background-color: ${p => p.theme.colors.ltgray};
  min-height: 100%;

  ${p => p.theme.media.minWidth('desktop')} {
    margin-top: 0;
  }

  iframe {
    margin: 0;
    border: none;
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const FormContainer = styled.div`
  ${p => p.theme.media.maxWidth('tablet')} {
    padding: 0 ${p => p.theme.grid.containerPadding.mb}px;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: ${p => p.$mediaPosition === 'left' ? '0 0 0 60px' : '0 60px 0 0'};
  }  
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const Footnote = styled.div`
  margin: 40px 0 0 0;
  ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
  }

  > * {
    font-size: 85%;
  }

  a {
    text-decoration: underline;

    &:hover {
      text-decoration: none;  
    }
  }
`

const SelectWrapper = styled.div`
  position: relative;
  margin: 0 0 24px 0;
  z-index: 50;
`

const SelectTitle = styled(Rte)`  
  margin: 0 0 .5em 0;
`

const ImageWrapper = styled.div`
  position: relative;
  margin-top: 30px;

  ${p => p.theme.media.minWidth('desktop')} {
    margin-top: 0;
    height: 100%;

    > div {
      padding-top: 0;
      height: 100%;
      > div > div {
        height: 100%;
        > span {
          height: 100% !important;
          img {
            object-fit: cover;
          }
        }
      }
    }
  }  
`

export const GQL_CONTACT_FORM_MODULE = `
  ${GQL_WP_IMAGE}

  fragment ContactFormModule on Page_Pagecontent_Modules_ContactForm {
    fieldGroupName
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag
    selectLabel
    mediaPositionDesktop
    forms {
      name
      formType
      html
      formId
      map
      mediaType
      footnote
      image {
        ...WPImage
      }      
    }
    visibleOnDesktop
    visibleOnMobile
  }
`

export default ContactForm
