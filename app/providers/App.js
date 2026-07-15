import { useState, useEffect } from 'react'
import { useRouter } from 'next/router'

import AppContext from 'contexts/App'

const App = ({
  children,  
  ...props
}) => {      
  const router = useRouter()
  const [mounted, setMounted] = useState(false)
  const [loaded, setLoaded] = useState(false)  
  const [menuOpen, setMenuOpen] = useState(false)
  
  const [videoModalUrl, openVideoModalByUrl] = useState(false)
  const [videoModalOpen, setVideoModalOpen] = useState(false)

  const [modalData, openModalWithData] = useState(false)
  const [modalOpen, setModalOpen] = useState(false)  

  const routeChangeStart = () => {
    setModalOpen(false)
  }

  const routeChangeComplete = () => {
    setMenuOpen(false)    
  }
  
  const closeVideoModal = () => {
    setVideoModalOpen(false)
  }

  const closeModal = () => {
    setModalOpen(false)
  }

  useEffect(() => {
    if ( videoModalUrl ) {
      setVideoModalOpen(true)
    }    
  }, [videoModalUrl])

  useEffect(() => {
    if ( !videoModalOpen ) {
      openVideoModalByUrl(false)
    }
  }, [videoModalOpen])

  useEffect(() => {
    if ( modalData ) {
      setModalOpen(true)
    }
  }, [modalData])

  useEffect(() => {
    if ( !modalOpen ) {
      openModalWithData(false)
    }
  }, [modalOpen])

  useEffect(() => {
    router.events.on('routeChangeStart', routeChangeStart)
    router.events.on('routeChangeComplete', routeChangeComplete)
        
    return () => {
      router.events.off('routeChangeStart', routeChangeStart)
      router.events.off('routeChangeComplete', routeChangeComplete)
    }
  }, [router.events])
  
  useEffect(() => {
    setMounted(true)
  }, [])

  return (    
    <AppContext.Provider
      value={{
        mounted,
        loaded,
        setLoaded,
        menuOpen,
        setMenuOpen,
        
        openVideoModalByUrl,
        closeVideoModal,        
        videoModalOpen,
        videoModalUrl,
               
        openModalWithData,
        closeModal,
        modalOpen,
        modalData,                
       
        ...props
      }}
    >      
      {children}             
    </AppContext.Provider>
  )
}

export default App
