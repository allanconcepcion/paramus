import { useContext } from 'react'
import styled from 'styled-components'
import ReactModal from 'react-modal'

import { Icon } from 'components/SVGIcons'
import { Container } from 'components/Grid'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import AppContext from 'contexts/App'
import FormComponent from 'components/Form'
 
const Form = () => {
  ReactModal.setAppElement('#__next')

  const {
    modalData: {
      headline, 
      body,
      formId
    },
    closeModal
  } = useContext(AppContext)  

  const onCloseClick = () => {
    closeModal()    
  }

  const onRequestClose = () => {
    closeModal()
  }
  
  return (
    <ReactModal
        isOpen={true}
        onRequestClose={onRequestClose}
        contentElement={(props, children) => (
            <Content {...props}>{children}</Content>
          )}
    >
      <Modal>
        <Close onClick={onCloseClick}>
          <Icon icon='close' />
        </Close>          
        <Container>
          {headline && (
            <S_Headline text={headline} align='left' />           
          )}
          {body && (
             <Body
                 dangerouslySetInnerHTML={{ __html: body }}
             />
           )}
          {formId && (            
            <FormComponent id={formId} />                    
          )}
        </Container>
      </Modal>      
    </ReactModal>
  )
}

const Content = styled.div`
  margin: auto;
  max-width: 750px;
`

const Modal = styled.div`
  position: relative;
  padding: 50px 0;
  background-color: ${p => p.theme.colors.white} !important;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 50px 0;
  }
`

const S_Headline = styled(Headline)`
  margin: 0 0 20px 0;
`

const Body = styled(Rte)`
  margin: 16px 0 32px 0;
`

const Close = styled.button`
  position: absolute;
  top: 12px;
  right: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  align-self: flex-end;
  margin: 0;
  width: 22px;
  height: 22px;
  border: solid 1px ${p => p.theme.colors.black};
  border-radius: 50%;
  ${p => p.theme.mixins.linkFade()};

  .icon {
    width: 1.2rem;
    height: 1.2rem;
    stroke-width: 0;
    fill: ${p => p.theme.colors.black};
  }
`

export const GQL_CUSTOMIZE_FORM_MODAL = `  
  fragment CustomizeFormModal on Customize_Modals_Modals_Form {
    __typename
    id
    triggerType
    triggerHandle
    triggerScrollPosition
    triggerDelay
    triggerPages
    formId
    headline
    body
  }
`

export default Form
