import { useContext } from 'react'
import styled from 'styled-components'
import last from 'lodash/last'
import lowerCase from 'lodash/lowerCase'
import upperCase from 'lodash/upperCase'

import { Container } from 'components/Grid'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import InnerHTML from 'components/Html'
import AppContext from 'contexts/App'

const Html = ({
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline, 
  headlineTag,
  body,
  html, 
  backgroundImageEnabled, 
  visibleOnDesktop,
  visibleOnMobile,
  customizeLayout, 
  fieldGroupName
}) => {
  const { customize } = useContext(AppContext)

  const layout = upperCase(customizeLayout) || last(fieldGroupName)
  
  const customizeSettings = customize?.modules[`html${layout}`]  

  return (
    <S_Html
      className={`layout-${lowerCase(layout)}`}
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customizeSettings?.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customizeSettings?.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customizeSettings?.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customizeSettings?.backgroundDesktop.backgroundImage}
    >
      <Container>
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
        {html && (
          <InnerHTML html={html} />
        )}
      </Container>      
    </S_Html>
  )
}

const S_Html = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  margin: ${p => p.$backgroundImageEnabled ? 0 : 65}px 0;  
  padding: ${p => p.$backgroundImageEnabled ? 65 : 0}px 0;  
  background-size: cover;
  background-repeat: no-repeat;
  background-position: ${p => p.$backgroundPositionMobile || 'center'};
  background-image: ${p =>
    p.$backgroundImageEnabled && p.$backgroundImageMobile ? (
      'url(' + p.$backgroundImageMobile.sourceUrl + ')'
    ) : 'none'
  };        

  ${p => p.theme.media.minWidth('tablet')} {
    margin: ${p => p.$backgroundImageEnabled ? 0 : 75}px 0;
    padding: ${p => p.$backgroundImageEnabled ? 75 : 0}px 0;
  }

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
    margin: ${p => p.$backgroundImageEnabled ? 0 : 100}px 0;
    padding: ${p => p.$backgroundImageEnabled ? 100 : 0}px 0;
    background-position: ${p => p.$backgroundPositionDesktop || 'center'};
    background-image: ${p =>
      p.$backgroundImageEnabled && p.$backgroundImageDesktop ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }

  &.layout-a {    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.htmlA.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  &.layout-b {    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.htmlB.backgroundColor') ||
      p.theme.colors.white
    };    
  }

  &.layout-c {    
    background-color: ${p =>
      p.theme.mixins.acfColor('modules.htmlC.backgroundColor') ||
      p.theme.colors.white
    };    
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
      p.theme.mixins.acfColor('modules.htmlA.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.htmlA.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-b & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.htmlB.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.htmlB.headlineColorBold') ||
        'currentColor'
      };
    }
  }

  .layout-c & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.htmlC.headlineColor') ||
      p.theme.colors.black
    };

    strong {
      color: ${p =>
        p.theme.mixins.acfColor('modules.htmlC.headlineColorBold') ||
        'currentColor'
      };
    }
  }
`


const Body = styled(Rte)`
  margin: 0 0 30px 0;
  text-align: center;

  .layout-a & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.htmlA.bodyColor') ||
      p.theme.colors.black
    };
  }

  .layout-b & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.htmlB.bodyColor') ||
      p.theme.colors.black
    };
  }

  .layout-c & {    
    color: ${p =>
      p.theme.mixins.acfColor('modules.htmlC.bodyColor') ||
      p.theme.colors.black
    };
  }
`

export const GQL_HTML_MODULE = `  
  fragment HtmlModule on Page_Pagecontent_Modules_Html {   
    headline
    headlineTag
    backgroundImageEnabled
    body
    html
    eyebrow
    eyebrowEnabled
    eyebrowTag
    fieldGroupName
    visibleOnDesktop
    visibleOnMobile
    customizeLayout
  }
`

export const GQL_CUSTOMIZE_HTML_MODULE = ( layout ) => `  
  fragment CustomizeHtml${layout}Module on Customize_Modules {
    html${layout} {         
      headlineColor
      headlineColorBold
      bodyColor
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
    }
  }
`

export default Html