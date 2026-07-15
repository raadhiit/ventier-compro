# 14. Security Requirements

## Public Website

- Validate all input server-side.
- Protect the contact form from spam and abuse.
- Apply rate limits to sensitive endpoints.
- Escape output by default.
- Sanitize rich-text HTML.
- Never expose detailed production errors.

## Admin Panel

- Authentication is mandatory.
- Use policies or equivalent Filament authorization.
- Inactive administrators cannot sign in.
- Hash passwords through Laravel-supported mechanisms.
- Apply login rate limiting.
- Restrict features by role.
- Validate every uploaded file.
- Reject executable uploads.
- Never expose `.env`, API keys, credentials, or secrets through the CMS.

## Production

- Set `APP_DEBUG=false`.
- Enforce HTTPS.
- Configure secure cookie settings.
- Keep database credentials out of the repository.
- Back up database and uploaded media.
- Do not write passwords, tokens, or unnecessary sensitive data to logs.
