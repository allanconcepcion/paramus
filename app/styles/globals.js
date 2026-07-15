import { css } from 'styled-components'

export const body = css`
  body {    
    background-color: ${p => p.theme.colors.white};
  }

  #cc-main .cm {
    max-width: 36rem;
  }

  #cc-main .cm__texts {
    padding: 2rem 0 0;
  }

  #cc-main .cm__title, 
  #cc-main .cm__desc {
    padding: 0 2rem;
  }

  #cc-main .cm__desc {
    font-size: 1.3rem;
  }

  #cc-main .cm__btns {
    padding: 1.5rem 2rem;
  }

  #cc-main .cm__links {
    padding-left: 2rem;
    padding-right: 2rem;
  }
`

export const modal = css`
  .ReactModal__Overlay {
    display: flex;
    z-index: 10000;
    background: rgba(0,0,0,.6) !important;
    padding: 20px;
    overflow-y: auto;
  }

  .ReactModal__Content {
    position: relative !important;
    inset: auto !important;
    width: 100%;
    margin: auto;
    border: none !important;
    padding: 0 !important;
    background-color: transparent !important;
    border-radius: 0 !important;
  }
`

export const localeSelector = css`
  .weglot-container {
    z-index: ${p => p.theme.zindex[5]} !important;
  }

  .country-selector {
    left: 0 !important;
    right: auto !important;

    ${p => p.theme.media.minWidth('desktop')} {
      top: ${p => p.theme.headerHeight}px;
      bottom: auto !important;
      left: auto !important;
      right: 0 !important;
      width: ${p => p.theme.headerContentHeight}px !important;
    }    
  }
`