import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import { Row, Col } from 'components/Grid'
import WPImage from 'components/WPImage'
import { H6 } from 'components/Typography'
import Box from 'components/Box'
import { TextArrow } from 'components/Button'

const PostCond = ({
  title,
  featuredImage,
  uri
}) => {
  return (
    <S_PostCond>
      <Link href={uri || ''} scroll={false}>
        <a>
          <Row gutter={{ mb: .5 }} alignItems={{ mb: 'center' }}>
            {featuredImage?.node && (
               <Col mb={10}>
                 <Thumbnail>
                   <Box width={3} height={2}>
                     <WPImage
                         image={featuredImage.node}
                         layout='fill'
                         objectFit='cover'
                     />
                   </Box>
                 </Thumbnail>
               </Col>
             )}
            <Col mb={14}>
              <Title>{title}</Title>
              <TextArrow>Read More</TextArrow>
            </Col>
          </Row>
        </a>
      </Link>
    </S_PostCond>
  )
}

const S_PostCond = styled.div`
  margin: 0 0 40px 0;
`

const Title = styled(H6)`
  margin: 0 0 10px 0;

  ${p => p.theme.mixins.acfTypography('global.h6Mobile.light')} !important;
    
  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h6Desktop.light')} !important;
  }
`

const Thumbnail = styled.div``

export default PostCond
