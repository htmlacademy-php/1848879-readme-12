<?php

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
function getIdFromParams(array $params): ?int
{
    if (!isset($params['id'])) {
        return null;
    }

    if (!is_numeric($params['id'])) {
        exit('Неверный параметр в запросе');
    }

    return (int)$params['id'];
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
//function addPost(mysqli $connection, array $data)
//{
//
////    id           INT AUTO_INCREMENT PRIMARY KEY,
////    user_id      INT,
////    title        VARCHAR(128) NOT NULL,
////    type_id      INT,
////    content      TEXT         NOT NULL,
////    name         VARCHAR(128),
////    file_id      VARCHAR(255),
////    date         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
////    views_amount INT,
////    FOREIGN KEY (user_id) REFERENCES users (id),
////    FOREIGN KEY (type_id) REFERENCES type_posts (id)
//
//    $contentTypeId = getIdFromParams($_GET) ?? 1;
//
//    $header = getSafePost($data['header']);
//    $content = getSafePost($data['content']);
//    $file = $_FILES['picture']['name'];
//
//
//    $sql = "INSERT INTO `posts` (user_id, title, type_id, content, name, file_id, date, views_amount) VALUES (1, $header, 1, $content, 'Владислав', $file, now(), 0)";
//
//    if(mysqli_query($connection, $sql)){
//        echo "Данные успешно добавлены";
//    } else{
//        echo "Ошибка: " . mysqli_error($connection);
//    }
//    mysqli_close($connection);
////    $stmt = mysqli_prepare($connection, $sql);
////    mysqli_stmt_bind_param($stmt, 'sssssssi', $header, $contentTypeId, $content, $_FILES['picture']['name']);
////    $result = mysqli_stmt_execute($stmt);
////
////    if (!$result) {
////        echo 'Ошибка' . mysqli_error($connection);
////    }
//}

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

function addPhoto(array $dataPost)
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);

    $header = getSafePost($dataPost['heading']);
    $file = $_FILES['picture']['name'];
    $name = 'Владислав';

    $sql = "INSERT INTO `posts` (user_id, title, type_id, content, name, date, views_amount) VALUES (1, '{$header}', 1, '{$file}', '{$name}', NOW(), 0)";

    if(mysqli_query($con, $sql)){
        var_dump("Данные успешно добавлены");
    } else{
        var_dump("Ошибка: " . mysqli_error($con));
    }
    mysqli_close($con);

//    header('/');
//    exit();
}
