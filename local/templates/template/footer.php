        <? if (!\OptimalGroup\Template::ShowFullWidth() && !$FullWidthDir):?>
            </div>
        </main>
        <? endif;?>
        <?php 
        use DorrBitt\ClassDebug\ClassDebug;
        use DorrBitt\dbapi\DGAPI; 
        //print DGAPI::ses();
        $dev = DGAPI::dev("c37ebf99b7924386821cd50e7948a375")?: ""; //($dev == 1) ? ClassDebug::debug($OptimalGroup) : "";
        ?>
        <footer class="bottom">
            <div class="container">
                <? require($_SERVER["DOCUMENT_ROOT"].$IncludePath.'/footer/menu.php');?>
                <hr>
                <div class="footer-bottom row">
                    <div class="col col-7 col-md-6 col-lg-4 footer-copyr mb-20 mb-lg-0"><? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/footer-copyr.php', Array(), Array("MODE"=> "html"));?></div>
                    <div class="col col-5 col-md-6 col-lg-2 text-right mb-20 mb-lg-0">
                        <div class="footer-socials">
                            <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/template/footer-social.php', Array(), Array("MODE"=> "html"));?>
                        </div>
                    </div>
                    <div class="col col-12 col-md-6 col-lg-4 footer-policy"><a href="/privacy/">Политика защиты персональных данных</a></div>
                    <div class="col col-2 col-md-6 col-lg-2 text-right hidden-sm-down"><a href="https://optimalgroup.ru/" target="_blank" class="optimalgroup">OptimalGroup</a></div>
                </div>
            </div>
        </footer>
        <div class="page-overlay none"></div>
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
                    accurateTrackBounce:true,
                    ecommerce:"dataLayer"
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

<?php //print $dev;
if($dev == 1){
    ClassDebug::debug($_SERVER['HTTP_REFERER']);
}
?>
</body>
</html>
