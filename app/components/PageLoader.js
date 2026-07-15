import { useEffect, useRef, useState, useContext } from 'react'
import styled from 'styled-components'
import gsap from 'gsap'

import AppContext from 'contexts/App'

const PageLoader = () => {
  const elRef = useRef()
  
  useEffect(() => {
    gsap.to(elRef.current, 1.25, {
      autoAlpha: 0,
      ease: 'power4.out',
      delay: .25,
    })
  }, [elRef])

  return (
    <S_PageLoader ref={elRef} />    
  )
}

const S_PageLoader = styled.div`
  ${p => p.theme.mixins.fill('fixed')};
  background-color: ${p => p.theme.colors.black};
  pointer-events: none;
  z-index: ${p => p.theme.zindex[9]};
`

export default PageLoader
