const Image = ({
  src,
  srcSet,
  lazy=true,
  webp=true,
  ...props
}) => {
  let optimized = !props.optimized

  optimized = false
  
  const { NEXT_PUBLIC_DOCKER_WORDPRESS_URL } = process.env
  const prefix = lazy ? 'data-' : ''  

  let safeSrc = src
  
  if ( 
    safeSrc && 
    process.env.NODE_ENV === 'development' && 
    NEXT_PUBLIC_DOCKER_WORDPRESS_URL && 
    optimized
  ) {  
    try {      
      const safeSrcUrl = new URL(safeSrc)
      const replaceUrl = new URL(NEXT_PUBLIC_DOCKER_WORDPRESS_URL)
      safeSrc = safeSrc.replace(safeSrcUrl.hostname, replaceUrl.hostname)
      safeSrc = safeSrc.replace(safeSrcUrl.port, replaceUrl.port)      
    } catch ( e ) {
      console.error(e)
    }        
  }

  const webpAttrs = {
    [`${prefix}src`]: `${safeSrc}.webp`,     
    [`${prefix}src${prefix ? 's' : 'S'}et`]: srcSet?.replace(/(\.(png|jpg|jpeg))/g, (a, b) => {
      return `${b}.webp`
    })
  }

  const imgAttrs = {
    [`${prefix}src`]: safeSrc, 
    [`${prefix}src${prefix ? 's' : 'S'}et`]: srcSet,
  }
  
  return (
    webp ? (
      <picture>
        <source
          {...webpAttrs}
          sizes='100vw'
          type='image/webp'
        />
        <img
          className={lazy ? 'lazy lazyload' : ''}
          src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='
          {...imgAttrs}            
          alt={props.alt}
        />
      </picture>    
    ) : (
      <img
        className={lazy ? 'lazy lazyload' : ''}
        src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='
        {...imgAttrs}            
        alt={props.alt}
      />
    )    
  )
}

export default Image
