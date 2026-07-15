import styled from 'styled-components'

const FileUpload = ({ field, form, ...props }) => {  
  return (
    <S_FileUpload>
      {props.label && (
         <Label>{props.label}</Label>
       )}
      <input
          name={field.name}
          type='file'
          accept={props.accept ? props.accept.join(',') : undefined}
          onChange={(e) => {
              form.setFieldValue(field.name, e.currentTarget.files[0])
            }}
      />
      {props.description && (
         <Description>{props.description}</Description>
       )}
    </S_FileUpload>
  )  
}

const S_FileUpload = styled.div`

`

const Label = styled.div`
  margin: 0 0 10px 0;  
`

const Description = styled.div`
  margin: 10px 0 0 0;
  font-size: 12px;
`

export default FileUpload
