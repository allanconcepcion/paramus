import { useRef, useEffect, useState, useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import  { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import { Container, Row, Col } from 'components/Grid'
import BasicCta from 'components/ctas/Basic'
import HtmlEmbedCta from 'components/ctas/HtmlEmbed'
import ChecklistHtmlEmbedCta from 'components/ctas/ChecklistHtmlEmbed'
import { Icon } from 'components/SVGIcons'
import AppContext from 'contexts/App'

import { useMinWidth } from 'hooks/useMedia'

const CtaMap = {
  Basic: BasicCta, 
  HtmlEmbed: HtmlEmbedCta, 
  ChecklistHtmlEmbed: ChecklistHtmlEmbedCta
}

const Footer = ({  
  page
}) => {
  const ctaWrapperRef = useRef()
  const ctaSpaceBackgroundRef = useRef()
  const mainContainerRef = useRef()
  
  const [footerCta, setFooterCta] = useState(false)
  const isDesktop = useMinWidth('desktop') 
  const { customize } = useContext(AppContext)    

  useEffect(() => {        
    if ( page?.pageFooter?.ctaEnabled ) {
      page?.pageFooter.ctas.map(cta => {        
        setFooterCta(cta)        
      })
    }   
  }, [page?.pageFooter])  

  const setCtaWrapperPosition = () => {
    if ( !ctaWrapperRef.current ) {
      return
    }
    
    let height = ctaWrapperRef.current.getBoundingClientRect().height * .5

    const text = ctaWrapperRef.current.querySelector('.js-align-text')  
  
    if ( text ) {
      height = text.getBoundingClientRect().height
    }
    
    if ( !isDesktop ) {                
      ctaWrapperRef.current.style.marginBottom = `-${height}px`
      ctaSpaceBackgroundRef.current.style.height = `calc(100% - ${height}px)`
      mainContainerRef.current.style.marginTop = `${height}px`
    } else {
      ctaWrapperRef.current.style.marginBottom = `-${height / 3}px`
      ctaSpaceBackgroundRef.current.style.height = `calc(100% - ${height / 3}px)`
      mainContainerRef.current.style.marginTop = `calc(${height / 3}px - 20px)`        
    }        
  }

  const onWindowResize = () => {
    setCtaWrapperPosition()
  }

  useEffect(() => {
    setCtaWrapperPosition()
    
    window.addEventListener('resize', onWindowResize)

    return () => {
      window.removeEventListener('resize', onWindowResize)
    }
  }, [isDesktop, footerCta])

  const renderCta = () => {
    const key = footerCta.__typename.match(/[^_]+$/)[0]
    const Cta = CtaMap[key]

    if ( Cta ) {
      return (
        <CtaWrapper id="_footer-cta" ref={ctaWrapperRef}>
          <CtaSpaceBackground
              ref={ctaSpaceBackgroundRef} 
              $backgroundColor={footerCta.backgroundColorSpace}
          />          
          <Cta {...footerCta} />
        </CtaWrapper>
      )        
    }      
  }
        
  return (
    <>
    <S_Footer>
      {footerCta && renderCta()}
      <Main>
        <BackgroundImage>
          <WPImage
            desktop={customize?.footer.blocksStyleDesktop.backgroundImage}
            mobile={customize?.footer.blocksStyleMobile.backgroundImage}
            layout='fill'
            objectFit='cover'          
            quality={90}
            webp={false}
          />    
        </BackgroundImage>
        
        <Container
            padding={{ dk: 6, lg: 7 }}
            maxWidth={false}
            ref={mainContainerRef}
        >
          {(customize?.footer.logoMobile || customize?.footer.logoDesktop) && (
             <Logo
              $widthMobile={customize?.footer.logoWidthMobile}
              $widthDesktop={customize?.footer.logoWidthDesktop}
             >
               <Link href='/'>
                 <a aria-label="Logo">
                   <WPImage
                      mobile={customize?.footer.logoMobile}
                      desktop={customize?.footer.logoDesktop}                      
                   />
                 </a>
               </Link>
             </Logo>
           )}

           {(customize?.footer.phoneLabel && customize?.footer.phoneNumber) && (
            <PhoneCta>
              <a href={`tel:${customize?.footer.phoneNumber}`}>
                <span>{customize?.footer.phoneLabel}</span>
                <span>{customize?.footer.phoneNumber}</span>
              </a>           
            </PhoneCta>
           )}
          {customize?.footer.blocksHiddenMobile && customize?.footer.blocksFormat === 'locations' && (
            <BlocksHiddenMobile>
              {customize?.footer.blocksLinkMobile && (
                <Link href={customize?.footer.blocksLinkMobile.url}>
                  <a target={customize?.footer.blocksLinkMobile.target}>
                    <Icon icon='map-marker' />
                    <span>{customize?.footer.blocksLinkMobile.title}</span>
                  </a>                  
                </Link>                            
              )}              
            </BlocksHiddenMobile>
          )}
          <Blocks 
            $hiddenMobile={customize?.footer.blocksHiddenMobile && customize?.footer.blocksFormat === 'locations'}
          >
            <BlocksRow
              $format={customize?.footer.blocksFormat || 'richText'} 
              $gridSize={customize?.footer.gridSize}
              justifyContent={{ 
                tblg: (customize?.footer.blocksFormat === 'richText' || !customize?.footer.blocksFormat) ? 'center' : 'flex-start'
              }}
            >
              {customize?.footer.blocks?.map((block, k) => (
                 <BlockCol 
                  key={k} 
                  tblg={24 / parseInt(customize?.footer.gridSize.replace('x', ''))}                  
                  $gridSize={customize?.footer.gridSize}
                  $format={customize?.footer.blocksFormat || 'richText'}
                 >
                   <Block
                    $format={customize?.footer.blocksFormat || 'richText'}
                   >
                     <BlockLabel>{block.label}</BlockLabel>
                     {(customize?.footer.blocksFormat === 'richText' || !customize?.footer.blocksFormat) && (
                        <BlockBody
                          dangerouslySetInnerHTML={{ __html: block.body }}
                        />
                     )}
                     {customize?.footer.blocksFormat === 'locations' && (
                      <BlockLocations>
                        {block.locations.map((location, k) => (
                          <li key={k}>
                            {location.link && (
                              <Link href={location.link.url}>
                                <a target={location.link.target}>
                                  <Icon icon='map-marker' />
                                  <span>{location.link.title}</span>                                  
                                </a>
                              </Link> 
                            )}                            
                          </li>
                        ))}
                      </BlockLocations>
                     )}
                   </Block>                   
                 </BlockCol>
               ))}
            </BlocksRow>            
          </Blocks>
        </Container>
      </Main>
      <Kicker>
        <Container padding={{ dk: 6, lg: 7 }} maxWidth={false}>
          <Row alignItems={{ tblg: 'center' }}>
            <TaglineCol tblg={8}>
              <Tagline dangerouslySetInnerHTML={{ __html: customize?.footer.tagline }} />
            </TaglineCol>
            <Col tblg={8}>
              <Cta dangerouslySetInnerHTML={{ __html: customize?.footer.cta }} />
            </Col>
            <CopyrightCol tblg={8}>
              <Copyright>
                {customize?.footer.copyright}
              </Copyright>
            </CopyrightCol>
          </Row>
        </Container>
      </Kicker>
    </S_Footer>
    </>
  )
}

const S_Footer = styled.footer``

const CtaWrapper = styled.div`
  position: relative;
  margin: 0;
  z-index: 2;
`

const CtaSpaceBackground = styled.div`
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: ${p =>
    p.theme.mixins.acfColor(p.$backgroundColor) || p.theme.colors.white
  };
`

const Main = styled.div`
  position: relative;
  padding: 60px 0 60px 0;  
  
  color: ${p =>
    p.theme.mixins.acfColor('footer.blocksStyleMobile.color') ||
    p.theme.colors.white
  };
  background-color: ${p =>
    p.theme.mixins.acfColor('footer.blocksStyleMobile.backgroundColor') ||
    p.theme.colors.black
  };    

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 100px 0;
    color: ${p =>
      p.theme.mixins.acfColor('footer.blocksStyleDesktop.color') ||
      p.theme.colors.white
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('footer.blocksStyleDesktop.backgroundColor') ||
      p.theme.colors.black
    };
  }
`

const BackgroundImage = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
`

const Logo = styled.div`
  margin: 0 auto 60px auto;
  width: ${p => p.$widthMobile}px;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 auto 100px auto;
    width: ${p => p.$widthDesktop}px;
  }  
`

const PhoneCta = styled.div`  
  margin: 40px 0 50px 0;
  text-align: center;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 60px 0 60px 0;  
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: -40px 0 75px 0;  
  }  

  a {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
  }

  span:nth-child(1) {  
    margin: 0 0 10px 0;
    ${p => p.theme.mixins.acfTypography('footer.phoneStyleMobile.label')};

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('footer.phoneStyleDesktop.label')};
    }
  }

  span:nth-child(2) {
    ${p => p.theme.mixins.acfTypography('footer.phoneStyleMobile.number')};

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('footer.phoneStyleDesktop.number')};
    }
  }
`

const BlocksRow = styled(Row)`  
  ${p => p.theme.media.minWidth('tablet-large')} {
    ${p => {
      if (p.$format !== 'locations') {
        return 
      }

      switch (p.$gridSize) {
        case '2x':
          return 'columns: 2'
        case '3x':
          return 'columns: 3'
        case '4x':
          return 'columns: 4'
        case '5x':
          return 'columns: 5'
      }
    }};    
  }  
`

const Blocks = styled.div`
  ${p => p.theme.media.maxWidth('tablet-large')} {
    display: ${p => p.$hiddenMobile ? 'none' : 'block'};
  }  
`

const BlocksHiddenMobile = styled.div`  
  ${p => p.theme.media.minWidth('tablet-large')} {
    display: none;
  }

  a {
    display: flex;
    flex-direction: column;    
    align-items: center;
  }

  .icon {
    font-size: 2.4rem;
    margin: 0 0 10px 0;
  }

  span {
    ${p => p.theme.mixins.acfTypography('footer.blocksStyleMobile.locationsLabel')};
  }
`

const Block = styled.div`
  text-align: center;  

  ${p => p.theme.media.minWidth('tablet-large')} {
    text-align: ${p => p.$format === 'richText' ? 'center' : 'left'};
  }
`

const BlockCol = styled(Col)`
  margin-bottom: 50px;  
  break-inside: avoid;
  ${p => p.$format === 'locations' && 'max-width: none;'};

  &:last-child {
    margin-bottom: 0;
  }  

  ${p => p.theme.media.minWidth('tablet-large')} {    
    &:nth-last-child(-n+${p => p.$gridSize === '4x' || p.$gridSize === '2x' ? 2 : 3}) {
      margin: 0;
    }

    ${p => p.$format === 'locations' && 'margin-bottom: 50px !important;'};
  }
  
  ${p => p.theme.media.minWidth('desktop')} {
    &:nth-last-child(-n+${p => p.$gridSize.replace('x', '')}) {
      margin: 0;
    }

    /* &:nth-child(${p => p.$gridSize.replace('x', '')}n+1):not(:last-child) {
      display: flex;
      justify-content: flex-start;
    } */

    /* &:nth-child(${p => p.$gridSize.replace('x', '')}n+${p => p.$gridSize.replace('x', '')}) {
      display: flex;
      justify-content: flex-end;
    }  */ 
      
    /* &:last-child:not(:nth-child(${p => p.$gridSize.replace('x', '')}n)) {
      display: flex;
      justify-content: flex-end;
    } */
    
    ${p => p.$format === 'locations' && 'display: block !important'};
    ${p => p.$format === 'locations' && 'margin-bottom: 50px !important;'};
  }  
`

const BlockLabel = styled.h4`
  margin: 0 0 12px 0;

  ${p => p.theme.mixins.acfTypography('footer.blocksStyleMobile.label')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('footer.blocksStyleDesktop.label')};
  }
`

const BlockBody = styled.div`
  margin: 0;

  ${p => p.theme.mixins.acfTypography('footer.blocksStyleMobile.body')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('footer.blocksStyleDesktop.body')};
  }

  > *:first-child {
    margin-top: 0;
  }

  > *:last-child {
    margin-bottom: 0;
  }

  a {
    color: currentColor;

    @media(hover:hover) {
      &:hover {
        text-decoration: underline;  
      }
    }
  } 
`

const BlockLocations = styled.ul`
  margin: 0;
  padding: 0;
  list-style: none;

  a {
    display: inline-flex;
    align-items: flex-start;
    transition: opacity 300ms ease;
    ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
    }

    @media(hover:hover) {
      &:hover {
        opacity: .75;
      }
    }

    span {
      display: block;      
    }

    .icon {
      display: none;
      margin: .3em 5px 0 0;
      ${p => p.theme.media.minWidth('tablet')} {
        display: block;
      }
    }
  }
`

const Kicker = styled.div`
  padding: 24px 0;

  color: ${p =>
    p.theme.mixins.acfColor('footer.kickerStyleMobile.color') ||
    p.theme.colors.white
  };
  background-color: ${p =>
    p.theme.mixins.acfColor('footer.kickerStyleMobile.backgroundColor') ||
    p.theme.colors.black
  };

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 20px 0;
    color: ${p =>
      p.theme.mixins.acfColor('footer.kickerStyleDesktop.color') ||
      p.theme.colors.white
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('footer.kickerStyleDesktop.backgroundColor') ||
      p.theme.colors.black
    };
  }
`

const TaglineCol = styled(Col)`
  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    justify-content: flex-start;
  }
`

const CopyrightCol = styled(Col)`
  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    justify-content: flex-end;
  }
`

const Tagline = styled.div`
  margin: 0 0 8px 0;
  text-align: center;
  ${p => p.theme.mixins.acfTypography('footer.kickerStyleMobile.tagline')};    

  ${p => p.theme.media.minWidth('tablet-large')} {
    margin: 0;
    text-align: left;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('footer.kickerStyleMobile.tagline')};
  }

  > *:first-child {
    margin-top: 0;
  }

  > *:last-child {
    margin-bottom: 0;
  }
`
const Cta = styled.div`
  margin: 0 0 8px 0;
  text-align: center;
  ${p => p.theme.mixins.acfTypography('footer.kickerStyleMobile.cta')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('footer.kickerStyleDesktop.cta')};
  }

  > *:first-child {
    margin-top: 0;
  }

  > *:last-child {
    margin-bottom: 0;
  }
`

const Copyright = styled.div`
  text-align: center;
  ${p => p.theme.mixins.acfTypography('footer.kickerStyleMobile.copyright')};

  ${p => p.theme.media.minWidth('tablet-large')} {
    text-align: right;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('footer.kickerStyleDesktop.copyright')};
  }
`

export const GQL_FOOTER = ( type ) => `
  ${GQL_WP_IMAGE}

  fragment ${type || ''}Footer on ${type} {
    pageFooter {
      ctaEnabled
      ctas {
        ... on Page_Pagefooter_FooterCtas_Basic {
          backgroundColor
          borderColor
          ctaEnabled
          cta {
            target
            title
            url
          }          
          ctaIconBackground
          ctaIconBackgroundHover
          ctaIconBorder
          ctaIconBorderHover
          ctaIconColor
          ctaIconColorHover
          backgroundColorSpace
          fieldGroupName
          headline
          image {
            ...WPImage
          }
          textColor
        }          
        ... on Page_Pagefooter_FooterCtas_HtmlEmbed {
          backgroundColor
          borderColor     
          backgroundColorSpace
          embedBackgroundColor
          fieldGroupName
          headline
          note
          htmlImage {
            ...WPImage
          }          
          textColor
          htmlEnabled
          html
        }
        ... on Page_Pagefooter_FooterCtas_ChecklistHtmlEmbed {
          backgroundColor
          borderColor
          backgroundColorSpace
          embedBackgroundColor
          fieldGroupName
          headline
          checklistHtmlImage {
            ...WPImage
          }
          checklistHtmlUnderlineImage {
            ...WPImage
          }
          textColor
          accentColor
          checklistHtmlEnabled
          html
          checklist {
            body
          }
        }
      }
    }
  }
`

export const GQL_CUSTOMIZE_FOOTER = `
  ${GQL_WP_IMAGE}

  fragment CustomizeFooter on Customize {
    footer {
      blocks {
        body
        label
        locations {
          link {
            target
            title
            url
          }
        }
      }
      blocksFormat
      blocksHiddenMobile
      blocksLinkMobile {
        target
        title
        url
      }
      blocksStyleDesktop {
        backgroundColor
        backgroundImage {
          ...WPImage
        }
        color
        ${GQL_ACF_TYPOGRAPHY('body')}
        ${GQL_ACF_TYPOGRAPHY('label')}        
      }
      blocksStyleMobile {
        backgroundColor
        backgroundImage {
          ...WPImage
        }
        color
        ${GQL_ACF_TYPOGRAPHY('body')}
        ${GQL_ACF_TYPOGRAPHY('label')}        
        ${GQL_ACF_TYPOGRAPHY('locationsLabel')}        
      }
      cta
      checklistHtmlEmbedStylesDesktop {
        ${GQL_ACF_TYPOGRAPHY('headlineRegular')}
        ${GQL_ACF_TYPOGRAPHY('headlineBold')}
        ${GQL_ACF_TYPOGRAPHY('checklistRegular')}
        ${GQL_ACF_TYPOGRAPHY('checklistBold')}        
      }
      checklistHtmlEmbedStylesMobile {
        ${GQL_ACF_TYPOGRAPHY('headlineRegular')}
        ${GQL_ACF_TYPOGRAPHY('headlineBold')}
        ${GQL_ACF_TYPOGRAPHY('checklistRegular')}
        ${GQL_ACF_TYPOGRAPHY('checklistBold')}        
      }
      copyright
      globalBasicCta {
        target
        title
        url
      }
      globalBasicCtaEnabled    
      globalChecklistHtmlEmbedHtmlEnabled
      globalChecklistHtmlEmbedHtml
      globalHtmlEmbedHtmlEnabled  
      globalHtmlEmbedHtml     
      gridSize      
      kickerStyleDesktop {
        backgroundColor
        color
        ${GQL_ACF_TYPOGRAPHY('copyright')}
        ${GQL_ACF_TYPOGRAPHY('cta')}
      } 
      kickerStyleMobile {
        backgroundColor
        color
        ${GQL_ACF_TYPOGRAPHY('tagline')}        
        ${GQL_ACF_TYPOGRAPHY('copyright')}        
        ${GQL_ACF_TYPOGRAPHY('cta')}                
      } 
      logoDesktop {
        ...WPImage
      }
      logoMobile {
        ...WPImage
      }
      logoWidthDesktop
      logoWidthMobile
      phoneLabel
      phoneNumber
      phoneStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('label')}
        ${GQL_ACF_TYPOGRAPHY('number')}
      }
      phoneStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('label')}
        ${GQL_ACF_TYPOGRAPHY('number')}        
      }
      tagline
    }
  }
`

export default Footer
