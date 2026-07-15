import styled from 'styled-components'

const Textarea = ({ field, form, ...props }) => {
  return (
    <S_Textarea {...field} {...props} />
  )  
}

const S_Textarea = styled.textarea`
  display: block;
  width: 100%;
  padding: 11px 10px 10px 10px;
  color: currentColor;
  appearance: none;
  font-family: inherit;
  font-size: inherit;
  font-weight: inherit;
  background-color: ${p => p.theme.colors.xltgray};
  border: none;

  &::placeholder {
    color: inherit;
    overflow: visible;
  }
`

export default Textarea
