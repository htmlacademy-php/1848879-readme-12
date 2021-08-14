CREATE DATABASE readme
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE readme;

CREATE TABLE users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    email      VARCHAR(128) NOT NULL UNIQUE,
    name       CHAR(128)    NOT NULL,
    password   CHAR(128)    NOT NULL,
    avatar_url VARCHAR(255)
);

CREATE TABLE type_posts
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(128) NOT NULL,
    class_name VARCHAR(128) NOT NULL
);

CREATE TABLE posts
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT,
    title        VARCHAR(128) NOT NULL,
    type_id      INT,
    content      TEXT         NOT NULL,
    name         VARCHAR(128),
    file_id      VARCHAR(255),
    date         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    views_amount INT,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (type_id) REFERENCES type_posts (id)
);


CREATE TABLE hashtags
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(128) NOT NULL
);

CREATE TABLE comments
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    text_content TEXT NOT NULL,
    author_id    INT,
    post_id      INT,
    FOREIGN KEY (author_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);


CREATE TABLE likes
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE
);

CREATE TABLE subscriptions
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT,
    follower_id INT,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (follower_id) REFERENCES users (id)
);

CREATE TABLE messages
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    create_date  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    text_content TEXT NOT NULL,
    sender_id    INT,
    receiver_id  INT,
    FOREIGN KEY (sender_id) REFERENCES users (id),
    FOREIGN KEY (receiver_id) REFERENCES users (id)
);

CREATE TABLE post_hashtags
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    post_id    INT,
    hashtag_id INT,
    FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE,
    FOREIGN KEY (hashtag_id) REFERENCES hashtags (id) ON DELETE CASCADE
);
