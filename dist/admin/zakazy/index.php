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
            <!-- <a class="admin__button" href="./create.php">Создать</a> -->
            <!-- <h2 class="obshiy__subtitle">Список всех карточек товаров</h2> -->

            <div class="filters">Фильтры</div>

            <div class="obshiy__grid select">
                <div class="select__forms forms select__forms_admin">
                    <?php include_once('../menu.php') ?>
                </div>
                <div class="select__positions select__positions_admin">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Изображение</th>
                                <th>Артикул</th>
                                <th>Количество</th>
                                <th>Размер</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rowOrds = $stmtMain->fetchArray(SQLITE3_ASSOC)): ?>
                                <tr style='background-color: grey; color: white;'>
                                    <td colspan="4">Заказ № <?= $rowOrds['id'] ?? '' ?> суммой <?= $rowOrds['sum'] ?? '' ?> <?= ' ' ?> от <?= $rowOrds['time'] ?? '' ?> <?= ' ' ?> <a href="view.php?idviewZakaz=<?= $rowOrds['id_zakaz'] ?? '' ?>">🔎</a></td>
                                </tr>
                                <?php for ($i = 1; $i < 4; $i++): ?>
                                    <?php if (isset($rowOrds['id_tovar_' . $i])): ?>
                                        <tr>
                                            <td>
                                                <div class="sample"><img src="../../assets/img/<?= getOrder($connect, $rowOrds['id_tovar_' . $i])['img_1'] ?>" alt=""></div>
                                            </td>
                                            <td><?= getOrder($connect, $rowOrds['id_tovar_' . $i])['artikul'] ?? '' ?></td>

                                            <!-- <td><a href="../cards/edit.php?idEdit=<?= $rowOrds['id_tovar_' . $i] . ' ' ?? '' ?>"><?= $rowOrds['id_tovar_' . $i] ?? '' ?> ↗</a></td> -->
                                            <td><?= $rowOrds['kolvo_' . $i] ?? '' ?></td>
                                            <td><?= $rowOrds['size_' . $i] ?? '' ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endfor; ?>

                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </main>

    <script src="<?= BASE_URL ?>assets/js/app.min.js"></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js
    "></script>
</body>


</html