# Unpublished Articles — Access & SEO

## Goal
- Articles whose `status` is not `published` (i.e. `draft` or `scheduled`) must NOT be reachable by anonymous visitors via the share link.
- Such pages must NOT be indexed by Google.

## Behavior
- Public visitor opens `/article/{shortlink}`:
  - If `status === 'published'` → shown normally (`index, follow`).
  - Else → redirected to home page (`/`).
- Logged-in dashboard users can still preview drafts/scheduled articles via the same URL.
- When a non-published article is rendered (preview by staff), the page emits `<meta name="robots" content="noindex, nofollow">`.

## Files changed
- [app/Http/Controllers/HomePageController.php](app/Http/Controllers/HomePageController.php) — `showNews()`: gate non-published by `auth()->check()`, redirect guests to login.
- [resources/views/layouts/index.blade.php](resources/views/layouts/index.blade.php) — robots meta now uses `@yield('meta_robots', 'index, follow')`.
- [resources/views/user/news.blade.php](resources/views/user/news.blade.php) — sets `meta_robots` to `noindex, nofollow` when `$news->status !== 'published'`.
- [resources/views/user/list.blade.php](resources/views/user/list.blade.php) — has its own `<head>`; robots meta rendered conditionally on `$news->status`.

## Notes / Future
- Same gating may be wanted for any other public route that loads a single `Content` (search results, sitemap, RSS). Currently only `showNews` was patched; category/tag/writer/trend listings already filter `where('status', 'published')`.
- If a separate public-user auth is introduced later, revisit the redirect target — currently it sends guests to the dashboard login.
