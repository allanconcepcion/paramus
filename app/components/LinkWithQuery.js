import Link from 'next/link'
import { useRouter } from 'next/router'
import each from 'lodash/each'

export const restricted_params = [
  'pageUri'  
]

const LinkWithQuery = ({ children, href, ...props }) => {
  const router = useRouter()
    
  let query = []
  let finalHref = href

  each(router.query, ( value, key ) => {
    if ( restricted_params.indexOf(key) === -1 ) {
      query.push(`${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
    }    
  })

  if ( query.length > 0 ) {
    finalHref += `?${query.join('&')}`
  }  
  
  return (
    <Link href={finalHref || ''} {...props}>
      {children}
    </Link>
  )
}

export default LinkWithQuery