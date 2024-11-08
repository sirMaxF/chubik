<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ' . '../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include(__DIR__ . '/../../app/include/head.php'); ?>
<?php include('../../app/controllers/images.php'); ?>


<body>
    <!-- <?php include(__DIR__ . '/../../app/include/header.php'); ?> -->
    <main class="obshiy">
        <div class="obshiy__container container">

            <h1 class="obshiy__title">Карточки товаров</h1>
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
                                <th>Изображение</th>
                                <th>Где находится</th>
                                <th>Редактировать</th>
                                <!-- <th>Удалить</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rowImages = $stmtMain->fetchArray(SQLITE3_ASSOC)): ?>
                                <tr>
                                    <td><?= $rowImages['id'] ?? '' ?></td>
                                    <td>
                                        <div class="sample"><img src="../../assets/img/<?= $rowImages['url'] ?? '' ?>" alt=""></div>
                                    </td>
                                    <td><?= $rowImages['where'] ?? '' ?></td>
                                    <td><a href="edit.php?idEdit=<?= $rowImages['id'] ?>">🖉</a></td>
                                    <!-- <td><a href="index.php?idDel=<?= $rowImages['id'] ?>">❌</a></td> -->
                                </tr>
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


</html>