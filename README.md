# Simple static site generator

A simple php script for generating html files from markdown files.

## Dependencies

We are depending on `erusev/parsedown` for the markdown compiler.

## Get started

    git clone https://github.com/dvikan/simple-static-site-generator.git
    cd simple-static-site-generator
    composer install
    php generate.php
    php -S localhost:8080 -t out/

Then browse http://localhost:8080/

The `posts` folder must contains markdown files with date and
slug in the filename:

    $ tree posts/
    posts/
    └── 2020-20-23-hello-world.md
    
    0 directories, 1 file

Example post:

    $ cat posts/2020-20-23-hello-world.md 
    {
        "title": "Hello World"
    }
    
    This is my first blog post!

## Use as a library

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
