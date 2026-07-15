import styled from 'styled-components'

const FieldGroup = ({ children, zindex }) => {
  return (
    <S_FieldGroup
      $zindex={zindex}
    >
      {children}      
    </S_FieldGroup>
  )
}

const S_FieldGroup = styled.div`
  position: relative;
  margin: 0 0 24px 0;
  line-height: 1;
  z-index: ${p => p.$zindex || 1};
`

export default FieldGroup
