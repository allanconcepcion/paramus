import { useState, useContext, useRef, useEffect} from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import { stripHtml } from 'string-strip-html'
import { SlideDown } from 'react-slidedown'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import Headline from 'components/Headline'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import WPVideo from 'components/WPVideo'
import Box from 'components/Box'
import { Icon } from 'components/SVGIcons'
import { Rte } from 'components/Typography'
import { useMinWidth } from 'hooks/useMedia'
import AppContext from 'contexts/App'

import {
  Text as TextButton,
  TextArrow as TextArrowButton
} from 'components/Button'

const HorizontalAccordion = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,    
  backgroundOverlayOpacityDesktop,  
  backgroundImage,
  backgroundVideo,
  items,
  fieldGroupName, 
  customizeLayout, 
  visibleOnDesktop,
  visibleOnMobile
}) => {  
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const { mounted, customize } = useContext(AppContext)
  const [activeIndex, setActiveIndex] = useState(false)
  const isDesktop = useMinWidth('desktop')
  const desktopCtaTitleRefs = useRef([])

  const customizeSettings = customize?.modules[`horizontalAccordion${layout}`]

  const onAccordionClick = ( index ) => {
    if ( index !== activeIndex ) {
      setActiveIndex(index)
    } else if ( !isDesktop ) {
      setActiveIndex(false)
    }
  }

  const onAccordionCloseClick = () => {
    setActiveIndex(false)
  }

  const setDesktopCtaTitleHeights = () => {  
    desktopCtaTitleRefs.current.forEach(h3 => {
      if ( !h3 ) return
      h3.style.height = `auto`      
    })        

    let height = 0
    desktopCtaTitleRefs.current.forEach(h3 => {
      if ( !h3 ) return
      if ( h3.clientHeight > height ) {
        height = h3.clientHeight
      }
    })  

    desktopCtaTitleRefs.current.forEach(h3 => {
      if ( !h3 ) return
      h3.style.height = `${height}px`      
    })        
  }

  const onWindowResize = () => {
    setDesktopCtaTitleHeights()
  }

  useEffect(() => {
    setTimeout(() => {
      setDesktopCtaTitleHeights()    
    }, 10)
        
    window.addEventListener('resize', onWindowResize)

    return () => {
      window.removeEventListener('resize', onWindowResize)  
    }
  }, [])

  const renderMobile = () => {
    return (
      <MobileAccordion>
        {items.map((item, k) => (
           <MobileAccordionItem
               key={k}
               className={k === activeIndex ? 'is-active' : ''}
           >
             <MobileAccordionItemHeader
                 onClick={() => onAccordionClick(k)}
             >
               <MobileAccordionTitle
                   dangerouslySetInnerHTML={{
                     __html: stripHtml(item.title || '', { onlyStripTags: 'p' }).result
                   }}
               />
               <MobileAccordionItemCtaButton aria-label="Expand">
                 <Icon icon='arrow-up' />
               </MobileAccordionItemCtaButton>
             </MobileAccordionItemHeader>
             <SlideDown>
               {k === activeIndex && (
                  <MobileAccordionItemContent>
                    <MobileAccordionItemMedia>
                      <WPImage image={item.image} />
                      {item.video && (
                         <WPVideo
                             video={item.video}
                             layout='fill'
                             objectFit='cover'
                         /> 
                       )}              
                    </MobileAccordionItemMedia>
                    <MobileAccordionItemText>
                      <Rte
                        dangerouslySetInnerHTML={{
                          __html: item.body
                        }}
                      />
                      {item.link?.url && (
                         <Link href={item.link.url} passHref>
                           <ReadMoreArrow
                               target={item.link.target || undefined}
                               link 
                           >
                             {item.link.title}
                           </ReadMoreArrow>
                         </Link>
                       )}
                    </MobileAccordionItemText>
                  </MobileAccordionItemContent>
                )}
             </SlideDown>
           </MobileAccordionItem>
         ))}
      </MobileAccordion>
    )
  }

  const renderDesktop = () => {    
    return (
      <>
      <DesktopBackground>
        <Box width={2} height={1}>
          <DesktopBackgroundBase
              className={activeIndex === false ? 'is-active' : ''}
              $overlayOpacity={backgroundOverlayOpacityDesktop}
          >
            <WPImage image={backgroundImage} layout='fill' objectFit='cover' />          
            {backgroundVideo && (
               <WPVideo
                   video={backgroundVideo}
                   layout='fill'
                   objectFit='cover'
               />
             )}
          </DesktopBackgroundBase>

          {items.map((item, k) => (
             <DesktopBackgroundItem
                 key={k}
                 className={k === activeIndex ? 'is-active' : ''}
                 $overlayOpacity={item.backgroundOverlayOpacityDesktop}
             >
               <WPImage image={item.image} layout='fill' objectFit='cover' />

               {item.video && (
                  <WPVideo
                      video={item.video}
                      layout='fill'
                      objectFit='cover'
                  /> 
                )}              
             </DesktopBackgroundItem>
           ))}
        </Box>
      </DesktopBackground>
      <DesktopAccordion>
        {items.map((item, k) => (
           <DesktopAccordionItem
               key={k}                
               className={activeIndex === false ? '' : (k === activeIndex ? 'is-active' : 'is-inactive')}
               $count={items.length}
               onClick={() => onAccordionClick(k)}
           >
             <DesktopAccordionItemCloseButton
                 onClick={onAccordionCloseClick}
                 aria-label="Close"
             >
               <Icon icon='close' />
             </DesktopAccordionItemCloseButton>

             <DesktopAccordionItemContent>
               <DesktopAccordionItemContentInner>
                 <DesktopAccordionTitle
                     dangerouslySetInnerHTML={{
                       __html: stripHtml(item.title || '', { onlyStripTags: 'p' }).result
                     }}
                 />
                 <Rte
                     dangerouslySetInnerHTML={{
                       __html: item.body
                     }}
                 />                   
                 {item.link?.url && (
                    <Link href={item.link.url} passHref>
                      <ReadMoreArrow
                          target={item.link.target || undefined}
                          link
                      >
                        {item.link.title}
                      </ReadMoreArrow>
                    </Link>
                  )}
               </DesktopAccordionItemContentInner>                 
             </DesktopAccordionItemContent>
             
             <DesktopAccordionItemCta>
               <DesktopAccordionItemCtaButton aria-label="Expand">
                 <Icon icon='arrow-up' />
               </DesktopAccordionItemCtaButton>

               <DesktopAccordionTitle
                ref={ref => desktopCtaTitleRefs.current[k] = ref}
                dangerouslySetInnerHTML={{
                  __html: stripHtml(item.title || '', { onlyStripTags: 'p' }).result
                }}
               />

               <DesktopReadMore>Read More</DesktopReadMore>
             </DesktopAccordionItemCta>
             
             <DesktopAccordionItemInactiveTitle>
               <DesktopAccordionTitle
                   dangerouslySetInnerHTML={{
                     __html: stripHtml(item.title || '', { onlyStripTags: 'p' }).result
                   }}
               />                 
             </DesktopAccordionItemInactiveTitle>
           </DesktopAccordionItem>
         ))}
      </DesktopAccordion>
      </>
    )
  }
  
  return (
    <S_HorizontalAccordion 
      className={`layout-${lowerCase(layout)}`}
      $backgroundImageEnabled={backgroundImageEnabled}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
    >
      {headline && (
        <Header
          $backgroundImageEnabled={backgroundImageEnabled}
          $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
          $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
          $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
          $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
        >
          {eyebrowEnabled && eyebrow && (
            <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
          )}
          <Headline
            text={headline}
            as={headlineTag}
            margin={!!body}               
          />
          {body && (
            <Body dangerouslySetInnerHTML={{ __html: body }} />
          )}
        </Header>
      )}
      <Content>
        {mounted && !isDesktop && renderMobile()}        
        {mounted && isDesktop && renderDesktop()}
      </Content>  
    </S_HorizontalAccordion>
  )
}

const S_HorizontalAccordion = styled.div`
  margin: 0;  
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};  
  }
`

const Header = styled.div`
  text-align: center;
  padding: 40px 30px 50px 30px;
  border-bottom: solid 1px;
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

  ${S_HorizontalAccordion}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.headerColor') ||
      p.theme.colors.white
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.headerColorBold') ||
        'currentColor'
      };
    }
    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.headerBackgroundColor') ||
      p.theme.colors.black
    };

    border-bottom-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.headerBorderColor') ||
      p.theme.colors.white
    };      
  }

  ${S_HorizontalAccordion}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.headerColor') ||
      p.theme.colors.white
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionB.headerColorBold') ||
        'currentColor'
      };
    }

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.headerBackgroundColor') ||
      p.theme.colors.black
    };

    border-bottom-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.headerBorderColor') ||
      p.theme.colors.white
    };        
  }
`

const Body = styled(Rte)`
  max-width: 960px;
  margin: 0 auto;

  ${S_HorizontalAccordion}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.headerBodyColor') ||
      p.theme.colors.black
    };   
  }

  ${S_HorizontalAccordion}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.headerBodyColor') ||
      p.theme.colors.black
    };
  }
`

const Content = styled.div`
  position: relative;
`

const AccordionTitle = styled.h3`
  margin: 0;
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.regular')};
  }

  strong {
    ${p => p.theme.mixins.acfTypography('global.h3Mobile.bold')};

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h3Desktop.bold')};
    }    
  }  
`

const AccordionItemCtaButton = styled.button`
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  flex: 0 0 50px;
  border-radius: 50%;
  border: solid 2px;
  transition:
    background-color 300ms ease,
    border-color 300ms ease
  ;

  .icon {
    width: 16px;
    height: 16px;
    transform-origin: 50% 50%;
    transition: fill 300ms ease, transform 300ms ease;
  }    
`

const ReadMoreArrow = styled(TextArrowButton)`  
  margin: 20px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 50px 0 0 0;
  }
`

const MobileAccordion = styled.div``

const MobileAccordionItem = styled.div`
  border-bottom: solid 1px;
  transition: border-color 300ms ease;

  ${S_HorizontalAccordion}.layout-a & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.closedBorderColor') ||
      p.theme.colors.white
    };    
  }

  ${S_HorizontalAccordion}.layout-a &.is-active {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openBorderColor') ||
      p.theme.colors.white
    };    
  }

  ${S_HorizontalAccordion}.layout-b & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.closedBorderColor') ||
      p.theme.colors.white
    };    
  }

  ${S_HorizontalAccordion}.layout-b &.is-active {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.openBorderColor') ||
      p.theme.colors.white
    };    
  }
`

const MobileAccordionItemHeader = styled.div`
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px ${p => p.theme.grid.containerPadding.mb}px;
  cursor: pointer;
  user-select: none;
  transition:
    color 300ms ease,
    background-color 300ms ease
  ;

  ${S_HorizontalAccordion}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.closedColor') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.closedBackgroundColor') ||
      p.theme.colors.black
    };    
  }

  ${S_HorizontalAccordion}.layout-a ${MobileAccordionItem}.is-active & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openColor') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openBackgroundColor') ||
      p.theme.colors.black
    };
  }

  ${S_HorizontalAccordion}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.closedColor') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.closedBackgroundColor') ||
      p.theme.colors.black
    };
  }

  ${S_HorizontalAccordion}.layout-b ${MobileAccordionItem}.is-active & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.openColor') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.openBackgroundColor') ||
      p.theme.colors.black
    };
  }
`

const MobileAccordionItemContent = styled.div`
  ${S_HorizontalAccordion}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openColor') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openBackgroundColor') ||
      p.theme.colors.black
    };
  }

  ${S_HorizontalAccordion}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.openColor') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleMobile.openBackgroundColor') ||
      p.theme.colors.black
    };
  }  
`

const MobileAccordionItemMedia = styled.div`
  position: relative;
  margin: 0 0 30px 0;
`

const MobileAccordionItemText = styled.div`
  padding: 0 ${p => p.theme.grid.containerPadding.mb}px 30px ${p => p.theme.grid.containerPadding.mb}px;
`

const MobileAccordionTitle = styled(AccordionTitle)``

const MobileAccordionItemCtaButton = styled(AccordionItemCtaButton)`
  ${S_HorizontalAccordion}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.closedIconBackgroundColor') ||
      'transparent'
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.closedIconBorderColor') ||
      p.theme.colors.white
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.closedIconColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_HorizontalAccordion}.layout-a ${MobileAccordionItem}.is-active & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openIconBackgroundColor') ||
      p.theme.colors.white
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openIconBorderColor') ||
      p.theme.colors.white
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleMobile.openIconColor') ||
        p.theme.colors.black
      };
    }
  }

  .icon {
    fill: currentColor;
    transform: rotate(180deg);
  }
  
  ${MobileAccordionItem}.is-active & {
    background-color: ${p => p.theme.colors.white};

    .icon {
      fill: ${p => p.theme.colors.black};
      transform: rotate(0deg);
    }
  }
`

const DesktopBackground = styled.div`
  position: relative;
  background-color: ${p => p.theme.colors.black};
`

const DesktopBackgroundBase = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  z-index: ${p => p.theme.zindex[1]};
  opacity: 0;
  visibility: hidden;
  z-index: ${p => p.theme.zindex[2]};
  transition:
    opacity 500ms ease,
    visibility 500ms ease
  ;

  &.is-active {
    opacity: 1;
    visibility: visible;
  }

  &:after {
    content: '';
    background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,${p => p.$overlayOpacity >= 0 ? (p.$overlayOpacity / 100) : .5}));
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const DesktopBackgroundItem = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  opacity: 0;
  visibility: hidden;
  z-index: ${p => p.theme.zindex[2]};
  transition:
    opacity 500ms ease,
    visibility 500ms ease
  ;

  &.is-active {
    opacity: 1;
    visibility: visible;
  }

  &:after {
    content: '';
    background: linear-gradient(to left, rgba(0,0,0,0), rgba(0,0,0,${p => p.$overlayOpacity >= 0 ? (p.$overlayOpacity / 100) : .5}));
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const DesktopAccordion = styled.div`
  display: flex;
  ${p => p.theme.mixins.fill('absolute')};
  z-index: ${p => p.theme.zindex[2]};  
`

const DesktopAccordionItem = styled.div`
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  flex: 1;
  border-right: solid 1px;
  user-select: none;
  overflow: hidden;
  cursor: pointer;
  transition:
    max-width 500ms ease,
    border-color 500ms ease
  ;
  max-width: ${p => (1 / p.$count) * 100}%;

  &.is-active {
   max-width: 100%;
   cursor: auto;
  }

  &.is-inactive {
   max-width: 70px;
  }

  &:last-child {
    border-right: none;
  }  

  ${S_HorizontalAccordion}.layout-a & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultBorderColor') ||
      p.theme.colors.white
    };

    &.is-inactive,
    &.is-active {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.closedBorderColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_HorizontalAccordion}.layout-b & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultBorderColor') ||
      p.theme.colors.white
    };

    &.is-inactive,
    &.is-active {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.closedBorderColor') ||
        p.theme.colors.white
      };
    }
  }    
`

const DesktopAccordionItemCta = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  padding: 0 0 40px 0;
  z-index: ${p => p.theme.zindex[1]};
  transition:
    opacity 300ms ease 500ms,
    visibility 300ms ease 500ms
  ;

  ${DesktopAccordionItem}.is-active &,
  ${DesktopAccordionItem}.is-inactive & {
    opacity: 0;
    visibility: hidden;
    transition:
      opacity 50ms ease,
      visibility 50ms ease
    ;
  }

  ${S_HorizontalAccordion}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultColor') ||
      p.theme.colors.white
    };
  }

  ${S_HorizontalAccordion}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultColor') ||
      p.theme.colors.white
    };
  }  
`

const DesktopAccordionItemContent = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  opacity: 0;
  visibility: hidden;
  z-index: ${p => p.theme.zindex[1]};
  transition:
    opacity 50ms ease,
    visibility 50ms ease
  ;

  ${DesktopAccordionItem}.is-active & {
    opacity: 1;
    visibility: visible;
    transition:
      opacity 300ms ease 500ms,
      visibility 300ms ease 500ms
    ;
  }

  ${S_HorizontalAccordion}.layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.openColor') ||
      p.theme.colors.white
    };
  }

  ${S_HorizontalAccordion}.layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.openColor') ||
      p.theme.colors.white
    };
  }  
`

const DesktopAccordionItemContentInner = styled.div`
  margin: auto 0;
  padding: 0 30px;
  max-width: 800px;

  ${p => p.theme.media.minWidth('large')} {
    padding: 0 50px;
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    padding: 0 75px;
  }
`

const DesktopAccordionItemInactiveTitle = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  opacity: 0;
  visibility: hidden;
  white-space: nowrap;
  z-index: ${p => p.theme.zindex[2]};
  transition:
    opacity 200ms ease,
    visibility 200ms ease
  ;

  ${S_HorizontalAccordion}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.closedBackgroundColor') ||
      p.theme.colors.black
    };
  }

  ${S_HorizontalAccordion}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.closedBackgroundColor') ||
      p.theme.colors.black
    };
  }
  
  ${DesktopAccordionItem}.is-inactive & {
    opacity: 1;
    visibility: visible;
    transition:
      opacity 300ms ease 200ms,
      visibility 300ms ease 200ms
    ;
  }
`

const DesktopAccordionTitle = styled(AccordionTitle)`
  margin: 0 0 24px 0;  
  
  ${DesktopAccordionItemCta} & {
    padding: 0 20px;
    text-align: center;
  }

  ${DesktopAccordionItemInactiveTitle} & {
    position: absolute;
    top: 50%;
    left: 50%;
    transform-origin: 0 0;
    transform: rotate(90deg) translateX(-50%) translateY(-50%);

    strong {
      font-weight: inherit;
    }
  }

  ${S_HorizontalAccordion}.layout-a ${DesktopAccordionItemInactiveTitle} & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.closedColor') ||
      p.theme.colors.white
    };
  }

  ${S_HorizontalAccordion}.layout-b ${DesktopAccordionItemInactiveTitle} & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.closedColor') ||
      p.theme.colors.white
    };
  }
`

const DesktopAccordionItemCtaButton = styled(AccordionItemCtaButton)`
  margin: 0 0 20px 0;

  ${DesktopAccordionItem}:hover & {
    .icon {
      transform: rotate(180deg);
    }
  }

  ${S_HorizontalAccordion}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBackgroundColor') ||
      'transparent'
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBorderColor') ||
      'transparent'
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_HorizontalAccordion}.layout-a ${DesktopAccordionItem}:hover & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBackgroundColorHover') ||
      p.theme.colors.white
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBorderColorHover') ||
      p.theme.colors.white
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconColorHover') ||
        p.theme.colors.black
      };
    }
  }

  ${S_HorizontalAccordion}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBackgroundColor') ||
      'transparent'
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBorderColor') ||
      'transparent'
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_HorizontalAccordion}.layout-b ${DesktopAccordionItem}:hover & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBackgroundColorHover') ||
      p.theme.colors.white
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBorderColorHover') ||
      p.theme.colors.white
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconColorHover') ||
        p.theme.colors.black
      };
    }
  }  
`

const DesktopAccordionItemCloseButton = styled.button`
  position: absolute;
  top: 30px;
  right: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: solid 2px;
  z-index: ${p => p.theme.zindex[2]};
  opacity: 0;
  visibility: hidden;
  transition:
    background-color 300ms ease,
    border-color 300ms ease,
    opacity 300ms ease,
    visibility 300ms ease
  ;

  .icon {
    width: 16px;
    height: 16px;
    transform-origin: 50% 50%;
    transition: fill 300ms ease, transform 300ms ease;
  }

  ${DesktopAccordionItem}.is-active & {
    opacity: 1;
    visibility: visible;
  }

  ${S_HorizontalAccordion}.layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBackgroundColor') ||
      'transparent'
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBorderColor') ||
      'transparent'
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_HorizontalAccordion}.layout-a &:hover {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBackgroundColorHover') ||
      p.theme.colors.white
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconBorderColorHover') ||
      p.theme.colors.white
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionA.itemsStyleDesktop.defaultIconColorHover') ||
        p.theme.colors.black
      };
    }
  }

  ${S_HorizontalAccordion}.layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBackgroundColor') ||
      'transparent'
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBorderColor') ||
      'transparent'
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_HorizontalAccordion}.layout-b &:hover {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBackgroundColorHover') ||
      p.theme.colors.white
    };

    border-color: ${p =>
      p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconBorderColorHover') ||
      p.theme.colors.white
    };

    .icon {
      fill: ${p =>
        p.theme.mixins.acfColor('modules.horizontalAccordionB.itemsStyleDesktop.defaultIconColorHover') ||
        p.theme.colors.black
      };
    }
  }  
`

const DesktopReadMore = styled(TextButton)`
  margin: 20px 0 0 0;
  opacity: 0;
  transition: opacity 300ms ease;

  ${DesktopAccordionItemCta}:hover & {
    opacity: 1;
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

export const GQL_HORIZONTAL_ACCORDION_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment HorizontalAccordion${layout}Module on Page_Pagecontent_Modules_HorizontalAccordion${layout} {
    backgroundImageEnabled
    backgroundOverlayOpacityDesktop
    backgroundVideo {
      mediaItemUrl
    }        
    backgroundImage {
      ...WPImage
    }    
    body
    fieldGroupName
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag    
    items {
      backgroundOverlayOpacityDesktop
      body      
      image {
        ...WPImage
      }
      link {
        target
        title
        url
      }            
      title
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

export const GQL_CUSTOMIZE_HORIZONTAL_ACCORDION_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeHorizontalAccordion${layout}Module on Customize_Modules {
    horizontalAccordion${layout} {
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
      headerBackgroundColor
      headerBorderColor
      headerBodyColor
      headerColor
      headerColorBold
      itemsStyleDesktop {                
        closedBackgroundColor
        closedBorderColor
        closedColor                              
        openColor                              
        defaultBorderColor
        defaultColor
        defaultIconBackgroundColor
        defaultIconBackgroundColorHover
        defaultIconBorderColor
        defaultIconBorderColorHover
        defaultIconColor
        defaultIconColorHover                
      }
      itemsStyleMobile {        
        closedBackgroundColor
        closedBorderColor
        closedColor
        closedIconBackgroundColor
        closedIconBorderColor
        closedIconColor
        openBackgroundColor
        openBorderColor
        openColor
        openIconBackgroundColor
        openIconBorderColor
        openIconColor                
      }    
    }
  }
`

export default HorizontalAccordion