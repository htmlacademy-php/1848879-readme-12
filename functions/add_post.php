<?php

function uploadPhoto($data)
{
    $fileName = $data['photo']['name'];
    $filePath = __DIR__ . '/uploads/';

    move_uploaded_file($data['picture']['tmp_name'], $filePath . $fileName);
}


/**
 * Извлекает картинку из ссылки и перемещает в директорию сайта
 * @param $data - входящий суперглобальный массив $_POST
 * @return string
 */
function uploadPhotoUrl($data)
{
    $allowedPics = ['jpg', 'jpeg', 'png', 'gif'];

    $filterUrl = filter_var($data['photo-url'], FILTER_VALIDATE_URL);

    $fileName = basename(parse_url($filterUrl, PHP_URL_PATH));
    $mime = pathinfo($fileName, PATHINFO_EXTENSION);

    if (in_array($mime, $allowedPics)) {

        $downloadFile = file_get_contents($filterUrl);
        $filePath = __DIR__ . '/uploads/';
        file_put_contents($filePath . $fileName, $downloadFile);
    }

    return $fileName;
}

/**
 * Возвращает числовой get id параметр приведенный
 * @param array $params
 * @return int|null
 */
function getIdFromParams(array $params) : ?int
{
    if (!isset($params['id'])) {
        return null;
    }

    if (! is_numeric($params['id'])) {
        exit('Неверный параметр в запросе');
    }

    return (int) $params['id'];
}

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
 * Добавляет созданный пользователем пост
 * @param mysqli $connection
 * @param $criteria - массив с данными для заполнения таблицы post
 */
function addPost(mysqli $connection, array $data)
{
    $sql = "INSERT INTO `posts` VALUES (NULL, now(), ?, ?, ?, ?, ?, ?, ?, 0, ?, 2, 0, 2, 0, 0)";

    $contentTypeId = getIdFromParams($_GET) ?? 1;

    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $data['header'], $data['content'], $data['quote-author'], $data['photo']['name'], $data['video'], $data['videoCover'], $data['link'], $contentTypeId);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        echo 'Ошибка' . mysqli_error($connection);
    }
}

/**
 * Добавляет хештег к позданному посту
 * @param mysqli $connection
 * @param array $hashtag
 * @param $lastPostId
 */
function addHashtag(mysqli $connection, array $hashtag, int $lastPostId)
{
    foreach ($hashtag as $tag) {
        $sql = "INSERT INTO `hashtag` VALUES(NULL, '{$tag}')";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            echo 'Ошибка' . mysqli_error($connection);
        }

        $lastHashId = mysqli_insert_id($connection);

        $sql = "INSERT INTO `hashtags` VALUES(NULL, '{$lastPostId}', '{$lastHashId}')";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            echo 'Ошибка' . mysqli_error($connection);
        }
    }
}

function addPhoto(array $data, array $error)
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);

    if (!$error) {
        if (!empty($data['picture']['name'])) {
            uploadPhoto($data);
        } else {
            $data['picture']['name'] = uploadPhotoUrl($data);
        }

        addPost($con, $data);
        $lastPostId = mysqli_insert_id($con);

        if (!empty(trim($data['tags']))) {
            $hashtagArray = hashtagArray(trim($data['tags']));
            addHashtag($con, $hashtagArray, $lastPostId);
        }
        header('Location: /post.php?id=' . $lastPostId);
        exit();
    }
}
