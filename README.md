# PHP MVC Structure

This repository contains a simple, yet functional, PHP MVC (Model-View-Controller) structure. It serves as a starting point for building a PHP-based web application using the MVC architecture. 

## Features

- **MVC Architecture**: Separates concerns into Models, Views, and Controllers.
- **URL Routing**: Uses `.htaccess` for URL rewriting to route requests to a central `index.php` file.
- **Basic Autoloading**: Autoloads core classes for controllers and models.

## Project Structure
Will edit after

## .htaccess Configuration

The `.htaccess` file is used to route all requests through `index.php`. 

```apache
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
