<?php
require_once 'config.php';
check_admin_login();

$page_title = 'Genre Management';
$breadcrumb = [
    ['title' => 'Content'],
    ['title' => 'Genre Management']
];

// Sample genre data
$genres_list = [
    [
        'id' => 1,
        'name' => 'Action',
        'slug' => 'action',
        'description' => 'High-energy anime with intense fight scenes and adventures',
        'anime_count' => 245,
        'popularity' => 95,
        'color' => '#FF5722',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 2,
        'name' => 'Romance',
        'slug' => 'romance',
        'description' => 'Love stories and romantic relationships between characters',
        'anime_count' => 189,
        'popularity' => 88,
        'color' => '#E91E63',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 3,
        'name' => 'Fantasy',
        'slug' => 'fantasy',
        'description' => 'Magical worlds with supernatural elements and mythical creatures',
        'anime_count' => 167,
        'popularity' => 92,
        'color' => '#9C27B0',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 4,
        'name' => 'Comedy',
        'slug' => 'comedy',
        'description' => 'Humorous anime designed to entertain and make you laugh',
        'anime_count' => 156,
        'popularity' => 85,
        'color' => '#FF9800',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 5,
        'name' => 'Drama',
        'slug' => 'drama',
        'description' => 'Emotional stories with character development and serious themes',
        'anime_count' => 134,
        'popularity' => 78,
        'color' => '#607D8B',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 6,
        'name' => 'Slice of Life',
        'slug' => 'slice-of-life',
        'description' => 'Everyday life situations and realistic character interactions',
        'anime_count' => 98,
        'popularity' => 72,
        'color' => '#4CAF50',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 7,
        'name' => 'Supernatural',
        'slug' => 'supernatural',
        'description' => 'Stories involving ghosts, spirits, and paranormal activities',
        'anime_count' => 87,
        'popularity' => 82,
        'color' => '#3F51B5',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ],
    [
        'id' => 8,
        'name' => 'Sports',
        'slug' => 'sports',
        'description' => 'Athletic competitions and team-based activities',
        'anime_count' => 76,
        'popularity' => 68,
        'color' => '#009688',
        'status' => 'Active',
        'created_at' => '2024-01-15'
    ]
];

include 'includes/header.php';
?>

<!-- Content Header -->
<div class="row mb-3">
    <div class="col-12">
        <a href="<?= admin_url('genre-add.php') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Genre
        </a>
        <a href="#" class="btn btn-info">
            <i class="fas fa-sort"></i> Reorder Genres
        </a>
        <a href="#" class="btn btn-warning">
            <i class="fas fa-palette"></i> Color Manager
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
                <h3>24</h3>
                <p>Total Genres</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>22</h3>
                <p>Active Genres</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>2</h3>
                <p>Inactive</p>
            </div>
            <div class="icon">
                <i class="fas fa-pause-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>1,250</h3>
                <p>Total Anime</p>
            </div>
            <div class="icon">
                <i class="fas fa-film"></i>
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
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search genres..." value="">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-control">
                            <option value="name">Name</option>
                            <option value="anime_count">Anime Count</option>
                            <option value="popularity">Popularity</option>
                            <option value="created_at">Date Created</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="<?= admin_url('genres.php') ?>" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Genre Cards Grid -->
<div class="row">
    <?php foreach ($genres_list as $genre): ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card genre-card" style="border-left: 4px solid <?= $genre['color'] ?>;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">
                            <span class="genre-color" style="background-color: <?= $genre['color'] ?>; width: 12px; height: 12px; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
                            <?= htmlspecialchars($genre['name']) ?>
                        </h5>
                        <div class="dropdown">
                            <a href="#" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="<?= admin_url('genre-edit.php?id=' . $genre['id']) ?>" class="dropdown-item">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= site_url('genre.php?slug=' . $genre['slug']) ?>" class="dropdown-item" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" onclick="deleteGenre(<?= $genre['id'] ?>)" class="dropdown-item text-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <p class="card-text text-muted small mb-3">
                        <?= htmlspecialchars(truncateText($genre['description'], 80)) ?>
                    </p>
                    
                    <div class="genre-stats">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-right">
                                    <strong class="d-block"><?= number_format($genre['anime_count']) ?></strong>
                                    <small class="text-muted">Anime</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <strong class="d-block"><?= $genre['popularity'] ?>%</strong>
                                <small class="text-muted">Popular</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: <?= $genre['popularity'] ?>%; background-color: <?= $genre['color'] ?>;"></div>
                        </div>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <span class="badge badge-<?= $genre['status'] === 'Active' ? 'success' : 'secondary' ?>">
                            <?= $genre['status'] ?>
                        </span>
                        <small class="text-muted">
                            <i class="fas fa-clock"></i> <?= date('M j, Y', strtotime($genre['created_at'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Detailed Table View -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detailed Genre List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Color</th>
                            <th>Anime Count</th>
                            <th>Popularity</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($genres_list as $genre): ?>
                            <tr>
                                <td><?= $genre['id'] ?></td>
                                <td>
                                    <span class="genre-color" style="background-color: <?= $genre['color'] ?>; width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
                                    <strong><?= htmlspecialchars($genre['name']) ?></strong>
                                </td>
                                <td>
                                    <code><?= $genre['slug'] ?></code>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 20px; height: 20px; background-color: <?= $genre['color'] ?>; border-radius: 3px; margin-right: 8px;"></div>
                                        <code><?= $genre['color'] ?></code>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary"><?= number_format($genre['anime_count']) ?></span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 20px; width: 60px;">
                                        <div class="progress-bar" style="width: <?= $genre['popularity'] ?>%; background-color: <?= $genre['color'] ?>;">
                                            <small><?= $genre['popularity'] ?>%</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $genre['status'] === 'Active' ? 'success' : 'secondary' ?>">
                                        <?= $genre['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <small><?= date('M j, Y', strtotime($genre['created_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= admin_url('genre-edit.php?id=' . $genre['id']) ?>" 
                                           class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('genre.php?slug=' . $genre['slug']) ?>" 
                                           class="btn btn-success btn-sm" title="View" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" onclick="deleteGenre(<?= $genre['id'] ?>)" 
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
        </div>
    </div>
</div>

<?php
$extra_styles = [
    '<style>
        .genre-card {
            transition: transform 0.2s;
        }
        .genre-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .genre-stats .border-right {
            border-right: 1px solid #dee2e6;
        }
    </style>'
];

$extra_scripts = [
    'https://cdn.jsdelivr.net/npm/sweetalert2@11'
];
include 'includes/footer.php';
?>

<script>
function deleteGenre(id) {
    confirmDelete(
        'Delete Genre?', 
        'This will permanently delete the genre and remove it from all associated anime!'
    ).then((result) => {
        if (result.isConfirmed) {
            // Here you would normally send AJAX request to delete
            showSuccess('Genre has been deleted successfully!');
        }
    });
}
</script>