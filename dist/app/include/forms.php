                    <div class="forms__close">✘</div>

                    <form action="" name="obsch">
                        <div id="razdel">
                            <p class="forms__title">Раздел</p>
                            <input type="checkbox" class="custom-checkbox" id="verh" name="collection" value="Верхняя одежда">
                            <label for="verh">Верхняя одежда</label>

                            <input type="checkbox" class="custom-checkbox" id="lap" name="collection" value="Коллекция из лапши">
                            <label for="lap">Коллекция из лапши</label>
                            <input type="checkbox" class="custom-checkbox" id="leto" name="collection" value="Лето">
                            <label for="leto">Лето</label>

                            <input type="checkbox" class="custom-checkbox" id="flis" name="collection" value="Флис и интерсофт">
                            <label for="flis">Флис и интерсофт</label>
                        </div>


                        <p class="forms__title">Цена <span></span></p>
                        <span>0</span> <input type="range" min="0" max="5000" step="10" value="5000" name="price">
                        <span>5000</span>
                        <!-- <span><?= $minPrice ?></span> <input type="range" min="<?= $minPrice ?>" max="<?= $maxPrice ?>" step="10" value="<?= $maxPrice ?>" name="price">
                        <span><?= $maxPrice ?></span> -->
                        <!-- <?= $maxPrice ?> -->

                        <p class="forms__title">Размер</p>
                        <p class="forms__rzm">
                            <?php foreach ($allSizes as $key => $value): ?>
                                <input type="checkbox" class="custom-checkbox" id="<?= $value ?>" name="razmer" value="<?= $value ?>">
                                <label for="<?= $value ?>"><?= $value ?></label>
                            <?php endforeach; ?>
                        </p>
                        <p class="forms__title">Вид товара</p>
                        <input type="checkbox" class="custom-checkbox" id="intsf" name="vid" value="intsf">
                        <label for="intsf">Интесофт</label>
                        <input type="checkbox" class="custom-checkbox" id="stgn" name="vid" value="stgn">
                        <label for="stgn">Стеганая куртка</label>
                        <input type="checkbox" class="custom-checkbox" id="stgnshtn" name="vid" value="stgnshtn">
                        <label for="stgnshtn">Стеганый штаны</label>
                        <input type="checkbox" class="custom-checkbox" id="mbn" name="vid" value="mbn">
                        <label for="mbn">Комбинезон из мембраны</label>
                        <input type="checkbox" class="custom-checkbox" id="vfl" name="vid" value="vfl">
                        <label for="vfl">Костюм из вафли</label>
                        <input type="checkbox" class="custom-checkbox" id="lph" name="vid" value="lph">
                        <label for="lph">Костюм из лапши</label>
                        <input type="checkbox" class="custom-checkbox" id="fls" name="vid" value="fls">
                        <label for="fls">Костюм из флиса</label>

                        <p class="forms__title">Наличие</p>
                        <input type="checkbox" class="custom-checkbox" id="nlch" name="nlch" value="yes">
                        <label for="nlch">Только товары в наличии</label>
                    </form>