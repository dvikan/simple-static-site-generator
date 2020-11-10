# Simple static site generator

A simple library for generating html files from markdown files.

Features:

* Posts
* Pages
* Frontpage with all the posts

## Installation

Install as a library:

```bash
$ composer require dvikan/simple-static-site-generator:dev-main
```
Install as as project:

```bash
$ composer create-project dvikan/simple-static-site-generator:dev-main
```
    
## Get started

Create the `posts` and `pages` folders and add entries to them.

The post files must have date and slug in their file name:

```
$ mkdir posts pages
$ cat > posts/2020-10-24-hello-world.md
{
    "title": "Hello World"
}
```

Pages simply need the slug in the filename:

```bash
This is my first blog post!
$ cat > pages/about.md
{
    "title": "About"
}

This is the about page.
```

Generate the site:

```bash
./vendor/bin/generate
```

Deploy it:

```bash
php -S localhost:8080 -t out/ bin/router.php
```

Browse it: http://localhost:8080/

You can also use the library directly from your own code:

```php
$generator = new Generator('title', 'https://example.com', 'description');

$generator->generate();
```

## Development

Installation:

```bash
git clone https://github.com/dvikan/simple-static-site-generator.git
cd simple-static-site-generator
composer install
php -S localhost:8080 -t out/ bin/router.php
```

Browse it: http://localhost:8080/

We are depending on `erusev/parsedown` for the markdown compiler.
