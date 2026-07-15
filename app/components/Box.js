import { useState, useEffect } from 'react'
import styled from 'styled-components'

const Box = ({
  children, 
  radius=0,
  className,
  ...props
}) => {
  const [width, setWidth] = useState(props.width || 1)
  const [height, setHeight] = useState(props.height || 1)
  const [offset, setOffset] = useState(props.offset || 0)

  useEffect(() => {
    setWidth(props.width || 1)
    setHeight(props.height || 1)
    setOffset(props.offset || 0)
    
  }, [
    props.width,
    props.height,
    props.offset
  ])
  
  return (
    <S_Box
      className={className}
      _width={width}
      _height={height}
      _offset={offset}
      _radius={radius}
    >
      <Inner>      
        {children}
      </Inner>      
    </S_Box>
  )
}

const S_Box = styled.div`
  position: relative;
  padding-top: calc(${p => p._height/p._width * 100}% + ${p => p._offset}px);
  border-radius: ${p => p._radius}px; 
  overflow: hidden;
`

const Inner = styled.div`
  ${p => p.theme.mixins.fill('absolute')};
  overflow: hidden;
`

export default Box
