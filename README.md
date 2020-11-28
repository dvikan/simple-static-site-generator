# Simple static site generator

A simple tool for generating html files from markdown files.

Features:

* posts and pages
* a frontpage with all the posts
* rss feed

## Get started

Install:

```bash
$ composer require dvikan/simple-static-site-generator
```

Place your markdown files in `files/`.

Create a post:

```bash
$ mkdir files
$ cat > files/2020-10-24-hello-world.md
{
    "title": "Hello World"
}

Hello world!
```

Create a page:

```bash
$ cat > pages/about.md
{
    "title": "About"
}

This is the about page.
```

Generate html files:

```bash
./vendor/bin/generate
```

The generated html files is located in `out/`.

## Misc

There is a dependency on `erusev/parsedown` for the markdown compiler.
