<?
global $OptimalGroup;
$arLinks = \OptimalGroup\SiteSection::names;
unset($arLinks['shop']);
?>
<div class="menu-switch">
<?
foreach($arLinks as $codeKey=>$HeadLink):
    $selected = false;
    $code = $HeadLink['CODE'];
    if ($OptimalGroup['SITE']['CODE'] == $code)
        $selected = true;
?>
    <a class="<? if ($selected):?>is-selected<? endif;?>"><span><?=$HeadLink['NAME'];?></a>
<? endforeach;?>
</div>