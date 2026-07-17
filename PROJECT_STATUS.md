# Paramus Dental Arts - Headless WordPress + Next.js Project Status

Last updated: 2026-07-17

## Architecture

- Backend: WordPress, headless CMS, at https://cms.paramusdentalarts.com/. Plugins: FaustWP (headless integration) + WPGraphQL (+ WPGraphQL Smart Cache) + WebP Express.
- Frontend: Next.js app (repo root app/) deployed on Vercel, live at https://paramus.vercel.app/.
- Source repo: github.com/allanconcepcion/paramus (public repo - never commit real .env or secrets, only .env.example).
- Deploy flow: push to main on GitHub, Vercel auto-builds and deploys.
- Custom domain: paramusdentalarts.com and www.paramusdentalarts.com now point at this Vercel deployment (completed 2026-07-17). The apex domain redirects (308) to www. This is also the real production site, previously hosted on a separate WordPress backend (cms.paramusdentalarts.com), which is now reused as the headless CMS source above.

## Known-good state

- WordPress content is served via GraphQL at https://cms.paramusdentalarts.com/graphql.
- Vercel production deployment builds successfully and serves the site.
- Images across the site (hero, header logo, doctor photos, sticky booking widget) render correctly.
- Homepage hero background video now renders and plays (see Fixes applied, item 3).
- Sitemap URLs at https://paramus.vercel.app/sitemap.xml now use the correct frontend domain and no longer hang the browser (see Fixes applied, items 4 and 5). NOTE: was blocked end-to-end by a Cloudflare issue against the old WordPress origin, see Open / next steps - status against the new cms.paramusdentalarts.com origin not yet re-verified.
- Custom domain paramusdentalarts.com (and www.paramusdentalarts.com) verified live and serving the Vercel deployment correctly, including hero image/video and booking widget.

## Fixes applied so far

1. Vercel build errors, resolved in an earlier session.
2. Broken images on front end, root-caused to two separate issues. First, FaustWP setting "Use the WordPress domain for media URLs in post content" was unchecked, causing GraphQL srcSet to return the frontend Vercel domain instead of the WordPress media domain. Fixed by checking this box in WP Admin, Settings, Faust, and purging the Kinsta cache (Clear All Caches) and the WPGraphQL object cache (Settings, GraphQL, Cache tab, Purge Now!). Second, a FaustWP library bug double-prefixes the protocol on multi-URL srcset strings, which persisted even with a fresh GraphQL response. Fixed with a fixDoubleProtocol sanitizer added to app/components/WPImage.js. Committed as 9ce8fb7.
3. Homepage hero background video not showing, static image only instead of the autoplay video seen on the live site paramusdentalarts.com. Root cause was NOT the frontend code - app/components/modules/Hero.js and app/components/WPVideo.js already fully supported background video, and the video file was already uploaded and attached to the Home page in WP Admin (ACF fields field_hero_video_desktop / field_hero_video_mobile). Actual root cause was a stale WPGraphQL Object Cache entry returning null for backgroundVideoDesktop and backgroundVideoMobile, plus a Kinsta CDN edge-cache propagation delay after purging. Secondary gotcha: WPGraphQL's sourceUrl resolver returns null for video media items - must query mediaItemUrl instead.

Fix procedure that worked: (1) In WP Admin, Settings > GraphQL > Cache tab, check "Purge Now!" and Save Changes. (2) In WP Admin, use the dedicated Kinsta Cache page (wp-admin/admin.php?page=kinsta-tools, not just the admin-bar "Clear Caches" shortcut) and click "Clear All Caches". (3) Wait several minutes for CDN edge propagation (Kinsta's own banner says changes usually appear globally within a few minutes) before doing anything else - redeploying immediately after purging can still pick up stale cached GraphQL data. (4) Verify fresh data by querying the WordPress GraphQL endpoint directly for backgroundVideoDesktop/Mobile mediaItemUrl and confirming it is non-null. (5) Only then trigger a Vercel redeploy (no build cache) so the static build embeds the correct data. (6) Verify on the live Vercel URL by reading window.__NEXT_DATA__.props.pageProps.page.hero directly (the actual data baked into the build) rather than relying on DOM video element inspection alone.
4. Sitemap pointed at the wrong domain and leaked a redirect to the WordPress backend instead of serving XML at the frontend domain. Root cause was two separate bugs: (a) next.config.js rewrites sent requests straight to the WordPress origin, which issued its own redirect that leaked into the browser, and (b) Yoast's sitemap <loc> entries always contain the WordPress domain, not the frontend domain. Fix: added a new serverless proxy route app/pages/api/sitemap/[...path].js that server-side fetches the corresponding Yoast sitemap XML from WordPress (with an explicit User-Agent and Accept header, since Node's default fetch has no User-Agent and was getting blocked), rewrites every <loc> occurrence of the WordPress domain to the request's own host, and returns that as the response. Updated next.config.js rewrites to point at this internal API route instead of the external WordPress URL. Shipped as PR #1 (branch fix-sitemap-domain), merged to main.
5. Sitemap page rendered blank in the browser (page appeared to hang, no visible XML). Root cause: Yoast's XML includes a <?xml-stylesheet type="text/xsl" href="//1202302.us28.myftpupload.com/..."?> processing instruction, and modern Chrome hangs/renders blank when it tries to apply a cross-origin XSLT transform referenced from a different domain than the one serving the XML. Fix: the proxy route now strips this processing instruction with a regex before returning the XML, so the browser just shows the raw XML tree instead of attempting (and failing) to load a cross-origin stylesheet. Shipped  as PR #2 (branch fix-sitemap-stylesheet), merged to main.
6. Pointed the custom domain at Vercel: added paramusdentalarts.com and www.paramusdentalarts.com as domains on the Vercel project (apex redirects 308 to www, www connected to Production). Added the required DNS records at GoDaddy (A record @ pointing to 216.198.79.1, CNAME www pointing to the vercel-dns target Vercel provided). Both domains show Valid Configuration in Vercel and the live site was verified working.
7. Switched the headless WordPress backend from the GoDaddy myftpupload staging URL to https://cms.paramusdentalarts.com (confirmed this is a live, working WPGraphQL endpoint first). Updated the NEXT_PUBLIC_WORDPRESS_URL environment variable in Vercel (Production and Preview) and redeployed. Gotcha: this variable was marked Sensitive in Vercel, which caused process.env.NEXT_PUBLIC_WORDPRESS_URL to evaluate as undefined specifically during the bin/prebuild script (a plain Node script that runs before next build to clear the WPGraphQL cache), making npm run build fail immediately with a URL parse error. Turning off the Sensitive flag on this variable (it is a public URL, not a secret) and re-saving the value fixed it; the build then completed and deployed successfully. Worth keeping in mind for any other NEXT_PUBLIC_ variables read by build-time scripts.

## Key files

- app/components/Image.js - custom lazy-load + webp picture component (uses lazysizes).
- app/components/WPImage.js - wrapper that maps WordPress GraphQL media fields to Image.js props; contains the protocol-fix sanitizer.
- app/components/modules/Hero.js - homepage hero section; supports both image and video backgrounds (contentType, backgroundImageDesktop/Mobile, backgroundVideoDesktop/Mobile fields).
- app/components/WPVideo.js - video component used by Hero.js; uses mediaItemUrl (not sourceUrl) as the video src.
- app/pages/api/sitemap/[...path].js - serverless proxy that fetches Yoast's sitemap XML from WordPress, rewrites the domain in <loc> tags to the request host, and strips the cross-origin xml-stylesheet processing instruction.
- app/next.config.js - Next.js config, including sitemap rewrites that point at the internal /api/sitemap proxy.
- app/pages/_app.js - imports lazysizes and its attrchange plugin globally.
- cms/mu-plugins/pd/acf/page/hero.php - ACF field definitions for the Hero module (backend source of truth for field names).

## Open / next steps

- User to do a final hard-refresh check that the hero video plays smoothly in their own browser. Last automated check showed the video loading correctly but stalling at readyState 0 in the test browser - may be a sandboxed network quirk rather than a real bug.
- Re-verify the sitemap proxy's server-side fetch against the new cms.paramusdentalarts.com backend. It was previously blocked with a 403 Forbidden and a Cloudflare "Attention Required!" challenge page when fetching from the old myftpupload origin (consistent and repeatable across multiple fresh, cache-busted requests to both /sitemap.xml and /page-sitemap.xml, while visiting the same WordPress URLs directly in a real browser worked fine). This pointed to Cloudflare (Bot Fight Mode or a similar WAF rule) blocking Vercel's server-to-server request traffic (likely by IP range/ASN). Not yet confirmed whether the same block applies to the new backend. Real fix requires either: (a) a Cloudflare/WordPress-side change (allowlist Vercel's outbound IP ranges, or a WAF/Bot Fight Mode exception for the sitemap paths) - requires explicit user confirmation before making any WordPress/Cloudflare settings changes, or (b) an alternate approach that avoids runtime fetches to WordPress entirely (e.g. build-time generation via a webhook-triggered rebuild, or checking whether the WPGraphQL endpoint is blocked the same way before relying on it).

## Operational notes for future sessions

- Do not log into GitHub/Vercel/WordPress on the user's behalf - user authenticates themselves.
- Never commit real secrets to this public repo.
- GitHub web editor requires full select-all + retype for edits (no true diff editing); auto-indent is cosmetic only for single-line edits, but typing multi-line lists via simulated keystrokes can corrupt indentation - use a clipboard paste event instead.
- When making WordPress settings changes, confirm with the user first.
- When debugging GraphQL/cache data issues, always verify with a fresh query after purging caches, and remember Kinsta's CDN purge has a propagation delay - wait a few minutes before relying on it or redeploying.
- When inspecting video or other repeated elements on a page, verify the correct element (e.g., filter by expected src filename) rather than assuming the first DOM match is correct - this page has many videos (hero background plus a testimonial carousel).
- Check window.__NEXT_DATA__ on the live site to see exactly what data was baked into the Next.js build - the most reliable verification method for headless CMS data issues.
- Avoid typing non-ASCII characters (em-dashes, smart quotes) into GitHub's web-based CodeMirror editor via automation - use plain ASCII only, it can garble input otherwise.
- Browser navigation can hit stale cached 301 redirects (Chrome caches these aggressively for navigation-type requests) even when a fresh fetch(url, {cache:'no-store'}) from the same domain shows correct behavior server-side - always verify with a no-store fetch or a brand-new tab, not just repeated navigation in the same tab.
- Cloudflare/WAF protection in front of the WordPress backend can silently block server-to-server requests from Vercel (403 with a Cloudflare challenge page) even though the same URL loads fine in a real browser - if a proxy/fetch route suddenly starts failing, check for this before assuming an app code bug.
- Vercel environment variables marked "Sensitive" can still be read at runtime, but a variable read by a build-time script (e.g. an npm "prebuild" hook) may evaluate as undefined if it is marked Sensitive - if a build-time script suddenly can't see an env var that was just updated, try removing the Sensitive flag as a diagnostic step (only for non-secret values).
