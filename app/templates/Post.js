import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import Layout from 'layouts/App'
import SEO from 'components/SEO'
import Hero from 'components/modules/Hero'
import Headline from 'components/Headline'
import { Container, Row, Col } from 'components/Grid'
import { Rte, H4 } from 'components/Typography'
import PostCond from 'components/PostCond'
import WPImage from 'components/WPImage'
import Image from 'components/Image'
import { DateTime } from 'luxon'
import AppContext from 'contexts/App'
import Box from 'components/Box'
import { nl2br } from 'utils/dom'

const Post = ({   
  page,
  post, 
  recentPosts,   
  schema, 
  categories
}) => {        
  const { customize } = useContext(AppContext)
  
  return (
    <Layout
      page={page}
      schema={schema}      
    >
      <SEO {...post.seo} />
      <Hero 
        {...page.hero} 
        height='auto' 
        copyFormat='paragraph'
      />
      <Container>
        <S_Post>
          <Row gutter={{ dk: 3, lg: 3, xl: 3 }}>
            <Col tb={16} dk={16}>
              <Headline
                text={post.title || ''}
                align='left'
                as='h1'
              />
              <Meta>
                <Rte>
                  <p>
                  {post.categories?.nodes.length > 0 && (
                    <>
                      Posted in <Link href={post.categories?.nodes[0].link}>{post.categories?.nodes[0].name}</Link><br />
                    </>                  
                  )}
                  {post.author?.node && (
                    <>
                      Posted on {DateTime.fromISO(post.date).toLocaleString(DateTime.DATE_FULL)} by {post.author.node.name}
                    </>                  
                  )}              
                  </p>                          
                </Rte>
              </Meta>
                                          
              {post.featuredImage?.node && (
                <FeaturedImage>
                  <WPImage
                    image={post.featuredImage.node}                     
                    objectFit='cover'
                 />
                </FeaturedImage>                              
              )} 
              <Body dangerouslySetInnerHTML={{ __html: post.content }} />

              {customize.components.post.authorEnabled && (
                <AuthorWidget>
                  <Row
                    alignItems={{ mb: 'center' }}
                  >
                    <Col
                      dk={10}
                      lg={8}
                    >
                      <AuthorAvatarName>
                        <AuthorAvatar>
                          <Box>
                            <Image 
                              src={post.author?.node.avatar.url}                        
                            /> 
                          </Box>                        
                        </AuthorAvatar>   
                        <AuthorName>
                          {post.author?.node.name}
                        </AuthorName>                   
                      </AuthorAvatarName>                      
                    </Col>
                    <Col
                      dk={14}
                      lg={16}
                    >
                      <Rte 
                        dangerouslySetInnerHTML={{ __html: nl2br(post.author?.node.description) }}
                      />                                            
                    </Col>
                  </Row>
                  {customize.components.post.authorCtaEnabled && (
                    <AuthorCta>
                      {customize.components.post.authorCtaBody && (
                        <Rte>
                          <p 
                            dangerouslySetInnerHTML={{ __html: nl2br(customize.components.post.authorCtaBody) }}
                          />                            
                        </Rte>                        
                      )}
                      {customize.components.post.authorCtaLink?.url && (
                        <Link href={customize.components.post.authorCtaLink.url}>
                          <AuthorCtaButton>                          
                            {customize.components.post.authorCtaLink.title}                         
                          </AuthorCtaButton>
                        </Link>                        
                      )}                      
                    </AuthorCta>
                  )}
                </AuthorWidget>
              )}
            </Col>
            <Col tb={8} dk={8}>
              <RecentPosts>
                <SidebarTitle>Recent Posts</SidebarTitle>
                {recentPosts.nodes.map((post, k) => (
                   <PostCond {...post} key={k} />
                 ))}
              </RecentPosts>

              <Categories>
                <SidebarTitle>Categories</SidebarTitle>
                <CategoriesList>
                  <ul>
                    {categories.nodes.map((category, k) => (
                       <li key={k}>
                         <Link href={category.uri || ''}>
                           <a>{category.name}</a>
                         </Link>
                       </li>
                     ))}
                  </ul>
                </CategoriesList>
              </Categories>
            </Col>
          </Row>
        </S_Post>
      </Container>        
    </Layout>
  )
}

const S_Post = styled.div`
  position: relative;
  padding: 50px 0;

  &:before {
    display: none;
    position: absolute;
    top: 0;
    left: calc(66.666% + 20px);
    content: '';
    width: 1px;
    height: 100%;
    background-color: ${p => p.theme.colors.ltgray};

    ${p => p.theme.media.minWidth('tablet')} {
      display: block;
      left: calc(66.666% + 5px);
    }

    ${p => p.theme.media.minWidth('desktop')} {
      left: calc(66.666% + 15px);
    }

    ${p => p.theme.media.minWidth('large')} {
      left: calc(66.666% + 15px);
    }

    ${p => p.theme.media.minWidth('xlarge')} {
      left: calc(66.666% + 20px);
    }
  }

  ${p => p.theme.media.minWidth('tablet')} {
    padding: 75px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 100px 0;
  }
`

const Meta = styled.div`
  margin: 0 0 2em 0;

  p {
    line-height: 1.5;
  }  
`

const FeaturedImage = styled.div`
  margin: 0 0 40px 0;
`

const Body = styled(Rte)`
  margin: 0 0 50px 0;
`

const SidebarTitle = styled(H4)`
  margin: 0 0 30px 0;
`

const RecentPosts = styled.div`
  margin: 0 0 50px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 75px 0;
  }
`

const Categories = styled.div``

const CategoriesList = styled(Rte)`
  li {
    line-height: 1.2;
  }

  a {
    ${p => p.theme.mixins.linkDecoration()};
    text-decoration: none !important;
    color: inherit !important;
  }
`

const AuthorWidget = styled.div`
  margin: 32px 0;
  padding: 32px 24px;

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 48px 32px;
  }

  color: ${p =>
    p.theme.mixins.acfColor('components.post.authorColor') ||
    p.theme.colors.white
  };
  background-color: ${p =>
    p.theme.mixins.acfColor('components.post.authorBackgroundColor') ||
    p.theme.colors.black
  };
`

const AuthorAvatarName = styled.div`
  text-align: center;
  margin: 0 auto 32px auto;
  max-width: 300px;
`

const AuthorAvatar = styled.div`
  position: relative;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 0 16px 0;

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
`

const AuthorName = styled.div`
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.regular')};
      
  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.regular')};
  }
`

const AuthorCta = styled.div`
  margin: 32px 0 0 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  
  p {
    font-weight: 500;
  }
`

const AuthorCtaButton = styled.a`    
  display: inline-block;
  border-radius: 2px;
  margin: 32px 0 0 0;
  padding: 16px 24px;    
  transition: 
    color 300ms ease, 
    background-color 300ms ease
  ;    

  ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
  }

  color: ${p =>
    p.theme.mixins.acfColor('components.post.authorCtaColor') ||
    p.theme.colors.black
  };
  background-color: ${p =>
    p.theme.mixins.acfColor('components.post.authorCtaBackgroundColor') ||
    p.theme.colors.white
  };

  @media(hover:hover) {
    &:hover {
      color: ${p =>
        p.theme.mixins.acfColor('components.post.authorCtaColorHover') ||
        p.theme.colors.black
      };
      background-color: ${p =>
        p.theme.mixins.acfColor('components.post.authorCtaBackgroundColorHover') ||
        p.theme.colors.white
      };
    }
  }

  font-weight: 500 !important;
`

export default Post