<?php
require_once 'config.php';

// Get genre slug from URL
$genre_slug = isset($_GET['slug']) ? $_GET['slug'] : 'action';

// Sample genres data
$genres_data = [
    'action' => ['name' => 'Action', 'description' => 'Anime dengan banyak adegan pertarungan, aksi, dan petualangan yang menegangkan'],
    'adventure' => ['name' => 'Adventure', 'description' => 'Anime yang mengisahkan perjalanan dan petualangan karakter utama'],
    'comedy' => ['name' => 'Comedy', 'description' => 'Anime dengan unsur komedi dan humor yang menghibur'],
    'drama' => ['name' => 'Drama', 'description' => 'Anime dengan cerita yang menyentuh dan penuh emosi'],
    'fantasy' => ['name' => 'Fantasy', 'description' => 'Anime dengan setting dunia fantasi, magic, dan makhluk mitos'],
    'romance' => ['name' => 'Romance', 'description' => 'Anime yang berfokus pada kisah cinta dan hubungan romantis'],
    'shounen' => ['name' => 'Shounen', 'description' => 'Anime yang ditargetkan untuk remaja laki-laki dengan tema persahabatan dan perjuangan'],
    'isekai' => ['name' => 'Isekai', 'description' => 'Anime tentang karakter yang berpindah ke dunia lain atau dunia paralel'],
];

// Get current genre info
$current_genre = isset($genres_data[$genre_slug]) ? $genres_data[$genre_slug] : $genres_data['action'];

// Sample anime data for the genre
$anime_by_genre = [
    'action' => [
        ['id' => 1, 'title' => 'Attack on Titan', 'poster' => 'aot.jpg', 'episode' => 'Episode 87', 'rating' => '9.5', 'status' => 'Complete'],
        ['id' => 2, 'title' => 'Jujutsu Kaisen', 'poster' => 'jjk.jpg', 'episode' => 'Episode 24', 'rating' => '9.1', 'status' => 'Ongoing'],
        ['id' => 3, 'title' => 'Demon Slayer', 'poster' => 'kny.jpg', 'episode' => 'Episode 44', 'rating' => '9.2', 'status' => 'Ongoing'],
        ['id' => 4, 'title' => 'One Punch Man', 'poster' => 'opm.jpg', 'episode' => 'Episode 24', 'rating' => '9.0', 'status' => 'Ongoing'],
        ['id' => 5, 'title' => 'My Hero Academia', 'poster' => 'mha.jpg', 'episode' => 'Episode 138', 'rating' => '9.2', 'status' => 'Ongoing'],
    ],
    'romance' => [
        ['id' => 6, 'title' => 'Your Name', 'poster' => 'yourname.jpg', 'episode' => 'Movie', 'rating' => '8.4', 'status' => 'Complete'],
        ['id' => 7, 'title' => 'Toradora!', 'poster' => 'toradora.jpg', 'episode' => 'Episode 25', 'rating' => '8.1', 'status' => 'Complete'],
        ['id' => 8, 'title' => 'Kaguya-sama', 'poster' => 'kaguya.jpg', 'episode' => 'Episode 37', 'rating' => '8.7', 'status' => 'Complete'],
    ],
    'fantasy' => [
        ['id' => 9, 'title' => 'Fairy Tail', 'poster' => 'fairytail.jpg', 'episode' => 'Episode 328', 'rating' => '8.3', 'status' => 'Complete'],
        ['id' => 10, 'title' => 'Overlord', 'poster' => 'overlord.jpg', 'episode' => 'Episode 52', 'rating' => '8.7', 'status' => 'Complete'],
    ]
];

// Get anime for current genre (fallback to action if not found)
$current_anime = isset($anime_by_genre[$genre_slug]) ? $anime_by_genre[$genre_slug] : $anime_by_genre['action'];

// Pagination
$items_per_page = 20;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$total_items = count($current_anime);
$total_pages = ceil($total_items / $items_per_page);
$offset = ($current_page - 1) * $items_per_page;
$anime_on_page = array_slice($current_anime, $offset, $items_per_page);

$page_title = "Genre {$current_genre['name']} - Otakudesu";
include 'includes/header.php';
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Genre Header -->
                <div class="genre-header">
                    <h1 class="genre-title">Genre <?= htmlspecialchars($current_genre['name']) ?></h1>
                    <p class="genre-description"><?= htmlspecialchars($current_genre['description']) ?></p>
                    <div class="genre-stats">
                        <span class="total-anime"><?= $total_items ?> Anime ditemukan</span>
                    </div>
                </div>

                <!-- Anime Grid -->
                <div class="anime-grid-section">
                    <div class="anime-grid-container">
                        <?php foreach ($anime_on_page as $anime): ?>
                            <div class="anime-card">
                                <div class="card-poster">
                                    <img src="<?= asset_url("images/anime/{$anime['poster']}") ?>" 
                                         alt="<?= htmlspecialchars($anime['title']) ?>" 
                                         onerror="this.src='<?= asset_url('images/placeholder.jpg') ?>'">
                                    <div class="card-overlay">
                                        <a href="<?= site_url("anime-detail.php?id={$anime['id']}") ?>" class="play-btn">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>
                                    <div class="rating-badge">
                                        <i class="fas fa-star"></i>
                                        <?= $anime['rating'] ?>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h3 class="anime-title">
                                        <a href="<?= site_url("anime-detail.php?id={$anime['id']}") ?>">
                                            <?= htmlspecialchars($anime['title']) ?>
                                        </a>
                                    </h3>
                                    <div class="anime-meta">
                                        <span class="episode-info"><?= $anime['episode'] ?></span>
                                        <span class="status-badge <?= strtolower($anime['status']) ?>">
                                            <?= $anime['status'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <div class="pagination-wrapper">
                            <div class="pagination-info">
                                Halaman <?= $current_page ?> dari <?= $total_pages ?>
                            </div>
                            <nav aria-label="Genre pagination">
                                <ul class="pagination">
                                    <?php if ($current_page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= site_url("genre.php?slug={$genre_slug}&page=" . ($current_page - 1)) ?>">
                                                <i class="fas fa-chevron-left"></i> Prev
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                                        <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= site_url("genre.php?slug={$genre_slug}&page={$i}") ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($current_page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= site_url("genre.php?slug={$genre_slug}&page=" . ($current_page + 1)) ?>">
                                                Next <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-lg-4">
                <?php include 'includes/sidebar.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>