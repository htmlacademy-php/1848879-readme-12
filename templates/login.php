<main class="page__main page__main--login">
    <div class="container">
        <h1 class="page__title page__title--login">Вход</h1>
    </div>
    <section class="login container">
        <h2 class="visually-hidden">Форма авторизации</h2>
        <form class="login__form form" action="/login/index.php" method="post">
            <div class="login__input-wrapper form__input-wrapper">
                <label class="login__label form__label" for="login-email">Электронная почта</label>
                <div class="form__input-section">
                    <input class="login__input form__input" id="login-email" type="email" name="email"
                           placeholder="Укажите эл.почту" value="<?= !empty($_POST['email']) ? $_POST['email']: '' ?> <?= empty($_POST['email']) && !empty($_COOKIE['visit']) ? $_COOKIE['visit'] : ''?>">
                    <button class="form__error-button button" <?= !empty($errors['email']) ? 'style="display: inline"' : '' ?> type="button">!
                        <span class="visually-hidden">Информация об ошибке</span>
                    </button>

                    <div class="form__error-text">
                        <h3 class="form__error-title">Заголовок сообщения</h3>
                        <p class="form__error-desc"><?= $errors['email'] ?></p>
                    </div>

                </div>
            </div>
            <div class="login__input-wrapper form__input-wrapper">
                <label class="login__label form__label" for="login-password">Пароль</label>
                <div class="form__input-section">
                    <input class="login__input form__input" id="login-password" type="password" name="password"
                           placeholder="Введите пароль" value="<?= !empty($_POST['password']) ? $_POST['password']: '' ?>">

                    <button class="form__error-button button button--main" <?= !empty($errors['password']) ? 'style="display: inline"' : '' ?> type="button">!
                        <span class="visually-hidden">Информация об ошибке</span>
                    </button>

                    <div class="form__error-text">
                        <h3 class="form__error-title">Заголовок сообщения</h3>
                        <p class="form__error-desc"><?= $errors['password'] ?></p>
                    </div>

                </div>
            </div>
            <button class="login__submit button button--main" type="submit">Отправить</button>
        </form>
    </section>
</main>
