import { useContext } from 'react'
import Head from 'next/head'

import { safeHtmlParser } from 'utils/dom'
import AppContext from 'contexts/App'

const SEO = ({
  title,
  metaDesc,
  fullHead, 
  metaRobotsNoindex,
  metaRobotsNofollow,  
}) => {  
  const { customize } = useContext(AppContext)        

  let robots = `${metaRobotsNoindex},${metaRobotsNofollow}${metaRobotsNoindex === 'index' ? ',max-snippet:-1,max-image-preview:large,max-video-preview:-1': ''}`

  return (
    <>
    <Head>      
      {customize?.seo.favicon?.sourceUrl && (
         <link rel='icon' type='image/png' href={customize?.seo.favicon.sourceUrl} />      
       )}
      <title>{title}</title>
      <meta name='robots' content={robots} />
      <meta name='description' content={metaDesc} />          
      {safeHtmlParser(fullHead)}       
    </Head>    
    </>
  )
}

export const GQL_SEO = ( type ) => `
  fragment ${type || ''}SEO on ${type} {
    seo {
      title
      metaDesc
      fullHead
      metaRobotsNoindex
      metaRobotsNofollow      
    }
  }  
`

export const GQL_CUSTOMIZE_SEO = `
  fragment CustomizeSEO on Customize {
    seo {
      favicon {
        sourceUrl
      }
      footerHtml
      gtmContainers {
        id
      }            
      headerHtml
    }
  }  
`

export default SEO