# 08. CMS and Admin Panel Scope

## Core Modules

The Filament admin panel must include at least:

1. Dashboard.
2. Products.
3. Product Categories, only when categories are used.
4. Articles.
5. Home Content.
6. About Content.
7. Contact Information.
8. Contact Messages.
9. Site Settings.
10. Admin Users.

## Dashboard

Display operational summaries only:

- Published product count.
- Draft product count.
- Published article count.
- Draft article count.
- Recent contact messages.
- Recently updated content.

Do not add charts without a clear operational purpose.

## Publishing Workflow

Core content should support:

- Draft and published states.
- Publication timestamp when relevant.
- Visibility control.
- Sort order when relevant.
- Created-by and updated-by tracking when the audit value justifies the implementation cost.

## Roles

Minimum roles:

- **Super Admin:** full system and admin-user management.
- **Content Admin:** products, articles, pages, and media without unrestricted access to sensitive configuration.

Do not create excessive roles without a real authorization requirement.

## CMS Guardrails

“Everything can be managed from the admin panel” means:

- Core business content can be updated.
- Main media can be uploaded.
- Predefined sections can be enabled or disabled.
- Predefined sections can be reordered.
- SEO metadata can be edited.
- Contact information and CTA links can be changed.

It does **not** mean:

- Arbitrary HTML layouts.
- Unrestricted navigation restructuring.
- Arbitrary script injection.
- Application-secret or environment configuration.
- General-purpose page creation through drag-and-drop components.

These restrictions are mandatory to protect design consistency, maintainability, and security.
