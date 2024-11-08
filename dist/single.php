<!DOCTYPE html>
<html lang="en">
<?php include('app/include/head.php'); ?>
<?php include('app/controllers/cards.php'); ?>
<?php
// print_r($forSingle);
?>

<body>

    <main class="single">
        <div id="vozvrat" class="vozvrat vozvrat_single">
            <div class="vozvrat__overlay">
                <div class="vozvrat__container vozvrat__container_single">
                    Товар добавлен в корзину
                </div>
            </div>
        </div>
        <div class="single__return">← Вернуться назад</div>

        <div class="single__flex">

            <div class="single__kartinki kartinki">
                <div class="kartinki__big square">
                    <img src="" alt="" class="uvel">
                    <div class="kartinki__prkl kartinki__prkl_left"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#left" alt=""></div>
                    <div class="kartinki__prkl kartinki__prkl_right"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#right" alt="">
                    </div>
                    <!-- <div class="image-zoom-block"></div> -->


                </div>
                <div id="popnew" class="popnew">

                    <div class="popnew__overlay">
                        <div class="popnew__container">
                            <div class="popnew__close"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#close" alt=""></div>

                        </div>
                    </div>
                </div>
                <div class="kartinki__row">
                    <div class="kartinki__small"><img src="<?= BASE_URL ?>assets/img/<?= $forSingle[0]['img_1'] ?? '' ?>" alt=""></div>
                    <div class="kartinki__small"><img src="<?= BASE_URL ?>assets/img/<?= $forSingle[0]['img_2'] ?? '' ?>" alt=""></div>
                    <div class="kartinki__small"><img src="<?= BASE_URL ?>assets/img/<?= $forSingle[0]['img_3'] ?? '' ?>" alt=""></div>
                </div>
            </div>
            <div class="single__descr descr">
                <div class="descr__title"><?= $forSingle[0]['name'] ?? '' ?></div>
                <div class="descr__subtitle">CHOUBIK</div>
                <div class="descr__artikul">Артикул: <?= $forSingle[0]['artikul'] ?? '' ?></div>
                <div class="descr__price"><?= $forSingle[0]['price'] ?? '' ?> р</div>
                <form action="" name="singleForm">
                    <p>Размер</p>
                    <select id="" size="1" name="size">
                        <?php $sizes = explode(',', $forSingle[0]['size']) ?>
                        <?php foreach ($sizes as $key => $value) : ?>
                            <option><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- <p>Вид товара</p>
                    <select name="raz2" id="" size="1">
                        <option>Костюм из лапши</option>
                    </select> -->
                    <p><input type="submit" name="" id="" value="Купить" class=""></p>
                </form>
                <div class="descr__text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus reiciendis
                    tempora sequi provident, velit, cupiditate officiis sunt voluptatibus vel ea aliquid, cumque odit!
                    Maxime, dolorum. Corrupti necessitatibus, debitis dolore aliquam, quas corporis nemo quibusdam optio
                    labore, dolores maiores expedita laboriosam eaque! Cumque blanditiis at ipsa reiciendis cum eum
                    soluta dignissimos?</div>
            </div>
        </div>
    </main>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="
    https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js
    "></script>
    <script src="<?= BASE_URL ?>assets/js/app.min.js"></script>
    <script>
        try {
            const singleForm = document.forms.singleForm;
            const vozvraSingle = document.querySelector('.vozvrat_single');
            const vozvratContainerSingle = document.querySelector('.vozvrat__container_single')

            // записываем данные для отправки в корзину
            const params = new URLSearchParams(window.location.search);
            const cartId = params.get('singleId');
            const nalichie = params.get('nalichie');

            console.log(nalichie)

            if (nalichie == 0) {
                vozvraSingle.style.display = 'block';
                vozvratContainerSingle.textContent = 'Товара нет в наличии'

                setTimeout(() => {
                    vozvraSingle.style.display = 'none';
                    window.history.back();
                }, 2000);

                // return false;
            }

            const cartData = {
                'id': cartId,
                'size': singleForm.size.value,
                'kolvo': 1
            };

            // console.log(cartData)


            singleForm.addEventListener('submit', (e) => {
                e.preventDefault();

                // работа с localStorage
                let cartStorage = JSON.parse(window.localStorage.getItem('korzina')) || [];

                if (cartStorage.length >= 3) {
                    vozvraSingle.style.display = 'block';
                    vozvratContainerSingle.textContent = 'Больше добавить в корзину нельзя!'

                    setTimeout(() => {
                        vozvraSingle.style.display = 'none';
                        window.history.back();
                    }, 2000);

                    return false;
                }

                // проверем есть ли такой товар в корзине уже

                let find = 0;
                for (const key in cartStorage) {
                    if (Object.prototype.hasOwnProperty.call(cartStorage, key)) {

                        if (cartStorage[key].id === cartData.id) {
                            // alert('Товар уже в корзине!')
                            find = 1;

                            vozvraSingle.style.display = 'block';
                            vozvratContainerSingle.textContent = 'Товар уже в корзине!'

                            setTimeout(() => {
                                vozvraSingle.style.display = 'none';
                                window.history.back();
                            }, 2000);

                            return false;
                        } else {

                        }
                        // sum = sum + (['price'] * korzina[key].kolvo);
                        // cartArrLocal.push((posts
                        //     .filter(cartpost => (cartpost.id == korzina[key].id))[0]))
                    }
                }

                if (find === 0) {
                    cartStorage.push(cartData);
                    window.localStorage.setItem('korzina', JSON.stringify(cartStorage));
                    vozvraSingle.style.display = 'block';


                    setTimeout(() => {
                        vozvraSingle.style.display = 'none';
                        window.location.replace('obshchiy-katalog.php');
                    }, 1000);
                }


            })
        } catch (error) {

        }
    </script>
</body>


</html>