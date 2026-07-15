import { useContext } from 'react'
import Link from 'components/LinkWithQuery'
import styled from 'styled-components'

import { Container } from 'components/Grid'
import Headline from 'components/Headline'
import WPImage from 'components/WPImage'
import { Cta } from 'components/Button'
import SocialMenu from 'components/SocialMenu'
import AppContext from 'contexts/App'

const Basic = ({
  backgroundColor,
  borderColor,
  cta,
  ctaEnabled,
  ctaIconBackground,
  ctaIconBackgroundHover,
  ctaIconBorder,
  ctaIconBorderHover,
  ctaIconColor,
  ctaIconColorHover,
  headline,
  image,
  textColor
}) => {  
  const { customize } = useContext(AppContext)   
  
  let renderedCta

  if ( customize?.footer.globalBasicCtaEnabled ) {
    renderedCta = customize.footer.globalBasicCta
  }

  if ( ctaEnabled ) {
    renderedCta = cta
  }  

  return (
    <S_Basic>
      <Container>
        <Content
            $color={textColor}
            $backgroundColor={backgroundColor}            
            $borderColor={borderColor}            
        >
          {image && (
             <Image>
               <WPImage
                   image={image}
                   objectFit={'cover'}
               />
             </Image>
           )}

          <Text className='js-align-text'>
            <TextInner>
              {headline && (           
                 <Headline
                     as={'h2'}
                     text={headline}
                     margin={false}
                 />
               )}
              {renderedCta && (
                 <Link href={renderedCta.url || ''} passHref>
                   <S_Cta
                       link
                       target={renderedCta.target}
                       iconColor={ctaIconColor}
                       iconBackground={ctaIconBackground}
                       iconBorder={ctaIconBorder}
                       iconColorHover={ctaIconColorHover}
                       iconBackgroundHover={ctaIconBackgroundHover}
                       iconBorderHover={ctaIconBorderHover}
                   >
                     {renderedCta.title}
                   </S_Cta>
                 </Link>
               )}
            </TextInner>
            
            <S_SocialMenu
              $borderColor={borderColor}            
            />
          </Text>
        </Content>
      </Container>      
    </S_Basic>
  )
}

const S_Basic = styled.div``

const Content = styled.div`
  padding: 0;
  color: ${p =>
    p.theme.mixins.acfColor(p.$color) || p.theme.colors.white
  };
  background-color: ${p =>
    p.theme.mixins.acfColor(p.$backgroundColor) || p.theme.colors.black
  };
  border-color: ${p =>
    p.theme.mixins.acfColor(p.$borderColor) || p.theme.colors.white
  } !important;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    border-bottom: solid 1px;
  }
`

const Image = styled.div`
  position: relative;

  ${p => p.theme.media.minWidth('desktop')} {
    flex: 1;
    max-width: 560px;

    > * {
      min-height: 100%;
      > * {
        min-height: 100%;
        > * {
          display: flex;
          min-height: 100%;
          > * {
            min-height: 100%;
          }
        }
      }
    }
  }
`

const Text = styled.div`
  text-align: center;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    flex: 1;
  }
`

const TextInner = styled.div`
  padding: 30px;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    flex: 1;
  }
`

const S_Cta = styled(Cta)`
  margin: 20px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 32px 0 0 0;
  }
`

const S_SocialMenu = styled(SocialMenu)`
  border-top: solid 1px;
  border-bottom: solid 1px;

  border-color: ${p =>
    p.theme.mixins.acfColor(p.$borderColor) || p.theme.colors.white
  } !important;

  ${p => p.theme.media.minWidth('desktop')} {
    border-top: none;
    border-bottom: none;
    border-left: solid 1px;
  }

  ul {
    display: flex;
    justify-content: center;
    ${p => p.theme.media.minWidth('desktop')} {
      height: 100%;
      flex-direction: column;
      justify-content: center;
    }
  }

  li {
    margin: 15px;
    ${p => p.theme.media.minWidth('desktop')} {
      margin: 10px 20px;
    }
  }  
`

export default Basic
