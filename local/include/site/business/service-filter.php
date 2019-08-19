<?
$arFilter = array();
$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>26, "CODE"=>"TYPE"));
while($enum_fields = $property_enums->GetNext())
{
    $arFilter[$enum_fields["ID"]]= $enum_fields["VALUE"];
}
?>
<div class="business-service--filter mb-50 js-BusinessFilter text-center hidden-sm-down" data-url="<?=$service_path;?>/index_service.php">
    <span>Тип Бизнеса:</span>
    <a href="<?=$APPLICATION->GetCurPage();?>" data-business-type="" data-count="<?=$Count;?>" class="color-orange">Все</a>
    <? foreach ($arFilter as $id=>$filter):?>
    <a href="#" data-business-type="<?=$id;?>" data-count="<?=$Count;?>" class="dotted"><?=$filter;?></a>
    <? endforeach;?>
</div>
<div class="hidden-md-up mb-50 business-service--filter" data-url="<?=$service_path;?>/index_service.php">
    <div class="form-select js-select">
        <select class="js-BusinessFilterSelect">
            <option data-business-type="" data-count="<?=$Count;?>" selected>Все</option>
            <? foreach ($arFilter as $id=>$filter):?>
            <option data-business-type="<?=$id;?>" data-count="<?=$Count;?>"><?=$filter;?></option>
            <? endforeach;?>
        </select>
        <i class="fa fa-angle-down"></i>
    </div>
</div>
<script>
$(function(){
    $('body').on('click','.business-service--filter a', OptimalGroup.BusinessFilter);
    $('body').on('change','.js-BusinessFilterSelect', OptimalGroup.BusinessFilter);
});
OptimalGroup.BusinessFilter = function(e){
    e.preventDefault();
    var container = $(this).closest('.business-service--filter'),
        url = container.data('url'),
        content = $('.business-service'),
        data;
    container.find('a').addClass('dotted');
    container.find('a').removeClass('color-orange');
    if ($(this).is('a')){
        $(this) 
            .removeClass('dotted')
            .addClass('color-orange');
        data = $(this).data();
    }
    else {
        data = $(this).find('option:selected').data();
    }
    console.log(data);
    $.ajax({
        url:url,
        data:data,
        success:function(html){
            content.html(html);
        }
    });
};
</script>