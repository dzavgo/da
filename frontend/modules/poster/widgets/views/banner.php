<sectiom class="banner-top">
    <div class="container">
        <img src="<?= $mainBannerPoster->poster_image; ?>" alt="">
        <div class="banner-top__wrap">
            <h2><?= $mainBannerPoster->main_poster_title; ?>"</h2>
            <p><?= $mainBannerPoster->main_poster_subtitle; ?></p>
            <span class="banner-date"><?= $mainBannerPoster->main_poster_substrate; ?></span>
        </div>
    </div>
</sectiom>

<?php
$arr = [
    [
        'title' => 'Ожидаемые концерты классической музыки',
        'items' => [
            1,2,3,4,5,6
        ],
    ],
    [
        'title' => 'Лучшие спектакли для детей',
        'items' => [
            3,4,5
        ],
    ],
]
?>