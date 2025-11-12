<?php
require_once 'config.php';
require_once 'includes/database.php';

// Set page class for specific styling
$page_class = 'anime-detail-page';

require_once 'includes/header.php';

// Sample anime data - in real app this would come from database
$anime_slug = $_GET['slug'] ?? 'sample-anime';
$anime_data = [
    'id' => 1,
    'title' => 'One Punch Man Season 3',
    'japanese_title' => 'ワンパンマン',
    'status' => 'Completed',
    'score' => '8.5',
    'producer' => 'Shogakukan-Shueisha Productions',
    'type' => 'TV',
    'total_episodes' => '12',
    'duration' => '24 min per ep',
    'release_date' => 'Oct 3, 2023 to Dec 26, 2023',
    'studio' => 'Madhouse',
    'genre' => 'Action, Comedy, Superhero, Supernatural',
    'synopsis' => 'The seemingly ordinary and unimpressive Saitama has a rather unique hobby: being a hero. In order to pursue his childhood dream, he trained relentlessly for three years—and lost all of his hair in the process. Now, Saitama is incredibly powerful, so much so that no enemy is able to defeat him in battle. In fact, all it takes to defeat evildoers with just one punch has led to an unexpected problem—he is no longer able to enjoy the thrill of battling and has become quite bored.',
    'image_url' => asset_url('images/no-image.jpg'),
    'episodes_list' => [
        ['id' => 1, 'episode' => 1, 'title' => 'One Punch Man Season 3 Episode 1 Subtitle Indonesia', 'date' => '2023-10-03'],
        ['id' => 2, 'episode' => 2, 'title' => 'One Punch Man Season 3 Episode 2 Subtitle Indonesia', 'date' => '2023-10-10'],
        ['id' => 3, 'episode' => 3, 'title' => 'One Punch Man Season 3 Episode 3 Subtitle Indonesia', 'date' => '2023-10-17'],
        ['id' => 4, 'episode' => 4, 'title' => 'One Punch Man Season 3 Episode 4 Subtitle Indonesia', 'date' => '2023-10-24'],
        ['id' => 5, 'episode' => 5, 'title' => 'One Punch Man Season 3 Episode 5 Subtitle Indonesia', 'date' => '2023-10-31'],
    ]
];
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
                <img src="<?= $anime_data['image_url'] ?>" alt="<?= htmlspecialchars($anime_data['title']) ?>" />
                
                <div class="infozingle">
                    <p><b>Judul:</b> <?= htmlspecialchars($anime_data['title']) ?></p>
                    <p><b>Japanese:</b> <?= htmlspecialchars($anime_data['japanese_title']) ?></p>
                    <p><b>Skor:</b> <?= htmlspecialchars($anime_data['score']) ?></p>
                    <p><b>Produser:</b> <?= htmlspecialchars($anime_data['producer']) ?></p>
                    <p><b>Type:</b> <?= htmlspecialchars($anime_data['type']) ?></p>
                    <p><b>Status:</b> <?= htmlspecialchars($anime_data['status']) ?></p>
                    <p><b>Total Episode:</b> <?= htmlspecialchars($anime_data['total_episodes']) ?></p>
                    <p><b>Durasi:</b> <?= htmlspecialchars($anime_data['duration']) ?></p>
                    <p><b>Tanggal Rilis:</b> <?= htmlspecialchars($anime_data['release_date']) ?></p>
                    <p><b>Studio:</b> <?= htmlspecialchars($anime_data['studio']) ?></p>
                    <p><b>Genre:</b> <?= htmlspecialchars($anime_data['genre']) ?></p>
                </div>
            </div>
            
            <!-- Synopsis -->
            <div class="sinopc">
                <p><?= htmlspecialchars($anime_data['synopsis']) ?></p>
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
                    <?php foreach($anime_data['episodes_list'] as $index => $episode): ?>
                    <li class="<?= $index % 2 == 0 ? '' : 'alternate' ?>">
                        <span class="zeebr">
                            <a href="<?= site_url('episode.php?id=' . $episode['id']) ?>">
                                <?= htmlspecialchars($episode['title']) ?>
                            </a>
                        </span>
                        <span class="rightplace"><?= date('j F, Y', strtotime($episode['date'])) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Keywords/Tags -->
            <div class="keyword">
                Streaming <?= htmlspecialchars($anime_data['title']) ?> Sub Indo, <?= htmlspecialchars($anime_data['title']) ?> resolusi 240p 360p 480p 720p format Mp4 dan Mkv Sub Indo, Download <?= htmlspecialchars($anime_data['title']) ?> Sub Indo, Nonton <?= htmlspecialchars($anime_data['title']) ?>, Download dan Streaming <?= htmlspecialchars($anime_data['title']) ?> Subtitle Indonesia, <?= htmlspecialchars($anime_data['title']) ?> Episode 1 - <?= count($anime_data['episodes_list']) ?> (End) Sub Indo, <?= htmlspecialchars($anime_data['title']) ?> Subtitle Indonesia
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
                    <?php for($i = 1; $i <= 5; $i++): ?>
                    <div class="isi-konten">
                        <div class="gambar-konten">
                            <div class="isi-anime">
                                <a href="<?= site_url('anime-detail.php?slug=recommend-anime-' . $i) ?>">
                                    <img src="<?= asset_url('images/no-image.jpg') ?>" alt="Recommend Anime <?= $i ?>" />
                                </a>
                                <div class="judul-anime">
                                    <a href="<?= site_url('anime-detail.php?slug=recommend-anime-' . $i) ?>">
                                        <h2>Recommend Anime <?= $i ?></h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
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