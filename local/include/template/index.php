<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$APPLICATION->SetTitle("ЭнергосбыТ Плюс - объединенная энергосбытовая компания Группы \"Т Плюс\""); 
$APPLICATION->SetPageProperty("description", "АО \"ЭнергосбыТ Плюс\" – объединенная энергосбытовая компания Группы \"Т Плюс\" с филиальной сетью из 13 региональных филиалов на территории Российской Федерации.");


use \Bitrix\Main\Page\Asset,
    \OptimalGroup\Template,
    \OptimalGroup\Core,
    \OptimalGroup\SiteSection;
$arCssFiles = array(
	'lib/grid',
    'reset',
    'base',
    'style',
    'responsive',
);
$arCssForJs = array(
    'js/lib/slick/slick.css',
    'js/lib/chosen/chosen.css',
    'js/lib/FontAwesome/font-awesome.css'
);
$arJsFiles = array(
	'library',
    'lib/jquery.matchHeight',
    'lib/jquery.inputmask',
    'lib/slick/slick.min',
    'lib/jquery.md5',
    'lib/chosen/chosen.jquery.min',
    'lib/jquery.imagesloaded.min',
    'optimalgroup',
    'material',
    'script',
    'optimalgroup/form',
    'optimalgroup/analytics'
);

Asset::getInstance()->addCss("//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&amp;subset=cyrillic");
Asset::getInstance()->addCss("//fonts.googleapis.com/css?family=Source+Sans+Pro&amp;subset=cyrillic");
foreach ($arCssForJs as $src)
	Asset::getInstance()->addCss(MEDIA_PATH . $src);
Core::AddCss($arCssFiles);
Core::AddJs($arJsFiles);

CJSCore::Init(
    array(
        'ajax', 
        'window',
        'fx'
    )
);
?>
<!DOCTYPE HTML>
<html class="no-js" lang="ru">
    <head>	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="cmsmagazine" content="05dd1571a43a773c1d44b36f091d48ca" />
        <meta name="it-rating" content="it-rat-2a6d62a251d2ac083522335ea7eb7ae1" />
		<? if ($OptimalGroup['BRANCH']['YA_WEB_CODE']):?><meta name="yandex-verification" content="<?=$OptimalGroup['BRANCH']['YA_WEB_CODE'];?>">
        <? endif;?><? if ($OptimalGroup['BRANCH']['GG_WEB_CODE']):?><meta name="google-site-verification" content="<?=$OptimalGroup['BRANCH']['GG_WEB_CODE'];?>">
        <? endif;?><title><?$APPLICATION->ShowTitle()?></title>
        <link rel="shortcut icon" href="<?=MEDIA_PATH;?>favicon.ico" />
		<link href="<?=MEDIA_PATH;?>favicon.ico" rel="icon" type="image/x-icon" />
		<? $APPLICATION->ShowHead(); ?>
		<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "header_analytics",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
        <? if ($OptimalGroup['BRANCH']['GTM_COUNTER']):?>
        <!-- Google Tag Manager -->
        <script data-skip-moving="true">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?=$OptimalGroup['BRANCH']['GTM_COUNTER'];?>');</script>
        <!-- End Google Tag Manager -->
        <? endif;?>
	</head>
	<body>
        <div class="is-current--city page">
            <div class="current-city--content current-city--fullheight">
                <div class="container">
                    <div class="mb-20 fs-18 text-center">Вы действительно находитесь в <?=$_SESSION['BXExtra']['REGION']['IBLOCK']['REGION_IN'];?>?</div>
                    <div class="overflow text-center">
                        <a href="#" class="btn btn-orange js-CityIsMy">Да, все верно</a>
                        <a href="#" class="btn btn-grey js-popUp" data-fancybox-type="ajax" data-fancybox-href="<?=AJAX_PATH;?>city-list.php">Нет, сменить регион</a>
                    </div>
                    <div class="mt-20 fs-16 text-center mb-40">От выбора региона зависят условия обслуживания.</div>
                </div>
            </div>
            <div class="current-city--content">
                <div class="container">
                    <h1 class="text-center color-white">Компания ЭнергосбыТ Плюс</h1>

                    <div class="simple-page">
                        <p>
                            АО "ЭнергосбыТ Плюс" – объединенная энергосбытовая компания <a href="http://www.tplusgroup.ru/" target="_blank">Группы "Т Плюс"</a> с филиальной сетью из <span class="color-orange fs-24">13 региональных филиалов</span> на территории Российской Федерации.
                        </p>
                        <p>
                            Компания имеет статус гарантирующего поставщика, что означает обязанность гарантированного обеспечения электроэнергией любого обратившегося к нам жителя или предприятия Свердловской, Кировской, Оренбургской области и Удмуртской Республики.
                        </p>
                        <p class="mt-30">
                             Региональная сеть ЭнергосбыТ Плюс представлена следующими филиалами:
                        </p>
                        <ul>
                            <?                
                            $OptimalGroupCity = new \OptimalGroup\City;
                            $arBranchList = $OptimalGroupCity->GetBranchList();
                            foreach($arBranchList as $k=>$arItem):
                                $url = \OptimalGroup\Url::Make($arItem['URL'],array("type"=>"m"));
                                $is_shop = false;
                                if ($_REQUEST['list'] == "shop"){
                                    $url = "#";
                                    $is_shop = true;
                                }
                                if($arItem['REGION']){
                            ?>
                                <li><a <? if ($url):?>href="<?=$url;?>"<? endif;?><?if ($is_shop):?> class="js-ChangeBranch notlined ws-nw" data-id="<?=$arItem['ID'];?>"<? else:?> class="notlined"<? endif;?>><?=$arItem['REGION'];?></a></li>
                            <? 
                                }
                            endforeach;?>

                        </ul>
                        <p>
                             Функции по начислению и сбору платежей за теплоснабжение и горячее водоснабжение на территории Ивановской области выполняются компанией ООО «Энергосбытовая компания Гарант», а на территории Республики Коми – АО «Коми энергосбытовая компания».
                        </p>
                        <p>
                            Филиалы компании обслуживают в общей сложности <span class="color-orange fs-24">более 120 тысяч организаций</span> и <span class="color-orange fs-24">более 3,4 миллиона домохозяйств</span>.
                        </p>
                        <p class="bg-message bg-info fs-24">
                             Общая численность сотрудников — <span class="color-orange">6 700 человек.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <? if ($OptimalGroup['BRANCH']['YA_COUNT_CODE']):?>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" data-skip-moving="true">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter<?=$OptimalGroup['BRANCH']['YA_COUNT_CODE'];?> = new Ya.Metrika({
                            id:<?=$OptimalGroup['BRANCH']['YA_COUNT_CODE'];?>,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true
                        });
                        w.yaCounterCode = "yaCounter<?=$OptimalGroup['BRANCH']['YA_COUNT_CODE'];?>";
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
        <noscript><div><img src="https://mc.yandex.ru/watch/<?=$OptimalGroup['BRANCH']['YA_COUNT_CODE'];?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        <? endif;?>
        <? if ($OptimalGroup['BRANCH']['GA_COUNT_CODE']):?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script data-skip-moving="true" async src="https://www.googletagmanager.com/gtag/js?id=<?=$OptimalGroup['BRANCH']['GA_COUNT_CODE'];?>"></script>
        <script data-skip-moving="true">
            window.dataLayer = window.dataLayer || [];
            window.gaCounterCode = '<?=$OptimalGroup['BRANCH']['GA_COUNT_CODE'];?>';
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?=$OptimalGroup['BRANCH']['GA_COUNT_CODE'];?>');
        </script>
        <? endif;?>
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
</body>
</html>        
        