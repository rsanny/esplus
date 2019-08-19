<?
global $OptimalGroup;
$arLinks = \OptimalGroup\SiteSection::names;
if (strpos($OptimalGroup['GROUP'],"shop") !== false){
    unset($arLinks['shop']);
}
?>
<div class="menu-switch js-switchSite">
<?
foreach($arLinks as $codeKey=>$HeadLink):
    $selected = false;
    $code = $HeadLink['CODE'];
    if ($OptimalGroup['SITE']['CODE'] == $code)
        $selected = true;
    $url = "#";
    if ($OptimalGroup['SITE']['CODE'] == "shop" && $code != "shop") {
        $url = \OptimalGroup\Url::Site("",array("site_section"=>$code, "type"=>"m"));
        $code = "";
    }
    if ($code == "shop"){
        $url = \OptimalGroup\Url::Shop();
    }
?>
    <a href="<?=$url;?>" class="<? if ($selected):?>is-selected <? endif;?>ink-reaction" data-code="<?=$code;?>"><span><? if ($selected):?><i class="fa fa-check"></i><? endif;?><?=$HeadLink['NAME'];?></a>
<? endforeach;?>
</div>