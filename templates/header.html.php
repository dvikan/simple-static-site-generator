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
body
{
    font-size: 16px;
    font-family: sans-serif;
    line-height: 21px;
    font-weight: 500;
}

img
{
    max-width: 100%;
}
pre, code
{
    background: #eef;
}

a {
    text-decoration: underline;
}

.container
{
    width: 800px;
    margin: 0 auto;
}

header
{
    overflow: hidden;
    background-color: #f1f1f1;
    padding: 20px 10px;
    margin-bottom: 50px;
}
.header-right {

}

header a{
    padding: 12px;
}

.entry
{
    margin-bottom: 10px
}

.meta
{
    color: #999;
    margin-right: 20px;
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

            <a href="/feed.xml">RSS</a>
        </div>
    </header>
