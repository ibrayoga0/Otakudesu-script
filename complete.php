<?php
require_once 'includes/config.php';

$page_title = "Complete Anime - Otakudesu";
$page_class = "complete-list";

// Get real completed anime data from database
$current_page = $_GET['page'] ?? 1;
$items_per_page = 25;
$complete_anime = $db->getCompletedAnime($items_per_page, ($current_page - 1) * $items_per_page);

// Calculate total pages (for now use a sample count)
$total_anime = 150; // In real implementation, you'd query the actual count
$total_pages = ceil($total_anime / $items_per_page);

include 'includes/header.php';
?>

<div class="center">
    <div id="venkonten" class="vezone">
        <div class="venser">
            <!-- Page Title -->
            <div id="rvod" class="rvad">
                <h1>Complete Anime List</h1>
                <div class="iconf">
                    <a href="<?= site_url('index.php') ?>">ANIME TERBARU</a>
                </div>
            </div>
            
            <!-- Anime Cards Grid -->
            <div class="rseries">
                <div class="rapi">
                    <div class="venz">
                        <ul>
                            <?php foreach($complete_anime as $anime): ?>
                            <li>
                                <div class="thumb">
                                    <a href="<?= site_url('anime-detail.php?slug=' . $anime['slug']) ?>">
                                        <img src="<?= get_anime_poster($anime['poster_url']) ?>" 
                                             alt="<?= htmlspecialchars($anime['title']) ?>" 
                                             class="attachment-thumb size-thumb wp-post-image">
                                        
                                        <!-- Episode Badge -->
                                        <div class="epz">
                                            <span class="dashicons dashicons-desktop"></span> 
                                            <?php
                                            $episode_count = $anime['episode_count'] ?? 'Unknown';
                                            echo $episode_count > 0 ? "Episode $episode_count" : "Unknown";
                                            ?>
                                        </div>
                                        
                                        <!-- Date Badge -->
                                        <div class="newnime"><?= date('j M') ?></div>
                                        
                                        <!-- Rating Badge -->
                                        <div class="epztipe">
                                            <i class="fa fa-star"></i> <?= number_format($anime['rating'], 2) ?>
                                        </div>
                                        
                                        <!-- Anime Title -->
                                        <h2 class="jdlflm"><?= htmlspecialchars($anime['title']) ?></h2>
                                    </a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <!-- Clear floats -->
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <div class="pagenavix">
                    <?php if($current_page > 1): ?>
                    <a href="<?= site_url('complete.php?page=' . ($current_page - 1)) ?>">« Previous</a>
                    <?php endif; ?>
                    
                    <?php
                    // Show pagination numbers
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);
                    
                    for($page = $start_page; $page <= $end_page; $page++):
                        if($page == $current_page):
                    ?>
                    <span><?= $page ?></span>
                    <?php else: ?>
                    <a href="<?= site_url('complete.php?page=' . $page) ?>"><?= $page ?></a>
                    <?php 
                        endif;
                    endfor; 
                    ?>
                    
                    <?php if($current_page < $total_pages): ?>
                    <a href="<?= site_url('complete.php?page=' . ($current_page + 1)) ?>">Next »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>