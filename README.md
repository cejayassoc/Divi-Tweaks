## Divi-Tweaks & Child Theme ##
Tweaks to the divi theme to improve speed and page score

IMPORTANT - backup your website before implementing these changes.

## .htaccess ##
Add this code to your .htaccess file. The .htaccess file can be found in the root of your website. Do not delete or overwrite any content in your .htaccess file, just add these lines.
**Troubleshooting**
If you get an internal server error after updating your .htacces file, undo your changes check your file for for invalid characters. Make small changes and test.
**Sets expire cache**
Sets expiration time for various file types and adds info for the handling of fonts with expires caching
**Adds Gzip Compression for all relevant file types.** 
To take advantage of gzip compression, you need to do more than turn just turn it on. Adding this to your htaccess file makes sure all possible file types are compressed with gzip.

## Creating a Child Theme ##
Add's the following files: 
style.css (required,) functions.php (required,) category.php, footer.php, help-template.php, search.php

Directions: 
1. Copy the child theme into your WP-Content Folder
2. Rename Divi-Child folder to your-child-theme-name
**Styles.css** Update styles.css comments section (lines 1-7) with your Theme Name, Description, Author, Author URI, and Version. Template must be Divi
**Functions.php** Enqueue's the style sheet in the theme folder and includes the following functions; it is adviseable to functions one at a time thoroughly testing each change:
1. function your_theme_enqueue_styles: Enqueu's divi child theme
2. function help_support: Adds a custom post type called "Help." Useful for adding instructions for customers; posts are not private by default. Uses help-template.php
3. function cejay_magic_meta: Adds standard meta tags title, description and keywords. These tags are often missing from WordPress website. 
--Meta name="title": uses custom field. If blank, post title is used
--Meta description: uses custom field, or custom excerpt or default excerpt with a fallback to the description written in the code (redundant)
--Meta name="keywords": uses custom field or the fall back text written in the function.
-- Fill in the fallback text with information relevant to your website.
4. function set_default_from_email: Change from email address and name to the address and name of your website. Set the default description and keywords for your website Meta 
5. function defer_js_async: sets some scripts to be async or defered.  Add scripts as desired; read description for scripts that should not be changed. 
**Category.php** Adds a title to Divi's standard category template. Also useful for adjusting image sizes and layouts on category pages. Does not work with Divi Theme Builder
**Search.php** Adds a title to Divi's standard search results page.  Does not work with Divi Theme Builder
**Footer.php** Adds a javascript generated copyright date to Divi's standard footer.  Modified to work on blank pages and with Divi Theme Builder.
**help-template.php** Template page for custom post type "Help"


We are not responsible for any damages, or perceived damages, incurred when using any of our source code. Use of any code is at your own risk.
