# Divi-Tweaks
Tweaks to the divi theme to improve speed and page score

IMPORTANT - backup your website before implementing these changes.

**.htaccess**
Add this code to your .htaccess file. The .htaccess file can be found in the root of your website. Do not delete or overwrite any content in your .htaccess file, just add these lines.
Troubleshooting - if you get an internal server error after adding, revert your .htaccess and check for improper characters.

## Add gzip compression to all file type ##
To take advantage of gzip compression, you need to do more than turn just turn it on. Adding this to your htaccess file makes sure all possible file types are compressed with gzip.

## EXPIRES CACHING ##
Sets expiration time for various file types. Also adds info for the handling of fonts with expires caching

**FUNCTIONS.PHP**
Add these codes to your functions.php file in CHILD THEME.  Add one function at a time to test functionality with your site. If you are not using a child theme, do not use these tweaks.  

