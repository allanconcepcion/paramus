import Layout from 'layouts/App'
import SEO from 'components/SEO'
import Hero from 'components/modules/Hero'
import Modules from 'components/Modules'
import Posts from 'components/Posts'

const PostsPaginated = ({  
  page,
  posts,     
  schema,
  paginationBasePath=''
}) => {    
  return (    
    <Layout 
      page={page}
      schema={schema}                
    >
      <SEO {...page.seo} />
      <Hero {...page.hero} />
      {page.pageContent.modules && (
        <Modules modules={page.pageContent.modules} /> 
      )}
      <Posts {...posts} paginationBasePath={paginationBasePath} />
    </Layout>   
  )
}

export default PostsPaginated