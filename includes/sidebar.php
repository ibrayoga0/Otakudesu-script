<div id="sidebar">
    <!-- Anime Terbaru -->
    <div class="section">
        <h3>Anime Terbaru</h3>
        <div class="content">
            <ul style="list-style: none; padding: 10px;">
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Sample Anime 1 Episode 5</a>
                    <div style="font-size: 10px; color: #999;"><?= date('d M Y') ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Sample Anime 2 Episode 3</a>
                    <div style="font-size: 10px; color: #999;"><?= date('d M Y') ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Sample Anime 3 Episode 7</a>
                    <div style="font-size: 10px; color: #999;"><?= date('d M Y') ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Sample Anime 4 Episode 2</a>
                    <div style="font-size: 10px; color: #999;"><?= date('d M Y') ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Sample Anime 5 Episode 12</a>
                    <div style="font-size: 10px; color: #999;"><?= date('d M Y') ?></div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Genre -->
    <div class="section">
        <h3>Genre</h3>
        <div class="content">
            <div style="padding: 10px;">
                <a href="<?= page_url('genre/action') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Action</a>
                <a href="<?= page_url('genre/adventure') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Adventure</a>
                <a href="<?= page_url('genre/comedy') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Comedy</a>
                <a href="<?= page_url('genre/drama') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Drama</a>
                <a href="<?= page_url('genre/fantasy') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Fantasy</a>
                <a href="<?= page_url('genre/romance') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Romance</a>
                <a href="<?= page_url('genre/sci-fi') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Sci-Fi</a>
                <a href="<?= page_url('genre/slice-of-life') ?>" style="display: inline-block; background: #f1f1f1; color: #333; border: 1px solid #ddd; padding: 4px 8px; margin: 2px; font-size: 11px; text-decoration: none;">Slice of Life</a>
            </div>
        </div>
    </div>

    <!-- Anime Populer -->
    <div class="section">
        <h3>Anime Populer</h3>
        <div class="content">
            <ul style="list-style: none; padding: 10px;">
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Popular Anime 1</a>
                    <div style="font-size: 10px; color: #999;">Rating: <?= number_format(rand(700, 950) / 100, 1) ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Popular Anime 2</a>
                    <div style="font-size: 10px; color: #999;">Rating: <?= number_format(rand(700, 950) / 100, 1) ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Popular Anime 3</a>
                    <div style="font-size: 10px; color: #999;">Rating: <?= number_format(rand(700, 950) / 100, 1) ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Popular Anime 4</a>
                    <div style="font-size: 10px; color: #999;">Rating: <?= number_format(rand(700, 950) / 100, 1) ?></div>
                </li>
                <li style="margin-bottom: 8px; border-bottom: 1px solid #444; padding-bottom: 5px;">
                    <a href="#" style="color: #00adff; font-size: 12px;">Popular Anime 5</a>
                    <div style="font-size: 10px; color: #999;">Rating: <?= number_format(rand(700, 950) / 100, 1) ?></div>
                </li>
            </ul>
        </div>
    </div>
</div>