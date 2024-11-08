<header class="header">
    <div class="header__container container">
        <div class="header__grid">
            <a href="<?= BASE_URL ?>index.php" class="header__logo">
                <img src="<?= BASE_URL ?>assets/img/logo.png" alt="">
            </a>
            <nav class="header__menu menu">
                <div class="menu__icon">☰</div>

                <div class="menu__row">
                    <a data-dest='footer' class="menu__item">О нас</a>
                    <div src="" class="menu__item" data-cat='cat'>Каталог<div class="arrow">></div>
                        <div class="menu__submenu submenu">
                            <a href="<?= BASE_URL ?>obshchiy-katalog.php" class="submenu__item">Общий каталог</a>
                            <a href="<?= BASE_URL ?>verhnyaya-odezhda.php" class="submenu__item">Верхняя одежда</a>
                            <a href="<?= BASE_URL ?>flis-i-intersoft.php" class="submenu__item">Флис и интерсофт</a>
                            <a href="<?= BASE_URL ?>odezhda-iz-lapshi.php" class="submenu__item">Лапша</a>
                            <a href="<?= BASE_URL ?>letnyaya-odezhda.php" class="submenu__item">Лето</a>
                        </div>
                    </div>

                    <a data-dest='gallery' href="" class="menu__item">Галерея</a>
                    <a data-dest='dostavka' href="" class="menu__item">Доставка</a>
                    <a data-dest='dostavka' href="" class="menu__item">Возврат</a>
                    <a data-dest='footer' href="" class="menu__item">Контакты</a>
                </div>
            </nav>
            <div class="header__social social">
                <div class="social__row">
                    <a href="" class="social__item"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#tel" alt=""></a>
                    <a href="" class="social__item"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#vk" alt=""></a>
                    <a href="" class="social__item"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#insta" alt=""></a>
                    <a href="" class="social__item"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#email" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</header>