<?php

require_once dirname(__DIR__) . '/settings.php';

const CONTENT_PHOTO = 1;
const CONTENT_VIDEO = 2;
const CONTENT_TEXT = 3;
const CONTENT_QUOTE = 4;
const CONTENT_LINK = 5;

$errors = [];

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
        $file_path = __DIR__ . '/uploads/';

        move_uploaded_file($fileName['picture']['tmp_name'], $file_path . $file_name);

        return '/uploads/' . $file_name;
    }

    $image_content = file_get_contents($_POST[$fileUrl]);
    $file_name = basename($_POST[$fileUrl]);
    $file_path = __DIR__ . '/uploads/img_posts/';
    file_put_contents($file_path . $file_name, $image_content);

    return '/uploads/img_posts/' . $file_name;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validateGeneral = checkTypeGeneral('heading', 'tags');
    switch ($_POST['form-type']) {
        case CONTENT_PHOTO:
            $validate = checkTypePhoto( 'photo-url');
            $errors = array_merge($validateGeneral, $validate);


            if(empty($errors)) {
                $fileUrl = uploadImage($_FILES, 'photo-url');
                $postId = addPost($_POST, $fileUrl);

                if(!empty($_POST['tags'])) {
                    addHashtag(hashtagArray($_POST['tags']), $postId);
                }

                $URL = '/index.php?post_id=' . $postId;
                header("Location: $URL");
            }
            break;
        case CONTENT_VIDEO:
            $validate = checkTypeVideo('content');
            $errors = array_merge($validateGeneral, $validate);

            if(empty($errors)) {
                $postId = addPost($_POST);

                if(!empty($_POST['tags'])) {
                    addHashtag(hashtagArray($_POST['tags']), $postId);
                }

                $URL = '/index.php?post_id=' . $postId;
                header("Location: $URL");
            }
            break;
        case CONTENT_TEXT:
            $validate = checkTypeText('content');
            $errors = array_merge($validateGeneral, $validate);

            if(empty($errors)) {
                $postId = addPost($_POST);

                if(!empty($_POST['tags'])) {
                    addHashtag(hashtagArray($_POST['tags']), $postId);
                }

                $URL = '/index.php?post_id=' . $postId;
                header("Location: $URL");
            }
            break;
        case CONTENT_QUOTE:
            $validate = checkTypeQuote('content', 'quote-author');
            $errors = array_merge($validateGeneral, $validate);

            if(empty($errors)) {
                $postId = addPost($_POST);

                if(!empty($_POST['tags'])) {
                    addHashtag(hashtagArray($_POST['tags']), $postId);
                }

                $URL = '/index.php?post_id=' . $postId;
                header("Location: $URL");
            }
            break;
        case CONTENT_LINK:
            $validate = checkTypeLink('content');
            $errors = array_merge($validateGeneral, $validate);

            if(empty($errors)) {
                $postId = addPost($_POST);

                if(!empty($_POST['tags'])) {
                    addHashtag(hashtagArray($_POST['tags']), $postId);
                }

                $URL = '/index.php?post_id=' . $postId;
                header("Location: $URL");
            }
            break;
    }
}

$typeAdding = takesGetDataDb(sprintf('SELECT * FROM type_posts WHERE id = %s', xssGetString($_GET['adding-type_id'])));

$types = getDataDb('SELECT * FROM type_posts');

$type_post = $typeAdding[0]['class_name'];

$type_active = include_template('add-post/' . $type_post . '.php', [
    'errors' => $errors,
]);

$page_content = include_template('adding-post.php', [
    'activePost' => $type_active,
    'type_post' => $type_post,
    'types' => $types,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Добавить публикацию',
]);

print($layout_content);
