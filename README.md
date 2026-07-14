# Shewabu Redi Mohammed Authorized Accounting Firm

Public website and Filament admin for Shewabu Redi Mohammed Authorized Accounting Firm — audit, tax, bookkeeping, and advisory services.

## Stack

- Laravel 11
- Filament 3 (admin at `/admin`)
- Tailwind CSS 3 + Alpine.js
- SQLite (default) or MySQL/PostgreSQL

## Requirements

- PHP 8.2+
- Composer 2
- Node.js 18+ and npm
- SQLite extension (default) or your chosen database

## Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Environment
cp .env.example .env
php artisan key:generate

# 3. Database & content
touch database/database.sqlite   # skip if using MySQL/PostgreSQL
php artisan migrate --seed

# 4. Storage link (uploads: team photos, service images, settings)
php artisan storage:link

# 5. Frontend assets
npm install
npm run build

# 6. Production optimization (optional, recommended before deploy)
php artisan optimize
```

## Development

```bash
# Terminal 1 — app server
php artisan serve --host=127.0.0.1 --port=8090

# Terminal 2 — Vite dev server (hot reload)
npm run dev
```

Visit [http://127.0.0.1:8090](http://127.0.0.1:8090)

## Admin panel

| | |
|---|---|
| URL | `/admin` |
| Email | `admin@shewaburedi.com` |
| Password | `password` |

Change the admin password immediately after first login in production.

## Managing content

All public-facing content is editable in Filament without code changes:

| Area | Admin location |
|------|----------------|
| Firm name, logo, favicon, SEO defaults | Settings → Brand / SEO |
| Contact info, map embed, office hours | Settings → Contact |
| Homepage hero & CTA | Settings → Hero / Pages |
| About excerpt, mission, vision | Settings → About & mission |
| Stats bar | Settings → Stats |
| Industries, privacy, terms pages | Settings → Pages |
| Services | Services resource |
| Team members | Team Members resource |
| Blog posts (Insights) | Posts resource |
| FAQs | FAQs resource |
| Testimonials | Testimonials resource |
| Contact form submissions | Contact Submissions resource |

## Tests

```bash
php artisan test
```

## Deployment checklist

1. Set `APP_ENV=production`, `APP_DEBUG=false`, and a real `APP_URL`
2. Run `php artisan migrate --force`
3. Run `npm run build` and `php artisan optimize`
4. Ensure `storage/` and `bootstrap/cache/` are writable
5. Point the web server document root to `/public`
6. Configure `FILESYSTEM_DISK=public` and run `php artisan storage:link`

## Sitemap

Available at `/sitemap.xml` — includes all published services, team members, and insights posts.

## Maintenance mode

```bash
php artisan down --secret="your-bypass-token"
# Visit /your-bypass-token to bypass while down
php artisan up
```

A styled 503 page is shown automatically when maintenance mode is active.

## License

Proprietary — Shewabu Redi Mohammed Authorized Accounting Firm.
