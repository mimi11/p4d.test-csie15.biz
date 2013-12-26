<div class='col1'><article>

    <?php foreach ($posts as $post): ?>
        <div class='post_index'>
            <h1><?= $post['first_name'] ?> <?= $post['last_name'] ?>&nbsp;</h1>
            <time class="post_time" datetime="<?= Time::display($post['created'], 'Y-m-d H:i') ?>">
                <?= Time::display($post['created']) ?>
            </time>

            <p><?= $post['content'] ?></p><br>

        </div>
    <?php endforeach; ?>
</article>

</div>

