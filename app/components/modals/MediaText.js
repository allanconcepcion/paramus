import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import ReactModal from 'react-modal'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Icon } from 'components/SVGIcons'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import { Container } from 'components/Grid'
import AppContext from 'contexts/App'
import { TextArrow } from 'components/Button'
import { useMinWidth } from 'hooks/useMedia'
 
const MediaText = () => {
  ReactModal.setAppElement('#__next')

  const {
    mounted,
    modalData: {
      headline,
      body,
      ctaEnabled,
      mediaTextCtaLink: ctaLink,
      mediaTextImage: image
    },
    closeModal
  } = useContext(AppContext)

  const isTablet = useMinWidth('tablet')

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
        <S_Container
          padding={{ dk: 5 }}
        >
          <Media>
            <WPImage
                image={image}
                layout={'responsive'}
            />
          </Media>
          <Text>
            {headline && (
               <Headline
                   text={headline}
                   align={mounted && isTablet ? 'left' : 'center'}
               />
             )}
            {body && (
               <Body
                   dangerouslySetInnerHTML={{ __html: body }}
               />
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
          </Text>          
        </S_Container>
      </Modal>      
    </ReactModal>
  )
}

const Content = styled.div`
  margin: auto;
  max-width: 1100px;
  text-align: center;

  ${p => p.theme.media.minWidth('tablet')} {
    text-align: left;
  }  
`

const S_Container = styled(Container)`
  ${p => p.theme.media.minWidth('tablet')} {
    display: flex;
    align-items: center;
  }
`

const Modal = styled.div`
  padding: 60px 0;
  background-color: ${p => p.theme.colors.white} !important;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 75px 0;
  }
`

const Media = styled.div`
  flex: 1;
  margin: 0 0 30px 0;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0;
  }
`

const Text = styled.div`
  flex: 1;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0 0 0 40px;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 0 50px;
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

export const GQL_CUSTOMIZE_MEDIA_TEXT_MODAL = `
  ${GQL_WP_IMAGE}

  fragment CustomizeMediaTextModal on Customize_Modals_Modals_MediaText {
    __typename
    id
    triggerType
    triggerHandle
    triggerScrollPosition
    triggerDelay
    triggerPages
    headline
    body
    ctaEnabled
    mediaTextCtaLink {
      target
      title      
      url
    }    
    mediaTextImage {
      ...WPImage
    }    
  }
`

export default MediaText
