<?php
require_once 'config.php';

// Sample genres data
$genres = [
    ['name' => 'Action', 'count' => 245],
    ['name' => 'Adventure', 'count' => 189],
    ['name' => 'Comedy', 'count' => 156],
    ['name' => 'Demons', 'count' => 87],
    ['name' => 'Drama', 'count' => 198],
    ['name' => 'Ecchi', 'count' => 76],
    ['name' => 'Fantasy', 'count' => 134],
    ['name' => 'Game', 'count' => 92],
    ['name' => 'Harem', 'count' => 67],
    ['name' => 'Historical', 'count' => 43],
    ['name' => 'Horror', 'count' => 54],
    ['name' => 'Josei', 'count' => 29],
    ['name' => 'Magic', 'count' => 89],
    ['name' => 'Martial Arts', 'count' => 78],
    ['name' => 'Mecha', 'count' => 56],
    ['name' => 'Military', 'count' => 34],
    ['name' => 'Music', 'count' => 45],
    ['name' => 'Mystery', 'count' => 67],
    ['name' => 'Psychological', 'count' => 56],
    ['name' => 'Parody', 'count' => 43],
    ['name' => 'Police', 'count' => 34],
    ['name' => 'Romance', 'count' => 167],
    ['name' => 'Samurai', 'count' => 23],
    ['name' => 'School', 'count' => 143],
    ['name' => 'Sci-Fi', 'count' => 89],
    ['name' => 'Seinen', 'count' => 98],
    ['name' => 'Shoujo', 'count' => 67],
    ['name' => 'Shoujo Ai', 'count' => 45],
    ['name' => 'Shounen', 'count' => 234],
    ['name' => 'Slice of Life', 'count' => 112],
    ['name' => 'Sports', 'count' => 45],
    ['name' => 'Space', 'count' => 32],
    ['name' => 'Super Power', 'count' => 78],
    ['name' => 'Supernatural', 'count' => 123],
    ['name' => 'Thriller', 'count' => 67],
    ['name' => 'Vampire', 'count' => 34],
];

$page_title = "Genre List - Otakudesu";
$page_class = "genre-list";
include 'includes/header.php';
?>

<div id="venkonten">
    <div class="vezone">
        <div class="venser">
            <div class="venutama">
                <!-- Title Bar -->
                <div class="rvad">
                    <h1>Genre List</h1>
                </div>
                
                <!-- Genre Section -->
                <div class="genres">
                    <ul>
                        <?php foreach ($genres as $genre): ?>
                            <li>
                                <a href="<?= site_url("genre.php?slug=" . strtolower(str_replace(' ', '-', $genre['name']))) ?>">
                                    <?= htmlspecialchars($genre['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <div style="clear: both;"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>