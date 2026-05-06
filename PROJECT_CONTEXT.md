# Aswat — Project Context

Quick-load reference for future tasks. Read this first.

## Stack
- Laravel 12 (PHP ^8.2)
- intervention/image v3 (image processing)
- Pint, Pail, Sail, PHPUnit 11

## Domain
News / content publishing platform (Arabic — see `أساسي`, `قائمة`, `ملف` folders).
Core entities: Content, Category, Tag, Trend, BreakingContent, TopContent, Window, Writer, ReadMore, Page, Section.
Engagement: ContentAction, ContentReview, ContentSocial, ContentDailyView, ContentMedia.
Auth/admin: User, Role, Permission.
Misc: Contact, JoinTeam, Mail/MailAttachement, Location, Template, displayMethod.

## Routes (`routes/`)
- `web.php` — public site
- `admin.php` — dashboard
- `client.php` — client/API-ish endpoints
- `mail.php`, `console.php`

## Controllers (`app/Http/Controllers/`)
Api, Auth, BreakingNews, Category, ComingSoon, Contact, ContentAction, Content, ContentList,
ContentReview, Dashboard, HomePage, JoinTeam, Location, Media, Pages, Permission,
PrincipalTrend, ReadMore, Role, Section, SendMail, Settings, Tag, TopContent, Trend,
Window, WindowManagement, Writter.

## Existing feature docs
- [README.md](README.md) — Laravel boilerplate
- [CONTACT_FEATURE_GUIDE.md](CONTACT_FEATURE_GUIDE.md)
- [TWITTER_INSTAGRAM_EMBED_GUIDE.md](TWITTER_INSTAGRAM_EMBED_GUIDE.md)
- [docs/WEATHER_SETUP.md](docs/WEATHER_SETUP.md)

## Working log
Append a dated bullet per task here so the next session has continuity.

- 2026-05-06 — Created this PROJECT_CONTEXT.md as a fast-load reference.
- 2026-05-06 — Restricted unpublished article access to logged-in users + added `noindex, nofollow` for non-published articles. See [UNPUBLISHED_ARTICLES_ACCESS.md](UNPUBLISHED_ARTICLES_ACCESS.md).

## Conventions discovered
- Article statuses: `draft`, `scheduled`, `published` (table `contents`, column `status`).
- "Logged-in users" in this project = dashboard users (auth guard `auth`, login route `dashboard.user.auth`). There is no separate public-user auth.
- `routes/client.php` = public site, `routes/admin.php` = dashboard (prefix `/dashboard`).
- Layout `layouts.index` exposes `@yield('meta_robots', 'index, follow')` — override per page for SEO control.
- `user/list.blade.php` does NOT extend `layouts.index` (has its own `<head>`).
