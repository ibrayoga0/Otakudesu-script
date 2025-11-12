<?php
require_once 'config.php';

// Get search query
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Sample search results (in real app, this would come from database)
$search_results = [];

if (!empty($search_query)) {
    // Sample anime data for search  
    $all_anime = [
        ['id' => 1, 'title' => 'Attack on Titan', 'alt_title' => 'Shingeki no Kyojin', 'poster' => 'aot.jpg', 'genres' => 'Action, Drama, Fantasy', 'rating' => '9.5', 'status' => 'Complete', 'year' => '2013', 'type' => 'TV'],
        ['id' => 2, 'title' => 'Jujutsu Kaisen', 'alt_title' => 'Sorcery Fight', 'poster' => 'jjk.jpg', 'genres' => 'Action, Supernatural, School', 'rating' => '9.1', 'status' => 'Ongoing', 'year' => '2020', 'type' => 'TV'],
        ['id' => 3, 'title' => 'Demon Slayer', 'alt_title' => 'Kimetsu no Yaiba', 'poster' => 'kny.jpg', 'genres' => 'Action, Historical, Supernatural', 'rating' => '9.2', 'status' => 'Ongoing', 'year' => '2019', 'type' => 'TV'],
        ['id' => 4, 'title' => 'One Piece', 'alt_title' => 'One Piece', 'poster' => 'onepiece.jpg', 'genres' => 'Action, Adventure, Comedy', 'rating' => '9.3', 'status' => 'Ongoing', 'year' => '1999', 'type' => 'TV'],
        ['id' => 5, 'title' => 'Naruto', 'alt_title' => 'Naruto', 'poster' => 'naruto.jpg', 'genres' => 'Action, Martial Arts, Ninja', 'rating' => '8.9', 'status' => 'Complete', 'year' => '2002', 'type' => 'TV'],
        ['id' => 6, 'title' => 'Dragon Ball Super', 'alt_title' => 'Dragon Ball Super', 'poster' => 'dbs.jpg', 'genres' => 'Action, Adventure, Martial Arts', 'rating' => '8.8', 'status' => 'Complete', 'year' => '2015', 'type' => 'TV'],
        ['id' => 7, 'title' => 'My Hero Academia', 'alt_title' => 'Boku no Hero Academia', 'poster' => 'mha.jpg', 'genres' => 'Action, School, Superhero', 'rating' => '9.2', 'status' => 'Ongoing', 'year' => '2016', 'type' => 'TV'],
        ['id' => 8, 'title' => 'One Punch Man', 'alt_title' => 'One Punch Man', 'poster' => 'opm.jpg', 'genres' => 'Action, Comedy, Superhero', 'rating' => '9.4', 'status' => 'Ongoing', 'year' => '2015', 'type' => 'TV'],
        ['id' => 9, 'title' => 'Hunter x Hunter', 'alt_title' => 'Hunter x Hunter', 'poster' => 'hxh.jpg', 'genres' => 'Action, Adventure, Fantasy', 'rating' => '9.6', 'status' => 'Complete', 'year' => '2011', 'type' => 'TV'],
        ['id' => 10, 'title' => 'Fullmetal Alchemist', 'alt_title' => 'Hagane no Renkinjutsushi', 'poster' => 'fma.jpg', 'genres' => 'Action, Adventure, Drama', 'rating' => '9.7', 'status' => 'Complete', 'year' => '2003', 'type' => 'TV'],
        ['id' => 11, 'title' => 'Death Note', 'alt_title' => 'Death Note', 'poster' => 'dn.jpg', 'genres' => 'Supernatural, Thriller, Psychological', 'rating' => '9.8', 'status' => 'Complete', 'year' => '2006', 'type' => 'TV'],
        ['id' => 12, 'title' => 'Tokyo Ghoul', 'alt_title' => 'Tokyo Ghoul', 'poster' => 'tg.jpg', 'genres' => 'Action, Horror, Supernatural', 'rating' => '8.7', 'status' => 'Complete', 'year' => '2014', 'type' => 'TV'],
    ];
    
    // Filter anime based on search query (max 12 results)
    $search_query_lower = strtolower($search_query);
    foreach ($all_anime as $anime) {
        if (count($search_results) >= 12) break; // Max 12 results
        
        if (strpos(strtolower($anime['title']), $search_query_lower) !== false ||
            strpos(strtolower($anime['alt_title']), $search_query_lower) !== false ||
            strpos(strtolower($anime['genres']), $search_query_lower) !== false) {
            $search_results[] = $anime;
        }
    }
}

$page_title = !empty($search_query) ? "Pencarian: $search_query - Otakudesu" : "Pencarian Anime - Otakudesu";
include 'includes/header.php';
?>

<!-- Main Content -->
<div id="venkonten">
    <div class="vezone">
        <!-- Main Content Area -->
        <div class="venser">
            <div class="venutama">
                <!-- Search Title Bar -->
                <div class="rvad">
                    <h1><i class="fas fa-search"></i> Hasil Pencarian (Max. hanya sampai 12 hasil)</h1>
                </div>

                <?php if (!empty($search_query)): ?>
                    <?php if (!empty($search_results)): ?>
                        <!-- Search Results -->
                        <div class="chivsrc">
                            <ul>
                                <?php foreach ($search_results as $anime): ?>
                                    <li>
                                        <img src="<?= asset_url("images/anime-placeholder.jpg") ?>" 
                                             alt="<?= htmlspecialchars($anime['title']) ?>" 
                                             onerror="this.src='<?= asset_url("images/anime-placeholder.jpg") ?>'">
                                        
                                        <div class="anime-info">
                                            <h2>
                                                <a href="<?= site_url("anime-detail.php?slug=" . strtolower(str_replace(' ', '-', $anime['title']))) ?>">
                                                    <?= htmlspecialchars($anime['title']) ?>
                                                </a>
                                            </h2>
                                            
                                            <div class="set">
                                                <b>Judul:</b> <?= htmlspecialchars($anime['alt_title']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Genres:</b> <?= htmlspecialchars($anime['genres']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Status:</b> <?= htmlspecialchars($anime['status']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Rating:</b> <?= htmlspecialchars($anime['rating']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Type:</b> <?= htmlspecialchars($anime['type']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Tahun:</b> <?= htmlspecialchars($anime['year']) ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- No Results -->
                        <div style="padding: 20px; text-align: center; color: #ccc;">
                            <h3>Tidak ada anime yang ditemukan untuk pencarian "<?= htmlspecialchars($search_query) ?>"</h3>
                            <p>Coba gunakan kata kunci yang berbeda atau periksa ejaan.</p>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Search Form when no query -->
                    <div style="padding: 20px; text-align: center; color: #ccc;">
                        <h3>Cari Anime Favorit Anda</h3>
                        <p>Masukkan nama anime, genre, atau kata kunci pada kolom pencarian di atas.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>