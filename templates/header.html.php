<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $title ?></title>

<link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $baseUrl ?>/feed.xml">
<link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Libre%20Franklin' rel='stylesheet' type='text/css'>

<style>

    h1,h2 {

        margin: 0;
    }
    body {
        font-family: Menlo, Consolas, Monaco, "Lucida Console", "Liberation Mono", "DejaVu Sans Mono", "Bitstream Vera Sans Mono", "Courier New", monospace, serif;
        font-size: 14px;
        line-height: 1.4em;
        background-color: #ffffff;
        color: #2b2b2b;
    }

    img {
        max-width: 100%;
    }

    pre {
        background-color: #000000;
        color: #cccccc;
        padding: 20px;
        white-space: pre-wrap;
        word-break: break-word;
    }

    a {
        background: transparent;
        color: rgb(33, 144, 211);
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .container {
        width: 800px;
        margin: 0 auto;
    }

    header {
        overflow: hidden;
        margin-bottom: 30px;
    }

    header a {
        padding: 12px;
    }

    .entry {
        margin-bottom: 10px
    }

    .meta {
        color: #999;
        margin-right: 20px;
    }

    h1.title, h2.description {
        margin-bottom: 30px;
    }
</style>

</head>

<body>

<div class="container">
    <header>
        <div class="header-right">
            <a href="/">Home</a>

            <?php foreach($pages as $_page): ?>
                <a href="<?= $_page->slug ?>">
                    <?= $_page->title ?>
                </a>
            <?php endforeach; ?>
        </div>
    </header>
