<?php
require_once 'config.php';
check_admin_login();

$page_title = 'Dashboard';

// Sample statistics data
$stats = [
    'total_anime' => 1250,
    'total_episodes' => 15680,
    'total_genres' => 24,
    'monthly_views' => 89420
];

// Recent activities (sample data)
$recent_activities = [
    ['action' => 'Added new anime', 'title' => 'One Piece Episode 1089', 'time' => '5 mins ago'],
    ['action' => 'Updated anime', 'title' => 'Naruto: Shippuden', 'time' => '12 mins ago'],
    ['action' => 'Added episode', 'title' => 'Attack on Titan Final Season', 'time' => '1 hour ago'],
    ['action' => 'Updated genre', 'title' => 'Action category', 'time' => '2 hours ago'],
    ['action' => 'Added new anime', 'title' => 'Demon Slayer Season 4', 'time' => '3 hours ago']
];

// Popular anime this month (sample data)
$popular_anime = [
    ['title' => 'One Piece', 'views' => 12450, 'episodes' => 1089],
    ['title' => 'Naruto: Shippuden', 'views' => 9830, 'episodes' => 720],
    ['title' => 'Attack on Titan', 'views' => 8920, 'episodes' => 87],
    ['title' => 'Demon Slayer', 'views' => 7650, 'episodes' => 44],
    ['title' => 'My Hero Academia', 'views' => 6840, 'episodes' => 158]
];

include 'includes/header.php';
?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($stats['total_anime']) ?></h3>
                <p>Total Anime</p>
            </div>
            <div class="icon">
                <i class="fas fa-film"></i>
            </div>
            <a href="<?= admin_url('anime.php') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= number_format($stats['total_episodes']) ?></h3>
                <p>Total Episodes</p>
            </div>
            <div class="icon">
                <i class="fas fa-video"></i>
            </div>
            <a href="<?= admin_url('episodes.php') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $stats['total_genres'] ?></h3>
                <p>Total Genres</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="<?= admin_url('genres.php') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= number_format($stats['monthly_views']) ?></h3>
                <p>Monthly Views</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="<?= admin_url('analytics.php') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i>
                    Recent Activities
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="timeline timeline-inverse">
                    <?php foreach ($recent_activities as $index => $activity): ?>
                        <div class="time-label">
                            <span class="bg-<?= $index == 0 ? 'success' : 'info' ?>">
                                <?= $activity['time'] ?>
                            </span>
                        </div>
                        <div>
                            <i class="fas fa-<?= $index % 2 == 0 ? 'plus' : 'edit' ?> bg-<?= $index % 2 == 0 ? 'primary' : 'warning' ?>"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><?= $activity['action'] ?></h3>
                                <div class="timeline-body">
                                    <?= $activity['title'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.Left col -->
    
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">
        <!-- Popular Anime -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-fire mr-1"></i>
                    Popular Anime This Month
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php foreach ($popular_anime as $anime): ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?= asset_url('images/sample-anime.jpg') ?>" alt="<?= $anime['title'] ?>" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title">
                                    <?= $anime['title'] ?>
                                    <span class="badge badge-info float-right"><?= $anime['episodes'] ?> eps</span>
                                </a>
                                <span class="product-description">
                                    <?= number_format($anime['views']) ?> views this month
                                </span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="<?= admin_url('analytics.php') ?>" class="uppercase">View All Analytics</a>
            </div>
        </div>
        <!-- /.card -->

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-rocket mr-1"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a href="<?= admin_url('anime.php?action=add') ?>" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Add Anime
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= admin_url('episodes.php?action=add') ?>" class="btn btn-success btn-block">
                            <i class="fas fa-video"></i> Add Episode
                        </a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <a href="<?= admin_url('genres.php') ?>" class="btn btn-warning btn-block">
                            <i class="fas fa-tags"></i> Manage Genres
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= admin_url('settings.php') ?>" class="btn btn-info btn-block">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->

<?php include 'includes/footer.php'; ?>