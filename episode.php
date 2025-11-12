<?php
require_once 'config.php';
require_once 'includes/database.php';

// Set page class for specific styling
$page_class = 'streaming-episode-page';

require_once 'includes/header.php';

// Sample episode data - in real app this would come from database
$episode_id = $_GET['id'] ?? 1;
$episode_data = [
    'id' => $episode_id,
    'anime_title' => 'One Punch Man Season 3',
    'episode_number' => 1,
    'episode_title' => 'Sosai Saitama no Inchiki Ryokushi',
    'release_date' => '2023-10-03 22:18',
    'posted_by' => 'admin',
    'video_embed' => 'https://example.com/embed/episode1',
    'prev_episode' => null,
    'next_episode' => 2,
    'all_episodes' => [
        1 => 'Episode 1 - Sosai Saitama no Inchiki Ryokushi',
        2 => 'Episode 2 - Next Episode',
        3 => 'Episode 3 - Another Episode',
        4 => 'Episode 4 - Final Episode'
    ],
    'download_links' => [
        'MP4' => [
            '360p' => [
                'Pdrain' => '#', 'Acefile' => '#', 'GoFile' => '#', 'Mega' => '#'
            ],
            '480p' => [
                'Pdrain' => '#', 'Acefile' => '#', 'GoFile' => '#', 'Mega' => '#'
            ],
            '720p' => [
                'Pdrain' => '#', 'Acefile' => '#', 'GoFile' => '#', 'Mega' => '#'
            ]
        ],
        'MKV' => [
            '480p' => [
                'Pdrain' => '#', 'Acefile' => '#', 'GoFile' => '#', 'Mega' => '#'
            ],
            '720p' => [
                'Pdrain' => '#', 'Acefile' => '#', 'GoFile' => '#', 'Mega' => '#'
            ]
        ]
    ],
    'anime_info' => [
        'credit' => 'Doronime',
        'encoder' => 'OtakuDesu Team',
        'genres' => 'Action, Comedy, Superhero, Supernatural',
        'duration' => '24 min per ep',
        'type' => 'TV Series'
    ]
];
?>

<div class="center">
    <div id="venkonten" class="vezone">
        <div class="venser">
            <div class="venutama">
                <!-- Episode Title -->
                <div class="posttl">
                    <h1><?= htmlspecialchars($episode_data['anime_title']) ?> Episode <?= $episode_data['episode_number'] ?> Subtitle Indonesia</h1>
                </div>
                
                <!-- Posted by and Release info -->
                <div class="kategoz">
                    <span><i class="fa fa-user"></i> Posted by <?= htmlspecialchars($episode_data['posted_by']) ?></span>
                    <span><i class="fa fa-clock-o"></i> Release on <?= date('g:i A', strtotime($episode_data['release_date'])) ?></span>
                </div>
                
                <!-- Episode Navigation -->
                <div class="prevnext">
                    <div class="fleft">
                        <select id="selectcog" onchange="changeEpisode(this.value)">
                            <option value="">Pilih Episode Lainnya</option>
                            <?php foreach($episode_data['all_episodes'] as $ep_id => $ep_title): ?>
                            <option value="<?= $ep_id ?>" <?= $ep_id == $episode_data['episode_number'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($ep_title) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="flir">
                        <a href="<?= site_url('anime-detail.php?slug=one-punch-man-season-3') ?>">See All Episodes</a>
                        <?php if($episode_data['next_episode']): ?>
                        <a href="<?= site_url('episode.php?id=' . $episode_data['next_episode']) ?>">Next Eps</a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Video Player -->
                <div id="lightsVideo">
                    <div id="embed_holder">
                        <div class="player-embed">
                            <div class="responsive-embed-stream">
                                <iframe src="<?= $episode_data['video_embed'] ?>" 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" 
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Cinema Mode Switch -->
                <div id="switch">
                    <a href="#" class="lightSwitcher" onclick="toggleCinema()">
                        <label>CINEMA OFF</label>
                    </a>
                </div>
                
                <!-- Mirror Stream Options -->
                <div class="mirrorstream">
                    <div class="m360p">
                        <span><i class="dashicons dashicons-desktop"></i> Mirror 360p</span>
                        <ul style="display: none;">
                            <li><a href="#">Mirror 1</a></li>
                            <li><a href="#">Mirror 2</a></li>
                        </ul>
                    </div>
                    <div class="m480p">
                        <span><i class="dashicons dashicons-desktop"></i> Mirror 480p</span>
                        <ul style="display: none;">
                            <li><a href="#">Mirror 1</a></li>
                            <li><a href="#">Mirror 2</a></li>
                        </ul>
                    </div>
                    <div class="m720p">
                        <span><i class="dashicons dashicons-desktop"></i> Mirror 720p</span>
                        <ul style="display: none;">
                            <li><a href="#">Mirror 1</a></li>
                            <li><a href="#">Mirror 2</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Mirror Info -->
                <div class="tambahan">
                    <p>Jika Mirror Streaming dan Link Download Error, silahkan gunakan Mirror dan Link alternative lainnya.</p>
                </div>
            </div>
            
            <!-- Download Section -->
            <div class="subheading">
                <h2>Link Download <?= htmlspecialchars($episode_data['anime_title']) ?> Episode <?= $episode_data['episode_number'] ?> Sub Indo Lengkap</h2>
            </div>
            
            <div class="download">
                <h4><?= htmlspecialchars($episode_data['anime_title']) ?> Episode <?= $episode_data['episode_number'] ?> Subtitle Indonesia – [<?= $episode_data['anime_info']['credit'] ?>]</h4>
                
                <!-- MP4 Downloads -->
                <?php foreach($episode_data['download_links']['MP4'] as $quality => $links): ?>
                <ul>
                    <li>
                        <strong>MP4 <?= $quality ?></strong>
                        <?php foreach($links as $host => $link): ?>
                        <a href="<?= $link ?>" target="_blank"><?= $host ?></a> |
                        <?php endforeach; ?>
                        <i>[<?= rand(80, 250) ?> MB]</i>
                    </li>
                </ul>
                <?php endforeach; ?>
                
                <!-- MKV Downloads -->
                <?php foreach($episode_data['download_links']['MKV'] as $quality => $links): ?>
                <ul>
                    <li>
                        <strong>MKV <?= $quality ?></strong>
                        <?php foreach($links as $host => $link): ?>
                        <a href="<?= $link ?>" target="_blank"><?= $host ?></a> |
                        <?php endforeach; ?>
                        <i>[<?= rand(150, 400) ?> MB]</i>
                    </li>
                </ul>
                <?php endforeach; ?>
            </div>
            
            <!-- Episode Info -->
            <div class="infozw">
                <h3>Info Sosai Saitama no Inchiki Ryokushi Episode 1 Subtitle Indonesia</h3>
            </div>
            
            <div class="cukder">
                <img src="<?= asset_url('images/no-image.jpg') ?>" alt="<?= htmlspecialchars($episode_data['anime_title']) ?>" />
                
                <div class="infozingle">
                    <p><strong>Credit:</strong> <?= htmlspecialchars($episode_data['anime_info']['credit']) ?></p>
                    <p><strong>Encoder:</strong> <?= htmlspecialchars($episode_data['anime_info']['encoder']) ?></p>
                    <p><strong>Genres:</strong> <?= htmlspecialchars($episode_data['anime_info']['genres']) ?></p>
                    <p><strong>Duration:</strong> <?= htmlspecialchars($episode_data['anime_info']['duration']) ?></p>
                    <p><strong>Type:</strong> <?= htmlspecialchars($episode_data['anime_info']['type']) ?></p>
                </div>
                
                <!-- Episode List Scrollable -->
                <div class="keyingpost">
                    <?php foreach($episode_data['all_episodes'] as $ep_id => $ep_title): ?>
                    <li class="<?= $ep_id % 2 == 0 ? 'alternate' : '' ?>">
                        <a href="<?= site_url('episode.php?id=' . $ep_id) ?>">
                            <?= htmlspecialchars($ep_title) ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Share Section -->
            <div class="subheading">
                <h2>Jangan lupa share <?= htmlspecialchars($episode_data['anime_title']) ?> Episode <?= $episode_data['episode_number'] ?> Subtitle Indonesia ke temanmu ya.</h2>
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
            
            <!-- Comments Section -->
            <button id="show-comments" onclick="showComments()">Nyalakan Komentar</button>
        </div>
    </div>
</div>

<script>
function changeEpisode(episodeId) {
    if(episodeId) {
        window.location.href = '<?= site_url('episode.php?id=') ?>' + episodeId;
    }
}

function toggleCinema() {
    var label = document.querySelector('.lightSwitcher label');
    if(label.textContent === 'CINEMA OFF') {
        label.textContent = 'CINEMA ON';
        document.body.classList.add('cinema-mode');
    } else {
        label.textContent = 'CINEMA OFF';
        document.body.classList.remove('cinema-mode');
    }
}

function showComments() {
    alert('Fitur komentar akan diaktifkan!');
}

// Mirror stream toggle
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.mirrorstream span').forEach(function(span) {
        span.addEventListener('click', function() {
            var ul = this.nextElementSibling;
            ul.style.display = ul.style.display === 'none' ? 'block' : 'none';
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>