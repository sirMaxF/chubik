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

            <h1 class="obshiy__title">Изображения</h1>
            <h2 class="obshiy__subtitle">Страница редактирования изображения</h2>
            <div class="filters">Фильтры</div>

            <div class="obshiy__grid select">
                <div class="select__forms forms select__forms_admin">
                    <?php include_once('../menu.php') ?>
                </div>
                <div class="select__positions select__positions_admin">
                    <?php while ($singleImage = $result->fetchArray(SQLITE3_ASSOC)) : ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="edit" id="" value="<?= $singleImage['id'] ?? '' ?>">
                            <p>
                            <div class="letsee">
                                <img src="../../assets/img/<?= $singleImage['url'] ?? '' ?>">
                            </div>
                            </p>
                            <p>Изменение изображения</p>
                            <p>
                                <input type="file" name="img" id="">
                            </p>
                            <p><input type="submit" value="Сохранить"></p>
                        </form>
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