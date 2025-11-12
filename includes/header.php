<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME ?></title>
    <meta name="description" content="<?= isset($page_description) ? $page_description : 'Nonton anime subtitle Indonesia terlengkap dan terbaru' ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Video.js CSS -->
    <link href="https://vjs.zencdn.net/8.5.2/video-js.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= asset_url('css/style.css') ?>?v=<?= time() ?>">
</head>
<body class="<?= isset($page_class) ? $page_class : '' ?>">
    <!-- Top Navigation Menu (Menux) -->
    <div class="menux">
        <div class="center">
            <ul class="menux-left">
                <li><a href="#">Cara Download</a></li>
                <li><a href="#">DMCA</a></li>
            </ul>
            <ul class="menux-right">
                <li><a href="#">LAPOR LINK</a></li>
                <li><a href="#">GRUP FB</a></li>
            </ul>
            <div style="clear: both;"></div>
        </div>
    </div>

    <!-- Main Header -->
    <div id="header">
        <div class="center">
            <div class="logo">
                <a href="<?= site_url() ?>">
                    <img src="<?= asset_url('images/otakudesu.png') ?>" alt="<?= SITE_NAME ?>" width="230" height="57">
                </a>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div id="menu">
        <div class="center">
            <div id="cssmenu">
                <ul>
                    <li><a href="<?= site_url() ?>" class="<?= !isset($_GET['page']) ? 'active' : '' ?>">HOME</a></li>
                    <li><a href="<?= site_url('anime-list.php') ?>" class="<?= basename($_SERVER['PHP_SELF']) == 'anime-list.php' ? 'active' : '' ?>">ANIME LIST</a></li>
                    <li><a href="<?= site_url('genres.php') ?>" class="<?= basename($_SERVER['PHP_SELF']) == 'genres.php' ? 'active' : '' ?>">GENRE LIST</a></li>
                    <li><a href="<?= site_url('ongoing.php') ?>" class="<?= basename($_SERVER['PHP_SELF']) == 'ongoing.php' ? 'active' : '' ?>">ON-GOING ANIME</a></li>
                    <li><a href="<?= site_url('complete.php') ?>" class="<?= basename($_SERVER['PHP_SELF']) == 'complete.php' ? 'active' : '' ?>">COMPLETED ANIME</a></li>
                    <li class="search-form">
                        <form action="<?= site_url('search.php') ?>" method="GET">
                            <input type="text" name="q" placeholder="Cari anime..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>