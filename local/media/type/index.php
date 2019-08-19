<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплатить онлайн");
?>
<div class="">
    <div class="z3">Заголовки</div>
    <div class="z1">Заголовки z1,h1</div>
    <div class="z2">Заголовки z2,h2</div>
    <div class="z3">Заголовки z3,h3</div>
    <div class="z4">Заголовки z4,h4</div>
    <div class="z5">Заголовки z5,h5</div>
    <div class="z6">Заголовки z6,h6</div>
    <div class="section-title"><span>Заголовок с линией</span></div>
    <br><br><br>
    <div class="z3">Списки</div>
    <div class="row">
        <div class="col col-6">
            <ul>
                <li>Список</li>
                <li>Список</li>
                <li>Список</li>
                <li>Список</li>
            </ul>
        </div>
        <div class="col col-6">
            <ol>
                <li>Список</li>
                <li>Список</li>
                <li>Список</li>
                <li>Список</li>
            </ol>
        </div>
        <div class="col col-6">
            <ul class="item-list">
                <li class="radio"><label><input type="radio" name="1"><i></i><span>Везде</span></label></li>
                <li class="radio"><label><input type="radio" name="1"><i></i><span>Информация для клиентов</span></label></li>
                <li class="radio"><label><input type="radio" name="1"><i></i><span>Новости</span></label></li>
            </ul>
        </div>
        <div class="col col-6">
            <ul class="item-list">
                <li class="checkbox"><label><input type="checkbox" name="1"><i></i><span>Везде</span></label></li>
                <li class="checkbox"><label><input type="checkbox" name="1"><i></i><span>Информация для клиентов</span></label></li>
                <li class="checkbox"><label><input type="checkbox" name="1"><i></i><span>Новости</span></label></li>
            </ul>
        </div>
    </div>
    <br><br><br>
    <div class="z3">Кнопки</div>
    <a href="#" class="btn btn-orange">Кнопка оранжева</a>
    <a href="#" class="btn btn-grey">Кнопка серая</a>
    <a href="#" class="btn btn-transparent-border">Кнопка с серой рамкой</a>
    <a href="#" class="btn btn-label"><span><i class="icon-question btn-icon"></i></span>Кнопки прозрачная с иконкой</a>
    <a href="#" class="btn btn-label btn-transparent-border"><span><i class="icon-post btn-icon"></i></span>Кнопки прозрачная с иконкой</a>
    <a href="#" class="btn btn-grey-light">Кнопка светло-серая</a>
    <a href="#" class="btn btn-grey-light w-170"><span class="fa-angle-btn">Кнопка</span></a>
    <a href="#" class="btn btn-orange btn-square"><i class="fa fa-bar-chart"></i></a>
    <a href="#" class="btn btn-orange btn-exsmall">Кнопка экстра маленькая</a>
    <a href="#" class="btn btn-orange btn-small">Кнопка меленька</a>
    <a href="#" class="btn btn-orange btn-middle">Кнопка средняя</a>
    <a href="#" class="btn btn-orange block">Кнопка во всю ширину блока</a>
    <a href="#" class="btn btn-grey--dark">Кнопка темно-серая</a>
    <br><br><br>
    
    <div class="z3">Сообщения</div>
    <div class="bg-message bg-success">Удачно</div>
    <div class="bg-message bg-info">Информация</div>
    <div class="bg-message bg-danger">Ошибка</div>
    <div class="bg-message bg-warning">Предупреждение</div>
    <br><br><br>
    
    <div class="z3">Ширина блоков</div>
    <div class="bg-message bg-success w-44">44px</div>
    <div class="bg-message bg-info w-54">54px</div>
    <div class="bg-message bg-info w-60">60px</div>
    <div class="bg-message bg-danger w-130">130px</div>
    <div class="bg-message bg-warning w-170">170px</div>
    <div class="bg-message bg-success w-200">200px</div>
    <div class="bg-message bg-info w-210">210px</div>
    <div class="bg-message bg-danger w-230">230px</div>
    <div class="bg-message bg-warning w-270">270px</div>
    <div class="bg-message bg-warning w-280">280px;</div>
    <br><br><br>
    <div class="z3">Тексты</div>
    <div class="bg-message bg-warning fs-12">font-size:12px;</div>
    <div class="bg-message bg-warning fs-14">font-size:14px;</div>
    <div class="bg-message bg-warning fs-15">font-size:15px;</div>
    <div class="bg-message bg-warning fs-16">font-size:16px;</div>
    <div class="bg-message bg-warning fs-18">font-size:18px;</div>
    <div class="bg-message bg-warning fs-24">font-size:24px;</div>
    <div class="bg-message bg-warning fs-30">font-size:30px;</div>
    <div class="bg-message bg-warning text-left">text-align:left;</div>
    <div class="bg-message bg-warning text-center">text-align:center;</div>
    <div class="bg-message bg-warning text-right">text-align:right;</div>
    <div class="bg-message bg-warning text-justify">text-align:justify;</div>
    <div class="bg-message color-black">Черный текст</div>
    <div class="bg-message color-yellow">Желтый текст</div>
    <div class="bg-message bg-warning color-white">Белый текст</div>
    <div class="bg-message color-orange">Оранжевый текст</div>
    <div class="bg-message color-red">Красный текст</div>
    <div class="bg-message color-blue">Синий текст</div>
    <div class="bg-message color-green">Зеленый текст</div>
    <div class="bg-message color-grey">Серый текст</div>
    <div class="bg-message bg-warning text-white">Белый текст</div>
    <div class="bg-message"><a href="#" class="link-orange">Оранжевая черта</a></div>
    <div class="bg-message"><a href="#" class="dotted">Точки</a></div>
    <div class="bg-message"><a href="#" class="dashed">Подчеркивание пунктиром</a></div>
    <div class="bg-message bg-warning text-uppercase">Большие буквы</div>
    
    <br><br><br>
    <div class="z3">Отступы</div>
    <div class="bg-message bg-warning mt-10 ml-10 mr-10 mb-10">mt-10 ml-10 mr-10 mb-10</div>
    <div class="bg-message bg-warning mt-20 ml-20 mr-20 mb-20">mt-20 ml-20 mr-20 mb-20</div>
    <div class="bg-message bg-warning mt-30 ml-30 mr-30 mb-30">mt-30 ml-30 mr-30 mb-30</div>
    <div class="bg-message bg-warning mt-40 ml-40 mr-40 mb-40">mt-40 ml-40 mr-40 mb-40</div>
    <div class="bg-message bg-warning mt-50 ml-50 mr-50 mb-50">mt-50 ml-50 mr-50 mb-50</div>
    <div class="bg-message bg-warning pt-0 pl-0 pr-0 pb-0">pt-0 pl-0 pr-0 pb-0</div>
    
    <br><br><br>
    <div class="z3">Форма</div>
    <div class="form-group">
        <div class="form-label">Способ тарификации <span class="color-orange">*</span></div>
        <div class="form-select js-select">
            <select>
                <option value="0">1 - тарифный</option>
                <option value="1">2 - тарифный</option>
                <option value="2">3 - тарифный</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="form-label">№ лицевого счета <span class="color-orange">*</span></div>
        <div class="form-control--container">
            <input class="form-control" value="" placeholder="">
            <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i>
        </div>
    </div>
    <div class="form-group">
        <div class="form-label">№ лицевого счета <span class="color-orange">*</span></div>
        <div class="form-control--container">
            <input class="form-control is-error" value="Ошибка" placeholder="">
            <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i>
        </div>
    </div>
    <div class="form-group">
        <div class="form-label">№ лицевого счета <span class="color-orange">*</span></div>
        <div class="form-control--container">
            <input class="form-control js-InputMask" data-inputmask="'mask': '+7 999 999 99 99','placeholder':'Х'" value="" placeholder="Телефон" >
            <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i>
        </div>
    </div>
    <div class="form-group">
        <div class="form-label">№ лицевого счета <span class="color-orange">*</span></div>
        <div class="form-control--container">
            <input class="form-control js-Email" value="" placeholder="Поля для мыла">
            <i class="form-control--question js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i>
        </div>
    </div>
    <div class="checkbox for-rules"><label><input type="checkbox" checked=""><i></i><span>Принимаю условия <a href="/privacy/" target="_blank">обработки данных</a></span></label></div>
    <br><br><br>
    
    
    <div class="z3">Конентные блоки</div>
    <div class="z6">Картинка в круге</div>
    <div id="temp-tooltip">
        <div class="round-105 text-center">
            <img src="/local/media/icons/icon-pc--pay.png" alt="">
        </div>
    </div>
    <br><br>
    <div class="z6">Подсказки</div>
    <span class="js-toolTip" data-text="с текст">можно и сюда</span><br>
    <i class="icon-info js-toolTip" data-text="из иконки"></i><br>
    <i class="icon-info--orange js-toolTip" data-text="Номер лицевого счета указывается на титульной странице абонентской книжки и в договоре на электроснабжение месяца."></i><br>
    <span class="js-toolTip" data-target="#temp-tooltip">получить описание из dom блока под id или class</span><Br>
    <span class="js-toolTip" data-text="из иконки" data-position="middle">центрование по середине родителя</span>
    <br><br>
    <div class="z6">Скрытый блок прям за мной</div>
    <div class="none">тут может быть все что угодно</div>
    
    <div class="z6">Оптикание<small>Не забываем сбрасывать</small></div>
    <div class="clearfix">
        <div class="pull-left">Слева
        </div>
        <div class="clear"></div>
        <div class="pull-right">Справа
        </div>
    </div>
    <a href="#description-1" class="js-SlideToggle">Скрыть/Показать</a>
    <div class="none" id="description-1">
                                <ul class="mt-0 pt-0 mb-0 pb-0">
                                    <li>введите сумму платежа и нажмите на кнопку «Отправить»</li>
                                    <li>после ввода суммы платежа и нажатия на кнопку «Оплатить», Вы будете перенаправлены на защищенную страницу платежной системы Газпромбанка, где безопасно осуществите Ваш платеж.</li>
                                    <li>после осуществления платежа Вы будете возвращены на прежнюю страницу.</li>
                                </ul>
                            </div>
    <br>
    <br>
    <br>
    
    <div class="z3">Переключалки</div>
        <div class="row">
            <div class="col col-6">
                <div class="one-radio js-OneRadio one-ratio--gray">
                    <label data-value="1" class="is-selected"><i></i>Однотарифный</label>
                    <label data-value="2" class=""><i></i>Многотарифный</label>
                    <input type="hidden" value="1">
                    <span class="is-selected-0"></span>
                </div>
            </div>
            <div class="col col-6">
                <div class="one-radio js-OneRadio">
                    <label data-value="1" class="is-selected"><i></i>Однотарифный</label>
                    <label data-value="2" class=""><i></i>Многотарифный</label>
                    <input type="hidden" value="1">
                    <span class="is-selected-0"></span>
                </div>
            </div>
        </div>
    <br>
    <br>
    <br>
    
    <div class="z3">Файлы</div>        
    <div class="file-list--small">
        <a href="#" class="file-item--small">
            <span><i class="icon-file--pdf"></i></span>
            <b>Постановление Региональной энергетической комиссии</b>
        </a>
        <a href="#" class="file-item--small">
            <span><i class="icon-file--doc"></i></span>
            <b>Постановление Региональной энергетической комиссии</b>
        </a>
        <a href="#" class="file-item--small">
            <span><i class="icon-file--exl"></i></span>
            <b>Постановление Региональной энергетической комиссии  Свердловской области от от 23.12.2016 № 226-ПК «Об установлении  понижающего коэффициента к тарифам на электрическую энергию для населения Свердловской области» Постановление Региональной энергетической комиссии  Свердловской области от от 23.12.2016 № 226-ПК «Об установлении  понижающего коэффициента к тарифам на электрическую энергию для населения Свердловской области»
</b>
        </a>
        <a href="#" class="file-item--small">
            <span><i class="icon-file--doc"></i></span>
            <b>«Об установлении  понижающего коэффициента к тарифам на электрическую энергию для населения Свердловской области»</b>
        </a>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>