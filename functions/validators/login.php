<?php

/**
 * Функция проверяет массив полей логина на заполненность
 * @param array $arrs Массив полей логина
 * @return array|bool
 */

function getEmpty(array $arrs) : array|bool {
    $error = [];

    foreach ($arrs as $arr) {
        if (empty($_POST[$arr])) {
            $error[$arr] = 'Поле не заполнено';
        }
    }

    return $error;
}

/**
 * Функция проверяет существование емеила
 * @param string $email Получает емеил адрес
 * @return array|string
 */
function searchEmail(string $email): array|string
{
    $conn = mysqli_connect(HOST, USER, PASS, NAME);

    $sql = "SELECT id, email, password, name FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        return false;
    }

    return $user;
}

function searchErrorsLogin() {
    $errors = [];
    $authorized = false;

    $searchEmpty = getEmpty(['email', 'password']);

    if (empty($searchEmpty)) {

        $user = searchEmail(getSafePost($_POST['email']));

        if (!$user) {
            $errors['email'] = 'email не найден';
        }

        if ($user && password_verify(getSafePost($_POST['password']), $user['password'])) {
            $authorized = true;

        } else {
            $errors['password'] = 'пароль неверный';
        }
    } else {
        $errors = $searchEmpty;
    }

    if (empty($errors)) {
        $user = searchEmail(getSafePost($_POST['email']));

        session_start();

        setcookie('visit', $user['email'], time() + (60 * 60 * 24 * 30), '/');

        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header('Location:/');
    }

    return $errors;
}
