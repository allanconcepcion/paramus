import styled, { css } from 'styled-components'

import {
  containerPadding,
  columnCount,
  columnGutter,
  unit
} from 'styles/grid'

import {
  minWidth,
  propMap,
  breakpoints  
} from 'styles/media'

export const Container = styled.div`
  position: relative;
  margin: 0 auto;
  padding: 0 ${containerPadding.mb}px;
  width: 100%;
  overflow: ${p => p.$overflow || 'hidden'};
  max-width: 1440px;
  ${p => renderContainerStyles(p)};
`

export const Row = styled.div`
  position: relative;
  display: flex;
  flex-wrap: wrap;
  min-width: 100%;
  margin-left: -${(columnGutter['mb'] / 2)}px;
  margin-right: -${(columnGutter['mb'] / 2)}px;

  ${p => p.theme.media.minWidth('tablet')} {
    margin-left: -${(columnGutter['tb'] / 2)}px;
    margin-right: -${(columnGutter['tb'] / 2)}px;        
  }

  ${p => p.theme.media.minWidth('desktop')} {
    margin-left: -${(columnGutter['dk'] / 2)}px;
    margin-right: -${(columnGutter['dk'] / 2)}px;        
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    margin-left: -${(columnGutter['xl'] / 2)}px;
    margin-right: -${(columnGutter['xl'] / 2)}px;        
  }

  ${p => renderRowStyles(p)};  
`

export const Col = styled.div`
  position: relative;
  flex: 0 0 100%;
  max-width: 100%;
  padding-left: ${(columnGutter['mb'] / 2)}px;
  padding-right: ${(columnGutter['mb'] / 2)}px;        

  ${p => p.theme.media.minWidth('tablet')} {
    padding-left: ${(columnGutter['tb'] / 2)}px;
    padding-right: ${(columnGutter['tb'] / 2)}px;        
  }

  ${p => p.theme.media.minWidth('desktop')} {
    padding-left: ${(columnGutter['dk'] / 2)}px;
    padding-right: ${(columnGutter['dk'] / 2)}px;        
  }

  ${p => p.theme.media.minWidth('xlarge')} {
    padding-left: ${(columnGutter['xl'] / 2)}px;
    padding-right: ${(columnGutter['xl'] / 2)}px;        
  }

  ${p => renderColStyles(p)};
`

const renderContainerStyles = ( props ) => {
  let styles = ''

  for ( const [k, v] of Object.entries(propMap) ) {    
    if ( props.padding && typeof(props.padding[k]) !== 'undefined' ) {
      const factor = props.padding[k]
      
      styles += `
          ${minWidth(v)} {
            padding: 0 ${unit * factor}px !important;
          }
        `
    } else {
      styles += `
          ${minWidth(v)} {
            padding: 0 ${containerPadding[k]}px;
          }
        `        
    }
  }  

  if ( props.maxWidth ) {
    const width = typeof(props.maxWidth) === 'number' ?
      props.maxWidth : breakpoints[props.maxWidth]

    styles += `      
      max-width: ${width}px;
    `
  } else if ( props.maxWidth === false ) {
    styles += `      
      max-width: none;
    `
  }

  if ( props.fullBleed ) {
    styles += `      
      padding: 0 !important;
      max-width: none !important;
    `
  }  

  return css`${styles}`
}

const renderRowStyles = ( props ) => {
  let styles = ''

  if ( props.gutter ) {
    for ( const [k, v] of Object.entries(propMap) ) {
      const factor = props.gutter[k]

      if ( typeof(factor) !== 'undefined' ) {
        styles += `
          ${minWidth(v)} {
            margin-left: -${(columnGutter[k] / 2) * factor}px;
            margin-right: -${(columnGutter[k] / 2) * factor}px;
          
            > ${Col} {           
              padding-left: ${(columnGutter[k] / 2) * factor}px;
              padding-right: ${(columnGutter[k] / 2) * factor}px;        
            }     
          }
        `
      }           
    }
  }
    
  if ( props.flexDirection ) {
    for ( const [k, v] of Object.entries(propMap) ) {
      if ( props.flexDirection[k] ) {      
        styles += `
          ${minWidth(v)} {
            flex-flow: ${props.flexDirection[k]};
          }
        `
      }       
    }  
  }

  if ( props.justifyContent ) {
    for ( const [k, v] of Object.entries(propMap) ) {
      if ( props.justifyContent[k] ) {      
        styles += `
          ${minWidth(v)} {
            justify-content: ${props.justifyContent[k]};
          }
        `
      }       
    }  
  }

  if ( props.alignItems ) {
    for ( const [k, v] of Object.entries(propMap) ) {
      if ( props.alignItems[k] ) {      
        styles += `
          ${minWidth(v)} {
            align-items: ${props.alignItems[k]};
          }
        `
      }       
    }  
  }  

  return css`${styles}`
}

const renderColStyles = ( props ) => {
  let styles = ''
  
  for ( const [k, v] of Object.entries(propMap) ) {
    if ( props[k] ) {
      styles += `
        ${minWidth(v)} {
          flex: 0 0 ${(props[k]/columnCount[k])*100}%;
          max-width: ${(props[k]/columnCount[k])*100}%;
        }                
      `
    }

    const kPush = `${k}Push`
    if ( props[kPush] ) {
      styles += `
        ${minWidth(v)} {
          margin-left: ${(props[kPush]/columnCount[k])*100}%;
        }                
      `
    }
  }

  return css`${styles}`
}
