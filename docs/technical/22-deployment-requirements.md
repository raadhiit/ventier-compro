# 22. Deployment Requirements

Before a production release:

- Production environment variables are correct.
- `APP_DEBUG=false`.
- Database migrations complete successfully.
- Storage link or object storage is active.
- Application cache is configured.
- Queue workers are active when required by released features.
- Scheduler is active when used.
- HTTPS is enabled.
- The initial admin account uses a secure password.
- Placeholder content has been replaced.
- An initial backup exists.
- Sitemap and robots behavior have been reviewed.
- Contact flow has been tested end-to-end.
