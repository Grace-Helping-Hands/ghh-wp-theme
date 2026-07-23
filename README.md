# GHH WordPress Theme

## Environment setup

### Prerequisites

- Git installed
- LocalWP installed
- WordPress and LocalWP support for your operating system

### Steps

1. Clone the repository:

   ```bash
   git clone <repository-url> ghh-wp-theme
   ```

   Replace `<repository-url>` with the remote repository URL.

2. Open LocalWP and create a new site:

   - Use `ghh-theme` as the site name.
   - Choose your preferred environment (Preferred or Custom).
   - Set the WordPress username, password, and email if prompted.

3. Locate the theme folder inside the new LocalWP site:

   - In LocalWP, click the site and choose `Open Site Shell` or `Open Folder`.
   - Navigate to the WordPress installation folder, then go to `wp-content/themes`.

4. Replace the theme folder with a symlink to the cloned repository:

   - Delete the existing theme folder inside `wp-content/themes`.
   - Create a symbolic link that points to your cloned repo folder from step 1.

   Example (macOS / Linux):

   ```bash
   cd /path/to/localwp/site/app/public/wp-content/themes
   rm -rf ghh-theme
   ln -s /path/to/cloned/ghh-wp-theme ghh-theme
   ```

5. Restart the site in LocalWP:
   - Stop the site and start it again, or use the restart button.
   - Refresh the browser preview if it is open.

## Using the theme

- In the WordPress admin, go to `Appearance -> Themes`.
- Activate the `ghh-theme` theme if it is not already active.

## Editor handbooks

- Newsletter editing and styling: `docs/newsletter-handbook.md`

## Pushing changes

> Note: Pull the remote repo regularly to get the latest changes.

1. Create a feature branch:

   ```bash
   git checkout -b feature/your-description
   ```

2. Make changes locally.
3. Commit your work:

   ```bash
   git add .
   git commit -m "Add brief summary of change"
   ```

4. Push the branch to the remote repository:

   ```bash
   git push origin feature/your-description
   ```

5. Create a pull request for review.
6. After review, merge the pull request.

## Notes

- Keep your local branch up to date by pulling from the remote main branch regularly:
  ```bash
  git checkout main
  git pull origin main
  git checkout feature/your-description
  git rebase main
  ```
- If the theme folder path is different in LocalWP, adjust the symlink command accordingly.
