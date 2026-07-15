import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import ReactModal from 'react-modal'

import Headline from 'components/Headline'
import { Icon } from 'components/SVGIcons'
import { Rte } from 'components/Typography'
import { Container } from 'components/Grid'
import AppContext from 'contexts/App'
import { TextArrow } from 'components/Button'
 
const Text = () => {
  ReactModal.setAppElement('#__next')

  const {
    modalData: {
      headline,
      body,
      html,
      ctaEnabled,
      textCtaLink: ctaLink
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
             <Headline text={headline} />           
           )}
          {body && (
             <Body
                 dangerouslySetInnerHTML={{ __html: body }}
             />
           )}
           {html && (
            <div dangerouslySetInnerHTML={{ __html: html }} />
           )}
          {ctaEnabled && (
             <Link href={ctaLink.url} passHref>
               <CtaLink
                   target={ctaLink.target || undefined}
                   link
               >
                 {ctaLink.title}
               </CtaLink>
             </Link>
           )}
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
  padding: 60px 0;
  background-color: ${p => p.theme.colors.white} !important;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 75px 0;
  }
`

const Body = styled(Rte)``

const CtaLink = styled(TextArrow)`
  margin: 20px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 30px 0 0 0;
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

export const GQL_CUSTOMIZE_TEXT_MODAL = `
  fragment CustomizeTextModal on Customize_Modals_Modals_Text {
    __typename
    id
    triggerType
    triggerHandle
    triggerScrollPosition
    triggerDelay
    triggerPages
    headline
    body
    html
    ctaEnabled
    textCtaLink {
      target
      title
      url
    }    
  }
`

export default Text
