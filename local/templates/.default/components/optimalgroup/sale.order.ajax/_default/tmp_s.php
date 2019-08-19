<div class="cart row">
    <div class="col col-6">
        <div class="cart">
            <form>
                <div class="basket-border">
                    <div class="form-legend text-uppercase">Состав заказа</div>
                    <div class="cart-list">
                        <? foreach ($tmpCart['CART'] as $cartItem):?>
                        <div class="cart-item">
                            <a href="<?=$cartItem['DETAIL_PAGE_URL'];?>" class="cart-item--img loading-bg"><img src="<?=MEDIA_PATH;?>images/counter-img.jpg" alt="<?=$cartItem['NAME'];?>" class="fadeImg img-responsive"></a>
                            <a href="<?=$cartItem['DETAIL_PAGE_URL'];?>" class="cart-item--name"><?=$cartItem['NAME'];?></a>
                            <div class="cart-item--quantity">
                                <div class="form-control--container">
                                   <div class="form-control--quantity">
                                        <i data-type="more">+</i>
                                        <i data-type="less">-</i>
                                    </div>
                                    <input type="text" value="<?=$cartItem['QUANTITY'];?>" class="form-control">
                                </div>
                                <div class="form-control--quantity__piece">шт.</div>
                            </div>
                            <div class="cart-item--price">
                                <div><?=number_format($cartItem['PRICE'],0,'',' ');?> руб.</div>
                                <!--Скидка: 190 руб.-->
                            </div>
                            <a href="#" data-id="<?=$cartItem['ID'];?>" data-action="remove" class="cart-item--remove js-RemoveFromCart"></a>
                        </div>
                        <? endforeach;?>
                        <div class="cart-total text-right">
                            С учётом общей скидки в 380 руб
                            <div>5 240 руб.</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="cart-service--title">Хотите заказать усановку счетчиков в комплекте?</div>
        <div class="cart-service">
            <form>
                <div class="cart-list basket-border">
                    <div class="cart-item">
                        <a href="#" class="cart-item--img loading-bg"><img src="<?=MEDIA_PATH;?>images/counter-img.jpg" alt="" class="fadeImg img-responsive"></a>
                        <a href="#" class="cart-item--name">
                            Счетчик НЕВА МТ 124 AS OP 3 тарифа
                            <span>Опломбируем сразу Оформим и передадим документы</span>
                        </a>
                        <div class="cart-item--quantity">
                            <div class="form-control--container">
                               <div class="form-control--quantity">
                                    <i data-type="more">+</i>
                                    <i data-type="less">-</i>
                                </div>
                                <input type="text" value="1" class="form-control">
                            </div>
                            <div class="form-control--quantity__piece">шт.</div>
                        </div>
                        <div class="cart-item--price text-right">
                            <span>1 310 руб.</span>
                            <div>1 000руб.</div>
                            Скидка: 190 руб.
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col col-6">
        <div class="cart-order">
            <form>
                <div class="basket-border">            
                    <div class="form-legend clearfix text-uppercase">
                        Оформление заказа
                        <a href="#" class="pull-right as-legal dashed">Оформить заказ как юр. лицо</a>
                    </div>
                    <div class="form-group--label">Получатель</div>
                    <div class="form-group">
                        <label class="form-label">Имя Фамилия</label>
                        <input type="text" value="Константин Константиновский" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col col-6">
                            <div class="form-group">
                                <label class="form-label">Электронная почта</label>
                                <input type="text" value="mail@mail.com" class="form-control">
                            </div>
                        </div>
                        <div class="col col-6">
                            <div class="form-group">
                                <label class="form-label">Телефон</label>
                                <input type="text" value="+7 9XX XXX XX XX" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group--label">Доставка</div>
                    <div class="form-group">
                        <ul class="item-list">
                            <li>
                                <div class="radio"><label><input type="radio" name="1" checked><i></i><span>Самовывоз</span></label></div>
                                <div class="radio-text">
                                    <p>ОПиОК - г. Ижевск, ул. Ленина, д 10 / 1</p>
                                    <div><a href="#" class="btn btn-grey-light btn-exsmall">Выбрать другой пункт самовывоза <i class="fa fa-angle-right"></i></a></div>
                                </div>
                                
                            </li>
                            <li>
                                <div class="radio"><label><input type="radio" name="1"><i></i><span>Информация для клиентов</span></label></div>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="form-group--label">Оплата</div>
                    <div class="form-group">
                        <ul class="item-list">
                            <li>
                                <div class="radio"><label><input type="radio" name="2" checked><i></i><span>Онлайн</span></label></div>
                            </li>
                            <li>
                                <div class="radio"><label><input type="radio" name="2"><i></i><span>При получении</span></label></div>
                            </li>
                            <li>
                                <div class="radio"><label><input type="radio" name="2"><i></i><span>Квитанцией в банке</span></label></div>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="form-group">
                        <label class="form-label">Комментарии к заказу</label>
                        <input type="text" value="Домофон не работает, звоните на телефон - открою" class="form-control">
                    </div>
                    <div class="cart-order--total clearfix">
                        <div class="cart-order--total__table pull-left">
                            <table width="100%">
                                <tr><td>Товары с учетом скидки</td><td><span class="color-orange">2 720 руб.</span></td></tr>
                                <tr><td>Доставка</td><td>100 руб.</td></tr>
                            </table>
                        </div>
                        <button class="btn btn-grey w-200 pull-right"><span class="fa-angle-btn">Подтвердить заказ</span></button>
                    </div>
                </div>
                <div class="form-annotation">Нажимая на кнопку, вы подтверждаете свое совершеннолетие, соглашаетесь
на обработку персональных данных в соответствии с <a href="#" class="color-orange">Условиями</a>, <br>
а также с <a href="#" class="color-orange">Условиями продажи</a></div>
            </form>
        </div>
    </div>
</div>