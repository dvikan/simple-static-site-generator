<?php

function main()
{
    require __DIR__ . '/vendor/autoload.php';

    set_error_handler(function($_, $errstr) {
        die("Error: $errstr\n");
    });

    set_exception_handler(function($e) {
        print "$e\n";
    });

    $header = file_get_contents(__DIR__ . '/templates/header.html');
    $footer = file_get_contents(__DIR__ . '/templates/footer.html');
    $posts = glob(__DIR__ . '/posts/*.md');

    foreach($posts as $post) {
        [$title, $filename, $date, $content] = parseFile($post);
        $html = "<h1>$title</h1><p class=\"meta\">Published $date</p>$content";
        file_put_contents(__DIR__ . '/out/' . $filename, sprintf($header, $title) . $html . $footer);
    }

    $html = '<h1>Index</h1>';
    foreach(array_reverse($posts) as $post) {
        [$title, $filename, $date] = parseFile($post);
        $html .= "<div class='entry'><span class=\"meta\">$date</span> <a href=\"$filename\">$title</a><br></div>";
    }
    file_put_contents(__DIR__ . '/out/' . 'index.html', sprintf($header, 'Index') . $html . $footer);
}

function parseFile($file)
{
    $parts = explode("\n\n", file_get_contents($file));
    $json = $parts[0];
    $rest = array_slice($parts, 1);
    $markdown = implode("\n\n", $rest);

    $header = json_decode($json);
    if(!isset($header->title)) {
        throw new Exception("Unable to json_decode header from $file");
    }
    $title = $header->title;
    $slug = mb_substr(pathinfo($file, PATHINFO_FILENAME), 11);
    $date = mb_substr(pathinfo($file, PATHINFO_FILENAME), 0, 10);
    $content = (new Parsedown())->text($markdown);

    return [$title, $slug, $date, $content];
}

main();
