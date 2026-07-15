import styled from 'styled-components'
import { stripHtml } from 'string-strip-html'

const Headline = ({  
  text,
  as,
  align='center',
  margin=true,
  underline=true,
  className
}) => {
  return (
    <S_Headline
      $align={align}
      $margin={margin}
      $underline={underline}
      as={as}
      className={className}
      dangerouslySetInnerHTML={{
        __html: stripHtml(text, { onlyStripTags: 'p' }).result
      }}
    />
  )
}

const S_Headline = styled.h2`
  margin: 0 0 ${p => p.$margin ? 30 : 0}px 0;
  color: currentColor;
  
  ${p => p.theme.mixins.acfTypography('global.h2Mobile.regular')};
  text-align: ${p => p.$align};

  ${p => p.theme.media.minWidth('desktop')} {
    margin: 0 0 ${p => p.$margin ? 40 : 0}px 0;
    ${p => p.theme.mixins.acfTypography('global.h2Desktop.regular')};
  }
 
  &:after {
    display: ${p => p.$underline ? 'block' : 'none'};
    margin: 24px ${p => p.$align === 'center' ? 'auto' : 0} 0 ${p => p.$align === 'center' ? 'auto' : 0};
    content: '';
    width: 70px;
    height: 4px;
    background-color: currentColor;
  }

  strong {
    ${p => p.theme.mixins.acfTypography('global.h2Mobile.bold')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h2Desktop.bold')};
    }
  }

  br {
    ${p => p.theme.media.maxWidth('desktop')} {
      display: none;
    }
  }
`

export default Headline
