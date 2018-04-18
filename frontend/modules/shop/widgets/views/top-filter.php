<div class="shop__filter-search">

    <div class="shop__filter-search--price">
        цена
        <input class="filter-price-min price-filter" type="number" name="minPrice" placeholder="мин"
               value="<?= (isset($get['minPrice'])) ? $get['minPrice'] : '' ?>">
        -
        <input  class="filter-price-max price-filter" type="number" name="maxPrice" placeholder="макс"
                value="<?= (isset($get['maxPrice'])) ? $get['maxPrice'] : ''?>">
    </div>



    <div class="shop__filter-search--check">
        <label class="sale-filter">Товары со скидкой
            <input type="checkbox" name="saleFilter" class="saleFilter" <?= (isset($get['saleFilter'])) ? 'checked' : ''?>>
            <span class="checkmark"></span>
        </label>
    </div>

    <div class="shop__filter-search--select">
        <label for="select">Сортировать по:</label>
        <select id="select" class="sortFilter">
            <option value="default">по умолчанию</option>
            <option value="cheap">от дешевых к дорогим</option>
            <option value="expensive">от дорогих к дешевым</option>
        </select>
    </div>
    <div class="shop__filter-search--check">
        <label class="sale-filter">Показывать только новые
            <input type="checkbox">
            <span class="checkmark"></span>
        </label>
    </div>

</div>