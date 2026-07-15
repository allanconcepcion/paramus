export const propMap = {
  mb:   'mobile',
  mblg: 'mobile-large',
  tb:   'tablet',
  tblg: 'tablet-large',
  dk:   'desktop',
  lg:   'large',
  xl:   'xlarge',
  xxl:  'xxlarge'
}

export const breakpoints = {
  'mobile':       0,
  'mobile-large': 568,
  'tablet':       768,
  'tablet-large': 900,
  'desktop':      1024,
  'large':        1200,
  'xlarge':       1440,
  'xxlarge':      1600
}

export const minWidth = breakpoint => {
  return `@media (min-width: ${breakpoints[breakpoint]}px)`
}

export const maxWidth = breakpoint => {
  return `@media (max-width: ${breakpoints[breakpoint] - 1}px)`
}
