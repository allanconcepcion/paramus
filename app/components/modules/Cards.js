import { useContext } from 'react'
import styled from 'styled-components'
import Link from 'components/LinkWithQuery'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import { Container, Row, Col } from 'components/Grid'
import { Rte, H3 } from 'components/Typography'
import Headline from 'components/Headline'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { TextArrow } from 'components/Button'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import AppContext from 'contexts/App'

const Cards = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,  
  fieldGroupName, 
  customizeLayout,
  cards,
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const { customize } = useContext(AppContext)
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const customizeSettings = customize?.modules[`cards${layout}`]
  
  return (
    <S_Cards
      className={`layout-${lowerCase(layout)}`}  
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}              
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
    >
      <Container maxWidth='large'>
        <Row>
          <Col>
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
                <Body dangerouslySetInnerHTML={{ __html: body }} />
               )}
            </Header>
          </Col>
        </Row>
      </Container>

      <Container padding={{ dk: 7 }}>
        <Row justifyContent={{ mb: 'center' }}>
          {cards?.map((card, k) => (
             <Col key={k} tb={12} lg={cards.length % 2 !== 0 || cards.length % 3 === 0 ? 8 : 6}>
               <Card>
                 <CardImage>
                   <WPImage
                       image={card.image}
                       layout='responsive'
                   />

                   <CardIcon>
                     <span>{k+1}</span>
                   </CardIcon>
                 </CardImage>                 
                 <CardTitle as={card.headlineTag || 'h3'}>{card.title}</CardTitle>
                 {card.body && (
                    <CardBody 
                      dangerouslySetInnerHTML={{ 
                        __html: card.body
                      }} 
                    />
                  )}

                 {card.ctaLink?.url && (
                    <Link
                        href={card.ctaLink.url}
                        passHref
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
             </Col>
           ))}
        </Row>
      </Container>
    </S_Cards>
  )
}

const S_Cards = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  padding: 60px 0 20px 0;
  text-align: center;
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

  &.layout-a {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardsA.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsA.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsA.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };      
    }
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardsB.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsB.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsB.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };      
    }
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardsC.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsC.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };    

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsC.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };      
    }
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 75px 0 35px 0;
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
      p.theme.mixins.acfColor('modules.cardsA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardsA.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardsB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardsB.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardsC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardsC.headlineColorBold') ||
        'currentColor'
      };
    }
  }    
`

const Body = styled(Rte)`
  margin: 0 auto;
  max-width: 960px;
`

const Card = styled.div`
  margin: 0 0 40px 0;
`

const CardImage = styled.div`
  position: relative;
  margin: 0 0 30px 0;

  ${p => p.theme.media.minWidth('tablet')} {
    margin: 0 0 40px 0;
  }
`

const CardIcon = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  left: 50%;
  bottom: 0;
  transform: translateX(-50%) translateY(50%);
  width: 46px;
  height: 46px;
  border: solid 1px;
  border-radius: 50%;

  ${p => p.theme.media.minWidth('tablet')} {
    box-shadow: 0 0 0 9px ${p => p.theme.colors.white};
  }

  ${S_Cards}.layout-a & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsA.iconAccentColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsA.backgroundMobile.backgroundColor') ||
      p.theme.colors.black
    };
    box-shadow: 0 0 0 9px ${p =>
      p.theme.mixins.acfColor('modules.cardsA.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };
    
    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsA.backgroundDesktop.backgroundColor') ||
        p.theme.colors.black
      };
      box-shadow: 0 0 0 9px ${p =>
        p.theme.mixins.acfColor('modules.cardsA.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_Cards}.layout-b & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsB.iconAccentColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsB.backgroundMobile.backgroundColor') ||
      p.theme.colors.black
    };
    box-shadow: 0 0 0 9px ${p =>
      p.theme.mixins.acfColor('modules.cardsB.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };
    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsB.backgroundDesktop.backgroundColor') ||
        p.theme.colors.black
      };
      box-shadow: 0 0 0 9px ${p =>
        p.theme.mixins.acfColor('modules.cardsB.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };
    }
  }

  ${S_Cards}.layout-c & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsC.iconAccentColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardsC.backgroundMobile.backgroundColor') ||
      p.theme.colors.black
    };
    box-shadow: 0 0 0 9px ${p =>
      p.theme.mixins.acfColor('modules.cardsC.backgroundMobile.backgroundColor') ||
      p.theme.colors.white
    };

    ${p => p.theme.media.minWidth('desktop')} {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsC.backgroundDesktop.backgroundColor') ||
        p.theme.colors.black
      };
      box-shadow: 0 0 0 9px ${p =>
        p.theme.mixins.acfColor('modules.cardsC.backgroundDesktop.backgroundColor') ||
        p.theme.colors.white
      };
    }
  }

  span {
    position: relative;
    z-index: 2;
    color: ${p => p.theme.colors.white};

    ${S_Cards}.layout-a & {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardsA.iconTextColor') ||
        p.theme.colors.white
      };

      ${p => p.theme.mixins.acfTypography('modules.cardsA.iconMobile.regular')};
      
      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardsA.iconDesktop.regular')};
      }
    }

    ${S_Cards}.layout-b & {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardsB.iconTextColor') ||
        p.theme.colors.white
      };

      ${p => p.theme.mixins.acfTypography('modules.cardsB.iconMobile.regular')};
      
      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardsB.iconDesktop.regular')};
      }
    }

    ${S_Cards}.layout-c & {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardsC.iconTextColor') ||
        p.theme.colors.white
      };

      ${p => p.theme.mixins.acfTypography('modules.cardsC.iconMobile.regular')};
      
      ${p => p.theme.media.minWidth('desktop')} {
        ${p => p.theme.mixins.acfTypography('modules.cardsC.iconDesktop.regular')};
      }
    }    
  }

  &:before {
    content: '';
    ${p => p.theme.mixins.center('absolute')};
    width: 30px;
    height: 30px;
    border-radius: 50%;
    z-index: 1;

    ${S_Cards}.layout-a & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsA.iconAccentColor') ||
        p.theme.colors.black
      };
    }

    ${S_Cards}.layout-b & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsB.iconAccentColor') ||
        p.theme.colors.black
      };
    }

    ${S_Cards}.layout-c & {
      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardsC.iconAccentColor') ||
        p.theme.colors.black
      };
    }  
  } 
`

const CardTitle = styled(H3)`
  margin: 0;
`

const CardBody = styled(Rte)`
  margin: 10px 0 0 0;
`

const CardCtaLink = styled(TextArrow)`
  margin: 15px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 15px 0 0 0;
  }
`

export const GQL_CARDS_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment Cards${layout}Module on Page_Pagecontent_Modules_Cards${layout} {   
    backgroundImageEnabled
    body
    cards {
      title
      body
      headlineTag
      ctaLink {
        target
        title
        url
      }      
      image {
        ...WPImage
      }      
    }
    fieldGroupName
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag
    visibleOnDesktop
    visibleOnMobile
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_CARDS_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeCards${layout}Module on Customize_Modules {
    cards${layout} {
      headlineColor
      headlineColorBold
      backgroundDesktop {
        backgroundColor 
        backgroundImage {
          ...WPImage
        }
        backgroundPosition
      }
      backgroundMobile {
        backgroundColor 
        backgroundImage {
          ...WPImage
        }
        backgroundPosition
      }
      color
      iconAccentColor
      iconDesktop {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      iconMobile {
        ${GQL_ACF_TYPOGRAPHY('regular')}
      }
      iconTextColor
    }
  }
`

export default Cards
