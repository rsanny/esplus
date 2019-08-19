<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
global $OptimalGroup;

\Bitrix\Main\Page\Asset::getInstance()->addJs("//api-maps.yandex.ru/2.1/?lang=ru_RU");
\OptimalGroup\Core::AddJs(array(
    "contacs",
    "lib/jquery.autocomplete.min",
    "optimalgroup/office.filter"
));
$arProperties = array();
$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>7, "CODE"=>array("ICONS","TYPE")));
while($enum_fields = $property_enums->GetNext())
{
    $arProperties[$enum_fields['PROPERTY_CODE']][] = $enum_fields;
}

if ($OptimalGroup['SITE']['CODE'] == "business" && !$_REQUEST['is_filter']){
    $_REQUEST['is_filter'] = "Y";
    $_REQUEST['contacts_type'] = $arProperties['TYPE'][1]['ID'];
}
if ($OptimalGroup['SITE']['CODE'] == "home" && !$_REQUEST['is_filter']){
    $_REQUEST['is_filter'] = "Y";
    $_REQUEST['contacts_type'] = $arProperties['TYPE'][0]['ID'];
}
?>

<main class="content">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        );?>
        <div class="page-header">
            <h1><?=$APPLICATION->ShowTitle();?></h1>
        </div>
        <form class="contacts-filter mb-10 js-OfficeFilter">
            <input type="hidden" name="is_filter" value="Y">
            <div class="row">
                <div class="col col-12 col-lg-6">
                    <div class="row">
                        <div class="col col-12 col-md-6 contacts-filter--padding">
                            <?
                            $isInd = "checked";
                            if (
                                $_REQUEST['is_filter'] && $_REQUEST['contacts_type'] != $arProperties['TYPE'][0]['ID']
                            )
                                $isInd = "";
                            ?>
                            <div class="radio mb-md-20">
                                <label>
                                    <input type="radio" name="contacts_type" value="<?=$arProperties['TYPE'][0]['ID'];?>" <?=$isInd;?>><i class=""></i>
                                    <span><?=$arProperties['TYPE'][0]['VALUE'];?></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="col col-12 col-md-6 contacts-filter--padding">
                            <?
                            if (!$isInd){
                                $IsLegal = "checked";
                            }
                            ?>
                            <div class="radio mb-md-20">
                                <label>
                                    <input type="radio" name="contacts_type" value="<?=$arProperties['TYPE'][1]['ID'];?>" <?=$IsLegal;?>><i class=""></i>
                                    <span><?=$arProperties['TYPE'][1]['VALUE'];?></span>
                                </label>
                            </div>
                        </div>
                        <div class="col col-12 col-md-6 order-md-3 order-4">
                            <?
                            $opened = false;
                            foreach ($arProperties['ICONS'] as $k=>$arIcon){
                                if($k<3)continue;
                                if (in_array($arIcon['ID'],$_REQUEST['contacts_service'])){
                                    $opened = true;
                                }
                            }
                            ?>
                            <? if(!$opened):?>
                            <a href="#more-contacts-service" class="btn btn-orange w-200 js-SlideToggle btn-more-contacts" data-close=".btn-more-contacts">+ выбрать услуги</a>
                            <? endif;?>
                            <div<? if(!$opened):?> class="none"<? endif;?> id="more-contacts-service">
                                <div class="contacts-filter--by_icon contacts-item--icons">
                            <? 
                                foreach ($arProperties['ICONS'] as $k=>$arIcon):
                                    if($k<3) continue;
                                    $checked = "";
                                    if (in_array($arIcon['ID'],$_REQUEST['contacts_service']))
                                        $checked = " checked";
                                ?>
                                    <label>
                                        <input name="contacts_service[]" type="checkbox" value="<?=$arIcon['ID'];?>"<?=$checked;?>>
                                        <i class="icon-<?=$arIcon['XML_ID'];?>"></i>
                                        <span><?=$arIcon['VALUE'];?></span>
                                    </label>
                                <? endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-md-6 order-3 order-md-4">               
                            <div class="contacts-filter--by_icon contacts-item--icons">
                            <? 
                            foreach ($arProperties['ICONS'] as $k=>$arIcon):
                                if($k>2) break;
                                $checked = "";
                                if (in_array($arIcon['ID'],$_REQUEST['contacts_service']))
                                    $checked = " checked";
                            ?>
                                <label>
                                    <input name="contacts_service[]" type="checkbox" value="<?=$arIcon['ID'];?>"<?=$checked;?>>
                                    <i class="icon-<?=$arIcon['XML_ID'];?>"></i>
                                    <span><?=$arIcon['VALUE'];?></span>
                                </label>
                            <? endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-lg-6 mt-20 mt-lg-0">
                    <?
                    $today = date('d');
                    $low = explode(",",$_SESSION['BXExtra']['REGION']['IBLOCK']['OCCUPANCY_LOW']);
                    $middle = explode(",",$_SESSION['BXExtra']['REGION']['IBLOCK']['OCCUPANCY_NORMAL']);
                    $high = explode(",",$_SESSION['BXExtra']['REGION']['IBLOCK']['OCCUPANCY_HIGH']);
                    if (in_array($today,$low))
                        $occupancy = array("TEXT"=>"низкая загруженность","COLOR"=>"green", "COUNT"=>1);
                    else if (in_array($today,$middle))
                        $occupancy = array("TEXT"=>"средняя загруженность","COLOR"=>"yellow", "COUNT"=>2);
                    else if (in_array($today,$high))
                        $occupancy = array("TEXT"=>"высокая загруженность","COLOR"=>"orange", "COUNT"=>3);
                        
                    ?>
                    <div class="none">
                        <div class="popup-form" id="office-about"><?=$_SESSION['BXExtra']['REGION']['IBLOCK']['OCCUPANCY_TEXT']['TEXT'];?></div>
                    </div>
                    <div class="contacts-occupancy mb-20 fs-18">
                        <div class="contacts-occupancy--text">
                            <a href="#office-about" class="js-popUp"><span>Загруженность офисов:</span>  <i class="fa fa-question-circle fs-18"></i></a>
                        </div>
                        <div class="contacts-occupancy--about fs-14">
                            <b>
                                <? for ($i=0;$i < $occupancy['COUNT'];$i++):?>
                                <i class="fa fa-user color-<?=$occupancy['COLOR'];?>"></i>
                                <? endfor;?>
                            </b>
                            Сегодня<br><?=$occupancy['TEXT'];?>
                        </div>
                        
                    </div>
                    <? if ($_SESSION['BXExtra']['REGION']['IBLOCK']['GRAFF']):?>
                    <img src="<?=CFile::GetPath($_SESSION['BXExtra']['REGION']['IBLOCK']['GRAFF']);?>" alt="" class="img-responsive">
                    <? endif;?>
                </div>
                <? if ($_REQUEST['is_filter']):?>
                <div class="col col-12 mb-10">
                    <div class="clearfix clear-office-filter">
                        <a href="/offices/" class="clear-filter--left"><span>Сбросить фильтр</span></a>
                    </div>
                </div>
                <? endif;?>
                <div class="col col-12 col-md-4 col-lg-3 mt-10">
                    <div class="form-group">
                        <div class="one-radio js-Tabs" data-container=".contacts-tab">
                            <a href="#tab-list" class="is-selected"><i></i>Списком</a>
                            <a href="#tab-map" class=""><i></i>На карте</a>
                            <span class="is-selected-0"></span>
                        </div>
                    </div>                                    
                </div>
                <div class="col col-12 col-md-8 col-lg-9 mt-10">
                    <div class="clearfix office-search">
                        <button class="btn btn-orange w-170 pull-right">Найти</button>
                        <div class="header-search--form__input overflow">
                            <i class="fa fa-search"></i>
                            <input type="search" name="city" class="form-control js-autocomplete" value="<?=$_REQUEST['city'];?>" placeholder="Населенный пункт">
                            <a href="#" class="js-input-clear"></a>
                        </div>
                    </div>
                </div>
            </div>
        <!--/Contacts filter-->                        
        </form>
    </div>
    <div class="contacts-tab" id="tab-list">      
        <div class="container">
            <? $APPLICATION->IncludeFile('/offices/contacts-list.php', Array(), Array("SHOW_BORDER"=> false));?>                       
        </div>
    </div>
    <div class="contacts-tab none" id="tab-map">
        <div class="contacts-map" id="map">
            <?
            global $contactsFilter;
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "contacts-map",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => "contactsFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "7",
                    "IBLOCK_TYPE" => "contacts",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "1000",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("PHONE", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
                )
            );?> 
        </div>        
    </div>
</main>        

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>