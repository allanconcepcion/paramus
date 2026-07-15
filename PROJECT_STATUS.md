# Paramus Dental Arts - Headless WordPress + Next.js Project Status

Last updated: 2026-07-16

## Architecture

- Backend: WordPress (GoDaddy Managed WordPress, Basic 50 plan) at https://1202302.us28.myftpupload.com/ - NOT a live/production site, used as headless CMS only.
- Plugins: FaustWP (headless integration) + WPGraphQL (+ WPGraphQL Smart Cache) + WebP Express.
- Frontend: Next.js app (repo root app/) deployed on Vercel, live at https://paramus.vercel.app/.
- Source repo: github.com/allanconcepcion/paramus (public repo - never commit real .env or secrets, only .env.example).
- Deploy flow: push to main on GitHub, Vercel auto-builds and deploys.

## Known-good state

- WordPress content is served via GraphQL at https://1202302.us28.myftpupload.com/graphql.
- Vercel production deployment builds successfully and serves the site.
- Images across the site (hero, header logo, doctor photos, sticky booking widget) render correctly as of the latest fix (see below).

## Fixes applied so far

1. Vercel build errors - resolved in an earlier session.
2. Broken images on front end - root-caused to two separate issues:
   - FaustWP setting "Use the WordPress domain for media URLs in post content" was unchecked, causing GraphQL srcSet to return the frontend (Vercel) domain instead of the WordPress media domain. Fixed by checking this box in WP Admin, Settings, Faust, and purging the Kinsta cache (Clear All Caches) and the WPGraphQL object cache (Settings, GraphQL, Cache tab, Purge Now!).
      - A FaustWP library bug double-prefixes the protocol on multi-URL srcset strings (producing https:https://...), which persisted even with a fully fresh/uncached GraphQL response. Fixed at the application level with a defensive fixDoubleProtocol() sanitizer added to app/components/WPImage.js, applied to both sourceUrl and srcSet before passing to the Image component. Committed as 9ce8fb7 ("Fix broken images: strip duplicated https: protocol from srcSet").

      ## Key files

      - app/components/Image.js - custom lazy-load + webp picture component (uses lazysizes).
      - app/components/WPImage.js - wrapper that maps WordPress GraphQL media fields to Image.js props; contains the protocol-fix sanitizer.
      - app/next.config.js - Next.js config.
      - app/pages/_app.js - imports lazysizes and its attrchange plugin globally.

      ## Open / next steps

      - Point the custom domain paramusdentalarts.com at this Vercel deployment (not yet started).
      - No other known open bugs as of last verification.

      ## Operational notes for future sessions

      - Do not log into GitHub/Vercel/WordPress on the user's behalf - user authenticates themselves.
      - Never commit real secrets to this public repo.
      - GitHub web editor requires full select-all + retype for edits (no true diff editing); auto-indent is cosmetic only.
      - When making WordPress settings changes, confirm with the user first.
      
