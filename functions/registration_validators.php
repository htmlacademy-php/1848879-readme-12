<?php

require_once 'validators/form_general.php';

function checkEmail($email)
{
    $conn = mysqli_connect(HOST, USER, PASS, NAME);

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        return 'Email уже существует';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email должен быть корректным';
    }

    return false;
}

function checkPass($pass, $passRepeat)
{
    if (trim($pass) != trim($passRepeat)) {
        return "Повторный пароль введен не верно!";
    }
    return false;
}

function checkRegister($fields)
{
    $errors = [];

    $array_fields = ['email', 'login', 'password', 'password-repeat'];

    foreach ($array_fields as $field) {
        $errors[$field] = isCorrectFullness($field, 6);
    }

    $errors[$fields['email']] = checkEmail($fields['email']);

    $errors[$fields['password']] = checkPass($fields['password'], $fields['password-repeat']);

    if (!empty($_FILES['picture']['name'])) {
        $files = $_FILES;
        $errors['userpic-file'] = upload_post_picture($files);
    }

    return array_filter($errors);
}
