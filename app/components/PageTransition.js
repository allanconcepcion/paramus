import styled from 'styled-components'
import { motion } from 'framer-motion'

const PageTransition = () => {  
  const inVariants = {
    initial: { bottom: 0, height: 0 },    
    animate: { bottom: 0, height: 0 },
    exit: { bottom: 0, height: '100vh' }   
  }

  const outVariants = {
    initial: { top: 0, height: '100vh' },
    animate: { top: 0, height: '100vh', opacity: 0 },
    exit: { top: 0, height: '100vh' }
  }
  
  return (
    <S_PageTransition>
      <InMask
        key='page-transition-in'
        as={motion.div}
        initial='initial'
        animate='animate'
        exit='exit'
        variants={inVariants}
        transition={{ type: 'tween', duration: .5, ease: [0.22, 1, 0.36, 1] }}
      />
      <OutMask
          key='page-transition-out'
          as={motion.div}
          initial='initial'
          animate='animate'
          exit='exit'
          variants={outVariants}
          transition={{ type: 'tween', duration: 1, delay: .2 }}
      />      
    </S_PageTransition>
  )
}

const S_PageTransition = styled.div``

const Mask = styled.div`
  position: fixed;
  width: 100%;
  background-color: ${p => p.theme.colors.black};
  z-index: ${p => p.theme.zindex[8]};
  pointer-events: none;
`

const InMask = styled(Mask)`
  bottom: 0;
`

const OutMask = styled(Mask)`
  top: 0;
`

export default PageTransition
