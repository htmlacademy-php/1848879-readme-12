<section class="adding-post__video tabs__content tabs__content--active">
    <h2 class="visually-hidden">Форма добавления видео</h2>
    <form class="adding-post__form form" action="/add/index.php?adding-type_id=2" method="POST" enctype="multipart/form-data">
        <div class="form__text-inputs-wrapper">
            <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="video-heading">Заголовок <span class="form__input-required">*</span></label>
                    <div class="form__input-section <?=(!empty($errors['heading'])) ? "form__input-section--error" : ""?>">
                        <input class="adding-post__input form__input" id="video-heading" type="text" name="heading" placeholder="Введите заголовок" value="<?=!empty($_POST['heading']) ? htmlspecialchars($_POST['heading']) : ''?>">
                        <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                        <div class="form__error-text">
                            <h3 class="form__error-title">Информация об ошибке</h3>
                            <p class="form__error-desc"><?=$errors['heading']?></p>
                        </div>
                    </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                    <div class="form__input-section <?=(!empty($errors['content'])) ? "form__input-section--error" : ""?>">
                        <input class="adding-post__input form__input" id="video-url" type="text" name="content" placeholder="Введите ссылку" value="<?=!empty($_POST['content']) ? htmlspecialchars($_POST['content']) : ''?>">
                        <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                        <div class="form__error-text">
                            <h3 class="form__error-title">Информация об ошибке</h3>
                            <p class="form__error-desc"><?=$errors['content']?></p>
                        </div>
                    </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                    <label class="adding-post__label form__label" for="video-tags">Теги</label>
                    <div class="form__input-section <?=(!empty($errors['tags'])) ? "form__input-section--error" : ""?>">
                        <input class="adding-post__input form__input" id="video-tags" type="text" name="tags" placeholder="Введите теги" value="<?=!empty($_POST['tags']) ? htmlspecialchars($_POST['tags']) : ''?>">
                        <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                        <div class="form__error-text">
                            <h3 class="form__error-title">Информация об ошибке</h3>
                            <p class="form__error-desc"><?=$errors['tags']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__invalid-block <?=(!empty($errors)) ? "" : "visually-hidden"?>">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                    <?php foreach ($errors as $key => $error):?>
                        <li class="form__invalid-item"><?=checkNameError($key)?> <?=$error?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="adding-post__textarea-wrapper form__input-wrapper" style="display:none">
            <label class="adding-post__label form__label" for="form-type">ТИП ПОСТА <span class="form__input-required">*</span></label>
            <div class="form__input-section">
                <input class="adding-post__input form__input" id="form-type" type="text" name="form-type" value="2">
            </div>
        </div>
        <div class="adding-post__buttons">
            <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
            <a class="adding-post__close" href="#">Закрыть</a>
        </div>
    </form>
</section>

