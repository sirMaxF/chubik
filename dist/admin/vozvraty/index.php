<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ' . '../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include(__DIR__ . '/../../app/include/head.php'); ?>
<?php include('../../app/controllers/vozvraty.php'); ?>


<body>
    <!-- <?php include(__DIR__ . '/../../app/include/header.php'); ?> -->
    <main class="obshiy">
        <div class="obshiy__container container">

            <h1 class="obshiy__title">Возвраты</h1>
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
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Почта</th>
                                <th>Время заявки</th>
                                <th>Исполнен? <span style="font-size: 11px;"><br> (нажмите на иконку для<br> изменения статуса)</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rowVozvraty = $stmtMain->fetchArray(SQLITE3_ASSOC)): ?>
                                <tr>
                                    <td><?= $rowVozvraty['id'] ?? '' ?></td>
                                    <td><?= $rowVozvraty['name'] ?? '' ?></td>
                                    <td><?= $rowVozvraty['phone'] ?? '' ?></td>
                                    <td><?= getUserZ($connect, $rowVozvraty['id_user'])['email'] ?? '' ?></td>
                                    <td><?= $rowVozvraty['time'] ?? '' ?></td>

                                    <!-- <td><a href="view.php?idEdit=<?= $rowVozvraty['id'] ?>">🔎</a></td> -->
                                    <td><a href="index.php?idDone=<?= $rowVozvraty['id'] ?>&done=<?= $rowVozvraty['done'] ?>"><?php if ($rowVozvraty['done'] === 1) {
                                                                                                                                    echo '✅';
                                                                                                                                } else {
                                                                                                                                    echo  '⛔';
                                                                                                                                } ?></a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </main>

    <script src=" <?= BASE_URL ?>assets/js/app.min.js"></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js
    "></script>
</body>


</html>