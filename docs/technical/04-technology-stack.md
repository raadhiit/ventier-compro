# 04. Technology Stack

## Backend

- **Framework:** Laravel 13
- **Language:** PHP version supported by Laravel 13
- **Database:** MySQL
- **ORM:** Eloquent ORM
- **Authentication:** Laravel authentication integrated with Filament
- **File storage:** Laravel Filesystem

## Frontend

- **Dynamic UI:** Livewire
- **Templating:** Blade
- **Styling:** Tailwind CSS
- **Lightweight client interaction:** Alpine.js when required by Livewire or UI components
- **Build tool:** Vite

## Admin Panel

- **Framework:** Filament
- **Default path:** `/admin`
- **Core capabilities:** content CRUD, media upload, publishing, ordering, visibility, SEO metadata, and site settings

## Infrastructure Assumptions

- The server supports the required PHP and Laravel versions.
- MySQL is available as the primary database.
- Public media is available through a storage link or Laravel-compatible object storage.
- HTTPS is mandatory in production.
- Cron is available when Laravel Scheduler is used.
- Queues are recommended for heavy jobs, but the core website must not fail solely because a queue worker is unavailable.
