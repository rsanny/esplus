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
<?php 

$requertUri = $_SERVER["DOCUMENT_ROOT"];
$branch = "by-branch/";
$url_all = $_SERVER["REQUEST_URI"];
$urlB = explode($branch,$url_all)[0];
$url = explode("?",$urlB)[0];
$dataPath = "{$requertUri}{$url}";
require("{$dataPath}classLoginPass.php");
//ClassDebug::debug($allNoStoreByShop);
$tSes = LoginPassBasa::ses();
$urlBranch = $url.$branch;

if(is_array($_POST) && !empty($_POST)){
    $dLogin = LoginPassBasa::trim($_POST["user_1"]);
    $dPass = LoginPassBasa::md5(LoginPassBasa::trim($_POST["pass_1"]));
    
    if( ($dLogin == LoginPassBasa::login()) && ($dPass == LoginPassBasa::pass())){
        LocalRedirect("{$urlBranch}?result={$tSes}");
    }
    else{
        LocalRedirect("{$urlBranch}?error={$tSes}"); 
    }
}

if(is_array($_GET) && !empty($_GET)){
    $res = LoginPassBasa::login_result();
    $rDostup = ((!empty(LoginPassBasa::userIzSee()) && !empty($res)) && (LoginPassBasa::userIzSee() == $res)) ? 1 : 0;
}
else{
    $rDostup = ((!empty(LoginPassBasa::userIzSee()) && !empty(LoginPassBasa::login())) && (LoginPassBasa::userIzSee() == LoginPassBasa::login())) ? 1 : 0;
}

?>
<?php if($rDostup == 0):?>
<form action="<?=$urlBranch?>?s=<?=$tSes?>" method="POST" >

<div class="form">
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-left form-label">
            <label for="SIMPLE_QUESTION_891">Логин <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
            <input id="user_1" type="text" name="user_1" class="form-control" placeholder="" value="">
        </div>
    </div>
    <div class="row form-group flex-vertical">
        <div class="col col-12 col-md-4 col-lg-5 text-left form-label">
            <label for="SIMPLE_QUESTION_646">Пароль <span class="color-orange">*</span></label>
        </div>
        <div class="col col-12 col-md-8 col-lg-7">
        <input id="pass_1" type="password" name="pass_1" class="form-control" placeholder="" value="" >
        </div>
    </div>

<div class="row form-group">
    <div class="col col-12 col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center">
        <button class="btn btn-orange w-170 1" name="web_form_submit" value="Войти" >Войти</button>
    </div>
</div>
</div>

</form>
<?php elseif($rDostup == 1):?>
    <a href="<?=$urlBranch?>?error=<?=$tSes?>" class="seans-link" >завершить сеанс - <?=LoginPassBasa::userIzSee()?></a>
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
<?php endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>