<!--Цитата-->

<div class="post-details__image-wrapper post-quote">
    <div class="post__main">
        <blockquote>
            <p>
                <?=htmlspecialchars($post['content']);?>
            </p>
            <cite><?= htmlspecialchars($post['author_quote']) ?></cite>
        </blockquote>
    </div>
</div>
