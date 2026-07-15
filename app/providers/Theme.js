import { useEffect, useRef, useState, useContext } from 'react'
import Head from 'next/head'
import { ThemeProvider, createGlobalStyle } from 'styled-components'
import ResizeObserver from 'resize-observer-polyfill'

import { safeHtmlParser } from 'utils/dom'
import * as global from 'styles/globals'
import * as grid from 'styles/grid'
import * as button from 'styles/button'
import colors from 'styles/colors'
import * as media from 'styles/media'
import * as mixins from 'styles/mixins'
import zindex from 'styles/zindex'
import AppContext from 'contexts/App'

const GlobalStyle = createGlobalStyle`
  ${global.body};
  ${global.modal};
  ${global.localeSelector};
`

const Theme = ({ children }) => {
  const { customize } = useContext(AppContext)
  const [headerHeight, setHeaderHeight] = useState(0)
  const [headerContentHeight, setHeaderContentHeight] = useState(0)
  const headerObserverRef = useRef()
  const headerContentObserverRef = useRef()

  useEffect(() => {
    const header = document.querySelector('.js-header')
    const headerContent = document.querySelector('.js-header-content')

    if ( !header ) {
      return
    }
    
    headerObserverRef.current = new ResizeObserver((entries) => {
      setHeaderHeight(entries[0].contentRect.height)
    })

    headerContentObserverRef.current = new ResizeObserver((entries) => {
      setHeaderContentHeight(entries[0].contentRect.height)
    })

    headerObserverRef.current.observe(header)
    headerContentObserverRef.current.observe(headerContent)
    return () => {
      headerObserverRef.current.unobserve(header)
      headerContentObserverRef.current.unobserve(headerContent)
    }
  }, [headerObserverRef.current, headerContentObserverRef.current])
  
  return (
    <ThemeProvider theme={{
      button,
      colors,      
      grid,
      media,
      mixins,
      zindex,
      headerHeight, 
      headerContentHeight, 
      global: customize?.global
    }}>
      <Head>
        {safeHtmlParser(customize?.global.typographyEmbed)}
      </Head>
      
      <GlobalStyle />
      {children}
    </ThemeProvider>
  )
}

export default Theme
