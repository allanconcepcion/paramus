import { useContext, useEffect, useRef, useState } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import gsap from 'gsap'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Icon } from 'components/SVGIcons'
import AppContext from 'contexts/App'
import SocialMenu from 'components/SocialMenu'
import { isUrlActive } from 'utils/dom'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'

const Menu = ({
  page
}) => {  
  const {    
    mounted,
    menuOpen,
    setMenuOpen, 
    menu, 
    customize
  } = useContext(AppContext)    
  
  const elRef = useRef()
  const drawerRef = useRef()
  const mainTLRef = useRef()
  const navRef = useRef()
  const [activeMenuIds, setActiveMenuIds] = useState([0])  

  const setHeight = () => {
    if ( elRef.current ) {
      elRef.current.style.height = `${window.innerHeight}px`
    }    
  }  
  
  const onMenuClick = ( e ) => {    
    if ( e.target === elRef.current ) {
      setMenuOpen(false)
    }
  }

  const onLinkButtonClick = ( id ) => {
    if ( activeMenuIds.indexOf(id) === -1 ) {
      setActiveMenuIds([id, ...activeMenuIds])
    }    
  }

  const onLinkBackClick = () => {
    const ids = [...activeMenuIds]
    ids.shift()
    setActiveMenuIds(ids)    
  }

  const onCloseClick = () => {
    setMenuOpen(false)    
  }

  const onWindowResize = () => {    
    setHeight()
  }

  const onWindowScroll = () => {
    setHeight()
  }

  useEffect(() => {
    setHeight()
  }, [])

  useEffect(() => {
    if ( mainTLRef.current ) {
      mainTLRef.current.kill()
    }

    mainTLRef.current = gsap.timeline({      
      onComplete: () => {
        setActiveMenuIds([0])
      }
    })
    
    if ( menuOpen ) {
      mainTLRef.current.to(elRef.current, .65, {
        autoAlpha: 1,
        ease: 'power4.out'
      })
      mainTLRef.current.to(drawerRef.current, .5, {
        x: 0,
        ease: 'expo.inOut'
      }, '-=.6')
    } else {
      mainTLRef.current.to(drawerRef.current, .5, {
        x: '100%',
        ease: 'expo.inOut'
      })
      mainTLRef.current.to(elRef.current, .65, {
        autoAlpha: 0,
        ease: 'power4.out'
      }, '-=.2')
    }

    return () => {
      if ( mainTLRef.current ) {
        mainTLRef.current.kill()
      }      
    }
  }, [menuOpen, elRef, drawerRef, mainTLRef])

  useEffect(() => {
    gsap.to(navRef.current, .65, {
      x: `-${(activeMenuIds.length - 1) * 100}%`,
      ease: 'expo.inOut'
    })

    let current = navRef.current.querySelector('.is-current')
    
    if ( !current ) {
      current = navRef.current
    }

    gsap.to(current.closest('nav'), .75, {
      height: current.offsetHeight,
      ease: 'expo.inOut'
    })    
  }, [activeMenuIds, navRef.current])

  useEffect(() => {
    window.addEventListener('resize', onWindowResize)
    window.addEventListener('scroll', onWindowScroll)

    return () => {
      window.removeEventListener('resize', onWindowResize)
      window.removeEventListener('scroll', onWindowScroll)
    }
  }, [])

  const renderLink = ({
    label,
    url,    
    id,    
    target, 
    childItems
  }, k) => {   
    return (
      <li 
        key={k}        
      >
        {childItems?.nodes?.length > 0 ? (
           <>
           <button onClick={() => onLinkButtonClick(id)}>
             <span>{label}</span>
             <Icon icon='arrow-right' />
           </button>
           <ul className={
             (activeMenuIds.indexOf(id) !== -1 ? 'is-active ' : '') +
             (activeMenuIds[0] === id ? 'is-current' : '')
           }>
             <li>
               <button onClick={onLinkBackClick}>
                 <span>Back</span>
                 <Icon icon='arrow-left' />
               </button>
             </li>
             {childItems.nodes.map(renderLink)}
           </ul>
           </>
         ) : (
          <Link 
           href={url ? url.replace(/\/+$/, '') : ''} prefetch={false}          
          >
            <a
              className={mounted && isUrlActive(url) ? 'is-active' : undefined}
              target={target || undefined}
              key={label}
            >                            
              {label}
            </a>
          </Link>           
         )}
      </li>
    )    
  }  
  
  return (
    <S_Menu 
      ref={elRef} 
      onClick={onMenuClick}
      $visible={page?.pageHeader?.menuEnabled}
    >
      <Drawer 
        ref={drawerRef}
        $backgroundImageDesktop={customize?.menu.backgroundImageDesktop}
        $backgroundImageMobile={customize?.menu.backgroundImageMobile}
      >
        <Header>
          <Close onClick={onCloseClick} aria-label="Close">
            <Icon icon='close' />
          </Close>          
          {(customize?.menu.logoDesktop || customize?.menu.logoDesktop) && (
             <Logo
                 $widthMobile={customize?.menu.logoWidthMobile}
                 $widthDesktop={customize?.menu.logoWidthDesktop}
             >
               <Link href='/'>
                 <a>                  
                   <WPImage
                       mobile={customize?.menu.logoMobile}
                       desktop={customize?.menu.logoDesktop}
                       fadeIn={false}
                   />                                 
                 </a>
               </Link>
             </Logo>
           )}
        </Header>
        {customize?.menu.ctaLinks?.length > 0 && (
          <CtaLinks>
            <ul>
              {customize?.menu.ctaLinks.map((link, k) => (
                <li key={k}>
                  <Link 
                    href={link.link.url || ''}                    
                  >
                    <a target={link.link.target}>                    
                      {link.link.title}
                    </a>
                  </Link>
                </li>
              ))}              
            </ul>
          </CtaLinks>
        )}        
        <Body>
          <LinksWrapper>
            <Links
              $hoverColor={customize?.menu.hoverColor}
            >
              <ul
                  className={
                    (activeMenuIds.indexOf(0) !== -1 ? 'is-active ' : '') +
                    (activeMenuIds[0] === 0 ? 'is-current' : '')
                  }
                  ref={navRef}
              >
                {menu?.map(renderLink)}
              </ul>
            </Links>            
          </LinksWrapper>

          {customize?.menu.socialEnabled && (
             <SocialMenuWrapper>
               <S_SocialMenu />
             </SocialMenuWrapper>
           )}

          {customize?.menu.ctaButtonLink && (
            <CTAButtonWrapper
              $color={customize?.menu.ctaButtonColor}
            >
              <Link                 
                href={customize?.menu.ctaButtonLink.url || ''}
              >
                <a
                  target={customize?.menu.ctaButtonLink.target}
                >
                  {customize?.menu.ctaButtonLink.title}
                </a>
              </Link>
            </CTAButtonWrapper>            
          )}
        </Body>
      </Drawer>
    </S_Menu>
  )
}

const S_Menu = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  opacity: 0;
  visibility: hidden;
  background-color: ${p =>
    p.theme.mixins.acfColor('menu.overlayColor') ||
    'rgba(0,0,0,.6)'
  };    
  user-select: none;
  z-index: ${p => p.theme.zindex[6]};    
  display: ${p => p.$visible ? 'block': 'none'};
`

const Drawer = styled.div`
  display: flex;
  flex-direction: column;
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  max-width: 400px;
  transform: translateX(100%);  
  color: ${p =>
    p.theme.mixins.acfColor('menu.color') ||
    p.theme.colors.white
  };  
  background-color: ${p =>
    p.theme.mixins.acfColor('menu.backgroundColor') ||
    p.theme.colors.black
  };  
  background-size: cover;
  background-repeat: no-repeat;
  background-image: ${p =>
    p.$backgroundImageMobile?.sourceUrl ? (
      'url(' + p.$backgroundImageMobile.sourceUrl + ')'
    ) : 'none'
  };      

  ${p => p.theme.media.minWidth('desktop')} {
    background-image: ${p =>
      p.$backgroundImageDesktop?.sourceUrl ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }
`

const Header = styled.div`
  display: flex;
  flex-direction: column;
  padding: 20px;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 30px;
  }
`

const CtaLinks = styled.nav`
  padding: 0 20px;
  color: ${p =>
    p.theme.mixins.acfColor('menu.ctaLinksColor') ||
    p.theme.colors.white
  };    

  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  li {
    margin: 0 8px 12px 8px;
  }

  a {
    ${p => p.theme.mixins.acfTypography('menu.ctaLinksMobile.regular')};
    ${p => p.theme.mixins.linkFade()};    
    white-space: nowrap;

    ${p => p.theme.media.minWidth('tablet')} {
      ${p => p.theme.mixins.acfTypography('menu.ctaLinksDesktop.regular')};  
    }
  }
`

const Close = styled.button`  
  display: flex;
  align-items: center;
  justify-content: center;
  align-self: flex-end;
  margin: 0;
  width: 18px;
  height: 18px;
  border: solid 1px ${p =>
    p.theme.mixins.acfColor('menu.closeButtonBorderColor') ||
    p.theme.colors.white
  };
  border-radius: 50%;
  ${p => p.theme.mixins.linkFade()};

  .icon {
    width: 1rem;
    height: 1rem;
    stroke-width: 0;    
    fill: ${p =>
      p.theme.mixins.acfColor('menu.closeButtonIconColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      fill: ${p =>
        p.theme.mixins.acfColor('menu.closeButtonIconColor') ||
        p.theme.colors.white
      };    
    }
  }
`

const Logo = styled.div`
  margin: 20px auto;
  width: 100%;
  max-width: ${p => p.$widthMobile}px;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 30px auto;
    max-width: ${p => p.$widthDesktop}px;
  }
`

const Body = styled.div`
  flex: 1;
  overflow-y: auto;
`

const LinksWrapper = styled.div`
  position: relative;
  padding: 20px;
`

const Links = styled.nav`
  position: relative;
  overflow: hidden;

  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;    
    transition:
      opacity 500ms ease 0ms,
      visibility 500ms ease 0ms
    ;

    &.is-active {
      opacity: 1;
      visibility: visible;
      transition:
        opacity 500ms ease 400ms,
        visibility 500ms ease 400ms
      ;
    }

    &.is-current {
      pointer-events: all;             
    }
  }

  li {
    padding: 12px 0;    
    border-bottom: solid .5px;
    border-bottom-color: ${p =>
      p.theme.mixins.acfColor('menu.accentColor') ||
      p.theme.colors.ltgray
    };  

    &:last-child {
      border-bottom: none;
    }
  }
  
  li > ul {
    position: absolute;
    top: 0;
    left: 0;
    transform: translateX(100%);    
  }

  a, button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    text-align: left;    
    ${p => p.theme.mixins.acfTypography('menu.mobile.regular')};    
    ${p => p.theme.mixins.linkFade(
      p.$hoverColor ? 1 : .75      
    )};        

    transition: opacity 250ms ease, color 250ms ease;

    @media(hover:hover) {
      &:hover {
        color: ${p =>
          p.theme.mixins.acfColor('menu.hoverColor') ||
          p.theme.colors.white
        };        

        .icon {
          color: ${p =>
            p.theme.mixins.acfColor('menu.hoverColor') ||
            p.theme.colors.white
          };          
        }
      }      
    }
      
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('menu.desktop.regular')};
    }
  }

  a.is-active {
    font-weight: bold;
  }

  .icon {
    font-size: 1.6rem;
    color: ${p =>
      p.theme.mixins.acfColor('menu.accentColor') ||
      p.theme.colors.white
    };
  }
`

const SocialMenuWrapper = styled.div`
  padding: 20px;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 30px;
  }
`

const S_SocialMenu = styled(SocialMenu)`
  ul {
    display: flex;
    justify-content: center;
  }

  li {
    margin: 15px;
  }  
`

const CTAButtonWrapper = styled.div`  
  padding: 20px;

  a {
    color: ${p => p.theme.mixins.acfColor(p.$color) || p.theme.colors.white};
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    border: solid 1px ${p => p.theme.mixins.acfColor(p.$color) || p.theme.colors.white};
    border-radius: 4px;
    ${p => p.theme.mixins.acfTypography('menu.ctaButtonMobile.regular')};
    transition: opacity 300ms ease;

    @media(hover:hover) {
      &:hover {
        opacity: .8;
      }
    }

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('menu.ctaButtonDesktop.regular')};  
    }
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 30px;
  }
`

const MENU_ITEM = `  
  id: databaseId
  target
  label
  url  
  mainMenu {
    featuredImage {
      ...WPImage
    }
  }
`

export const GQL_MENU = `
  ${GQL_WP_IMAGE}

  fragment Menu on MenuItem {
    ${MENU_ITEM}
    childItems(first:50) {
      nodes {
        ${MENU_ITEM}
        childItems(first:50) {
          nodes {
            ${MENU_ITEM}
            childItems(first:50) {
              nodes {
                ${MENU_ITEM}
              }        
            }
          }        
        }
      }        
    }    
  }
`

export const GQL_CUSTOMIZE_MENU = `
  ${GQL_WP_IMAGE}

  fragment CustomizeMenu on Customize {
    menu {
      accentColor
      backgroundColor
      backgroundImageDesktop {
        ...WPImage
      }
      backgroundImageMobile {
        ...WPImage
      }
      closeButtonBorderColor
      closeButtonIconColor
      color
      ctaButtonColor
      ctaButtonDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      ctaButtonLink {
        target
        title
        url
      }       
      ctaButtonMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      ctaLinks {        
        link {
          target
          title
          url
        }
      }
      ctaLinksColor
      ctaLinksDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      ctaLinksMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      desktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      formatDesktop
      hamburgerLabel
      hoverColor      
      iconBackgroundColor
      iconBackgroundColorMobile
      iconColor      
      iconColorMobile     
      iconBorderColorDesktop 

      logoMobile {
        ...WPImage    
      }
      logoDesktop {
        ...WPImage    
      }                        
      mobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      overlayColor                  
      ${GQL_ACF_TYPOGRAPHY('hamburgerLabelRegular')}                  
    }
  }
`

export default Menu
