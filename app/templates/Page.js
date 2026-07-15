import Layout from 'layouts/App'
import SEO from 'components/SEO'
import Hero from 'components/modules/Hero'
import Modules from 'components/Modules'

const Page = ({   
  page,
  schema,  
}) => {                
  return (
    <Layout       
      page={page}
      schema={schema}
    >
      <SEO {...page.seo} />
      <Hero {...page.hero} />
      <Modules modules={page.pageContent.modules} /> 
    </Layout>   
  )
} 

export default Page