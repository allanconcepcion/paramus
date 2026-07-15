import { useEffect, useContext, useRef } from 'react'
import Cookies from 'js-cookie'
import kebabCase from 'voca/kebab_case'

import Text, { GQL_CUSTOMIZE_TEXT_MODAL } from 'components/modals/Text'
import MediaText, { GQL_CUSTOMIZE_MEDIA_TEXT_MODAL } from 'components/modals/MediaText'
import LogoCarousel, { GQL_CUSTOMIZE_LOGO_CAROUSEL_MODAL } from 'components/modals/LogoCarousel'
import Media, { GQL_CUSTOMIZE_MEDIA_MODAL } from 'components/modals/Media'
import Form, { GQL_CUSTOMIZE_FORM_MODAL } from 'components/modals/Form'
import AppContext from 'contexts/App'

const Modals = ({
  page
}) => {      
  const delayRefs = useRef({})    

  const {
    openModalWithData,
    modalData,
    modalOpen,    
    customize
  } = useContext(AppContext)    

  const modals = customize?.modals.modals

  const onTriggerClick = ( e ) => {
    e.preventDefault()
    
    openModalWithData(e.currentTarget.modal)
  }

  const dismissed = ( modal ) => {
    return Cookies.get(`modal-${kebabCase(modal.id)}-dismissed`) === 'true'
  }

  const dismiss = ( modal ) => {
    Cookies.set(`modal-${kebabCase(modal.id)}-dismissed`, 'true', { expires: 1 })
  }

  const onWindowScroll = () => {
    const percent = (window.scrollY / (document.body.offsetHeight - window.innerHeight)) * 100
    
    modals.forEach(modal => {
      if ( modal?.triggerType === 'scrollPosition' ) {
        const activePage = modal.triggerPages.includes(page.databaseId?.toString()) || modal.triggerPages.length === 0

        if ( percent >= modal.triggerScrollPosition && !dismissed(modal) && activePage ) {
          openModalWithData(modal)
          dismiss(modal)
        }       
      }     
    })
  }

  // Setup "Click" and "Delay" trigger type events
  useEffect(() => {
    modals.forEach(modal => {
      switch ( modal?.triggerType ) {
        case 'click':                    
          document.querySelectorAll(`[href*="#modal-${modal.triggerHandle}"]`).forEach(node => {
            node.modal = modal
            node.addEventListener('click', onTriggerClick)
          })
          break
        case 'delay':          
          const activePage = modal.triggerPages.includes(page.databaseId?.toString()) || modal.triggerPages.length === 0

          if ( !dismissed(modal) && activePage ) {
            delayRefs.current[`${kebabCase(modal.id)}`] = setTimeout(() => {
              console.log(modal.triggerPages, page.databaseId)
              openModalWithData(modal)
              dismiss(modal)
            }, modal.triggerDelay * 1000)
          }          
          break
      }
    })

    return () => {
      modals.forEach(modal => {
        switch ( modal?.triggerType ) {
          case 'click':            
            document.querySelectorAll(`[href*="#modal-${modal.triggerHandle}"]`).forEach(node => {
              node.removeEventListener('click', onTriggerClick)
            })
            break
          case 'delay':
            clearTimeout(delayRefs.current[`${kebabCase(modal.id)}`])
            break
        }
      })     
    }
  }, [modals, delayRefs.current])

  // Setup "Scroll" trigger type events
  useEffect(() => {
    window.addEventListener('scroll', onWindowScroll)

    return () => {
      window.removeEventListener('scroll', onWindowScroll)
    }
  }, [modals, modalOpen])  
  
  const renderModal = () => {
    if ( modalOpen && modalData ) {            
      switch ( modalData.__typename ) {
        case 'Customize_Modals_Modals_Text':
          return (
            <Text />
          )
        case 'Customize_Modals_Modals_MediaText':
          return (
            <MediaText />
          )
        case 'Customize_Modals_Modals_LogoCarousel':          
          return (
            <LogoCarousel />
          )
        case 'Customize_Modals_Modals_Media':          
          return (
            <Media />
          )                    
        case 'Customize_Modals_Modals_Form':          
          return (
            <Form />
          )                              
      }      
    } else {
      return <></>
    }
  }
  
  return renderModal()
}

export const GQL_CUSTOMIZE_MODALS = `
  ${GQL_CUSTOMIZE_TEXT_MODAL}
  ${GQL_CUSTOMIZE_MEDIA_TEXT_MODAL}
  ${GQL_CUSTOMIZE_LOGO_CAROUSEL_MODAL}
  ${GQL_CUSTOMIZE_MEDIA_MODAL}
  ${GQL_CUSTOMIZE_FORM_MODAL}

  fragment CustomizeModals on Customize_Modals {
    modals {
      ...CustomizeTextModal
      ...CustomizeMediaTextModal
      ...CustomizeLogoCarouselModal
      ...CustomizeMediaModal
      ...CustomizeFormModal
    }
  }
`

export default Modals
