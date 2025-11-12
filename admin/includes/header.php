<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>Otakudesu Admin</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style (AdminLTE) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Custom Admin Styles -->
    <link rel="stylesheet" href="<?= admin_asset_url('css/admin.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= asset_url('images/logo.svg') ?>" alt="Otakudesu Logo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= admin_url() ?>" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= site_url() ?>" class="nav-link" target="_blank">View Site</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">3 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> New anime request
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <!-- User Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img src="https://via.placeholder.com/160x160/00adff/ffffff?text=A" class="img-circle elevation-2" alt="User Image" style="width: 25px;">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-item">
                        <div class="media">
                            <img src="https://via.placeholder.com/160x160/00adff/ffffff?text=A" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    <?= get_admin_info()['name'] ?>
                                    <span class="float-right text-sm text-success"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm"><?= get_admin_info()['email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= admin_url('logout.php') ?>" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= admin_url() ?>" class="brand-link">
            <img src="<?= asset_url('images/logo.svg') ?>" alt="Otakudesu Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Otakudesu</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="<?= admin_url() ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <!-- Content Management -->
                    <li class="nav-header">CONTENT MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="<?= admin_url('anime.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'anime.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-film"></i>
                            <p>
                                Anime
                                <span class="right badge badge-info">25</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= admin_url('episodes.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'episodes.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-video"></i>
                            <p>
                                Episodes
                                <span class="right badge badge-success">156</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= admin_url('genres.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'genres.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Genres</p>
                        </a>
                    </li>
                    
                    <!-- Statistics -->
                    <li class="nav-header">ANALYTICS</li>
                    <li class="nav-item">
                        <a href="<?= admin_url('analytics.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'analytics.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Analytics</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= admin_url('reports.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : '' ?>">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    
                    <!-- Settings -->
                    <li class="nav-header">SETTINGS</li>
                    <li class="nav-item">
                        <a href="<?= admin_url('settings.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>General Settings</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= admin_url('users.php') ?>" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Admin Users</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"><?php if (isset($page_title)): ?>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $page_title ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= admin_url() ?>">Dashboard</a></li>
                            <?php if (isset($breadcrumb)): ?>
                                <?php foreach ($breadcrumb as $item): ?>
                                    <?php if (isset($item['url'])): ?>
                                        <li class="breadcrumb-item"><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a></li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item active"><?= $item['title'] ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="breadcrumb-item active"><?= $page_title ?></li>
                            <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
    <?php endif; ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">