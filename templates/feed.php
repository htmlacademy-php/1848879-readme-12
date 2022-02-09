<main class="page__main page__main--feed">
    <div class="container">
        <h1 class="page__title page__title--feed">Моя лента</h1>
    </div>
    <div class="page__main-wrapper container">
        <section class="feed">
            <h2 class="visually-hidden">Лента</h2>
            <div class="feed__main-wrapper">
                <div class="feed__wrapper">
                    <?php foreach ($cards as $card) : ?>
                        <article class="feed__post post post-<?= $card['class_name'] ?>">
                            <header class="post__header post__author">
                                <a class="post__author-link" href="<?= '/post/?post_id=' . $card['id'] ?>" title="<?= $card['name'] ?>">
                                    <div class="post__avatar-wrapper">
                                        <img class="post__author-avatar" src="/assets/img/<?= $card['file_id'] ?>"
                                             alt="Аватар пользователя" width="60" height="60">
                                    </div>
                                    <div class="post__info">
                                        <b class="post__author-name"><?= $card['name'] ?></b>
                                        <span class="post__time"><?= time_has_passed(generate_random_date($card['id'])) ?></span>
                                    </div>
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
                                            <cite><?=$card['author_quote']?></cite>
                                        </blockquote>
                                        <?php
                                        break; ?>

                                    <?php
                                    case 'text': ?>
                                        <h2><a href="#"><?=$card['title']?></a></h2>
                                        <p>
                                            <?=cropping_text(htmlspecialchars($card['content']))?>
                                        </p>
                                        <?php
                                        break; ?>

                                    <?php
                                    case 'link': ?>
                                        <div class="post-link__wrapper">
                                            <a class="post-link__external" href="http://<?= $card['content'] ?>"
                                               title="Перейти по ссылке">
                                                <div class="post-link__icon-wrapper">
                                                    <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                                </div>
                                                <div class="post-link__info">
                                                    <h3><?= htmlspecialchars($card['title']) ?></h3>
                                                    <span><?= htmlspecialchars($card['content']) ?></span>
                                                </div>
                                                <svg class="post-link__arrow" width="11" height="16">
                                                    <use xlink:href="#icon-arrow-right-ad"></use>
                                                </svg>
                                            </a>
                                        </div>
                                        <?php
                                        break; ?>

                                    <?php
                                    case 'photo': ?>
                                        <h2>
                                            <a href="#"><?= htmlspecialchars($card['title']) ?></a>
                                        </h2>
                                        <div class="post-photo__image-wrapper">
                                            <img src="<?= $card['content'] ?>" alt="Фото от пользователя" width="760" height="396">
                                        </div>
                                        <?php
                                        break; ?>

                                    <?php
                                    case 'video': ?>
                                        <div class="post-video__block">
                                            <div class="post-video__preview">
                                                <?= embed_youtube_cover($card['content']); ?>
                                            </div>
                                            <div class="post-video__control">
                                                <button class="post-video__play post-video__play--paused button button--video"
                                                        type="button"><span class="visually-hidden">Запустить видео</span>
                                                </button>
                                                <div class="post-video__scale-wrapper">
                                                    <div class="post-video__scale">
                                                        <div class="post-video__bar">
                                                            <div class="post-video__toggle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button
                                                    class="post-video__fullscreen post-video__fullscreen--inactive button button--video"
                                                    type="button"><span class="visually-hidden">Полноэкранный режим</span>
                                                </button>
                                            </div>
                                            <button class="post-video__play-big button" type="button">
                                                <svg class="post-video__play-big-icon" width="27" height="28">
                                                    <use xlink:href="#icon-video-play-big"></use>
                                                </svg>
                                                <span class="visually-hidden">Запустить проигрыватель</span>
                                            </button>
                                        </div>
                                        <?php
                                        break; ?>

                                    <?php
                                endswitch ?>
                            </div>
                            <footer class="post__footer post__indicators">
                                <div class="post__buttons">
                                    <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                        <svg class="post__indicator-icon" width="20" height="17">
                                            <use xlink:href="#icon-heart"></use>
                                        </svg>
                                        <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                             height="17">
                                            <use xlink:href="#icon-heart-active"></use>
                                        </svg>
                                        <span>250</span>
                                        <span class="visually-hidden">количество лайков</span>
                                    </a>
                                    <a class="post__indicator post__indicator--comments button" href="#"
                                       title="Комментарии">
                                        <svg class="post__indicator-icon" width="19" height="17">
                                            <use xlink:href="#icon-comment"></use>
                                        </svg>
                                        <span>25</span>
                                        <span class="visually-hidden">количество комментариев</span>
                                    </a>
                                    <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                                        <svg class="post__indicator-icon" width="19" height="17">
                                            <use xlink:href="#icon-repost"></use>
                                        </svg>
                                        <span>5</span>
                                        <span class="visually-hidden">количество репостов</span>
                                    </a>
                                </div>
                            </footer>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <ul class="feed__filters filters">
                <li class="feed__filters-item filters__item">
                    <a class="filters__button <?= ($sortingParameters === 'all') ?
                        'filters__button--active' : ""; ?>" href="/">
                        <span>Все</span>
                    </a>
                </li>
                <?php foreach ($types as $type) : ?>
                    <li class="feed__filters-item filters__item">
                        <a class="filters__button filters__button--<?= $type['class_name'] ?> <?= ($sortingParameters === $type['class_name']) ?
                            'filters__button--active' : ""; ?> button" href="?type_post=<?= $type['id'] ?>">
                            <span class="visually-hidden"><?= $type['class_name'] ?></span>
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-<?= $type['class_name'] ?>"></use>
                            </svg>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <aside class="promo">
            <article class="promo__block promo__block--barbershop">
                <h2 class="visually-hidden">Рекламный блок</h2>
                <p class="promo__text">
                    Все еще сидишь на окладе в офисе? Открой свой барбершоп по нашей франшизе!
                </p>
                <a class="promo__link" href="#">
                    Подробнее
                </a>
            </article>
            <article class="promo__block promo__block--technomart">
                <h2 class="visually-hidden">Рекламный блок</h2>
                <p class="promo__text">
                    Товары будущего уже сегодня в онлайн-сторе Техномарт!
                </p>
                <a class="promo__link" href="#">
                    Перейти в магазин
                </a>
            </article>
            <article class="promo__block">
                <h2 class="visually-hidden">Рекламный блок</h2>
                <p class="promo__text">
                    Здесь<br> могла быть<br> ваша реклама
                </p>
                <a class="promo__link" href="#">
                    Разместить
                </a>
            </article>
        </aside>
    </div>
</main>
