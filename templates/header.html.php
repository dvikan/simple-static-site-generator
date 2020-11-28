<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $baseUrl ?>/feed.xml">
    <link href="/styles.css" rel="stylesheet">
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
