<?php

declare(strict_types=1);

namespace dvikan\SimpleStaticSiteGenerator;

use Parsedown;
use RuntimeException;

class Generator
{
    private $postsFolder;
    private $outFolder;

    public function __construct(string $postsFolder = null, string $outFolder = null)
    {
        $this->postsFolder = $postsFolder ?? __DIR__ . '/../posts';
        $this->outFolder = $outFolder ?? __DIR__ . '/../out';
    }

    public function generate()
    {
        if(!is_dir($this->postsFolder)) {
            throw new RuntimeException(sprintf('Filepath "%s" is not a folder', $this->postsFolder));
        }

        if(!is_writable($this->outFolder)) {
            throw new RuntimeException(sprintf('Folder "%s" is not writeable', $this->outFolder));
        }

        $header = file_get_contents(__DIR__ . '/../templates/header.html');
        $footer = file_get_contents(__DIR__ . '/../templates/footer.html');
        $posts = glob($this->postsFolder . '/*.md');

        foreach($posts as $post) {
            [$title, $filename, $date, $content] = $this->parseFile($post);
            $html = "<h1>$title</h1><p class=\"meta\">Published $date</p>$content";
            file_put_contents($this->outFolder . '/' . $filename, sprintf($header, $title) . $html . $footer);
        }

        $html = '<h1>Index</h1>';
        foreach(array_reverse($posts) as $post) {
            [$title, $filename, $date] = $this->parseFile($post);
            $html .= "<div class='entry'><span class=\"meta\">$date</span> <a href=\"$filename\">$title</a><br></div>";
        }
        file_put_contents($this->outFolder . '/index.html', sprintf($header, 'Index') . $html . $footer);
    }

    private function parseFile($file)
    {
        $parts = explode("\n\n", file_get_contents($file));
        $json = $parts[0];
        $rest = array_slice($parts, 1);
        $markdown = implode("\n\n", $rest);

        $header = json_decode($json);
        if(!isset($header->title)) {
            throw new RuntimeException("Unable to json_decode header from $file");
        }
        $title = $header->title;
        $slug = mb_substr(pathinfo($file, PATHINFO_FILENAME), 11);
        $date = mb_substr(pathinfo($file, PATHINFO_FILENAME), 0, 10);
        $content = (new Parsedown())->text($markdown);

        return [$title, $slug, $date, $content];
    }
}
