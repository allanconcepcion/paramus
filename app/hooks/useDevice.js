export const isTouch = () => {
  return typeof(window) !== 'undefined' && 'ontouchstart' in window
}
