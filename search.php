<?php
require_once 'includes/config.php';

// Get search query
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Search results from database
$search_results = [];

if (!empty($search_query)) {
    $search_results = $db->searchAnime($search_query, 12);
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
                                        <img src="<?= get_anime_poster($anime['poster_url']) ?>" 
                                             alt="<?= htmlspecialchars($anime['title']) ?>" 
                                             onerror="this.src='<?= get_anime_poster('') ?>'">
                                        
                                        <div class="anime-info">
                                            <h2>
                                                <a href="<?= site_url('anime-detail.php?slug=' . $anime['slug']) ?>">
                                                    <?= htmlspecialchars($anime['title']) ?>
                                                </a>
                                            </h2>
                                            
                                            <div class="set">
                                                <b>Judul Jepang:</b> <?= htmlspecialchars($anime['japanese_title']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Status:</b> <?= htmlspecialchars($anime['status']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Rating:</b> <?= number_format($anime['rating'], 1) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Type:</b> <?= htmlspecialchars($anime['type']) ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Tahun:</b> <?= $anime['year'] ?>
                                            </div>
                                            
                                            <div class="set">
                                                <b>Episode:</b> <?= $anime['episode_count'] ?? 'N/A' ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <!-- Clear floats -->
                            <div style="clear: both;"></div>
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