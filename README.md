# Simple static site generator

A simple library for generating html files from markdown files.

## Installation

Install as a library:

    $ composer require dvikan/simple-static-site-generator:dev-main

## Get started

Create the `posts` folder and add one entry to it:

    $ mkdir posts
    $ cat > posts/2020-10-24-hello-world.md
    {
        "title": "Hello World"
    }
    
    This is my first blog post!

Generate the site:

    ./vendor/bin/generate

Deploy it:

    php -S localhost:8080 -t out/

Browse it: http://localhost:8080/

You can also use the library directly from your own code:

    <?php
    
    $generator = new \dvikan\SimpleStaticSiteGenerator\Generator();
    
    $generator->generate();

Or:

    <?php
    
    $generator = new \dvikan\SimpleStaticSiteGenerator\Generator(
        '/var/posts',
        '/var/www/public_html'
    );
    
    $generator->generate();

## Development

Installation:

    git clone https://github.com/dvikan/simple-static-site-generator.git
    cd simple-static-site-generator
    composer install
    php -S localhost:8080 -t out/

Browse it: http://localhost:8080/

We are depending on `erusev/parsedown` for the markdown compiler.

