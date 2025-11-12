// Main JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Hover effect for anime cards
    const animeCards = document.querySelectorAll('.venz ul li .thumb a');
    animeCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const title = this.querySelector('h2.jdlflm');
            if (title) {
                title.style.height = '65px';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const title = this.querySelector('h2.jdlflm');
            if (title) {
                title.style.height = '25px';
            }
        });
    });

    // Search form validation
    const searchForm = document.querySelector('.search-form form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input[name="q"]');
            if (searchInput.value.trim() === '') {
                e.preventDefault();
                alert('Masukkan kata kunci pencarian');
                searchInput.focus();
            }
        });
    }

    // Mobile menu toggle
    const menuToggle = document.createElement('button');
    menuToggle.className = 'menu-toggle d-md-none';
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    menuToggle.style.cssText = `
        background: #00adff;
        border: none;
        color: white;
        padding: 10px;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
    `;

    const header = document.querySelector('#header .container-fluid .row .col-12');
    if (header) {
        header.appendChild(menuToggle);
    }

    menuToggle.addEventListener('click', function() {
        const menu = document.querySelector('#cssmenu ul');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    });

    // Cinema mode for video player
    function toggleCinemaMode() {
        const body = document.body;
        const cinemaButton = document.querySelector('.lightSwitcher');
        
        if (body.classList.contains('cinema-mode')) {
            body.classList.remove('cinema-mode');
            if (cinemaButton) cinemaButton.textContent = 'CINEMA OFF';
        } else {
            body.classList.add('cinema-mode');
            if (cinemaButton) cinemaButton.textContent = 'CINEMA ON';
        }
    }

    // Bind cinema mode toggle
    const cinemaButton = document.querySelector('.lightSwitcher');
    if (cinemaButton) {
        cinemaButton.addEventListener('click', function(e) {
            e.preventDefault();
            toggleCinemaMode();
        });
    }

    // Mirror stream tabs
    const mirrorTabs = document.querySelectorAll('.mirrorstream ul');
    mirrorTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            mirrorTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Here you would typically load the corresponding video source
            console.log('Loading mirror:', this.textContent);
        });
    });

});