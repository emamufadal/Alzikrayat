-- Create the application database if it does not already exist.
CREATE DATABASE IF NOT EXISTS alzikrayat
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Select the application database for the following table definitions.
USE alzikrayat;

-- Store registered user accounts and profile information.
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(100),
    description TEXT,
    occupation VARCHAR(100)
) ENGINE=InnoDB;

-- Store uploaded photo metadata and ownership information.
CREATE TABLE photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_photos_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    INDEX (user_id),
    INDEX (date_time)
) ENGINE=InnoDB;

-- Store comments linked to both photos and users.
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    photo_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_comments_photo
        FOREIGN KEY (photo_id) REFERENCES photos(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_comments_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    INDEX (photo_id),
    INDEX (user_id)
) ENGINE=InnoDB;
