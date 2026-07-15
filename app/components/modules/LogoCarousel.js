import styled from 'styled-components'
import Slider from 'react-slick'

import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Container, Row, Col } from 'components/Grid'
import Box from 'components/Box'

const LogoCarousel = ({
  logos,
  logoRatioWidth,
  logoRatioHeight, 
  format, 
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const max = logos.length
  
  const settings = {    
    slidesToShow: max >= 5 ? 5 : max,
    slidesToScroll: max >= 5 ? 5 : max,
    dots: true,
    arrows: false,
    variableWidth: max >= 5 ? false : true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: max >= 2 ? 2 : max,
          slidesToScroll: max >= 2 ? 2 : max,
          variableWidth: false,
        }
      }
    ]
  }

  const renderLogo = (logo) => {
    return (
      <Logo $format={format}>
        <Box
          width={logoRatioWidth}
          height={logoRatioHeight}
        >
          <WPImage
            image={logo}
            layout='fill'
            objectFit='contain'
          />
        </Box>
      </Logo>
    )
  }

  const renderCarousel = () => {
    return (
      <Carousel {...settings}>
        {logos?.map((logo, k) => (
          <Slide 
            $max={max} 
            key={k}
          >
            {renderLogo(logo)}
          </Slide>
        ))}
      </Carousel>
    )
  }

  const renderGrid = () => {
    return (
      <Grid
        justifyContent={{
          mb: 'center'
        }}
      >
        {logos?.map((logo, k) => (
          <Col mb={12} mblg={8} tb={6} dk={4} key={k}>
            {renderLogo(logo)}
          </Col>          
        ))}
      </Grid>
    )
  }
  
  return (
    <S_LogoCarousel 
      $max={max}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
    >
      <Container
          padding={{ dk: 6 }}
          maxWidth={false}
      >
        {format === 'carousel' ? renderCarousel() : renderGrid()}        
      </Container>      
    </S_LogoCarousel>
  )
}

const S_LogoCarousel = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  margin: 50px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    margin: 60px 0;
  }

  .slick-track {
    ${p => p.theme.media.minWidth('tablet')} {      
      display: ${p => p.$max >= 5 ? 'block' : 'flex'};
      justify-content: center;
    }
  }

  .slick-dots {
    margin: 30px 0 0 0;
    padding: 0;
    list-style: none;
    text-align: center;

    ${p => p.theme.media.minWidth('desktop')} {
      margin: 50px 0 0 0;
    }
  }

  .slick-dots li {
    display: inline-block;
    margin: 0 3px;
  }

  .slick-dots li button {
    width: 8px;
    height: 8px;
    color: transparent;
    font-size: 0;
    border-radius: 50%;
    background-color: ${p => p.theme.colors.ltgray};
    transition: background-color 300ms ease;
  }

  .slick-dots li.slick-active button {
    background-color: ${p => p.theme.colors.gray};    
  }
`

const Carousel = styled(Slider)``

const Slide = styled.div`
  padding: 0 20px;

  ${p => p.theme.media.minWidth('tablet')} {
    width: ${p => p.$max >= 5 ? 'auto' : '230px !important'};
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 0 30px;
  }
`

const Grid = styled(Row)`
  margin: 0;
  display: flex;
`

const Logo = styled.div`
  max-width: 150px;
  margin: 0 auto ${p => p.$format === 'grid' ? 24 : 0}px auto;

  ${Col}:nth-last-child(-n+2) & {
    margin-bottom: 0;
  }

  ${p => p.theme.media.minWidth('mobile-large')} {
    ${Col}:nth-last-child(-n+3) & {
      margin-bottom: 0;
    } 
  }

  ${p => p.theme.media.minWidth('tablet')} {
    ${Col}:nth-last-child(-n+4) & {
      margin-bottom: 0;
    } 
  }

  ${p => p.theme.media.minWidth('desktop')} {
    ${Col}:nth-last-child(-n+6) & {
      margin-bottom: 0;
    } 
  }  
`

export const GQL_LOGO_CAROUSEL_MODULE = `
  ${GQL_WP_IMAGE}

  fragment LogoCarouselModule on Page_Pagecontent_Modules_LogoCarousel {
    fieldGroupName
    logoRatioWidth
    logoRatioHeight
    format
    logos {
      ...WPImage
    }
    visibleOnDesktop
    visibleOnMobile
  }
`

export default LogoCarousel
