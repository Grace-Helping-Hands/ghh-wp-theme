# Newsletter Handbook

This handbook explains how the Newsletter page works, how Editors should add newsletters, and where developers should adjust the styling.

## How The Page Works

The public Newsletter page is:

`Pages -> Newsletter`

That page uses the `Newsletter` page template. The top intro and call-to-action area are editable in the page Body.

The newsletter list below it is dynamic. It is generated from published items in:

`Newsletters`

Do not manually add newsletter cards to the Newsletter page Body. Add a new Newsletter item instead.

## Editor Workflow

1. Go to `Newsletters -> Add New`.
2. Add the newsletter title.
3. Set the publish date to the month the newsletter should represent.
4. Add the preview image and short summary in the Body editor.
5. Paste the PDF, image, or external URL in the `Newsletter Link` field below the Body editor.
6. Publish.

The Newsletter page automatically shows published newsletter items from newest to oldest.

## Body Content Rules

Each Newsletter item should be built in the Body field only.

Use this order:

1. Add the preview image first.
2. Add a short summary paragraph second.
3. Add the PDF, image, or external newsletter URL in the `Newsletter Link` field below the Body editor.

The listing card uses:

- The title from the newsletter title field.
- The month/year from the publish date.
- The preview image from the first image in the Body.
- The summary from the Body text.
- The `Read Newsletter` button destination from the `Newsletter Link` field.

If the `Newsletter Link` field is empty, the `Read Newsletter` button is not shown.

## PDF Newsletter

For a PDF newsletter:

1. Upload the PDF in the Body editor.
2. Copy the PDF URL.
3. Paste the PDF URL in the `Newsletter Link` field.

The `Read Newsletter` button will open the PDF directly.

## Image Newsletter

For a PNG, JPG, or WebP newsletter:

1. Add the newsletter image as the first image in the Body.
2. Add a short summary paragraph after it.
3. Paste the image URL in the `Newsletter Link` field.

The `Read Newsletter` button opens that image directly.

## External Newsletter Link

For a newsletter hosted elsewhere:

1. Add the preview image first.
2. Add the summary text in the Body.
3. Paste the external URL in the `Newsletter Link` field.

The `Read Newsletter` button will open the external link in a new tab.

## Editing The Top Page Text

Go to:

`Pages -> Newsletter`

Edit the Body content there. The recommended structure is:

- A Columns block.
- Left column: intro paragraph.
- Right column: Group block with heading, paragraph, and button.

The template styles this structure to match the design.

## Styling Notes

Newsletter styles live in:

`assets/css/custom.css`

Important classes:

- `.newsletter-page`: page wrapper.
- `.newsletter-container`: max-width content container.
- `.newsletter-page__body`: editable top Body content.
- `.newsletter-list`: dynamic newsletter list wrapper.
- `.newsletter-card`: one generated newsletter row.
- `.newsletter-card__media`: preview image area.
- `.newsletter-card__content`: date, title, and summary.
- `.newsletter-card__button`: `Read Newsletter` button.

The card grid is controlled by:

```css
.newsletter-card {
    grid-template-columns: repeat(12, minmax(0, 1fr));
}
```

The card uses a 12-column layout inside the page container:

- `.newsletter-card__media`: 4 columns.
- `.newsletter-card__content`: 6 columns.
- `.newsletter-card__button`: 2 columns.

Adjust those spans if the image, text, or button columns need different proportions.

## Developer Notes

Newsletter logic lives in:

`inc/newsletters.php`

The page template lives in:

`templates/page-newsletter.php`

The content type is admin-only. Newsletter items are used as data for the listing page, not as public landing pages.

Do not change the listing to hardcoded cards. Future newsletters must appear automatically from WordPress data.
