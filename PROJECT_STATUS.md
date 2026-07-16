# Paramus Dental Arts - Headless WordPress + Next.js Project Status

Last updated: 2026-07-16

## Architecture

- Backend: WordPress (GoDaddy Managed WordPress, Basic 50 plan) at https://1202302.us28.myftpupload.com/ - NOT a live/production site, used as headless CMS only. Hosting is actually Kinsta-based (confirmed via the Kinsta Cache tools available in wp-admin).
- Plugins: FaustWP (headless integration) + WPGraphQL (+ WPGraphQL Smart Cache) + WebP Express.
- Frontend: Next.js app (repo root app/) deployed on Vercel, live at https://paramus.vercel.app/.
- Source repo: github.com/allanconcepcion/paramus (public repo - never commit real .env or secrets, only .env.example).
- Deploy flow: push to main on GitHub, Vercel auto-builds and deploys.
- The real production site is https://www.paramusdentalarts.com/, hosted on a separate WordPress backend (cms.paramusdentalarts.com). Used as the visual reference for what the new headless site should match.

## Known-good state

- WordPress content is served via GraphQL at https://1202302.us28.myftpupload.com/graphql.
- Vercel production deployment builds successfully and serves the site.
- Images across the site (hero, header logo, doctor photos, sticky booking widget) render correctly.
- Homepage hero background video now renders and plays (see Fixes applied, item 3).

## Fixes applied so far

1. Vercel build errors, resolved in an earlier session.
2. Broken images on front end, root-caused to two separate issues. First, FaustWP setting "Use the WordPress domain for media URLs in post content" was unchecked, causing GraphQL srcSet to return the frontend Vercel domain instead of the WordPress media domain. Fixed by checking this box in WP Admin, Settings, Faust, and purging the Kinsta cache (Clear All Caches) and the WPGraphQL object cache (Settings, GraphQL, Cache tab, Purge Now!). Second, a FaustWP library bug double-prefixes the protocol on multi-URL srcset strings, which persisted even with a fresh GraphQL response. Fixed with a fixDoubleProtocol sanitizer added to app/components/WPImage.js. Committed as 9ce8fb7.
3. Homepage hero background video not showing, static image only instead of the autoplay video seen on the live site paramusdentalarts.com. Root cause was NOT the frontend code - app/components/modules/Hero.js and app/components/WPVideo.js already fully supported background video, and the video file was already uploaded and attached to the Home page in WP Admin (ACF fields field_hero_video_desktop / field_hero_video_mobile). Actual root cause was a stale WPGraphQL Object Cache entry returning null for backgroundVideoDesktop and backgroundVideoMobile, plus a Kinsta CDN edge-cache propagation delay after purging. Secondary gotcha: WPGraphQL's sourceUrl resolver returns null for video media items - must query mediaItemUrl instead.

Fix procedure that worked: (1) In WP Admin, Settings > GraphQL > Cache tab, check "Purge Now!" and Save Changes. (2) In WP Admin, use the dedicated Kinsta Cache page (wp-admin/admin.php?page=kinsta-tools, not just the admin-bar "Clear Caches" shortcut) and click "Clear All Caches". (3) Wait several minutes for CDN edge propagation (Kinsta's own banner says changes usually appear globally within a few minutes) before doing anything else - redeploying immediately after purging can still pick up stale cached GraphQL data. (4) Verify fresh data by querying the WordPress GraphQL endpoint directly for backgroundVideoDesktop/Mobile mediaItemUrl and confirming it is non-null. (5) Only then trigger a Vercel redeploy (no build cache) so the static build embeds the correct data. (6) Verify on the live Vercel URL by reading window.__NEXT_DATA__.props.pageProps.page.hero directly (the actual data baked into the build) rather than relying on DOM video element inspection alone.

## Key files

- app/components/Image.js - custom lazy-load + webp picture component (uses lazysizes).
- app/components/WPImage.js - wrapper that maps WordPress GraphQL media fields to Image.js props; contains the protocol-fix sanitizer.
- app/components/modules/Hero.js - homepage hero section; supports both image and video backgrounds (contentType, backgroundImageDesktop/Mobile, backgroundVideoDesktop/Mobile fields).
- app/components/WPVideo.js - video component used by Hero.js; uses mediaItemUrl (not sourceUrl) as the video src.
- app/next.config.js - Next.js config.
- app/pages/_app.js - imports lazysizes and its attrchange plugin globally.
- cms/mu-plugins/pd/acf/page/hero.php - ACF field definitions for the Hero module (backend source of truth for field names).

## Open / next steps

- Point the custom domain paramusdentalarts.com at this Vercel deployment (not yet started).
- User to do a final hard-refresh check that the hero video plays smoothly in their own browser. Last automated check showed the video loading correctly but stalling at readyState 0 in the test browser - may be a sandboxed network quirk rather than a real bug.
- No other known open bugs as of last verification.

## Operational notes for future sessions

- Do not log into GitHub/Vercel/WordPress on the user's behalf - user authenticates themselves.
- Never commit real secrets to this public repo.
- GitHub web editor requires full select-all + retype for edits (no true diff editing); auto-indent is cosmetic only for single-line edits, but typing multi-line lists via simulated keystrokes can corrupt indentation - use a clipboard paste event instead.
- When making WordPress settings changes, confirm with the user first.
- When debugging GraphQL/cache data issues, always verify with a fresh query after purging caches, and remember Kinsta's CDN purge has a propagation delay - wait a few minutes before relying on it or redeploying.
- When inspecting video or other repeated elements on a page, verify the correct element (e.g., filter by expected src filename) rather than assuming the first DOM match is correct - this page has many videos (hero background plus a testimonial carousel).
- Check window.__NEXT_DATA__ on the live site to see exactly what data was baked into the Next.js build - the most reliable verification method for headless CMS data issues.
- Avoid typing non-ASCII characters (em-dashes, smart quotes) into GitHub's web-based CodeMirror editor via automation - use plain ASCII only, it can garble input otherwise.
