# 13. Performance Requirements

Performance must be considered from the beginning.

## Required Practices

- Use eager loading to prevent N+1 queries.
- Paginate listings.
- Cache site settings and infrequently changed content.
- Invalidate related cache when content is updated.
- Lazy-load below-the-fold images.
- Set image width and height to reduce layout shift.
- Bundle and minify frontend assets.
- Avoid large JavaScript libraries for minor visual effects.
- Do not deliver full-resolution originals for every gallery view.
- Index frequently queried fields such as slug, status, `published_at`, `sort_order`, and foreign keys.

## Principle

Interactivity must not make the website slow. Remove animations and dynamic features that do not improve usability or conversion.
