<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

// Set page class for specific styling
$page_class = 'streaming-episode-page';

// Get episode parameters
$anime_id = $_GET['anime_id'] ?? null;
$episode_number = $_GET['episode'] ?? null;

if (!$anime_id || !$episode_number) {
    header('Location: ' . site_url());
    exit;
}

// Get episode data from database
$episode_data = $db->getEpisode($anime_id, $episode_number);

if (!$episode_data) {
    header('Location: ' . site_url());
    exit;
}

// Get anime info and all episodes
$all_episodes = $db->getAnimeEpisodes($anime_id);
$anime_genres = $db->getAnimeGenres($anime_id);
$genre_names = array_column($anime_genres, 'name');

// Find previous and next episodes
$prev_episode = null;
$next_episode = null;
foreach ($all_episodes as $index => $ep) {
    if ($ep['episode_number'] == $episode_number) {
        if (isset($all_episodes[$index - 1])) {
            $prev_episode = $all_episodes[$index - 1];
        }
        if (isset($all_episodes[$index + 1])) {
            $next_episode = $all_episodes[$index + 1];
        }
        break;
    }
}

// Set page meta info
$page_title = htmlspecialchars($episode_data['anime_title']) . ' Episode ' . $episode_number . ' - Otaku Desu';
$page_description = 'Nonton ' . htmlspecialchars($episode_data['anime_title']) . ' Episode ' . $episode_number . ' subtitle Indonesia online gratis.';

require_once 'includes/header.php';
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
                    <span><i class="fa fa-user"></i> Posted by admin</span>
                    <span><i class="fa fa-clock-o"></i> Release on <?= date('g:i A', strtotime($episode_data['created_at'])) ?></span>
                </div>
                
                <!-- Episode Navigation -->
                <div class="prevnext">
                    <div class="fleft">
                        <select id="selectcog" onchange="changeEpisode(this.value)">
                            <option value="">Pilih Episode Lainnya</option>
                            <?php foreach($all_episodes as $episode): ?>
                            <option value="<?= $episode['episode_number'] ?>" <?= $episode['episode_number'] == $episode_data['episode_number'] ? 'selected' : '' ?>>
                                Episode <?= $episode['episode_number'] ?><?= !empty($episode['title']) ? ' - ' . htmlspecialchars($episode['title']) : '' ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="flir">
                        <a href="<?= site_url('anime-detail.php?slug=' . $episode_data['anime_slug']) ?>">See All Episodes</a>
                        <?php if($next_episode): ?>
                        <a href="<?= site_url('episode.php?anime_id=' . $anime_id . '&episode=' . $next_episode['episode_number']) ?>">Next Eps</a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Video Player -->
                <div id="lightsVideo">
                    <div id="embed_holder">
                        <div class="player-embed">
                            <div class="responsive-embed-stream">
                                <?php if (!empty($episode_data['video_url'])): ?>
                                <iframe src="<?= htmlspecialchars($episode_data['video_url']) ?>" 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" 
                                        allowfullscreen>
                                </iframe>
                                <?php else: ?>
                                <div style="background: #000; color: white; text-align: center; padding: 100px; font-size: 18px;">
                                    Video belum tersedia<br>
                                    <small style="font-size: 14px; opacity: 0.7;">Episode akan segera diupload</small>
                                </div>
                                <?php endif; ?>
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
                <h4><?= htmlspecialchars($episode_data['anime_title']) ?> Episode <?= $episode_data['episode_number'] ?> Subtitle Indonesia – [Doronime]</h4>
                
                <!-- Sample Download Links -->
                <ul>
                    <li>
                        <strong>MP4 360p</strong>
                        <a href="#" target="_blank">Pdrain</a> |
                        <a href="#" target="_blank">Acefile</a> |
                        <a href="#" target="_blank">GoFile</a> |
                        <a href="#" target="_blank">Mega</a>
                        <i>[80 MB]</i>
                    </li>
                </ul>
                <ul>
                    <li>
                        <strong>MP4 480p</strong>
                        <a href="#" target="_blank">Pdrain</a> |
                        <a href="#" target="_blank">Acefile</a> |
                        <a href="#" target="_blank">GoFile</a> |
                        <a href="#" target="_blank">Mega</a>
                        <i>[120 MB]</i>
                    </li>
                </ul>
                <ul>
                    <li>
                        <strong>MP4 720p</strong>
                        <a href="#" target="_blank">Pdrain</a> |
                        <a href="#" target="_blank">Acefile</a> |
                        <a href="#" target="_blank">GoFile</a> |
                        <a href="#" target="_blank">Mega</a>
                        <i>[200 MB]</i>
                    </li>
                </ul>
                <ul>
                    <li>
                        <strong>MKV 480p</strong>
                        <a href="#" target="_blank">Pdrain</a> |
                        <a href="#" target="_blank">Acefile</a> |
                        <a href="#" target="_blank">GoFile</a> |
                        <a href="#" target="_blank">Mega</a>
                        <i>[150 MB]</i>
                    </li>
                </ul>
                <ul>
                    <li>
                        <strong>MKV 720p</strong>
                        <a href="#" target="_blank">Pdrain</a> |
                        <a href="#" target="_blank">Acefile</a> |
                        <a href="#" target="_blank">GoFile</a> |
                        <a href="#" target="_blank">Mega</a>
                        <i>[300 MB]</i>
                    </li>
                </ul>
            </div>
            
            <!-- Episode Info -->
            <div class="infozw">
                <h3>Info <?= htmlspecialchars($episode_data['anime_title']) ?> Episode <?= $episode_data['episode_number'] ?> Subtitle Indonesia</h3>
            </div>
            
            <div class="cukder">
                <img src="<?= get_anime_poster('') ?>" alt="<?= htmlspecialchars($episode_data['anime_title']) ?>" />
                
                <div class="infozingle">
                    <p><strong>Credit:</strong> Doronime</p>
                    <p><strong>Encoder:</strong> OtakuDesu Team</p>
                    <p><strong>Genres:</strong> <?= implode(', ', $genre_names) ?></p>
                    <p><strong>Duration:</strong> <?= htmlspecialchars($episode_data['duration'] ?? '24 min') ?></p>
                    <p><strong>Type:</strong> TV Series</p>
                </div>
                
                <!-- Episode List Scrollable -->
                <div class="keyingpost">
                    <?php foreach($all_episodes as $index => $episode): ?>
                    <li class="<?= $index % 2 == 0 ? '' : 'alternate' ?>">
                        <a href="<?= site_url('episode.php?anime_id=' . $anime_id . '&episode=' . $episode['episode_number']) ?>">
                            Episode <?= $episode['episode_number'] ?><?= !empty($episode['title']) ? ' - ' . htmlspecialchars($episode['title']) : '' ?>
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
function changeEpisode(episodeNumber) {
    if(episodeNumber) {
        window.location.href = '<?= site_url('episode.php?anime_id=' . $anime_id . '&episode=') ?>' + episodeNumber;
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