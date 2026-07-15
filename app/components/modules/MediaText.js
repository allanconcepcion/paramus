import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import WPVideo from 'components/WPVideo'
import { Container, Row, Col } from 'components/Grid'
import { useMinWidth } from 'hooks/useMedia'
import { Icon } from 'components/SVGIcons'
import AppContext from 'contexts/App'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'

import {
  Cta as CtaButton,
  Play as PlayButton
} from 'components/Button'

const MediaText = ({
  videoUrl,
  mediaMaxWidthDesktop,
  mediaMaxWidthMobile,
  textMaxWidthDesktop,
  textMaxWidthMobile,
  mediaPositionDesktop,
  captionEnabled,
  caption,
  hotspotsEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,
  ctaEnabled,
  ctaIconStyle,
  backgroundImageEnabled,
  textAlignmentMobile,
  fieldGroupName,
  customizeLayout,
  image, 
  video,
  cta, 
  hotspots, 
  visibleOnDesktop,
  visibleOnMobile
}) => {  
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const isDesktop = useMinWidth('desktop')  
  
  const {
    mounted,
    openVideoModalByUrl, 
    customize
  } = useContext(AppContext)

  const customizeSettings = customize?.modules[`mediaText${layout}`]  

  const onMediaClick = () => {
    openVideoModalByUrl(videoUrl)
  }
  
  return (
    <S_MediaText
      className={`layout-${lowerCase(layout)}`}
      $textAlignmentMobile={textAlignmentMobile}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
    >
      <Container $overflow='visible' fullBleed={mounted && isDesktop}>
        <Row
            alignItems={{ dk: 'center' }}
            flexDirection={{ dk: mediaPositionDesktop === 'right' ? 'row-reverse': 'row' }}
            gutter={{ dk: 0 }}
        >
          <Col dk={12}>
            <MediaWrapper
              $maxWidthMobile={mediaMaxWidthMobile}
              $maxWidthDesktop={mediaMaxWidthDesktop}
              $mediaPositionDesktop={mediaPositionDesktop}
            >
              <Media 
                $hasVideo={!!videoUrl} 
                $hasCaption={!!captionEnabled && !!caption}
                onClick={!!videoUrl ? onMediaClick : null}
              >
                <WPImage
                    desktop={image}
                    layout={'responsive'}
                />
                {video && (
                   <WPVideo
                       desktop={video}
                       layout='fill'
                       objectFit='cover'
                   />               
                 )}

                {hotspotsEnabled && (
                  <Hotspots>
                    {hotspots && hotspots.map((hotspot, k) => (
                       <Hotspot
                           key={k}
                           $top={hotspot.positionTop}
                           $left={hotspot.positionLeft}
                       >
                         <HotspotButton>
                           <Icon icon='add' />
                         </HotspotButton>
                         <HotspotLabel>{hotspot.label}</HotspotLabel>
                       </Hotspot>
                    ))}
                  </Hotspots>
                )}
                {videoUrl && (
                  <VideoTitlePlay>
                    <VideoPlay />
                    {captionEnabled && caption && (
                      <VideoTitle>
                        {caption}
                      </VideoTitle>
                    )}                    
                  </VideoTitlePlay>
                 )}
              </Media>
              {!videoUrl && captionEnabled && caption && (
                 <Caption>
                   <Icon icon='arrow-up' />
                   <span>{caption}</span>
                 </Caption>
               )}
            </MediaWrapper>
          </Col>
          <Col dk={12}>
            <Text
                $mediaPositionDesktop={mediaPositionDesktop}
                $textAlignmentMobile={textAlignmentMobile}
            >
              <TextInner
                  $maxWidthMobile={textMaxWidthMobile}
                  $maxWidthDesktop={textMaxWidthDesktop}
              >
                {eyebrowEnabled && eyebrow && (
                  <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
                )}
                {headline && (
                   <S_Headline
                     text={headline}
                     align={mounted && isDesktop ? 'left' : (textAlignmentMobile || 'center')}
                     forwardedAs={headlineTag}
                   />
                 )}
      
                <Rte dangerouslySetInnerHTML={{ __html: body }} />
              </TextInner>
            </Text>              
          </Col>
        </Row>

        {ctaEnabled && cta && (
           <Link href={cta.url || ''} passHref>
             <S_CtaButton
               link
               target={cta.target}
               iconColor={`modules.mediaText${layout}.ctaIcon${ctaIconStyle === 'alt' ? 'Alt' : ''}Color`}
               iconBackground={`modules.mediaText${layout}.ctaIcon${ctaIconStyle === 'alt' ? 'Alt' : ''}Background`}
               iconBorder={`modules.mediaText${layout}.ctaIcon${ctaIconStyle === 'alt' ? 'Alt' : ''}Border`}
               iconColorHover={`modules.mediaText${layout}.ctaIcon${ctaIconStyle === 'alt' ? 'Alt' : ''}ColorHover`}
               iconBackgroundHover={`modules.mediaText${layout}.ctaIcon${ctaIconStyle === 'alt' ? 'Alt' : ''}BackgroundHover`}
               iconBorderHover={`modules.mediaText${layout}.ctaIcon${ctaIconStyle === 'alt' ? 'Alt' : ''}BorderHover`}
             >
               {cta.title}
             </S_CtaButton>
           </Link>
         )}
        
      </Container>
    </S_MediaText>
  )
}

const S_MediaText = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  position: relative;
  padding: 75px 0;
  background-size: cover;
  background-repeat: no-repeat;
  text-align: ${p => p.$textAlignmentMobile || 'center'};
  background-position: ${p => p.$backgroundPositionMobile || 'center'};
  background-image: ${p =>
    p.$backgroundImageEnabled && p.$backgroundImageMobile ? (
      'url(' + p.$backgroundImageMobile.sourceUrl + ')'
    ) : 'none'
  };  
    
  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    padding: 100px 0;
    text-align: center;
    background-position: ${p => p.$backgroundPositionDesktop || 'center'};
    background-image: ${p =>
      p.$backgroundImageEnabled && p.$backgroundImageDesktop ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }

  &.layout-a {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.color') ||
      p.theme.colors.black
    };    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.backgroundMobile.backgroundColor') ||
      p.theme.colors.ltgray
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextA.backgroundDesktop.backgroundColor') ||
        p.theme.colors.ltgray
      };      
    }
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.color') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.backgroundMobile.backgroundColor') ||
      p.theme.colors.ltgray
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextB.backgroundDesktop.backgroundColor') ||
        p.theme.colors.ltgray
      };      
    }
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.color') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.backgroundMobile.backgroundColor') ||
      p.theme.colors.ltgray
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextC.backgroundDesktop.backgroundColor') ||
        p.theme.colors.ltgray
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
      display: block;
    }
  }

  &.layout-a:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.borderColor') ||
      p.theme.colors.black
    };
  }

  &.layout-b:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.borderColor') ||
      p.theme.colors.black
    };
  }

  &.layout-c:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.borderColor') ||
      p.theme.colors.black
    };
  }  
`

const MediaWrapper = styled.div`
  position: relative;
  margin: 0 auto 50px auto;
  max-width: ${p => p.$maxWidthMobile}%;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 auto;
    padding-right: ${p => p.$mediaPositionDesktop === 'right' ? (p.$maxWidthDesktop === 100 ? p.theme.grid.containerPadding.dk : 0) : 0}px;
    padding-left: ${p => p.$mediaPositionDesktop === 'right' ? 0 : (p.$maxWidthDesktop === 100 ? p.theme.grid.containerPadding.dk : 0)}px;
    max-width: ${p => p.$maxWidthDesktop}%;
  }
`

const Media = styled.div`
  position: relative;
  z-index: 1;
  cursor: ${p => p.$hasVideo ? 'pointer' : 'auto'};

  &:after {
    display: ${p => p.$hasCaption ? 'block' : 'none'};
    content: '';
    background: linear-gradient(rgba(0,0,0,0) 60%, ${p => p.$gradient || 'rgba(0,0,0,.6)'});
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const Caption = styled.p`
  display: flex;
  margin: 10px 0 0 0;

  ${p => p.theme.mixins.acfTypography('global.imageCaptionsMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.imageCaptionsDesktop.regular')};
  }

  .icon {
    margin: .4em 0 0 0;
    font-size: 1.4rem;
    flex: 0 0 1.4rem;
  }

  span {
    margin: 0 0 0 15px;
  }
`

const Hotspots = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  z-index: 2;
`

const Hotspot = styled.div`
  position: absolute;
  top: ${p => p.$top}%;
  left: ${p => p.$left}%;   
`

const HotspotLabel = styled.span`
  position: absolute;
  top: 50%;
  left: 0;  
  padding: 5px 32px;
  transform: translateX(-100%) translateX(-10px) translateY(-50%) translateY(10px);
  opacity: 0;
  transition:
    opacity 250ms ease,
    transform 250ms ease
  ;

  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.labelColor') ||
      p.theme.colors.white
    };
    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.labelBackgroundColor') ||
      p.theme.colors.gray
    };
  }  

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.labelColor') ||
      p.theme.colors.white
    };
    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.labelBackgroundColor') ||
      p.theme.colors.gray
    };
  }  

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.labelColor') ||
      p.theme.colors.white
    };
    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.labelBackgroundColor') ||
      p.theme.colors.gray
    };
  }  

  ${p => p.theme.mixins.acfTypography('global.buttonMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.buttonDesktop.regular')};
  }
`

const HotspotButton = styled.button`
  display: block;
  width: 32px;
  height: 32px;
  border-radius: 50%;

  .icon {
    font-size: 3.2rem;       
  }

  .layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.buttonIconColor') ||
      p.theme.colors.white
    };

    .icon {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextA.buttonBackgroundColor') ||
        p.theme.colors.black
      };
    }    
  }  

  .layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.buttonIconColor') ||
      p.theme.colors.white
    };

    .icon {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextB.buttonBackgroundColor') ||
        p.theme.colors.black
      };
    }    
  }  

  .layout-c & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.buttonIconColor') ||
      p.theme.colors.white
    };

    .icon {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextC.buttonBackgroundColor') ||
        p.theme.colors.black
      };
    }    
  }  

  &:hover + ${HotspotLabel} {
    opacity: 1;
    transform: translateX(-100%) translateX(-10px) translateY(-50%);
  }
`

const Text = styled.div`
  text-align: ${p => p.$textAlignmentMobile || 'center'};

  ${p => p.theme.media.minWidth('desktop')} {
    padding-right: ${p => p.$mediaPositionDesktop === 'right' ? 50 : p.theme.grid.containerPadding.dk}px;
    padding-left: ${p => p.$mediaPositionDesktop === 'right' ? p.theme.grid.containerPadding.dk : 50}px;
    padding-top: 0;
    padding-bottom: 0;
    text-align: left;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  ${p => p.theme.media.minWidth('large')} {
    padding-right: ${p => p.$mediaPositionDesktop === 'right' ? 55 : p.theme.grid.containerPadding.lg}px;
    padding-left: ${p => p.$mediaPositionDesktop === 'right' ? p.theme.grid.containerPadding.lg : 55}px;
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    padding-right: ${p => p.$mediaPositionDesktop === 'right' ? 60 : p.theme.grid.containerPadding.xl}px;
    padding-left: ${p => p.$mediaPositionDesktop === 'right' ? p.theme.grid.containerPadding.lg : 60}px;
  }  
`

const TextInner = styled.div`
  margin: 0 auto;
  max-width: ${p => p.$maxWidthMobile || 100}%;

  ${p => p.theme.media.minWidth('desktop')} {
    max-width: ${p => p.$maxWidthDesktop || 100}%;    
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

const S_Headline = styled(Headline)`
  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextA.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextB.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaTextC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextC.headlineColorBold') ||
        'currentColor'
      };
    }
  }  
`

const S_CtaButton = styled(CtaButton)`
  margin: 30px auto 0 auto;
  flex-direction: row-reverse;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 40px auto 0 auto;
  }

  span:nth-child(1) {
    margin: 0 0 0 20px !important;
    
    ${p => p.theme.media.minWidth('desktop')} {
      position: absolute;
      right: 0;
      transform: translateX(100%) translateX(20px);
    }    
  }

  span:nth-child(2) {
    ${S_MediaText}.layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextA.backgroundMobile.backgroundColor') ||
        p.theme.colors.black
      };

      ${p => p.theme.media.minWidth('desktop')} {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.mediaTextA.backgroundDesktop.backgroundColor') ||
          p.theme.colors.black
        };
      }
    }

    ${S_MediaText}.layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextB.backgroundMobile.backgroundColor') ||
        p.theme.colors.black
      };

      ${p => p.theme.media.minWidth('desktop')} {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.mediaTextB.backgroundDesktop.backgroundColor') ||
          p.theme.colors.black
        };
      }
    }

    ${S_MediaText}.layout-c & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaTextC.backgroundMobile.backgroundColor') ||
        p.theme.colors.black
      };

      ${p => p.theme.media.minWidth('desktop')} {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.mediaTextC.backgroundDesktop.backgroundColor') ||
          p.theme.colors.black
        };
      }
    }
  }
`

const VideoTitlePlay = styled.div`
  display: flex;
  align-items: center;
  position: absolute !important;
  left: 0px;  
  bottom: 20px;
  padding: 0 20px;
  z-index: ${p => p.theme.zindex[2]};
`

const VideoPlay = styled(PlayButton)`
  margin: 0 15px 0 0;  
`

const VideoTitle = styled.div`
  text-align: left;
  color: ${p => p.theme.colors.white};

  .layout-a & {
    ${p => p.theme.mixins.acfTypography('modules.mediaTextA.videoTitlesStyleMobile.regular')};
      
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.mediaTextA.videoTitlesStyleDesktop.regular')};
    }    
  }

  .layout-b & {
    ${p => p.theme.mixins.acfTypography('modules.mediaTextB.videoTitlesStyleMobile.regular')};
      
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.mediaTextB.videoTitlesStyleDesktop.regular')};
    }    
  }

  .layout-c & {
    ${p => p.theme.mixins.acfTypography('modules.mediaTextC.videoTitlesStyleMobile.regular')};
      
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.mediaTextC.videoTitlesStyleDesktop.regular')};
    }    
  }
`

export const GQL_MEDIA_TEXT_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment MediaText${layout}Module on Page_Pagecontent_Modules_MediaText${layout} {   
    backgroundImageEnabled
    body
    caption
    captionEnabled
    cta {
      target
      title
      url
    }
    ctaEnabled
    ctaIconStyle
    fieldGroupName
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag
    hotspots {
      label
      positionLeft
      positionTop
      fieldGroupName
    }
    hotspotsEnabled
    image {
      ...WPImage
    }
    mediaMaxWidthDesktop
    mediaMaxWidthMobile
    mediaPositionDesktop
    textAlignmentMobile
    textMaxWidthDesktop
    textMaxWidthMobile    
    video {
      link
      mediaItemUrl
    }    
    videoUrl
    visibleOnDesktop
    visibleOnMobile
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_MEDIA_TEXT_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeMediaText${layout}Module on Customize_Modules {
    mediaText${layout} {
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
      buttonBackgroundColor
      buttonIconColor
      color
      ctaIconBackground
      ctaIconBackgroundHover
      ctaIconBorder
      ctaIconBorderHover
      ctaIconColor
      ctaIconColorHover   
      ctaIconAltBackground
      ctaIconAltBackgroundHover
      ctaIconAltBorder
      ctaIconAltBorderHover
      ctaIconAltColor  
      ctaIconAltColorHover      
      headlineColor
      headlineColorBold      
      labelBackgroundColor
      labelColor
      videoTitlesStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      videoTitlesStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }      
    }
  }
`

export default MediaText
