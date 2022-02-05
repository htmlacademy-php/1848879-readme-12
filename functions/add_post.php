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
 * Добавляет созданный пользователем пост
 * @param array $dataPost метод POST
 * @param $fileUrl, если есть картинка
 */
function addPost(array $dataPost, $fileUrl = null)
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

    $sql = "INSERT INTO `posts` (user_id, title, type_id, content, author_quote, date, views_amount) VALUES (1, '$header', '$type_id', '$content', '$author', NOW(), 0)";

    if (mysqli_query($con, $sql)) {
        var_dump("Данные успешно добавлены");
    } else {
        var_dump("Ошибка: " . mysqli_error($con));
    }

    return mysqli_insert_id($con);
}
