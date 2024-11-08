<!DOCTYPE html>
<html lang="en">
<?php include('app/include/head.php'); ?>
<?php include('app/controllers/images.php'); ?>


<body>
  <?php include('app/include/header.php'); ?>
  <main class="main">
    <div class="main__carousel carousel">
      <div class="carousel__item _active"><img src="<?= BASE_URL ?>assets/img/<?= $glvn ?>" alt=""></div>
      <!-- <div class="carousel__item "><img src="<?= BASE_URL ?>assets/img/bbb.webp" alt=""></div> -->
      <div class="carousel__text text">
        <div class="text__title">Стиль и комфорт для самых любимых</div>
        <div class="text__subtitle">Наша основная цель — это комфорт и эстетика, которые сочетаются в нашей одежде</div>
        <a href="<?= BASE_URL ?>obshchiy-katalog.php" class="text__button">Смотреть каталогг</a>
      </div>
    </div>
    <!-- </div> -->
  </main>
  <section class="katalog">
    <div class="katalog__container container">
      <div class="katalog__title">Каталог товаров</div>
      <div class="katalog__grid elements">
        <a href="<?= BASE_URL ?>flis-i-intersoft.php" class="katalog__element">
          <img src="<?= BASE_URL ?>assets/img/<?= $katalog_1 ?>" alt="">
          <div class="katalog__link">Флис и интерсофт ↗</div>
        </a>
        <a href="<?= BASE_URL ?>letnyaya-odezhda.php" class="katalog__element">
          <img src="<?= BASE_URL ?>assets/img/<?= $katalog_2 ?>" alt="">
          <div class="katalog__link">Летняя коллекция ↗</div>
        </a>
        <a href="<?= BASE_URL ?>verhnyaya-odezhda.php" class="katalog__element">
          <img src="<?= BASE_URL ?>assets/img/<?= $katalog_3 ?>" alt="">
          <div class="katalog__link">Верхняя одежда ↗</div>
        </a>
        <a href="<?= BASE_URL ?>odezhda-iz-lapshi.php" class="katalog__element">
          <img src="<?= BASE_URL ?>assets/img/<?= $katalog_4 ?>" alt="">
          <div class="katalog__link">Коллекция из лапши ↗</div>
        </a>
      </div>
    </div>
  </section>
  <section class="presentation">
    <div class="presentation__container container">
      <div class="presentation__top top">
        <div class="top__left">Рады представить наш бренд детской одежды Choubik!</div>
        <div class="top__right">Мы не просто создаем одежду, мы создаем семейную традицию.</div>
      </div>
      <div class="presentation__grid cards">
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img-2.png" alt="">
          </div>
          <div class="cards__text">Мы создаем одежду с любовью и заботой о детях и их родителях. Наша основная цель —
            это комфорт и эстетика, которые сочетаются в нашей одежде</div>
        </div>
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img.png" alt="">
          </div>
          <div class="cards__text">Мы не стремимся следовать краткосрочным трендам, а наша философия — это рациональное
            потребление и устойчивая мода</div>
        </div>
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img-3.png" alt="">
          </div>
          <div class="cards__text">Наша одежда изготовлена из натуральных, приятных к телу материалов, которые не только
            обеспечивают комфорт, но и защищают детскую кожу</div>
        </div>
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img-4.png" alt="">
          </div>
          <div class="cards__text">Мы уверены, что наша одежда станет отличным дополнением к любому гардеробу. Каждый
            элемент нашей коллекции универсален и подходит для любых повседневных ситуаций</div>
        </div>
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img-6.png" alt="">
          </div>
          <div class="cards__text">Верхняя одежда произведена из износостойких и долговечных материалов, которые можно
            носить год за годом, передавать друзьям или младшим детям</div>
        </div>
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img-1.png" alt="">
          </div>
          <div class="cards__text">Мы учитываем все требования, которые предъявляются к детской одежде, и уверены, что
            наши изделия будут радовать вас и ваших детей</div>
        </div>
        <div class="cards__item">
          <div class="cards__icon">
            <img src="<?= BASE_URL ?>assets/img/img.tn-atom__img-5.png" alt="">
          </div>
          <div class="cards__text">Мы гарантируем высокое качество и надежность продукции. Присоединяйтесь к большой
            семье Choubik и позвольте нам заботиться о вашей детской одежде!</div>
        </div>
      </div>
    </div>
  </section>
  <section id="gallery" class="gallery">
    <div class="gallery__container container">
      <div class="gallery__title">Живые фото нашей одежды</div>
      <div class="scroller" data-speed="fast">
        <div class="scroller__inner">
          <?php
          $files = scandir('./assets/img/', 0);
          for ($i = 2; $i < count($files); $i++) :
          ?>
            <?php if (filesize('assets/img/' . $files[$i]) > 10480): ?>

              <img src="./assets/img/<?= $files[$i] ?>" alt="" />
            <?php endif; ?>

          <?php endfor; ?>
        </div>
      </div>

      <div class="scroller" data-direction="right" data-speed="slow">
        <div class="scroller__inner">
          <?php
          $files = scandir('./assets/img/', 0);
          for ($i = 2; $i < count($files); $i++) :
          ?>
            <?php if (filesize('assets/img/' . $files[$i]) > 10480): ?>
              <img src="./assets/img/<?= $files[$i] ?>" alt="" />
            <?php endif; ?>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>
  <section id="dostavka" class="dostavka">
    <div class="dostavka__container container">
      <div class="dostavka__details details">
        <div class="details__title">Доставка</div>
        <div class="details__row">
          <div class="details__item">
            <div class="details__top">Курьерская доставка</div>
            <div class="details__bottom">Стоимость: 350₽ <br> При заказе от 8.000₽ доставка бесплатная <br> Сроки: от 2
              до 5 рабочих дней</div>
          </div>
          <div class="details__item">
            <div class="details__top">Экспресс доставка (Москва)</div>
            <div class="details__bottom">Стоимость: 500₽ <br> Сроки: в течение дня</div>
          </div>
          <div class="details__item">
            <div class="details__top">Возврат</div>
            <div class="details__bottom">Заказ можно полностью или частично вернуть в течение 14 дней со дня получения в
              надлежащем виде.</div>
            <div class="details__button">Оставить заявку</div>
            <!-- попап -->
            <div id="vozvrat" class="vozvrat">
              <div class="vozvrat__overlay">

                <div class="vozvrat__container">
                  <div class="vozvrat__title">Заявка на возврат товара</div>
                  <div class="vozvrat__text">Введите свои данные и мы свяжемся с вами для обсуждения деталей
                  </div>
                  <div id="vozvratUspMsg">Заявка успешно создана!</div>
                  <form name="vernut">
                    <input type="text" name="text" id="" placeholder="Ваше имя" minlength="3" maxlength="20" required>
                    <input type="tel" name="tel" id="" placeholder="Ваш телефон" required>
                    <input type="email" name="email" id="" placeholder="Ваша почта" required>
                    <div id="vozvratMsg">Покупатель с такой почтой не найден</div>
                    <input type="submit" name="" id="" value="Оставить заявку">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <?php include('app/include/footer.php'); ?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="<?= BASE_URL ?>assets/js/app.min.js"></script>
</body>


</html>