<?php

require_once('settings.php');

/**
 * Функция сохранения загруженного изображения, если оно есть или
 * сохранения изображения по ссылке
 * @param $fileName
 * @param $fileUrl
 * @return false|string
 */
function uploadImage($fileName, $fileUrl)
{
    if (!empty($fileName['picture']) && $fileName['picture']['error'] !== 4) {
        $file_name = $fileName['picture']['name'];
        $file_path = __DIR__ . '/uploads/avatar_user/';

        move_uploaded_file($fileName['picture']['tmp_name'], $file_path . $file_name);

        return '/uploads/avatar_user/' . $file_name;
    }

    $image_content = file_get_contents($_POST[$fileUrl]);
    $file_name = basename($_POST[$fileUrl]);
    $file_path = __DIR__ . '/uploads/avatar_user/';
    file_put_contents($file_path . $file_name, $image_content);

    return '/uploads/avatar_user/' . $file_name;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $fileUrl = null;
    $validate = checkRegister($_POST);

    $errors[] = $validate;

    if(empty(array_filter($errors))){
        if(!empty($_FILES['picture']['name'])) {
            $fileUrl = uploadImage($_FILES, 'picture');
        }

        $postId = addUsers($_POST, $fileUrl);
    }
}

$page_content = include_template('registration.php', [
    'errors' => reset($errors),
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: популярное',
    'is_auth' => rand(0, 1),
    'user_name' => 'Владислав',
]);

print($layout_content);
