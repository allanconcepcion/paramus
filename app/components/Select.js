import styled from 'styled-components'
import ReactSelect from 'react-select'

const Select = ({
  ...props
}) => {
  const styles = {}

  return (
    <Wrapper>
      <ReactSelect
        isSearchable={false}
        styles={styles}      
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

export default Select