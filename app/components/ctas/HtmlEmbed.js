import { useContext } from 'react'
import styled from 'styled-components'

import { Container } from 'components/Grid'
import Headline from 'components/Headline'
import WPImage from 'components/WPImage'
import SocialMenu from 'components/SocialMenu'
import InnerHTML from 'components/Html'
import AppContext from 'contexts/App'

const HtmlEmbed = ({
  backgroundColor,
  borderColor,
  headline,
  htmlEnabled,
  html,
  note,
  htmlImage: image,
  textColor, 
  embedBackgroundColor,  
}) => {        
  const { customize } = useContext(AppContext)   
    
  return (
    <S_HtmlEmbed>
      <Container>
        <Content
          $color={textColor}
          $backgroundColor={backgroundColor}            
          $borderColor={borderColor}            
        >    
          <Text>
            <TextInner>
              {headline && (           
                <S_Headline
                  forwardAs={'h2'}
                  text={headline}
                  underline={false}
                  margin={true}
                />
              )}   
              {note && (
                <Note>{note}</Note>
              )}    
              <ImageHtml>
              {image && (
                <Image>
                  <WPImage
                      image={image}
                      objectFit={'cover'}
                  />                  
                </Image>
              )}              
              {htmlEnabled && (
                <Html                   
                  $backgroundColor={embedBackgroundColor}
                >
                  <InnerHTML html={html} />
                </Html>
              )}
              {customize?.footer.globalHtmlEmbedHtmlEnabled && !htmlEnabled && (
                <Html                   
                  $backgroundColor={embedBackgroundColor}
                >
                  <InnerHTML 
                    html={customize?.footer.globalHtmlEmbedHtml} 
                  />
                </Html>
              )}
              </ImageHtml>
            </TextInner>            
            <S_SocialMenu
              $borderColor={borderColor}            
            />
          </Text>
        </Content>
      </Container>      
    </S_HtmlEmbed>
  )
}

const S_HtmlEmbed = styled.div``

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
  margin: 0 auto;
  max-width: 400px;

  ${p => p.theme.media.minWidth('desktop')} {
    flex: 1;
    max-width: 40%;
    padding: 0 30px;  
  }
`

const Html = styled.div`
  margin: 2.4rem 0 0 0;
  flex: 1;
  iframe {    
    border-radius: 18px;    
    background-color: ${p =>
      p.theme.mixins.acfColor(p.$backgroundColor) || p.theme.colors.white
    };  
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 0 0;
    padding: 0 0 0 30px;
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
  padding: 50px 20px;

  ${p => p.theme.media.minWidth('desktop')} {    
    flex: 1;
    padding: 50px 30px;
  }

  ${p => p.theme.media.minWidth('large')} {        
    padding: 75px 30px;
  }  
`

const S_Headline = styled(Headline)`
  margin-bottom: 0px;
`

const ImageHtml = styled.div`
  margin: 30px 0 0 0;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    margin: 50px 0 0 0;
  }  
`

const Note = styled.div`
  margin: 20px auto 0 auto;
  max-width: 700px;
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {    
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.regular')};
    margin: 20px auto 0 auto;
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

export default HtmlEmbed
