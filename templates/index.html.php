<h1>Index</h1>

<?php foreach($posts as $_post): ?>

    <div class="entry">
        <span class="meta">
            <?= $_post->date ?>
        </span>

        <a href="/<?= $_post->slug ?>">
            <?= $_post->title ?>
        </a>

        <br>

    </div>

<?php endforeach; ?>
