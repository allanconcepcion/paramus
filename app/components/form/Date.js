import { useState, useEffect } from 'react'
import styled from 'styled-components'
import find from 'lodash/find'
import times from 'lodash/times'

import ReactSelect from 'react-select'

const _Date = ({
  field,
  form, 
  label, 
  inputs,
  ...props
}) => { 
  const defaultMonth = parseInt(inputs[0]?.defaultValue)
  const defaultDay = parseInt(inputs[1]?.defaultValue)
  const defaultYear = parseInt(inputs[2]?.defaultValue)

  const [month, setMonth] = useState(defaultMonth)
  const [day, setDay] = useState(defaultDay)
  const [year, setYear] = useState(defaultYear)

  const [dayOptions, setDayOptions] = useState([])

  const monthOptions = [
    { label: 'January', value: 1 }, 
    { label: 'February', value: 2 }, 
    { label: 'March', value: 3 }, 
    { label: 'April', value: 4 }, 
    { label: 'May', value: 5 }, 
    { label: 'June', value: 6 }, 
    { label: 'July', value: 7 }, 
    { label: 'August', value: 8 }, 
    { label: 'September', value: 9 }, 
    { label: 'October', value: 10 }, 
    { label: 'November', value: 11 }, 
    { label: 'December', value: 12 }, 
  ]  

  const yearOptions = []
  const currentYear = new Date().getFullYear()

  times(100, i => {
    yearOptions.push({
      label: currentYear - i,       
      value: currentYear - i
    })
  })  

  times(50, i => {
    yearOptions.push({
      label: currentYear + i, 
      
      value: currentYear + i
    })
  })  

  useEffect(() => {    
    let count = 0

    switch ( month ) {
      case 1:
      case 3:
      case 5:
      case 7:
      case 8:      
      case 10:      
      case 12:              
        count = 31    
      break
      case 4:
      case 6:
      case 9:
      case 11:              
        count = 30
      break
      case 2:
        count = ((year % 100 === 0) ? (year % 400 === 0) : (year % 4 === 0)) ? 29 : 28
      break
      default:             
        count = 31
    }

    setDayOptions(
      Array(count).fill().map((_, k) => ({
        label: k+1, value: k+1
      }))
    )  
  }, [month, year])

  useEffect(() => {
    if ( month && day && year) {
      form.setFieldValue(field.name, `${month}/${day}/${year}`)
    }    
  }, [month, day, year])
  
  return (
    <S_Date>    
      {label && (
        <Label>
          {label}                
        </Label>  
      )}
      <SelectWrapper>
        <ReactSelect
          isSearchable={true}
          options={monthOptions}        
          defaultValue={find(monthOptions, o => o.value === defaultMonth)}
          placeholder={inputs[0]?.placeholder}
          onChange={option => {            
            setMonth(option.value)                  
          }}  
          styles={{
            menu: provided => {
              return {
                ...provided, 
                minWidth: "max-content"
              }
            }
          }}       
          {...props}
        />
        <ReactSelect
          isSearchable={true}
          options={dayOptions} 
          defaultValue={find(dayOptions, o => o.value === parseInt(inputs[1]?.defaultValue))}
          placeholder={inputs[1]?.placeholder}
          onChange={option => {            
            setDay(option.value)                        
          }}         
          styles={{
            menu: provided => {
              return {
                ...provided, 
                minWidth: "max-content"
              }
            }
          }}       
          {...props}
        />
        <ReactSelect
          isSearchable={true}
          options={yearOptions} 
          defaultValue={find(yearOptions, o => o.value === parseInt(inputs[2]?.defaultValue))}
          placeholder={inputs[2]?.placeholder}
          onChange={option => {            
            setYear(option.value)          
          }}        
          styles={{
            menu: provided => {
              return {
                ...provided, 
                minWidth: "max-content"
              }
            }
          }}        
          {...props}
        />
      </SelectWrapper>      
    </S_Date>
  )  
}

const S_Date = styled.div`
  
`

const Label = styled.div`
  margin: 0 0 10px 0;  
`

const SelectWrapper = styled.div`
  display: flex;
  > div {
    margin-right: 10px; 
    &:last-child {
      margin: 0;
    }
  }
`

export default _Date