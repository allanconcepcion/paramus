export default function handler(req, res) {  
  const protocol = req.headers["x-forwarded-proto"] || req.connection.encrypted ? "https" : "http"

  res.send(`
    User-agent: *
    Allow: /
    Sitemap: ${protocol}://${req.headers['host']}/sitemap_index.xml
  `)
}