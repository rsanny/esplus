<? 
global $OptimalGroup;
?>
<? //$APPLICATION->IncludeFile(INCLUDE_PATH . '/template/inline-auth.php', array(), Array("MODE"=> "html"));?>

<section class="index-section index-service__list bg-grey border-top-bottom index-section">
    <div class="container">

        <div class="section-title text-center"><span>Онлайн сервисы</span></div>
        <div class="service-tabs--selector text-center js-Tabs clearfix service-mobile--row" data-container=".service-tab">
    
            <a href="#form4" class="is-selected icon-transfer js-MobileHref" data-mobile-href="/service/post/"><i><span></span></i><span>Передать показания</span></a>
            <a href="#form5" class="icon-contract js-MobileHref" data-mobile-href="/service/contract/" ><i><span></span></i>
              <span>Заключить договор</span>
            </a>
        </div>

        <div class="content-container hidden-sm-down">
            <div class="service-tab none" id="form1">
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/online-pay-kirov.php', Array(), Array("MODE"=> "html"));?>
            </div>
            <div class="service-tab " id="form4">
                <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/post-value-samara.php', Array(), Array("MODE"=> "html"));?>
            </div>
            <div class="service-tab none" id="form5">
            <? $APPLICATION->IncludeFile(INCLUDE_PATH . '/form/dogovor-value-samara.php', Array(), Array("MODE"=> "html"));?>
            </div>

        </div>
    </div>
</section>