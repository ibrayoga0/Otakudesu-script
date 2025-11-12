<?php
ob_start();
require_once 'config.php';
require_once 'includes/database.php';

$page_title = 'Otaku Desu - Nonton Anime Subtitle Indonesia';
$page_description = 'Nonton anime subtitle Indonesia terlengkap dan terbaru. Streaming anime online gratis dengan kualitas HD.';

// Get anime data
$ongoing_anime = $db->getOngoingAnime(15);
$completed_anime = $db->getCompletedAnime(15);
$random_anime = $db->getRandomAnime(5);

include 'includes/header.php';
?>

<!-- Main Content -->
<div id="venkonten">
    <div class="vezone">
        <!-- Main Content Area -->
        <div class="venser">
            <div class="venutama">
                <!-- Info Update Bar -->
                <div class="infoupdate">
                    Selamat datang di <?= SITE_NAME ?>! Nonton anime subtitle Indonesia terlengkap dan terbaru.
                </div>

                <!-- On-going Anime Section -->
                <div id="rvod" class="rvad">
                    <h1>On-going Anime</h1>
                    <div class="iconf">
                        <a href="<?= site_url('ongoing.php') ?>">CEK ANIME TERBARU LAINNYA</a>
                    </div>
                </div>

                <div class="rseries">
                    <div class="rapi">
                        <div class="venz">
                            <ul>
                                <?php if (empty($ongoing_anime)): ?>
                                    <!-- Sample Data for Demo -->
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                    <li>
                                        <div class="thumb">
                                            <a href="<?= site_url('anime-detail.php?slug=sample-anime-' . $i) ?>">
                                                <img src="http://otakudesu.test/assets/images/no-image.jpg" 
                                                     alt="Sample Anime <?= $i ?>" 
                                                     class="attachment-thumb size-thumb wp-post-image">
                                                
                                                <!-- Episode Badge -->
                                                <div class="epz">
                                                    <span class="dashicons dashicons-desktop"></span> Episode <?= $i ?>
                                                </div>
                                                
                                                <!-- Date Badge -->
                                                <div class="newnime"><?= date('j M') ?></div>
                                                
                                                <!-- Days Badge -->
                                                <div class="epztipe">
                                                    <i class="fa fa-star"></i> <?= $i ?> hari
                                                </div>
                                                
                                                <!-- Anime Title -->
                                                <h2 class="jdlflm">Sample Anime Title <?= $i ?> Subtitle Indonesia</h2>
                                            </a>
                                        </div>
                                    </li>
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <?php foreach ($ongoing_anime as $anime): ?>
                                        <?php 
                                        $episode_count = $anime['episode_count'] ?? 0;
                                        $latest_episode = $episode_count > 0 ? "Episode $episode_count" : "Coming Soon";
                                        $release_date = date('d M', strtotime($anime['updated_at']));
                                        $days_ago = floor((time() - strtotime($anime['updated_at'])) / (60 * 60 * 24));
                                        ?>
                                        <li>
                                            <div class="thumb">
                                                <a href="<?= page_url('anime/' . $anime['slug']) ?>">
                                                <img src="http://otakudesu.test/assets/images/no-image.jpg" 
                                                     alt="<?= htmlspecialchars($anime['title']) ?>" 
                                                     class="attachment-thumb size-thumb wp-post-image">                                                    <!-- Episode Badge -->
                                                    <div class="epz">
                                                        <span class="dashicons dashicons-desktop"></span> <?= $latest_episode ?>
                                                    </div>
                                                    
                                                    <!-- Date Badge -->
                                                    <div class="newnime"><?= $release_date ?></div>
                                                    
                                                    <!-- Days Badge -->
                                                    <div class="epztipe">
                                                        <i class="fa fa-star"></i> <?= $days_ago ?> hari
                                                    </div>
                                                    
                                                    <!-- Anime Title -->
                                                    <h2 class="jdlflm"><?= htmlspecialchars($anime['title']) ?></h2>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Complete Anime Section -->
                <div class="complete-anime-section">
                    <div id="rvod" class="rvad">
                        <h1>Complete Anime</h1>
                        <div class="iconf">
                            <a href="<?= site_url('complete.php') ?>">CEK ANIME SELESAI LAINNYA</a>
                        </div>
                    </div>

                    <div class="rseries">
                        <div class="rapi">
                            <div class="venz">
                                <ul>
                                    <?php if (empty($completed_anime)): ?>
                                        <!-- Sample Data for Demo -->
                                        <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <li>
                                            <div class="thumb">
                                                <a href="<?= site_url('anime-detail.php?slug=completed-anime-' . $i) ?>">
                                                    <img src="http://otakudesu.test/assets/images/no-image.jpg" 
                                                         alt="Complete Anime <?= $i ?>" 
                                                         class="attachment-thumb size-thumb wp-post-image">
                                                    
                                                    <!-- Episode Badge -->
                                                    <div class="epz">
                                                        <span class="dashicons dashicons-desktop"></span> <?= rand(12, 24) ?> Episode
                                                    </div>
                                                    
                                                    <!-- Date Badge -->
                                                    <div class="newnime"><?= date('j M', strtotime('-' . $i . ' days')) ?></div>
                                                    
                                                    <!-- Rating Badge -->
                                                    <div class="epztipe">
                                                        <i class="fa fa-star"></i> <?= number_format(rand(500, 999) / 100, 2) ?>
                                                    </div>
                                                    
                                                    <!-- Anime Title -->
                                                    <h2 class="jdlflm">Complete Anime Title <?= $i ?> Subtitle Indonesia</h2>
                                                </a>
                                            </div>
                                        </li>
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        <?php foreach ($completed_anime as $anime): ?>
                                            <?php 
                                            $episode_count = $anime['episode_count'] ?? 0;
                                            $total_episodes = $episode_count > 0 ? "Episode $episode_count" : "Unknown";
                                            $release_date = date('d M', strtotime($anime['updated_at']));
                                            $rating = number_format($anime['rating'], 2);
                                            ?>
                                            <li>
                                                <div class="thumb">
                                                    <a href="<?= page_url('anime/' . $anime['slug']) ?>">
                                                        <img src="http://otakudesu.test/assets/images/no-image.jpg" 
                                                             alt="<?= htmlspecialchars($anime['title']) ?>" 
                                                             class="attachment-thumb size-thumb wp-post-image">
                                                        
                                                        <!-- Episode Badge -->
                                                        <div class="epz">
                                                            <span class="dashicons dashicons-desktop"></span> <?= $total_episodes ?>
                                                        </div>
                                                        
                                                        <!-- Date Badge -->
                                                        <div class="newnime"><?= $release_date ?></div>
                                                        
                                                        <!-- Rating Badge -->
                                                        <div class="epztipe">
                                                            <i class="fa fa-star"></i> <?= $rating ?>
                                                        </div>
                                                        
                                                        <!-- Anime Title -->
                                                        <h2 class="jdlflm"><?= htmlspecialchars($anime['title']) ?></h2>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>