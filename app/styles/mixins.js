import { useContext } from 'react'
import { css, ThemeContext } from 'styled-components'
import get from 'lodash/get'
import first from 'lodash/first'

import AppContext from 'contexts/App'

export const fill = position => {
  return `
    position: ${position};
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  `
}

export const center = position => {
  return `
    position: ${position};
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
  `
}

export const vCenter = position => {
  return `
    position: ${position};
    top: 50%;
    transform: translateY(-50%);
  `
}

export const hCenter = position => {
  return `
    position: ${position};
    left: 50%;
    transform: translateX(-50%);
  `
}

export const linkDecoration = color => {
  return css`
    position: relative;
    display: inline-block;
      
    &:after {
      position: absolute;
      display: block;
      content: '';
      width: 0;
      height: 1px;
      bottom: -2px;
      left: auto;
      right: 0;
      background-color: ${p => color || 'currentColor'};
      z-index: 1;
      will-change: width;
      transition: 
        width 200ms cubic-bezier(0.25, 0.1, 0.25, 1);
      }    
    
     &.is-active:after {
        width: 100%;
        transition: 
        width 200ms cubic-bezier(0.25, 0.1, 0.25, 1);
      }
    
    @media (hover:hover) {
      a:hover &:after,
      &:hover:after {
        width: 100%;
        left: 0;
        right: auto;
        transition: 
        width 200ms cubic-bezier(0.25, 0.1, 0.25, 1);
      }
    }
  `
}

export const linkFade = (opacity=.75) => {  
  return css`    
    transition: opacity 250ms ease;

    @media(hover:hover) {
      a:hover &,
      &:hover {
        opacity: ${opacity};
      }      
    }
  `
}

export const linkZoomImg = trigger => {
  return css`
    position: relative;
    overflow: hidden;

    img {
      display: block;
      backface-visibility: hidden;
      transition: transform 500ms ease, opacity 300ms ease;
    }

    @media (hover: hover) {
      a:hover & img,
      &:hover img {
        transform: scale(1.04);
      }        
    }    
  `  
}

export const acfColor = path => {  
  const { customize } = useContext(AppContext)
    
  // either find the color based on config path within the customize object,
  // or simply pass the color name directly as 'path'

  const name = get(customize, path)

  if ( name === 'transparent' ) {
    return name
  }
  
  return customize?.global.colors?.find(c => c.name === (name || path))?.color || ''
}

export const acfTypography = path => {
  const { customize } = useContext(AppContext)
  
  let fontFamily = customize?.global.fontFamilies?.find(f => f.label === get(customize, path + 'FontFamily'))

  if ( !fontFamily ) {
    fontFamily = first(customize?.global?.fontFamilies)
  }
  
  return css`
    font-family: ${get(fontFamily, 'family')};
    font-size: ${get(customize, path + 'FontSize') / 10}rem;
    font-weight: ${get(customize, path + 'FontWeight')};
    letter-spacing: ${get(customize, path + 'LetterSpacing') || '0'}em;
    line-height: ${get(customize, path + 'LineHeight')};
    text-transform: ${get(customize, path + 'TextTransform')};
  `
}
