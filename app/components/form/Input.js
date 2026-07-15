import styled from 'styled-components'

const Input = ({ field, form, ...props }) => {
  return (
    <S_Input {...field} {...props} />
  )  
}

const S_Input = styled.input`
  display: block;
  width: 100%;
  padding: 11px 10px 10px 10px;
  color: currentColor;
  appearance: none;
  font-family: inherit;
  font-size: inherit;
  font-weight: inherit;
  line-height: inherit;
  background-color: ${p => p.theme.colors.xltgray};
  border: none;

  &::placeholder {
    color: inherit;
    overflow: visible;
  }
`

export default Input
