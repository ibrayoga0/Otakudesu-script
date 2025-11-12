<?php
require_once 'config.php';
check_admin_login();

$page_title = 'User Management';
$breadcrumb = [
    ['title' => 'User Management']
];

// Sample user data
$users_list = [
    [
        'id' => 1,
        'username' => 'admin',
        'email' => 'admin@otakudesu.test',
        'full_name' => 'Administrator',
        'role' => 'Super Admin',
        'status' => 'Active',
        'last_login' => '2024-11-12 14:30:00',
        'created_at' => '2024-01-15 10:00:00',
        'avatar' => 'https://via.placeholder.com/50x50?text=AD'
    ],
    [
        'id' => 2,
        'username' => 'moderator1',
        'email' => 'mod1@otakudesu.test',
        'full_name' => 'Content Moderator',
        'role' => 'Moderator',
        'status' => 'Active',
        'last_login' => '2024-11-12 12:15:00',
        'created_at' => '2024-02-20 09:30:00',
        'avatar' => 'https://via.placeholder.com/50x50?text=CM'
    ],
    [
        'id' => 3,
        'username' => 'editor1',
        'email' => 'editor1@otakudesu.test',
        'full_name' => 'Content Editor',
        'role' => 'Editor',
        'status' => 'Active',
        'last_login' => '2024-11-11 16:45:00',
        'created_at' => '2024-03-10 14:20:00',
        'avatar' => 'https://via.placeholder.com/50x50?text=CE'
    ],
    [
        'id' => 4,
        'username' => 'viewer1',
        'email' => 'viewer@otakudesu.test',
        'full_name' => 'Content Viewer',
        'role' => 'Viewer',
        'status' => 'Suspended',
        'last_login' => '2024-11-08 10:20:00',
        'created_at' => '2024-04-05 11:15:00',
        'avatar' => 'https://via.placeholder.com/50x50?text=CV'
    ],
    [
        'id' => 5,
        'username' => 'uploader1',
        'email' => 'uploader@otakudesu.test',
        'full_name' => 'Content Uploader',
        'role' => 'Uploader',
        'status' => 'Active',
        'last_login' => '2024-11-12 08:30:00',
        'created_at' => '2024-05-15 13:45:00',
        'avatar' => 'https://via.placeholder.com/50x50?text=CU'
    ]
];

$roles = [
    'Super Admin' => ['color' => 'danger', 'permissions' => 'Full Access'],
    'Admin' => ['color' => 'warning', 'permissions' => 'Most Access'],
    'Moderator' => ['color' => 'info', 'permissions' => 'Content Management'],
    'Editor' => ['color' => 'primary', 'permissions' => 'Edit Content'],
    'Uploader' => ['color' => 'success', 'permissions' => 'Upload Content'],
    'Viewer' => ['color' => 'secondary', 'permissions' => 'View Only']
];

include 'includes/header.php';
?>

<!-- Content Header -->
<div class="row mb-3">
    <div class="col-12">
        <a href="<?= admin_url('user-add.php') ?>" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Add New User
        </a>
        <a href="#" class="btn btn-info">
            <i class="fas fa-users-cog"></i> Manage Roles
        </a>
        <a href="#" class="btn btn-warning">
            <i class="fas fa-key"></i> Password Reset
        </a>
        <a href="#" class="btn btn-secondary">
            <i class="fas fa-download"></i> Export Users
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>5</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>4</h3>
                <p>Active Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>1</h3>
                <p>Suspended</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>3</h3>
                <p>Online Now</p>
            </div>
            <div class="icon">
                <i class="fas fa-circle text-success"></i>
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
                        <input type="text" name="search" class="form-control" placeholder="Search users..." value="">
                    </div>
                    <div class="col-md-2">
                        <select name="role" class="form-control">
                            <option value="">All Roles</option>
                            <?php foreach ($roles as $role => $info): ?>
                                <option value="<?= strtolower(str_replace(' ', '_', $role)) ?>"><?= $role ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="suspended">Suspended</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-control">
                            <option value="created_at">Newest</option>
                            <option value="last_login">Last Login</option>
                            <option value="username">Username</option>
                            <option value="role">Role</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="<?= admin_url('users.php') ?>" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Users List -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">System Users</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right quick-search" 
                               data-target="#users-table" placeholder="Quick search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table id="users-table" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users_list as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td>
                                    <div class="user-info d-flex align-items-center">
                                        <img src="<?= $user['avatar'] ?>" alt="Avatar" class="img-circle img-size-32 mr-2">
                                        <div>
                                            <strong><?= htmlspecialchars($user['username']) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($user['full_name']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:<?= $user['email'] ?>"><?= htmlspecialchars($user['email']) ?></a>
                                </td>
                                <td>
                                    <?php
                                    $role_info = $roles[$user['role']] ?? ['color' => 'secondary', 'permissions' => 'Unknown'];
                                    ?>
                                    <span class="badge badge-<?= $role_info['color'] ?>" title="<?= $role_info['permissions'] ?>">
                                        <?= $user['role'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $status_class = $user['status'] === 'Active' ? 'success' : 
                                                   ($user['status'] === 'Suspended' ? 'danger' : 'warning');
                                    ?>
                                    <span class="badge badge-<?= $status_class ?>">
                                        <?= $user['status'] ?>
                                    </span>
                                    <?php if ($user['status'] === 'Active' && strtotime($user['last_login']) > strtotime('-10 minutes')): ?>
                                        <span class="badge badge-success badge-sm ml-1" title="Online">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small><?= date('M j, Y H:i', strtotime($user['last_login'])) ?></small>
                                    <br>
                                    <small class="text-muted">
                                        <?php
                                        $diff = time() - strtotime($user['last_login']);
                                        if ($diff < 3600) {
                                            echo floor($diff / 60) . ' min ago';
                                        } elseif ($diff < 86400) {
                                            echo floor($diff / 3600) . ' hours ago';
                                        } else {
                                            echo floor($diff / 86400) . ' days ago';
                                        }
                                        ?>
                                    </small>
                                </td>
                                <td>
                                    <small><?= date('M j, Y', strtotime($user['created_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= admin_url('user-edit.php?id=' . $user['id']) ?>" 
                                           class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= admin_url('user-profile.php?id=' . $user['id']) ?>" 
                                           class="btn btn-info btn-sm" title="View Profile">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" 
                                                    data-toggle="dropdown" title="More Actions">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" onclick="resetPassword(<?= $user['id'] ?>)">
                                                    <i class="fas fa-key"></i> Reset Password
                                                </a>
                                                <?php if ($user['status'] === 'Active'): ?>
                                                    <a class="dropdown-item" href="#" onclick="suspendUser(<?= $user['id'] ?>)">
                                                        <i class="fas fa-user-times"></i> Suspend
                                                    </a>
                                                <?php else: ?>
                                                    <a class="dropdown-item" href="#" onclick="activateUser(<?= $user['id'] ?>)">
                                                        <i class="fas fa-user-check"></i> Activate
                                                    </a>
                                                <?php endif; ?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#" onclick="loginAsUser(<?= $user['id'] ?>)">
                                                    <i class="fas fa-sign-in-alt"></i> Login As User
                                                </a>
                                                <?php if ($user['role'] !== 'Super Admin'): ?>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deleteUser(<?= $user['id'] ?>)">
                                                        <i class="fas fa-trash"></i> Delete User
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
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
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
                <div class="float-left">
                    Showing 1 to 5 of 5 entries
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Role Permissions Modal -->
<div class="modal fade" id="roleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Role Permissions</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($roles as $role => $info): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <span class="badge badge-<?= $info['color'] ?>"><?= $role ?></span>
                                    </h5>
                                    <p class="card-text"><?= $info['permissions'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
function resetPassword(userId) {
    confirmAction('Reset Password?', 'This will generate a new password and send it to the user\'s email.').then((result) => {
        if (result.isConfirmed) {
            // Here you would send AJAX request to reset password
            showSuccess('Password reset email sent successfully!');
        }
    });
}

function suspendUser(userId) {
    confirmAction('Suspend User?', 'The user will not be able to access the system until reactivated.').then((result) => {
        if (result.isConfirmed) {
            // Here you would send AJAX request to suspend user
            showSuccess('User suspended successfully!');
            location.reload();
        }
    });
}

function activateUser(userId) {
    confirmAction('Activate User?', 'The user will regain access to the system.').then((result) => {
        if (result.isConfirmed) {
            // Here you would send AJAX request to activate user
            showSuccess('User activated successfully!');
            location.reload();
        }
    });
}

function deleteUser(userId) {
    confirmDelete('Delete User?', 'This will permanently delete the user and all their data!').then((result) => {
        if (result.isConfirmed) {
            // Here you would send AJAX request to delete user
            showSuccess('User deleted successfully!');
            location.reload();
        }
    });
}

function loginAsUser(userId) {
    confirmAction('Login as User?', 'You will be logged in as this user. Make sure to logout when done.').then((result) => {
        if (result.isConfirmed) {
            // Here you would send request to login as user
            window.open('<?= site_url() ?>', '_blank');
        }
    });
}

// Show role permissions modal
document.querySelector('[href="#"]').addEventListener('click', function(e) {
    if (this.textContent.includes('Manage Roles')) {
        e.preventDefault();
        $('#roleModal').modal('show');
    }
});
</script>