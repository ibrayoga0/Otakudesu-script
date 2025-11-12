    <!-- Footer -->
    <div id="footer">
        <div id="footzer">
            <div class="center">
                <div class="stbwid">
                    <h4>About</h4>
                    <p><?= SITE_NAME ?> adalah situs streaming anime subtitle Indonesia terlengkap dan selalu update. Kami menyediakan berbagai macam anime dari berbagai genre dan tahun rilis.</p>
                </div>
                <div class="stbwid">
                    <h4>Tips</h4>
                    <p>Gunakan bookmark untuk menyimpan anime favorit kamu. Cek jadwal rilis untuk anime terbaru setiap minggunya.</p>
                </div>
                <div class="stbwid">
                    <h4>Info</h4>
                    <p>Semua video yang tersedia di situs ini bersumber dari berbagai situs video sharing yang ada di internet.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Credit -->
    <div id="credit">
        <div class="center">
            <p>All rights reserved © Copyright <?= date('Y') ?>, <?= SITE_NAME ?>. Created With <i class="fas fa-heart" style="color: #e74c3c;"></i> Powered by PHP & MySQL</p>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Video.js -->
    <script src="https://vjs.zencdn.net/8.5.2/video.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= asset_url('js/script.js') ?>"></script>
</body>
</html>