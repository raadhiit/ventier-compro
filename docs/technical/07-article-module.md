# 07. Article Module

Articles support education, promotion, SEO, and Ventier announcements.

## Fields

- Title.
- Unique slug.
- Excerpt.
- Body.
- Cover image.
- Author or last editor.
- Status.
- Publication timestamp.
- SEO title.
- SEO description.
- Optional social-sharing image.

## Statuses

- `draft`
- `published`
- `archived`

## Rules

- Draft articles are not publicly accessible.
- Scheduled articles become public only when `published_at` has been reached.
- Slugs must be unique.
- Preview-before-publish may be implemented when it does not threaten the main delivery timeline.
- Rich-text output must be sanitized and must not allow dangerous HTML or scripts.
