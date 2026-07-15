import { useContext, useState, useEffect, useRef } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import Headline from 'components/Headline'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Container, Row, Col } from 'components/Grid'
import { Rte, H3 } from 'components/Typography'
import { TextArrow } from 'components/Button'
import AppContext from 'contexts/App'
import { useMinWidth } from 'hooks/useMedia'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'

const Timeline = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,
  itemMinHeightDesktop,
  fieldGroupName, 
  customizeLayout,
  items, 
  visibleOnDesktop,
  visibleOnMobile
}) => {  
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const { mounted, customize } = useContext(AppContext)
  const [lineHeight, setLineHeight] = useState(50)
  const isDesktop = useMinWidth('desktop')
  const contentRef = useRef()    

  const customizeSettings = customize?.modules[`timeline${layout}`]

  const setLineStyle = () => {
    const { top, height } = contentRef.current?.getBoundingClientRect()
    let lineHeight = window.innerHeight / 2 - top

    if ( lineHeight < 0 ) {
      lineHeight = 0
    }

    if ( lineHeight > height ) {
      lineHeight = height
    }

    setLineHeight(lineHeight)
  }
  
  const onWindowScroll = () => {
    setLineStyle()
  }

  const onWindowResize = () => {
    setLineStyle()    
  }

  useEffect(() => {
    setLineStyle()
    
    window.addEventListener('scroll', onWindowScroll)
    window.addEventListener('resize', onWindowResize)

    return () => {
      window.removeEventListener('scroll', onWindowScroll)
      window.removeEventListener('resize', onWindowResize)
    }
  }, [])
  
  return (
    <S_Timeline 
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
        <Header>
          {eyebrowEnabled && eyebrow && (
            <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
          )}
          {headline && (
            <S_Headline 
              text={headline} 
              forwardAs={headlineTag}
              margin={!!body} 
            />
           )}
          {body && (
             <Body dangerouslySetInnerHTML={{ __html: body }} />
           )}
        </Header>

        <Content ref={contentRef}>
          {mounted && isDesktop && (
             <Line style={{ height: lineHeight }} />
           )}
      
          <Items>
            {items.map((item, k) => (
               <Item key={k}>
                 <Row flexDirection={{ dk: k % 2 === 0 ? 'row' : 'row-reverse'}}>
                   <Col dk={12}>
                     <ItemImage $minHeight={itemMinHeightDesktop}>
                       <WPImage
                           image={item.image}
                           layout={mounted && isDesktop ? 'fill' : undefined}
                           objectFit='cover'
                       />
          
                       <ItemNumber>
                         <ItemNumberIcon>
                           <span>{k+1}</span>
                         </ItemNumberIcon>
                       </ItemNumber>
                     </ItemImage>
                   </Col>
                   <Col dk={12}>
                     <ItemCard>
                       <ItemTitle>{item.title}</ItemTitle>
                       <ItemBody
                           dangerouslySetInnerHTML={{ 
                            __html: item.body 
                          }}
                       />
                       {item.ctaLink?.url && (
                          <Link
                              href={item.ctaLink.url}
                              passHref
                          >
                            <ItemCtaLink
                                target={item.ctaLink.target || undefined}
                                link
                            >
                              {item.ctaLink.title}
                            </ItemCtaLink>
                          </Link>
                        )}
                     </ItemCard>
                   </Col>                 
                 </Row>
               </Item>
             ))}
          </Items>
        </Content>
      </Container>      
    </S_Timeline>
  )
}

const S_Timeline = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  padding: 70px 0;
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
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.backgroundColor') ||
      p.theme.colors.white
    };               
  }

  &.layout-b {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.backgroundColor') ||
      p.theme.colors.white
    };              
  }

  &.layout-c {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.backgroundColor') ||
      p.theme.colors.white
    };                
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 110px 0;
  }
`

const Header = styled.div`
  margin: 0 0 40px 0;
  text-align: center;

  ${S_Timeline}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.timelineA.headlineColorBold') ||
        'currentColor'
      };  
    }
  }

  ${S_Timeline}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.timelineB.headlineColorBold') ||
        'currentColor'
      };  
    }
  }

  ${S_Timeline}.layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.timelineC.headlineColorBold') ||
        'currentColor'
      };  
    }
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 55px 0;
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

const S_Headline = styled(Headline)``

const Body = styled(Rte)`
  margin: 30px auto 0 auto;
  max-width: 960px;

  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.bodyColor') ||
      p.theme.colors.black
    }
  }
  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.bodyColor') ||
      p.theme.colors.black
    }
  }
  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.bodyColor') ||
      p.theme.colors.black
    }
  }
`

const Content = styled.div`
  position: relative;
`

const Items = styled.div``

const Item = styled.div`
  position: relative;
  margin: 0 auto 30px auto;
  max-width: 700px;
  
  &:first-child:before,
  &:last-child:before {
    display: none;
    content: '';
    ${p => p.theme.mixins.hCenter('absolute')};
    height: 50%;
    width: ${p => p.theme.grid.columnGutter.dk}px;

    ${S_Timeline}.layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineA.backgroundColor') ||
        p.theme.colors.white
      };    
    }
    
    ${S_Timeline}.layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineB.backgroundColor') ||
        p.theme.colors.white
      };    
    }
    
    ${S_Timeline}.layout-c & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineC.backgroundColor') ||
        p.theme.colors.white
      };    
    }
  }

  &:first-child:before {
    top: 0;
  }

  &:last-child:before {
    bottom: 0;
  }

  &:last-child {
    margin: 0 auto;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 70px 0;
    max-width: none;

    &:before {
      display: block !important;
    }

    &:last-child {
      margin: 0;
    }    
  }
`

const ItemImage = styled.div`
  position: relative;
  margin: 0 0 12px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0;
    height: 100%;
    min-height: ${p => p.$minHeight || 0}px;
  }
`

const ItemCard = styled.div`
  padding: 60px 20px 50px 20px;
  text-align: center;

  ${S_Timeline}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.cardsBackgroundColor') ||
      p.theme.colors.ltgray
    };
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.cardsColor') ||
      p.theme.colors.black
    };
  }

  ${S_Timeline}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.cardsBackgroundColor') ||
      p.theme.colors.ltgray
    };
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.cardsColor') ||
      p.theme.colors.black
    };
  }

  ${S_Timeline}.layout-c & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.cardsBackgroundColor') ||
      p.theme.colors.ltgray
    };
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.cardsColor') ||
      p.theme.colors.black
    };
  }

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: left;
    height: 100%;
    padding: 75px;
  }
`

const ItemTitle = styled(H3)`
  margin: 0 0 .5em 0;
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.bold')};

  ${S_Timeline}.layout-a & {  
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.cardsTitleColor') ||
      p.theme.colors.black
    };
  }

  ${S_Timeline}.layout-b & {  
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.cardsTitleColor') ||
      p.theme.colors.black
    };
  }

  ${S_Timeline}.layout-c & {  
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.cardsTitleColor') ||
      p.theme.colors.black
    };
  }
   
  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.bold')};
  }
`

const ItemBody = styled(Rte)``

const ItemCtaLink = styled(TextArrow)`
  margin: 30px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 20px 0 0 0;
  }
`

const ItemNumber = styled.div`
  position: absolute;
  left: 50%;
  transform: translateX(-50%) translateY(50%) translateY(6px);
  bottom: 0;
  width: 85px;
  height: 85px;
  border-radius: 50%;
  z-index: ${p => p.theme.zindex[1]};
  ${p => p.theme.mixins.acfTypography('modules.timelineA.timelineMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('modules.timelineA.timelineDesktop.regular')};    
  }

  ${S_Timeline}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  ${S_Timeline}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  ${S_Timeline}.layout-c & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  ${p => p.theme.media.minWidth('desktop')} {
    top: 50%;
    left: auto;
    right: 0;
    width: 115px;
    height: 115px;
    transform: translateX(50%) translateX(${p => p.theme.grid.columnGutter.dk / 2}px) translateY(-50%);

    ${Item}:nth-child(even) & {
      left: 0;
      right: auto;
      transform: translateX(-50%) translateX(-${p => p.theme.grid.columnGutter.dk / 2}px) translateY(-50%);
    }
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    transform: translateX(50%) translateX(${p => p.theme.grid.columnGutter.xl / 2}px) translateY(-50%);

    ${Item}:nth-child(even) & {
      transform: translateX(-50%) translateX(-${p => p.theme.grid.columnGutter.xl / 2}px) translateY(-50%);
    }
  }
`

const ItemNumberIcon = styled.div`
  ${p => p.theme.mixins.center('absolute')};

  ${S_Timeline}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.timelineTextColor') ||
      p.theme.colors.white
    };    
  }

  ${S_Timeline}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.timelineTextColor') ||
      p.theme.colors.white
    };    
  }

  ${S_Timeline}.layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.timelineTextColor') ||
      p.theme.colors.white
    };    
  }  

  &:before {
    ${p => p.theme.mixins.center('absolute')};
    display: block;
    content: '';
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: solid 1px;

    ${S_Timeline}.layout-a & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineA.timelineAccentColor') ||
        p.theme.colors.black
      };    
    }

    ${S_Timeline}.layout-b & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineB.timelineAccentColor') ||
        p.theme.colors.black
      };    
    }

    ${S_Timeline}.layout-c & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineC.timelineAccentColor') ||
        p.theme.colors.black
      };    
    }

    ${p => p.theme.media.minWidth('tablet')} {
      width: 75px;
      height: 75px;
    }
  }

  &:after {
    ${p => p.theme.mixins.center('absolute')};
    display: block;
    content: '';
    width: 36px;
    height: 36px;
    border-radius: 50%;

    ${S_Timeline}.layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineA.timelineAccentColor') ||
        p.theme.colors.black
      };    
    }

    ${S_Timeline}.layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineB.timelineAccentColor') ||
        p.theme.colors.black
      };    
    }

    ${S_Timeline}.layout-c & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.timelineC.timelineAccentColor') ||
        p.theme.colors.black
      };    
    }

    ${p => p.theme.media.minWidth('tablet')} {
      width: 50px;
      height: 50px;
    }
  }

  span {
    position relative;
    z-index: ${p => p.theme.zindex[2]};
  }
`

const Line = styled.div`
  position: absolute;
  left: 50%;
  top: 0;
  width: 2px;
  transition: height 500ms ease;

  ${S_Timeline}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineA.timelineProgressColor') ||
      p.theme.colors.black
    };
  }

  ${S_Timeline}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineB.timelineProgressColor') ||
      p.theme.colors.black
    };
  }

  ${S_Timeline}.layout-c & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.timelineC.timelineProgressColor') ||
      p.theme.colors.black
    };
  }
`

export const GQL_TIMELINE_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment Timeline${layout}Module on Page_Pagecontent_Modules_Timeline${layout} {   
    backgroundImageEnabled
    body
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag
    fieldGroupName
    items {
      body
      title
      ctaLink {
        target
        title
        url
      }      
      image {
        ...WPImage
      }      
    }
    itemMinHeightDesktop
    visibleOnDesktop
    visibleOnMobile
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_TIMELINE_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeTimeline${layout}Module on Customize_Modules {
    timeline${layout} {      
      backgroundColor
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
      bodyColor      
      cardsBackgroundColor
      cardsColor
      cardsTitleColor
      headlineColor
      headlineColorBold
      timelineAccentColor    
      timelineDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }  
      timelineMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }  
      timelineProgressColor
      timelineTextColor      
    }
  }
`

export default Timeline
