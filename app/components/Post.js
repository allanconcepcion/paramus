import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import { DateTime } from 'luxon'

import { H6, Rte } from 'components/Typography'
import WPImage from 'components/WPImage'
import Box from 'components/Box'
import { TextArrow } from 'components/Button'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'

const Post = ({
  title,
  excerpt,
  featuredImage,
  date,
  uri
}) => {
  return (
    <S_Post>      
      <Link href={uri || ''} scroll={false}>
        <a>
          {featuredImage?.node && (
             <Thumbnail>
               <Box width={7} height={5}>
                 <WPImage
                     image={featuredImage.node}
                     layout='fill'
                     objectFit='cover'
                 />
               </Box>
             </Thumbnail>
           )}      
          <Title>{title}</Title>
          {excerpt && (
             <Excerpt dangerouslySetInnerHTML={{ __html: excerpt }} />
           )}
          <Cta>Read More</Cta>
          <Date>{DateTime.fromISO(date).toLocaleString(DateTime.DATE_FULL)}</Date>
        </a>
      </Link>
    </S_Post>
  )
}

const S_Post = styled.div`
  text-align: center;
  margin: 0 0 50px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 60px 0;
  }
`

const Title = styled(H6)`
  margin: 0 0 12px 0;
`

const Excerpt = styled(Rte)`
  margin: 0 0 12px 0;
`

const Thumbnail = styled.div`
  margin: 0 0 20px 0;
  width: 100%;
  ${p => p.theme.mixins.linkZoomImg()};
`

const Cta = styled(TextArrow)`
  margin: 0 0 12px 0;

  span:nth-child(1):after {
    display: none;
  }

  ${p => p.theme.mixins.linkFade()};
`

const Date = styled.div`
  margin: auto 0 0 0;
  padding: 3px 0;
  border-top: solid 1px;
  border-bottom: solid 1px;
  border-color: ${p => p.theme.mixins.acfColor('components.post.dateBorderColor')}; 
  width: 100%;

  ${p => p.theme.mixins.acfTypography('components.post.mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('components.post.desktop.regular')};
  }
`

export const GQL_CUSTOMIZE_POST = `
  fragment CustomizePost on Customize_Components {
    post {
      dateBorderColor      
      authorEnabled
      authorCtaBody
      authorColor
      authorBackgroundColor
      authorCtaEnabled
      authorCtaColor
      authorCtaBackgroundColor
      authorCtaColorHover
      authorCtaBackgroundColorHover
      authorCtaLink {
        target
        title
        url
      }
      desktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      mobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
    }    
  }
`

export default Post
