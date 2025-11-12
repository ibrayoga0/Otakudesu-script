<?php
require_once 'config.php';
check_admin_login();

$page_title = 'Analytics & Reports';
$breadcrumb = [
    ['title' => 'Analytics & Reports']
];

// Sample analytics data
$analytics_data = [
    'today_views' => 12456,
    'yesterday_views' => 11234,
    'weekly_views' => 87453,
    'monthly_views' => 345678,
    'total_users' => 45678,
    'active_users' => 12345,
    'bounce_rate' => 32.5,
    'avg_session' => '4:23',
    'top_countries' => [
        ['country' => 'Indonesia', 'views' => 45678, 'percentage' => 35.2],
        ['country' => 'Malaysia', 'views' => 23456, 'percentage' => 18.1],
        ['country' => 'Philippines', 'views' => 18234, 'percentage' => 14.0],
        ['country' => 'Thailand', 'views' => 15432, 'percentage' => 11.9],
        ['country' => 'Singapore', 'views' => 12345, 'percentage' => 9.5]
    ],
    'popular_devices' => [
        ['device' => 'Mobile', 'percentage' => 65.4, 'sessions' => 85432],
        ['device' => 'Desktop', 'percentage' => 28.7, 'sessions' => 37654],
        ['device' => 'Tablet', 'percentage' => 5.9, 'sessions' => 7890]
    ],
    'top_anime' => [
        ['title' => 'One Piece', 'views' => 156789, 'growth' => '+12.4%'],
        ['title' => 'Attack on Titan', 'views' => 134567, 'growth' => '+8.7%'],
        ['title' => 'Demon Slayer', 'views' => 123456, 'growth' => '+15.2%'],
        ['title' => 'Jujutsu Kaisen', 'views' => 98765, 'growth' => '+22.1%'],
        ['title' => 'My Hero Academia', 'views' => 87654, 'growth' => '+5.3%']
    ],
    'hourly_traffic' => [
        ['hour' => '00:00', 'views' => 1234],
        ['hour' => '01:00', 'views' => 987],
        ['hour' => '02:00', 'views' => 765],
        ['hour' => '03:00', 'views' => 543],
        ['hour' => '04:00', 'views' => 654],
        ['hour' => '05:00', 'views' => 876],
        ['hour' => '06:00', 'views' => 1098],
        ['hour' => '07:00', 'views' => 1432],
        ['hour' => '08:00', 'views' => 2156],
        ['hour' => '09:00', 'views' => 2789],
        ['hour' => '10:00', 'views' => 3234],
        ['hour' => '11:00', 'views' => 3567],
        ['hour' => '12:00', 'views' => 4123],
        ['hour' => '13:00', 'views' => 4567],
        ['hour' => '14:00', 'views' => 5123],
        ['hour' => '15:00', 'views' => 5678],
        ['hour' => '16:00', 'views' => 6234],
        ['hour' => '17:00', 'views' => 6789],
        ['hour' => '18:00', 'views' => 7456],
        ['hour' => '19:00', 'views' => 8123],
        ['hour' => '20:00', 'views' => 8967],
        ['hour' => '21:00', 'views' => 9234],
        ['hour' => '22:00', 'views' => 7890],
        ['hour' => '23:00', 'views' => 6543]
    ]
];

include 'includes/header.php';
?>

<!-- Date Range Selector -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row align-items-end">
                    <div class="col-md-3">
                        <label>Date Range</label>
                        <select name="range" class="form-control">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last7days" selected>Last 7 Days</option>
                            <option value="last30days">Last 30 Days</option>
                            <option value="last90days">Last 90 Days</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>From</label>
                        <input type="date" name="from" class="form-control" value="<?= date('Y-m-d', strtotime('-7 days')) ?>">
                    </div>
                    <div class="col-md-2">
                        <label>To</label>
                        <input type="date" name="to" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-2">
                        <label>Compare</label>
                        <select name="compare" class="form-control">
                            <option value="none">No Comparison</option>
                            <option value="previous">Previous Period</option>
                            <option value="year">Same Period Last Year</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-chart-line"></i> Update Report
                        </button>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-download"></i> Export
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Key Metrics -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($analytics_data['today_views']) ?></h3>
                <p>Today's Views</p>
                <div class="small">
                    <i class="fas fa-arrow-up text-white"></i>
                    <?= round((($analytics_data['today_views'] - $analytics_data['yesterday_views']) / $analytics_data['yesterday_views']) * 100, 1) ?>% vs yesterday
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-eye"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= number_format($analytics_data['active_users']) ?></h3>
                <p>Active Users</p>
                <div class="small">
                    <i class="fas fa-users text-white"></i>
                    <?= number_format($analytics_data['total_users']) ?> total users
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $analytics_data['bounce_rate'] ?>%</h3>
                <p>Bounce Rate</p>
                <div class="small">
                    <i class="fas fa-clock text-white"></i>
                    <?= $analytics_data['avg_session'] ?> avg session
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= number_format($analytics_data['monthly_views']) ?></h3>
                <p>Monthly Views</p>
                <div class="small">
                    <i class="fas fa-calendar text-white"></i>
                    This month's traffic
                </div>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <!-- Traffic Chart -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Traffic Overview (Last 7 Days)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="trafficChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Device Analytics -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Device Usage</h3>
            </div>
            <div class="card-body">
                <canvas id="deviceChart"></canvas>
                <div class="mt-3">
                    <?php foreach ($analytics_data['popular_devices'] as $device): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?= $device['device'] ?></span>
                            <span class="text-muted"><?= $device['percentage'] ?>%</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Analytics -->
<div class="row mt-4">
    <!-- Top Countries -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top Countries</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Views</th>
                                <th>Percentage</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($analytics_data['top_countries'] as $index => $country): ?>
                                <tr>
                                    <td>
                                        <i class="fas fa-flag mr-2"></i>
                                        <?= $country['country'] ?>
                                    </td>
                                    <td><?= number_format($country['views']) ?></td>
                                    <td>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-primary" style="width: <?= $country['percentage'] ?>%"></div>
                                        </div>
                                        <small><?= $country['percentage'] ?>%</small>
                                    </td>
                                    <td>
                                        <small class="text-success">
                                            <i class="fas fa-arrow-up"></i> 
                                            <?= rand(5, 15) ?>%
                                        </small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Top Anime -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Most Watched Anime</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Anime</th>
                                <th>Views</th>
                                <th>Growth</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($analytics_data['top_anime'] as $index => $anime): ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-<?= $index < 3 ? 'warning' : 'secondary' ?>">
                                            #<?= $index + 1 ?>
                                        </span>
                                    </td>
                                    <td><?= $anime['title'] ?></td>
                                    <td><?= number_format($anime['views']) ?></td>
                                    <td>
                                        <small class="text-success">
                                            <i class="fas fa-arrow-up"></i> 
                                            <?= $anime['growth'] ?>
                                        </small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hourly Traffic -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hourly Traffic Pattern</h3>
            </div>
            <div class="card-body">
                <canvas id="hourlyChart" height="60"></canvas>
            </div>
        </div>
    </div>
</div>

<?php
$extra_scripts = [
    'https://cdn.jsdelivr.net/npm/chart.js',
    admin_url('assets/js/charts.js')
];
include 'includes/footer.php';
?>

<script>
// Traffic Chart (Line)
const trafficCtx = document.getElementById('trafficChart').getContext('2d');
new Chart(trafficCtx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Page Views',
            data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
            borderColor: '#00adff',
            backgroundColor: 'rgba(0, 173, 255, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'Unique Visitors',
            data: [8000, 12000, 10000, 16000, 14000, 18000, 17000],
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString();
                    }
                }
            }
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

// Device Chart (Doughnut)
const deviceCtx = document.getElementById('deviceChart').getContext('2d');
new Chart(deviceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Mobile', 'Desktop', 'Tablet'],
        datasets: [{
            data: [65.4, 28.7, 5.9],
            backgroundColor: ['#00adff', '#28a745', '#ffc107'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

// Hourly Chart (Bar)
const hourlyCtx = document.getElementById('hourlyChart').getContext('2d');
const hourlyData = <?= json_encode(array_column($analytics_data['hourly_traffic'], 'views')) ?>;
const hourlyLabels = <?= json_encode(array_column($analytics_data['hourly_traffic'], 'hour')) ?>;

new Chart(hourlyCtx, {
    type: 'bar',
    data: {
        labels: hourlyLabels,
        datasets: [{
            label: 'Views per Hour',
            data: hourlyData,
            backgroundColor: '#00adff',
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString();
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>