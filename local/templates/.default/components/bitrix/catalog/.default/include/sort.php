<?
if ($_REQUEST['in_page']){
    $_SESSION['BXExtra']['CATALOG']['PAGE'] = $_REQUEST['in_page'];
}
if ($_REQUEST['sort']){
    $_SESSION['BXExtra']['CATALOG']['SORT']['SORT'] = $_REQUEST['sort'];
    $_SESSION['BXExtra']['CATALOG']['SORT']['ORDER'] = $_REQUEST['order'];
}

if (!$_SESSION['BXExtra']['CATALOG']){
    $arCatalogOptionDefaults = $_SESSION['BXExtra']['CATALOG'] = array(
        "SORT"=>array("SORT" => "price", "ORDER"=> "desc"),
        "PAGE"=>$arParams['PAGE_ELEMENT_COUNT'],
        "VIEW"=>"grid"
    );
} else {
    $arCatalogOptionDefaults = $_SESSION['BXExtra']['CATALOG'];
}
$PriceId = $_SESSION['BXExtra']['PRICE']['ID'];
$arCatalogOption = array(
    "SORT" => array(
        array(
            "CODE"=>"catalog_PRICE_".$PriceId,
            "NAME"=>"по цене",
            "ORDER"=> "desc",
            "SORT"=>"price"
        ),
        array(
            "CODE"=>"catalog_PRICE_".$PriceId,
            "NAME"=>"по цене",
            "ORDER"=> "asc" ,
            "SORT"=>"price"
        ),
        array(
            "CODE"=>"show_counter",
            "NAME"=>"по популярности",
            "ORDER"=>"asc",
            "SORT"=>"popular"
        ),
        array(
            "CODE"=>"DATE_ACTIVE_FROM",
            "NAME"=>"по новизне",
            "ORDER"=>"asc",
            "SORT"=>"date"
        )
    ),
    "PAGE" => array(12,48,"Все"),
    "VIEW" => array("grid","list","table")
);
$arSelectedSort = array();
foreach($arCatalogOption['SORT'] as $k=>$sort){
    if ($sort['SORT'] == $arCatalogOptionDefaults['SORT']['SORT'] && $sort['ORDER'] == $arCatalogOptionDefaults['SORT']['ORDER']){
        $arCatalogOption['SORT'][$k]['SELECTED'] = true;
        $arSelectedSort = $sort;
    }
}
$arParams['ELEMENT_SORT_FIELD2'] = $arSelectedSort['CODE'];
$arParams["ELEMENT_SORT_ORDER2"] = $arCatalogOptionDefaults['SORT']['ORDER'];
$arParams['PAGE_ELEMENT_COUNT'] = $arCatalogOptionDefaults['PAGE'];
if (!(int)$arCatalogOptionDefaults['PAGE']) {
    $arParams['PAGE_ELEMENT_COUNT'] = 1000;    
}
$arParams['CATALOG_VIEW'] = $arCatalogOptionDefaults['VIEW'];
?>
<form class="section-mode clearfix" method="post">
    <div class="pull-left">
        <!--<div class="section-mode--total section-mode--field pull-left">
            <b><?=$CoutnInSection;?></b> <span><?=FormatHelper::plural($CoutnInSection, array('товар', 'товара', 'товаров'));?></span>
        </div>-->
        <div class="section-mode--sort section-mode--field pull-left">
            <span>Сортировать по:</span>
            <div class="dropdown by-hover sort-select ib">
                <div class="dropdown--label"><?=$arSelectedSort['NAME'];?><i class="fa btn-fa--collapse fa-angle-down"></i></div>
                <div class="dropdown-list">
                <? 
                foreach($arCatalogOption['SORT'] as $sort):
                $icon = "";
                if ($sort['SORT']=="price"){
                    $position = 'fa-angle-down';
                    if ($sort['ORDER'] == "asc") 
                        $position = 'fa-angle-up';
                    $icon = '<i class="fa btn-fa--collapse '.$position.'"></i>';
                }
                ?>
                    <a href="?sort=<?=$sort['SORT'];?>&order=<?=$sort['ORDER'];?>" class="btn<? if($sort['SELECTED']):?> is-selected<?endif;?>"><?=$sort['NAME'];?><?=$icon;?></a>
                <? endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        <div class="section-mode--count section-mode--field pull-left">
            <span>Показывать по:</span>
            <? foreach($arCatalogOption['PAGE'] as $page):?>
            <a href="?in_page=<?=$page;?>" class="btn<? if($page == $arCatalogOptionDefaults['PAGE']):?> is-selected<? endif;?>"><?=$page;?></a>
            <? endforeach;?>
        </div>
        <div class="section-mode--view section-mode--field pull-left js-CatalogView">
        <? foreach($arCatalogOption['VIEW'] as $view):?>
            <a href="#" class="btn<? if($view == $arCatalogOptionDefaults['VIEW']):?> is-selected<? endif;?>" data-view="<?=$view;?>"><i class="section-mode--view__<?=$view;?>"></i></a>
        <? endforeach;?>
        </div>
    </div>
</form>