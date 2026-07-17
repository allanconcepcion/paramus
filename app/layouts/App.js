import { useContext, useRef, useEffect } from 'react'
import Head from 'next/head'
import { useRouter } from 'next/router'

import Header from 'components/Header'
import Menu from 'components/Menu'
import MobileMenu from 'components/MobileMenu'
import Footer from 'components/Footer'
import Modals from 'components/Modals'
import VideoModal from 'components/VideoModal'
import CookiesConsent from '../components/CookiesConsent'
import ThemeProvider from 'providers/Theme'
import AppContext from 'contexts/App'
import { safeHtmlParser, rewriteWpHost } from 'utils/dom'

const App = ({
  children,  
  page,
  schema  
}) => {  
  const {
    mounted,
    videoModalOpen,
  } = useContext(AppContext)
  
  const scrollTO = useRef()
  const router = useRouter()    
  
  const scrollToElement = (element, behavior='auto' ) => {
    if ( !element ) {
      return 
    }
    const header = document.querySelector('#header')
    const { height } = header.getBoundingClientRect()
    const { top } = element.getBoundingClientRect()    
    const marginTop = parseInt(getComputedStyle(element)?.marginTop?.replace('px', '')) || 0
        
    window.scrollTo({
      top: top + window.scrollY - height - marginTop, 
      behavior
    })        
  }

  const scrollToModule = ( index, behavior ) => {    
    const modules = document.querySelector('#modules')

    if ( !modules ) {
      return
    }

    scrollToElement(modules.childNodes[index], behavior)
  }

  const scrollToFooterCta = ( behavior ) => {    
    scrollToElement(document.querySelector('#_footer-cta'), behavior)
  }

  const onDocumentClick = ( e ) => {        
    if ( e.target.tagName !== 'A' && !e.target.closest('a') ) {
      return 
    }    

    let link = e.target.tagName === 'A' ? e.target : e.target.closest('a')    

    const moduleMatch = link.href.match(/#module-(\d+)/)

    if ( moduleMatch && moduleMatch[1] ) {
      const href = new URL(link.href)    

      if ( href.pathname === window.location.pathname ) {
        e.preventDefault()
        const index = parseInt(moduleMatch[1]) - 1      
        scrollToModule(index, 'smooth')        
      }            
    }    

    if ( link.href.match(/#footer-cta/) ) {
      const href = new URL(link.href)      
      
      if ( href.pathname === window.location.pathname ) {
        e.preventDefault()  
        scrollToFooterCta('smooth')        
      }            
    }    
  }

  useEffect(() => {
    if ( !mounted ) {
      return 
    }

    clearTimeout(scrollTO.current)

    const moduleMatch = router.asPath.match(/#module-(\d+)/)  
      
    if ( moduleMatch && moduleMatch[1] && mounted ) {
      const index = parseInt(moduleMatch[1]) - 1
      scrollTO.current = setTimeout(() => {        
        scrollToModule(index)
      }, 500)            
    } 
    
    const ctaMatch = router.asPath.match(/#footer-cta/)
    if ( ctaMatch ) {
      scrollTO.current = setTimeout(() => {        
        scrollToFooterCta()  
      }, 500)      
    }        
  }, [router.asPath, mounted])
  
  useEffect(() => {      
    document.addEventListener('click', onDocumentClick)
    
    return () => {      
      document.removeEventListener('click', onDocumentClick)
    }
  }, [mounted])  

  const onHashChangeStart = ( url ) => {    
    const moduleMatch = url.match(/#module-(\d+)/)    
    const ctaMatch = url.match(/#footer-cta/)
    
    if ( moduleMatch || ctaMatch ) {
      router.events.emit('routeChangeError')
      throw `Route change to "${url}" was aborted (this error can be safely ignored).`    
    }    
  }

  useEffect(() => {
    router.events.on('hashChangeStart', onHashChangeStart)    
    
    return () => {
      router.events.off('hashChangeStart', onHashChangeStart)  
    }
  }, [router.events])                  

  return (
    <ThemeProvider>
      {schema?.location === 'head' && (
        <Head>
          {safeHtmlParser(rewriteWpHost(schema.markup))}
        </Head>
      )}      
      <Header 
        page={page}        
      /> 
      <Menu page={page} />
      <MobileMenu />
      
      <main id="main">
        <div>
          {children}
        </div>
      </main>
      
      <Footer page={page} />      
      <Modals page={page} />
      {videoModalOpen && <VideoModal />}
      <CookiesConsent />
      {schema?.location === 'footer' && (      
                  safeHtmlParser(rewriteWpHost(schema.markup))
      )}
    </ThemeProvider>
  )  
}

export default App
