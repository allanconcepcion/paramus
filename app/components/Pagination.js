import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import { Icon } from 'components/SVGIcons'
import { Container } from 'components/Grid'

const Pagination = ({
  pageInfo,
  basePath,
  className
}) => {
  const prevUrl = `${basePath || ''}/before/${pageInfo?.startCursor}`;
  const nextUrl = `${basePath || ''}/after/${pageInfo?.endCursor}`;
    
  return (
    <S_Pagination className={className}>
      <Container>
        <Nav>
          <ul>
            {pageInfo.hasPreviousPage && (
               <li>
                 <Link href={prevUrl} scroll={false}>
                   <a><Icon icon='arrow-left'/> <span>Prev</span></a>
                 </Link>
               </li>
             )}

            {pageInfo.hasPreviousPage && pageInfo.hasNextPage && (
               <li>/</li>
             )}
                  
            {pageInfo.hasNextPage && (
             <li>
               <Link href={nextUrl} scroll={false}>
                 <a><span>Next</span> <Icon icon='arrow-right'/></a>
               </Link>
             </li>
           )}      
          </ul>
        </Nav>
      </Container>
    </S_Pagination>
  )
}

const S_Pagination = styled.div`
  text-align: center;
`

const Nav = styled.nav`
  ${p => p.theme.mixins.acfTypography('components.pagination.mobile.regular')};
  
  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('components.pagination.mobile.regular')};
  }

  ul {
    display: flex;
    justify-content: center;
    margin: 0;
    padding: 0;
    list-style: none;
  }

  li {
    margin: 0 2px;
  }

  a {
    &:hover {
      span {
        text-decoration: underline;
      }
    }
  }

  span {
    display: inline-block;
    margin: 0 5px;
  }

  .icon {
    font-size: 1rem;
  }
`

export default Pagination
