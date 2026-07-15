import { useRef, useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import Slider from 'react-slick'
import last from 'lodash/last'

import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import Box from 'components/Box'
import { TextArrow } from 'components/Button'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Container } from 'components/Grid'
import { Icon } from 'components/SVGIcons'
import { useMinWidth } from 'hooks/useMedia'
import AppContext from 'contexts/App'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

const CardCarousel = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,
  cards, 
  customizeLayout,
  fieldGroupName,
  slidesToShowDesktop, 
  visibleOnDesktop,
  visibleOnMobile
}) => {  
  const elRef = useRef()
  const carouselRef = useRef()  
  const isTablet = useMinWidth('tablet')
  const { customize } = useContext(AppContext)
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const customizeSettings = customize?.modules[`cardCarousel${layout}`]


  const onInit = () => {
    if ( slidesToShowDesktop === '1' ) {
      return 
    }
    
    setTimeout(() => {
      const current = elRef.current?.querySelector('.slick-current')                  
      current?.querySelector(':scope > div').classList.add('slick-highlighted')

      if ( isTablet ) {
        current?.previousElementSibling?.querySelector(':scope > div').classList.add('slick-highlighted')
      }      
    })    
  }

  const afterChange = () => {    
    if ( slidesToShowDesktop === '1' ) {
      return 
    }

    const current = elRef.current.querySelector('.slick-current')                  
    const previous = current.previousElementSibling
    const highlighted = elRef.current.querySelectorAll('.slick-highlighted')    

    highlighted.forEach(node => {            
      if ( 
        (node.parentNode !== current && node.parentNode !== previous) || 
        !isTablet
      ) {      
        node.classList.remove('slick-highlighted')
      }
    })

    current.querySelector(':scope > div').classList.add('slick-highlighted')

    if ( isTablet ) {
      previous?.querySelector(':scope > div').classList.add('slick-highlighted')
    }    
  }  

  const onPrevClick = () => {
    carouselRef.current.slickPrev()
  }  

  const onNextClick = () => {
    carouselRef.current.slickNext()
  }  

  const settings = {
    arrows: false,
    dots: false,
    ref: carouselRef, 
    slidesToShow: parseInt(slidesToShowDesktop),    
    infinite: true,
    centerMode: true,
    centerPadding: slidesToShowDesktop === '1' ? '28%' : '15%',
    onInit,
    afterChange,
    responsive: [
      {
        breakpoint: 767, 
        settings: {
          slidesToShow: 1, 
          centerPadding: '10%',
        }
      }
    ]
  } 

  return (    
    <S_CardCarousel 
      className={`layout-${lowerCase(layout)}`}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
      ref={elRef}
    >
      <Container maxWidth='large'>
        <Header>
          {eyebrowEnabled && eyebrow && (
            <Eyebrow as={eyebrowTag}>{eyebrow}</Eyebrow>
          )}
          {headline && (
            <S_Headline 
              text={headline} 
              forwardedAs={headlineTag}
            />
          )}
          {body && (
            <Body 
              dangerouslySetInnerHTML={{ __html: body }} 
            />
          )}
        </Header>
      </Container>
      <Carousel {...settings}>
        {cards.map((card, k) => (
          <Card key={k}>
            <CardImage>
              <Box width={1} height={1}>
                <WPImage
                  image={card.image}
                  layout='fill'
                />
              </Box>              
            </CardImage>
            <CardAccent>
              <i />
            </CardAccent>
            <CardTitle>{card.title}</CardTitle>
            {card.body && (
              <CardBody 
                dangerouslySetInnerHTML={{ __html: card.body }} 
              />
            )}
            {card.ctaLink?.url && (
              <Link
                href={card.ctaLink.url}
              >
                <CardCtaLink
                  target={card.ctaLink.target || undefined}
                  link
                >
                  {card.ctaLink.title}
                </CardCtaLink>
              </Link>
            )}
          </Card>        
        ))}      
      </Carousel>

      <Navigation>
        <ul>
          <li>
            <button
              onClick={onPrevClick}
            >
              <Icon icon='arrow-left' />
              <span>Previous</span>
            </button>
          </li>
          <li>|</li>
          <li>
            <button
              onClick={onNextClick}
            >
              <span>Next</span>
              <Icon icon='arrow-right' />
            </button>
          </li>
        </ul>
      </Navigation>
    </S_CardCarousel>
  )
}

const S_CardCarousel = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  text-align: center;
  padding: 50px 0;  
  background-size: cover;
  background-repeat: no-repeat;
  background-position: ${p => p.$backgroundPositionMobile || 'center'};
  background-image: ${p =>
    p.$backgroundImageEnabled && p.$backgroundImageMobile ? (
      'url(' + p.$backgroundImageMobile.sourceUrl + ')'
    ) : 'none'
  };  
    
  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    background-position: ${p => p.$backgroundPositionDesktop || 'center'};
    background-image: ${p =>
      p.$backgroundImageEnabled && p.$backgroundImageDesktop ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }

  ${p => p.theme.media.minWidth('tablet')} {
    padding: 75px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 90px 0;
  }

  &.layout-a {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselA.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselA.backgroundColor') ||
      p.theme.colors.white
    };        
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselB.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselB.backgroundColor') ||
      p.theme.colors.white
    };        
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselC.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselC.backgroundColor') ||
      p.theme.colors.white
    };        
  }    
`

const Header = styled.div`
  margin: 0 0 40px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 70px 0;
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  text-align: center;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;  
    text-align: center;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const S_Headline = styled(Headline)`
  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselA.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselB.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardCarouselC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselC.headlineColorBold') ||
        'currentColor'
      };
    }
  }    
`

const Body = styled(Rte)`
  margin: 0 auto;
  max-width: 960px;
`

const Carousel = styled(Slider)`
  .slick-track {
    ${p => p.theme.media.minWidth('tablet')} {
      display: flex;
    }    
  }

  .slick-slide {  
    ${p => p.theme.media.minWidth('tablet')} {
      display: flex;
      flex-direction: column;    
      height: auto;

      > div {
        height: 100%;
      }
    }    
  }
`

const Card = styled.div`
  position: relative;
  padding: 0 12px;

  ${p => p.theme.media.minWidth('tablet')} {
    padding: 0 20px;  
    height: 100%;
    display: flex !important;
    flex-direction: column;
    align-items: center;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 0 25px;  
  }
`

const CardImage = styled.div`
  margin: 0;  
  min-width: 100%;
  opacity: .4;
  transition: opacity 300ms ease;

  img {
    object-fit: cover;
  }

  .slick-highlighted &, 
  .slick-active &  {
    opacity: 1;  
  }

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0;  
  }
`

const CardAccent = styled.div`
  position: relative;
  margin: 32px 0 24px 0;    
  width: calc(100% + 24px);
  
  ${p => p.theme.media.minWidth('tablet')} {
    margin: 32px 0 24px 0;  
    width: calc(100% + 40px);
  }

  ${p => p.theme.media.minWidth('desktop')} {      
    margin: 40px 0 40px 0;  
    width: calc(100% + 50px);
  }

  &:after {
    display: block;
    content: '';
    width: 100%;
    height: 1px;

    .layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselA.iconAccentColor') ||
        p.theme.colors.black
      };
    } 
    
    .layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselB.iconAccentColor') ||
        p.theme.colors.black
      };
    } 

    .layout-c & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselC.iconAccentColor') ||
        p.theme.colors.black
      };
    } 
  }

  i {
    ${p => p.theme.mixins.center('absolute')};
    display: block;        
    width: 36px;
    height: 36px;
    border-radius: 50%;    
    border: solid 1px;            

    .layout-a & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselA.iconAccentColor') ||
        p.theme.colors.black
      };      
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselA.backgroundColor') ||
        p.theme.colors.white
      };
    }    

    .layout-b & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselB.iconAccentColor') ||
        p.theme.colors.black
      };      
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselB.backgroundColor') ||
        p.theme.colors.white
      };
    }   

    .layout-c & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselC.iconAccentColor') ||
        p.theme.colors.black
      };      
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardCarouselC.backgroundColor') ||
        p.theme.colors.white
      };
    }   

    &:after {
      display: block;
      content: '';
      position: relative;            
      border-radius: 50%; 
      top: 5px;
      left: 5px;
      width: 24px;
      height: 24px;   

      .layout-a & {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.cardCarouselA.iconAccentColor') ||
          p.theme.colors.black
        };
      }   

      .layout-b & {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.cardCarouselB.iconAccentColor') ||
          p.theme.colors.black
        };
      }   

      .layout-c & {
        background-color: ${p =>
          p.theme.mixins.acfColor('modules.cardCarouselC.iconAccentColor') ||
          p.theme.colors.black
        };
      }   
    }     
  }
`

const CardTitle = styled.h3`
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.bold')};
  margin: 0 0 24px 0;
  opacity: .4;
  transition: opacity 300ms ease;

  .slick-highlighted &, 
  .slick-active & {
    opacity: 1;  
  }

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0 0 30px 0;  
  }
  
  ${p => p.theme.media.minWidth('desktop')} {  
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.bold')};
  }
`

const CardBody = styled(Rte)`
  margin: 0 0 20px 0;
  opacity: .4;
  transition: opacity 300ms ease;

  .slick-highlighted &, 
  .slick-active & {
    opacity: 1;  
  }
`

const CardCtaLink = styled(TextArrow)`
  margin: 15px 0 0 0;
  opacity: .4;  
  transition: opacity 300ms ease;

  .slick-highlighted &, 
  .slick-active & {
    opacity: 1;  
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: auto 0 0 0;
  }
`

const Navigation = styled.nav`
  margin: 60px 0 0 0; 
  padding: 0 30px;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 75px 0 0 0;   
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 90px 0 0 0;   
  }

  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;    
    justify-content: center;
    align-items: center;
  }

  li {
    .layout-a & {
      ${p => p.theme.mixins.acfTypography('modules.cardCarouselA.textStylesMobile.regular')};

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardCarouselA.textStylesDesktop.regular')};      
      }    
    }

    .layout-b & {
      ${p => p.theme.mixins.acfTypography('modules.cardCarouselB.textStylesMobile.regular')};

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardCarouselB.textStylesDesktop.regular')};      
      }    
    }

    .layout-c & {
      ${p => p.theme.mixins.acfTypography('modules.cardCarouselC.textStylesMobile.regular')};

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardCarouselC.textStylesDesktop.regular')};      
      }    
    } 
  }

  button {
    display: flex;
    align-items: center;    
    transition: opacity 300ms ease;

    @media(hover:hover) {
      &:hover {
        opacity: .75;
      }
    }       

    .layout-a & {
      ${p => p.theme.mixins.acfTypography('modules.cardCarouselA.textStylesMobile.regular')};

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardCarouselA.textStylesDesktop.regular')};      
      }    
    }

    .layout-b & {
      ${p => p.theme.mixins.acfTypography('modules.cardCarouselB.textStylesMobile.regular')};

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardCarouselB.textStylesDesktop.regular')};      
      }    
    }

    .layout-c & {
      ${p => p.theme.mixins.acfTypography('modules.cardCarouselC.textStylesMobile.regular')};

      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardCarouselC.textStylesDesktop.regular')};      
      }    
    } 

    span {
      margin: 0 10px;
    }
    
    .icon {
      font-size: 80%;      
    }
  }
`

export const GQL_CARD_CAROUSEL_MODULE = `
  ${GQL_WP_IMAGE}

  fragment CardCarouselModule on Page_Pagecontent_Modules_CardCarousel {           
    backgroundImageEnabled
    body
    cards {
      body
      ctaLink {
        target
        title
        url
      }      
      fieldGroupName
      image {
        ...WPImage
      }      
      title
    }
    customizeLayout
    fieldGroupName
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag
    slidesToShowDesktop
    visibleOnDesktop
    visibleOnMobile
  }
`

export const GQL_CUSTOMIZE_CARD_CAROUSEL_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeCardCarousel${layout}Module on Customize_Modules {
    cardCarousel${layout} {
      color
      backgroundColor
      headlineColor
      headlineColorBold
      iconAccentColor
      backgroundDesktop {
        backgroundImage {
          ...WPImage
        }
        backgroundPosition
      }
      backgroundMobile {
        backgroundImage {
          ...WPImage
        }
        backgroundPosition
      }
      textStylesDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }        
      textStylesMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }        
    }
  }
`

export default CardCarousel