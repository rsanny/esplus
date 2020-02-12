<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\DBIB\TypeUri;
//ClassDebug::debug($listUrls);
?>
<?php if(count($arResult) > 0):?>


    <div class="data-cart-cont" >

        <div class="data-cart-block-1" >

        <!-- list-zakaza -->
          <div class="list-zakaza" >

          <div class="title" >Состав заказа</div>
          <div class="data-zakaza"  >

          <?php foreach($arResult as $id=>$val):?>
          <?php if($id > 0):?>
          <?php $iter++; $class_bask = ($iter % 2 == 0) ? " tovar-bask-1": " tovar-bask-2"; ?>
          <?php $val["DETAIL_PAGE_URL"] = TypeUri::parseUri($val["DETAIL_PAGE_URL"],"pakety-vody"); ?>
          <?php $DETAIL_PAGE_URL = $val["DETAIL_PAGE_URL"];?>

          <?php 
          if(!empty($val["MORE_PHOTO"]["SRC"])){
              $image = $val["MORE_PHOTO"]["SRC"];
              }
          elseif(!empty($val["PREVIEW_PICTURE"])){
              $image = $val["PREVIEW_PICTURE"];
              }
          ?>

          <div class="data-tovar<?=$class_bask?>" >

            <div class="el-img" >

                <img src="<?=$image?>" onclick="window.location.href='<?=$DETAIL_PAGE_URL?>'" >
            </div>
            <div class="el-name" onclick="window.location.href='<?=$DETAIL_PAGE_URL?>'" >
            <?=$val["TOVAR_NAME"]?>
            </div>
            <div class="el-col-pole" >

            <div class="blok" >
                <?php
                $arData = [
                    "ACTION"=>"ONCHANGE",
                    "TOVARID"=>$val["TOVARID"]
                ];
                $arData = json_encode($arData);
                $arDataBase64 = base64_encode($arData);
                ?>
              <input type="text" name="v-pole" class="v-pole" data-param="1" value="<?=$val["QUANTITY"]?>" data-val="this.value" data-ajax="<?=$arDataBase64?>" >
              <div class="plus-minus" >
                <?php
                $arData = [
                    "ACTION"=>"ADD",
                    "TOVARID"=>$val["TOVARID"]
                ];
                $arData = json_encode($arData);
                $arDataBase64 = base64_encode($arData);
                ?>
                <div class="plus" data-ajax="<?=$arDataBase64?>" data-param="1" >+</div>
                <?php
                $arData = [
                    "ACTION"=>"MINUS",
                    "TOVARID"=>$val["TOVARID"]
                ];
                $arData = json_encode($arData);
                $arDataBase64 = base64_encode($arData);
                ?>
                <div class="minus" data-ajax="<?=$arDataBase64?>" data-param="1" >-</div>
              </div>
            </div>

            </div>
            <div class="el-price" >
            <?=$val["PRICE"]?>
            </div>
            <div class="el-valute" >
            <?php $valuta = ($val["CURRENCY"] == "руб.") ? "<span class=\"fa fa-ruble\"></span>" : $val["CURRENCY"]; ?>
            <?=$valuta?>
            </div>
                <?php
                $arData = [
                    "ACTION"=>"DEL",
                    "TOVARID"=>$val["TOVARID"]
                ];
                $arData = json_encode($arData);
                $arDataBase64 = base64_encode($arData);
                ?>
            <div class="el-remove" data-ajax="<?=$arDataBase64?>" data-param="1" ></div>

          </div>
          <?php endif;?>
          <?php endforeach;?>

          <div class="itogo" >

          <div class="el-img" ></div>
          <div class="el-name" ></div>
          <div class="el-col-pole" ></div>
          <div class="el-price" ></div>
          <div class="el-rtesult" ><?=number_format($arResult["TOVAR_SUMMA_COLS_RESULT"]["tovar_summa_result"], 2, '.', ' ')?></div>
          <div class="el-remove" ><?=$valuta?></div>

          </div>

          </div>

          </div>
        <!-- end list-zakaza -->

        </div>
        <div class="data-cart-block-2" >

        <div class="oformlenie-zakaza" >
        <div class="title" >Оформление заказа</div>
        <!-- forma -->

        <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "cart", Array(
		"WEB_FORM_ID" => 6,	// ID веб-формы
        "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
        "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "VARIABLE_ALIASES" => array(
            "WEB_FORM_ID" => "WEB_FORM_ID",
            "RESULT_ID" => "RESULT_ID",
        ),
        "CACHE_TYPE" => "N",	// Тип кеширования
        "CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "LIST_URL" => "",	// Страница со списком результатов
        "EDIT_URL" => "",	// Страница редактирования результата
        "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
        "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
        "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
        "AJAX_MODE" => "Y   ",
        "AJAX_OPTION_JUMP" => "N",
        "SUCCESS_TEXT" => "Спасибо!",
        "SHOW_LIST_PAGE" =>"Y",
    ),
    false
    );?>

        <!-- end forma -->
        </div>

        </div>

    </div>
<?php else:?>
<div class="cart-empty" >Ваша корзина пуста.</div>
<?php endif;?>