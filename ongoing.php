<?php
require_once 'config.php';
require_once 'includes/database.php';
require_once 'includes/header.php';

// Sample ongoing anime data - in real app this would come from database
$current_page = $_GET['page'] ?? 1;
$items_per_page = 25;
$total_anime = 125; // Sample total
$total_pages = ceil($total_anime / $items_per_page);

$ongoing_anime = [];
for ($i = 1; $i <= $items_per_page; $i++) {
    $ongoing_anime[] = [
        'id' => $i + (($current_page - 1) * $items_per_page),
        'title' => 'Sample Ongoing Anime ' . ($i + (($current_page - 1) * $items_per_page)),
        'japanese_title' => 'サンプルアニメ ' . ($i + (($current_page - 1) * $items_per_page)),
        'image_url' => asset_url('images/no-image.jpg'),
        'episode' => rand(1, 24),
        'date' => date('j M'),
        'days_ago' => rand(1, 7) . ' hari',
        'rating' => number_format(rand(50, 100) / 10, 1),
        'slug' => 'sample-ongoing-anime-' . ($i + (($current_page - 1) * $items_per_page))
    ];
}
?>

<div class="center">
    <div id="venkonten" class="vezone">
        <div class="venser">
            <!-- Page Title -->
            <div id="rvod" class="rvad">
                <h1>List & Jadwal Anime Ongoing</h1>
                <div class="iconf">
                    <a href="<?= site_url('index.php') ?>">ANIME TERBARU</a>
                </div>
            </div>
            
            <!-- Anime Cards Grid -->
            <div class="rseries">
                <div class="rapi">
                    <div class="venz">
                        <ul>
                            <?php foreach($ongoing_anime as $anime): ?>
                            <li>
                                <div class="thumb">
                                    <a href="<?= site_url('anime-detail.php?slug=' . $anime['slug']) ?>">
                                        <img src="<?= $anime['image_url'] ?>" 
                                             alt="<?= htmlspecialchars($anime['title']) ?>" 
                                             class="attachment-thumb size-thumb wp-post-image">
                                        
                                        <!-- Episode Badge -->
                                        <div class="epz">
                                            <span class="dashicons dashicons-desktop"></span> Episode <?= $anime['episode'] ?>
                                        </div>
                                        
                                        <!-- Date Badge -->
                                        <div class="newnime"><?= $anime['date'] ?></div>
                                        
                                        <!-- Days Badge -->
                                        <div class="epztipe">
                                            <i class="fa fa-star"></i> <?= $anime['days_ago'] ?>
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
                    <a href="<?= site_url('ongoing.php?page=' . ($current_page - 1)) ?>">« Previous</a>
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
                    <a href="<?= site_url('ongoing.php?page=' . $page) ?>"><?= $page ?></a>
                    <?php 
                        endif;
                    endfor; 
                    ?>
                    
                    <?php if($current_page < $total_pages): ?>
                    <a href="<?= site_url('ongoing.php?page=' . ($current_page + 1)) ?>">Next »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>