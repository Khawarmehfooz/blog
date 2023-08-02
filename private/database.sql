CREATE DATABASE blog_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_excerpt VARCHAR(255) NOT NULL,
    post_description TEXT NOT NULL,
    publish_date DATE NOT NULL,
    post_thumbnail VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE admins(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL
);