import { useEffect, useState, useRef } from 'react'
import styled from 'styled-components'

import { useMinWidth } from 'hooks/useMedia'

const WPVideo = ({
  desktop,
  tablet,
  mobile,
  video,  
  layout,
  objectFit,
  objectPosition, 
  autoplay=true
}) => {
  const [responsiveVideo, setResponsiveVideo] = useState(mobile || tablet || desktop || video)
  const isTablet = useMinWidth('tablet')
  const isDesktop = useMinWidth('desktop')
  const elRef = useRef()

  useEffect(() => {
    if ( isTablet && tablet ) {
      setResponsiveVideo(tablet)
    } else if ( isDesktop && desktop ) {
      setResponsiveVideo(desktop)
    } else if ( mobile ) {
      setResponsiveVideo(mobile)
    } else if ( video ) {
      setResponsiveVideo(video)
    }
  }, [isTablet, isDesktop, desktop, tablet, mobile, video])
  
  return (
    <Video
        ref={elRef}
        src={responsiveVideo.mediaItemUrl}
        $layout={layout}
        $objectFit={objectFit}
        $objectPosition={objectPosition}
        muted autoPlay={autoplay || undefined} playsInline loop        
        onPlaying={(e) => {
          e.target.classList.add('is-playing')
        }}
    />
  )
}

const Video = styled.video`
  ${p => p.$layout === 'fill' && p.theme.mixins.fill('absolute')};
  object-fit: ${p => p.$objectFit || 'contain'};
  object-position: ${p => p.$objectPosition || 'center'};
`

export const GQL_CUSTOMIZE_VIDEO = `
  fragment CustomizeVideo on Customize_Components {
    video {
      accentColor
    }
  }
`

export default WPVideo
