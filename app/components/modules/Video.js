import { useContext } from 'react'
import styled from 'styled-components'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import WPVideo from 'components/WPVideo'
import Box from 'components/Box'
import Headline from 'components/Headline'
import { Container } from 'components/Grid'
import { H3, Rte } from 'components/Typography'
import { Play } from 'components/Button'
import { nl2br } from 'utils/dom'
import AppContext from 'contexts/App'
import { useMinWidth } from 'hooks/useMedia'

const Video = ({
  posterImage,
  posterVideo,
  title,
  url,
  textEnabled,
  headline,
  body,
  videoContainer,
  colors,
}) => {
  const isDesktop = useMinWidth('desktop')
  
  const {
    mounted,
    openVideoModalByUrl
  } = useContext(AppContext)
  
  const onClick = () => {
    openVideoModalByUrl(url)
  }
  
  return (
    <S_Video  
      $backgroundColor={colors.backgroundColor}
      $containerFormat={videoContainer.format}
    >      
      <Container
          fullBleed={mounted && !isDesktop || videoContainer.format === 'fullBleed'}
          maxWidth={mounted && isDesktop && videoContainer.format === 'contained' ? 'large' : false}
      >
        <VideoEl
          $hasUrl={!!url}
          onClick={url ? onClick : undefined}
        >
          <Poster $gradient={colors.gradientColor}>
            <Box
                width={mounted && isDesktop ? 16 : 3}
                height={mounted && isDesktop ? 9 : 2}
            >
              <WPImage
                  image={posterImage}
                  layout='fill'
                  objectFit='cover'
              />
              {posterVideo && (
                 <WPVideo
                     video={posterVideo}
                     layout='fill'
                     objectFit='cover'
                 />
               )}
            </Box>
          </Poster>

          {url && (
             <PlayTitle>
               <Container
                   padding={{
                     dk: mounted && isDesktop && videoContainer.format === 'contained' ? 3 : 7
                   }}
                   maxWidth={false}
                   $overflow='visible'
               >
                 <PlayButton aria-label="Play" />
                 <Title
                     dangerouslySetInnerHTML={{ __html: nl2br(title || '') }}
                 />
               </Container>
             </PlayTitle>
           )}
        </VideoEl>
      </Container>

      {textEnabled && (
         <Container maxWidth='large'>
           <Text
             $color={colors.color}
             $colorBold={colors.colorBold}
           >           
             {headline && (
                <Headline 
                  text={headline}                   
                />                
              )}
           {body && (
              <Body 
                dangerouslySetInnerHTML={{ __html: body }} 
                $color={colors.bodyColor}
              />                
            )}           
           </Text>
         </Container>
       )}
    </S_Video>    
  )
}

const S_Video = styled.div`
  position: relative;
  background-color: ${p => p.theme.mixins.acfColor(p.$backgroundColor)};

  ${p => p.theme.media.minWidth('desktop')} {
    padding: ${p => p.$containerFormat === 'contained' ? 100 : 0}px 0;
  }

  ${p => p.theme.media.minWidth('large')} {
    padding: ${p => p.$containerFormat === 'contained' ? 120 : 0}px 0;
  }  
`

const VideoEl = styled.div`
  position: relative;
  cursor: ${p => p.$hasUrl ? 'pointer' : 'auto'};
`

const Poster = styled.div`
  position: relative;

  &:after {
    content: '';
    background: linear-gradient(rgba(0,0,0,0) 60%, ${p => p.$gradient || 'rgba(0,0,0,.6)'});
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const PlayTitle = styled.div`
  position: absolute;
  bottom: 20px;
  left: 0;
  width: 100%;
  color: ${p => p.theme.colors.white};
  z-index: ${p => p.theme.zindex[1]};
  text-align: left;

  ${p => p.theme.media.minWidth('desktop')} {
    bottom: 40px;
  }

  ${Container} {
    display: flex;
    align-items: center;
  }
`

const Title = styled(H3)`
  margin: 0;
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.extraBold')};
    
  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.extraBold')};
  }
`

const PlayButton = styled(Play)`
  margin: 0 15px 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 30px 0 0;
    width: 112px !important;
    height: 112px !important;
    flex: 0 0 112px !important;

    .icon {
      width: 40px !important;
      height: 40px !important;
      margin: 0 0 0 6px;
    }
  }
`

const Text = styled.div`
  margin: 60px 0 60px 0;
  text-align: center;
  color: ${p => p.theme.mixins.acfColor(p.$color)};

  strong {
    color: ${p =>
      p.theme.mixins.acfColor(p.$colorBold) ||
      'currentColor'
    };  
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 60px 0 0 0;
  }
`

const Body = styled(Rte)`
  color: ${p => p.theme.mixins.acfColor(p.$color)};
`

export const GQL_VIDEO_MODULE = `
  ${GQL_WP_IMAGE}
  
  fragment VideoModule on Page_Pagecontent_Modules_Video {    
    body
    colors {
      backgroundColor
      color
      colorBold
      bodyColor
      gradientColor
    }
    fieldGroupName
    headline
    posterImage {
      ...WPImage
    }
    posterVideo {
      link
      mediaItemUrl
    }        
    textEnabled
    title
    url 
    videoContainer {
      format
    }
  }
`

export default Video
