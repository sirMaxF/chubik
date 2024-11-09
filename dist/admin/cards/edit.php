<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ' . '../../index.php');
}
?>
<?php include('../../app/controllers/cards.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include(__DIR__ . '/../../app/include/head.php'); ?>

<body>
    <!-- <?php include(__DIR__ . '/../../app/include/header.php'); ?> -->
    <main class="obshiy">
        <div class="obshiy__container container">
            <?php while ($singleTovar = $result->fetchArray(SQLITE3_ASSOC)) : ?>

                <h1 class="obshiy__title">Товар арт. <?= $singleTovar['artikul'] ?? '' ?></h1>
                <h2 class="obshiy__subtitle">Страница редактирования карточки товара</h2>
                <div class="filters">Фильтры</div>

                <div class="obshiy__grid select">
                    <div class="select__forms forms select__forms_admin">
                        <?php include_once('../menu.php') ?>
                    </div>
                    <div class="select__positions select__positions_admin">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="edit" id="" value="<?= $singleTovar['id'] ?? '' ?>">

                            <p><label for="name">Название</label></p>
                            <p><input type="text" name="name" id="name" maxlength="2000" minlength="3" value="<?= $singleTovar['name'] ?? '' ?>"></p>
                            <p><label for="price">Цена</label></p>
                            <p><input type="number" name="price" id="price" pattern="[0-9]" value="<?= $singleTovar['price'] ?? '' ?>"></p>
                            <p><label for="artikul">Артикул</label></p>
                            <p><input type="number" name="artikul" id="artikul" pattern="[0-9]" value="<?= $singleTovar['artikul'] ?? '' ?>" required></p>

                            <p><label for="opis">Описание</label></p>
                            <p><textarea rows="10" wrap="hard" cols="50" name="opis" id="opis" maxlength="20000" minlength="3"><?= $singleTovar['opis'] ?? '' ?></textarea></p>

                            <p><label for="size">Размер</label></p>
                            <span>для выбора нескольких значений зажмите Ctrl</span>
                            <p>
                                <select name="size[]" id="size" multiple style="height:100px" required>
                                    <?php for ($i = 60; $i < 125; $i++): ?>
                                        <option <?php
                                                $arr = explode(',', $singleTovar['size']);
                                                if (in_array($i, $arr)) echo 'selected'; ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                                <!-- <select name="size[]" id="size" multiple style="height:100px">
                                    <?php foreach ($allSizes as $key => $value) : ?>
                                        <option <?php
                                                $arr = explode(',', $singleTovar['size']);
                                                if (in_array($value, $arr)) echo 'selected'; ?>>
                                            <?= $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select> -->
                            </p>
                            <p><label for="nalichie">Наличие </label><span>&nbsp;&nbsp;&nbsp;</span> <input type="checkbox" name="nalichie" id="nalichie" value="1" <?php if ($singleTovar['nalichie'] === 1) echo 'checked' ?>></p>
                            <!-- <p><?php if ($singleTovar['nalichie'] === 1) echo '   В наличии' ?></p> -->
                            <p><label for="coll">Коллекция</label></p>
                            <p>
                                <select name="coll" id="coll">
                                    <option>Верхняя одежда</option>
                                    <option>Коллекция из лапши</option>
                                    <option>Лето</option>
                                    <option>Флис и интерсофт</option>
                                </select>
                            </p>

                            <p><label for="type">Вид товара</label></p>
                            <p>
                                <select name="type" id="">
                                    <option disabled selected>Выберите тип товара</option>
                                    <option>Интесофт</option>
                                    <option>Стеганая куртка</option>
                                    <option>Стеганый штаны</option>
                                    <option>Комбинезон из мембраны</option>
                                    <option>Костюм из вафли</option>
                                    <option>Костюм из лапши</option>
                                    <option>Костюм из флиса</option>
                                </select>
                            </p>

                            <p>Крупные изображения</p>
                            <p>
                                <input type="file" name="img[]" id="">
                                <input type="file" name="img[]" id="">
                                <input type="file" name="img[]" id="">
                            </p>

                            <p>Мелкие изображения</p>
                            <p>
                                <input type="file" name="img[]" id="">
                                <input type="file" name="img[]" id="">
                                <input type="file" name="img[]" id="">
                                <input type="file" name="img[]" id="">
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