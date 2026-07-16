const isDev = process.env.NODE_ENV === 'development'

const domains = []

const wordpressUrl = new URL(process.env.NEXT_PUBLIC_WORDPRESS_URL)

domains.push(wordpressUrl.hostname)

if ( isDev ) {
  try {
    const dockerWordpressUrl = new URL(process.env.NEXT_PUBLIC_DOCKER_WORDPRESS_URL)
    domains.push(dockerWordpressUrl.hostname)
  } catch ( e ) {}
}

const serverApiUrl = (isDev && process.env.NEXT_PUBLIC_DOCKER_WORDPRESS_URL) || process.env.NEXT_PUBLIC_WORDPRESS_URL

module.exports = {
  trailingSlash: true,
  serverRuntimeConfig: {
    apiUrl: serverApiUrl
  },
  publicRuntimeConfig: {
    apiUrl: process.env.NEXT_PUBLIC_WORDPRESS_URL
  },
  compiler: {
    styledComponents: true,
  },
  images: {
    domains,
    formats: ['image/webp'],
    minimumCacheTTL: 31536000
  },
  headers: async () => {
    return [
      {
        source: '/(.*)?',
        headers: [
          {
            key: 'X-Frame-Options',
            value: 'DENY',
          },
          {
            key: 'Content-Security-Policy',
            value: "frame-ancestors 'self'"
          },
          {
            key: 'Referrer-Policy',
            value: 'strict-origin-when-cross-origin'
          }
        ]
      }
    ]
  },
  rewrites: async () => {
    const sitemaps = [
      {
        source: '/robots.txt',
        destination: '/api/robots'
      },
      {
        source: '/:path(.*sitemap\.xml)',
        destination: '/api/sitemap/:path',
      },
      {
        source: '/sitemap:path(.*).xml',
        destination: '/api/sitemap/sitemap:path.xml',
      }
    ]

    return [
      ...sitemaps
    ]
  },
  redirects: async () => {
    const admin = [
      {
        source: '/admin',
        destination: `${wordpressUrl}/wp-admin`,
        permanent: true,
      },
      {
        source: '/wp-admin',
        destination: `${wordpressUrl}/wp-admin`,
        permanent: true,
      },
      {
        source: '/wp-content/:path*',
        destination: `${wordpressUrl}wp-content/:path*`,
        permanent: false,
      }
    ]

    let apiEndpoint = process.env.NEXT_PUBLIC_WORDPRESS_URL
    if ( process.env.NEXT_PUBLIC_DOCKER_WORDPRESS_URL ) {
      apiEndpoint = process.env.NEXT_PUBLIC_DOCKER_WORDPRESS_URL
    }

    let redirects = []

    const response = await fetch(`${apiEndpoint}/graphql`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        query: `{
          redirects {
            urlFrom
            urlTo
            status
          }
        }`
      })
    })

    const json = await response.json()

    if ( !json.errors ) {
      redirects = json.data.redirects.map(r => ({
        source: `${!r.urlFrom.match(/^\//) ? '/' : ''}${r.urlFrom.replace(/\/$/, '')}`,
        destination: r.urlTo,
        permanent: r.status == 301
      })).filter(r => !!r.destination)
    }

    return [
      ...admin,
      ...redirects
    ]
  }
}
