# Divi-Tweaks
Tweaks to the divi theme to improve speed and page score

IMPORTANT - backup your website before implementing these changes.

**.htaccess**
Add this code to your .htaccess file. The .htaccess file can be found in the root of your website. Do not delete or overwrite any content in your .htaccess file, just add these lines.
Troubleshooting - if you get an internal server error after adding, revert your .htaccess and check for improper characters.
Also, sets expiration time for various file types and adds info for the handling of fonts with expires caching

**Child Theme**
1. Copy the child theme into your WP-Content Folder
2. Rename Divi-Child folder to your-child-theme-name
3. Update styles.css comments section (lines 1-7) with your Theme Name, Description, Author, Author URI, and Version. Template must be Divi
4. Update **FUNCTIONS.PHP** in the functions.php for your website. It is adviseable to functions one at a time thoroughly testing each change:
4a. function set_default_from_email: Change from email address and name to the address and name of your website
4b. Set the default description and keywords for your website Meta 
5. Adds a custom post type called "Help." Useful for adding instructions for customers; posts are not private by default.

## Add gzip compression to all file type ##
To take advantage of gzip compression, you need to do more than turn just turn it on. Adding this to your htaccess file makes sure all possible file types are compressed with gzip.

We are not responsible for any damages, or perceived damages, incurred when using any of our source code. Use of any code is at your own risk.
