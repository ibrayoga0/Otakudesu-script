<?php
require_once 'config.php';

class Database {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    // Add public method to get PDO instance
    public function getPdo() {
        return $this->pdo;
    }
    
    // Anime functions
    public function getOngoingAnime($limit = 15) {
        $sql = "SELECT a.*, COUNT(e.id) as episode_count 
                FROM anime a 
                LEFT JOIN episodes e ON a.id = e.anime_id 
                WHERE a.status = 'Ongoing' 
                GROUP BY a.id 
                ORDER BY a.updated_at DESC 
                LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getCompletedAnime($limit = 15) {
        $sql = "SELECT a.*, COUNT(e.id) as episode_count 
                FROM anime a 
                LEFT JOIN episodes e ON a.id = e.anime_id 
                WHERE a.status = 'Completed' 
                GROUP BY a.id 
                ORDER BY a.rating DESC 
                LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAnimeBySlug($slug) {
        $sql = "SELECT * FROM anime WHERE slug = :slug";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getAnimeGenres($anime_id) {
        $sql = "SELECT g.* FROM genres g 
                JOIN anime_genres ag ON g.id = ag.genre_id 
                WHERE ag.anime_id = :anime_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAnimeEpisodes($anime_id) {
        $sql = "SELECT * FROM episodes WHERE anime_id = :anime_id ORDER BY episode_number ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getEpisode($anime_id, $episode_number) {
        $sql = "SELECT e.*, a.title as anime_title, a.slug as anime_slug 
                FROM episodes e 
                JOIN anime a ON e.anime_id = a.id 
                WHERE e.anime_id = :anime_id AND e.episode_number = :episode_number";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->bindValue(':episode_number', $episode_number, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function searchAnime($query, $limit = 12) {
        $sql = "SELECT a.*, COUNT(e.id) as episode_count 
                FROM anime a 
                LEFT JOIN episodes e ON a.id = e.anime_id 
                WHERE a.title LIKE :query OR a.japanese_title LIKE :query 
                GROUP BY a.id 
                ORDER BY a.title ASC 
                LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAllGenres() {
        $sql = "SELECT * FROM genres ORDER BY name ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAnimeByGenre($genre_slug, $page = 1, $limit = 25) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT a.*, COUNT(e.id) as episode_count 
                FROM anime a 
                LEFT JOIN episodes e ON a.id = e.anime_id 
                JOIN anime_genres ag ON a.id = ag.anime_id 
                JOIN genres g ON ag.genre_id = g.id 
                WHERE g.slug = :genre_slug 
                GROUP BY a.id 
                ORDER BY a.updated_at DESC 
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':genre_slug', $genre_slug);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getRandomAnime($limit = 5) {
        $sql = "SELECT * FROM anime ORDER BY RAND() LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

$db = new Database();
?>