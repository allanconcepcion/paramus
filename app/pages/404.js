import styled from 'styled-components'
import get from 'lodash/get'

import PageTemplate from 'templates/Page'
import cms from 'lib/cms'
import { GQL_SEO } from 'components/SEO'
import { GQL_HEADER } from 'components/Header'
import { GQL_HERO } from 'components/modules/Hero'
import { GQL_MODULES } from 'components/Modules'
import { GQL_FOOTER } from 'components/Footer'
import { GQL_WP_IMAGE } from 'components/WPImage'

const Home = ({
  page
}) => {
  if ( !page ) {
    return (
      <NotFound>
        No 404 template found. Please create a page on your Wordpress site with the slug "404-not-found".
      </NotFound>
    )
  }
  
  return (
    <PageTemplate 
      page={page}
    />
  )
}

const NotFound = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
`

export async function getStaticProps ( context ) {
  const pageResponse = await cms(`
    ${GQL_SEO('Page')}    
    ${GQL_HEADER('Page')}
    ${GQL_HERO}
    ${GQL_MODULES}
    ${GQL_FOOTER('Page')}
    ${GQL_WP_IMAGE}
    query {      
      nodeByUri(uri: "/404-not-found") { 
        ... on Page {        
          ...PageSEO
          ...PageHeader
          ...Hero
          ...Modules
          ...PageFooter
        }      
      }      
    }
  `)  
  
  const page = get(pageResponse, 'data.nodeByUri')   
  
  return {
    props: {
      page
    },
    revalidate: 300
  }
}

export default Home
