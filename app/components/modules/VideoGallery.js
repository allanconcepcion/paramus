import { useContext } from 'react'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'

import { Container, Row, Col } from 'components/Grid'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import Box from 'components/Box'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import { Play } from 'components/Button'
import AppContext from 'contexts/App'
import { nl2br } from 'utils/dom'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql' 

const VideoGallery = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,
  items,
  fieldGroupName,
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const {
    openVideoModalByUrl, 
    customize
  } = useContext(AppContext)

  const layout = lowerCase(last(fieldGroupName))
  const customizeSettings = customize?.modules[`videoGallery${last(fieldGroupName)}`]  

  const onVideoClick = ( url ) => {
    openVideoModalByUrl(url)
  }
  
  return (
    <S_VideoGallery 
      className={`layout-${layout}`}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
    >
      <Container maxWidth='large'>        
        <Header>
          {eyebrowEnabled && eyebrow && (
            <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
          )}
          {headline && (
             <S_Headline 
              text={headline} 
              forwardedAs={headlineTag}
            />
           )}
          {body && (
             <Body dangerouslySetInnerHTML={{ __html: body }} />
           )}
        </Header>
      </Container>
      <Container padding={{ xl: 15 }}>
        <Row>
          {items.map((item, k) => (
             <Col
                 tb={12}
                 key={k}
             >
               <Video onClick={() => onVideoClick(item.url)}>
                 <VideoPoster>
                   <Box
                       width={3}
                       height={2}
                   >
                     <WPImage
                         image={item.posterImage}
                         layout='fill'
                         objectFit='cover'
                     />
                   </Box>
                 </VideoPoster>
                 <VideoPlayTitle>
                   <PlayButton trigger={Video} />
                   {item.title && (
                      <VideoTitle
                          dangerouslySetInnerHTML={{ __html: nl2br(item.title || '') }}
                      />
                    )}
                 </VideoPlayTitle>
               </Video>
             </Col>
           ))}
        </Row>
      </Container>
    </S_VideoGallery>
  )
}

const S_VideoGallery = styled.div`  
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  margin: ${p => p.$backgroundImageEnabled ? 0 : 50}px 0;
  padding: ${p => p.$backgroundImageEnabled ? 50 : 0}px 0;
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

  ${p => p.theme.media.minWidth('tablet')} {    
    margin: ${p => p.$backgroundImageEnabled ? 0 : 75}px 0;
    padding: ${p => p.$backgroundImageEnabled ? 75 : 0}px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: ${p => p.$backgroundImageEnabled ? 0 : 100}px 0;
    padding: ${p => p.$backgroundImageEnabled ? 100 : 0}px 0;
  }

  ${p => p.theme.media.minWidth('large')} {
    margin: ${p => p.$backgroundImageEnabled ? 0 : 120}px 0;
    padding: ${p => p.$backgroundImageEnabled ? 120 : 0}px 0;
  }    
`

const Header = styled.div`
  margin: 0 0 40px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 70px 0;
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  text-align: center;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const S_Headline = styled(Headline)`
  .layout-a & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoGalleryA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.videoGalleryA.headlineColorBold') ||
        'currentColor'
      };
    }
  }
`

const Body = styled(Rte)`
  text-align: center;

  .layout-a & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.videoGalleryA.textColor') ||
      p.theme.colors.black
    };
  }
`

const Video = styled.div`
  position: relative;
  cursor: pointer;
  margin: 0 0 40px 0;

  ${Col}:last-child & {
    margin-bottom: 0;
  }

  ${p => p.theme.media.minWidth('tablet')} {
    ${Col}:nth-last-child(-n+2) & {
      margin-bottom: 0;
    }
  }
`

const VideoPoster = styled.div`
  position: relative;

  &:after {
    content: '';
    background: linear-gradient(rgba(0,0,0,0) 60%, ${p => p.$gradient || 'rgba(0,0,0,.6)'});
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const VideoPlayTitle = styled.div`
  display: flex;
  align-items: center;
  position: absolute;
  bottom: 20px;
  left: 0;
  width: 100%;
  color: ${p => p.theme.colors.white};
  z-index: ${p => p.theme.zindex[1]};
  text-align: left;
  padding: 0 20px;
`

const VideoTitle = styled.div`
  .layout-a & {
    ${p => p.theme.mixins.acfTypography('modules.videoGalleryA.videoTitlesStyleMobile.regular')};
      
    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('modules.videoGalleryA.videoTitlesStyleDesktop.regular')};
    }    
  }
`

const PlayButton = styled(Play)`
  margin: 0 15px 0 0;
`

export const GQL_VIDEO_GALLERY_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment VideoGallery${layout}Module on Page_Pagecontent_Modules_VideoGallery${layout} {   
    backgroundImageEnabled    
    body
    eyebrow
    eyebrowEnabled
    eyebrowTag
    fieldGroupName
    headline
    headlineTag            
    items {
      title
      url
      posterImage {
        ...WPImage
      }
    }
    visibleOnDesktop
    visibleOnMobile
  }
`

export const GQL_CUSTOMIZE_VIDEO_GALLERY_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeVideoGallery${layout}Module on Customize_Modules {
    videoGallery${layout} {         
      backgroundDesktop {
        backgroundImage {
          ...WPImage
        }
        backgroundPosition
      }
      backgroundMobile {
        backgroundImage {
          ...WPImage
        }
        backgroundPosition
      } 
      headlineColor
      headlineColorBold
      textColor
      videoTitlesStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }       
      videoTitlesStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }       
    }
  }
`

export default VideoGallery
