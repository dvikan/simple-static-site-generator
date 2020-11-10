<h1><?= $post->title ?></h1>

<p class="meta">Published <?= $post->date->format('Y-m-d') ?></p>

<?= $post->content ?>
