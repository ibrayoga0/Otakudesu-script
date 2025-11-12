<?php
require_once 'config.php';
check_admin_login();

$page_title = 'Anime Management';
$breadcrumb = [
    ['title' => 'Content'],
    ['title' => 'Anime Management']
];

// Sample anime data
$anime_list = [
    [
        'id' => 1,
        'title' => 'One Piece',
        'japanese_title' => 'ワンピース',
        'type' => 'TV Series',
        'status' => 'Ongoing',
        'episodes' => 1089,
        'rating' => 9.2,
        'year' => 1999,
        'genres' => 'Action, Adventure, Comedy',
        'created_at' => '2023-01-15',
        'updated_at' => '2024-11-12'
    ],
    [
        'id' => 2,
        'title' => 'Attack on Titan',
        'japanese_title' => '進撃の巨人',
        'type' => 'TV Series',
        'status' => 'Completed',
        'episodes' => 87,
        'rating' => 9.5,
        'year' => 2013,
        'genres' => 'Action, Drama, Fantasy',
        'created_at' => '2023-01-20',
        'updated_at' => '2024-11-10'
    ],
    [
        'id' => 3,
        'title' => 'Demon Slayer',
        'japanese_title' => '鬼滅の刃',
        'type' => 'TV Series',
        'status' => 'Ongoing',
        'episodes' => 44,
        'rating' => 8.9,
        'year' => 2019,
        'genres' => 'Action, Supernatural, Historical',
        'created_at' => '2023-02-01',
        'updated_at' => '2024-11-08'
    ],
    [
        'id' => 4,
        'title' => 'My Hero Academia',
        'japanese_title' => '僕のヒーローアカデミア',
        'type' => 'TV Series',
        'status' => 'Ongoing',
        'episodes' => 158,
        'rating' => 8.7,
        'year' => 2016,
        'genres' => 'Action, School, Super Power',
        'created_at' => '2023-02-10',
        'updated_at' => '2024-11-05'
    ],
    [
        'id' => 5,
        'title' => 'Naruto: Shippuden',
        'japanese_title' => 'ナルト 疾風伝',
        'type' => 'TV Series',
        'status' => 'Completed',
        'episodes' => 720,
        'rating' => 8.8,
        'year' => 2007,
        'genres' => 'Action, Martial Arts, Super Power',
        'created_at' => '2023-01-10',
        'updated_at' => '2024-10-28'
    ]
];

include 'includes/header.php';
?>

<!-- Content Header -->
<div class="row mb-3">
    <div class="col-12">
        <a href="<?= admin_url('anime-add.php') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Anime
        </a>
        <a href="#" class="btn btn-info">
            <i class="fas fa-upload"></i> Bulk Import
        </a>
        <a href="#" class="btn btn-secondary">
            <i class="fas fa-download"></i> Export Data
        </a>
    </div>
</div>

<!-- Filters -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search anime..." value="">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="type" class="form-control">
                            <option value="">All Types</option>
                            <option value="tv">TV Series</option>
                            <option value="movie">Movie</option>
                            <option value="ova">OVA</option>
                            <option value="special">Special</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="year" class="form-control" placeholder="Year" min="1950" max="<?= date('Y') + 1 ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="<?= admin_url('anime.php') ?>" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Anime List -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Anime List</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Quick search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Poster</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Episodes</th>
                            <th>Rating</th>
                            <th>Year</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anime_list as $anime): ?>
                            <tr>
                                <td><?= $anime['id'] ?></td>
                                <td>
                                    <img src="<?= asset_url('images/sample-anime.jpg') ?>" 
                                         alt="<?= htmlspecialchars($anime['title']) ?>" 
                                         class="img-thumbnail" style="width: 40px; height: 60px;">
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($anime['title']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($anime['japanese_title']) ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-info"><?= $anime['type'] ?></span>
                                </td>
                                <td>
                                    <?php
                                    $status_class = $anime['status'] === 'Ongoing' ? 'success' : 
                                                   ($anime['status'] === 'Completed' ? 'secondary' : 'warning');
                                    ?>
                                    <span class="badge badge-<?= $status_class ?>"><?= $anime['status'] ?></span>
                                </td>
                                <td><?= $anime['episodes'] ?></td>
                                <td>
                                    <span class="badge badge-warning">
                                        <i class="fas fa-star"></i> <?= $anime['rating'] ?>
                                    </span>
                                </td>
                                <td><?= $anime['year'] ?></td>
                                <td>
                                    <small class="text-muted"><?= date('M j, Y', strtotime($anime['updated_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= admin_url('anime-view.php?id=' . $anime['id']) ?>" 
                                           class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= admin_url('anime-edit.php?id=' . $anime['id']) ?>" 
                                           class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="deleteAnime(<?= $anime['id'] ?>)" 
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
                    Showing 1 to 5 of 1,250 entries
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
function deleteAnime(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Here you would normally send AJAX request to delete
            Swal.fire(
                'Deleted!',
                'Anime has been deleted.',
                'success'
            );
        }
    });
}
</script>