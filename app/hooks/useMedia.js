import { useMediaQuery } from '@react-hook/media-query'
import { minWidth } from 'styles/media'

export const useMinWidth = ( breakpoint ) => {
  return useMediaQuery(
    minWidth(breakpoint).replace('@media', '')
  )
}
