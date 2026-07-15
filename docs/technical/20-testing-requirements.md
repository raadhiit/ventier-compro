# 20. Testing Requirements

Automated tests should focus on high-value flows.

## Public Feature Tests

- Home page loads successfully.
- Product listing shows only published products.
- Product detail resolves by slug.
- Draft products are not publicly accessible.
- Published articles are accessible.
- Draft articles are not publicly accessible.
- Contact form validates input.
- Valid contact submissions are stored.

## Admin Feature Tests

- Unauthorized users cannot open the admin panel.
- Content Admin cannot manage admin users unless explicitly allowed.
- Products can be created and published.
- Articles can be created and published.
- Invalid files are rejected.

## Manual QA

- Responsive behavior on mobile and desktop.
- Main modern browsers.
- Media uploads.
- Form validation.
- Broken links.
- SEO metadata.
- Basic accessibility.
- Performance on image-heavy pages.
