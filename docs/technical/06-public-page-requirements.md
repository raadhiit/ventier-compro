# 06. Public Page Requirements

## Home

The Home page is the main landing page and must communicate Ventier's value quickly.

Recommended sections:

1. **Hero:** headline, supporting copy, hero image or banner, primary CTA, and optional secondary CTA.
2. **Featured Products:** product thumbnail, name, short description, and detail link.
3. **Benefits / Value Proposition:** concise product advantages with supporting icons or images.
4. **About Ventier Preview:** short brand introduction and About Us link.
5. **Latest Articles:** latest published articles, limited by system configuration.
6. **Contact CTA:** WhatsApp, contact form, or another approved primary channel.

Admin controls:

- Edit headlines and supporting copy.
- Upload hero or promotional images.
- Configure CTA labels and URLs.
- Select featured products.
- Show or hide predefined sections.
- Reorder predefined sections.
- Edit section copy.
- Display latest articles automatically or select them manually.

## Product

The Product page is a catalog, not an e-commerce checkout flow.

### Product Listing

- Display only active and published products.
- Show thumbnail, name, short description, and detail CTA.
- Add lightweight search when the catalog is large enough to justify it.
- Add category or vehicle-type filters only when the product data requires them.
- Use pagination or load more.
- Do not use infinite scroll as the only navigation method.

### Product Detail

Minimum content:

- Product name and unique slug.
- Main thumbnail and gallery.
- Short and full descriptions.
- Benefits or features.
- Material or specifications when available.
- Vehicle compatibility when available.
- Contact CTA.
- Related products when relevant.
- SEO title and description.

Product statuses:

- `draft`
- `published`
- `archived`

Only `published` products are publicly accessible.

## About Us

The page must build trust rather than present an unstructured wall of text.

Minimum content:

- Ventier story or company profile.
- Brand values.
- Key advantages.
- Supporting visuals.
- CTA to Product or Contact.

Use predefined sections in the initial release. Do not implement an unrestricted page builder.

## Contact

Minimum content:

- WhatsApp number.
- Email address.
- Physical address when available.
- Business hours when available.
- Social links.
- Map embed when needed.
- Contact form.
- Clear CTA.

Contact form fields:

- Name.
- Phone or WhatsApp number.
- Email, optional based on business needs.
- Subject, optional.
- Message.
- Data-use consent when legally or operationally required.

Contact form behavior:

- Server-side validation is mandatory.
- Spam protection is mandatory.
- Valid submissions are stored in the database.
- Administrators can review and update message status.
- Email notifications are optional but recommended.
- Sensitive information and internal error details must never be exposed publicly.
