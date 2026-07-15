import styled from 'styled-components'

import { Field } from 'formik'

import { Icon } from 'components/SVGIcons'

const Checkboxes = ({ 
  name, 
  label, 
  options
}) => {  
  return (    
    <S_Checkboxes>
      <Label>
        {label}                
      </Label>   

      <Options>
        {options.map((option, k) => (
          <label key={k}>
            <Field 
              type='checkbox' 
              name={name} 
              value={option.value} 
            />
            <i>
              <Icon icon='checkmark' />
            </i>
            <span>{option.label}</span>
          </label>          
        ))}
      </Options>
    </S_Checkboxes>
  )  
}

const S_Checkboxes = styled.div``

const Label = styled.div`
  margin: 0 0 1rem 0;  
`

const Options = styled.div`
  label {
    margin: 1rem 2rem 1rem 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
  }

  input {
    display: none;
  }

  input:checked + i {
    svg {
      opacity: 1;
    }
  }

  i {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border: solid 1px ${p => p.theme.colors.ltgray};
    margin: 0 .5rem 0 0;

    svg {
      font-size: 1.2rem;
      opacity: 0;
    }
  }

  span {
    user-select: none;
  }    
`

export default Checkboxes