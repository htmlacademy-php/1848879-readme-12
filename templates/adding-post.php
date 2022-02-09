<div class="container">
    <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
</div>
<div class="adding-post container">
    <div class="adding-post__tabs-wrapper tabs">
        <div class="adding-post__tabs filters">
            <ul class="adding-post__tabs-list filters__list tabs__list">
                <?php foreach($types as $type):?>
                    <li class="adding-post__tabs-item filters__item">
                        <a href="/add/index.php?adding-type_id=<?= $type['id']?>" class="adding-post__tabs-link filters__button filters__button--<?= $type['class_name']?> tabs__item button
                    <?= ($type['class_name'] == $type_post) ? 'filters__button--active tabs__item--active': '' ?>">
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-<?= $type['class_name']?>"></use>
                            </svg>
                            <span><?= $type['title']?></span>
                        </a>
                    </li>
                <?php endforeach?>
            </ul>
        </div>
        <div class="adding-post__tab-content">
            <?=$activePost?>
        </div>
    </div>
</div>
