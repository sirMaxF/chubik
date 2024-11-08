<!DOCTYPE html>
<html lang="en">
<?php include('app/include/head.php'); ?>
<?php include('app/controllers/cards.php'); ?>


<body>
    <?php include('app/include/header.php'); ?>
    <?php include('app/include/cart.php') ?>

    <main class="obshiy">

        <div class="obshiy__container container">
            <!-- <div id="vozvrat" class="vozvrat vozvrat_single vozvrat_obsch">
                <div class="vozvrat__overlay">
                    <div class="vozvrat__container vozvrat__container_single">
                        Товара нет в наличии!
                    </div>
                </div>
            </div> -->
            <div class="obshiy__cart">
                <div class="obshiy__indicator">5</div>

                🛒
            </div>

            <h1 class="obshiy__title">Общий каталог</h1>
            <h2 class="obshiy__subtitle">Тут вы найдете одежду для нашего ребенка из всех наших коллекций!
                <div class="select__icon">
                    <img src="./assets/img/photo.gif" alt="">
                </div>
            </h2>
            <div class="filters">Фильтры</div>

            <div class="obshiy__grid select">

                <div class="select__forms forms">
                    <?php include('app/include/forms.php'); ?>
                </div>
                <div class="select__positions">
                    <!-- <?php while ($rowCards = $stmtMain->fetchArray(SQLITE3_ASSOC)): ?>
                        <div class="position">
                            <div class="position__image"><img src="<?= BASE_URL ?>assets/img/<?= $rowCards['img_1'] ?? '' ?>" alt=""></div>
                            <div class="position__title"><?= $rowCards['name'] ?? '' ?></div>
                            <div class="position__price"><?= $rowCards['price'] ?? '' ?> руб</div>
                            <div class="position__button">Выбрать размер</div>
                        </div>
                    <?php endwhile; ?> -->
                </div>

            </div>
        </div>
    </main>



    <?php include('app/include/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="http://cdn.jsdelivr.net/npm/suggestions-jquery@22.6.0/dist/js/jquery.suggestions.min.js"></script>
    <!-- <script src="https://securepay.tinkoff.ru/html/payForm/js/tinkoff_v2.js"></script> -->
    <script src="<?= BASE_URL ?>assets/js/app.min.js"></script>

</body>


</html>