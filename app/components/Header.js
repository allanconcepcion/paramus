import { useContext, useState, useEffect, useRef } from 'react'
import Link from 'components/LinkWithQuery'
import styled, { ThemeContext } from 'styled-components'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Icon } from 'components/SVGIcons'
import { transparentize } from 'utils/color'
import { useMinWidth } from 'hooks/useMedia'
import { breakpoints } from 'styles/media'
import AppContext from 'contexts/App'
import DropdownMenu from 'components/DropdownMenu'
import  { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'

const Header = ({
  page
}) => {
  const {
    mounted,
    setMenuOpen, 
    customize
  } = useContext(AppContext)        
  const theme = useContext(ThemeContext)

  const headerContentRef = useRef()
  const dropDownMenuRef = useRef()

  let logoDesktop = customize?.header.logoDesktop
  let logoWidthDesktop = customize?.header.logoWidthDesktop
  let logoMobile = customize?.header.logoMobile  
  let logoWidthMobile = customize?.header.logoWidthMobile    
  let visibleOnLoadDesktop = customize?.header.visibleOnLoadDesktop
  let positionDesktop = customize?.header.positionDesktop
  let stickyDesktop = customize?.header.stickyDesktop
  let menuFormatDesktop = customize?.menu.formatDesktop
  let pageMenuEnabled = page?.pageHeader?.menuEnabled

  let logoLink    

  if ( page?.pageHeader?.overrideLogo ) {    
    logoDesktop = page.pageHeader.logoDesktop
    logoWidthDesktop = page.pageHeader.logoWidthDesktop
    logoMobile = page.pageHeader.logoMobile    
    logoWidthMobile = page.pageHeader.logoWidthMobile
    logoLink = page.pageHeader.logoLink    
  } else if ( page?.parent?.node?.pageHeader?.overrideLogo ) {
    logoDesktop = parent.node.pageHeader.logoDesktop
    logoWidthDesktop = parent.node.pageHeader.logoWidthDesktop
    logoMobile = parent.node.pageHeader.logoMobile    
    logoWidthMobile = parent.node.pageHeader.logoWidthMobile
    logoLink = parent.node.pageHeader.logoLink    
  }
  
  const [opaque, setOpaque] = useState(true)
  const [stickyMenuDesktop, setStickyMenuDesktop] = useState(false)
  const isDesktop = useMinWidth('desktop')

  const updateOpaque = () => {
    /// We cant use isDesktop here as we can't get the absolute latest value reliably.    
    if ( window.innerWidth >= breakpoints.desktop ) {
      setOpaque(window.scrollY > 0 && stickyDesktop)
    } else {
      setOpaque(true)
    }
  }

  const updateStickyElements = () => {    
    const headerContentHeight = headerContentRef.current?.getBoundingClientRect().height
    setStickyMenuDesktop(
      window.scrollY >= headerContentHeight - 1 && 
      !stickyDesktop && 
      pageMenuEnabled && 
      menuFormatDesktop === 'dropdown'
    )    
  }

  const onMenuToggleClick = () => {
    setMenuOpen(true)
  }

  const onWindowScroll = () => {
    updateOpaque()
    updateStickyElements()
  }

  const onWindowResize = () => {    
    updateOpaque()
    updateStickyElements()
  }

  const onWindowOrientationchange = () => {
    updateOpaque()
    updateStickyElements()
  }

  useEffect(() => {
    if ( !dropDownMenuRef.current ) {
      return
    }

    if ( stickyMenuDesktop ) {      
      dropDownMenuRef.current.style.position = 'fixed'
      dropDownMenuRef.current.style.borderBottom = `solid 1px ${transparentize(theme.colors.white, .5)}`
    } else {
      dropDownMenuRef.current.style.position = 'relative'
      dropDownMenuRef.current.style.borderBottom = 'none'
    }    
  }, [stickyMenuDesktop])

  useEffect(() => {
    updateOpaque()
    updateStickyElements()
  }, [])

  useEffect(() => {
    window.addEventListener('scroll', onWindowScroll)
    window.addEventListener('resize', onWindowResize)
    window.addEventListener('orientationchange', onWindowOrientationchange)

    return () => {
      window.removeEventListener('scroll', onWindowScroll)
      window.removeEventListener('resize', onWindowResize)
      window.removeEventListener('orientationchange', onWindowOrientationchange)
    }
  }, [mounted, isDesktop])

  const leftLinks = customize?.header.leftLinks?.map(link => ({
    label: link.label,
    title: link.link?.title,
    icon: link.icon,
    url: link.link?.url,
    target: link.link?.target,
    button: link.button
  })) || []      

  const rightLinks = customize?.header.rightLinks?.map(link => ({
    label: link.label,
    icon: link.icon,
    title: link.link?.title,
    url: link.link?.url,
    target: link.link?.target,    
    button: link.button
  })) || []  

  const renderExpandedLink = ( link, position ) => {
    return (
      <Link href={link.url || ''} passHref>
        <ExpandedLink 
          target={link.target}
          $position={position}
          $opaque={opaque}
        >
          <div>{link.label}</div>
          <div>{link.icon && <Icon icon={link.icon} />} {link.title}</div>
        </ExpandedLink>
      </Link>
    )
  }

  const renderNormalLink = ( link, position ) => {
    return (
      <Link href={link.url || ''} passHref>
        <NormalLink 
          target={link.target}
          $position={position}
          $opaque={opaque}
          $button={link.button}
        >
          {link.icon && <Icon icon={link.icon} />} {link.title}
        </NormalLink>
      </Link>
    )    
  }

  const renderLogo = () => {
    if ( !logoMobile && !logoDesktop ) return 

    return (
      <Logo
        $headerOpaque={opaque}
        $visibleOnLoadDesktop={visibleOnLoadDesktop}
        $positionDesktop={positionDesktop}
        $widthMobile={logoWidthMobile}
        $widthDesktop={logoWidthDesktop}
      >            
        <Link href={logoLink ? logoLink.url : '/'}>
          <a aria-label="Logo">
            <WPImage
              mobile={logoMobile}
              desktop={logoDesktop}
              fadeIn={false}
            />
          </a>
        </Link>
      </Logo>
    )
  }
  
  return (
    <S_Header
      id="header"
      $opaque={opaque}
      $stickyDesktop={stickyDesktop}
      className='js-header'
    >
      <HeaderContent 
        className='js-header-content'
        $opaque={opaque}
        ref={headerContentRef}
      >
        {(positionDesktop === 'left') && renderLogo()}

        {mounted && isDesktop && (
          <LeftLinks
            $menuFormatDesktop={customize?.menu.formatDesktop}
            $logoPositionDesktop={positionDesktop}
            $opaque={opaque}
          >
            {leftLinks.length > 0 && (
                <ul>
                  {leftLinks.map((link, i) => (
                    <li key={i}>                    
                      {customize?.header.leftLinksFormat === 'expanded' ? (
                        renderExpandedLink(link, 'left')
                      ) : (
                        renderNormalLink(link, 'left')
                      )}                     
                    </li>
                  ))}
                </ul>
              )}
          </LeftLinks>
        )}
        
        {(positionDesktop === 'center') && renderLogo()}
        
        <Nav
          $logoPositionDesktop={positionDesktop}
        >        
          {mounted && !isDesktop && customize?.header.iconLink?.url && (
            <IconLink>
              <Link href={customize?.header.iconLink?.url}>
                <a target={customize?.header.iconLink?.target}>
                  <div>
                    <WPImage
                        image={customize?.header.iconLinkIcon}
                    />
                  </div>
                  <span>{customize?.header.iconLink?.title}</span>
                </a>
              </Link>
            </IconLink>
          )}
        
          {mounted && isDesktop && rightLinks.length > 0 && (
            <RightLinks
              $menuFormatDesktop={customize?.menu.formatDesktop}              
              $opaque={opaque}
            >
              <ul>
                {rightLinks.map((link, i) => (
                  <li key={i}>                    
                    {customize?.header.rightLinksFormat === 'expanded' ? (
                      renderExpandedLink(link, 'right')
                    ) : (
                      renderNormalLink(link, 'right')
                    )}                     
                  </li>
                ))}
              </ul>
            </RightLinks>
          )}   

          {((mounted && !isDesktop) || (mounted && isDesktop && customize?.menu.formatDesktop === 'flyout')) && page?.pageHeader?.menuEnabled && (
            <MenuToggle
              onClick={onMenuToggleClick}
              aria-label="Navigation Menu"
            >
              {customize?.menu.hamburgerLabel && (
                <span>{customize?.menu.hamburgerLabel}</span>
              )}
              <Icon icon={customize?.menu.hamburgerLabel ? 'menu-flush' : 'menu'} />
            </MenuToggle>
          )}
        </Nav>
      </HeaderContent>    

      {mounted && isDesktop && menuFormatDesktop === 'dropdown' && pageMenuEnabled && (
        <DropdownMenu ref={dropDownMenuRef} />
      )}
    </S_Header>
  )
}

const S_Header = styled.header`
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;  
  border-bottom: solid 1px ${p => transparentize(p.theme.colors.white, .5)};  
  user-select: none;  
  z-index: ${p => p.theme.zindex[5]};  

  ${p => p.theme.media.minWidth('desktop')} {
    position: ${p => p.$stickyDesktop ? 'fixed' : 'absolute'};
  }
`

const HeaderContent = styled.div`
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  min-height: 60px;

  &:before {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};    
    pointer-events: none;    
    transition: opacity 300ms ease;
    z-index: 1;
    background-color: ${p =>
      p.theme.mixins.acfColor('header.backgroundColorMobile') ||
      p.theme.colors.black
    };
  
    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('header.backgroundColorDesktop') ||
        p.theme.colors.black
      };    
    }
  }
  
  &:after {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};    
    pointer-events: none;    
    
    opacity: ${p => p.$opaque ? 1 : 0};
    transition: opacity 300ms ease;
    z-index: 2;
    background-color: ${p =>
      p.theme.mixins.acfColor('header.backgroundColorMobile') ||
      p.theme.colors.black
    };
  
    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('header.backgroundColorDesktopScroll') ||
        p.theme.colors.black
      };    
    }    
  }
  
  ${p => p.theme.media.minWidth('desktop')} {
    flex-direction: row;
  }
`

const Links = styled.div`
  display: flex;
  position: relative;  
  z-index: 3;

  ul {
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
  }

  li {
    margin: 0 12px;

    ${p => p.theme.media.minWidth('xlarge')} {
      margin: 0 24px;  
    }

    &:first-child {
      margin-left: 0;
    }

    &:last-child {
      margin-right: 0;
    }
  }  
`

const LeftLinks = styled(Links)`
  flex: 1;

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.$logoPositionDesktop === 'left' ? 'flex: none' : ''};
    ${p => p.$logoPositionDesktop === 'left' ? 'margin-right: 24px' : ''};    
  }
  
  ${p => p.theme.media.minWidth('xlarge')} {
    ${p => p.$logoPositionDesktop === 'left' ? 'margin-right: 48px' : ''};    
  }

  ul {
    margin: 0 0 0 30px;

    ${p => p.theme.media.minWidth('large')} {
      margin: 0 0 0 ${p => p.$menuFormatDesktop === 'dropdown' ? 50 : 30}px;
    }    
  }  
`

const RightLinks = styled(Links)`    
  ul {
    margin: 0 30px 0 0;
    
    ${p => p.theme.media.minWidth('large')} {
      margin: 0 ${p => p.$menuFormatDesktop === 'dropdown' ? 50 : 30}px 0 0;
    }    
  }
`

const ExpandedLink = styled.a`
  font-size: 1.6rem;
  white-space: nowrap;
  ${p => p.theme.mixins.linkFade()};
  
  div {
    transition: color 300ms ease;
  }

   div:nth-child(1) {
    ${p => p.theme.mixins.acfTypography('header.' + p.$position + 'LinksExpandedTypographyDesktop.label')};
    margin: 0 0 3px 0;

    color: ${p =>
      p.theme.mixins.acfColor('header.' + p.$position + 'LinksExpandedTypographyDesktop.labelColor' + (p.$opaque ? 'Scroll' : '')) ||
      p.theme.colors.white
    };
  }

  div:nth-child(2) {
    display: flex;
    align-items: center;
    ${p => p.theme.mixins.acfTypography('header.' + p.$position + 'LinksExpandedTypographyDesktop.link')};

    .icon {
      margin: 0 .3em 0 0;
    }
    
    color: ${p =>
      p.theme.mixins.acfColor('header.' + p.$position + 'LinksExpandedTypographyDesktop.linkColor' + (p.$opaque ? 'Scroll' : '')) ||
      p.theme.colors.white
    };
  }
`

const Logo = styled.div`
  position: relative;
  margin: 12px 20px;
  width: 100%;
  max-width: ${p => p.$widthMobile}px;
  opacity: ${p => p.$headerOpaque ? 1 : 0};
  visibility: ${p => p.$headerOpaque ? 'visible' : 'hidden'};
  z-index: 3;

  transition:
    opacity 300ms ease,
    visibility 300ms ease
  ;

  ${p => p.theme.media.minWidth('desktop')} {
    max-width: ${p => p.$widthDesktop}px;
    opacity: ${p => (p.$headerOpaque || p.$visibleOnLoadDesktop) ? 1 : 0};
    visibility: ${p => (p.$headerOpaque || p.$visibleOnLoadDesktop) ? 'visible' : 'hidden'};
    margin-right: ${p => p.$positionDesktop === 'left' ? 'auto' : 0};
    margin-left: ${p => p.$positionDesktop === 'left' ? '32px' : 0};
  }
`

const Nav = styled.div`
  position: relative;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  align-self: stretch;
  flex: 1;
  border-top: solid 1px ${p => transparentize(p.theme.colors.white, .5)};  
  z-index: 3; 

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.$logoPositionDesktop === 'left' ? 'flex: none' : ''};
  }
`

const NormalLink = styled.a`    
  white-space: nowrap;
  ${p => p.theme.mixins.acfTypography('header.' + p.$position + 'LinksNormalTypographyDesktop.regular')};
  ${p => p.theme.mixins.linkDecoration('currentColor')};  
  border-radius: ${p => p.$button ? '4px' : 0};
  padding: ${p => p.$button ? '10px 16px' : 0};
  display: flex;
  align-items: center;

  .icon {
    margin: 0 .4em 0 0;
  }

  transition: 
    color 300ms ease,
    background-color 300ms ease,
    opacity 300ms ease
  ;
  
  @media(hover:hover) {
    &:hover {
      opacity: ${p => p.$button ? .85 : 1};
    }
  }
  
  color: ${p =>
    p.$button ? (p.$opaque ? (p.theme.mixins.acfColor('header.backgroundColorDesktopScroll') || p.theme.colors.black) : p.theme.mixins.acfColor('header.backgroundColorDesktop') || p.theme.colors.black) : 
    (p.theme.mixins.acfColor('header.' + p.$position + 'LinksNormalTypographyDesktop.color' + (p.$opaque ? 'Scroll' : '')) || p.theme.colors.white)
  };

  background-color: ${p =>
    p.$button ? (p.theme.mixins.acfColor('header.' + p.$position + 'LinksNormalTypographyDesktop.color' + (p.$opaque ? 'Scroll' : '')) || p.theme.colors.white) :
    'transparent'
  };
`

const IconLink = styled.div`
  flex: 1;
  align-self: stretch;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 6px 0;
  color: ${p =>
    p.theme.mixins.acfColor('header.iconLinkTypographyMobile.colorMobile') ||
    p.theme.colors.white
  };
  background-color: ${p =>
    p.theme.mixins.acfColor('header.iconLinkTypographyMobile.backgroundColorMobile') ||
    p.theme.colors.black
  };

  a {
    display: flex;
    align-items: center;
    justify-content: center;
    color: currentColor;

    > div {
      width: 30px;
      margin: 0 10px 0 0;
    }

    > span {
      ${p => p.theme.mixins.acfTypography('header.iconLinkTypographyMobile.regular')};
    }
  }
`

const MenuToggle = styled.button`
  display: flex;
  align-items: center;
  justify-content: center;
  align-self: stretch;
  flex-direction: column;
  height: auto;
  width: 60px;
  padding: 5px 10px;
  border-left: solid 1px ${p => transparentize(p.theme.colors.white, .5)};
  background-color: ${p =>
    p.theme.mixins.acfColor('menu.iconBackgroundColorMobile') ||
    'transparent'
  };    

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 0;
    width: ${p => p.theme.headerHeight}px;
    border-left: solid 1px ${p => p.theme.mixins.acfColor('menu.iconBorderColorDesktop') || transparentize(p.theme.colors.white, .5)};
    background-color: ${p =>
      p.theme.mixins.acfColor('menu.iconBackgroundColor') ||
      'transparent'
    };    
  }

  span {
    display: block;
    ${p => p.theme.mixins.acfTypography('menu.hamburgerLabelRegular')};

    color: ${p =>
      p.theme.mixins.acfColor('menu.iconColorMobile') ||
      p.theme.colors.white
    };

    ${p => p.theme.media.minWidth('desktop')} {
      color: ${p =>
        p.theme.mixins.acfColor('menu.iconColor') ||
        p.theme.colors.white
      };
    }
  }
 
  .icon {
    display: inline-block;
    width: 3.5rem;
    height: 3.5rem;
    stroke-width: 0;
    stroke: ${p =>
      p.theme.mixins.acfColor('menu.iconColorMobile') ||
      p.theme.colors.white
    };
    fill: ${p =>
      p.theme.mixins.acfColor('menu.iconColorMobile') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      stroke: ${p =>
        p.theme.mixins.acfColor('menu.iconColor') ||
        p.theme.colors.white
      };
      fill: ${p =>
        p.theme.mixins.acfColor('menu.iconColor') ||
        p.theme.colors.white
      };    
    }
  }
`

export const GQL_HEADER = ( type ) => `
  ${GQL_WP_IMAGE}

  fragment ${type || ''}Header on ${type} {
    pageHeader {
      overrideLogo
      logoDesktop {
        ...WPImage
      }                        
      logoMobile {
        ...WPImage
      }
      logoWidthDesktop            
      logoWidthMobile
      logoLink {
        target
        url
      }        
      menuEnabled    
    }
    parent {
      node {
        ... on Page {
          pageHeader {
            menuEnabled
            overrideLogo
            logoDesktop {
              ...WPImage
            }                        
            logoMobile {
              ...WPImage
            }
            logoWidthDesktop            
            logoWidthMobile
            logoLink {
              target
              url
            }            
          }
        }
      }
    }
  }
`

export const GQL_CUSTOMIZE_HEADER = `
  ${GQL_WP_IMAGE}

  fragment CustomizHeader on Customize {
    header {
      backgroundColorDesktop
      backgroundColorDesktopScroll
      backgroundColorMobile

      iconLink {
        url
        target
        title
      }
      iconLinkIcon {
        ...WPImage
      }      
      iconLinkTypographyMobile {
        backgroundColorMobile
        colorMobile
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      
      leftLinks {
        button
        icon
        label
        link {
          target
          title
          url
        }                        
      }            
      leftLinksExpandedTypographyDesktop {
        labelColor
        labelColorScroll
        linkColor
        linkColorScroll
        ${GQL_ACF_TYPOGRAPHY('label')}
        ${GQL_ACF_TYPOGRAPHY('link')}
      }
      leftLinksFormat 
      leftLinksNormalTypographyDesktop {
        color
        colorScroll
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }   
      logoDesktop {
        ...WPImage
      }
      logoMobile {
        ...WPImage
      }
      logoWidthMobile      
      logoWidthDesktop                              
      rightLinks {
        link {
          target          
          title
          url
        }
        icon
        label
      }      
      rightLinksExpandedTypographyDesktop {
        labelColor
        labelColorScroll
        linkColor
        linkColorScroll
        ${GQL_ACF_TYPOGRAPHY('label')}
        ${GQL_ACF_TYPOGRAPHY('link')}
      }
      rightLinksFormat    
      rightLinksNormalTypographyDesktop {
        color
        colorScroll
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }      
      stickyDesktop
      visibleOnLoadDesktop   
      positionDesktop                     
    }
  }
`

export default Header
