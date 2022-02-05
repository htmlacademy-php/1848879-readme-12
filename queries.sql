INSERT INTO type_posts (title, class_name) VALUES ('Фото', 'photo');
INSERT INTO type_posts (title, class_name) VALUES ('Видео', 'video');
INSERT INTO type_posts (title, class_name) VALUES ('Текст', 'text');
INSERT INTO type_posts (title, class_name) VALUES ('Цитата', 'quote');
INSERT INTO type_posts (title, class_name) VALUES ('Ссылка', 'link');

INSERT INTO users (email, name,  password, avatar_url) VALUES ('larisa@example.com', 'Лариса', 'qwerty1', 'userpic-larisa-small.jpg');
INSERT INTO users (email, name,  password, avatar_url) VALUES ('vladik@example.com', 'Владик', 'qwerty123', 'userpic.jpg');
INSERT INTO users (email, name,  password, avatar_url) VALUES ('виктор@пример.рф', 'Виктор', 'qwerty1', 'userpic-mark.jpg');

INSERT INTO posts (user_id, title, type_id, content, author_quote, date, views_amount) VALUES (1, 'Цитата', 4, 'Мы в жизни любим только раз, а после ищем лишь похожих', 'Пушкин', '2021-07-22 16:00', 25);
INSERT INTO posts (user_id, title, type_id, content, date, views_amount) VALUES (2, 'Игра престолов', 3, 'Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!', '2021-07-22 15:25', 20);
INSERT INTO posts (user_id, title, type_id, content, date, views_amount) VALUES (3, 'Наконец, обработал фотки!', 1, '/uploads/img_posts/rock-medium.jpg', '2021-07-15 13:05', 15);
INSERT INTO posts (user_id, title, type_id, content, date, views_amount) VALUES (1, 'Моя мечта', 1, '/uploads/img_posts/coast-medium.jpg', '2021-06-15 13:05', 10);
INSERT INTO posts (user_id, title, type_id, content, date, views_amount) VALUES (2, 'Лучшие курсы', 5, 'www.htmlacademy.ru', '2021-07-15 13:05', 40);

INSERT INTO comments (text_content, author_id, post_id) VALUES ('Вау!!!', 1, 2);
INSERT INTO comments (text_content, author_id, post_id) VALUES ('Ого', 3, 1);
INSERT INTO comments (text_content, author_id, post_id) VALUES ('Круто', 2, 4);

# --- Запросы ---

/*
 Получаем список постов с сортировкой по популярности вместе с именами авторов и типом контента
 */

SELECT p.*, u.name, ct.class_name
FROM posts p
         JOIN users u ON p.user_id = u.id
         JOIN type_posts ct ON p.type_id = ct.id
ORDER BY views_amount DESC;

/*
 Получаем список постов для пользователя c id 1
*/

SELECT * FROM posts WHERE user_id = 1;

/*
 Получаем список комментариев для поста c id 2 c логином пользователя
*/

SELECT c.text_content, u.name
FROM comments c JOIN users u ON c.author_id = u.id
WHERE post_id = 2;

/*
 Добавляем лайк к посту с id 2;
*/

INSERT INTO likes (user_id, post_id) VALUES (1, 2);

/*
 Добавляем подписку пользователя с id 1 на пользователя с id 3;
*/

INSERT INTO subscriptions (user_id, follower_id) VALUES (3, 1);
