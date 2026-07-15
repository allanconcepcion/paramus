import { useRef, useEffect, useState } from 'react'
import styled from 'styled-components'
import gsap from 'gsap'
import Draggable from 'gsap/dist/Draggable'
import InertiaPlugin from 'vendor/gsap/InertiaPlugin'

import WPImage from 'components/WPImage'
import Box from 'components/Box'
import { Icon } from 'components/SVGIcons'

const SplitSlides = ({
  imageA,
  imageB,
  boxWidth=3,
  boxHeight=2,
  label  
}) => {  
  const elRef = useRef()
  const imageAWrapperRef = useRef()
  const imageARef = useRef()
  const toolRef = useRef()
  const draggableRef = useRef()
  const toolButtonRef = useRef()
  const observerRef = useRef()
  const xRef = useRef(50)
  
  const onInteract = () => {
    const { width:maxWidth } = elRef.current.getBoundingClientRect()
    const { x } = draggableRef.current[0]

    xRef.current = ((x + 15) / maxWidth) * 100

    gsap.set(imageAWrapperRef.current, {
      width: `${xRef.current}%`
    })
  }

  useEffect(() => {    
    observerRef.current = new ResizeObserver((entries) => {
      const { width } = entries[0].contentRect

      if ( imageARef.current ) {
        imageARef.current.style.width = `${width}px`
        
        gsap.set(toolRef.current, {
          x: ((xRef.current / 100) * width) - 15
        })      
      }      
    })

    if ( observerRef.current && elRef.current  ) {
      observerRef.current.observe(elRef.current)
    }
        
    return () => {
      if ( observerRef.current && elRef.current ) {
        observerRef.current.unobserve(elRef.current)
      }      
    }
  }, [observerRef.current, elRef.current, toolRef.current, toolButtonRef.current])

  useEffect(() => {
    gsap.registerPlugin(Draggable)
    gsap.registerPlugin(InertiaPlugin)
    
    draggableRef.current = Draggable.create(toolRef.current, {
      bounds: elRef.current,
      trigger: toolButtonRef.current,
      type: 'x',
      zIndexBoost: false,
      dragResistance: 0,
      edgeResistance: .99,
      inertia: true,
      throwResistance: 2000,
      onDrag: onInteract,
      onDragEnd: onInteract,
      onThrowUpdate: onInteract
    })
  }, [toolRef.current])
  
  return (
    <S_SplitSlides ref={elRef}>
      <Box width={boxWidth} height={boxHeight}>
        <ImageAWrapper ref={imageAWrapperRef}>
          <ImageA ref={imageARef}>
            <WPImage
                image={imageA}
                layout='fill'
                objectFit='contain'
            />
          </ImageA>
        </ImageAWrapper>
        <ImageB>
          <WPImage
              image={imageB}
              layout='fill'
              objectFit='contain'
          />                      
        </ImageB>

        <Tool ref={toolRef} className='o-tool'>
          <ToolButton ref={toolButtonRef} className='o-tool-button'>
            <ToolButtonInner className='o-tool-button-inner'>
              <Icon icon='arrow-left' />
              <Icon icon='arrow-right' />
            </ToolButtonInner>
          </ToolButton>
        </Tool>

        
        <LabelA className='o-label'>Before</LabelA>
        <LabelB className='o-label'>After</LabelB>        
      </Box>     

      {label && (
        <TitleLabel>
          {label}
        </TitleLabel>
      )} 
    </S_SplitSlides>
  )
}

const S_SplitSlides = styled.div``

const ImageAWrapper = styled.div`
  position: absolute;
  top: 0;
  left: 0;
  width: 50%;
  height: 100%;
  z-index: 2;
  overflow: hidden;
`

const Image = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  user-select: none;
  pointer-events: none;
`

const ImageA = styled(Image)`

`

const ImageB = styled(Image)`

`

const Tool = styled.div`
  position: absolute;
  top: 0;
  left: 0;
  width: 30px;
  height: 100%;
  z-index: ${p => p.theme.zindex[3]};

  &:after {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 1px;
    height: 100%;   
    background-color: ${p => p.theme.colors.white};
    pointer-events: none;
  }
`

const ToolButton = styled.button`
  ${p => p.theme.mixins.center('absolute')};
  width: 30px;
  height: 30px;
  border-radius: 50%;
  color: ${p => p.theme.colors.white};
  background-color: ${p => p.theme.colors.black};
  border: solid 1px ${p => p.theme.colors.white};
  cursor: grab;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: center;

  &:active {
    cursor: grabbing;
  }
`

const ToolButtonInner = styled.span`
  display: flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  background-color: ${p => p.theme.colors.dkgray};

  .icon {
    font-size: .9rem;
    margin: 0 1px;
  }
`

const TitleLabel = styled.div`
  color: inherit;
  margin: 16px 0 0 0;

  .layout-a & {
    ${p => p.theme.mixins.acfTypography('modules.galleryA.navigationStyleMobile.regular')};    

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.galleryA.navigationStyleDesktop.regular')};        
    }
  }

  .layout-b & {
    ${p => p.theme.mixins.acfTypography('modules.galleryB.navigationStyleMobile.regular')};
  
    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.galleryB.navigationStyleDesktop.regular')};    
    }
  }

  .layout-c & {
    ${p => p.theme.mixins.acfTypography('modules.galleryC.navigationStyleMobile.regular')};

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('modules.galleryC.navigationStyleDesktop.regular')};      
    }
  }    
`

const Label = styled.div`
  display: inline-block;
  ${p => p.$position !== 'underImage' && p.theme.mixins.vCenter('absolute')};
  background-color: rgba(0,0,0,.6);
  color: ${p => p.theme.colors.white};
  padding: 5px 12px;
  font-size: 8px;
  z-index: 3;
  user-select: none;
  pointer-events: none;
`

const LabelA = styled(Label)`
  left: 10px;
`
const LabelB = styled(Label)`
  right: 10px;
`

export default SplitSlides
