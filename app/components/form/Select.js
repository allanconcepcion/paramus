import styled from 'styled-components'
import ReactSelect from 'react-select'

const Select = ({
  field, 
  form, 
  label,
  ...props
}) => {
  const styles = {}
  
  return (
    <Wrapper>
      {label && (
        <Label>{label}</Label>
      )}
      <ReactSelect
        isSearchable={false}
        styles={styles}     
        onChange={option => {            
          form.setFieldValue(field.name, option.value)
          
          if ( props.onChange ) {
            props.onChange(option)
          }            
        }}         
        {...props}
      />
    </Wrapper>    
  )
}

const Wrapper = styled.div`
  position: relative;  
  ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};
  z-index: 10;
      
  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
  }
`

const Label = styled.div`
  margin: 0 0 10px 0;  
`

export default Select