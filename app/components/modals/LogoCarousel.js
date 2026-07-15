import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import ReactModal from 'react-modal'
import Slider from 'react-slick'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Icon } from 'components/SVGIcons'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import { Container } from 'components/Grid'
import AppContext from 'contexts/App'
import { TextArrow } from 'components/Button'
import Box from 'components/Box'
 
const LogoCarousel = () => {
  ReactModal.setAppElement('#__next')

  const {    
    modalData: {
      logoCarouselImage: image,
      headline,
      body,
      ctaEnabled,
      logoCarouselCtaLink: ctaLink,
      logoCarouselLogos: logos,
      logoRatioWidth,
      logoRatioHeight,      
    },
    closeModal
  } = useContext(AppContext)

  const max = logos.length
  
  const settings = {    
    slidesToShow: max >= 3 ? 3 : max,
    slidesToScroll: max >= 3 ? 3 : max,
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: max >= 2 ? 2 : max,
          slidesToScroll: max >= 2 ? 2 : max,
        }
      }
    ]
  }

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
        <S_Container>
          <Media>
            <WPImage
                image={image}
                layout={'fill'}
                objectFit={'cover'}
            />
          </Media>
          <Text>
            {headline && (
               <Headline
                   text={headline}
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

          <Carousel {...settings}>
            {logos?.map((logo, k) => (
               <Slide key={k}>
                 <Logo>
                   <Box
                       width={logoRatioWidth}
                       height={logoRatioHeight}
                   >
                     <WPImage
                         image={logo}
                         layout='fill'
                         objectFit='contain'
                     />
                   </Box>
                 </Logo>
               </Slide>
             ))}
          </Carousel>
        </S_Container>
      </Modal>      
    </ReactModal>
  )
}

const Content = styled.div`
  margin: auto;
  max-width: 1100px;
  text-align: center;
`

const S_Container = styled(Container)``

const Modal = styled.div`
  padding: 60px 0;
  background-color: ${p => p.theme.colors.white} !important;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 75px 0;
  }
`

const Media = styled.div`
  position: relative;
  margin: 0 auto 30px auto;
  width: 145px;
  height: 145px;
  border-radius: 50%;
  overflow: hidden;
`

const Text = styled.div``

const Body = styled(Rte)``

const CtaLink = styled(TextArrow)`
  margin: 20px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 30px 0 0 0;
  }
`

const Carousel = styled(Slider)`
  margin: 40px auto 0 auto;
  max-widtH: 600px;

  .slick-dots {
    margin: 20px 0 0 0;
    padding: 0;
    list-style: none;
    text-align: center;
  }

  .slick-dots li {
    display: inline-block;
    margin: 0 3px;
  }

  .slick-dots li button {
    width: 8px;
    height: 8px;
    color: transparent;
    font-size: 0;
    border-radius: 50%;
    background-color: ${p => p.theme.colors.ltgray};
    transition: background-color 300ms ease;
  }

  .slick-dots li.slick-active button {
    background-color: ${p => p.theme.colors.gray};    
  }
`

const Slide = styled.div`
  padding: 0 20px;
`

const Logo = styled.div`
  max-width: 150px;
  margin: 0 auto;
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

export const GQL_CUSTOMIZE_LOGO_CAROUSEL_MODAL = `
  ${GQL_WP_IMAGE}

  fragment CustomizeLogoCarouselModal on Customize_Modals_Modals_LogoCarousel {
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
    logoCarouselCtaLink {
      target
      title
      url
    }    
    logoCarouselImage {
      ...WPImage
    }
    logoRatioWidth
    logoRatioHeight
    logoCarouselLogos {
      ...WPImage
    }
  }
`

export default LogoCarousel
