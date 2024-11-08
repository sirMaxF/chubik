<?php
include_once(__DIR__ . '/../app/database/path.php');
?>
<div class="tabs">
    <div class="tabs__flex">
        <a class="tabs__item" href="<?= BASE_URL . 'admin/cards/index.php'; ?>">Карточки товаров</a>
        <a class="tabs__item" href="<?= BASE_URL . 'admin/zakazy/index.php'; ?>">Заказы</a>
        <!-- <a class="tabs__item" href="<?= BASE_URL . 'admin/users/index.php'; ?>">Пользователи</a> -->
        <a class="tabs__item" href="<?= BASE_URL . 'admin/images/index.php'; ?>">Изображения</a>
        <a class="tabs__item" href="<?= BASE_URL . 'admin/vozvraty/index.php'; ?>">Заявки на возврат</a>
    </div>
</div>