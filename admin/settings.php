<?php
require_once 'config.php';
check_admin_login();

$page_title = 'Settings';
$breadcrumb = [
    ['title' => 'Settings']
];

// Sample settings data
$settings = [
    'site' => [
        'site_name' => 'Otakudesu Clone',
        'site_description' => 'Watch your favorite anime episodes online for free',
        'site_url' => 'http://otakudesu.test',
        'site_email' => 'admin@otakudesu.test',
        'timezone' => 'Asia/Jakarta',
        'date_format' => 'Y-m-d H:i:s',
        'posts_per_page' => 12,
        'maintenance_mode' => false
    ],
    'video' => [
        'default_quality' => '720p',
        'auto_play' => true,
        'show_controls' => true,
        'volume_default' => 80,
        'seek_step' => 10,
        'allowed_qualities' => ['360p', '480p', '720p', '1080p'],
        'player_theme' => 'dark'
    ],
    'seo' => [
        'meta_title_format' => '{anime_title} - Episode {episode_number} - Otakudesu',
        'meta_description_format' => 'Watch {anime_title} Episode {episode_number} English Subbed online at Otakudesu',
        'enable_sitemap' => true,
        'robots_txt' => true,
        'google_analytics' => '',
        'google_search_console' => ''
    ],
    'security' => [
        'enable_ssl' => false,
        'session_lifetime' => 3600,
        'max_login_attempts' => 5,
        'login_lockout_time' => 900,
        'enable_2fa' => false,
        'password_min_length' => 8
    ],
    'cache' => [
        'enable_cache' => true,
        'cache_lifetime' => 3600,
        'enable_gzip' => true,
        'minify_html' => false,
        'minify_css' => false,
        'minify_js' => false
    ]
];

if ($_POST) {
    // Handle form submission
    // In real application, validate and save settings to database
    show_success('Settings saved successfully!');
}

include 'includes/header.php';
?>

<form method="POST" action="">
    <!-- Site Settings -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog"></i> General Settings
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site[site_name]" 
                                       value="<?= htmlspecialchars($settings['site']['site_name']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_url">Site URL</label>
                                <input type="url" class="form-control" id="site_url" name="site[site_url]" 
                                       value="<?= htmlspecialchars($settings['site']['site_url']) ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="site_description">Site Description</label>
                        <textarea class="form-control" id="site_description" name="site[site_description]" 
                                  rows="3" required><?= htmlspecialchars($settings['site']['site_description']) ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="site_email">Admin Email</label>
                                <input type="email" class="form-control" id="site_email" name="site[site_email]" 
                                       value="<?= htmlspecialchars($settings['site']['site_email']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select class="form-control" id="timezone" name="site[timezone]">
                                    <option value="Asia/Jakarta" <?= $settings['site']['timezone'] === 'Asia/Jakarta' ? 'selected' : '' ?>>Asia/Jakarta</option>
                                    <option value="Asia/Tokyo" <?= $settings['site']['timezone'] === 'Asia/Tokyo' ? 'selected' : '' ?>>Asia/Tokyo</option>
                                    <option value="UTC" <?= $settings['site']['timezone'] === 'UTC' ? 'selected' : '' ?>>UTC</option>
                                    <option value="America/New_York" <?= $settings['site']['timezone'] === 'America/New_York' ? 'selected' : '' ?>>America/New_York</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="posts_per_page">Anime per Page</label>
                                <input type="number" class="form-control" id="posts_per_page" name="site[posts_per_page]" 
                                       value="<?= $settings['site']['posts_per_page'] ?>" min="1" max="50">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="maintenance_mode" 
                                   name="site[maintenance_mode]" <?= $settings['site']['maintenance_mode'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="maintenance_mode">Maintenance Mode</label>
                            <small class="form-text text-muted">Enable this to show a maintenance page to visitors</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Player Settings -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-video"></i> Video Player Settings
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="default_quality">Default Quality</label>
                                <select class="form-control" id="default_quality" name="video[default_quality]">
                                    <?php foreach ($settings['video']['allowed_qualities'] as $quality): ?>
                                        <option value="<?= $quality ?>" <?= $settings['video']['default_quality'] === $quality ? 'selected' : '' ?>>
                                            <?= $quality ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="volume_default">Default Volume (%)</label>
                                <input type="range" class="form-control-range" id="volume_default" 
                                       name="video[volume_default]" min="0" max="100" 
                                       value="<?= $settings['video']['volume_default'] ?>"
                                       oninput="document.getElementById('volume_display').textContent = this.value + '%'">
                                <small class="text-muted">Current: <span id="volume_display"><?= $settings['video']['volume_default'] ?>%</span></small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="seek_step">Seek Step (seconds)</label>
                                <input type="number" class="form-control" id="seek_step" name="video[seek_step]" 
                                       value="<?= $settings['video']['seek_step'] ?>" min="5" max="30">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="player_theme">Player Theme</label>
                                <select class="form-control" id="player_theme" name="video[player_theme]">
                                    <option value="dark" <?= $settings['video']['player_theme'] === 'dark' ? 'selected' : '' ?>>Dark</option>
                                    <option value="light" <?= $settings['video']['player_theme'] === 'light' ? 'selected' : '' ?>>Light</option>
                                    <option value="auto" <?= $settings['video']['player_theme'] === 'auto' ? 'selected' : '' ?>>Auto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Player Options</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="auto_play" 
                                           name="video[auto_play]" <?= $settings['video']['auto_play'] ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="auto_play">Auto Play</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="show_controls" 
                                           name="video[show_controls]" <?= $settings['video']['show_controls'] ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="show_controls">Show Controls</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEO Settings -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-search"></i> SEO Settings
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_title_format">Meta Title Format</label>
                        <input type="text" class="form-control" id="meta_title_format" 
                               name="seo[meta_title_format]" value="<?= htmlspecialchars($settings['seo']['meta_title_format']) ?>">
                        <small class="form-text text-muted">Available variables: {anime_title}, {episode_number}, {site_name}</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="meta_description_format">Meta Description Format</label>
                        <textarea class="form-control" id="meta_description_format" 
                                  name="seo[meta_description_format]" rows="3"><?= htmlspecialchars($settings['seo']['meta_description_format']) ?></textarea>
                        <small class="form-text text-muted">Available variables: {anime_title}, {episode_number}, {site_name}</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="google_analytics">Google Analytics ID</label>
                                <input type="text" class="form-control" id="google_analytics" 
                                       name="seo[google_analytics]" value="<?= htmlspecialchars($settings['seo']['google_analytics']) ?>" 
                                       placeholder="G-XXXXXXXXXX">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="google_search_console">Google Search Console</label>
                                <input type="text" class="form-control" id="google_search_console" 
                                       name="seo[google_search_console]" value="<?= htmlspecialchars($settings['seo']['google_search_console']) ?>" 
                                       placeholder="Verification code">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>SEO Options</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="enable_sitemap" 
                                           name="seo[enable_sitemap]" <?= $settings['seo']['enable_sitemap'] ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="enable_sitemap">Enable Sitemap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="robots_txt" 
                                           name="seo[robots_txt]" <?= $settings['seo']['robots_txt'] ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="robots_txt">Generate robots.txt</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Security & Cache Settings -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-shield-alt"></i> Security Settings
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="session_lifetime">Session Lifetime (seconds)</label>
                        <input type="number" class="form-control" id="session_lifetime" 
                               name="security[session_lifetime]" value="<?= $settings['security']['session_lifetime'] ?>" min="300">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="max_login_attempts">Max Login Attempts</label>
                                <input type="number" class="form-control" id="max_login_attempts" 
                                       name="security[max_login_attempts]" value="<?= $settings['security']['max_login_attempts'] ?>" min="3" max="10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="login_lockout_time">Lockout Time (seconds)</label>
                                <input type="number" class="form-control" id="login_lockout_time" 
                                       name="security[login_lockout_time]" value="<?= $settings['security']['login_lockout_time'] ?>" min="300">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="enable_ssl" 
                                   name="security[enable_ssl]" <?= $settings['security']['enable_ssl'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="enable_ssl">Force SSL/HTTPS</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="enable_2fa" 
                                   name="security[enable_2fa]" <?= $settings['security']['enable_2fa'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="enable_2fa">Enable Two-Factor Authentication</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tachometer-alt"></i> Performance & Cache
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="cache_lifetime">Cache Lifetime (seconds)</label>
                        <input type="number" class="form-control" id="cache_lifetime" 
                               name="cache[cache_lifetime]" value="<?= $settings['cache']['cache_lifetime'] ?>" min="60">
                    </div>
                    
                    <div class="form-group">
                        <label>Cache Options</label>
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="enable_cache" 
                                   name="cache[enable_cache]" <?= $settings['cache']['enable_cache'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="enable_cache">Enable Page Cache</label>
                        </div>
                        
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="enable_gzip" 
                                   name="cache[enable_gzip]" <?= $settings['cache']['enable_gzip'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="enable_gzip">Enable GZIP Compression</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Minification</label>
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="minify_html" 
                                   name="cache[minify_html]" <?= $settings['cache']['minify_html'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="minify_html">Minify HTML</label>
                        </div>
                        
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="minify_css" 
                                   name="cache[minify_css]" <?= $settings['cache']['minify_css'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="minify_css">Minify CSS</label>
                        </div>
                        
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="minify_js" 
                                   name="cache[minify_js]" <?= $settings['cache']['minify_js'] ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="minify_js">Minify JavaScript</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                    <a href="<?= admin_url('settings.php') ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-undo"></i> Reset Changes
                    </a>
                    <button type="button" class="btn btn-warning btn-lg" onclick="clearCache()">
                        <i class="fas fa-trash"></i> Clear Cache
                    </button>
                    <a href="#" class="btn btn-info btn-lg">
                        <i class="fas fa-download"></i> Export Settings
                    </a>
                    <a href="#" class="btn btn-success btn-lg">
                        <i class="fas fa-upload"></i> Import Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
$extra_scripts = [
    'https://cdn.jsdelivr.net/npm/sweetalert2@11'
];
include 'includes/footer.php';
?>

<script>
function clearCache() {
    confirmAction('Clear Cache?', 'This will clear all cached files and may temporarily slow down the site.').then((result) => {
        if (result.isConfirmed) {
            // Here you would send AJAX request to clear cache
            showSuccess('Cache cleared successfully!');
        }
    });
}

// Auto-save functionality
let autoSaveTimeout;
document.querySelectorAll('input, select, textarea').forEach(element => {
    element.addEventListener('change', function() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            // Auto-save settings
            showInfo('Settings auto-saved', 2000);
        }, 2000);
    });
});
</script>