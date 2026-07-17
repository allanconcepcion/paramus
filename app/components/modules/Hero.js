import { useEffect, useRef, useContext } from 'react'
import styled from 'styled-components'
import Link from 'components/LinkWithQuery'
import { stripHtml } from 'string-strip-html'
import { useParallax } from 'react-scroll-parallax'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import WPVideo from 'components/WPVideo'
import SocialMenu from 'components/SocialMenu'
import Box from 'components/Box'
import AppContext from 'contexts/App'
import { Play } from 'components/Button'
import { Icon } from 'components/SVGIcons'
import { useMinWidth } from 'hooks/useMedia'
import { breakpoints } from 'styles/media'
import { isTouch } from 'hooks/useDevice'
import { transparentize } from 'utils/color'
import { nl2br, toLocalUrl } from 'utils/dom'

const Hero = ({
  contentType,
  eyebrow,
  headline,
  showImageMobile,
  backgroundImageDesktop,
  backgroundImageMobile,
  backgroundVideoDesktop,
  backgroundVideoMobile,
  backgroundOverlayDesktop,
  backgroundOverlayMobile,
  globalBackgroundOverlayOverride,
  backgroundPositionDesktop,
  backgroundPositionMobile, 
  image,
  imageMaxWidth,
  imageMaxWidthMobile,
  videoEnabled,
  videoPosterImage,
  videoPosterVideo,
  videoTitle,
  videoUrl,
  linkOverride,
  linkEnabled,
  linklistEnabled,
  linklist,
  link,
  ctaOverride,
  ctaEnabled,
  cta,
  copyAlignmentDesktop,
  textBackgroundImageMobile,
  height='full', 

  minHeightMobile,  
  copyFormat='header'
}) => {      
  const {
    mounted,
    openVideoModalByUrl, 
    customize   
  } = useContext(AppContext)    
  
  const isTablet = useMinWidth('tablet')
  const isDesktop = useMinWidth('desktop')
  const isTouchDevice = isTouch()
  const elRef = useRef()  
  const { ref:backgroundParallaxRef } = useParallax({ 
    speed: mounted && isTablet ? -15 : 0 
  })      
        
  const setHeight = () => {        
    let minHeight = 0    

    if ( window.innerWidth < breakpoints.desktop ) {      
      let wMin = window.innerHeight * (minHeightMobile/100)      
      minHeight = `${wMin}px`    
    } else if ( height === 'full' ) {            
      minHeight = `${window.innerHeight}px`
    } else {
      minHeight = `0`
    }

    elRef.current.style.minHeight = minHeight
  }

  const onVideoPlayClick = () => {
    openVideoModalByUrl(videoUrl)
  }
    
  const onWindowResize = () => {
    if ( !isTouchDevice ) {
      setHeight()
    }    
  }
  
  useEffect(() => {
    setHeight()
  }, [])  

  useEffect(() => {
    window.addEventListener('resize', onWindowResize)

    return () => {
      window.removeEventListener('resize', onWindowResize)
    }
  }, [])

  const renderContent = () => {
    if ( contentType === 'image' ) {
      return (
        <ImageContent 
          $maxWidth={imageMaxWidth}
          $maxWidthMobile={imageMaxWidthMobile}
          $showMobile={showImageMobile}
        >
          <WPImage 
            image={image} 
            priority={true} 
            unoptimized
          />
        </ImageContent>
      )
    } else if ( contentType === 'copy' ) {            
      return (
        <CopyContent
          $alignment={copyAlignmentDesktop}
          $backgroundImageMobile={
            textBackgroundImageMobile?.sourceUrl ||
            customize?.modules.hero.copyMobile.textBackgroundImageMobile?.sourceUrl            
          }
        >
          <Eyebrow 
            as={copyFormat === 'paragraph' ? 'p' : 'h1'}
          >
            {eyebrow}
          </Eyebrow>
          {headline && (
             <Headline 
              as={copyFormat === 'paragraph' ? 'p' : 'h2'}
              dangerouslySetInnerHTML={{
                __html: stripHtml(headline, { onlyStripTags: 'p' }).result
              }} 
            />
           )}
        </CopyContent>
      )      
    }
  }
  const renderLinklist = () => {
    if ( !linklistEnabled ) return
   
    return (
      <Linklist>
        {linklist.map((element, i) => {
          return (
            <li key={i}>
              <Link href={toLocalUrl(element.link?.url)}>
                <a target={element.link?.target ? '_blank' : undefined}>{element.link?.title}</a>
              </Link>
            </li>
          )
        })}
      </Linklist>
    )
  } 
  
  return (
    <S_Hero 
      ref={elRef}  
      $contentType={contentType}    
      $showImageMobile={showImageMobile}
    >
      {renderContent()}
      {renderLinklist()}
      {videoEnabled && (
        <VideoPlayMobileWrapper>
          <VideoPlayMobileInner>
            <VideoPlayMobile onClick={onVideoPlayClick} aria-label="Play" />
          </VideoPlayMobileInner>          
        </VideoPlayMobileWrapper>
      )}
      <Background          
          $globalOverlayDesktop={customize?.modules.hero.backgroundOverlayDesktop}
          $globalOverlayMobile={customize?.modules.hero.backgroundOverlayMobile}
          $globalOverlayOverride={globalBackgroundOverlayOverride}          
          $overlayDesktop={backgroundOverlayDesktop}
          $overlayMobile={backgroundOverlayMobile}          
          $videoEnabled={videoEnabled}
          $avoidHeader={customize?.modules.hero.avoidHeader}
          $contentType={contentType}
          $showImageMobile={showImageMobile}
      >
        <BackgroundMedia ref={backgroundParallaxRef}>
          {(backgroundImageDesktop || backgroundImageMobile) && (
             <WPImage
                 desktop={backgroundImageDesktop}
                 mobile={backgroundImageMobile}
                 layout='fill'
                 objectFit='cover'
                 objectPosition={mounted && isDesktop ? backgroundPositionDesktop : backgroundPositionMobile}
                 quality={100}
                 priority={true}
                 unoptimized
             />
           )}
          {(backgroundVideoDesktop || backgroundVideoMobile) && (
             <WPVideo
                 desktop={backgroundVideoDesktop}
                 mobile={backgroundVideoMobile}
                 layout='fill'
                 objectFit='cover'
                 objectPosition={mounted && isDesktop ? backgroundPositionDesktop : backgroundPositionMobile}
             />               
           )}
        </BackgroundMedia>
      </Background>

      {mounted && isDesktop && (
         <Sidebar>
           <S_SocialMenu />
         </Sidebar>
       )}

      {videoEnabled && mounted && isTablet && (
         <VideoPoster>
           <Box width={7} height={5}>
             {videoPosterImage && (
                <WPImage
                    image={videoPosterImage}
                    layout='fill'
                    objectFit='cover'
                    priority={true}
                />
              )}
             {videoPosterVideo && (
                <WPVideo
                    video={videoPosterVideo}
                    layout='fill'
                    objectFit='cover'
                />
              )}        
           </Box>
           <VideoPlay onClick={onVideoPlayClick} aria-label="Play" />
         </VideoPoster>
       )}

      {(videoEnabled || (ctaOverride && ctaEnabled) || customize?.modules.hero.ctaEnabled) && (
         <BottomBar $videoEnabled={videoEnabled}>
           {videoEnabled && mounted && !isTablet && (
              <VideoMobile>
                <VideoPlay onClick={onVideoPlayClick} aria-label="Play"/>
                <VideoTitle dangerouslySetInnerHTML={{ __html: nl2br(videoTitle)}} />                
              </VideoMobile>
            )}

           {videoEnabled && mounted && isTablet && (
              <VideoTitle dangerouslySetInnerHTML={{ __html: nl2br(videoTitle)}} />
            )}

            {customize?.modules.hero.linkEnabled && !linkOverride && mounted && isDesktop && (
              <SimpleButton>
                <Link href={toLocalUrl(customize?.modules.hero.link.url)}>
                  <a target={customize?.modules.hero.link.target}>
                    <span>{customize?.modules.hero.link.title}</span>
                  </a>              
                </Link>              
              </SimpleButton>              
            )}
           
           {linkOverride && linkEnabled && mounted && isDesktop && (
              <SimpleButton>
                <Link href={toLocalUrl(link.url)}>
                  <a target={link.target}>
                    <span>{link.title}</span>
                  </a>              
                </Link>              
              </SimpleButton>                      
            )}            

           {customize?.modules.hero.ctaEnabled && !ctaOverride && mounted && isDesktop && (
              <Cta>
                <Link href={toLocalUrl(customize?.modules.hero.cta.url)}>
                  <a target={customize?.modules.hero.cta.target}>
                    <CtaIcon>
                      <Icon icon='arrow-right' />
                    </CtaIcon>
                    <CtaTitle>
                      <span>{customize?.modules.hero.cta.title}</span>
                    </CtaTitle>
                  </a>
                </Link>
              </Cta>
            )}
           
           {ctaOverride && ctaEnabled && mounted && isDesktop && (
              <Cta>
                <Link href={toLocalUrl(cta.url)}>
                  <a target={cta.target}>
                    <CtaIcon>
                      <Icon icon='arrow-right' />
                    </CtaIcon>
                    <CtaTitle>
                      <span>{cta.title}</span>
                    </CtaTitle>
                  </a>
                </Link>
              </Cta>
            )}            
         </BottomBar>
       )}
    </S_Hero>
  )
}



const S_Hero = styled.div`
  position: relative;
  display: flex;
  flex-direction: ${p => p.$contentType === 'image' && p.$showImageMobile ? 'column' : 'column-reverse'};
  color: ${p => p.theme.colors.white};
  padding: ${p => p.theme.headerHeight}px 0 0 0;
  min-height: 100vh;

  ${p => p.theme.media.minWidth('mobile-large')} {
    flex-direction: column;
  }

  ${p => p.theme.media.minWidth('tablet')} {
    display: flex;    
    justify-content: center;
    padding-top: 0px;
  }
`

const ImageContent = styled.div`
  display: ${p => p.$showMobile ? 'flex' : 'none'};
  width: 100%;
  margin: 75px auto;
  padding: 0 30px;
  max-width: ${p => p.$maxWidthMobile ? (p.$maxWidthMobile + 'px') : 'auto'};    
  z-index: ${p => p.theme.zindex[2]};
  flex: 1;
  align-items: center;

  > div {
    width: 100%;
  }

  ${p => p.theme.media.minWidth('tablet')} {
    display: flex;
    max-width: ${p => p.$maxWidth + 60}px;    
    margin: 275px auto;
  }

  ${p => p.theme.media.minWidth('large')} {
    margin: 275px auto;
  }
`

const CopyContent = styled.div`
  padding: 60px 30px 40px 30px;
  width: 100%;
  text-align: center;
  background-color: ${p =>
    p.theme.mixins.acfColor('modules.hero.copyMobile.backgroundColor') ||
    p.theme.colors.black
  };

  background-image: ${p => p.$backgroundImageMobile ? ('url(' + p.$backgroundImageMobile + ')') : 'none'};
  background-size: 100%;
  background-repeat: no-repeat;

  ${p => p.theme.media.minWidth('mobile-large')} {
    padding: 40px 30px;  
  }

  ${p => p.theme.media.minWidth('tablet')} {
    position: relative;        
    padding: 0 ${p => p.theme.grid.containerPadding.tb}px;
    text-align: ${p => p.$alignment};
    background-color: transparent;
    background-image: none;
    z-index: ${p => p.theme.zindex[2]};
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 250px 0;
    padding: 0 ${p => p.theme.grid.containerPadding.dk}px 0 ${p => p.theme.grid.containerPadding.dk}px;
  }

  ${p => p.theme.media.minWidth('large')} {
    margin: 275px 0;
    padding: 0 ${p => p.theme.grid.containerPadding.lg}px 0 ${p => p.theme.grid.containerPadding.lg}px;
  }

  ${p => p.theme.media.minWidth('large')} {
    margin: 325px 0;
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 20px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const Headline = styled.h2`
  margin: 0;
  ${p => p.theme.mixins.acfTypography('modules.hero.copyMobile.headlineRegular')};

  strong {
    ${p => p.theme.mixins.acfTypography('modules.hero.copyMobile.headlineBold')};
  }

  ${p => p.theme.media.minWidth('tablet')} {
    ${p => p.theme.mixins.acfTypography('modules.hero.copyDesktop.headlineRegular')};
    
    strong {
      ${p => p.theme.mixins.acfTypography('modules.hero.copyDesktop.headlineBold')};
    }
  }
`

const Sidebar = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  position: absolute;
  top: ${p => p.theme.headerHeight}px;
  right: 0;  
  width: ${p => p.theme.headerContentHeight}px;
  height: calc(100% - ${p => p.theme.headerHeight}px);
  padding: 30px 0;
  border-left: solid 1px ${p => transparentize(p.theme.colors.white, .5)};
  opacity: ${p => p.theme.headerContentHeight === 0 ? 0 : 1};
  z-index: ${p => p.theme.zindex[2]};
`

const BottomBar = styled.div`  
  display: none;
  align-items: center;
  justify-content: center;
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: auto;
  padding: 0 30px;
  border-top: solid 1px ${p => transparentize(p.theme.colors.white, .5)}; 
  z-index: ${p => p.theme.zindex[2]};

  ${p => p.theme.media.minWidth('mobile-large')} {
    display: flex;
  }

  ${p => p.theme.media.minWidth('tablet')} {  
    justify-content: space-between;
    padding: 0 0 0 ${p => p.$videoEnabled ? 380 : 0}px;
    width: 100%;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    height: auto;
    min-height: 80px;
    width: calc(100% - ${p => p.theme.headerContentHeight}px);
  }
`

const S_SocialMenu = styled(SocialMenu)`
  li {
    margin: 0 0 15px 0;

    &:last-child {
      margin: 0;
    }
  }
`

const VideoPoster = styled.div`
  position: absolute;
  left: 0;
  bottom: 0;
  z-index: ${p => p.theme.zindex[3]};  
  width: 380px;

  video {    
    ${p => p.theme.mixins.fill('absolute')};    
    object-fit: cover;
    z-index: ${p => p.theme.zindex[2]};
  }
`

const VideoMobile = styled.div`
  display: flex;
  align-items: center;
  margin: 12px 0;
`

const VideoPlay = styled(Play)`
  margin: 0 16px 0 0;

  ${p => p.theme.media.minWidth('tablet')} {
    position: absolute !important;
    right: 10px;
    bottom: 10px;  
    z-index: ${p => p.theme.zindex[2]};
  }  
`

const VideoTitle = styled.div`
  ${p => p.theme.mixins.acfTypography('modules.hero.ctaBarTypographyMobile.regular')};

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 20px 0 20px 20px;
    ${p => p.theme.mixins.acfTypography('modules.hero.ctaBarTypographyDesktop.regular')};
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 20px;
  }

  br {
    ${p => p.theme.media.maxWidth('large')} {
      display: none;
    }
  }
`

const VideoPlayMobileWrapper = styled.div`
  position: relative;
  z-index: ${p => p.theme.zindex[2]};
  background-color: ${p => p.theme.colors.white};
  height: 12px;

  ${p => p.theme.media.minWidth('mobile-large')} {
    display: none;
  }
`

const VideoPlayMobileInner = styled.div`
  ${p => p.theme.mixins.center('absolute')};
  background-color: ${p => p.theme.colors.white};
  border-radius: 50%;
  padding: 14px;
` 

const VideoPlayMobile = styled(Play)`
  width: 56px;
  height: 56px;
  border: solid 1px ${p => p.theme.colors.black};  
  transition: border-color 300ms ease;

  @media(hover:hover) {
    &:hover {
      border-color: transparent;
    }
  }  

  .icon {
    width: 24px;
    height: 24px;
    color: ${p => p.theme.colors.black} !important;
  }
`

const Cta = styled.div`
  display: flex;
  align-self: stretch;
  margin: 0 0 0 auto;
  ${p => p.theme.mixins.acfTypography('modules.hero.ctaBarTypographyMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('modules.hero.ctaBarTypographyDesktop.regular')};
  }

  a {
    display: flex;
    align-self: stretch;
    color: inherit;
  }
`

const CtaIcon = styled.div`
  display: flex;
  align-items: center;
  padding: 10px 15px;
  background-color: ${p =>
    p.theme.mixins.acfColor('modules.hero.ctaIconBackgroundColor') ||
    p.theme.colors.white
  };
  
  .icon {
    width: 16px;
    height: 16px;
    fill: ${p =>
      p.theme.mixins.acfColor('modules.hero.ctaIconColor') ||
      p.theme.colors.black
    };    
  }  
`

const CtaTitle = styled.div`
  position: relative;
  display: flex;
  align-items: center;
  padding: 10px 15px;
  white-space: nowrap;

  ${p => p.theme.media.minWidth('large')} {
    padding: 10px 30px;
  }
  
  &:before {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};    
    z-index: 1;
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.hero.ctaTitleBackgroundColor') ||
      'transparent'
    };
  }

  &:after {
    content: '';
    position: absolute;
    width: 0;
    height: 100%;
    left: 0;
    top: 0;
    z-index: 2;
    transition: width 300ms ease;
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.hero.ctaIconBackgroundColor') ||
      'transparent'
    };
  }

  span {
    position: relative;
    z-index: 3;
    transition: color 300ms ease;
    color: ${p =>
      p.theme.mixins.acfColor('modules.hero.ctaTitleColor') ||
      p.theme.colors.white
    };
  }

  ${Cta}:hover & {
    &:after {
      width: 100%;
    }
    span {
      color: ${p =>
        p.theme.mixins.acfColor('modules.hero.ctaTitleColorHover') ||
        p.theme.colors.white
      };
    }
  }
`

const SimpleButton = styled.div`
  display: block;
  margin: 0 32px;  

  a {
    ${p => p.theme.mixins.acfTypography('modules.hero.ctaBarTypographyMobile.regular')};
    white-space: nowrap;
    padding: 12px 24px;        
    border-radius: 4px;
    transition: opacity 200ms ease;
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.hero.linkBackgroundColor') ||
      p.theme.colors.white
    };
    color: ${p =>
      p.theme.mixins.acfColor('modules.hero.linkColor') ||
      p.theme.colors.black
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.hero.ctaBarTypographyDesktop.regular')};
    }

    @media(hover:hover) {
      &:hover {
        opacity: .9;
      }    
    }    
  }
`

const Background = styled.div`
  position: relative;
  flex: 1;
  overflow: hidden;
  z-index: ${p => p.theme.zindex[1]};  

  ${p => p.$contentType === 'image' && p.$showImageMobile ? p.theme.mixins.fill('absolute') : ''};
  top: ${p => p.$contentType === 'image' && p.$showImageMobile && p.$avoidHeader ? p.theme.headerHeight : 0}px;
  height: calc(100% - ${p => p.$contentType === 'image' && p.$showImageMobile && p.$avoidHeader ? p.theme.headerHeight : 0}px);

  ${p => p.theme.media.minWidth('tablet')} {
    ${p => p.theme.mixins.fill('absolute')};
    top: ${p => p.$avoidHeader ? p.theme.headerHeight : 0}px;
    height: calc(100% - ${p => p.$avoidHeader ? p.theme.headerHeight : 0}px);
  }  

  &:after {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};
    background: ${p => p.$globalOverlayOverride ? p.$overlayMobile : (p.$globalOverlayMobile || 'rgba(0,0,0,.5)')};
    z-index: ${p => p.theme.zindex[2]};
    display: block;

    ${p => p.theme.media.minWidth('tablet')} {    
      background: ${p => p.$globalOverlayOverride ? p.$overlayDesktop : (p.$globalOverlayDesktop || 'rgba(0,0,0,.5)')};
    }
  }

  video {    
    ${p => p.theme.mixins.fill('absolute')};    
    object-fit: cover;
    z-index: ${p => p.theme.zindex[2]};
  }
`

const BackgroundMedia = styled.div`
  position: absolute;
  top: -10%;
  left: 0;
  width: 100%;
  height: 120%;
`

const Linklist = styled.ul`
  margin: 0;
  padding: 0;
  list-style: none;

  li {

  }

  a {
    
  }
`

export const GQL_HERO = `
  ${GQL_WP_IMAGE}

  fragment Hero on Page {    
    hero {
      contentType
      eyebrow
      headline
      showImageMobile
      backgroundImageDesktop {
        ...WPImage
      }
      backgroundImageMobile {
        ...WPImage
      }
      backgroundVideoDesktop {
        id
        mediaItemUrl
        mediaType
      }
      backgroundVideoMobile {
        id
        mediaItemUrl
        mediaType
      }
      backgroundOverlayDesktop
      backgroundOverlayMobile
      globalBackgroundOverlayOverride
      backgroundPositionDesktop
      backgroundPositionMobile
      image {
        ...WPImage
      }
      imageMaxWidth
      imageMaxWidthMobile
      videoEnabled
      videoPosterImage {
        ...WPImage
      }
      videoPosterVideo {
        id
        mediaItemUrl
        mediaType
      }
      videoTitle
      videoUrl
      linkOverride
      linkEnabled
      link {
        target
        title
        url
      }
      ctaOverride
      ctaEnabled
      cta {
        target
        title
        url
      }
      copyAlignmentDesktop
      textBackgroundImageMobile {
        ...WPImage
      }
      height
      minHeightMobile


      linklistEnabled
      linklist{
        link{
        title
        target
        url
        }
      }
    }
  }
`

export const GQL_CUSTOMIZE_HERO = `
  ${GQL_WP_IMAGE}

  fragment CustomizeHero on Customize_Modules {
    hero {
      avoidHeader
      backgroundOverlayDesktop
      backgroundOverlayMobile
      copyDesktop {
        ${GQL_ACF_TYPOGRAPHY('headlineBold')}
        ${GQL_ACF_TYPOGRAPHY('headlineRegular')}        
      }
      copyMobile {
        backgroundColor
        textBackgroundImageMobile {
          ...WPImage
        }
        ${GQL_ACF_TYPOGRAPHY('headlineBold')}
        ${GQL_ACF_TYPOGRAPHY('headlineRegular')}
      }
      cta {
        target
        title
        url
      }  
      ctaBarTypographyDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      ctaBarTypographyMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      ctaEnabled
      ctaIconBackgroundColor
      ctaIconColor
      ctaTitleBackgroundColor
      ctaTitleColor
      ctaTitleColorHover
      linkEnabled
      link {
        target
        title
        url
      }
      linkBackgroundColor
      linkColor        
    }    
  }
`


export default Hero
