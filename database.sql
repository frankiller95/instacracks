CREATE DATABASE IF NOT EXISTS instacracks_master;
USE instacracks_master;

CREATE TABLE IF NOT EXISTS users (
  id INT(255) NOT NULL AUTO_INCREMENT,
  role VARCHAR(20), 
  name VARCHAR(100) NOT NULL,
  surname VARCHAR(100),
  nick VARCHAR(100),
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  image VARCHAR(255),
  created_at datetime,
  updated_at datetime,
  remember_token VARCHAR(255),
  CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDB;

INSERT INTO users values (NULL, 'user', 'francisco', 'restrepo', 'franresdev', 'frank95299@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

INSERT INTO users values (NULL, 'user', 'juan', 'lopez', 'juanlo', 'juan@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

INSERT INTO users values (NULL, 'user', 'manolo', 'garcia', 'manogar', 'manogar@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

CREATE TABLE IF NOT EXISTS images (
  id INT(255) NOT NULL AUTO_INCREMENT,
  user_id INT(255) NOT NULL,
  image_path VARCHAR(255), 
  description text(100),
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  CONSTRAINT pk_images PRIMARY KEY(id),
  CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB;

INSERT INTO images values (NULL, 1, 'test.jpg', 'descripcion de prueba 1', CURTIME(), CURTIME());
INSERT INTO images values (NULL, 1, 'playa.jpg', 'descripcion de prueba 2', CURTIME(), CURTIME());
INSERT INTO images values (NULL, 1, 'arena.jpg', 'descripcion de prueba 3', CURTIME(), CURTIME());
INSERT INTO images values (NULL, 3, 'familia.jpg', 'descripcion de prueba 3', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments (
  id INT(255) NOT NULL AUTO_INCREMENT,
  user_id INT(255) NOT NULL,
  image_id INT(255) NOT NULL,
  content text,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  CONSTRAINT pk_comments PRIMARY KEY(id),
  CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDB;

INSERT INTO comments values (NULL, 1, 4, 'buena foto de familia', CURTIME(), CURTIME());
INSERT INTO comments values (NULL, 2, 1, 'Buena foto de playa', CURTIME(), CURTIME());
INSERT INTO comments values (NULL, 2, 4, 'gracias bro, bendiciones', CURTIME(), CURTIME());

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


INSERT INTO likes values (NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO likes values (NULL, 2, 4, CURTIME(), CURTIME());
INSERT INTO likes values (NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes values (NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO likes values (NULL, 2, 1, CURTIME(), CURTIME());

ALTER TABLE `users` CHANGE `role` `role` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL; 

ALTER TABLE `users` CHANGE `surname` `surname` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL; 

ALTER TABLE `users` CHANGE `nick` `nick` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;