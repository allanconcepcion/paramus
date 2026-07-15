import { useState, useContext } from 'react'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'
import { SlideDown } from 'react-slidedown'

import { Container, Row, Col } from 'components/Grid'
import Headline from 'components/Headline'
import WPImage, { GQL_WP_IMAGE } from 'components/WPImage'
import { Rte } from 'components/Typography'
import { Icon } from 'components/SVGIcons'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import AppContext from 'contexts/App'

const Accordion = ({
  backgroundImageEnabled,
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,
  fieldGroupName,
  customizeLayout,
  items,
  visibleOnDesktop,
  visibleOnMobile
}) => {
  const {    
    customize
  } = useContext(AppContext)

  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  const [activeIndex, setActiveIndex] = useState(null)
  
  const customizeSettings = customize?.modules[`accordion${layout}`]

  const onItemTitleClick = ( index ) => {
    setActiveIndex(activeIndex === index ? null : index)
  }
  
  return (
    <S_Accordion
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
          </Col>
        </Row>
      </Container>
      <Container
        maxWidth={1270}
      >        
        <Items>
          {items.map((item, k) => (
            <Item key={k}>
              <ItemTitle onClick={() => onItemTitleClick(k)}>
                <span>{item.title}</span><Icon icon={`arrow-${activeIndex === k ? 'up' : 'down'}`} />
              </ItemTitle>
              <SlideDown>
                {activeIndex === k && (
                  <ItemContent>
                    {item.image && (
                      <ItemImage>
                        <WPImage
                          image={item.image}
                          layout='responsive'
                        />
                      </ItemImage>
                    )}
                    <ItemBody
                      dangerouslySetInnerHTML={{ __html: item.body }}
                    />
                  </ItemContent>                
                )}
               </SlideDown>                
             </Item>
           ))}
        </Items>
      </Container>      
    </S_Accordion>
  )
}

const S_Accordion = styled.div`  
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  padding: 65px 0;
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
    padding: 100px 0;
  }

  &.layout-a {
    color: ${p =>
      p.theme.mixins.acfColor('modules.accordionA.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.accordionA.backgroundColor') ||
      p.theme.colors.white
    };                 
  }

  &.layout-b {
    color: ${p =>
      p.theme.mixins.acfColor('modules.accordionB.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.accordionB.backgroundColor') ||
      p.theme.colors.white
    };        
  }

  &.layout-c {
    color: ${p =>
      p.theme.mixins.acfColor('modules.accordionC.color') ||
      p.theme.colors.black
    };

    background-color: ${p =>
      p.theme.mixins.acfColor('modules.accordionC.backgroundColor') ||
      p.theme.colors.white
    };        
  }

  .react-slidedown {
    transition-duration: .3s;
    transition-timing-function: ease-in-out;
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  text-align: center;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const S_Headline = styled(Headline)`
  .layout-a & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.accordionA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.accordionA.headlineColorBold') ||
        'currentColor'
      };  
    }
  }

  .layout-b & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.accordionB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.accordionB.headlineColorBold') ||
        'currentColor'
      };  
    }
  }

  .layout-c & {
    color: ${p =>
      p.theme.mixins.acfColor('modules.accordionC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.accordionC.headlineColorBold') ||
        'currentColor'
      };  
    }
  } 
`

const Body = styled(Rte)`
  margin: 0 auto;
  max-width: 960px;
  text-align: center;
`

const Items = styled.div`
  margin: 50px 0 0 0;
`

const Item = styled.div`
  border-top: solid 1px;

  &:last-child {
    border-bottom: solid 1px;
  }

  .layout-a & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.accordionA.itemBorderColor') ||
      p.theme.colors.black
    };    
  }

  .layout-b & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.accordionB.itemBorderColor') ||
      p.theme.colors.black
    };    
  }

  .layout-c & {
    border-color: ${p =>
      p.theme.mixins.acfColor('modules.accordionC.itemBorderColor') ||
      p.theme.colors.black
    };    
  }  
`

const ItemTitle = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  padding: 24px 0;
  transition: opacity 300ms ease;

  @media(hover:hover) {
    &:hover {
      opacity: .75;
    }
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding: 28px 0;
  }

  .icon {
    margin: 0 0 0 10px;
    font-size: 1.5rem;

    ${p => p.theme.media.minWidth('desktop')} {
      font-size: 1.8rem;
    }
  }

  .layout-a & {
    ${p => p.theme.mixins.acfTypography('modules.accordionA.textMobile.itemTitleRegular')};
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.accordionA.textDesktop.itemTitleRegular')};
    }
  }

  .layout-b & {
    ${p => p.theme.mixins.acfTypography('modules.accordionB.textMobile.itemTitleRegular')};
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.accordionB.textDesktop.itemTitleRegular')};
    }
  }

  .layout-c & {
    ${p => p.theme.mixins.acfTypography('modules.accordionC.textMobile.itemTitleRegular')};
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.accordionC.textDesktop.itemTitleRegular')};
    }
  }
`

const ItemContent = styled.div`
  padding: 0 0 24px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    padding: 0 0 30px 0;
  }  
`

const ItemImage = styled.div`
  margin: 0 0 24px 0;

  ${p => p.theme.media.minWidth('desktop')} {
    flex: 1;
    max-width: 320px;
    margin: 0 ${p => p.theme.grid.columnGutter.dk}px 0 0;
  }  
`

const ItemBody = styled(Rte)`
  flex: 1;  
`

export const GQL_ACCORDION_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment Accordion${layout}Module on Page_Pagecontent_Modules_Accordion${layout} {   
    backgroundImageEnabled
    body        
    eyebrow
    eyebrowEnabled
    eyebrowTag    
    fieldGroupName
    headline
    headlineTag  
    items {
      title
      body
      image {
        ...WPImage
      }      
    }     
    visibleOnDesktop
    visibleOnMobile 
    ${layout === 'A' ? 'customizeLayout' : ''}
  }
`

export const GQL_CUSTOMIZE_ACCORDION_MODULE = ( layout ) => `
  ${GQL_WP_IMAGE}

  fragment CustomizeAccordion${layout}Module on Customize_Modules {
    accordion${layout} {
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
      itemBorderColor
      textDesktop {
        ${GQL_ACF_TYPOGRAPHY('itemTitleRegular')}
      }
      textMobile {
        ${GQL_ACF_TYPOGRAPHY('itemTitleRegular')}
      }
    }
  }
`

export default Accordion
