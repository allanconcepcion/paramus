import { useEffect, useState } from 'react'
import styled from 'styled-components'

import Image from 'components/Image'
import Box from 'components/Box'
import { useMinWidth } from 'hooks/useMedia'

const WPImage = ({
  desktop,
  tablet,
  mobile,
  image,
  layout,
  fadeIn=true,
  ...props
}) => {
  const [loaded, setLoaded] = useState(false)  
  const [responsiveImage, setResponsiveImage] = useState(mobile || tablet || desktop || image)
  const isTablet = useMinWidth('tablet')
  const isDesktop = useMinWidth('desktop')

  useEffect(() => {
    if ( isTablet && tablet ) {
      setResponsiveImage(tablet)
    } else if ( isDesktop && desktop ) {
      setResponsiveImage(desktop)
    } else if ( mobile ) {
      setResponsiveImage(mobile)
    } else if ( image ) {
      setResponsiveImage(image)
    }
  }, [isTablet, isDesktop, desktop, tablet, mobile, image])

  const renderImage = () => {
    return responsiveImage && responsiveImage.sourceUrl ? (
      <ImageWrapper
          className={loaded ? 'is-loaded' : ''}
          $fadeIn={fadeIn}
          $background={fadeIn && responsiveImage.mimeType && responsiveImage.mimeType !== 'image/png'}
          $layout={layout}
      >                
        <Image
            src={responsiveImage.sourceUrl && typeof(responsiveImage.sourceUrl) === 'function' ? responsiveImage.sourceUrl() : responsiveImage.sourceUrl}
            srcSet={responsiveImage.srcSet && typeof(responsiveImage.srcSet) === 'function' ? responsiveImage.srcSet() : responsiveImage.srcSet}
            alt={responsiveImage.altText}
            width={layout === 'fill' ? undefined : (responsiveImage.mediaDetails.width || 0)}
            height={layout === 'fill' ? undefined : (responsiveImage.mediaDetails.height || 0)}
            layout={layout}
            onLoadingComplete={() => setLoaded(true)}
            {...props}
        />
      </ImageWrapper>
    ) : null
  }    

  return (
    layout === 'fill' ? renderImage() : (
      <Box width={responsiveImage.mediaDetails.width} height={responsiveImage.mediaDetails.height}>
        {renderImage()}
      </Box>
    )    
  )
}

const ImageWrapper = styled.div`
  ${p => p.$layout === 'fill' ? p.theme.mixins.fill('absolute') : ''};
  background-color: ${p => p.$background ? p.theme.colors.dkgray : 'transparent'};

  img {
    ${p => p.theme.mixins.fill('absolute')};
    object-fit: cover;
    transition: opacity 300ms ease-in-out;
    opacity: ${p => p.$fadeIn ? 0 : 1} !important;
  }

  img.lazyloaded {
    opacity: 1 !important;
  }
`

export const GQL_WP_IMAGE = `
  fragment WPImage on MediaItem {
    id
    altText    
    sourceUrl
    srcSet
    mimeType
    mediaDetails {
      height
      width
    }
  }
`

export default WPImage
