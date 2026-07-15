import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import { GQL_WP_IMAGE } from 'components/WPImage'
import { Container } from 'components/Grid'
import Headline from 'components/Headline'
import { Rte } from 'components/Typography'
import { Cta } from 'components/Button'
import AppContext from 'contexts/App'

const Text = ({
  eyebrowEnabled,
  eyebrow,
  eyebrowTag,
  headline,
  headlineTag,
  body,
  ctaEnabled,
  textCta: cta,
  backgroundImageEnabled, 
  visibleOnDesktop,
  visibleOnMobile
}) => {      
  const { customize } = useContext(AppContext)

  return (
    <S_Text
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionDesktop={customize?.modules.text.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customize?.modules.text.backgroundDesktop.backgroundImage}
      $backgroundPositionMobile={customize?.modules.text.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customize?.modules.text.backgroundMobile.backgroundImage}
    >
      <Container maxWidth={1100}>
        <Header>
          {eyebrowEnabled && eyebrow && (
            <Eyebrow 
              as={eyebrowTag}
            >
              {eyebrow}
            </Eyebrow>
          )}

          {headline && (           
             <Headline
                as={headlineTag}
                text={headline}
             />
           )}
        </Header>
      
        <Rte dangerouslySetInnerHTML={{ __html: body }} />

        {ctaEnabled && cta && cta.url && (
           <Link href={cta.url || ''} passHref>
             <S_Cta
              link
              target={cta.target}
              iconColor='modules.text.ctaIconColor'
              iconBackground='modules.text.ctaIconBackground'
              iconBorder='modules.text.ctaIconBorder'
              iconColorHover='modules.text.ctaIconColorHover'
              iconBackgroundHover='modules.text.ctaIconBackgroundHover'
              iconBorderHover='modules.text.ctaIconBorderHover'
            >
              {cta.title}
            </S_Cta>
          </Link>
        )}
      </Container>      
    </S_Text>
  )
}

const S_Text = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  margin: ${p => p.$backgroundImageEnabled ? 0 : 65}px 0;
  padding: ${p => p.$backgroundImageEnabled ? 65 : 0}px 0;
  text-align: center;
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
`

const Header = styled.div`
  color: ${p =>
    p.theme.mixins.acfColor('modules.text.headlineColor') ||
    'currentColor'
  };

  strong {
    color: ${p =>
      p.theme.mixins.acfColor('modules.text.headlineColorBold') ||
      'currentColor'
    };  
  }
`

const Eyebrow = styled.h1`
  margin: 0 0 10px 0;
  ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 16px 0;
    ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
  }
`

const S_Cta = styled(Cta)`
  margin: 40px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 32px 0 0 0;
  }
`

export const GQL_TEXT_MODULE = `
  fragment TextModule on Page_Pagecontent_Modules_Text {
    backgroundImageEnabled
    body
    ctaEnabled
    textCta {
      target
      title
      url
    }
    eyebrow
    eyebrowEnabled
    eyebrowTag
    headlineTag
    headline
    fieldGroupName    
    visibleOnDesktop
    visibleOnMobile
  }
`

export const GQL_CUSTOMIZE_TEXT_MODULE = `
  ${GQL_WP_IMAGE}

  fragment CustomizeTextModule on Customize_Modules {
    text {
      headlineColor
      headlineColorBold
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
      ctaIconBackground
      ctaIconBackgroundHover
      ctaIconBorder
      ctaIconBorderHover
      ctaIconColor
      ctaIconColorHover
    }    
  }
`

export default Text
