# GHH WordPress Theme

## Environment setup

### Prerequisites

- Git installed
- LocalWP installed. [LocalWP](https://localwp.com/)
- [All-in-One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) plugin (free) on both the live site and your local site, to copy site content. See [Copying the live site with All-in-One WP Migration](#copying-the-live-site-with-all-in-one-wp-migration).

### Steps

1. Clone the repository:

   ```bash
   git clone <repository-url> ghh-wp-theme
   ```

   Replace `<repository-url>` with the remote repository URL.

2. Open LocalWP and create a new site:

   - Use `ghh-theme` as the site name.
   - Choose your preferred environment. Select Preferred.
   - Set the WordPress username, password, and email if prompted. These are overridden when you import a backup from the live site.

3. Import the live site content:

   - Follow [Copying the live site with All-in-One WP Migration](#copying-the-live-site-with-all-in-one-wp-migration).
   - Do this **before** creating the symlink in step 5. An import replaces the contents of `wp-content/themes`, which removes the symlink if it already exists.

4. Locate the theme folder inside the new LocalWP site:

   - In LocalWP, click the site and choose `Open Site Shell` or `Open Folder`.
   - Navigate to the WordPress installation folder, then go to `wp-content/themes`.

5. Replace the theme folder with a symlink to the cloned repository:

   - Delete the existing theme folder inside `wp-content/themes`.
   - Create a symbolic link that points to your cloned repo folder from step 1.

   Example (macOS / Linux):

   ```bash
   cd /path/to/localwp/site/app/public/wp-content/themes
   rm -rf ghh-wp-theme
   ln -s /path/to/cloned/ghh-wp-theme ghh-wp-theme
   ```

6. Restart the site in LocalWP:
   - Stop the site and start it again, or use the restart button.
   - Refresh the browser preview if it is open.

## Copying the live site with All-in-One WP Migration

Use [All-in-One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) to copy the live site's database, media, and plugins into your local site.

### Export from the live site

1. Log in to the live site's WordPress admin.
2. Install and activate the plugin if it isn't there already: `Plugins -> Add New`, search for "All-in-One WP Migration".
3. Go to `All-in-One WP Migration -> Export`.
4. Optional: open **Advanced options** to make the file smaller, for example:
   - **Do not export themes.** The theme comes from this repo, so you don't need it in the backup.
   - **Do not export spam comments** and **Do not export post revisions**.
5. Click **Export To -> File**. When the export finishes, download the `.wpress` file.

### Import into LocalWP

1. Start the `ghh-theme` site in LocalWP and open WP Admin.
2. Install and activate All-in-One WP Migration (`Plugins -> Add New`).
3. Go to `All-in-One WP Migration -> Import`.
4. Check the **maximum upload file size** shown on the screen. If your `.wpress` file is larger, see [Increasing the upload size in LocalWP](#increasing-the-upload-size-in-localwp) first.
5. Drag the `.wpress` file onto the page, or use **Import From -> File**.
6. Confirm the warning that the import will overwrite the local site, then wait for it to finish.
7. Log in again using your **live site** username and password. The import replaces the local users.
8. Go to `Settings -> Permalinks` and click **Save Changes** twice. This rebuilds the URL rules so pages don't return 404 errors.
9. Deactivate Wordfence on the local site. The import doesn't bring over all of Wordfence's database tables, and without them every local page takes about 30 seconds to load. In LocalWP, click **Open Site Shell** and run:

   ```bash
   wp plugin deactivate wordfence
   ```

   This only affects your local copy; Wordfence stays active on the live site. Repeat this after every import, because importing turns it back on.

10. Continue with the environment setup steps (symlink the theme, then restart the site).

### Increasing the upload size in LocalWP

LocalWP limits uploads to 300 MB by default. The plugin's import screen shows whatever limit PHP allows, so raise the PHP limits to import a larger file:

1. In LocalWP, select the site and click **Go to site folder**.
2. Open `conf/php/php.ini.hbs` in a text editor.
3. Set these values higher than your `.wpress` file size (this example allows up to 2 GB):

   ```ini
   upload_max_filesize = 2048M
   post_max_size = 2048M
   memory_limit = 1024M
   max_execution_time = 600
   max_input_time = 600
   ```

   Keep `post_max_size` at least as large as `upload_max_filesize`. WordPress uses the smaller of the two as its upload limit.

4. Save the file, then **stop and start the site** in LocalWP. Local applies `php.ini.hbs` only when the site restarts. If the old limit still shows, quit and reopen LocalWP.
5. Reload `All-in-One WP Migration -> Import` and check that the maximum upload size has changed. You can also check `Tools -> Site Health -> Info -> Server`.

Notes:

- The plugin's Import screen links to its own instructions for raising the limit. In LocalWP, editing `php.ini.hbs` as described above is what has worked.


## Editor handbooks

- Newsletter editing and styling: `docs/newsletter-handbook.md`
- Donate buttons and Givebutter forms: `docs/donate-buttons.md`
- Button styles (classes, examples, adding a color): `docs/buttons.md`

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

> Note: If you add or change a block pattern, bump `Version` in `style.css`, or the change won't show on the live site.

> Note: [WP Pusher](https://wppusher.com/) should update the theme on the live site automatically after the merge. If it doesn't, update it manually in the live site's admin: go to `WP Pusher -> Themes` and click **Update theme**.

## Notes

- Keep your local branch up to date by pulling from the remote main branch regularly:
  ```bash
  git checkout main
  git pull origin main
  git checkout feature/your-description
  git rebase main
  ```
- If the theme folder path is different in LocalWP, adjust the symlink command accordingly.