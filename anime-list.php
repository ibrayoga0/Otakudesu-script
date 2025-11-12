<?php
require_once 'config.php';

// Get selected letter (default to '#')
$selected_letter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : '#';

// Sample anime data organized by letters
$anime_by_letter = [
    '#' => [
        ['title' => '#Compass 2.0: Sentou Setsuri Kaiseki System'],
    ],
    '1' => [
        ['title' => '100-man no Inochi no Ue ni Ore wa Tatteiru'],
        ['title' => '100-man no Inochi no Ue ni Ore wa Tatteiru Season 2'],
        ['title' => '11eyes'],
        ['title' => '12-sai.: Chicchana Mune no Tokimeki'],
        ['title' => '16bit Sensation: Another Layer'],
    ],
    '2' => [
        ['title' => '2.43: Seiin Koukou Danshi Volley-bu'],
        ['title' => '2.5-jigen no Ririsa'],
        ['title' => '22/7'],
    ],
    '3' => [
        ['title' => '3-gatsu no Lion'],
        ['title' => '3-gatsu no Lion Season 2'],
        ['title' => '3D Kanojo: Real Girl'],
        ['title' => '3D Kanojo: Real Girl Season 2'],
    ],
    '4' => [
        ['title' => '4-nin wa Sorezore Uso wo Tsuku'],
    ],
    '8' => [
        ['title' => '86'],
        ['title' => '86 Season 2'],
    ],
    '9' => [
        ['title' => '91 Days'],
    ],
    'A' => [
        ['title' => 'A-Channel'],
        ['title' => 'A-Rank Party wo Ridatsu shita Ore wa'],
        ['title' => 'AICO Incarnation'],
        ['title' => 'Absolute Duo'],
        ['title' => 'ACCA: 13-ku Kansatsu-ka'],
        ['title' => 'Accel World'],
        ['title' => 'Acchi Kocchi'],
        ['title' => 'Acro Trip'],
    ]
];

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
                                            <a href="<?= site_url('anime-detail.php?id=1') ?>">
                                                <?= htmlspecialchars($anime['title']) ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Second Column -->
                                    <?php foreach ($second_half as $anime): ?>
                                        <div class="jdlbar">
                                            <a href="<?= site_url('anime-detail.php?id=1') ?>">
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