<?php 
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$arResult = array();
use DorrBitt\ClassDebug\ClassDebug;
use DorrBitt\dbapi\BElements;
use DorrBitt\SamaraObrabotkaUnload\SOU;
use DorrBitt\ParseType\ParseType;
use DorrBitt\dbapi\DGAPI;
use DorrBitt\dbapi\ClassDBase;
$ses = DGAPI::ses();
//$_SESSION["pp-{$ses}"]["nlsid"]
//ClassDebug::debug($_POST);
//ClassDebug::debug($_SESSION);
//ClassDebug::debug($_SERVER["REQUEST_METHOD"]);
$ats = 0;
$obj = new BElements();
$oElement = new \CIBlockElement();
$objSOU = new SOU();
$objParseType = new ParseType();
$objClassDBase = new ClassDBase();
$table = "b_iblock_element_prop_s55";
/*
IBLOCK_ELEMENT_ID 	
PROPERTY_1149     // NLS_ID	
PROPERTY_1150    // ZAV_NOM	
PROPERTY_1151	   // SHOV_LAST
PROPERTY_1153    // DATA_M	
PROPERTY_1154    // SHOV_LAST_ADD
PROPERTY_1155    // IDFILE
*/


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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST["par"] == 1){
      
      $arParams = [
          "IBLOCK_ID"=>55,
          "arSelect"=>["ID","NAME","IBLOCK_ID","XML_ID"],
          "arOrder"=>"",
          "arProperty"=>["CODE"=>"NLS_ID"],
          "PROPERTYID"=>$_POST["nlsid"],
      ];
      $_SESSION["pp-{$ses}"]["nlsid"] = $_POST["nlsid"];
      $daraResult = $obj->elemList2($arParams);
      $resultData = $objSOU->listElemProps($daraResult);

      if(is_array($resultData) && !empty($resultData) && count($resultData) > 0){ $ats = 1; }else{ $ats = 0; }  
    }
    elseif($_POST["par"] == 2){
      
      /*$arParams = [
          "IBLOCK_ID"=>55,
          "arSelect"=>["ID","NAME","IBLOCK_ID","XML_ID"],
          "arOrder"=>"",
          "arProperty"=>["CODE"=>"NLS_ID"],
          "PROPERTYID"=>$_POST["nlsid"],
      ];
      $dataXmlIDP = $obj->elemList2($arParams);
      $dataXmlID = $objSOU->listElemProps($dataXmlIDP);*/
      if($objParseType->pt_numeric($_POST["nlsid"]) == 1){
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
              ["{$table}.PROPERTY_1149","=",$_POST["nlsid"]],
          ],
          []
        );
      }

      if(is_array($dataXmlID) && !empty($dataXmlID) && count($dataXmlID) > 0){
        foreach($dataXmlID as $reslt){
          $pokazania = $_POST["numberPY-{$reslt["ID"]}"];
          
          $pokazania = $objParseType->pt_replace($pokazania,[",","."]);
          $pokazania = $objParseType->pt_trim($pokazania);
          $pokazania = $objParseType->pt_add_slash($pokazania);
          $pokazania = $objParseType->pt_add_hschar($pokazania);
          if($pokazania >= $reslt["SHOV_LAST"]){
            $pokazaniaProverka = $objParseType->pt_numeric($pokazania);
            if($pokazaniaProverka == 1){
              $pokazania = ($pokazaniaProverka == 1) ? $pokazania : "";

              /*$arrUpdateArray = Array(
                "MODIFIED_BY"    => $_SESSION["SESS_AUTH"]["USER_ID"], 
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $reslt["NAME"],
                "ACTIVE"         => "Y",
                "ACTIVE_FROM"   => $reslt["ACTIVE_FROM"],
                "CODE"=>$reslt["CODE"],
                );*/
              //$res = $oElement->Update($reslt["ID"], $arrUpdateArray);
              $res = $objClassDBase->initUpdate(
                $table,
                [
                  ["{$table}.PROPERTY_1153","=",$pokazania],
                ]
                ,
                [
                  ["{$table}.PROPERTY_1149","=",$reslt["NLS_ID"]],
                  ["{$table}.IBLOCK_ELEMENT_ID","=",$reslt["ID"]]
                ]
              );
              $arDorr["numberPY-{$reslt["ID"]}"]["save"] = 1;
            }
          }
          else{
            $arDorr["numberPY-{$reslt["ID"]}"]["save"] = 0;
          }
        }
      }

      //$daraResult = $obj->elemList2($arParams);
      //$resultData = $objSOU->listElemProps($daraResult);
      //ClassDebug::debug($resultData);
      $resultData = $objClassDBase->initQuery4(
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
            ["{$table}.PROPERTY_1149","=",$_POST["nlsid"]],
        ],
        []
      );

      if(is_array($resultData) && !empty($resultData) && count($resultData) > 0){ $ats = 1; }else{ $ats = 0; }  
      //ClassDebug::debug($arDorr);
      //print array_sum($arDorr);
      }
}
//ClassDebug::debug($resultData);
?>
<?php if($vkuch == 1): ?>
<div class="dataPP" >

  <div class="b-blok" >
      <?php if($ats == 1):?>
      <?php if(count($arDorr) == array_sum($arDorr) && $_POST["par"] == 2):?>
          <!--<div class="vcontUpdate" >Данные успешно обновлены!</div>-->
      <?php endif;?>
      <div class="vcont" >
        <?php if(is_array($resultData) && !empty($resultData)):?>
          <?php foreach($resultData as $resData):?>
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
            $pokazania = ($pokazaniaProverka == 1) ? $resData["SHOV_LAST_ADD"] : "";
            $pokazaniaResult = (!empty($pokazania)) ? $pokazania : "";
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
                      <?php $value = ($arDorr["numberPY-{$resData["ID"]}"]["save"] == 0) ? "" : $pokazaniaResult; ?>
                      <input type="text" value="<?=$value?>" name="numberPY-<?=$resData["ID"]?>" 
                             placeholder="Последнее показание <?=$resData["SHOV_LAST"]?>" maxlength="20" />
                      <?php if(!empty($_POST["numberPY-{$resData["ID"]}"])):?>
                      <?php if(!empty($value)):?>
                      <div class="yes">Показания успешно переданы.</div>
                      <?php else:?>
                      <div class="erorr" >Показания не могут быть меньше чем предыдущие.</div>
                      <?php endif;?>
                      <?php endif;?>
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
    <div>Период передачи показаний еще не наступил.</div>
    <div>Рекомендуем передавать показания приборов учета<br /> ежемесячно с 5 по 21 число.</div>
    </div>
<?php endif;?>