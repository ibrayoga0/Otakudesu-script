<?php
require_once 'config.php';
require_once 'includes/database.php';
require_once 'includes/header.php';

// Sample complete anime data - in real app this would come from database
$current_page = $_GET['page'] ?? 1;
$items_per_page = 25;
$total_anime = 150; // Sample total
$total_pages = ceil($total_anime / $items_per_page);

$complete_anime = [];
for ($i = 1; $i <= $items_per_page; $i++) {
    $complete_anime[] = [
        'id' => $i + (($current_page - 1) * $items_per_page),
        'title' => 'Sample Complete Anime ' . ($i + (($current_page - 1) * $items_per_page)),
        'japanese_title' => 'サンプルアニメ ' . ($i + (($current_page - 1) * $items_per_page)),
        'image_url' => asset_url('images/no-image.jpg'),
        'total_episodes' => rand(12, 26),
        'date' => date('j M'),
        'rating' => number_format(rand(60, 100) / 10, 1),
        'slug' => 'sample-complete-anime-' . ($i + (($current_page - 1) * $items_per_page))
    ];
}
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
                                        <img src="<?= $anime['image_url'] ?>" 
                                             alt="<?= htmlspecialchars($anime['title']) ?>" 
                                             class="attachment-thumb size-thumb wp-post-image">
                                        
                                        <!-- Episode Badge -->
                                        <div class="epz">
                                            <span class="dashicons dashicons-desktop"></span> <?= $anime['total_episodes'] ?> Episode
                                        </div>
                                        
                                        <!-- Date Badge -->
                                        <div class="newnime"><?= $anime['date'] ?></div>
                                        
                                        <!-- Rating Badge (different from ongoing) -->
                                        <div class="epztipe">
                                            <i class="fa fa-star"></i> <?= $anime['rating'] ?>
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

<?php require_once 'includes/footer.php'; ?>