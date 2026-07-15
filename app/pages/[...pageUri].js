import compact from 'lodash/compact'
import get from 'lodash/get'

import PageTemplate from 'templates/Page'
import PostTemplate from 'templates/Post'
import PostsPaginated from 'templates/PostsPaginated'
import { GQL_SEO } from 'components/SEO'
import { GQL_HEADER } from 'components/Header'
import { GQL_HERO } from 'components/modules/Hero'
import { GQL_MODULES } from 'components/Modules'
import { GQL_FOOTER } from 'components/Footer'
import { GQL_WP_IMAGE } from 'components/WPImage'
import cms from 'lib/cms'

const Page = ({
  pageType, 
  page, 
  post,
  posts,
  recentPosts, 
  categories,   
  schema,
  paginationBasePath,    
}) => {          
  switch ( pageType ) {
    case 'Page':      
      return (
        <PageTemplate         
          page={page}
          schema={schema}          
        />  
      )
    case 'Post':    
      return (
        <PostTemplate 
          page={page}
          post={post}
          schema={schema}          
          recentPosts={recentPosts}           
          categories={categories}        
        />
      )
    case 'PostsPaginated':      
      return (
        <PostsPaginated 
          page={page}          
          schema={schema}                  
          posts={posts}            
          paginationBasePath={paginationBasePath}
        /> 
      )    
  }     
}

export async function getStaticPaths() {
  const pagesResponse = await cms(`
    query {
      pages(first: 1000) {
        nodes { uri }
      }
    }
  `)

  const pages = get(pagesResponse, 'data.pages.nodes')    

  const pagePaths = compact(pages.map(node => node.uri !== '/' && node.uri))
    .map(uri => ({ params: { pageUri: compact(uri.split('/')) }}))  

  const postsResponse = await cms(`
    query {
      posts(first: 1000) {
        nodes { uri }
      }
    }
  `)

  const posts = get(postsResponse, 'data.posts.nodes')  

  const postPaths = compact(posts.map(node => node.uri))
    .map(uri => ({ params: { pageUri: compact(uri.split('/')) }}))  
  
  return { 
    paths: [
      ...pagePaths, 
      ...postPaths
    ], 
    fallback: 'blocking' 
  }
}

const getPageByUri = async ( uri, asPreview ) => {
  const nodeResponse = await cms(`
    query(
      $uri: String!
    ) {
      node: nodeByUri(uri: $uri) {
        ... on Page { databaseId }                  
      }    
    }      
  `, {
    uri
  })

  const node = get(nodeResponse, 'data.node')    

  return getPageById(node.databaseId, asPreview)
}

const getPageById = async ( id, asPreview ) => {
  return cms(`
    ${GQL_SEO('Page')}
    ${GQL_HEADER('Page')}
    ${GQL_HERO}    
    ${GQL_MODULES}
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
        databaseId
        ...PageSEO
        ...PageHeader
        ...Hero   
        ...Modules
        ...PageFooter       
      } 
      
      schema: schemaPro(
        postId: $pageId
      ) {
        location
        markup
      }
    }      
  `, {
    id: id, 
    pageId: id, 
    asPreview
  }, asPreview) 
}

export async function getStaticProps ( context ) { 
  // Establish page type and variables  
  const nodeResponse = await cms(`
    query(
      $uri: String!
    ) {
      readingSettings {
        postsPerPage
      }
      permalinkSettings {
        categoryBase
      }
      node: nodeByUri(uri: $uri) {
        ... on Page {
          databaseId
          contentTypeName
          isPostsPage
        }        
        ... on Post {
          databaseId
          contentTypeName
        }        
      }
    }    
  `, {
    uri: context.params.pageUri.join('/')
  })

  const node = get(nodeResponse, 'data.node')
  const permalinkSettings = get(nodeResponse, 'data.permalinkSettings')
  const readingSettings = get(nodeResponse, 'data.readingSettings')
  const isCategory = context.params.pageUri[0] === (permalinkSettings.categoryBase || 'category')
  const isBefore = context.params.pageUri[isCategory ? 2 : 0] === 'before'
  const isAfter = context.params.pageUri[isCategory ? 2 : 0] === 'after'
  const isPaginatedPage = isBefore || isAfter 
  const isPostsPage = node?.isPostsPage

  // Blog page
  if ( isPostsPage || isCategory || isPaginatedPage ) {  
    const pageResponse = await getPageByUri('blog', !!context.preview)          
    const postsResponse = await cms(`
      ${GQL_WP_IMAGE}

      query(
        $after: String, 
        $before: String, 
        $first: Int, 
        $last: Int, 
        $where: RootQueryToPostConnectionWhereArgs
      ) {
        posts(
          after: $after, 
          before: $before, 
          first: $first, 
          last: $last, 
          where: $where
        ) {
          nodes {
            id
            title
            uri
            excerpt
            date
            featuredImage {
              node {
                ...WPImage
              }            
            }          
          } 
          pageInfo {
            startCursor
            endCursor 
            hasNextPage
            hasPreviousPage
          }       
        }
      }
    `, {
      after: !isBefore ? (context.params.pageUri[isCategory ? 3 : 1]) : undefined,
      before: isBefore ? (context.params.pageUri[isCategory ? 3 : 1]) : undefined,
      first: !isBefore ? readingSettings.postsPerPage : undefined,
      last: isBefore ? readingSettings.postsPerPage : undefined,
      where: isCategory ? { categoryName: context.params.pageUri[1] } : undefined
    })    

    return {
      props: {
        pageType: 'PostsPaginated', 
        page: get(pageResponse, 'data.page'),         
        schema: get(pageResponse, 'data.schema'), 
        posts: get(postsResponse, 'data.posts'),
        paginationBasePath: isCategory ? (context.params.pageUri.slice(0,2).join('/')) : null
      }, 
      revalidate: 60
    }
  }

  // Any page
  if ( node?.contentTypeName === 'page' ) {    
    const pageResponse = await getPageById(node.databaseId, !!context.preview) 

    return {
      props: {
        pageType: 'Page', 
        page: get(pageResponse, 'data.page'), 
        schema: get(pageResponse, 'data.schema')
      }, 
      revalidate: 60
    }
  }

  // Post 
  if ( node?.contentTypeName === 'post' ) {    
    const pageResponse = await getPageByUri('blog', !!context.preview)

    const postResponse = await cms(`   
      ${GQL_WP_IMAGE}
      ${GQL_SEO('Post')} 

      query(
        $id: ID!, 
        $postId: Int, 
        $asPreview: Boolean
      ) {
        post(
          id: $id, 
          idType: DATABASE_ID, 
          asPreview: $asPreview
        ) {
          ...PostSEO
          title
          categories {
            nodes {
              id
              name
              link
            }
          }
          author {
            node {
              name
              description  
              avatar(size: 400) {
                url              
                width
                height
              }            
            }
          }
          date
          content
          featuredImage {
            node {
              ...WPImage
            }
          }
        } 
        
        schema: schemaPro(
          postId: $postId
        ) {
          location
          markup
        }

        recentPosts: posts(first: 4) {
          nodes {
            id
            title
            uri
            featuredImage {
              node {
                ...WPImage
              }
            }
          }
        }
        categories {
          nodes {
            uri
            name
          }
        }
      }
    `, {
      id: node.databaseId, 
      postId: node.databaseId, 
      asPreview: !!context.preview
    }, !!context.preview)                

    return {
      props: {
        pageType: 'Post', 
        page: get(pageResponse, 'data.page'), 
        post: get(postResponse, 'data.post'),
        schema: get(postResponse, 'data.schema'), 
        recentPosts: get(postResponse, 'data.recentPosts'), 
        categories: get(postResponse, 'data.categories')
      }, 
      revalidate: 60
    }    
  }  

  return {
    notFound: true, 
    revalidate: 60
  }
}

export default Page