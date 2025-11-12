-- Otakudesu Database Schema
-- Created: November 10, 2025

CREATE DATABASE IF NOT EXISTS otakudesu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE otakudesu;

-- Genres table
CREATE TABLE genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Anime table
CREATE TABLE anime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    japanese_title VARCHAR(255),
    slug VARCHAR(255) NOT NULL UNIQUE,
    synopsis TEXT,
    poster VARCHAR(255),
    studio VARCHAR(100),
    producer VARCHAR(100),
    type ENUM('TV', 'Movie', 'OVA', 'ONA', 'Special') DEFAULT 'TV',
    status ENUM('Ongoing', 'Completed', 'Upcoming') DEFAULT 'Ongoing',
    total_episodes INT DEFAULT 0,
    duration VARCHAR(50),
    release_date DATE,
    rating DECIMAL(3,2) DEFAULT 0.00,
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Episodes table
CREATE TABLE episodes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    anime_id INT NOT NULL,
    episode_number INT NOT NULL,
    title VARCHAR(255),
    embed_url TEXT,
    mirror_360p TEXT,
    mirror_480p TEXT,
    mirror_720p TEXT,
    download_links JSON,
    release_date DATE,
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (anime_id) REFERENCES anime(id) ON DELETE CASCADE,
    UNIQUE KEY unique_episode (anime_id, episode_number)
);

-- Anime-Genre relationship table
CREATE TABLE anime_genres (
    anime_id INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (anime_id, genre_id),
    FOREIGN KEY (anime_id) REFERENCES anime(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
);

-- Batch downloads table
CREATE TABLE batch_downloads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    anime_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    download_links JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (anime_id) REFERENCES anime(id) ON DELETE CASCADE
);

-- Insert default genres
INSERT INTO genres (name, slug) VALUES
('Action', 'action'),
('Adventure', 'adventure'),
('Comedy', 'comedy'),
('Drama', 'drama'),
('Fantasy', 'fantasy'),
('Romance', 'romance'),
('Sci-Fi', 'sci-fi'),
('Slice of Life', 'slice-of-life'),
('Supernatural', 'supernatural'),
('Thriller', 'thriller'),
('Horror', 'horror'),
('Mystery', 'mystery'),
('Sports', 'sports'),
('School', 'school'),
('Military', 'military'),
('Historical', 'historical'),
('Mecha', 'mecha'),
('Music', 'music'),
('Psychological', 'psychological'),
('Shounen', 'shounen'),
('Shoujo', 'shoujo'),
('Seinen', 'seinen'),
('Josei', 'josei'),
('Ecchi', 'ecchi'),
('Harem', 'harem'),
('Isekai', 'isekai');