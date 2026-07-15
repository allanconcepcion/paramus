import get from 'lodash/get'

import PageTemplate from 'templates/Page'
import { GQL_SEO } from 'components/SEO'
import { GQL_HEADER } from 'components/Header'
import { GQL_HERO } from 'components/modules/Hero'
import { GQL_MODULES } from 'components/Modules'
import { GQL_FOOTER } from 'components/Footer'

import cms from 'lib/cms'

const Home = ({
  page,  
  schema,   
}) => {      
  return (
    <PageTemplate       
      page={page}
      schema={schema}            
    />
  )
}

export async function getStaticProps ( context ) {
  const nodeResponse = await cms(`
    query {
      node: nodeByUri(uri: "home") {
        ... on Page {
          databaseId
        }        
      }
    }    
  `)

  const node = get(nodeResponse, 'data.node') 
    
  const pageResponse = await cms(`
    ${GQL_SEO('Page')}
    ${GQL_HERO}
    ${GQL_MODULES}
    ${GQL_HEADER('Page')}
    ${GQL_FOOTER('Page')}

    query(
      $id: ID!, 
      $pageId: Int, 
      $asPreview: Boolean
    ) {      
      page(
        id: $id, 
        idType: DATABASE_ID, 
        asPreview: $asPreview
      ) {                
        ... on Page {     
          databaseId   
          ...PageSEO
          ...PageHeader
          ...Hero
          ...Modules
          ...PageFooter
        }      
      }

      schema: schemaPro(
        postId: $pageId
      ) {
        location
        markup
      }
    }
  `, {
    id: node.databaseId, 
    pageId: node.databaseId, 
    asPreview: !!context.preview
  }, !!context.preview)             
  
  const page = get(pageResponse, 'data.page')      
  const schema = get(pageResponse, 'data.schema')      
   
  return {
    props: {
      page, 
      schema
    },
    revalidate: 60
  }  
}

export default Home
