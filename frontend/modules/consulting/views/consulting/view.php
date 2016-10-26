
    <div class="consult-item">
        <div class="consult-item-mnu">
<!--            <img src="--><?//= $consulting->icon; ?><!--" alt="" class="consult-img">-->
            <p class="consult-img">
                <i class="fa <?= $consulting->icon; ?>"></i>
            </p>
            <h4><?= $consulting->title; ?></h4>
            <div class="shape">
                <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
            </div>
            <ul class="consult-item-mnu-menu">
                <li><a href=""><span class="marker"></span>О компании</a></li>
                <li><a href="#"><span class="marker"></span>Нормативно-правовые и законодательные акты</a></li>
                <li><a href="#"><span class="marker"></span>Статьи</a></li>
                <li><a href="#"><span class="marker"></span>Налоговый раздел</a></li>
                <li><a href="#"><span class="marker"></span>Вопрос / ответ</a></li>
            </ul>
        </div>
        <div class="consult-item-content">
            <h4 class="company-title">"<?=$company->name; ?>"</h4>
            <p class="company-descr"><?=$company->descr; ?></p>
            <img src="/theme/portal-donbassa/img/map.png" class="company-map" alt="">
            <p class="company-location"><?= $company->address; ?></p>
            <p class="company-phone"><?= $company->phone; ?></p>
        </div>
    </div>
