<?php
require_once 'config.php';
check_admin_login();

$page_title = 'Episode Management';
$breadcrumb = [
    ['title' => 'Content'],
    ['title' => 'Episode Management']
];

// Sample episode data
$episodes_list = [
    [
        'id' => 1,
        'anime_title' => 'One Piece',
        'episode_number' => 1089,
        'title' => 'The Straw Hat Crew Arrives! The Battle Begins',
        'duration' => '24:12',
        'views' => 45678,
        'quality' => '1080p, 720p, 480p',
        'status' => 'Published',
        'release_date' => '2024-11-12',
        'created_at' => '2024-11-12 08:30:00'
    ],
    [
        'id' => 2,
        'anime_title' => 'Attack on Titan',
        'episode_number' => 87,
        'title' => 'The Final Battle - Part 2',
        'duration' => '28:45',
        'views' => 89234,
        'quality' => '1080p, 720p, 480p, 360p',
        'status' => 'Published',
        'release_date' => '2024-11-10',
        'created_at' => '2024-11-10 10:15:00'
    ],
    [
        'id' => 3,
        'anime_title' => 'Demon Slayer',
        'episode_number' => 44,
        'title' => 'Hashira Training Arc Finale',
        'duration' => '23:58',
        'views' => 67890,
        'quality' => '1080p, 720p, 480p',
        'status' => 'Published',
        'release_date' => '2024-11-08',
        'created_at' => '2024-11-08 09:45:00'
    ],
    [
        'id' => 4,
        'anime_title' => 'My Hero Academia',
        'episode_number' => 158,
        'title' => 'Class 1-A vs Class 1-B',
        'duration' => '23:42',
        'views' => 34567,
        'quality' => '1080p, 720p, 480p',
        'status' => 'Draft',
        'release_date' => '2024-11-15',
        'created_at' => '2024-11-12 14:20:00'
    ],
    [
        'id' => 5,
        'anime_title' => 'Jujutsu Kaisen',
        'episode_number' => 24,
        'title' => 'Shibuya Incident - Conclusion',
        'duration' => '24:30',
        'views' => 78901,
        'quality' => '1080p, 720p, 480p',
        'status' => 'Published',
        'release_date' => '2024-11-05',
        'created_at' => '2024-11-05 11:30:00'
    ]
];

include 'includes/header.php';
?>

<!-- Content Header -->
<div class="row mb-3">
    <div class="col-12">
        <a href="<?= admin_url('episode-add.php') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Episode
        </a>
        <a href="#" class="btn btn-info">
            <i class="fas fa-upload"></i> Bulk Upload
        </a>
        <a href="#" class="btn btn-warning">
            <i class="fas fa-sync"></i> Sync Episodes
        </a>
        <a href="#" class="btn btn-secondary">
            <i class="fas fa-download"></i> Export Data
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>15,680</h3>
                <p>Total Episodes</p>
            </div>
            <div class="icon">
                <i class="fas fa-video"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>14,523</h3>
                <p>Published</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>1,157</h3>
                <p>Draft</p>
            </div>
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>2.4M</h3>
                <p>Total Views</p>
            </div>
            <div class="icon">
                <i class="fas fa-eye"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search episodes..." value="">
                    </div>
                    <div class="col-md-2">
                        <select name="anime" class="form-control">
                            <option value="">All Anime</option>
                            <option value="1">One Piece</option>
                            <option value="2">Attack on Titan</option>
                            <option value="3">Demon Slayer</option>
                            <option value="4">My Hero Academia</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="quality" class="form-control">
                            <option value="">All Quality</option>
                            <option value="1080p">1080p</option>
                            <option value="720p">720p</option>
                            <option value="480p">480p</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="<?= admin_url('episodes.php') ?>" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Episodes List -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Episodes List</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right quick-search" 
                               data-target="#episodes-table" placeholder="Quick search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table id="episodes-table" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Anime</th>
                            <th>Episode</th>
                            <th>Title</th>
                            <th>Duration</th>
                            <th>Views</th>
                            <th>Quality</th>
                            <th>Status</th>
                            <th>Release Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($episodes_list as $episode): ?>
                            <tr>
                                <td><?= $episode['id'] ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($episode['anime_title']) ?></strong>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Ep. <?= $episode['episode_number'] ?></span>
                                </td>
                                <td>
                                    <?= htmlspecialchars(truncateText($episode['title'], 40)) ?>
                                </td>
                                <td>
                                    <i class="fas fa-clock text-muted"></i> <?= $episode['duration'] ?>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="fas fa-eye"></i> <?= number_format($episode['views']) ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted"><?= $episode['quality'] ?></small>
                                </td>
                                <td>
                                    <?php
                                    $status_class = $episode['status'] === 'Published' ? 'success' : 
                                                   ($episode['status'] === 'Draft' ? 'warning' : 'info');
                                    ?>
                                    <span class="badge badge-<?= $status_class ?>"><?= $episode['status'] ?></span>
                                </td>
                                <td>
                                    <small><?= date('M j, Y', strtotime($episode['release_date'])) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= admin_url('episode-view.php?id=' . $episode['id']) ?>" 
                                           class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= admin_url('episode-edit.php?id=' . $episode['id']) ?>" 
                                           class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('episode.php?id=' . $episode['id']) ?>" 
                                           class="btn btn-success btn-sm" title="Watch" target="_blank">
                                            <i class="fas fa-play"></i>
                                        </a>
                                        <a href="#" onclick="deleteEpisode(<?= $episode['id'] ?>)" 
                                           class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
                <div class="float-left">
                    Showing 1 to 5 of 15,680 entries
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$extra_scripts = [
    'https://cdn.jsdelivr.net/npm/sweetalert2@11'
];
include 'includes/footer.php';
?>

<script>
function truncateText(text, maxLength) {
    if (text.length <= maxLength) {
        return text;
    }
    return text.substring(0, maxLength) + '...';
}

function deleteEpisode(id) {
    confirmDelete(
        'Delete Episode?', 
        'This will permanently delete the episode and all its data!'
    ).then((result) => {
        if (result.isConfirmed) {
            // Here you would normally send AJAX request to delete
            showSuccess('Episode has been deleted successfully!');
        }
    });
}

// Auto-refresh views count every 30 seconds
setInterval(function() {
    // In real application, you would update view counts via AJAX
    console.log('Refreshing view counts...');
}, 30000);
</script>