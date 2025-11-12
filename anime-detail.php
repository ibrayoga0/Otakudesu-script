<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

// Set page class for specific styling
$page_class = 'anime-detail-page';

// Get anime slug from URL
$anime_slug = $_GET['slug'] ?? null;

if (!$anime_slug) {
    header('Location: ' . site_url());
    exit;
}

// Get anime data from database
$anime_data = $db->getAnimeBySlug($anime_slug);

if (!$anime_data) {
    // Redirect to 404 or homepage if anime not found
    header('Location: ' . site_url());
    exit;
}

// Get anime genres
$anime_genres = $db->getAnimeGenres($anime_data['id']);
$genre_names = array_column($anime_genres, 'name');

// Get episodes list
$episodes_list = $db->getAnimeEpisodes($anime_data['id']);

// Get recommended anime (random)
$recommended_anime = $db->getRandomAnime(5);

// Set page meta info
$page_title = htmlspecialchars($anime_data['title']) . ' - Otaku Desu';
$page_description = truncate_text($anime_data['description'], 160);

require_once 'includes/header.php';
?>

<div class="center">
    <div id="venkonten" class="vezone">
        <div class="venser">
            <!-- Anime Title -->
            <div class="jdlrx">
                <h1><?= htmlspecialchars($anime_data['title']) ?></h1>
            </div>
            
            <!-- Subheading -->
            <div class="subheading">
                <h2>Streaming <?= htmlspecialchars($anime_data['title']) ?> Sub Indo</h2>
            </div>
            
            <!-- Anime Info Section -->
            <div class="fotoanime">
                <img src="<?= get_anime_poster($anime_data['poster_url']) ?>" alt="<?= htmlspecialchars($anime_data['title']) ?>" />
                
                <div class="infozingle">
                    <p><b>Judul</b> : <?= htmlspecialchars($anime_data['title']) ?></p>
                    <p><b>Japanese</b> : <?= htmlspecialchars($anime_data['japanese_title']) ?></p>
                    <p><b>Skor</b> : <?= number_format($anime_data['rating'], 1) ?></p>
                    <p><b>Produser</b> : <?= htmlspecialchars($anime_data['studio']) ?></p>
                    <p><b>Type</b> : <?= htmlspecialchars($anime_data['type']) ?></p>
                    <p><b>Status</b> : <?= htmlspecialchars($anime_data['status']) ?></p>
                    <p><b>Total Episode</b> : <?= count($episodes_list) ?></p>
                    <p><b>Durasi</b> : 23 Min.</p>
                    <p><b>Tanggal Rilis</b> : <?= $anime_data['year'] ?></p>
                    <p><b>Studio</b> : <?= htmlspecialchars($anime_data['studio']) ?></p>
                    <p><b>Genre</b> : <?= implode(', ', $genre_names) ?></p>
                </div>
                
                <!-- Synopsis inside same container -->
                <div class="sinopc-inside">
                    <p><?= nl2br(htmlspecialchars($anime_data['description'])) ?></p>
                </div>
                
                <div style="clear: both;"></div>
            </div>
            
            <!-- Batch Download Section -->
            <div class="episodelist">
                <div class="smokelister">
                    <span class="monktit"><?= htmlspecialchars($anime_data['title']) ?> Batch</span>
                </div>
            </div>
            
            <!-- Episode List Section -->
            <div class="episodelist">
                <div class="smokelister">
                    <span class="monktit"><?= htmlspecialchars($anime_data['title']) ?> Episode List (Link Download Episode & Streaming)</span>
                </div>
                
                <ul>
                    <?php if (!empty($episodes_list)): ?>
                        <?php foreach($episodes_list as $index => $episode): ?>
                        <li class="<?= $index % 2 == 0 ? '' : 'alternate' ?>">
                            <span class="zeebr">
                                <a href="<?= site_url('episode.php?anime_id=' . $anime_data['id'] . '&episode=' . $episode['episode_number']) ?>">
                                    <?= htmlspecialchars($anime_data['title']) ?> Episode <?= $episode['episode_number'] ?> <?= !empty($episode['title']) ? '- ' . htmlspecialchars($episode['title']) : '' ?> Subtitle Indonesia
                                </a>
                            </span>
                            <span class="rightplace"><?= date('j F, Y', strtotime($episode['created_at'])) ?></span>
                        </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                            <span class="zeebr">
                                Episode belum tersedia
                            </span>
                            <span class="rightplace">Coming Soon</span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <!-- Keywords/Tags -->
            <div class="keyword">
                Streaming <?= htmlspecialchars($anime_data['title']) ?> Sub Indo, <?= htmlspecialchars($anime_data['title']) ?> resolusi 240p 360p 480p 720p format Mp4 dan Mkv Sub Indo, Download <?= htmlspecialchars($anime_data['title']) ?> Sub Indo, Nonton <?= htmlspecialchars($anime_data['title']) ?>, Download dan Streaming <?= htmlspecialchars($anime_data['title']) ?> Subtitle Indonesia, <?= htmlspecialchars($anime_data['title']) ?> Episode 1 - <?= count($episodes_list) ?> (<?= $anime_data['status'] === 'Completed' ? 'End' : 'Ongoing' ?>) Sub Indo, <?= htmlspecialchars($anime_data['title']) ?> Subtitle Indonesia
            </div>
            
            <!-- Share Section -->
            <div class="subheading">
                <h2>Jangan Lupa Bantu Share Anime <?= htmlspecialchars($anime_data['title']) ?> Sub Indo ke teman kalian ya.</h2>
            </div>
            
            <div class="sharing">
                <ul>
                    <li>
                        <a href="#" onclick="return false;">
                            <span class="fa fa-facebook"></span>
                        </a>
                        <div class="sharecount">Share Now</div>
                    </li>
                    <li>
                        <a href="#" onclick="return false;">
                            <span class="fa fa-twitter"></span>
                        </a>
                        <div class="sharecount">Share Now</div>
                    </li>
                    <li>
                        <a href="#" onclick="return false;">
                            <span class="fa fa-google-plus"></span>
                        </a>
                        <div class="sharecount">Share Now</div>
                    </li>
                    <li>
                        <a href="#" onclick="return false;">
                            <span class="fa fa-telegram"></span>
                        </a>
                        <div class="sharecount">Share Now</div>
                    </li>
                </ul>
            </div>
            
            <!-- Recommended Anime Section -->
            <div id="recommend-anime-series">
                <div class="judul-recommend-anime-series">
                    <h3 class="judul-konten">Rekomendasi Anime Lainnya</h3>
                </div>
                
                <div class="isi-recommend-anime-series">
                    <?php foreach($recommended_anime as $rec_anime): ?>
                    <div class="isi-konten">
                        <div class="gambar-konten">
                            <div class="isi-anime">
                                <a href="<?= site_url('anime-detail.php?slug=' . $rec_anime['slug']) ?>">
                                    <img src="<?= get_anime_poster($rec_anime['poster_url']) ?>" alt="<?= htmlspecialchars($rec_anime['title']) ?>" />
                                </a>
                                <div class="judul-anime">
                                    <a href="<?= site_url('anime-detail.php?slug=' . $rec_anime['slug']) ?>">
                                        <h2><?= htmlspecialchars($rec_anime['title']) ?></h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Comments Section -->
            <button id="show-comments" onclick="showComments()">Nyalakan Komentar</button>
        </div>
    </div>
</div>

<script>
function showComments() {
    alert('Fitur komentar akan diaktifkan!');
}
</script>

<?php require_once 'includes/footer.php'; ?>