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
    const wpResponse = await fetch(`${wpBase}${requestPath}`, {
      redirect: 'follow',
      headers: {
        'User-Agent': 'Mozilla/5.0 (compatible; ParamusSitemapProxy/1.0; +https://paramusdentalarts.com)',
        'Accept': 'application/xml,text/xml,*/*'
      }
    })

    if (!wpResponse.ok) {
      const bodyText = await wpResponse.text().catch(() => '')
      res.status(wpResponse.status)
      res.setHeader('Content-Type', 'text/plain')
      res.send(`Upstream sitemap fetch failed: ${wpResponse.status} ${wpResponse.statusText}\n${bodyText.slice(0, 500)}`)
      return
    }

    let xml = await wpResponse.text()

    // Strip the Yoast XSL stylesheet processing instruction. It points at
    // the WordPress domain, and browsers hang/render a blank page trying to
    // apply a cross-origin XSLT transform to it. Removing it just makes
    // browsers show the raw XML instead - crawlers ignore it either way.
    xml = xml.replace(/<\?xml-stylesheet[^>]*\?>\s*/i, '')

    const protocol = req.headers['x-forwarded-proto'] || (req.socket && req.socket.encrypted ? 'https' : 'http')
    const requestHost = req.headers['host']

    // Only rewrite URLs inside <loc> tags.
    xml = xml.replace(
      new RegExp(`(<loc>)https?://${wpHostEscaped}(/[^<]*)?(</loc>)`, 'g'),
      (match, open, path, close) => `${open}${protocol}://${requestHost}${path || ''}${close}`
    )

    res.setHeader('Content-Type', 'application/xml')
    res.status(200).send(xml)
  } catch (e) {
    res.status(502)
    res.setHeader('Content-Type', 'text/plain')
    res.send(`Sitemap proxy error: ${e.message}`)
  }
}
