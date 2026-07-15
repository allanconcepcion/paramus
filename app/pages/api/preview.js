export default function handler(req, res) {
  res.setPreviewData({}, { maxAge: 60 })
  
  res.redirect(req.query.url)
}