import { useContext } from 'react'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import { Container, Row, Col } from 'components/Grid'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import WPVideo from 'components/WPVideo'
import { useMinWidth } from 'hooks/useMedia'
import AppContext from 'contexts/App'

const MediaText2x = ({  
  backgroundImageEnabled,
  fieldGroupName,
  customizeLayout,
  rowA, 
  rowB,  
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const isDesktop = useMinWidth('desktop')

  const {
    mounted,
    customize
  } = useContext(AppContext)  
  
  const customizeSettings = customize?.modules[`mediaText2x${layout}`]  
  
  return (
    <S_MediaText2x
      className={`layout-${lowerCase(layout)}`}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
    >
      <Container>
        <Row gutter={{ dk: 0 }} alignItems={{ dk: 'flex-end' }}>
          <MediaCol dk={12} $isIframeEmbed={rowA.mediaType === 'iframeEmbed'}>
            <Media $isIframeEmbed={rowA.mediaType === 'iframeEmbed'}>              
              {rowA.mediaType === 'imageVideo' && (
                <>
                  <WPImage
                    image={rowA.image}
                    layout={'responsive'}
                  />
                  {rowA.video && (
                    <WPVideo
                      video={rowA.video}
                      layout='fill'
                      objectFit='cover'
                    />
                  )}
                </>
              )}              
              {rowA.mediaType === 'iframeEmbed' && (
                <IframeEmbed
                  dangerouslySetInnerHTML={{ __html: rowA.iframeEmbed }}
                />
              )}              
            </Media>
          </MediaCol>
          <TextCol dk={12}>
            <TextA $textAlignmentMobile={rowA.textAlignmentMobile}>
              {rowA.eyebrowEnabled && rowA.eyebrow && (
                <Eyebrow as={rowA.eyebrowTag}>{rowA.eyebrow}</Eyebrow>
               )}
              {rowA.headline && (
                 <S_Headline
                     text={rowA.headline}
                     align={mounted && isDesktop ? 'left' : (rowA.textAlignmentMobile || 'center')}
                     forwardedAs={rowA.headlineTag}
                 />
               )}
      
              <Rte dangerouslySetInnerHTML={{ __html: rowA.body }} />
            </TextA>
          </TextCol>
        </Row>
      </Container>
      
      <Divider>        
        <Icon>
          <IconInner>
            {customizeSettings?.image && (
               <WPImage
                   image={customizeSettings?.image}
                   layout='fill'
                   objectFit='contain'
                   fadeIn={false}
               />
             )}
          </IconInner>
        </Icon>
      </Divider>
      
      <Container>
        <Row
            gutter={{ dk: 0 }}
            alignItems={{ dk: 'flex-start' }}
            flexDirection={{ dk: 'row-reverse' }}
        >
          <MediaCol dk={12} $isIframeEmbed={rowB.mediaType === 'iframeEmbed'}>
            <Media $isIframeEmbed={rowB.mediaType === 'iframeEmbed'}>
              {rowB.mediaType === 'imageVideo' && (
                <>
                  <WPImage
                    image={rowB.image}
                    layout={'responsive'}
                  />
                  {rowB.video && (
                    <WPVideo
                      video={rowB.video}
                      layout='fill'
                      objectFit='cover'
                    />
                  )}
                </>
              )}              
              {rowB.mediaType === 'iframeEmbed' && (
                <IframeEmbed
                  dangerouslySetInnerHTML={{ __html: rowB.iframeEmbed }}
                />
              )}
            </Media>
          </MediaCol>
          <TextCol dk={12}>
            <TextB $textAlignmentMobile={rowB.textAlignmentMobile}>
              {rowB.eyebrowEnabled && rowB.eyebrow && (
                <Eyebrow as={rowB.eyebrowTag}>{rowB.eyebrow}</Eyebrow>
               )}
              {rowB.headline && (
                 <S_Headline
                     text={rowB.headline}
                     align={mounted && isDesktop ? 'left' : (rowB.textAlignmentMobile || 'center')}
                     forwardedAs={rowB.headlineTag}
                 />
               )}
      
              <Rte dangerouslySetInnerHTML={{ __html: rowB.body }} />
            </TextB>
          </TextCol>
        </Row>        
      </Container>                
    </S_MediaText2x>
  )
}

const S_MediaText2x = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  position: relative;
  padding: 60px 0;
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
      p.theme.mixins.acfColor('modules.mediaText2xA.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xA.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xA.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };      
    }
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xB.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };      
    }
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xC.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };      
    }
  }

  ${p => p.theme.media.minWidth('tablet')} {
    padding: 75px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 100px 0;
    text-align: left;
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
      p.theme.mixins.acfColor('modules.mediaText2xA.borderColor') ||
      p.theme.colors.black
    };
  }

  &.layout-b:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.borderColor') ||
      p.theme.colors.black
    };
  }

  &.layout-c:before {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.borderColor') ||
      p.theme.colors.black
    };
  }
`

const MediaCol = styled(Col)`
  ${p => p.theme.media.minWidth('desktop')} {
    align-self: ${p => p.$isIframeEmbed ? 'stretch' : 'auto'};
  }
`

const TextCol = styled(Col)`
  ${p => p.theme.media.minWidth('desktop')} {
    align-self: stretch;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
`

const Media = styled.div`
  position: relative;
  margin: 0 0 30px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 0 1px;
    flex: 1;
    height: ${p => p.$isIframeEmbed ? '100%' : 'auto'};
  }
`

const IframeEmbed = styled.div`
  position: relative;
  padding-top: 80%;

  ${p => p.theme.media.minWidth('desktop')} {
    height: 100%;
    padding-top: 0;
  }  

  iframe {
    ${p => p.theme.mixins.fill('absolute')};    
  }
`

const TextA = styled.div`
  text-align: ${p => p.$textAlignmentMobile || 'center'};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 40px 0;
    padding: 0 0 0 60px;
    text-align: left;
  }
`

const TextB = styled.div`
  text-align: ${p => p.$textAlignmentMobile || 'center'};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 40px 0 0 0;
    padding: 0 60px 0 0;
    text-align: left;
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
      p.theme.mixins.acfColor('modules.mediaText2xA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xA.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xB.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xC.headlineColorBold') ||
        'currentColor'
      };
    }
  }    
`

const Divider = styled.div`
  position: relative;
  margin: 100px 0;
  z-index: ${p => p.theme.zindex[1]};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0;
  }

  &:before {
    display: block;
    content: '';
    width: 100%;
    height: 1px;

    ${S_MediaText2x}.layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xA.borderColor') ||
        p.theme.colors.black
      };
    }

    ${S_MediaText2x}.layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xB.borderColor') ||
        p.theme.colors.black
      };
    }

    ${S_MediaText2x}.layout-c & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.mediaText2xC.borderColor') ||
        p.theme.colors.black
      };
    }
  }  
`

const Icon = styled.div`
  ${p => p.theme.mixins.center('absolute')};
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: solid 1px;
  box-shadow: 0 0 0 7px ${p => p.theme.colors.white};
  padding: 12px;

  ${S_MediaText2x}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xA.iconBackgroundColor') ||
      p.theme.colors.white
    };
    box-shadow: 0 0 0 7px ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xA.iconBackgroundColor') ||
      p.theme.colors.white
    };
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xA.iconBorderColor') ||
      p.theme.colors.black
    };
  }

  ${S_MediaText2x}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.iconBackgroundColor') ||
      p.theme.colors.white
    };
    box-shadow: 0 0 0 7px ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.iconBackgroundColor') ||
      p.theme.colors.white
    };
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xB.iconBorderColor') ||
      p.theme.colors.black
    };
  }

  ${S_MediaText2x}.layout-c & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.iconBackgroundColor') ||
      p.theme.colors.white
    };
    box-shadow: 0 0 0 7px ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.iconBackgroundColor') ||
      p.theme.colors.white
    };
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.mediaText2xC.iconBorderColor') ||
      p.theme.colors.black
    };
  }
`

const IconInner = styled.div`
  ${p => p.theme.mixins.fill('relative')};
`

export const GQL_MEDIA_TEXT_2X_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment MediaText2x${layout}Module on Page_Pagecontent_Modules_MediaText2x${layout} {   
    backgroundImageEnabled        
    fieldGroupName
    rowA {
      body
      eyebrowEnabled
      eyebrow
      eyebrowTag
      headline
      headlineTag    
      iframeEmbed
      image {
        ...WPImage
      }
      mediaType 
      textAlignmentMobile
      video {
        link
        mediaItemUrl
      }        
    }    
    rowB {
      body
      eyebrowEnabled
      eyebrow
      eyebrowTag
      headline
      headlineTag    
      iframeEmbed
      image {
        ...WPImage
      }
      mediaType 
      textAlignmentMobile
      video {
        link
        mediaItemUrl
      }        
    }    
    visibleOnDesktop
    visibleOnMobile
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_MEDIA_TEXT_2X_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeMediaText2x${layout}Module on Customize_Modules {
    mediaText2x${layout} {
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
      headlineColor
      headlineColorBold
      iconBackgroundColor
      iconBorderColor
      image {
        ...WPImage
      }
    }
  }
`

export default MediaText2x
