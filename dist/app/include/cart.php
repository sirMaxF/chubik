           <?php
            //    include(__DIR__ . '../../app/controllers/cards.php'); 
            ?>

           <!-- попап -->
           <div id="vozvrat" class="vozvrat vozvrat_cart">
               <div class="vozvrat__overlay vozvrat__overlay_cart">

                   <div class="vozvrat__container vozvrat__container_cart">
                       <div class="popnew__close"><img src="<?= BASE_URL ?>assets/img/icons/icons.svg#close" alt=""></div>
                       <div class="vozvrat__title">Ваш заказ</div>
                       <form action="" name="cartform">
                           <div class="vozvrat__tovar tovar">
                               <!-- <div class="tovar__grid">
                                   <div class="tovar__image"><img src="assets/img/aaa.jpg" alt=""></div>
                                   <div class="tovar__name">
                                       <div class="tovar__title">Название</div>
                                       <div class="tovar__subtitle">
                                           <div class="tovar__data">Размер</div>
                                           <div class="tovar__data">Вид товара</div>
                                           <div class="tovar__data">Артикул</div>
                                       </div>

                                   </div>
                                   <div class="tovar__kolvo">
                                       <div class="cart-plus-minus">
                                           <input type="text" name="quantity" value="1">
                                       </div>
                                   </div>
                                   <div class="tovar__price">2100 р</div>
                                   <div class="tovar__del">❌</div>
                               </div> -->
                           </div>

                           <div class="vozvrat__title vozvrat__title_itogo"></div>


                           <input type="text" name="name" id="" placeholder="Ваше имя" minlength="3" maxlength="20" required>
                           <input type="tel" name="phone" id="" placeholder="Ваш телефон" required>
                           <input type="email" name="email" id="" placeholder="Ваша почта" required>


                           <div class="vozvrat__subtitle">Доставка</div>

                           <!-- <label for="city">Город / населенный пункт:</label> -->
                           <input id="city" name="city" type="text" placeholder="Город / населенный пункт" minlength="3" maxlength="30" required />
                           <!-- <br><br> -->
                           <!-- <label for="address">Улица, дом, квартира:</label> -->
                           <input id="address" name="address" type="text" placeholder="Улица, дом, квартира" minlength="3" maxlength="150" required />

                           <div class="vozvrat__radio">
                               <p>
                                   <input type="radio" name="dostavka" id="cdek" value="cdek">
                                   <label for="cdek">Доставка CDEK <span>от 2 дней, 350 р.</span></label>
                               </p>
                               <p>
                                   <input type="radio" name="dostavka" id="kurer" value="kurer">
                                   <label for="kurer">Курьерская служба <span>от 1 дня 500 р.</span></label>
                               </p>
                               <p>
                                   <input type="radio" name="dostavka" id="express" value="express">
                                   <label for="express">Экспресс-доставка (Москва) <span>от 1 дня 500 р.</span></label>
                               </p>
                           </div>

                           <input type="text" name="fio" id="" placeholder="ФИО получателя" minlength="3" maxlength="200" required>
                           <input type="text" name="comm" id="" placeholder="Комментарий" minlength="3" maxlength="200" required>

                           <input type="submit" name="" id="" value="Оплатить заказ">
                       </form>
                       <form class="payform-tbank" id="payformTbank" name="payform-tbank" onsubmit="pay(this); return false;">
                           <input class="payform-tbank-row" type="hidden" name="terminalkey" value="TBankTest">
                           <input class="payform-tbank-row" type="hidden" name="frame" value="false">
                           <input class="payform-tbank-row" type="hidden" name="language" value="ru">
                           <input class="payform-tbank-row" type="text" placeholder="Сумма заказа" name="amount" required>
                           <input class="payform-tbank-row" type="hidden" placeholder="Номер заказа" name="order">
                           <input class="payform-tbank-row" type="text" placeholder="Описание заказа" name="description">
                           <input class="payform-tbank-row" type="text" placeholder="ФИО плательщика" name="name">
                           <input class="payform-tbank-row" type="email" placeholder="E-mail" name="email">
                           <input class="payform-tbank-row" type="tel" placeholder="Контактный телефон" name="phone">
                           <input class="payform-tbank-row payform-tbank-btn" type="submit" name="oplatit" value="Оплатить">
                       </form>
                   </div>
               </div>
           </div>