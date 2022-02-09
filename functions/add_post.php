<?php

/**
 * Возвращает массив хештегов
 * @param $hashtags
 * @return array
 */
function hashtagArray($hashtags): array
{
    return explode(' ', $hashtags);
}

/**
 * Добавляет хештег к заданному посту
 * @param array $hashtag
 * @param int $lastPostId
 */
function addHashtag(array $hashtag, int $lastPostId)
{
    $connection = mysqli_connect(HOST, USER, PASS, NAME);

    foreach ($hashtag as $tag) {
        $sql = "INSERT INTO `hashtags` (post_id, title) VALUES ('$lastPostId', '$tag')";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            echo 'Ошибка' . mysqli_error($connection);
        }
    }
}

/**
 * Функция сохранения загруженного изображения, если оно есть или
 * сохранения изображения по ссылке
 * @param $fileName
 * @param $fileUrl
 * @return string
 */
function uploadImage($fileName, $fileUrl): string
{
    if (!empty($fileName['picture']) && $fileName['picture']['error'] !== 4) {
        $file_name = $fileName['picture']['name'];
        $file_path = dirname(__DIR__) . '/uploads/';

        move_uploaded_file($fileName['picture']['tmp_name'], $file_path . $file_name);

        return '/uploads/' . $file_name;
    }

    $image_content = file_get_contents($_POST[$fileUrl]);
    $file_name = basename($_POST[$fileUrl]);
    $file_path = dirname(__DIR__) . '/uploads/';
    file_put_contents($file_path . $file_name, $image_content);

    return '/uploads/' . $file_name;
}

/**
 * Добавляет созданный пользователем пост
 * @param array $dataPost метод POST
 * @param $fileUrl, если есть картинка
 */
function addPost(array $dataPost, $id, $fileUrl = null)
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);

    $header = getSafePost($dataPost['heading']);
    $type_id = getSafePost($dataPost['form-type']);
    $author = NULL;
    $content = NULL;

    if($dataPost['form-type'] == 1){
        if ($fileUrl) {
            $content = $fileUrl;
        }
    } else {
        $content = getSafePost($dataPost['content']);
    }

    if($dataPost['quote-author'] != '') {
        $author = getSafePost($dataPost['quote-author']);
    }

    $sql = "INSERT INTO `posts` (user_id, title, type_id, content, author_quote, date, views_amount) VALUES ('$id', '$header', '$type_id', '$content', '$author', NOW(), 0)";

    if (mysqli_query($con, $sql)) {
        var_dump("Данные успешно добавлены");
    } else {
        var_dump("Ошибка: " . mysqli_error($con));
    }

    return mysqli_insert_id($con);
}
