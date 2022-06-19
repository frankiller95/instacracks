CREATE DATABASE IF NOT EXISTS instacracks_master;
USE instacracks_master;

CREATE TABLE IF NOT EXISTS users (
  id INT(255) NOT NULL AUTO_INCREMENT,
  role VARCHAR(20) NOT NULL, 
  name VARCHAR(100) NOT NULL,
  surname VARCHAR(100) NOT NULL,
  nick VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  remember_token VARCHAR(255) NOT NULL,
  CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS images (
  id INT(255) NOT NULL AUTO_INCREMENT,
  user_id INT(255) NOT NULL,
  image_path VARCHAR(255) NOT NULL, 
  description text(100) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  CONSTRAINT pk_images PRIMARY KEY(id),
  CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS comments (
  id INT(255) NOT NULL AUTO_INCREMENT,
  user_id INT(255) NOT NULL,
  image_id INT(255) NOT NULL,
  content text NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  CONSTRAINT pk_comments PRIMARY KEY(id),
  CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS likes (
  id INT(255) NOT NULL AUTO_INCREMENT,
  user_id INT(255) NOT NULL,
  image_id INT(255) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  CONSTRAINT pk_likes PRIMARY KEY(id),
  CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDB;