import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import { Container, Row, Col } from 'components/Grid'
import Headline from 'components/Headline'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Rte } from 'components/Typography'
import { useMinWidth } from 'hooks/useMedia'
import AppContext from 'contexts/App'
import { Cta as CtaButton } from 'components/Button'

const Cta = ({
  format,
  headline,
  headlineTag,
  body,
  image,
  cta,
  color,
  backgroundColor,
  ctaIconColor,
  ctaIconBackground,
  ctaIconBorder,
  ctaIconColorHover,
  ctaIconBackgroundHover,
  ctaIconBorderHover, 
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const isTablet = useMinWidth('tablet')    
  const { mounted } = useContext(AppContext)
  
  return (
    <S_Cta
      $color={color}
      $backgroundColor={backgroundColor}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
    >
      <Container>
        <Row
          alignItems={{ tb: 'center' }}
          gutter={{ dk: 2 }}
        >
          <Col
            tb={format === 'mini' ? 15 : 12}
            dk={format === 'mini' ? 18 : 12}
          >
            {format === 'mini' && (
               <Headline
                text={headline}
                as={headlineTag}
                align={mounted && isTablet ? 'left' : 'center'}
                underline={false}
                margin={false}
              />
            )}      
            {format === 'full' && image && (
              <Media>
                <WPImage
                  image={image}
                  layout='responsive'
                />
              </Media>
            )}     
          </Col>
          
          <Col
            tb={format === 'mini' ? 9 : 12}
            dk={format === 'mini' ? 6 : 12}
          >
            {format === 'full' && (
              <Headline
                text={headline}
                align={mounted && isTablet ? 'left' : 'center'}
              />
            )}

            {format === 'full' && body && (
              <Body dangerouslySetInnerHTML={{ __html: body }} />
            )}      
      
            {cta && (
              <Link href={cta.url || ''} passHref>
                <S_CtaButton
                  link
                  target={cta.target}
                  iconColor={ctaIconColor}
                  iconBackground={ctaIconBackground}
                  iconBorder={ctaIconBorder}
                  iconColorHover={ctaIconColorHover}
                  iconBackgroundHover={ctaIconBackgroundHover}
                  iconBorderHover={ctaIconBorderHover}
                  $format={format}
                >
                  {cta.title}
                </S_CtaButton>
              </Link>
            )}            
          </Col>
        </Row>
      </Container>
    </S_Cta>
  )
}

const S_Cta = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  background-color: ${p => p.theme.mixins.acfColor(p.$backgroundColor)};
  color: ${p => p.theme.mixins.acfColor(p.$color)};
  padding: 75px 0;
  text-align: center;

  ${p => p.theme.media.minWidth('tablet')} {
    text-align: left;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
  }  
`

const Media = styled.div`
  margin: 0 0 50px 0;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0;
  }
`

const Body = styled(Rte)``

const S_CtaButton = styled(CtaButton)`
  margin: 40px 0 0 0;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: ${p => p.$format === 'mini' ? 0 : 40}px 0 0 0;
  }
`

export const GQL_CTA_MODULE = `
  ${GQL_WP_IMAGE}

  fragment CtaModule on Page_Pagecontent_Modules_Cta {
    backgroundColor
    body
    color
    cta {
      target
      title
      url
    }    
    ctaIconBackground
    ctaIconBackgroundHover
    ctaIconBorder
    ctaIconBorderHover
    ctaIconColor
    ctaIconColorHover
    fieldGroupName
    format
    headline
    headlineTag
    image {
      ...WPImage
    }    
    visibleOnDesktop
    visibleOnMobile
  }
`

export default Cta
