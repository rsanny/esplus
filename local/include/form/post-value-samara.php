<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetAdditionalCSS("/local/templates/.default/components/bitrix/news/clients/bitrix/news.list/.default/style.css");
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
use DorrBitt\dbapi\DGAPI;
use DorrBitt\dbapi\ClassDBase;
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\SamaraObrabotkaUnload\SOU;
use DorrBitt\ParseType\ParseType;
use DorrBitt\dbCity\DBCITY;
$ses = DGAPI::ses();
use DorrBitt\dbapi\BElements;
$objParseType = new ParseType();
$getData = $request->get('data');
$obj = new BElements();
$objSOU = new SOU();
$objClassDBase = new ClassDBase();
$table = "b_iblock_element_prop_s55";
/** Включение / выключение сервиса
*  array $arrResultVV
*/
$vkvyk = 57;
$arParams = [
    "IBLOCK_ID"=>$vkvyk,
    "arSelect"=>["ID","NAME","IBLOCK_ID","XML_ID"],
    "arOrder"=>"",
    "arProperty"=>["CODE"=>"VKVYK"],
];
$arrResultVV = $obj->elemList($arParams);
$vkuch = ($arrResultVV[0]["arProps"]["VALUE"] == 10016) ? 1 : 0;

if(!empty($getData)){
    /*$arParams = [
        "IBLOCK_ID"=>55,
        "arSelect"=>["ID","NAME","IBLOCK_ID","XML_ID"],
        "arOrder"=>"",
        "arProperty"=>["CODE"=>"NLS_ID"],
        "PROPERTYID"=>$getData,
    ];
    $_SESSION["pp-{$ses}"]["nlsid"] = $getData;
    $daraResult = $obj->elemList2($arParams);
    $resultData = $objSOU->listElemProps($daraResult);*/
    if($objParseType->pt_numeric($getData) == 1){
        $dataXmlID = $objClassDBase->initQuery4(
            $table,
            [
              "{$table}.IBLOCK_ELEMENT_ID as ID",
              "{$table}.PROPERTY_1149 as NLS_ID",
              "{$table}.PROPERTY_1150 as ZAV_NOM",
              "{$table}.PROPERTY_1151 as SHOV_LAST",
              "{$table}.PROPERTY_1152 as DATA_M",
              "{$table}.PROPERTY_1153 as SHOV_LAST_ADD",
              "{$table}.PROPERTY_1154 as IDFILE",
            ],
            [
                ["{$table}.PROPERTY_1149","=",$getData],
            ],
            []
          );
    }

    $IDFILE = round($dataXmlID[0]["IDFILE"],0);

    $dostypTime = 0;
    if($IDFILE > 0){
      $arParams = [
        "IBLOCK_ID"=>56,
        "arSelect"=>["ID","NAME","IBLOCK_ID","XML_ID"],
        "arOrder"=>"",
        "arProperty"=>["CODE"=>"PERIOD_VY"],
        "PROPERTYID"=>$_POST["nlsid"],
    ];
    $timeArr = $obj->elementID($IDFILE);

    $timeArrData[0] = [
      "ID"=>$timeArr["ID"],
      "NAME"=>$timeArr["NAME"],
      "IBLOCK_ID"=>$timeArr["IBLOCK_ID"],
      "XML_ID"=>$timeArr["XML_ID"],
    ];
    //ClassDebug::debug($timeArrData[0]);
    $resultTimeID = $objSOU->listElemPropsTime($timeArrData);
    $data_time = "06.01.2020 00:00:00";
    $dostypTime = DBCITY::dostup_time_period($data_time,$resultTimeID[$IDFILE]["PERIOD_VY"]["VALUE"]);
    //print("<div>{$data_time} == {$resultTimeID[$IDFILE]["PERIOD_VY"]["VALUE"]} ==== {$dostypTime}</div>");
    }
    else{
          $IDFF = 535876;
          $timeArr = $obj->elementID($IDFF);
          $timeArrData[0] = [
          "ID"=>$timeArr["ID"],
          "NAME"=>$timeArr["NAME"],
          "IBLOCK_ID"=>$timeArr["IBLOCK_ID"],
          "XML_ID"=>$timeArr["XML_ID"],
        ];
        $resultTimeID = $objSOU->listElemPropsTime($timeArrData);
        $data_time = "05.12.2019 00:00:00";
        $dostypTime = DBCITY::dostup_time_period($data_time,$resultTimeID[$IDFF]["PERIOD_VY"]["VALUE"]);
      }

    if(is_array($dataXmlID) && !empty($dataXmlID) && count($dataXmlID) > 0){ $ats = 1; }else{ $ats = 0; }
}
?>

<?php if($vkuch == 1): ?>
<?php if(!empty($getData)):?>
<div id="dataLC" ></div>
<?php endif;?>

<div style="height:40px;" ></div>
<div id="IDPP" >
<div class="form-group--title text-left text-md-center">Передача показаний онлайн</div>
<form id="formIDPP" >
    <?=bitrix_sessid_post()?>
    <div class="row">
        <div class="col col-12 col-md-10 col-lg-8">
            <div class="row form-group flex-vertical">
                <div class="col col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 text-md-right text-left form-label">
                Номер лицевого счета <span class="text-danger">*</span>
                </div>
                <div class="col col-12 col-md-6">
                    <div class="form-control--container">
                        <input class="form-control" value="<?=$getData?>" name="nlsid"  placeholder="" maxlength="20" required>
                        <i class="form-control--question js-toolTip"
                           data-text="Номер лицевого счета указан в Вашей квитанции">
                        </i>
                    </div>
                </div>
            </div>
            <div class="row flex-vertical">
                <div class="col col-12 col-md-6 offset-md-6 form-group text-center col-mt-md-20">
                    <button class="btn btn-orange w-170 " name="get_counters" value="Y">Далее</button>
                    <div class="js-msg" style="display: none;"></div></div>
            </div>


        </div>
    </div>

    <div class="" id="dataIdSUL" >
    <?php if(!empty($getData)):?>
        <?php if($dostypTime == 1): ?>
    <div class="dataPP" >

<div class="b-blok" >
    <?php if($ats == 1):?>
    <?php if(count($arDorr) == array_sum($arDorr) && $_POST["par"] == 2):?>
        <!--<div class="vcontUpdate" >Данные успешно обновлены!</div>-->
    <?php endif;?>
    <div class="vcont" >
      <?php if(is_array($dataXmlID) && !empty($dataXmlID)):?>
        <?php foreach($dataXmlID as $resData):?>
        <?php
          $resData["SHOV_LAST"] = $objParseType->pt_trim($resData["SHOV_LAST"]);
          $resData["SHOV_LAST"] = $objParseType->pt_add_slash($resData["SHOV_LAST"]);
          $resData["SHOV_LAST"] = $objParseType->pt_add_hschar($resData["SHOV_LAST"]);
          $resData["SHOV_LAST"] = $objParseType->pt_replace($resData["SHOV_LAST"],[",","."]);

          $resData["SHOV_LAST_ADD"] = $objParseType->pt_replace($resData["SHOV_LAST_ADD"],[",","."]);
          $resData["SHOV_LAST_ADD"] = $objParseType->pt_trim($resData["SHOV_LAST_ADD"]);
          $resData["SHOV_LAST_ADD"] = $objParseType->pt_add_slash($resData["SHOV_LAST_ADD"]);
          $resData["SHOV_LAST_ADD"] = $objParseType->pt_add_hschar($resData["SHOV_LAST_ADD"]);
          $pokazaniaProverka = $objParseType->pt_numeric($resData["SHOV_LAST_ADD"]);
          if($pokazaniaProverka == 1){
            $pokazania = ($pokazaniaProverka == 1) ? $resData["SHOV_LAST_ADD"] : "";
            $pokazaniaResult = (!empty($pokazania)) ? $pokazania : "";
            $pozDataIS = ($resData["SHOV_LAST_ADD"] >= $resData["SHOV_LAST"]) ? 1 : 0;
          }

        ?>
        <div class="element-block" >

            <div class="elem-left" >
              <div class="b-loks" >
                <div class="b-loks-element" >ГВС</div>
                <div class="b-loks-element" >ПУ № <?=$resData["ZAV_NOM"]?></div>
              </div>
            </div>

            <div class="elem-right" >
              <div class="b-loks" >
                <div class="b-loks-element" >Показания</div>
                <div class="b-loks-element" >
                    <?php $value = ($pozDataIS == 1) ? $resData["SHOV_LAST_ADD"] : ""; ?>
                    <input type="text" value="<?=$value?>" name="numberPY-<?=$resData["ID"]?>"
                           placeholder="Последнее показание <?=$resData["SHOV_LAST"]?>" maxlength="20" />
                </div>
              </div>

              <div class="classSubMit" >
                <input type="submit" class="dataxls" value="Отправить" id="s-submit-<?=$resData["ID"]?>" name="s-submit-<?=$resData["ID"]?>" />
              </div>

            </div>

        </div>
        <?php endforeach;?>
      <?php endif;?>
    </div>
    <?php else:?>
    <div class="vcont-error" >
    <?=$objSOU->error()?>
    </div>
    <?php endif;?>
</div>
</div>
<?php else:?>
  <div class="vv-error" >
  <div>Период передачи показаний для клиентов ООО «Центр-СБК-Самара» еще не наступил.</div>
    <div>Рекомендуем передавать показания приборов учета<br /> ежемесячно с 6 по 25 число.</div>
  </div>
<?php endif;?>
<?php endif;?>
</div>

 <div class="bg-info bg-message mt-20">
    <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
      <!--<p>
      Данная форма позволяет клиентам расчетно-кассовых центров ООО &laquo;Центр-СБК-Самара&raquo; и ООО &laquo;ЕРЦ г.Тольятти&raquo;
      передавать показания онлайн по номеру лицевого счета, указанному в платежных документах(квитанциях).
      </p>
      <p>
      Передача показаний онлайн для клиентов АО &laquo;ЭнергосбыТ Плюс&raquo; доступна в <a target="_blank" href="https://lk.kvp24.ru/login" >личном кабинете</a>.
      </p>
      <p>
      Рекомендуем передавать показания приборов учета до 25 числа.
      </p>-->

      <!--<p>
      Данная форма позволяет клиентам расчетно-кассового центра <b>ООО «Центр-СБК-Самара»</b> передавать показания онлайн по номеру лицевого счета,
      указанному в платежных документах (квитанциях).
      </p>
      <p>
      Рекомендуем передавать показания приборов учета ежемесячно с 6 по 25 число.
      </p>

      <p>
      Передача показаний онлайн для клиентов <b>АО &laquo;ЭнергосбыТ Плюс&raquo;</b> доступна в <a target="_blank" href="https://lk.kvp24.ru/login" >личном кабинете</a>.
      </p>-->
      <p>
      Данная форма позволяет новым клиентам АО &laquo;ЭнергосбыТ Плюс&raquo; передавать показания онлайн по номеру лицевого счета (10 цифр), указанному в квитанциях. 
      </p>
      <p>
      Передача показаний для клиентов, номер лицевого счета которых состоит из 11 цифр,  временно доступна только в <a target="_blank" href="https://esplus.kvp24.ru/login" >личном кабинете</a>.
      </p>
      <br>
      <p>
      Рекомендуем передавать показания приборов учета ежемесячно с 6 по 25 число.
      </p>
</div>


        </form>
</div>
<?php
$uri_sa = explode("?",$_SERVER["REQUEST_URI"])[0];
$snum = md5(rand(5, 15));
?>
<script>
$('#formIDPP').on('click', 'button', function(e){
    e.preventDefault();
    var $form = $('#formIDPP');
    var lc = $("input[name='nlsid']").val();
    var url = "<?=$uri_sa?>?data="+lc;
    var par = 2;
    var dataPost = $form.serialize();

    //console.log(lc);
    dataPost += '&'+$(this).attr('name')+'='+$(this).val()+"&par="+par;
    ///modals('dataIdSUL','<div id="loader" >Подождите пожалуйста. Идёт загрузка данных.</div>');
    $('#loader').show();

    $.ajax({
        url: '/local/include/ajax/ajax-form-pp.php',
        data: dataPost,
        type: 'json',
        method: 'POST',
        beforeSend: function() {
            //$('#loader').show();
        },
        success: function(data){
            console.log(data);
            modals('dataIdSUL',data);
        },
        error: function(xhr){
            modals('dataIdSUL',"Ошибка. Что-то пошло не так.");
            document.location.href=url;
        },
        complete: function(){
            //$('#loader').hide();
        }
    });
});


$(document).on('click','.dataxls',function(e){
    e.preventDefault();
    var $form = $('#formIDPP');
    var lc = $("input[name='nlsid']").val();
    var url = "<?=$uri_sa?>?data="+lc;
    var par = 2;
    var dataPost = $form.serialize();
    console.log(dataPost);
    dataPost += '&'+$(this).attr('name')+'='+$(this).val()+"&par="+par;
    //modals('dataIdSUL','<div id="loader" >Подождите пожалуйста. Идёт загрузка данных.</div>');
    $('#loader').show();

    $.ajax({
        url: '/local/include/ajax/ajax-form-pp.php',
        data: dataPost,
        type: 'json',
        method: 'POST',
        beforeSend: function() {
            //$('#loader').show();
        },
        success: function(data){
            console.log(data);
            modals('dataIdSUL',data);
        },
        error: function(xhr){
            modals('dataIdSUL',"Ошибка. Что-то пошло не так.");
            document.location.href=url;
        },
        complete: function(){
            //$('#loader').hide();
        }
    });
});
</script>
<?php else:?>
  <div class="form-group--title text-left text-md-center">Передача показаний онлайн</div>
    <!--<div class="vv-error" >
    <div>Период передачи показаний еще не наступил.</div>
    <div>Рекомендуем передавать показания приборов учета<br /> ежемесячно с 5 по 21 число.</div>
    </div>-->

    <div class="bg-info bg-message mt-20">
    <div class="mb-10 color-orange"><b>Информация</b><i class="icon-info--orange"></i></div>
      <!--<p>
      Данная форма позволяет клиентам расчетно-кассовых центров ООО &laquo;Центр-СБК-Самара&raquo; и ООО &laquo;ЕРЦ г.Тольятти&raquo;
      передавать показания онлайн по номеру лицевого счета, указанному в платежных документах(квитанциях).
      </p>
      <p>
      Передача показаний онлайн для клиентов АО &laquo;ЭнергосбыТ Плюс&raquo; доступна в <a target="_blank" href="https://lk.kvp24.ru/login" >личном кабинете</a>.
      </p>
      <p>
      Рекомендуем передавать показания приборов учета до 25 числа.
      </p>-->

      <p>
      Данная форма позволяет новым клиентам АО &laquo;ЭнергосбыТ Плюс&raquo; передавать показания онлайн по номеру лицевого счета (10 цифр), указанному в квитанциях. 
      </p>
      <p>
      Передача показаний для клиентов, номер лицевого счета которых состоит из 11 цифр,  временно доступна только в <a target="_blank" href="https://esplus.kvp24.ru/login" >личном кабинете</a>.
      </p>
      <br>
      <p>
      Рекомендуем передавать показания приборов учета ежемесячно с 6 по 25 число.
      </p>
</div>
<?php endif;?>
