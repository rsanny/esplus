<?
define("STOP_STATISTICS", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
//BY API COUSE PERMISSION FOR IBLOCK IS LOCKED IF WILL OPEN, THAN MOVE TO NEWS.LIST COMPONENT @city-list@ is template
CJSCore::Init(array('ajax', 'window'));
$OptimalGroupCity = new \OptimalGroup\City;
$arBranchList = $OptimalGroupCity->GetBranchList();
?>
<div class="popup-form">
    <div class="section-title text-center"><span>Выберите Ваш регион</span></div>
    <div class="overflow">
        <div class="cities-popup">
            <div class="row">
                <div class="col col-12">
                    <ul class="no-list cities-list">
                        <?
                        $t = count($arBranchList);
                        $row = ceil($t/2);
                        foreach($arBranchList as $k=>$arItem):
                        $url = \OptimalGroup\Url::Make($arItem['URL'],array());
                        $url1 = explode('.',$url);
                        $url2 = explode('//',$url1[0]);
                        $url = $url2[0].'//promo.'.$url1[1].'.'.$url1[2].$url1[3].'from='.$url2[1];
                        $is_shop = false;
                        if ($_REQUEST['list'] == "shop"){
                            $url = "#";
                            $is_shop = true;
                        }
                        if ($k==$row):?>
                    </ul>
                </div>
                <div class="col col-12">
                    <ul class="no-list cities-list">
                        <? endif;?>
                        <li><a <? if ($url):?>href="<?=$url;?>"<? endif;?><?if ($is_shop):?> class="js-ChangeBranch notlined ws-nw" data-id="<?=$arItem['ID'];?>"<? else:?> class="notlined"<? endif;?>><?=$arItem['REGION'];?></a></li>
                        <?
                        endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>    