<?php

require_once('settings.php');

const CONTENT_PHOTO = 'photo';
const CONTENT_VIDEO = 'video';
const CONTENT_TEXT = 'text';
const CONTENT_QUOTE = 'quote';
const CONTENT_LINK = 'link';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $validateGeneral = checkTypeGeneral('heading', 'tags');

    switch ($_POST['form-type']) {
        case CONTENT_PHOTO:
            $validate = checkTypePhoto( 'photo-url');
            $errors[] = array_merge($validateGeneral, $validate);

            if(empty(reset($errors))) {
                print_r('okey');
            }
            break;
        case CONTENT_VIDEO:
            $validate = checkTypeVideo('link');
            $errors[] = array_merge($validateGeneral, $validate);

            if(empty(reset($errors))) {
                print_r('okey');
            }
            break;
        case CONTENT_TEXT:
            $validate = checkTypeText('content');
            $errors[] = array_merge($validateGeneral, $validate);

            if(empty(reset($errors))) {
                print_r('okey');
            }
            break;
        case CONTENT_QUOTE:
            $validate = checkTypeQuote('quote-content', 'quote-author');
            $errors[] = array_merge($validateGeneral, $validate);

            if(empty(reset($errors))) {
                print_r('okey');
            }
            break;
        case CONTENT_LINK:
            $validate = checkTypeLink('link');
            $errors[] = array_merge($validateGeneral, $validate);

            if(empty(reset($errors))) {
                print_r('okey');
            }
            break;
    }
}

$typeAdding = takesGetDataDb(sprintf('SELECT * FROM type_posts WHERE id = %s', xssGetString($_GET['adding-type_id'])));

$types = getDataDb('SELECT * FROM type_posts');

$type_post = reset($typeAdding)['class_name'];

$type_active = include_template('add-post/' . $type_post . '.php', [
    'errors' => reset($errors),
]);

$page_content = include_template('adding-post.php', [
    'activePost' => $type_active,
    'type_post' => $type_post,
    'types' => $types,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Добавить публикацию',
    'is_auth' => rand(0, 1),
    'user_name' => 'Владислав',
]);

print($layout_content);
