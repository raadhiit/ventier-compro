# 21. Logging, Monitoring, and Backup

## Logging

Record meaningful failures such as:

- Contact message storage failure.
- Notification delivery failure.
- Media upload or deletion failure.
- Unauthorized admin actions.

Do not flood logs with routine activity that provides no diagnostic value.

## Backup

Minimum backup scope:

- Database.
- Uploaded media.
- Environment configuration stored securely outside the repository.

A backup is not sufficient until the restore procedure has been tested.
