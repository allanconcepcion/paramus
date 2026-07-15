import { NextResponse } from 'next/server'

export default async function _middleware(req) {      
  /* const sitemapRequest = await handleSitemapRequests(req, {
    wpUrl: process.env.NEXT_PUBLIC_DOCKER_WORDPRESS_URL || process.env.NEXT_PUBLIC_WORDPRESS_URL,
    sitemapIndexPath: `/sitemap_index.xml`,
    sitemapPathsToIgnore: ['/author-sitemap.xml'],    
    async robotsTxt() {
      return `
        User-agent: *
        Allow: /
        Sitemap: ${req.nextUrl.protocol}//${req.headers.get('host')}/sitemap_index.xml
      `;
    },
  });

  if ( sitemapRequest ) {
    return sitemapRequest
  }   */

  const hostname = req.headers.get('host') || req.nextUrl.hostname

  if ( !hostname.match(/^localhost/) && 
       process.env.NODE_ENV === 'production' && 
       !req.headers?.get("x-forwarded-proto")?.includes("https")
  ) {     
    return NextResponse.redirect(`https://${hostname}${req.nextUrl.pathname}`, 301)
  }    

  if ( process.env.FORCE_WWW === 'true' && !hostname.match(/^www\./) ) {
    return NextResponse.redirect(`https://www.${hostname}${req.nextUrl.pathname}`, 301)
  }

  return NextResponse.next()
} 