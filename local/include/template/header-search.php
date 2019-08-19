<? 
$SiteSection = OptimalGroup\SiteSection::Get();
$SearchUrl = "/clients/search/";
if ($SiteSection['CODE'] == "business")
    $SearchUrl = "/business/clients/search/";
//, товаров или услуг
?>

<a href="#" class="ink-reaction header-top--link"><i class="fa fa-search"></i></a>
<form class="header-search--form none" action="<?=$SearchUrl;?>">
    <div class="clearfix">
        <button class="btn btn-orange w-170 pull-right">Найти</button>
        <div class="header-search--form__input overflow">
            <i class="fa fa-search"></i>
            <input type="search" name="q" class="form-control" value="" placeholder="Поиск информации">
            <a href="#" class="js-input-clear"></a>
        </div>
    </div>
    <div class="none">
        <div class="header-search--form--title">Где искать</div>
        <div class="header-search--form--where">
            <div class="row">
                <div class="col col-12 col-sm-5">
                    <ul class="item-list">
                        <li class="radio"><label><input type="radio" name="1"><i></i><span>Везде</span></label></li>
                        <li class="radio"><label><input type="radio" name="1"><i></i><span>Помощь и поддержка</span></label></li>
                    </ul>
                </div>
                <div class="col col-12 col-sm-5">
                    <ul class="item-list">
                        <li class="radio"><label><input type="radio" name="1"><i></i><span>Контакты (отделения)</span></label></li>
                        <li class="radio"><label><input type="radio" name="1"><i></i><span>Интернет-магазин</span></label></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>