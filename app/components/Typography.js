import { useEffect, useRef } from 'react'
import styled from 'styled-components'

export const H1 = styled.h1`
  ${p => p.theme.mixins.acfTypography('global.h1Mobile')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h1Desktop')};
  }
`

export const H2 = styled.h2`
  ${p => p.theme.mixins.acfTypography('global.h2Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h2Desktop.regular')};
  }

  strong {
    ${p => p.theme.mixins.acfTypography('global.h2Mobile.bold')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h2Desktop.bold')};
    }
  }
`

export const H3 = styled.h3`
  ${p => p.theme.mixins.acfTypography('global.h3Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h3Desktop.regular')};
  }

  strong {
    ${p => p.theme.mixins.acfTypography('global.h3Mobile.bold')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h3Desktop.bold')};
    }
  }
`

export const H4 = styled.h3`
  ${p => p.theme.mixins.acfTypography('global.h4Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h4Desktop.regular')};
  }
`

export const H5 = styled.h5`
  ${p => p.theme.mixins.acfTypography('global.h5Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h5Desktop.regular')};
  }
`

export const H6 = styled.h6`
  ${p => p.theme.mixins.acfTypography('global.h6Mobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.h6Desktop.regular')};
  }
`

export const Rte = ({
  ...props
}) => {
  const elRef = useRef()

  useEffect(() => {
    const lis = elRef.current.querySelectorAll('li')

    lis.forEach((li) => {      
      if ( li.classList.contains('u-wrapped') ) {
        return
      }
      
      li.innerHTML = `<div>${li.innerHTML}</div>`
      li.classList.add('u-wrapped')
    })        
  }, [elRef.current])

  return (
    <S_Rte {...props} ref={elRef} />
  )
}

const S_Rte = styled.div`
  ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
  }

  p {
    ${p => p.theme.mixins.acfTypography('global.bodyMobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.bodyDesktop.regular')};
    }
  }

  h1 {
    margin: 1em 0;

    ${p => p.theme.mixins.acfTypography('global.h1Mobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h1Desktop.regular')};
    }
  }

  h2 {
    margin: .5em 0;

    ${p => p.theme.mixins.acfTypography('global.h2Mobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h2Desktop.regular')};
    }
  }

  h3 {
    margin: .5em 0;

    ${p => p.theme.mixins.acfTypography('global.h3Mobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h3Desktop.regular')};
    }
  }

  h4 { 
    margin: 1em 0;

    ${p => p.theme.mixins.acfTypography('global.h4Mobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h4Desktop.regular')};
    }
  }

  h5 {
    margin: 1em 0;

    ${p => p.theme.mixins.acfTypography('global.h5Mobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h5Desktop.regular')};
    }
  }

  h6 {
    margin: 1em 0;

    ${p => p.theme.mixins.acfTypography('global.h6Mobile.regular')};
    
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.h6Desktop.regular')};
    }
  }

  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    text-align: left;
  }

  li {
    display: flex;
    align-items: baseline;
    margin: 0 0 1em 0;

    &:last-child {
      margin: 0;
    }

    &:before {
      margin: 0 1.3em 0 0;
      content: '';
      display: block;
      width: 10px;
      height: 10px;
      flex: 0 0 10px;
      border-radius: 50%;
      background-color: ${p => p.theme.global?.overrideListBulletColor ? p.theme.mixins.acfColor('global.listBulletColor') : 'currentColor'};
      outline: 1px solid ${p => p.theme.global?.overrideListBulletColor ? p.theme.mixins.acfColor('global.listBulletColor') : 'currentColor'};
      outline-offset: 2px;      
    }
  }

  a {
    color: ${p =>
      p.theme.mixins.acfColor('global.hyperlinkColor') ||
      p.theme.colors.black
    };
    font-weight: ${p => p.theme.global?.hyperlinkFontWeight};

    &:hover {
      text-decoration: underline;
    }
  }

  img {
    width: 100%;
    height: auto !important;
  }

  > * {
    &:first-child {
      margin-top: 0;
    }
    &:last-child {
      margin-bottom: 0;
    }
  }    
`
