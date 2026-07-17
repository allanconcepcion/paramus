import { useState, useRef, useEffect, useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import Shuffle from 'shufflejs'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import { Container } from 'components/Grid'
import Headline from 'components/Headline'
import Box from 'components/Box'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import SplitSlides from 'components/SplitSlides'
import { Rte } from 'components/Typography'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import AppContext from 'contexts/App'
import {
  Cta as CtaButton
} from 'components/Button'
import { toLocalUrl } from 'utils/dom'

const Gallery = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,  
  fieldGroupName,
  ctaEnabled,  
  slideTagLabel,
  imageAspectRatio,
  ctaSize,
  customizeLayout, 
  items, 
  navigation,
  ctaLink, 
  visibleOnDesktop,
  visibleOnMobile
}) => {  

  const { customize } = useContext(AppContext)
  const itemsRef = useRef()
  const shuffleRef = useRef()
  const [activeTag, setActiveTag] = useState('all')
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const customizeSettings = customize?.modules[`gallery${layout}`]    
  
  useEffect(() => {    
    shuffleRef.current = new Shuffle(itemsRef.current, {
      itemSelector: '.js-item', 
      isCentered: true
    })

    return () => {
      shuffleRef.current.destroy()
    }
  }, [items])

  useEffect(() => {    
    shuffleRef.current.filter(activeTag)
  }, [activeTag])
  
  const onNavigationItemClick = ( tag ) => {
    setActiveTag(tag)    
  }  
  
  return (
    <S_Gallery 
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
                 underline={!!body}
                 forwardedAs={headlineTag}
             />
           )}

          {body && (
             <Body
                 dangerouslySetInnerHTML={{ __html: body }}
             />
           )}

        {navigation && navigation.length > 0 && (
           <Nav>
             <ul>
               <li>
                 <button
                     className={activeTag === 'all' ? 'is-active' : null}
                     onClick={() => onNavigationItemClick('all')}
                 >
                   All
                 </button>
               </li>
               {navigation.map((item, k) => (
                  <li
                      key={k}
                  >
                    <button
                        className={activeTag === item.tag ? 'is-active' : null}
                        onClick={() => onNavigationItemClick(item.tag)}
                    >
                      {item.title}
                    </button>
                  </li>
                ))}
             </ul>
           </Nav>
         )}
        </Header>

        <Items ref={itemsRef}>
          {items.map((item, k) => (
             <Item
                 className='js-item'
                 data-groups={`${JSON.stringify(item.tag ? item.tag.trim().split(',') : [])}`}
                 key={k}
             >                            
               {item.type === 'image' && (
                  <Box 
                    width={imageAspectRatio === 'native' ? item.image.mediaDetails.width : 3} 
                    height={imageAspectRatio === 'native' ? item.image.mediaDetails.height : 2} 
                  >                    
                    <WPImage
                        image={item.image}
                        layout='fill'
                        objectFit='contain'
                    />
                  </Box>
                )}                
               {item.type === 'beforeAfter' && (
                  <SplitSlides
                      imageA={item.imageBefore}
                      imageB={item.imageAfter}
                      boxWidth={3}
                      boxHeight={2}
                      label={slideTagLabel === 'on' ? navigation?.find(i => i.tag === item.tag)?.title : undefined}
                  />
                )}               
             </Item>
           ))}
        </Items>

        {ctaEnabled && ctaLink && (
           <Link href={toLocalUrl(ctaLink.url)} passHref>
             <S_CtaButton              
               link
               target={ctaLink.target}
               iconColor={`modules.gallery${layout}.ctaIconColor`}
               iconBackground={`modules.gallery${layout}.ctaIconBackground`}
               iconBorder={`modules.gallery${layout}.ctaIconBorder`}
               iconColorHover={`modules.gallery${layout}.ctaIconColorHover`}
               iconBackgroundHover={`modules.gallery${layout}.ctaIconBackgroundHover`}
               iconBorderHover={`modules.gallery${layout}.ctaIconBorderHover`}
               size={ctaSize}
             >
               {ctaLink.title}
             </S_CtaButton>
           </Link>
         )}
      </Container>
    </S_Gallery>
  )
}

const S_Gallery = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  padding: 50px 0;
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
    background-position: ${p => p.$backgroundPositionDesktop || 'center'};
    background-image: ${p =>
      p.$backgroundImageEnabled && p.$backgroundImageDesktop ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }      

  &.layout-a {
    color: ${p =>
      p.theme.mixins.acfColor('modules.galleryA.textColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.galleryA.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.galleryB.textColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.galleryB.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.galleryC.textColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.galleryC.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  ${p => p.theme.media.minWidth('tablet')} {
    padding: 75px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    padding: 100px 0;
  }

  ${p => p.theme.media.minWidth('large')} {
    padding: 120px 0;
  }
`

const Header = styled.header`
  margin: 0 0 50px 0;
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const S_Headline = styled(Headline)`
  .layout-a & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.galleryA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.galleryA.headlineColorBold') ||
        'current'
      };
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.galleryB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.galleryB.headlineColorBold') ||
        'current'
      };
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.galleryC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.galleryC.headlineColorBold') ||
        'current'
      };
    }
  }  
`

const Body = styled(Rte)`
  margin: 0 auto;
  max-width: 960px;
  text-align: center;
`

const Nav = styled.nav`
  .layout-a & {
    border-top: solid 1px ${p => p.theme.mixins.acfColor('modules.galleryA.navigationBorderColor')};
    border-bottom: solid 1px ${p => p.theme.mixins.acfColor('modules.galleryA.navigationBorderColor')};
  }

  .layout-b & {
    border-top: solid 1px ${p => p.theme.mixins.acfColor('modules.galleryB.navigationBorderColor')};
    border-bottom: solid 1px ${p => p.theme.mixins.acfColor('modules.galleryB.navigationBorderColor')};
  }

  .layout-c & {
    border-top: solid 1px ${p => p.theme.mixins.acfColor('modules.galleryC.navigationBorderColor')};
    border-bottom: solid 1px ${p => p.theme.mixins.acfColor('modules.galleryC.navigationBorderColor')};
  }

  margin: 50px 0 0 0;
  padding: 24px 0;

  ul {
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    list-style: none;
    ${p => p.theme.media.minWidth('tablet')} {
      flex-direction: row;
      justify-content: center;
    }
  }

  li {
    margin: 0 0 10px 0;

    &:last-child {
      margin-bottom: 0;
    }

    ${p => p.theme.media.minWidth('tablet')} {
      margin: 0 15px;
    }

    ${p => p.theme.media.minWidth('desktop')} {
      margin: 0 20px;
    }

    ${p => p.theme.media.minWidth('large')} {
      margin: 0 30px;
    }

    ${p => p.theme.media.minWidth('xlarge')} {
      margin: 0 40px;
    }
  }

  li button {
    transition: opacity 300ms ease;
    
    @media(hover:hover) {
      &:hover {
        opacity: .7;
      }      
    }

    .layout-a & {
      ${p => p.theme.mixins.acfTypography('modules.galleryA.navigationStyleMobile.regular')};

      &.is-active {
        ${p => p.theme.mixins.acfTypography('modules.galleryA.navigationStyleMobile.bold')};
      }

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.galleryA.navigationStyleDesktop.regular')};
      
        &.is-active {
          ${p => p.theme.mixins.acfTypography('modules.galleryA.navigationStyleDesktop.bold')};
        }
      }
    }

    .layout-b & {
      ${p => p.theme.mixins.acfTypography('modules.galleryB.navigationStyleMobile.regular')};

      &.is-active {
        ${p => p.theme.mixins.acfTypography('modules.galleryB.navigationStyleMobile.bold')};
      }

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.galleryB.navigationStyleDesktop.regular')};
      
        &.is-active {
          ${p => p.theme.mixins.acfTypography('modules.galleryB.navigationStyleDesktop.bold')};
        }
      }
    }

    .layout-c & {
      ${p => p.theme.mixins.acfTypography('modules.galleryC.navigationStyleMobile.regular')};

      &.is-active {
        ${p => p.theme.mixins.acfTypography('modules.galleryC.navigationStyleMobile.bold')};
      }

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.galleryC.navigationStyleDesktop.regular')};
      
        &.is-active {
          ${p => p.theme.mixins.acfTypography('modules.galleryC.navigationStyleDesktop.bold')};
        }
      }
    }        
  }
`

const Items = styled.div`
  margin: 0 -${p => p.theme.grid.columnGutter.mb}px;  
`

const Item = styled.div`
  width: 100%;
  margin: 0 0 40px 0;
  padding: 0 ${p => p.theme.grid.columnGutter.mb}px;  

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0 0 50px 0;
    width: 50%;
  }

  ${p => p.theme.media.minWidth('large')} {
    width: 33.33%;
  }

  .o-label {
    .layout-a & {
      color: ${p => p.theme.mixins.acfColor('modules.galleryA.labelColor')} !important;
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryA.labelBackgroundColor')} !important;
      
      ${p => p.theme.mixins.acfTypography('modules.galleryA.itemsStyleMobile.label')};
      
      ${p => p.theme.media.minWidth('tablet')} {
        ${p => p.theme.mixins.acfTypography('modules.galleryA.itemsStyleDesktop.label')};
      }    
    }

    .layout-b & {
      color: ${p => p.theme.mixins.acfColor('modules.galleryB.labelColor')} !important;
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryB.labelBackgroundColor')} !important;
      
      ${p => p.theme.mixins.acfTypography('modules.galleryB.itemsStyleMobile.label')};
      
      ${p => p.theme.media.minWidth('tablet')} {
        ${p => p.theme.mixins.acfTypography('modules.galleryB.itemsStyleDesktop.label')};
      }    
    }

    .layout-c & {
      color: ${p => p.theme.mixins.acfColor('modules.galleryC.labelColor')} !important;
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryC.labelBackgroundColor')} !important;
      
      ${p => p.theme.mixins.acfTypography('modules.galleryC.itemsStyleMobile.label')};
      
      ${p => p.theme.media.minWidth('tablet')} {
        ${p => p.theme.mixins.acfTypography('modules.galleryC.itemsStyleDesktop.label')};
      }    
    }    
  }

  .o-tool:after {
    .layoua-a & {
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryA.toolBorderColor')};      
    }
    .layoua-b & {
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryB.toolBorderColor')};      
    }
    .layoua-c & {
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryC.toolBorderColor')};      
    }    
  }

  .o-tool-button {
    .layout-a & {
      color: ${p => p.theme.mixins.acfColor('modules.galleryA.toolIconColor')} !important;
      border-color: ${p => p.theme.mixins.acfColor('modules.galleryA.toolBorderColor')} !important;
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryA.toolOuterBackgroundColor')} !important;
    }

    .layout-b & {
      color: ${p => p.theme.mixins.acfColor('modules.galleryB.toolIconColor')} !important;
      border-color: ${p => p.theme.mixins.acfColor('modules.galleryB.toolBorderColor')} !important;
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryA.toolOuterBackgroundColor')} !important;
    }

    .layout-c & {
      color: ${p => p.theme.mixins.acfColor('modules.galleryC.toolIconColor')} !important;
      border-color: ${p => p.theme.mixins.acfColor('modules.galleryC.toolBorderColor')} !important;
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryC.toolOuterBackgroundColor')} !important;
    }
  }

  .o-tool-button-inner {
    .layout-a & {
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryA.toolInnerBackgroundColor')} !important;
    }

    .layout-b & {
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryB.toolInnerBackgroundColor')} !important;
    }

    .layout-c & {
      background-color: ${p => p.theme.mixins.acfColor('modules.galleryC.toolInnerBackgroundColor')} !important;
    }    
  }
`

const S_CtaButton = styled(CtaButton)`
  margin: 20px 0 0 0;
`

export const GQL_GALLERY_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment Gallery${layout}Module on Page_Pagecontent_Modules_Gallery${layout} {   
    body
    backgroundImageEnabled
    fieldGroupName
    eyebrow
    eyebrowEnabled
    eyebrowTag
    headline
    headlineTag
    ctaEnabled   
    slideTagLabel
    imageAspectRatio
    ctaSize
    ctaLink {
      target
      title
      url
    }
    items {
      imageBefore {
        ...WPImage
      }
      imageAfter {
        ...WPImage
      }
      image {
        ...WPImage
      }            
      tag
      type
    }
    navigation {
      title
      tag
    }
    visibleOnDesktop
    visibleOnMobile
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_GALLERY_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeGallery${layout}Module on Customize_Modules {
    gallery${layout} {
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
      ctaIconBackground
      ctaIconBackgroundHover
      ctaIconBorder
      ctaIconBorderHover
      ctaIconColor
      ctaIconColorHover
      headlineColor
      headlineColorBold
      labelBackgroundColor
      labelColor
      navigationBorderColor
      textColor
      toolBorderColor
      toolIconColor
      toolInnerBackgroundColor
      toolOuterBackgroundColor
      itemsStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('label')}
      }
      itemsStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('label')}
      }
      navigationStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('bold')}
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      navigationStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('bold')}
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
    }
  }
`

export default Gallery
