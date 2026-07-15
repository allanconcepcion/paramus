import { useState, useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import { Container } from 'components/Grid'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import Select from 'components/Select'
import { TextArrow } from 'components/Button'
import AppContext from 'contexts/App'

const CardTabs = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline, 
  headlineTag,
  body, 
  cardTabs, 
  customizeLayout, 
  fieldGroupName, 
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const { customize } = useContext(AppContext)
  const [activeIndex, setActiveIndex] = useState(0)
  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const customizeSettings = customize?.modules[`cardTabs${layout}`]

  const options = cardTabs?.map((c, i) => ({
    label: c.title, 
    value: i
  }))

  const onTabClick = (index) => {
    setActiveIndex(index)
  }

  const onSelectChange = (option) => {  
    setActiveIndex(option.value)
  }

  return (
    <S_CardTabs
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
      </Container>

      <ContentContainer>       
        <Tabs>
          {cardTabs.map((card, k) => (
            <Tab 
              key={k}
              className={activeIndex === k ? 'is-active' : undefined}
              onClick={() => onTabClick(k)}
            >
              {card.title}
            </Tab>
          ))}          
        </Tabs>
        <Cards>          
          {cardTabs[activeIndex] && (
            <>
              <SelectWrapper>
                <Select       
                  instanceId={`cardTabs-select`}
                  options={options}
                  defaultValue={options[activeIndex]}
                  onChange={onSelectChange}
                />  
              </SelectWrapper>              
              <Card>              
                <CardImage>
                  <WPImage
                    image={cardTabs[activeIndex].image}
                    layout='responsive'
                  />
                </CardImage>              
                <CardTitle>
                  {cardTabs[activeIndex].title}
                </CardTitle>
                {cardTabs[activeIndex].body && (
                  <CardBody 
                    dangerouslySetInnerHTML={{ __html: cardTabs[activeIndex].body }} 
                  />
                )}
                {cardTabs[activeIndex].ctaLink?.url && (
                  <Link
                    href={cardTabs[activeIndex].ctaLink.url}
                  >
                    <CardCtaLink
                      target={cardTabs[activeIndex].ctaLink.target || undefined}
                      link
                    >
                      {cardTabs[activeIndex].ctaLink.title}
                    </CardCtaLink>
                  </Link>
                )}
              </Card>
            </>            
          )}
        </Cards>
      </ContentContainer>
    </S_CardTabs>
  )
}

const S_CardTabs = styled.div`
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
      p.theme.mixins.acfColor('modules.cardTabsA.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsA.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.backgroundColor') ||
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
      p.theme.mixins.acfColor('modules.cardTabsA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsA.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsB.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsC.headlineColorBold') ||
        'currentColor'
      };
    }
  }    
`

const Body = styled(Rte)`
  margin: 0 auto;
  max-width: 960px;
`

const ContentContainer = styled(Container)`
  ${p => p.theme.media.minWidth('tablet')} {
    display: flex;
  }
`

const SelectWrapper = styled.div`
  margin: 0 0 20px 0;
  color: ${p => p.theme.colors.black};

  ${p => p.theme.media.minWidth('desktop')} {
    display: none;
  }
`

const Tabs = styled.nav`
  display: none;
  flex: 1;
  max-width: 420px;
  text-align: left;

  ${p => p.theme.media.minWidth('desktop')} {
    display: block;  
  }  
`

const Tab = styled.h4`
  margin: 0;
  padding: 24px 40px;
  cursor: pointer;
  ${p => p.theme.mixins.acfTypography('global.h4Desktop.regular')};
  border-left: solid 11px transparent;

  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsA.tabAccentColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsA.backgroundColor') ||
      p.theme.colors.white
    };
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.tabAccentColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.backgroundColor') ||
      p.theme.colors.white
    };
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.tabAccentColor') ||
      p.theme.colors.black
    };
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.backgroundColor') ||
      p.theme.colors.white
    };
  }  

  &.is-active {
    ${p => p.theme.mixins.acfTypography('global.h4Desktop.regular')};

    .layout-a & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsA.tabAccentColor') ||
        p.theme.colors.white
      };

      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsA.cardBackgroundColor') ||
        p.theme.colors.white
      };
    }
  
    .layout-b & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsB.tabAccentColor') ||
        p.theme.colors.white
      };

      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsB.cardBackgroundColor') ||
        p.theme.colors.white
      };
    }
  
    .layout-c & {
      border-color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsC.tabAccentColor') ||
        p.theme.colors.white
      };

      background-color: ${p =>
        p.theme.mixins.acfColor('modules.cardTabsC.cardBackgroundColor') ||
        p.theme.colors.white
      };
    }  
  }  
`

const Cards = styled.div`
  flex: 1;
  min-height: 100%;
  text-align: left;  
`

const Card = styled.div`  
  min-height: 100%;
  padding: 30px;
  
  ${p => p.theme.media.minWidth('tablet')} {
    padding: 40px 50px;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 30px 40px;
  }

  ${p => p.theme.media.minWidth('large')} {
    padding: 50px 75px;
  }

  .layout-a & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsA.cardBackgroundColor') ||
      p.theme.colors.white
    };
  }

  .layout-b & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.cardBackgroundColor') ||
      p.theme.colors.white
    };
  }

  .layout-c & {
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.cardBackgroundColor') ||
      p.theme.colors.white
    };
  } 
`

const CardTitle = styled.h3`
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.bold')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.bold')};  
  }

  .layout-a & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsA.tabAccentColor') ||
      p.theme.colors.black
    };
  }  

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsB.tabAccentColor') ||
      p.theme.colors.black
    };
  }  

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.cardTabsC.tabAccentColor') ||
      p.theme.colors.black
    };
  }  
`

const CardImage = styled.div``

const CardBody = styled(Rte)``

const CardCtaLink = styled(TextArrow)`
  margin: 30px 0 0 0;    
`

export const GQL_CARD_TABS_MODULE = `
  ${GQL_WP_IMAGE}

  fragment CardTabsModule on Page_Pagecontent_Modules_CardTabs {       
    backgroundImageEnabled
    body
    customizeLayout
    fieldGroupName
    eyebrowEnabled
    eyebrow
    eyebrowTag
    headline
    headlineTag
    cardTabs {
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
    visibleOnDesktop
    visibleOnMobile
  }
`

export const GQL_CUSTOMIZE_CARD_TABS_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeCardTabs${layout}Module on Customize_Modules {
    cardTabs${layout} {
      backgroundColor
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
      color
      headlineColor
      headlineColorBold
      tabAccentColor
      cardBackgroundColor
      tabAccentColor
    }
  }
`

export default CardTabs