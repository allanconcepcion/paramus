import { useContext, useRef, useState, useEffect } from 'react'
import styled from 'styled-components'
import Link from 'components/LinkWithQuery'
import gsap from 'gsap'
import usePrevious from '@react-hook/previous'

import AppContext from 'contexts/App'
import WPImage, { GQL_WP_IMAGE} from 'components/WPImage'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'

const MobileMenu = () => {
  const { customize, mobileMenu } = useContext(AppContext)
  const elRef = useRef()
  const navRef = useRef()
  const tlRef = useRef()
  const iconRef = useRef()
  const closeLabelRef = useRef()
  const closeIconRef = useRef()
  const backgroundRef = useRef()
  const isAnimating = useRef()
  const [activeMenuIds, setActiveMenuIds] = useState([])
  const prevActiveMenuIds = usePrevious(activeMenuIds)      

  const mapLinks = ({
    id,    
    label, 
    url,
    target,
    mobileMenu,
    childItems
  }) => {    
    let obj = {        
      id,
      label,   
      url,
      target,    
      backgroundColor: mobileMenu?.backgroundColor,      
      childItems: childItems && childItems.nodes.map(mapLinks),
    }

    if ( mobileMenu?.icon ) {
      obj.icon = {}
      obj.icon.altText = mobileMenu?.icon.altText
      obj.icon.sourceUrl = mobileMenu?.icon.sourceUrl
      obj.icon.srcSet = mobileMenu?.icon.srcSetl
    }
    
    return obj
  }

  const links = mobileMenu?.map(mapLinks)  

  const setHeight = () => {
    if ( elRef.current ) {
      elRef.current.style.height = `${window.innerHeight}px`
    }    
  }  

  const onMenuToggleClick = () => {
    if ( isAnimating.current ) {
      return
    }
    
    if ( activeMenuIds.length === 0 ) {
      setActiveMenuIds([0])
    } else {
      const ids = [...activeMenuIds]
      ids.shift()
      setActiveMenuIds(ids)
    }
  }
  
  const onLinkButtonClick = ( id ) => {
    if ( isAnimating.current ) {
      return
    }
    
    if ( activeMenuIds.indexOf(id) === -1 ) {
      setActiveMenuIds([id, ...activeMenuIds])
    }    
  }
  
  const onBackgroundClick = () => {
    if ( isAnimating.current ) {
      return
    }
    
    setActiveMenuIds([])
  }

  const onWindowResize = () => {
    setHeight()    
  }  

  const onWindowScroll = () => {
    setHeight()    
  }  

  useEffect(() => {
    if ( tlRef.current ) {
      tlRef.current.kill()
    }

    tlRef.current = gsap.timeline({
      onStart: () => {
        isAnimating.current = true
      },
      onComplete: () => {
        isAnimating.current = false
      }
    })

    // first open
    if ( prevActiveMenuIds && prevActiveMenuIds.length === 0 && activeMenuIds.length === 1 ) {
      tlRef.current.to(backgroundRef.current, .75, {
        autoAlpha: 1,
        ease: 'power4.inOut'
      }, 'first-in')

      tlRef.current.to(closeLabelRef.current, .75, {
        autoAlpha: 1,
        ease: 'power4.inOut'
      }, 'first-in')

      tlRef.current.to(iconRef.current, .75, {
        autoAlpha: 0,
        ease: 'power4.inOut'
      }, 'first-in')

      tlRef.current.to(closeIconRef.current, .75, {
        autoAlpha: 1,
        ease: 'power4.inOut'
      }, 'first-in')
    }
        
    // Open elements
    if ( prevActiveMenuIds && activeMenuIds.length > prevActiveMenuIds.length ) {
      // animate old items out      
      tlRef.current.to(navRef.current, activeMenuIds.length > 1 ? 1 : 0, {
        x: `-${(activeMenuIds.length - 1) * 100}%`,
        ease: 'expo.inOut'
      }, 'shift-in')

      if ( prevActiveMenuIds && prevActiveMenuIds[0] !== undefined ) {
        const ul = navRef.current.querySelector(`ul[data-parent-id="${prevActiveMenuIds[0]}"]`)
        const items = [...ul.querySelectorAll(':scope > li > button, :scope > li > a')].reverse()

        tlRef.current.to(items, .4, {
          autoAlpha: 0,
          x: -20,
          ease: 'power4.inOut',
          stagger: .05,
        }, 'shift-in')
      }

      // animate current items in
      const ul = navRef.current.querySelector(`ul[data-parent-id="${activeMenuIds[0]}"]`)
      const items = [...ul.querySelectorAll(':scope > li > button, :scope > li > a')].reverse()
      
      tlRef.current.fromTo(items, .5, {
        autoAlpha: 0,
        x: 20,
      }, {
        autoAlpha: 1,
        x: 0,
        ease: 'elastic.out(1, 0.5)',
        stagger: .05,
      }, '-=.5')
    }

    // Close elements
    else if ( prevActiveMenuIds && prevActiveMenuIds.length > activeMenuIds.length ) {
      // animate current items out
      const ul = navRef.current.querySelector(`ul[data-parent-id="${prevActiveMenuIds[0]}"]`)
      const items = [...ul.querySelectorAll(':scope > li > button, :scope > li > a')].reverse()
      
      tlRef.current.fromTo(items, .4, {
        autoAlpha: 1,
        x: 0,
      }, {
        autoAlpha: 0,
        x: 20,
        ease: 'power4.inOut',
        stagger: .05,
      }, 'shift-out')

      tlRef.current.to(navRef.current, 1, {
        x: `-${(activeMenuIds.length - 1) * 100}%`,
        ease: 'expo.inOut'
      }, 'shift-out')

      // animate old items in
      if ( activeMenuIds[0] !== undefined ) {
        const ul = navRef.current.querySelector(`ul[data-parent-id="${activeMenuIds[0]}"]`)
        const items = [...ul.querySelectorAll(':scope > li > button, :scope > li > a')].reverse()

        tlRef.current.to(items, .5, {
          autoAlpha: 1,
          x: 0,
          ease: 'elastic.out(1, 0.5)',
          stagger: .05,
        }, '-=.5')
      }      
    }

    // last close
    if ( prevActiveMenuIds && prevActiveMenuIds.length > 0 && activeMenuIds.length === 0 ) {
      tlRef.current.to(backgroundRef.current, .75, {
        autoAlpha: 0,
        ease: 'power4.inOut'
      }, '-=1')

      tlRef.current.to(closeLabelRef.current, .75, {
        autoAlpha: 0,
        ease: 'power4.inOut'
      }, '-=1')

      tlRef.current.to(iconRef.current, .75, {
        autoAlpha: 1,
        ease: 'power4.inOut'
      }, '-=1')

      tlRef.current.to(closeIconRef.current, .75, {
        autoAlpha: 0,
        ease: 'power4.inOut'
      }, '-=1')
    }        
  }, [activeMenuIds, prevActiveMenuIds, navRef.current])

  useEffect(() => {
    setHeight()
  }, [])

  useEffect(() => {
    window.addEventListener('resize', onWindowResize)
    window.addEventListener('scroll', onWindowScroll)

    return () => {
      window.removeEventListener('resize', onWindowResize)
      window.removeEventListener('scroll', onWindowScroll)
    }
  }, [])

  const renderLink = ({
    id,
    label,
    url,
    target,
    icon,
    backgroundColor,
    childItems,
  }, k) => {
    return (
      <li key={k} data-id={id}>
        {childItems?.length > 0 ? (
           <>
           <NavLink
               as='button'
               onClick={() => onLinkButtonClick(id)}               
               $backgroundColor={backgroundColor}
           >
             <span>{label}</span>
             <span>
               <Icon>                
                 <WPImage
                     image={icon}
                     layout='fill'
                     objectFit='contain'
                     fadeIn={false}
                 />
               </Icon>
             </span>
           </NavLink>
           <ul data-parent-id={id}>
             {childItems.map(renderLink)}
           </ul>
           </>
         ) : (
           <Link href={url || ''} passHref>
             <NavLink
                 $backgroundColor={backgroundColor}                 
                 target={target || undefined}
             >              
               <span>{label}</span>
               <span>
                 <Icon>
                   <WPImage
                      image={icon}
                      layout='fill'                       
                      objectFit='contain'
                      fadeIn={false}
                   />
                 </Icon>
               </span>
             </NavLink>
           </Link>           
         )}
      </li>
    )    
  }
  
  return (
    <S_MobileMenu ref={elRef} $display={customize?.customizeMobileMenu.enabled}>
      <Background
          ref={backgroundRef}
          onClick={onBackgroundClick}
      />
      <NavWrapper>
        <Nav ref={navRef}>
          <ul
              data-parent-id={0}
              ref={navRef}
          >
            {links && links.map(renderLink)}
          </ul>        
        </Nav>
      </NavWrapper>

      <MenuToggle onClick={onMenuToggleClick}>
        <span ref={closeLabelRef}>Close</span>
        <span>
          <Icon ref={iconRef}>                      
            <WPImage
                image={customize?.customizeMobileMenu.icon}
                layout='fill'                       
                objectFit='contain'
                fadeIn={false}
            />
          </Icon>          
          <CloseIcon ref={closeIconRef}>
            <WPImage
                image={customize?.customizeMobileMenu.closeIcon}
                layout='fill'                       
                objectFit='contain'
                fadeIn={false}
            />
          </CloseIcon>
        </span>
      </MenuToggle>
    </S_MobileMenu>
  )
}

const S_MobileMenu = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  user-select: none;
  z-index: ${p => p.theme.zindex[5]};
  pointer-events: none;
  display: ${p => p.$display ? 'block': 'none'};

  ${p => p.theme.media.minWidth('tablet')} {
    display: none;
  }
`

const Background = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  background-color: rgba(0,0,0,.8);
  opacity: 0;
  visibility: hidden;
  pointer-events: all;
`

const MenuToggle = styled.button`
  position: absolute;
  right: 15px;
  bottom: 15px;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  pointer-events: all;

  // label
  span:nth-child(1) {
    display: block;
    margin: 0 15px 0 0;
    color: white;
    opacity: 0;
    ${p => p.theme.mixins.acfTypography('customizeMobileMenu.mobile.regular')};
  }

  // icon
  span:nth-child(2) {
    position: relative;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: ${p =>
      p.theme.mixins.acfColor('customizeMobileMenu.buttonBackgroundColor') ||
      p.theme.colors.black
    };
    box-shadow: 0 4px 4px 0 rgba(0,0,0,.25);
    transition: transform 150ms ease;
  }

  &:active span:nth-child(2) {
    transform: scale(.9);
  }
`

const NavWrapper = styled.div`
  position: absolute;
  right: 15px;
  bottom: 80px;  
`

const Nav = styled.nav`
  position: relative;

  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;
  }

  li {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin: 0 0 10px 0;

    &:last-child {
      margin: 0;
    }
  }

  li > ul {
    position: absolute;
    bottom: 0;
    left: 0;
    transform: translateX(100%);    
  }  
`

const NavLink = styled.a`
  display: flex;
  align-items: center;
  justify-content: flex-end;
  opacity: 0;
  visibility: hidden;
  pointer-events: all;

  // label
  span:nth-child(1) {
    display: block;
    margin: 0 15px 0 0;
    color: white;
    ${p => p.theme.mixins.acfTypography('customizeMobileMenu.mobile.regular')};
  }

  // icon
  span:nth-child(2) {
    position: relative;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: ${p =>
      p.theme.mixins.acfColor(p.$backgroundColor) ||
      p.theme.colors.black
    };
    box-shadow: 0 4px 4px 0 rgba(0,0,0,.25);
    flex: 0 0 50px;
    transition: transform 150ms ease;
  }

  &:active span:nth-child(2) {
    transform: scale(.9);
  }
`

const Icon = styled.div`
  ${p => p.theme.mixins.center('absolute')};
  width: 30px;
  height: 30px;
`

const CloseIcon = styled(Icon)`
  opacity: 0;
`

const MOBILE_MENU_ITEM = `  
  id: databaseId
  target
  label
  url   
  mobileMenu {
    icon {
      ...WPImage
    }
    backgroundColor
  }   
`

export const GQL_MOBILE_MENU = `
  ${GQL_WP_IMAGE}

  fragment MobileMenu on MenuItem {
    ${MOBILE_MENU_ITEM}
    childItems(first:50) {
      nodes {
        ${MOBILE_MENU_ITEM}
        childItems(first:50) {
          nodes {
            ${MOBILE_MENU_ITEM}
            childItems(first:50) {
              nodes {
                ${MOBILE_MENU_ITEM}
              }        
            }
          }        
        }
      }        
    }    
  }
`

export const GQL_CUSTOMIZE_MOBILE_MENU = `
  ${GQL_WP_IMAGE}

  fragment CustomizeMobileMenu on Customize {
    customizeMobileMenu {
      enabled
      buttonBackgroundColor
      closeIcon {
        ...WPImage
      }
      icon {
        ...WPImage
      }
      mobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
    }
  }
`

export default MobileMenu
