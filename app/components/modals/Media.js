import { useContext } from 'react'
import styled from 'styled-components'
import ReactModal from 'react-modal'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Icon } from 'components/SVGIcons'
import { Container } from 'components/Grid'
import AppContext from 'contexts/App'
 
const Media = () => {
  ReactModal.setAppElement('#__next')

  const {
    modalData: {
      mediaImage: image
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
        <Container
            padding={{ tb: 4 }}
        >
          <WPImage
              image={image}
              layout={'responsive'}
          />
        </Container>
      </Modal>      
    </ReactModal>
  )
}

const Content = styled.div`
  margin: auto;
  max-width: 750px;
  text-align: center;
`

const Modal = styled.div`
  position: relative;
  padding: 50px 0;
  background-color: ${p => p.theme.colors.white} !important;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 50px 0;
  }
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

export const GQL_CUSTOMIZE_MEDIA_MODAL = `
  ${GQL_WP_IMAGE}

  fragment CustomizeMediaModal on Customize_Modals_Modals_Media {
    __typename
    id
    triggerType
    triggerHandle
    triggerScrollPosition
    triggerDelay
    triggerPages
    mediaImage {
      ...WPImage
    }    
  }
`

export default Media
