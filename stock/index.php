<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Stock");
$arStocks = array();
$arBrach = array();
$arBrachId = array();
$arFilter = Array();
$arSelectFields = Array( "*", "UF_*");
$res = \CCatalogStore::GetList(Array("UF_REGION"=>"ASC"),$arFilter,false,false,$arSelectFields);
while ($arRes = $res->GetNext()){
    $arStocks[$arRes['ID']] = $arRes;
    if ($arRes['UF_CONTACTS']){
        $arContacts[] = $arRes['UF_CONTACTS'];
        if ($arStocksId[$arRes['UF_CONTACTS']])
            $arStocksId[$arRes['UF_CONTACTS']][] = $arRes['ID'];
        else
            $arStocksId[$arRes['UF_CONTACTS']] = array($arRes['ID']);
        $arContacts[] = $arRes['UF_CONTACTS'];
    }
    if ($arRes['UF_REGION']){
        if ($arBrachId[$arRes['UF_REGION']])
            $arBrachId[$arRes['UF_REGION']][] = $arRes['ID'];
        else
            $arBrachId[$arRes['UF_REGION']] = array($arRes['ID']);
        $arBrach[] = $arRes['UF_REGION'];
    }
}

if ($arContacts){
    $tempContacts = array();
    $tempBranch = array();
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>OFFICE_IBLOCK, "ACTIVE"=>"Y", "ID" => $arContacts);
    $res = CIBlockElement::GetList(array("sort"=>"asc"), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        $tempContacts[$arFields['ID']] = $arFields;
    }
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>BRANCH_IBLOCK, "ACTIVE"=>"Y", "ID" => $arBrach);
    $res = CIBlockElement::GetList(array("sort"=>"asc"), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
    while($ob = $res->GetNextElement()){ 
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        $tempBranch[$arFields['ID']] = $arFields;
    }
    
    foreach ($arStocks as $k=>$stock){
        $arStocks[$k]['CONTACTS'] = $tempContacts[$stock['UF_CONTACTS']];
        $arStocks[$k]['BRANCH'] = $tempBranch[$stock['UF_REGION']];
    }
}
//pr($arStocks);
?>
<?php 
$requertUri = $_SERVER["DOCUMENT_ROOT"];
$url_all = $_SERVER["REQUEST_URI"];
$url = explode("?",$url_all)[0];
$dataPath = "{$requertUri}{$url}";
require("{$dataPath}classLoginPass.php");

$tSes = LoginPassBasa::ses();
$aDostup = (is_array($arStocks) && !empty($arStocks)) ? 1 : 0;

if(is_array($_POST) && !empty($_POST) && $aDostup == 1){
    $dLogin = LoginPassBasa::trim($_POST["user_1"]);
    $dPass = LoginPassBasa::md5(LoginPassBasa::trim($_POST["pass_1"]));

    if( ($dLogin == LoginPassBasa::login()) && ($dPass == LoginPassBasa::pass())){
        LocalRedirect("{$url}?result={$tSes}");
    }
    else{
        LocalRedirect("{$url}?error={$tSes}"); 
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
<form action="<?=$url?>?s=<?=$tSes?>" method="POST" >

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
<a href="<?=$url?>?error=<?=$tSes?>" class="seans-link" >завершить сеанс - <?=LoginPassBasa::userIzSee()?></a>
<table width="100%" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Название склад [ID склада]</th>
            <th>Данные привязки скалада</th>
            <th>Данные контактов склада</th>
            <th>Регион [ID региона]</th>
            <!--<th>Данные региона</th>-->
        </tr>
    </thead>
    <tbody>
    <? foreach ($arStocks as $arStock):?>
    <tr>
        <td><?=$arStock['TITLE'];?> [<?=$arStock['ID'];?>]</td>
        <td nowrap><b>ID филиала:</b> <?=$arStock['UF_REGION'];?><br><b>ID Контатов</b>: <?=$arStock['UF_CONTACTS'];?></td>
        <td>
            <? foreach ($arStock['CONTACTS']['PROPERTIES'] as $property):
                if(empty($property['VALUE'])) continue;
            ?>
            <b><?=$property['NAME'];?></b>: <?=is_array($property['VALUE'])?implode(", ",$property['VALUE']):$property['VALUE'];?><br>
            <? endforeach;?>
        </td>
        <td nowrap><?=$arStock['BRANCH']['NAME'];?> [<?=$arStock['BRANCH']['ID'];?>]</td><!--
        <td>
            <? foreach ($arStock['BRANCH']['PROPERTIES'] as $property):?>
            <b><?=$property['NAME'];?></b>: <?=$property['VALUE'];?><br>
            <? endforeach;?>
        </td>-->
    </tr>
    <? endforeach;?>
    </tbody>
</table>
<?php endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>