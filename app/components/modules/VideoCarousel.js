import { useContext, useState, useCallback, useRef, useEffect } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import Slider from 'react-slick'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import { Container, Row, Col } from 'components/Grid'
import Box from 'components/Box'
import SocialMenu from 'components/SocialMenu'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import WPVideo from 'components/WPVideo'
import Headline from 'components/Headline'
import { useMinWidth } from 'hooks/useMedia'
import { Icon } from 'components/SVGIcons'
import AppContext from 'contexts/App'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import {
  Play,
  Cta as CtaButton, 
  TextArrow as TextArrowButton
} from 'components/Button'

const VideoCarousel = ({
  ctaEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  fieldGroupName,
  backgroundImageEnabled,
  carouselPositionDesktop,
  carouselLayoutDesktop,
  slidesToShowDesktop,
  socialLinksEnabled,
  socialLinksEyebrow,
  customizeLayout,
  videos, 
  ctaLink, 
  visibleOnDesktop,
  visibleOnMobile,   
}) => {
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const isDesktop = useMinWidth('desktop')
  const isLarge = useMinWidth('large')
  const [swiped, setSwiped] = useState(false)
  const [currentSlide, setCurrentSlide] = useState(1)
  const [slidesToShow, setSlidesToShow] = useState(1)
  const carouselRef = useRef()  
  
  const {
    mounted,
    openVideoModalByUrl, 
    customize
  } = useContext(AppContext)

  const customizeSettings = customize?.modules[`videoCarousel${layout}`]    
  
  const settings = {
    arrows: false,
    dots: false,
    ref: carouselRef, 
    slidesToShow,
    beforeChange: (current, next) => {
      setCurrentSlide(next+1)      
    },
    afterChange: (current, next) => {
      playCurrent()
    }
  }    

  const onPrevClick = () => {
    carouselRef.current.slickPrev()
  }

  const onNextClick = () => {
    carouselRef.current.slickNext()
  }

  const onSlideClick = useCallback((e) => {
    if ( swiped ) {
      e.stopPropagation()
      e.preventDefault()
      setSwiped(false)
    }
  }, [swiped])

  const onVideoClick = ( e ) => {    
    openVideoModalByUrl(e.currentTarget.dataset.url)
  }

  const playCurrent = () => {
    const videos = carouselRef.current?.innerSlider?.list?.querySelectorAll('.slick-active video')

    videos.forEach((video) => {      
      video.play()        
    })  
  }

  useEffect(() => {
    setSlidesToShow(isLarge ? (parseInt(slidesToShowDesktop) || 1) : 1)
  }, [isLarge])

  useEffect(() => {
    playCurrent()
  }, [currentSlide])
  
  return (
    <S_VideoCarousel
      className={`layout-${lowerCase(layout)}`}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $ctaEnabled={ctaEnabled}
      $carouselLayoutDesktop={carouselLayoutDesktop}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
    >
      <Container fullBleed>
        <Row
            gutter={{ tb: 0 }}
            flexDirection={{ 
              mb: 'column-reverse', 
              dk: carouselPositionDesktop === 'left' ? 'row-reverse' : 'row' 
            }}
            alignItems={{ dk: 'center' }}
        >
          <Col dk={12} lg={carouselLayoutDesktop === '70:30' ? 8 : 12}>
            <Text
              $carouselPositionDesktop={carouselPositionDesktop}
            >
              {eyebrowEnabled && eyebrow && (
                <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
              )}
              {headline && (
                 <Headline
                    text={headline}
                    align={mounted && isDesktop ? 'left' : 'center'}
                    margin={false}
                    as={headlineTag}
                />
              )}
              {socialLinksEnabled && (                
                <SocialMenuWrapper>
                  {socialLinksEyebrow && (
                    <SocialLinksEyebrow>
                      {socialLinksEyebrow}
                    </SocialLinksEyebrow>
                  )}
                  <S_SocialMenu />                
                </SocialMenuWrapper>
              )}               
              {ctaEnabled && ctaLink && carouselLayoutDesktop === '70:30' && (
                <Link href={ctaLink.url} passHref>
                  <CtaTextArrowButton
                    target={ctaLink.target || undefined}
                    link                      
                  >
                    {ctaLink.title}
                  </CtaTextArrowButton>
              </Link>
               )}
            </Text>            
          </Col>
          <Col dk={12} lg={carouselLayoutDesktop === '70:30' ? 16 : 12}>
            <CarouselWrapper
              $carouselPositionDesktop={carouselPositionDesktop}
            >
              <Carousel {...settings}>
                {videos.map((video, k) => (
                   <Slide
                       key={k}
                       onMouseMove={() => setSwiped(true)}
                       onMouseDown={() => setSwiped(false)}
                       onClickCapture={onSlideClick}
                   >
                     <Video
                         onClick={onVideoClick}
                         data-url={video.videoUrl}
                     >
                      <VideoPoster 
                        $hasTitle={!!video.videoTitle}
                        $overlayOpacity={video.backgroundOverlayOpacity}
                        $gradientDesktop={video.backgroundOverlayOverride ? video.backgroundOverlayDesktop : customizeSettings.backgroundDesktop.videoBackgroundOverlay}
                      >
                         <Box width={3} height={2}>
                           <WPImage
                               image={video.posterImage}
                               layout='fill'
                               objectFit='cover'
                           />
                           {video.posterVideo && (
                              <WPVideo
                                  video={video.posterVideo}
                                  layout='fill'
                                  objectFit='cover'
                                  autoplay={false}
                              /> 
                            )}              
                         </Box>
                       </VideoPoster>
                       <VideoTitlePlay>
                         <VideoPlay trigger={Video} aria-label="Play" />
                         <VideoTitle>
                           {video.videoTitle}
                         </VideoTitle>
                       </VideoTitlePlay>
                     </Video>
                   </Slide>
                 ))}
              </Carousel>

              {videos.length > slidesToShow && (
                 <Nav>
                   <NavArrow onClick={onPrevClick} aria-label="Previous">
                     <Icon icon='arrow-left' />
                   </NavArrow>
                   <NavCount>
                     {new Intl.NumberFormat('en-US', { 
                        minimumIntegerDigits: 2,
                      }).format(currentSlide)}
                     &nbsp;/&nbsp; 
                     {new Intl.NumberFormat('en-US', { 
                        minimumIntegerDigits: 2,
                      }).format(videos.length)}
                   </NavCount>
                   <NavArrow onClick={onNextClick} aria-label="Next">
                     <Icon icon='arrow-right' />
                   </NavArrow>
                 </Nav>
               )}
            </CarouselWrapper>
          </Col>
        </Row>        

        {ctaEnabled && ctaLink && carouselLayoutDesktop !== '70:30' && (
           <Link href={ctaLink.url || ''} passHref>
             <S_CtaButton
               link
               target={ctaLink.target}
               iconColor={`modules.videoCarousel${layout}.ctaIconColor`}
               iconBackground={`modules.videoCarousel${layout}.ctaIconBackground`}
               iconBorder={`modules.videoCarousel${layout}.ctaIconBorder`}
               iconColorHover={`modules.videoCarousel${layout}.ctaIconColorHover`}
               iconBackgroundHover={`modules.videoCarousel${layout}.ctaIconBackgroundHover`}
               iconBorderHover={`modules.videoCarousel${layout}.ctaIconBorderHover`}
             >
               {ctaLink.title}
             </S_CtaButton>
           </Link>
         )}
      </Container>
    </S_VideoCarousel>
  )
}

const S_VideoCarousel = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  position: relative;
  padding: 0 0 60px 0;
  text-align: center;  
  background-size: cover;
  background-repeat: no-repeat;
  background-position: ${p => p.$backgroundPositionMobile || 'center'};
  background-image: ${p =>
    p.$backgroundImageEnabled && p.$backgroundImageMobile ? (
      'url(' + p.$backgroundImageMobile.sourceUrl + ')'
    ) : 'none'
  };  
    
  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    background-position: ${p => p.$backgroundPositionDesktop || 'center'};
    background-image: ${p =>
      p.$backgroundImageEnabled && p.$backgroundImageDesktop ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }

  &.layout-a {
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselA.color') ||
      p.theme.colors.white
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.videoCarouselA.colorBold') ||
        'currentColor'
      };
    }    

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselA.backgroundMobile.backgroundColor') ||
      p.theme.colors.black
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.videoCarouselA.backgroundDesktop.backgroundColor') ||
        p.theme.colors.black
      };      
    }
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselB.color') ||
      p.theme.colors.white
    };
    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.videoCarouselB.colorBold') ||
        'currentColor'
      };
    }    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselB.backgroundMobile.backgroundColor') ||
      p.theme.colors.black
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.videoCarouselB.backgroundDesktop.backgroundColor') ||
        p.theme.colors.black
      };      
    }
  }

  &:before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 1px;
    height: 100%;
    display: none;    

    ${p => p.theme.media.minWidth('desktop')} {
      display: ${p => p.$ctaEnabled && p.$carouselLayoutDesktop !== '70:30' ? 'block' : 'none'};
    }
  }

  &.layout-a:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselA.borderColor') ||
      p.theme.colors.white
    };
  }

  &.layout-b:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselB.borderColor') ||
      p.theme.colors.white
    };
  }  

  .slick-slider {
    ${p => p.theme.media.minWidth('large')} {
      margin: 0 -10px;
    }      
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 100px 0 60px 0;;
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  text-align: center;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    text-align: left;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const Text = styled.div`
  padding: 0 ${p => p.theme.grid.containerPadding.mb}px;

  ${p => p.theme.media.minWidth('desktop')} {  
    text-align: left;  
    padding: 0 ${p => p.$carouselPositionDesktop === 'right' ? 40 : p.theme.grid.containerPadding.dk}px 0 ${p => p.$carouselPositionDesktop === 'right' ? p.theme.grid.containerPadding.dk : 40}px;
  }
`

const CtaTextArrowButton = styled(TextArrowButton)`
  margin: 40px 0 0 0;

  ${S_VideoCarousel}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselA.ctaTextColor') ||
      p.theme.colors.white
    };
  }  

  ${S_VideoCarousel}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselB.ctaTextColor') ||
      p.theme.colors.white
    };
  }  
`

const CarouselWrapper = styled.div`
  margin: 0 0 40px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 0 1px;    
    padding: 0 ${p => p.$carouselPositionDesktop === 'right' ? p.theme.grid.containerPadding.dk : 0}px 0 ${p => p.$carouselPositionDesktop === 'right' ? 0 : p.theme.grid.containerPadding.dk}px;    
  }  
`

const Carousel = styled(Slider)``

const Slide = styled.div`
  ${p => p.theme.media.minWidth('large')} {
    padding: 0 10px;
  }
`

const Video = styled.div`
  position: relative;
  cursor: pointer;

  video {
    opacity: 0;
    transition: opacity 200ms ease;

    &.is-playing {
      opacity: 1;
    }
  }
`

const VideoPoster = styled.div`
  position: relative;

  &:after {
    display: ${p => p.$hasTitle ? 'block' : 'none'};
    content: '';
    background: linear-gradient(rgba(0,0,0,0) 60%, rgba(0,0,0,${p => p.$overlayOpacity >= 0 ? (p.$overlayOpacity / 100) : .5}));
    transform: translateZ(0);
    ${p => p.theme.mixins.fill('absolute')};    
  }
`

const VideoTitlePlay = styled.div`
  display: flex;
  align-items: center;
  position: absolute !important;
  left: 0px;  
  bottom: 20px;
  padding: 0 20px;
  transform: translateZ(0);
  z-index: ${p => p.theme.zindex[2]};
`

const VideoPlay = styled(Play)`
  margin: 0 15px 0 0;  
`

const VideoTitle = styled.div`
  text-align: left;
  color: ${p => p.theme.colors.white};

  .layout-a & {
    ${p => p.theme.mixins.acfTypography('modules.videoCarouselA.videoTitlesStyleMobile.regular')};
      
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.videoCarouselA.videoTitlesStyleDesktop.regular')};
    }    
  }

  .layout-b & {
    ${p => p.theme.mixins.acfTypography('modules.videoCarouselB.videoTitlesStyleMobile.regular')};
      
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.videoCarouselB.videoTitlesStyleDesktop.regular')};
    }    
  }
`

const Nav = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 10px 0 0 0;
  color: currentColor;
  ${p => p.theme.mixins.acfTypography('modules.videoCarouselA.navMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('modules.videoCarouselA.navDesktop.regular')};    
  }
`

const NavArrow = styled.button`
  font-size: 12px;
  height: 12px;
`

const NavCount = styled.span`
  margin: 0 10px;
`

const S_CtaButton = styled(CtaButton)`
  margin: 30px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 40px 0 0 0;
  }

  span:nth-child(1) {
    ${p => p.theme.media.minWidth('desktop')} {
      position: absolute;
      left: 0;
      transform: translateX(-100%) translateX(-20px);
    }    
  }

  span:nth-child(2) {
    ${S_VideoCarousel}.layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.videoCarouselA.backgroundMobile.backgroundColor') ||
        p.theme.colors.black
      };

      ${p => p.theme.media.minWidth('desktop')} {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.videoCarouselA.backgroundDesktop.backgroundColor') ||
          p.theme.colors.black
        };
      }
    }

    ${S_VideoCarousel}.layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.videoCarouselB.backgroundMobile.backgroundColor') ||
        p.theme.colors.black
      };

      ${p => p.theme.media.minWidth('desktop')} {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.videoCarouselB.backgroundDesktop.backgroundColor') ||
          p.theme.colors.black
        };
      }
    }
  }
`

const SocialMenuWrapper = styled.div`
  margin: 40px 0 32px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 48px 0;
  }

  + a {
    margin: 0;
  }
`

const SocialLinksEyebrow = styled.h3`
  margin: 0 0 16px 0;

  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselA.socialLinksEyebrowColor') ||
      p.theme.colors.white
    };

    ${p => p.theme.mixins.acfTypography('modules.videoCarouselA.videoSocialLinksEyebrowMobile.regular')};
    
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.videoCarouselA.videoSocialLinksEyebrowDesktop.regular')};
    }    
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoCarouselB.socialLinksEyebrowColor') ||
      p.theme.colors.white
    };

    ${p => p.theme.mixins.acfTypography('modules.videoCarouselB.videoSocialLinksEyebrowMobile.regular')};
    
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.videoCarouselB.videoSocialLinksEyebrowDesktop.regular')};
    }    
  }  
`

const S_SocialMenu = styled(SocialMenu)`
  ul {
    display: flex;
    justify-content: center;

    ${p => p.theme.media.minWidth('desktop')} {
      justify-content: flex-start;  
    }
  }

  li {
    margin: 5px;
  }  
`

export const GQL_VIDEO_CAROUSEL_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment VideoCarousel${layout}Module on Page_Pagecontent_Modules_VideoCarousel${layout} {   
    backgroundImageEnabled    
    carouselPositionDesktop    
    carouselLayoutDesktop    
    ctaEnabled   
    ctaLink {
      target
      title
      url
    } 
    eyebrowEnabled
    eyebrow
    eyebrowTag
    fieldGroupName
    headline  
    headlineTag  
    slidesToShowDesktop
    socialLinksEnabled
    socialLinksEyebrow
    videos {
      videoTitle
      videoUrl
      posterImage {
        ...WPImage
      }      
      posterVideo {
        link
        mediaItemUrl
      }       
      backgroundOverlayOpacity   
    }    
    visibleOnDesktop
    visibleOnMobile
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_VIDEO_CAROUSEL_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeVideoCarousel${layout}Module on Customize_Modules {
    videoCarousel${layout} {      
      backgroundDesktop {
        backgroundColor
        backgroundImage {
          ...WPImage
        }
        backgroundPosition           
      }
      backgroundMobile {
        backgroundColor
        backgroundImage {
          ...WPImage
        }
        backgroundPosition        
      }
      borderColor
      color
      colorBold
      ctaIconBackground
      ctaIconBackgroundHover
      ctaIconBorder
      ctaIconBorderHover
      ctaIconColor
      ctaIconColorHover
      ctaTextColor      
      navDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      navMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      socialLinksEyebrowColor
      videoSocialLinksEyebrowDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      videoSocialLinksEyebrowMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      videoTitlesStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      videoTitlesStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }      
    }
  }
`

export default VideoCarousel
