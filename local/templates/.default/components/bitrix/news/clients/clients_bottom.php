<form class="clearfix mb-30" action="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"];?>">
    <button class="btn btn-orange w-170 pull-right">Найти</button>
    <div class="header-search--form__input overflow">
        <i class="fa fa-search"></i>
        <input type="search" name="q" class="form-control d-md-none" value="<?=$_REQUEST['q'];?>" placeholder="Поиск" autocomplete="off">
        <input type="search" name="q" class="form-control d-none d-md-block" value="<?=$_REQUEST['q'];?>" placeholder="Поиск информации или вопроса" autocomplete="off">
        <a href="#" class="js-input-clear"></a>
    </div>
</form>
<div class="client-question">
    <div class="fs-30 mb-20"><b>Не нашли ответ на свой вопрос?</b></div>
    <div class="clients-contacts mt-40 mb-30">
        <div class="fs-14 color-grey mb-20">Спросите наших специалистов по телефону</div>
        <a href="tel:<?=str_replace(array("-",")","("," "), "",$_SESSION['BXExtra']['REGION']['IBLOCK']['PHONE']);?>" class="color-black fs-24 notlined"><?=$_SESSION['BXExtra']['REGION']['IBLOCK']['PHONE'];?></a>
        <? if ($_SESSION['BXExtra']['REGION']['IBLOCK']['PHONE_ADD']):
            foreach ($_SESSION['BXExtra']['REGION']['IBLOCK']['PHONE_ADD'] as $phone_add):
        ?><br><a href="tel:<?=str_replace(array("-","(",")"," "),"",$phone_add);?>" class="color-black fs-24 notlined"><?=$phone_add;?></a><?
            endforeach;
        endif;?>
        <div class="fs-14 color-grey mt-20">или через форму:</div>
    </div>
    <div class="row">
        <div class="col col-12 col-lg-8 col-xl-5 offset-xl-0 offset-lg-2">
            <?
            $ClientForm = 27;
            $EmailSend = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_QUESTIONS'];
            $Analytics = array(
                "ga" => array(
                    "category" => "dom-about",
                    "action" => "clients-fiz"
                ),
                "ym" => "clients-fiz"
            );
            if ($_SESSION['BXExtra']['SITE']['CODE'] == "business") {
                $Analytics = array(
                    "ga" => array(
                        "category" => "busin-form",
                        "action" => "clients-biz"
                    ),
                    "ym" => "clients-biz"
                );
            }
            
            if ($_SESSION['BXExtra']['SITE']['CODE'] == "shop") {
                $ClientForm = 28;
                $EmailSend = $_SESSION['BXExtra']['REGION']['IBLOCK']['E_QUESTIONS_SHOP'];
            }
            ?>
            <?$APPLICATION->IncludeComponent(
	"dorrbitt:form.result.new", 
	".default", 
	array(
		"ANALYTICS" => $Analytics,
		"IN_COLUMN" => true,
		"HIDE_TITLE" => true,
		"EMAIL_SEND" => $EmailSend,
		"URL" => $_SERVER["SCRIPT_URI"]?$_SERVER["SCRIPT_URI"]:$APPLICATION->GetCurPage(),
		"BRANCH_HIDDEN" => true,
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => $ClientForm,
		"COMPONENT_TEMPLATE" => ".default",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
        </div>
    </div>
</div>
<div class="clients-office fs-14 mt-30">
    <div class="fs-18 mb-20">Адреса филиалов</div>
    <p><a href="/offices/" class="link-orange--text"><span>Найти ближайший</span>   <i class="fa fa-angle-right color-orange"></i></a></p>
    <p><a href="/offices/#tab-map" class="link-orange--text"><span>Показать на карте</span>   <i class="fa fa-angle-right color-orange"></i></a></p>
    <p><a href="/offices/" class="link-orange--text"><span>Фильтр и поиск по параметрам</span>  <i class="fa fa-angle-right color-orange"></i></a></p>
</div>