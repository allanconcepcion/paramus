import { useContext } from 'react'
import styled from 'styled-components'
import { stripHtml } from 'string-strip-html'

import { Container } from 'components/Grid'
import WPImage from 'components/WPImage'
import SocialMenu from 'components/SocialMenu'
import { Icon } from 'components/SVGIcons'
import InnerHTML from 'components/Html'
import AppContext from 'contexts/App'

const ChecklistHtmlEmbed = ({
  accentColor,
  backgroundColor,
  borderColor,
  headline,
  checklistHtmlEnabled,
  html,
  checklistHtmlImage: image,
  checklistHtmlUnderlineImage: underlineImage,
  checklist,
  textColor, 
  embedBackgroundColor
}) => {   
  const { customize } = useContext(AppContext)   

  return (
    <S_ChecklistHtmlEmbed>
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
              {underlineImage && (
                <UnderlineImage>
                  <img src={underlineImage.sourceUrl} />
                </UnderlineImage>                
              )}                          
            </Image>
          )}
          <Text>
            <TextInner>
              {headline && (           
                <Headline
                  $accentColor={accentColor}
                  dangerouslySetInnerHTML={{ 
                    __html: stripHtml(headline, { onlyStripTags: 'p' }).result 
                  }}
                />
              )}
              {underlineImage && (
                <HeadlineUnderlineImage>
                  <img src={underlineImage.sourceUrl} />
                </HeadlineUnderlineImage>                
              )}                     
              {checklist?.length > 0 && (
                <Checklist
                  $accentColor={accentColor}
                >
                  {checklist.map((item, k) => (
                    <li key={k}>
                      <Icon icon='checkmark' />  
                      <div 
                        dangerouslySetInnerHTML={{ __html: item.body }}
                      />
                    </li>
                  ))}
                </Checklist>
              )}
              {checklistHtmlEnabled && (
                <Html                   
                  $backgroundColor={embedBackgroundColor}
                >
                  <InnerHTML html={html} />
                </Html>
              )}
              {customize?.footer.globalChecklistHtmlEmbedHtmlEnabled && !checklistHtmlEnabled && (
                <Html                   
                  $backgroundColor={embedBackgroundColor}
                >
                  <InnerHTML 
                    html={customize?.footer.globalChecklistHtmlEmbedHtml} 
                  />
                </Html>
              )}
            </TextInner>            
            <S_SocialMenu
              $borderColor={borderColor}            
            />
          </Text>
        </Content>
      </Container>      
    </S_ChecklistHtmlEmbed>
  )
}

const S_ChecklistHtmlEmbed = styled.div``

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
  padding: 4rem 2rem 0 2rem;
  max-width: 400px;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex: 1;
    max-width: 50%;
    padding: 0 30px;  
  }
`

const Html = styled.div`
  flex: 1;

  iframe {  
    border-radius: 18px;    
    background-color: ${p =>
      p.theme.mixins.acfColor(p.$backgroundColor) || p.theme.colors.white
    };  
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
  padding: 24px 20px;

  ${p => p.theme.media.minWidth('desktop')} {    
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 50px 30px;
  }

  ${p => p.theme.media.minWidth('large')} {        
    padding: 75px 30px;
  }
`

const Headline = styled.h3`
  margin: 0 0 2.4rem 0;
  ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesMobile.headlineRegular')};  

  strong {
    ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesMobile.headlineBold')};    
    text-decoration: underline;

    color: ${p =>
      p.theme.mixins.acfColor(p.$accentColor) || p.theme.colors.white
    };
  }

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesDesktop.headlineRegular')};  

    strong {
      ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesDesktop.headlineBold')};  
    }
  }
`

const UnderlineImage = styled.div`    
  img {
    display: block;
    max-width: 100%;
  }
`

const HeadlineUnderlineImage = styled(UnderlineImage)`
  margin: -.2rem 0 2.4rem 0;  
`

const Checklist = styled.ul`
  margin: 0 0 2.4rem 0;
  padding: 0;
  list-style: none;

  ${p => p.theme.media.minWidth('desktop')} {
    display: flex;
    flex-wrap: wrap;
    margin-left: -.5rem;
    margin-right: -.5rem;
  }

  li {
    margin: 0 0 2.4rem 0;
    &:last-child {
      margin-bottom: 0;
    }

    ${p => p.theme.media.minWidth('desktop')} {
      display: flex;
      align-items: flex-start;
      text-align: left;
      flex: 1 0 50%;      
      margin: 0 0 2.4rem 0;      
      padding: 0 1rem;

      &:nth-last-child(-n + 2) {
        margin-bottom: 0;
      }
    }    
  }

  li .icon {
    font-size: 2.2rem;
    flex: 0 0 2.2rem;    
    margin: .5rem 1rem 0 0;
    color: ${p =>
      p.theme.mixins.acfColor(p.$accentColor) || p.theme.colors.white
    };
  }

  li div {
    ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesMobile.checklistRegular')};  

    > *:first-child {
      margin-top: 0;
    }

    > *:last-child {
      margin-bottom: 0;
    }

    strong {
      ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesMobile.checklistBold')};    
      text-decoration: underline;
    }

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesDesktop.checklistRegular')};    

      strong {
        ${p => p.theme.mixins.acfTypography('footer.checklistHtmlEmbedStylesDesktop.checklistBold')};    
      }
    }
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

export default ChecklistHtmlEmbed
