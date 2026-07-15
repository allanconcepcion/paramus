import styled from 'styled-components'

import Post from 'components/Post'
import Pagination from 'components/Pagination'
import { Container, Row, Col } from 'components/Grid'

const Posts = ({
  nodes,
  pageInfo,
  paginationBasePath=''
}) => {        
  return (    
    <S_Posts>
      <Container>
        <Row>          
          {nodes.map((post, k) => (
             <Col key={k} tb={12} dk={8}>
               <Post {...post} />
             </Col>
           ))}
        </Row>
      </Container>
      <Pagination pageInfo={pageInfo} basePath={paginationBasePath} />
    </S_Posts>
  )
}

const S_Posts = styled.div`
  margin: 50px 0;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 75px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 100px 0;
  }
`

export default Posts
