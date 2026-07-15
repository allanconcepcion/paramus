import styled from 'styled-components'

import { Row, Col } from 'components/Grid'
import { Rte } from 'components/Typography'

const IconBar = ({
  blocks, 
  visibleOnDesktop,
  visibleOnMobile
}) => {  
  const columns = () => {
    switch ( blocks.length ) {
      case 1:
        return ({
          dk: 24
        })
      case 2: 
        return ({
          dk: 12
        })
      case 3:
        return ({
          dk: 8
        })
      default:       
        return ({
          tb: 12,
          dk: 6
        })        
    }
  }

  return (
    <S_IconBar
      $visibleOnDesktop={visibleOnDesktop}
      $visibleOnMobile={visibleOnMobile}
    >
      <Row
        gutter={{ mb: 0 }}
      >
        {blocks.map((block, k) => (
          <Col
            key={k} 
            {...columns()}
          >
            <Block               
              $isFirst={k === 0}
              $isLast={k === blocks.length - 1}
              $evenOdd={blocks.length % 2 === 0 ? 'even' : 'odd'}
              $textColor={block.textColor}
              $backgroundColor={block.backgroundColor}
            >
              {block.icon && (
                <Icon>
                  <i className={block.icon} />
                </Icon>
              )}
              {block.headline && (
                <Headline>{block.headline}</Headline>
              )}              
              <Body 
                dangerouslySetInnerHTML={{ __html: block.body }}
              />
            </Block>
          </Col>          
        ))}
      </Row>      
    </S_IconBar>
  )
}

const S_IconBar = styled.div`
  display: ${p => p.$visibleOnMobile ? 'block' : 'none'};

  ${p => p.theme.media.minWidth('desktop')} {
    display: ${p => p.$visibleOnDesktop ? 'block' : 'none'};
  }
`

const Block = styled.div`  
  padding: 25px;
  text-align: center;
  min-height: 100%;
  color: ${p => p.$textColor};
  background-color: ${p => p.$backgroundColor};
  border: solid .5px ${p => p.theme.colors.white};

  ${p => p.theme.media.minWidth('tablet')} {    
    padding: 50px 40px;  
  }
`

const Icon = styled.div`
  margin: 0 0 2.4rem 0;
  font-size: 3.5rem;
`

const Headline = styled.h4`
  margin: 0 0 1.8rem 0;
  ${p => p.theme.mixins.acfTypography('global.h4Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {  
    ${p => p.theme.mixins.acfTypography('global.h4Desktop.regular')};
  }
`

const Body = styled(Rte)``

export const GQL_ICON_BAR_MODULE = `
  fragment IconBarModule on Page_Pagecontent_Modules_IconBar {    
    fieldGroupName  
    visibleOnDesktop
    visibleOnMobile  
    blocks {
      headline
      body
      icon   
      textColor
      backgroundColor
    }
  }
`

export default IconBar