<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ' . '../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include(__DIR__ . '/../../app/include/head.php'); ?>
<?php include('../../app/controllers/orders.php'); ?>

<body>
    <!-- <?php include(__DIR__ . '/../../app/include/header.php'); ?> -->
    <main class="obshiy">
        <div class="obshiy__container container">

            <h1 class="obshiy__title">Заказы</h1>
            <h2 class="obshiy__subtitle">Страница карточки заказа</h2>
            <div class="filters">Фильтры</div>

            <div class="obshiy__grid select">
                <div class="select__forms forms select__forms_admin">
                    <?php include_once('../menu.php') ?>
                </div>
                <div class="select__positions select__positions_admin">
                    <?php while ($singleZakaz = $result->fetchArray(SQLITE3_ASSOC)) : ?>
                        <p>Данные о товарах</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Артикул</th>
                                    <th>Количество</th>
                                    <th>Размер</th>
                                    <th>Подробнее</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i < 4; $i++): ?>
                                    <?php if (isset($singleZakaz['id_tovar_' . $i])): ?>
                                        <tr>
                                            <td>
                                                <div class="sample"><img src="../../assets/img/<?= getOrder($connect, $singleZakaz['id_tovar_' . $i])['img_1'] ?>" alt=""></div>
                                            </td>
                                            <td><?= getOrder($connect, $singleZakaz['id_tovar_' . $i])['artikul'] ?? '' ?></td>

                                            <!-- <td><a href="../cards/edit.php?idEdit=<?= $singleZakaz['id_tovar_' . $i] . ' ' ?? '' ?>"><?= $singleZakaz['id_tovar_' . $i] ?? '' ?> ↗</a></td> -->
                                            <td><?= $singleZakaz['kolvo_' . $i] ?? '' ?></td>
                                            <td><?= $singleZakaz['size_' . $i] ?? '' ?></td>
                                            <td><a href="../cards/edit.php?idEdit=<?= $singleZakaz['id_tovar_' . $i] . ' ' ?? '' ?>">См карту товара</a></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endfor; ?>

                            </tbody>
                        </table>
                        <p>Данные о покупателе</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Почта</th>
                                    <th>Телефон</th>
                                    <th>Время первой покупки</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?= getUserZ($connect, $singleZakaz['user_id'])['name'] ?? '' ?></td>
                                    <td><?= getUserZ($connect, $singleZakaz['user_id'])['email'] ?? '' ?></td>
                                    <td><?= getUserZ($connect, $singleZakaz['user_id'])['phone'] ?? '' ?></td>
                                    <td><?= getUserZ($connect, $singleZakaz['user_id'])['time'] ?? '' ?></td>
                                </tr>


                            </tbody>
                        </table>
                        <p>Данные о доставке</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Способ</th>
                                    <th>Адрес</th>
                                    <th>Получатель</th>
                                    <th>Комментарий</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <?php
                                        switch (getDostavkaZ($connect, $singleZakaz['id_dostavka'])['type']) {
                                            case 'cdek':
                                                echo "СДЭК";
                                                break;
                                            case 'kurer':
                                                echo "Курьер";
                                                break;
                                            case 'express':
                                                echo "Экспресс";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?= getDostavkaZ($connect, $singleZakaz['id_dostavka'])['adress'] ?? '' ?></td>
                                    <td><?= getDostavkaZ($connect, $singleZakaz['id_dostavka'])['fio'] ?? '' ?></td>
                                    <td><?= $singleZakaz['comment'] ?></td>

                                </tr>


                            </tbody>
                        </table>
                    <?php endwhile; ?>
                </div>

            </div>
        </div>
    </main>

    <script src="<?= BASE_URL ?>assets/js/app.min.js"></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js
    "></script>
</body>

</html>