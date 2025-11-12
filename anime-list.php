<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

// Get selected letter (default to '#')
$selected_letter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : '#';

// Get all anime from database
$all_anime_result = $db->getPdo()->query("SELECT title, slug FROM anime ORDER BY title ASC");
$all_anime = $all_anime_result->fetchAll();

// Organize anime by first letter
$anime_by_letter = [];
foreach ($all_anime as $anime) {
    $first_char = strtoupper(substr($anime['title'], 0, 1));
    
    // Group numbers and special characters as '#'
    if (!ctype_alpha($first_char)) {
        $first_char = '#';
    }
    
    if (!isset($anime_by_letter[$first_char])) {
        $anime_by_letter[$first_char] = [];
    }
    
    $anime_by_letter[$first_char][] = $anime;
}

// Sort the keys
ksort($anime_by_letter);

// Move '#' to the beginning
if (isset($anime_by_letter['#'])) {
    $hash_group = $anime_by_letter['#'];
    unset($anime_by_letter['#']);
    $anime_by_letter = ['#' => $hash_group] + $anime_by_letter;
}

// Get all available letters/numbers for navigation
$all_letters = array_keys($anime_by_letter);

$page_title = "Anime List - Otakudesu";
$page_class = "anime-list";
include 'includes/header.php';
?>

<div id="venkonten">
    <div class="vezone">
        <div class="venser">
            <div class="venutama">
                <!-- Title Bar -->
                <div class="rvad">
                    <h1>Anime List</h1>
                </div>
                
                <!-- Daftar Kartun Section -->
                <div class="daftarkartun">
                    <!-- Alphabet Navigation -->
                    <div class="abjtext">
                        <?php foreach ($all_letters as $letter): ?>
                            <a href="<?= site_url("anime-list.php?letter=$letter") ?>" 
                               class="<?= ($letter === $selected_letter) ? 'active' : '' ?>">
                                <?= $letter ?>
                            </a>
                        <?php endforeach; ?>
                        <div style="clear: both;"></div>
                    </div>
                    
                    <!-- Anime List Content -->
                    <div id="abtext">
                        <?php
                        // Get anime for selected letter
                        $current_anime = isset($anime_by_letter[$selected_letter]) ? $anime_by_letter[$selected_letter] : [];
                        
                        if (!empty($current_anime)):
                            // Split anime into two columns
                            $half = ceil(count($current_anime) / 2);
                            $first_half = array_slice($current_anime, 0, $half);
                            $second_half = array_slice($current_anime, $half);
                        ?>
                            <div class="bariskelom">
                                <div class="barispenz">
                                    <a href="#"><?= $selected_letter ?></a>
                                </div>
                                <div class="penzbar">
                                    <!-- First Column -->
                                    <?php foreach ($first_half as $anime): ?>
                                        <div class="jdlbar">
                                            <a href="<?= site_url('anime-detail.php?slug=' . $anime['slug']) ?>">
                                                <?= htmlspecialchars($anime['title']) ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Second Column -->
                                    <?php foreach ($second_half as $anime): ?>
                                        <div class="jdlbar">
                                            <a href="<?= site_url('anime-detail.php?slug=' . $anime['slug']) ?>">
                                                <?= htmlspecialchars($anime['title']) ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="bariskelom">
                                <div class="barispenz">
                                    <a href="#"><?= $selected_letter ?></a>
                                </div>
                                <div class="penzbar">
                                    <div style="text-align: center; color: #ccc; padding: 20px;">
                                        Belum ada anime dengan awalan "<?= $selected_letter ?>" di database.
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>