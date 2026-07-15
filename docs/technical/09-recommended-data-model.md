# 09. Recommended Data Model

Table names may change, but their responsibilities should remain consistent.

## `users`

- `id`
- `name`
- `email`
- `password`
- `role`
- `is_active`
- timestamps

## `products`

- `id`
- `product_category_id`, nullable
- `name`
- `slug`
- `short_description`
- `description`
- `material`, nullable
- `specifications`, nullable JSON
- `features`, nullable JSON
- `thumbnail_path`
- `status`
- `is_featured`
- `sort_order`
- `published_at`, nullable
- `seo_title`, nullable
- `seo_description`, nullable
- timestamps
- soft deletes

## `product_categories`

Create this table only when categories provide real value.

- `id`
- `name`
- `slug`
- `description`, nullable
- `is_active`
- `sort_order`
- timestamps

## `product_images`

- `id`
- `product_id`
- `image_path`
- `alt_text`, nullable
- `sort_order`
- timestamps

## `articles`

- `id`
- `title`
- `slug`
- `excerpt`
- `body`
- `cover_image_path`
- `status`
- `published_at`, nullable
- `author_id`, nullable
- `seo_title`, nullable
- `seo_description`, nullable
- timestamps
- soft deletes

## `home_sections`

Stores content for application-defined Home sections.

- `id`
- `section_key`
- `title`, nullable
- `subtitle`, nullable
- `content`, nullable
- `image_path`, nullable
- `cta_label`, nullable
- `cta_url`, nullable
- `settings`, nullable JSON
- `is_visible`
- `sort_order`
- timestamps

`section_key` must come from an application-controlled list, not unrestricted admin input.

## `page_contents`

Stores structured About Us content or other predefined page sections.

- `id`
- `page_key`
- `section_key`
- `title`, nullable
- `subtitle`, nullable
- `content`, nullable
- `image_path`, nullable
- `cta_label`, nullable
- `cta_url`, nullable
- `settings`, nullable JSON
- `is_visible`
- `sort_order`
- timestamps

## `site_settings`

- `id`
- `key`
- `value`
- `type`
- timestamps

Only application-whitelisted keys may be edited. Do not expose an unrestricted key-value configuration store.

Example settings:

- Brand name.
- Primary and alternate logos.
- Favicon.
- Default SEO title and description.
- WhatsApp number.
- Email address.
- Address.
- Business hours.
- Social links.
- Map embed URL.
- Footer text.

## `contact_messages`

- `id`
- `name`
- `phone`
- `email`, nullable
- `subject`, nullable
- `message`
- `status`
- `source_page`, nullable
- `ip_address`, nullable and subject to privacy policy
- timestamps

Minimum statuses:

- `new`
- `in_progress`
- `resolved`
- `spam`
