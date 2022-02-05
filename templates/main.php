<div class="container">
    <h1 class="page__title page__title--popular">Популярное</h1>
</div>
<div class="popular container">
    <div class="popular__filters-wrapper">
        <div class="popular__sorting sorting">
            <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
            <ul class="popular__sorting-list sorting__list">
                <li class="sorting__item sorting__item--popular">
                    <a class="sorting__link sorting__link--active" href="#">
                        <span>Популярность</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Лайки</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Дата</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="popular__filters filters">
            <b class="popular__filters-caption filters__caption">Тип контента:</b>
            <ul class="popular__filters-list filters__list">
                <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                    <a href="/"
                       class="filters__button filters__button--ellipse filters__button--all <?= ($sortingParameters === 'all') ?
                           'filters__button--active' : ""; ?>">
                        <span>Все</span>
                    </a>
                </li>
                <?php
                foreach ($types as $type): ?>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--<?= $type['class_name'] ?> <?= ($sortingParameters === $type['class_name']) ?
                            'filters__button--active' : ""; ?> button" href="/index.php?type_post=<?= $type['id'] ?>">
                            <span class="visually-hidden"><?= $type['class_name'] ?></span>
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-<?= $type['class_name'] ?>"></use>
                            </svg>
                        </a>
                    </li>
                <?php
                endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="popular__posts">
        <?php
        foreach ($cards as $card): ?>
            <article class="popular__post post post-<?= $types[$card['type_id'] - 1]['class_name'] ?>">
                <header class="post__header">
                    <a href="<?= '/post.php?post_id=' . $card['id'] ?>">
                        <h2><?= htmlspecialchars($card['title']) ?></h2>
                    </a>
                </header>

                <div class="post__main">
                    <?php
                    switch (getTypeID($card['type_id'])):
                        case 'quote': ?>
                            <blockquote>
                                <p>
                                    <?= htmlspecialchars($card['content']) ?>
                                </p>
                                <cite><?= htmlspecialchars($card['author_quote']) ?></cite>
                            </blockquote>
                            <?php
                            break; ?>

                        <?php
                        case 'text': ?>
                            <?= cropping_text(htmlspecialchars($card['content'])) ?>
                            <?php
                            break; ?>

                        <?php
                        case 'link': ?>
                            <div class="post-link__wrapper">
                                <a class="post-link__external" href="https://<?= $card['content'] ?>"
                                   title="Перейти по ссылке">
                                    <div class="post-link__info-wrapper">
                                        <div class="post-link__icon-wrapper">
                                            <img src="https://www.google.com/s2/favicons?domain=vitadental.ru"
                                                 alt="Иконка">
                                        </div>
                                        <div class="post-link__info">
                                            <h3><?= htmlspecialchars($card['title']) ?></h3>
                                        </div>
                                    </div>
                                    <span><?= htmlspecialchars($card['content']) ?></span>
                                </a>
                            </div>
                            <?php
                            break; ?>

                        <?php
                        case 'photo': ?>
                            <div class="post-photo__image-wrapper">
                                <img src="<?= $card['content'] ?>" alt="Фото от пользователя" width="360"
                                     height="240">
                            </div>
                            <?php
                            break; ?>

                        <?php
                        case 'video': ?>
                            <div class="post-video__block">
                                <div class="post-video__preview">
                                    <?= embed_youtube_cover($card['content']); ?>
                                </div>
                                <a href="<?= $card['content'] ?>" class="post-video__play-big button">
                                    <svg class="post-video__play-big-icon" width="14" height="14">
                                        <use xlink:href="#icon-video-play-big"></use>
                                    </svg>
                                    <span class="visually-hidden">Запустить проигрыватель</span>
                                </a>
                            </div>
                            <?php
                            break; ?>

                        <?php
                    endswitch ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="<?= $card['name'] ?>">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/<?= $users[$card['user_id'] - 1]['avatar_url'] ?>"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name"><?= $users[$card['user_id'] - 1]['name'] ?></b>
                                <time class="post__time"
                                      datetime="<?= get_time_format(generate_random_date($card['id'])) ?>"
                                      title="<?= get_time_format(generate_random_date($card['id'])) ?>"
                                >
                                    <?= time_has_passed(generate_random_date($card['id'])) ?>
                                </time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#"
                               title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
        <?php
        endforeach; ?>
    </div>
