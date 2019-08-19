<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
//TODO: MOVE TO COMPONENT
use DorrBitt\dbapi\DGAPI;
use DorrBitt\ClassDebug\ClassDebug;
//print DGAPI::ses();
$dev = DGAPI::dev("499b20fbbccf33b1a96a32aa8753cf46");
\CModule::IncludeModule("sale");
\CModule::IncludeModule("iblock");
$arStocks = array();
$arContacts = array();
$arStocksId = array();

$products = explode(",",$_REQUEST['products']);
if ($_REQUEST['products'] == "all") {
    $products = $_REQUEST['products'];
}
$Stocks = \OptimalGroup\Catalog::GetStock($products);
$arrProAmound = [];

if ($_REQUEST['products'] == "all") {
    foreach ($Stocks as  $stock){
        if(!empty($stock['UF_CONTACTS'])){
          $arStocksId[$stock['UF_CONTACTS']] = $stock['ID'];
          $arContacts[] = $stock['UF_CONTACTS'];
          $arStocks[$stock['ID']] = $stock;
          
        }
    }
}
else {    
    foreach ($Stocks as $productStock){
        foreach ($productStock as $stock){
            $arStocksId[$stock['UF_CONTACTS']] = $stock['ID'];
            $arContacts[] = $stock['UF_CONTACTS'];
            $arStocks[$stock['ID']] = $stock;
            $arrProAmound[$stock['UF_CONTACTS']] = $stock["PRODUCT_AMOUNT"];
            $arrIDsclad[$stock['UF_CONTACTS']] = $stock['ID'];
        }
    }
}
if ($arContacts){
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*", "PREVIEW_TEXT");
    $arFilter = Array("IBLOCK_ID"=>OFFICE_IBLOCK, "ACTIVE"=>"Y", "ID" => $arContacts);
    $res = CIBlockElement::GetList(array("sort"=>"asc"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    $arStocks = [];
    
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        if(is_array($arFields['PROPERTIES']) && !empty($arFields['PROPERTIES'])){
            $arFields["SKLADID"] = $arrIDsclad[$arFields["ID"]];
            $arStocks[$arStocksId[$arFields['ID']]]['CONTACTS'] = $arFields;
        }
    }
}
?>
<script src="<?=MEDIA_PATH;?>js/contacs.js"></script>
<div class="popup-form" style="max-width: 600px;">
    <div class="popup-form--title text-center">Выбор пункт самовывоза</div>
    <div class="js-Tabs product-detail--stock__selectors" data-container=".product-detail--stock">
        <a href="#stock-table" class="btn is-selected"><i class="section-mode--view__grid btn-fa"></i>Список</a>
        <a href="#stock-map" class="btn"><i class="fa fa-map-marker btn-fa"></i>На карте</a>
    </div>
    <div class="product-detail--stock" id="stock-table">
        <div class="product-detail--stock__table">
            <table width="100%">
                <tr>
                    <th>Адрес</th>
                    <th>Наличие</th>
                    <th colspan="2">Режим работы</th>
                </tr>
                <? foreach($arStocks as $idsklad=>$arItem):
                    $office = $arItem['CONTACTS'];
                    $StoreAddress = $office['PROPERTIES']['ADDRESS']['VALUE'];
                    if (!$StoreAddress){
                        $StoreAddress = $arItem['TITLE'];
                    }
                    $StoreAddressID = $arItem['CONTACTS']['ID'];
                ?>
                <tr class="stock-tr">
                    <td><?=$StoreAddress;?></td>
                    <td>
                        <? 
                        if(!empty($arrProAmound)){
                            $arItem['PRODUCT_AMOUNT'] = (empty($arItem['PRODUCT_AMOUNT'])) ? $arrProAmound[$StoreAddressID] : $arItem['PRODUCT_AMOUNT'];
                        }
                        $inStock = \OptimalGroup\Catalog::GetStockView($arItem['PRODUCT_AMOUNT']);
                        $InStockJs = $InStockHtml = '<div class="product-item--availability is-avaiable">';
                        $InStockJs .= '<i class="fa fa-check-circle-o"></i> Наличие: ';
                        for($i=1; $i<=5; $i++){
                            $class = "";
                            if ($i<=$inStock)
                                $class = ' class="is-selected"';
                            $InStockHtml .= '<b'.$class.'></b>';
                            $InStockJs .= '<b'.$class.'></b>';
                        }
                        $InStockJs  .=  '</div>';
                        $InStockHtml .=  '</div>';

                    ?>
                    <?=$InStockHtml;?>
                </td>
                <td> <?php if($dev == 1){ print $_REQUEST['current']." id ".$idsklad; } ?>
                    <? if ($office['PROPERTIES']['TIME_INDIVIDUALS']['VALUE']):?>
                    <?
                    $arTimeInd = '<table class="no-padding" width="100%">';
                    foreach ($office['PROPERTIES']['TIME_INDIVIDUALS']['VALUE'] as $k=>$day):
                        $time = $office['PROPERTIES']['TIME_INDIVIDUALS']['DESCRIPTION'][$k];
                        $arTimeInd .= '<tr><td nowrap>'.$day.'</td><td nowrap>'.$time.'</td></tr>';
                    endforeach;
                    $arTimeInd .= "</table>";   
                    ?>
                    <?=$arTimeInd;?>
                    <? endif;?>
                </td>
                <td><a href="#" data-id="<?=$idsklad?>" class="btn btn-small w-130 js-ChangeStore <? if ($_REQUEST['current'] == $idsklad):?>btn-orange<? else:?>btn-grey<? endif;?>">Выбрать</a></td>
            </tr>
            <?
            if ($office['PROPERTIES']['COORDS']['VALUE']){
                $coord = explode(',',$office['PROPERTIES']['COORDS']['VALUE']);
                
                $MapPlacmarks[] = array(
                    'CENTER'=>array($coord[0],$coord[1]),
                    "ID"=>$arItem['ID'],
                    "REGION"=>$office['PROPERTIES']['REGION']['VALUE'],
                    "CONTENT"=>array(
                        "IN_STOCK"=>$InStockJs,
                        "ADDRESS" => $office['PROPERTIES']['INDEX']['VALUE'].", ".$office['PROPERTIES']['ADDRESS']['VALUE'],
                        "PHONE" => implode(",<br>",$office['PROPERTIES']['PHONE']['VALUE']),
                        "TIME" => $arTimeInd,
                        "TEXT" => $office['PREVIEW_TEXT']
                    ),
                    "TEMPLATE"=>"cart"
                );
            }
            ?>
            <? endforeach;?>
        </table>
    </div>
    </div>
    <div class="product-detail--stock product-detail--stock__map none" id="stock-map">
        <script>
            ContactsPlaceMarksList = <?=json_encode($MapPlacmarks);?>;
        </script>
        <div class="contacts-map" id="map"></div>
    </div>
</div>