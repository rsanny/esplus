<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ОПиОК с привязкой к складам");

$arStocks =
$arStocksOfficeId = 
$arStockNoOffice =
$arBranch =
$allStoreByShop =
$allNoStoreByShop = [];
$arStocksNameByOfficeId = [];

$arSelectFields = ["*", "UF_*"];
$res = \CCatalogStore::GetList(["TITLE"=>"ASC"], ['ACTIVE' => 'Y'], false, false, $arSelectFields);
while ($arRes = $res->GetNext()){
    if($arRes['UF_CONTACTS']){
        $arStocksNameByOfficeId[$arRes['UF_CONTACTS']] = $arRes;
        $arStocksOfficeId[] = $arRes['UF_CONTACTS'];
    }
    else
        $arStockNoOffice[] = $arRes;
}

$arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_*"];
$arFilter = ["IBLOCK_ID" => OFFICE_IBLOCK, "ACTIVE"=>"Y", "!=ID" => $arStocksOfficeId, 'PROPERTY_ICONS' => 6];
$res = CIBlockElement::GetList(["NAME"=>"asc"], $arFilter, false, ["nPageSize" => 1000], $arSelect);
while($ob = $res->GetNextElement()){ 
    $arFields = $ob->GetFields();
    $arProp = $ob->GetProperties();
    $branchId = $arProp['BRANCH']['VALUE'];    
    if ($branchId)
        $allNoStoreByShop[$branchId][] = $arFields;
    else
        $allNoStoreByShop['NO_BRANCH'][] = $arFields;
}
$arFilter = ["IBLOCK_ID" => OFFICE_IBLOCK, "ACTIVE"=>"Y", "ID" => $arStocksOfficeId, 'PROPERTY_ICONS' => 6];
$res = CIBlockElement::GetList(["NAME"=>"asc"], $arFilter, false, ["nPageSize" => 1000], $arSelect);
while($ob = $res->GetNextElement()){ 
    $arFields = $ob->GetFields();
    $arProp = $ob->GetProperties();
    $branchId = $arProp['BRANCH']['VALUE'];    
    if ($branchId)
        $allStoreByShop[$branchId][] = $arFields;
    else
        $allStoreByShop['NO_BRANCH'][] = $arFields;
}

$arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_*"];
$arFilter = ["IBLOCK_ID" => BRANCH_IBLOCK, "ACTIVE" => "Y"];
$res = CIBlockElement::GetList(["NAME"=>"asc"], $arFilter, false, ["nPageSize"=>1000], $arSelect);
while($ob = $res->GetNextElement()){ 
    $arFields = $ob->GetFields();
    $arBranch[$arFields['ID']] = $arFields['NAME'];
}
?>
<? $k = 1;?>
<div class="z2">1. Нет привязки к складам</div>
<table width="100%" class="table table-striped table-hover">
    <tbody>
    <? foreach ($allNoStoreByShop as $arBranchId => $arOffices):?>
        <tr>
            <th class="text-center" colspan="2"><div class="z5"><?=$arBranch[$arBranchId]?:"Нет привязки к филиалу";?></div></th>
        </tr>
        <? foreach ($arOffices as $arOffice):?>
        <tr>
            <td width="10"><?=$k;?></td>
            <td><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=7&type=contacts&ID=<?=$arOffice['ID'];?>&lang=ru&WF=Y" target="_blank"><?=$arOffice['NAME'];?></a></td>
        </tr>
        <? 
            $k++;
        endforeach;?>
    <? endforeach;?>
    </tbody>
</table>

<? $k = 1;?>
<div class="z2">2. ОПиОК с привязкой к складам</div>
<table width="100%" class="table table-striped table-hover">
    
    <thead>
        <tr>
            <th></th>
            <th>Название офиса</th>
            <th>Название склада</th>
        </tr>
    </thead>
    <tbody>
    <? foreach ($allStoreByShop as $arBranchId => $arOffices):?>
        <tr>
            <th class="text-center" colspan="3"><div class="z5"><?=$arBranch[$arBranchId]?:"Нет привязки к филиалу";?></div></th>
        </tr>
        <? foreach ($arOffices as $arOffice):?>
        <tr>
            <td width="10"><?=$k;?></td>
            <td><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=7&type=contacts&ID=<?=$arOffice['ID'];?>&lang=ru&WF=Y" target="_blank"><?=$arOffice['NAME'];?></a></td>
            <td><a href="/bitrix/admin/cat_store_edit.php?ID=<?=$arStocksNameByOfficeId[$arOffice['ID']]['ID'];?>&lang=ru&&filter=Y&set_filter=Y" target="_blank"><?=$arStocksNameByOfficeId[$arOffice['ID']]['TITLE'];?></a></td>
        </tr>
        <? 
            $k++;
        endforeach;?>
    <? endforeach;?>
    </tbody>
</table>


<? $k = 1;?>
<div class="z2">3. Склады, у которых нет привязки к офисам</div>
<table width="100%" class="table table-striped table-hover">
    <tbody>
    <? foreach ($arStockNoOffice as $arOffice):?>
        <tr>
            <td width="10"><?=$k;?></td>
            <td><a href="/bitrix/admin/cat_store_edit.php?ID=<?=$arOffice['ID'];?>&lang=ru&&filter=Y&set_filter=Y" target="_blank"><?=$arOffice['TITLE'];?></a></td>
        </tr>
    <? 
        $k++;
    endforeach;?>
    </tbody>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>