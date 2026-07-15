# 10. Media Management

All primary media must be uploadable through the admin panel:

- Logos.
- Favicon.
- Hero images.
- Product thumbnails.
- Product galleries.
- Home-section images.
- About Us images.
- Article cover images.
- Embedded article images when supported by the editor.

## Rules

- Validate MIME type and file size.
- Never depend on the original user filename for stored filenames.
- Store files using unique names and structured directories.
- Provide alt text for publicly displayed images.
- Optimize images for web delivery.
- Do not send oversized originals directly as thumbnails or gallery previews.
- Delete replaced or unused files only after confirming they are not referenced elsewhere.

## Initial Upload Limits

Final limits may be adjusted to the infrastructure:

- Logo and icon: maximum 2 MB.
- Product thumbnail: maximum 4 MB.
- Product gallery image: maximum 6 MB each.
- Article cover: maximum 4 MB.
- Primary formats: JPEG, PNG, and WebP.
- SVG is allowed only when proper SVG sanitization is implemented.
