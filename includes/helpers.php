<?php
// Helper functions for anime data
function getAnimeImage($poster) {
    if ($poster && file_exists('assets/images/anime/' . $poster)) {
        return asset_url('images/anime/' . $poster);
    }
    return asset_url('images/no-image.jpg');
}

function formatEpisodeNumber($count) {
    return $count > 0 ? "Episode $count" : "Coming Soon";
}

function formatReleaseDate($date) {
    return date('j M', strtotime($date));
}

function getDaysAgo($date) {
    return floor((time() - strtotime($date)) / (60 * 60 * 24));
}

function formatRating($rating) {
    return number_format($rating, 2);
}
?>