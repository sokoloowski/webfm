# WebFM - File Manager for webservers
WebFM is a simple file manager (file explorer) with code-preview function. In the future there will be more functions like file management (copy, move, delete) with user auth.

## Installation and usage
Clone or download _master_ branch to the webserver directory (`/var/www` on Debian, `/srv/http` on Arch, `C:\xampp\htdocs` on Windows XAMPP). If you want to have filemanager in subfolder of website, just place it there (e.g. `/var/www/files` instead of `/var/www`). To make it work in subfolders, edit 5 line of `.htaccess` file to look like that:
```RewriteRule ^(.+/)$ /path/index.php?path=$1 [L,QSA]```
*Important*: do not forget about `.htaccess` file, which is hidden in Linux systems (use `Ctrl+H` to show hidden files in your file manager)

## What's working:
- directories and files listing
- code preview (syntax highlighting with HighlightJS)

## TODO list:
- admin authentication
- file management