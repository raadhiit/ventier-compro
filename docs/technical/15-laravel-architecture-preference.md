# 15. Laravel Architecture Preference

Use pragmatic Laravel conventions.

## Preferred Structure

- `app/Models` for Eloquent models.
- `app/Livewire` for interactive public components.
- `app/Filament/Resources` for admin CRUD.
- `app/Policies` for authorization.
- `app/Enums` for finite statuses and controlled values.
- `app/Services` only for reusable or genuinely complex logic.
- `app/Actions` for clear, focused operations when useful; they are not mandatory.

## Avoid

- Repository classes for simple Eloquent queries.
- Multi-layer clean architecture without a demonstrated problem.
- Generic services for every model.
- Abstractions that only relocate one line of Eloquent code.
- Event-driven architecture for ordinary CRUD.
- Microservices.
- A separate headless CMS.
- A full SPA when Blade and Livewire meet the requirement.

## Model Rules

- Use `$fillable` or another safe mass-assignment strategy.
- Define casts for JSON, booleans, dates, and enums.
- Use scopes for common queries such as `published` and `featured`.
- Use slug-based route model binding on public detail pages.
- Keep substantial business logic out of Blade templates.
- Never query the database directly from Blade.
