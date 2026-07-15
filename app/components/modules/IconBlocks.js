import { useContext } from 'react'
import styled from 'styled-components'

import { Container, Row, Col } from 'components/Grid'
import { Icon } from 'components/SVGIcons'
import { H5 } from 'components/Typography'
import { GQL_WP_IMAGE } from 'components/WPImage'
import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import AppContext from 'contexts/App'

const IconBlocks = ({
  backgroundImageEnabled,
  visibleOnDesktop,
  visibleOnMobile,
  ...props
}) => {  
  const { customize } = useContext(AppContext)

  return (
    <S_IconBlocks
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
      $backgroundImageEnabled={backgroundImageEnabled}
      $backgroundPositionMobile={customize?.modules.iconBlocks.backgroundMobile.backgroundPosition}
      $backgroundImageMobile={customize?.modules.iconBlocks.backgroundMobile.backgroundImage}
      $backgroundPositionDesktop={customize?.modules.iconBlocks.backgroundDesktop.backgroundPosition}
      $backgroundImageDesktop={customize?.modules.iconBlocks.backgroundDesktop.backgroundImage}
    >
      <Container>
        <Row justifyContent={{ tb: 'center' }}>          
          {props.iconBlocks.map((iconBlock, k) => (
            <BlockCol 
              key={k}               
              tb={props.gridSize === '4x' ? 12 : 8} 
              dk={props.gridSize === '4x' ? 6 : 8}
            >
              <IconBlock
                o$gridSize={props.gridSize}
              >
                {iconBlock.icon && (
                  <IconBlockIcon $color={iconBlock.iconColor}>
                    <Icon icon={iconBlock.icon} />
                  </IconBlockIcon>
                )}
                {iconBlock.label && (
                  <IconBlockLabel>{iconBlock.label}</IconBlockLabel>
                )}                
                <IconBlockBody
                    dangerouslySetInnerHTML={{ __html: iconBlock.body }}
                />
              </IconBlock>
            </BlockCol>
          ))}
        </Row>
      </Container>
    </S_IconBlocks>
  )
}

const S_IconBlocks = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};
  margin: ${p => p.$backgroundImageEnabled ? 0 : 50}px 0;
  padding: ${p => p.$backgroundImageEnabled ? 50 : 0}px 0;
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
    margin: ${p => p.$backgroundImageEnabled ? 0 : 75}px 0;
    padding: ${p => p.$backgroundImageEnabled ? 75 : 0}px 0;
    background-position: ${p => p.$backgroundPositionDesktop || 'center'};
    background-image: ${p =>
      p.$backgroundImageEnabled && p.$backgroundImageDesktop ? (
        'url(' + p.$backgroundImageDesktop.sourceUrl + ')'
      ) : 'none'
    };  
  }  
`

const BlockCol = styled(Col)`  
  ${p => p.theme.media.minWidth('desktop')} {
    &:nth-child(3n+1):not(:last-child) {
      display: flex;
      justify-content: flex-start;
    }

    &:nth-child(3n+3) {
      display: flex;
      justify-content: flex-end;
    }

    &:nth-last-child(-n+3) {
      margin-bottom: 0;
    }
  }  
`

const IconBlock = styled.div`
  margin: 0 0 30px 0;
  text-align: center;

  ${BlockCol}:last-child & {
    margin: 0;
  }  

  ${p => p.theme.media.minWidth('tablet')} {    
    ${BlockCol}:nth-last-child(-n+${p => p.$gridSize === '4x' ? 2 : 3}) & {
      margin: 0;
    }
  }

  ${p => p.theme.media.minWidth('desktop')} {
    ${BlockCol}:nth-last-child(-n+${p => p.$gridSize === '4x' ? 4 : 3}) & {
      margin: 0;
    }
  }
`

const IconBlockIcon = styled.div`
  margin: 0 0 15px 0;
  font-size: 2.4rem;
  color: ${p => p.theme.mixins.acfColor(p.$color) || 'currentColor'};
`

const IconBlockLabel = styled(H5)`
  margin: 0;

  ${p => p.theme.mixins.acfTypography('modules.iconBlocks.blocksStyleMobile.label')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('modules.iconBlocks.blocksStyleDesktop.label')};
  }
`

const IconBlockBody = styled.div`
  ${p => p.theme.mixins.acfTypography('modules.iconBlocks.blocksStyleMobile.body')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('modules.iconBlocks.blocksStyleDesktop.body')};
  }

  a {
    color: currentColor;

    @media(hover:hover) {
      &:hover {
        text-decoration: underline;  
      }
    }
  } 
`

export const GQL_ICON_BLOCKS_MODULE = `
  fragment IconBlocksModule on Page_Pagecontent_Modules_IconBlocks {
    gridSize
    backgroundImageEnabled
    fieldGroupName
    visibleOnDesktop
    visibleOnMobile
    iconBlocks {
      body
      icon
      iconColor
      label
    }
  }
`

export const GQL_CUSTOMIZE_ICON_BLOCKS_MODULE = `
  ${GQL_WP_IMAGE}

  fragment CustomizeIconBlocksModule on Customize_Modules {
    iconBlocks {
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
      blocksStyleDesktop {
        ${GQL_ACF_TYPOGRAPHY('body')}
        ${GQL_ACF_TYPOGRAPHY('label')}
      }      
      blocksStyleMobile {
        ${GQL_ACF_TYPOGRAPHY('body')}
        ${GQL_ACF_TYPOGRAPHY('label')}
      }      
    }    
  }
`

export default IconBlocks
