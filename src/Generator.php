<?php

declare(strict_types=1);

namespace dvikan\SimpleStaticSiteGenerator;

use JsonException;
use Parsedown;
use RuntimeException;
use stdClass;

class Generator
{
    private $postFolder;
    private $pageFolder;
    private $outFolder;
    private $parsedown;

    public function __construct(
        string $postFolder = null,
        string $pageFolder = null,
        string $outFolder = null
    ) {
        $this->postFolder = $postFolder ?? 'posts';
        $this->pageFolder = $pageFolder ?? 'pages';
        $this->outFolder = $outFolder ?? 'out';
        $this->parsedown = new Parsedown();
    }

    public function generate()
    {
        $this->guardAgainstFileSystemIssues();

        $posts = $this->fetchPosts();
        $pages = $this->fetchPages();

        $this->createPosts($posts, $pages);
        $this->createPages($pages);
        $this->createIndex($posts, $pages);
    }

    private function fetchPosts(): array
    {
        $posts = [];
        foreach (glob($this->postFolder . "/*.md") as $postFile) {
            $posts[] = $this->parseFilePath($postFile);
        }
        return array_reverse($posts);
    }

    private function fetchPages(): array
    {
        $pages = [];
        foreach (glob($this->pageFolder . "/*.md") as $pageFile) {
            $pages[] = $this->parseFilePath($pageFile);
        }
        return $pages;
    }

    private function createPosts(array $posts, array $pages): void
    {
        foreach ($posts as $post) {
            file_put_contents(
                sprintf('%s/%s.html', $this->outFolder, $post->slug),
                $this->render('post.html.php', [
                    'title' => $post->title,
                    'pages' => $pages,
                    'post' => $post,
                ])
            );
        }
    }

    private function createPages(array $pages): void
    {
        foreach ($pages as $page) {
            file_put_contents(
                sprintf('%s/%s.html', $this->outFolder, $page->slug),
                $this->render('page.html.php', [
                    'title' => $page->title,
                    'pages' => $pages,
                    'page' => $page,
                ])
            );
        }
    }

    private function createIndex(array $posts, array $pages): void
    {
        file_put_contents(
            sprintf('%s/index.html', $this->outFolder),
            $this->render('index.html.php', [
                'title' => 'Index',
                'pages' => $pages,
                'posts' => $posts,
            ])
        );
    }

    private function render(string $template, array $context = []): string
    {
        extract($context);
        ob_start();
        require __DIR__ . '/../templates/header.html.php';
        require __DIR__ . '/../templates/' . $template;
        require __DIR__ . '/../templates/footer.html.php';
        return ob_get_clean();
    }

    private function parseFilePath(string $filepath): stdClass
    {
        $fileParts = explode("\n\n", file_get_contents($filepath));
        $filename = pathinfo($filepath, PATHINFO_FILENAME);

        try {
            $header = json_decode($fileParts[0], false, 512, JSON_THROW_ON_ERROR);
        } catch(JsonException $e) {
            throw new RuntimeException(sprintf('Invalid json in "%s"', $filepath));
        }

        if (!isset($header->title)) {
            throw new RuntimeException(sprintf('File "%s" is missing a title', $filepath));
        }

        $markdown = implode("\n\n", array_slice($fileParts, 1));

        $file = new stdClass();
        $file->title = $header->title;
        $file->content = $this->parsedown->text($markdown);

        if (preg_match('/^\d{4}-\d{2}-\d{2}-/', $filename)) {
            // This is a post with filename like 2020-01-31-hello-world
            $file->date = mb_substr($filename, 0, 10);
            $file->slug = mb_substr($filename, 11);
        } else if (preg_match('/^[a-z]+$/', $filename)) {
            // This is a page. It has no date
            $file->slug = $filename;
        } else {
            throw new RuntimeException(sprintf('Illegal filename "%s"', $filename));
        }

        return $file;
    }

    private function guardAgainstFileSystemIssues(): void
    {
        if (!is_dir($this->postFolder)) {
            throw new RuntimeException(sprintf('Filepath "%s" is not a folder', $this->postFolder));
        }

        if (!is_dir($this->pageFolder)) {
            throw new RuntimeException(sprintf('Filepath "%s" is not a folder', $this->pageFolder));
        }

        if (!is_dir($this->outFolder)) {
            if (!mkdir($this->outFolder)) {
                throw new RuntimeException(sprintf('Unable to create out folder "%s"', $this->outFolder));
            }
        }

        if (!is_writable($this->outFolder)) {
            throw new RuntimeException(sprintf('Folder "%s" is not writeable', $this->outFolder));
        }
    }
}
