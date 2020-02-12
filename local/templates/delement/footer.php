<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
IncludeTemplateLangFile(__FILE__);
?>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer__aux">
                <address class="footer__info">
                    <dl class="explanation footer__info-item">
                        <dd class="explanation__content">
                            <?$APPLICATION->IncludeComponent(
		                        'bitrix:main.include',
		                        '',
		                        array(
			                        'AREA_FILE_SHOW' => 'file',
			                        'PATH' => SITE_TEMPLATE_PATH . "/include/foot_company.php",
			                        'COMPOSITE_FRAME_TYPE' => 'AUTO',
			                        'COMPONENT_TEMPLATE' => '.default',
			                        'COMPOSITE_FRAME_MODE' => 'A',
                                    "TEXT_FOOTER" => $_SESSION['BXExtra']['REGION']['IBLOCK']['TEXT_FOOTER'],
                                    "LINK_FOOTER" => $_SESSION['BXExtra']['REGION']['IBLOCK']['LINK_FOOTER'],
		                        ),
		                        false
	                        );?></dd>
                    </dl>
                    <dl class="explanation footer__info-item">
                        <dd class="explanation__content">
	                        <?$APPLICATION->IncludeComponent(
		                        'bitrix:main.include',
		                        '',
		                        array(
			                        'AREA_FILE_SHOW' => 'file',
			                        'PATH' => SITE_TEMPLATE_PATH . "/include/foot_contact.php",
			                        'COMPOSITE_FRAME_TYPE' => 'AUTO',
			                        'COMPONENT_TEMPLATE' => 'phone',
			                        'COMPOSITE_FRAME_MODE' => 'A',
                                    "LINK_CONTACT" => $_SESSION['BXExtra']['REGION']['IBLOCK']['LINK_CONTACT'],
		                        ),
		                        false
	                        );?>
                        </dd>
                    </dl>
                    <dl class="explanation footer__info-item">
                        <dd class="explanation__content">
                            <?$APPLICATION->IncludeComponent(
		                        'bitrix:main.include',
		                        '',
		                        array(
			                        'AREA_FILE_SHOW' => 'file',
			                        'PATH' => SITE_TEMPLATE_PATH . "/include/foot_pd.php",
			                        'COMPOSITE_FRAME_TYPE' => 'AUTO',
			                        'COMPONENT_TEMPLATE' => 'email',
			                        'COMPOSITE_FRAME_MODE' => 'A',
                                    'LINK_PD' => $OptimalGroup['BRANCH']['LINK_PD'],
		                        ),
		                        false
	                        );?>
                        </dd>
                    </dl>
                </address>
            </div>
        </div>
    </footer>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "participant_modal",
    Array(
        "EMAIL_SEND" => $_SESSION['BXExtra']['REGION']['IBLOCK']['E_PURCHASE'],
        "BRANCH_HIDDEN" => true,
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "N",
        "CHAIN_ITEM_LINK" => "",
        "CHAIN_ITEM_TEXT" => "",
        "EDIT_URL" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "ANALYTICS" => array(
            "ga" => array(
                "category" => "dom-about",
                "action" => "zakup-q"
            ),
            "ym" => "FORM_PROMO_1"
        ),
        "LIST_URL" => "",
        "SEF_MODE" => "N",
        "SUCCESS_URL" => "",
        "USE_EXTENDED_ERRORS" => "Y",
        "VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
        "WEB_FORM_ID" => 34,
        "DOMAIN" => $OptimalGroup['DOMAIN'],
        "URL_PD" => $_SESSION['BXExtra']['REGION']['IBLOCK']['LINK_PD'],
    )
);
?>
<?if(!empty($_REQUEST['WEB_FORM_ID']) && !empty($_REQUEST['RESULT_ID'] && !empty($_REQUEST['formresult']))){?>
    <div class="popup-message" id="mypopup" data-fancybox="close"><h2>Спасибо!</h2><p>Ваша заявка принята!</p></div>
    <script>
        //$.fancybox.open('<div class="popup-message" data-fancybox="close"><h2>Заявка принята!</h2><a href="/">Перейти на сайт</a></div>');
console.log($('#mypopup'));
        $.fancybox.open({
            href: '#mypopup',
            type: 'inline',
            modal: false,
            afterClose : function( instance, current ) {
                location.href = '/?from=<?=$_GET['from']?>';
                console.log('12');
            }
        });
    </script>
<?}?>
<div class="overlay"></div>
<div id="success" class="modal">
    <header class="modal__header h2"><?=GetMessage("D_TMP_FOOT_SUCCESS_TITLE")?></header>
    <div class="modal__body modal__body--large"><?=GetMessage("D_TMP_FOOT_SUCCESS_BODY")?></div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" data-skip-moving="true">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter56389927 = new Ya.Metrika({
                    id:56389927,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    ecommerce:"dataLayer"
                });
                w.yaCounterCode = "yaCounter56389927";
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/26526327" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?$APPLICATION->ShowViewContent('events_js_script'); //?>
<?=$OptimalGroup['BRANCH']['COUNTERS']['TEXT'];?>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
    "AREA_FILE_SHOW" => "sect",
    "AREA_FILE_SUFFIX" => "counters",
    "AREA_FILE_RECURSIVE" => "Y",
    "EDIT_TEMPLATE" => ""
),
    false
);?>

<?php //print $dev;
if($dev == 1){
    ClassDebug::debug($_SERVER['HTTP_REFERER']);
}
setcookie("popup", '1', time()+60*60*24*60);
setcookie("region", $_GET['from'], time()+60*60*24*60);
?>
</body>
</html>