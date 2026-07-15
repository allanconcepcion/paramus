import { useState, useContext, useEffect, useRef, forwardRef } from 'react'
import styled from 'styled-components'
import gsap from 'gsap'
import usePrevious from '@react-hook/previous'

import Link from 'components/LinkWithQuery'
import { isUrlActive } from 'utils/dom'
import AppContext from 'contexts/App'
import { Icon } from 'components/SVGIcons'
import WPImage from 'components/WPImage'
import { H3 } from 'components/Typography'

const DropdownMenu = forwardRef((props, elRef) => {
  const [activeMenuIds, setActiveMenuIds] = useState([0])
  const [activeDropdown, setActiveDropdown] = useState()
  const prevDropdown = usePrevious(activeDropdown)
  const { 
    mounted, 
    menu, 
    customize  
  } = useContext(AppContext)
  const dropdownsRef = useRef([])
  const toRef = useRef()
  const tlRef = useRef()
    
  useEffect(() => {
    if ( activeDropdown === prevDropdown ) return 
    
    if ( tlRef.current ) {
      tlRef.current.kill()
    }

    tlRef.current = gsap.timeline()

    dropdownsRef.current.forEach((dropdown) => {        
      if ( dropdown.dataset.id === activeDropdown ) {        
        tlRef.current.fromTo(dropdown, {
          y: '10px',
          autoAlpha: 0
        }, {
          y: 'calc(100% + 1px)',
          autoAlpha: 1,
          duration: .25, 
          pointerEvents: 'all',
          ease: 'power4.out'
        })        
      } else {   
        gsap.to(dropdown, {
          y: '10px',
          autoAlpha: 0, 
          duration: 0, 
          pointerEvents: 'none',
          ease: 'power4.out'
        })        

        gsap.to(dropdown.querySelector('.js-dropdown-nav-track'), {
          x: 0, 
          duration: 0                    
        })        
      }      
    })      
  }, [activeDropdown, prevDropdown])

  useEffect(() => {    
    const dropdown = dropdownsRef.current.find(dd => dd?.dataset?.id === activeDropdown)    

    if ( !dropdown ) return

    const nav = dropdown.querySelector('.js-dropdown-nav')
    const track = dropdown.querySelector('.js-dropdown-nav-track')

    gsap.to(track, {    
      x: `-${(activeMenuIds.length - 1) * 100}%`,
      duration: .65,
      ease: 'expo.inOut'
    })

    let current = track.querySelector('.is-current')
    
    if ( !current ) {
      current = track
    }

    gsap.to(nav, {
      height: current.offsetHeight,
      duration: .2,
      ease: 'expo.inOut'
    })  
  }, [activeMenuIds, activeDropdown])  

  useEffect(() => {
    updateDropdownPositions()

    window.addEventListener('resize', onWindowResize)

    return () => {
      window.removeEventListener('resize', onWindowResize)  
    }
  }, [])
  
  const updateDropdownPositions = () => {
    dropdownsRef.current.forEach((el) => {
      el.style.left = `0px`

      const { left, width } = el.getBoundingClientRect()
      let offset = (left + width) - window.innerWidth
      
      el.style.left = `-${offset}px`
    })    
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

  const onWindowResize = () => {
    updateDropdownPositions()
  }

  const onTopLinkMouseEnter = ( e ) => {
    clearTimeout(toRef.current)    
    setActiveMenuIds([0])
    setActiveDropdown(e.currentTarget.dataset.id)    
  }

  const onTopLinkMouseLeave = ( e ) => {
    toRef.current = setTimeout(() => {
      setActiveDropdown(null)    
    }, 100) 
  }

  const renderLink = ({
    label,
    url,    
    id,
    childItems, 
    target    
  }, k) => {        
    return (
      <li 
        key={id}
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
    <S_DropdownMenu ref={elRef}>
      <nav>
        <ul>
          {menu.map((link, k) => (
            <li 
              key={k}
              data-id={link.id}
              onMouseEnter={onTopLinkMouseEnter}
              onMouseLeave={onTopLinkMouseLeave}
            >              
              <Link 
                href={link.url || ''}
              >
                <a
                  className={mounted && isUrlActive(link.url) ? 'is-active' : undefined}
                  target={link.target || undefined}
                >                  
                  {link.label}
                </a>
              </Link>

              {link.childItems?.nodes.length > 0 && (
                <DropDown 
                  ref={r => dropdownsRef.current[k] = r}
                  data-id={link.id}
                  $backgroundImageDesktop={customize.menu.backgroundImageDesktop}
                  $backgroundImageMobile={customize.menu.backgroundImageMobile}
                >                  
                  <DropdownNav className='js-dropdown-nav'>
                    <DropDownNavTrack className='js-dropdown-nav-track'>
                      <ul
                        className={
                          (activeMenuIds.indexOf(0) !== -1 ? 'is-active ' : '') +
                          (activeMenuIds[0] === 0 ? 'is-current' : '')
                        }
                      >
                        {link.childItems.nodes.map(renderLink)}
                      </ul>
                    </DropDownNavTrack>                    
                  </DropdownNav>                                    

                  {link.mainMenu?.featuredImage && (
                    <DropdownImage>
                      <WPImage 
                        image={link.mainMenu?.featuredImage}
                      />
                      <DropdownTitle>
                        {link.label}
                      </DropdownTitle>
                    </DropdownImage>
                  )}
                </DropDown>
              )}
            </li>
          ))}
        </ul>       
      </nav>      
    </S_DropdownMenu>
  )
})

const S_DropdownMenu = styled.div`   
  top: 0;
  width: 100%;
  padding: 0 30px;
  background-color: ${p =>
    p.theme.mixins.acfColor('menu.backgroundColor') ||
    p.theme.colors.black
  };  

  > nav > ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;    
  }

  > nav > ul > li {
    position: relative;
  }

  > nav > ul > li > a {
    display: block;
    padding: 12px 12px;
    text-align: center;
    ${p => p.theme.mixins.acfTypography('menu.mobile.regular')};    
    ${p => p.theme.mixins.linkFade()};
    
    ${p => p.theme.media.minWidth('large')} {
      padding: 12px 24px;
    }    

    color: ${p =>
      p.theme.mixins.acfColor('menu.color') ||
      p.theme.colors.white
    };  
      
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('menu.desktop.regular')};
    }

    &.is-active {
      font-weight: bold;
      color: ${p =>
        p.theme.mixins.acfColor('menu.accentColor') ||
        p.theme.mixins.acfColor('menu.color') ||
        p.theme.colors.white
      };  
    }
  }
`

const DropDown = styled.div`
  display: flex;
  position: absolute;
  top: calc(100% + 1px);
  left: 0;
  padding: 75px 40px;
  overflow: hidden;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  background-color: ${p =>
    p.theme.mixins.acfColor('menu.backgroundColor') ||
    p.theme.colors.black
  };  

  background-size: cover;
  background-repeat: no-repeat;
  background-image: ${p =>
    p.$backgroundImageMobile?.sourceUrl ? (
      'url(' + p.$backgroundImageMobile?.sourceUrl + ')'
    ) : 'none'
  };      

  ${p => p.theme.media.minWidth('desktop')} {
    background-image: ${p =>
      p.$backgroundImageDesktop?.sourceUrl ? (
        'url(' + p.$backgroundImageDesktop?.sourceUrl + ')'
      ) : 'none'
    };  
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    padding: 80px 50px;
  }  
`

const DropdownNav = styled.div`
  position: relative;    
  overflow: hidden;      
  min-width: 350px;
  flex: 1 0 350px;
`

const DropDownNavTrack = styled.div`
  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;    
    opacity: 0;
    visibility: hidden;    
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
  }

  li {
    padding: 16px 0;
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
    //white-space: nowrap;      
    ${p => p.theme.mixins.linkFade()};

    color: ${p =>
      p.theme.mixins.acfColor('menu.color') ||
      p.theme.colors.white
    };

    ${p => p.theme.mixins.acfTypography('menu.desktop.regular')};    
  }

  a.is-active {
    color: ${p =>
      p.theme.mixins.acfColor('menu.accentColor') ||
      p.theme.mixins.acfColor('menu.color') ||
      p.theme.colors.white
    };  
  }

  .icon {
    font-size: 1.6rem;
    color: ${p =>
      p.theme.mixins.acfColor('menu.accentColor') ||
      p.theme.colors.white
    };
  }
`

const DropdownImage = styled.div`
  min-width: 350px;
  flex: 1 0 350px;
  margin: 0 0 0 40px;

  ${p => p.theme.media.minWidth('large')} {
    margin: 0 0 0 50px;  
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    margin: 0 0 0 72px;  
  }
`

const DropdownTitle = styled(H3)`
  margin: 12px 0 0 0;
  text-align: center;
  color: ${p =>
    p.theme.mixins.acfColor('menu.color') ||
    p.theme.colors.white
  };
`

export default DropdownMenu