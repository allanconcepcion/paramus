import styled from 'styled-components'
import { Field } from 'formik'

const Radio = ({
  name,
  label,
  options=[],
  onChange,
  className
}) => {
  return (
    <S_Radio className={className} onChange={onChange}>
      {label && (
         <Label>{label}</Label>
       )}
      <Options>
        {options.map((option, k) => (
           <Option key={k}>
             <span>{option.label}</span>
             <Field type="radio" name={name} value={option.value} />
           </Option>
         ))}
      </Options>
    </S_Radio>
  )
}

const S_Radio = styled.div`
  overflow: hidden;
`

const Label = styled.div`
  margin: 0 0 10px 0;  
`

const Options = styled.div`
  margin: 0 -4px;
`

const Option = styled.label`
  display: inline-block;
  position: relative;
  margin: 4px;
  padding: 13px 15px 12px 15px;
  cursor: pointer;

  input {
    display: none;
  }

  &:after {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};
    border: solid 1px transparent;
    background-color: ${p => p.theme.colors.xltgray};
    transition: border-color 300ms ease;
    z-index: 1;
  }

  &:has(input:checked):after {
    border-color: ${p => p.theme.colors.gray};
  } 

  span {
    position: relative;
    z-index: 2;
  }
`

export default Radio
