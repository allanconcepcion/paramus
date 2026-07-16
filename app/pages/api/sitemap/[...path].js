export default async function handler(req, res) {
  const serverApiUrl = (process.env.NODE_ENV === 'development' && process.env.NEXT_PUBLIC_DOCKER_WORDPRESS_URL)
    || process.env.NEXT_PUBLIC_WORDPRESS_URL

  const wpBase = serverApiUrl.replace(/\/$/, '')
  const wpHost = new URL(wpBase).host
  const wpHostEscaped = wpHost.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')

  const segments = Array.isArray(req.query.path) ? req.query.path : [req.query.path].filter(Boolean)
  let requestPath = '/' + segments.join('/')

  // WordPress/Yoast redirects /sitemap.xml -> /sitemap_index.xml. Fetch the
  // real target server-side so the browser never sees the WordPress domain.
  if (requestPath === '/sitemap.xml') {
    requestPath = '/sitemap_index.xml'
  }

  try {
    const wpResponse = await fetch(`${wpBase}${requestPath}`, { redirect: 'follow' })

    if (!wpResponse.ok) {
      res.status(wpResponse.status).end()
      return
    }

    let xml = await wpResponse.text()

    const protocol = req.headers['x-forwarded-proto'] || (req.socket && req.socket.encrypted ? 'https' : 'http')
    const requestHost = req.headers['host']

    // Only rewrite URLs inside <loc> tags so the XSL stylesheet reference
    // (which still needs to load from WordPress) is left untouched.
    xml = xml.replace(
      new RegExp(`(<loc>)https?://${wpHostEscaped}(/[^<]*)?(</loc>)`, 'g'),
      (match, open, path, close) => `${open}${protocol}://${requestHost}${path || ''}${close}`
    )

    res.setHeader('Content-Type', 'application/xml')
    res.status(200).send(xml)
  } catch (e) {
    res.status(502).end()
  }
}
