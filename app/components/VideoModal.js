import { useContext, useState, useEffect, useRef } from 'react'
import styled from 'styled-components'
import ReactModal from 'react-modal'
import YouTubePlayer from 'react-youtube'
import VimeoPlayer from '@u-wave/react-vimeo'

import AppContext from 'contexts/App'
import { Icon } from 'components/SVGIcons'
import { scale } from 'utils/dom'

const VideoModal = ({
  ...props
}) => {
  const [ready, setReady] = useState(false)
  const [box, setBox] = useState({ width: 16, height: 9 })
  const contentRef = useRef()
  const boxRef = useRef()
  
  ReactModal.setAppElement('#__next')
  
  const {
    videoModalOpen,
    videoModalUrl,
    closeVideoModal
  } = useContext(AppContext)  

  useEffect(() => {
    setSize()
    
    window.addEventListener('resize', onWindowResize)

    if ( contentRef.current ) {
      contentRef.current.addEventListener('click', onContentClick)
    }

    return () => {
      window.removeEventListener('resize', onWindowResize)

      if ( contentRef.current ) {
        contentRef.current.removeEventListener('click', onContentClick)
      }
    }
  }, [box])

  const onReady = async ( e ) => {
    switch ( type(videoModalUrl) ) {
      case 'youtube':
        setBox(e.target.getSize())
        break
      case 'vimeo':
        const width = await e.getVideoWidth()
        const height = await e.getVideoHeight()
        const ratio = height/width
        if ( ratio < .3 ) {
          setBox({ width: 1920, height: 1080 })        
        } else {
          setBox({ width, height })        
        }        
        break
    } 
    
    setReady(true)
  }  

  const onWindowResize = () => {
    setSize()
  }

  const onContentClick = ( e ) => {
    closeVideoModal()    
  }

  const onCloseClick = () => {
    closeVideoModal()    
  }

  const onRequestClose = () => {
    closeVideoModal()    
  }

  const onEnd = () => {
    closeVideoModal()    
  }

  const getYouTubeIdFromUrl = ( url ) => {
    return url.match(/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/)[1]
  }

  const getVimeoIdFromUrl = ( url ) => {
    return url.match(/^(http\:\/\/|https\:\/\/)?(www\.)?(vimeo\.com\/)([0-9]+)$/)[4]
  }

  const type = ( url ) => {
    if ( /^(https?\:\/\/)?((www\.)?youtube\.com|youtu\.be)\/.+$/.test(url) ) {
      return 'youtube'
    } else if ( /^(http\:\/\/|https\:\/\/)?(www\.)?(vimeo\.com\/)([0-9]+)$/.test(url) ) {
      return 'vimeo'
    }
  }  

  const setSize = () => {
    if ( !boxRef.current ) {
      return 
    }    

    const { width, height } = scale('contain', {
      width: box.width || 1920, 
      height: box.height || 1080
    }, { 
      width: window.innerWidth > 1360 ? 1360 : (window.innerWidth - 40), 
      height: window.innerHeight * .9
    })    

    boxRef.current.style.width = `${width}px`
    boxRef.current.style.height = `${height}px`    
  }

  const renderPlayer = () => {      
    switch ( type(videoModalUrl) ) {
      case 'youtube':
        return (
          <YouTubePlayer            
              videoId={getYouTubeIdFromUrl(videoModalUrl)}
              opts={{
                playerVars: {
                  autoplay: 1,
                }
              }}
              onReady={onReady}
              onEnd={onEnd}
          />
        )
      case 'vimeo':
        return (
          <VimeoPlayer
            video={getVimeoIdFromUrl(videoModalUrl)}
            onReady={onReady}
            onEnd={onEnd}
            autoplay
          />
        )
    }
  }
  
  return (    
    <ReactModal    
        isOpen={!!videoModalOpen}
        onRequestClose={onRequestClose}
        contentElement={(props, children) => (
            <Content {...props} ref={contentRef}>{children}</Content>
          )}
        {...props}
    >
      <Player>     
        {ready && (
          <Close onClick={onCloseClick}>
            <Icon icon='close' />
          </Close>            
        )}
        <Box ref={boxRef}>
          {renderPlayer()}
        </Box>        
      </Player>
    </ReactModal>
  )
}

const Content = styled.div`
  display: flex;
  justify-content: center;
  margin: auto;
  max-width: 1400px; 
  overflow: visible !important;
`

const Box = styled.div``

const Player = styled.div`
  position: relative;  
  background-color: ${p => p.theme.colors.black};
 
  iframe {
    ${p => p.theme.mixins.fill('absolute')};
  }
`

const Close = styled.button`
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  top: -12px;
  right: -12px;
  color: ${p => p.theme.mixins.acfColor('components.videoModal.closeColor')}; 
  background-color: ${p => p.theme.colors.white};
  z-index: 2;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  font-size: 1rem;
  
  ${p => p.theme.media.minWidth('tablet')} {
    top: -17px;
    right: -17px;
    width: 35px;
    height: 35px;
    font-size: 1.4rem;  
  }  
`

export const GQL_CUSTOMIZE_VIDEO_MODAL = `
  fragment CustomizeVideoModal on Customize_Components {
    videoModal {
      closeColor
    }    
  }
`

export default VideoModal
