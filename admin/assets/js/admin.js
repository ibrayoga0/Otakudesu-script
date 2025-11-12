/* Custom Admin JavaScript for Otakudesu */

$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Initialize popovers
    $('[data-toggle="popover"]').popover();
    
    // Add fade-in animation to cards
    $('.card').addClass('fade-in');
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Sidebar menu active state
    var currentUrl = window.location.pathname;
    $('.nav-sidebar .nav-link').each(function() {
        var linkUrl = $(this).attr('href');
        if (currentUrl.includes(linkUrl) && linkUrl !== admin_url) {
            $(this).addClass('active');
            $(this).parents('.nav-item').addClass('menu-open');
        }
    });
    
    // DataTable initialization (if available)
    if ($.fn.DataTable) {
        $('.datatable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 25,
            "order": [[0, "desc"]],
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    }
    
    // File upload preview
    $('.file-upload').on('change', function() {
        var input = this;
        var $preview = $(input).siblings('.preview');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $preview.html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;">');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
    
    // Drag and drop file upload
    $('.upload-area').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('dragover');
    });
    
    $('.upload-area').on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
    });
    
    $('.upload-area').on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        
        var files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            var input = $(this).find('input[type="file"]')[0];
            input.files = files;
            $(input).trigger('change');
        }
    });
    
    // Quick search functionality
    $('.quick-search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        var target = $(this).data('target');
        
        $(target + ' tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // Auto-save draft functionality
    var autoSaveTimer;
    $('form[data-autosave]').on('change keyup', 'input, textarea, select', function() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(function() {
            saveDraft();
        }, 3000);
    });
    
    function saveDraft() {
        var formData = $('form[data-autosave]').serialize();
        var formId = $('form[data-autosave]').attr('id');
        
        if (formId && formData) {
            localStorage.setItem('draft_' + formId, formData);
            showNotification('Draft saved automatically', 'info');
        }
    }
    
    // Restore draft on page load
    $('form[data-autosave]').each(function() {
        var formId = $(this).attr('id');
        var savedDraft = localStorage.getItem('draft_' + formId);
        
        if (savedDraft) {
            var $form = $(this);
            $.each(savedDraft.split('&'), function(i, pair) {
                var parts = pair.split('=');
                if (parts.length === 2) {
                    var name = decodeURIComponent(parts[0]);
                    var value = decodeURIComponent(parts[1]);
                    $form.find('[name="' + name + '"]').val(value);
                }
            });
            showNotification('Draft restored', 'info');
        }
    });
    
    // Clear draft on successful submit
    $('form[data-autosave]').on('submit', function() {
        var formId = $(this).attr('id');
        if (formId) {
            localStorage.removeItem('draft_' + formId);
        }
    });
});

// Utility Functions
function showNotification(message, type = 'success') {
    var alertClass = 'alert-' + type;
    var notification = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    `;
    
    $('#notifications-container').html(notification);
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);
}

function confirmDelete(title = 'Are you sure?', text = "You won't be able to revert this!") {
    return Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    });
}

function showSuccess(message = 'Operation completed successfully!') {
    Swal.fire({
        title: 'Success!',
        text: message,
        icon: 'success',
        confirmButtonColor: '#00adff'
    });
}

function showError(message = 'Something went wrong!') {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonColor: '#d33'
    });
}

// AJAX Helper Functions
function makeAjaxRequest(url, data, method = 'POST') {
    return $.ajax({
        url: url,
        type: method,
        data: data,
        dataType: 'json',
        beforeSend: function() {
            showLoading();
        },
        complete: function() {
            hideLoading();
        }
    });
}

function showLoading() {
    if (!$('#loading-overlay').length) {
        $('body').append(`
            <div id="loading-overlay" class="overlay" style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `);
    }
}

function hideLoading() {
    $('#loading-overlay').remove();
}

// Format Numbers
function formatNumber(num) {
    return new Intl.NumberFormat().format(num);
}

// Format Date
function formatDate(dateString) {
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
}

// Truncate Text
function truncateText(text, maxLength) {
    if (text.length <= maxLength) {
        return text;
    }
    return text.substring(0, maxLength) + '...';
}

// Chart.js Default Configuration
if (typeof Chart !== 'undefined') {
    Chart.defaults.global.defaultFontFamily = 'Source Sans Pro, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
    Chart.defaults.global.defaultFontSize = 13;
    Chart.defaults.global.defaultFontColor = '#6c757d';
    
    Chart.defaults.global.elements.line.borderWidth = 2;
    Chart.defaults.global.elements.point.radius = 4;
    Chart.defaults.global.elements.point.hoverRadius = 6;
}

// Initialize dark mode
function toggleDarkMode() {
    $('body').toggleClass('dark-mode');
    var isDarkMode = $('body').hasClass('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
}

// Restore dark mode preference
$(document).ready(function() {
    var isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        $('body').addClass('dark-mode');
    }
});