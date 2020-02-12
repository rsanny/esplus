<?
$arNewWeb = array(
    "komi" => [
        'name' => 'komiesc.ru',
        'address' => 'http://komiesc.ru'
    ],
    "ivanovo" => [
        'name' => 'garant-ivanovo.ru',
        'address' => 'http://garant-ivanovo.ru'
    ]
);
?>
<div class="col col-5 col-md-4 col-lg-10">
    <div class="header-auth text-right mb-lg-10 mb-xl-20">
        <a href="<?=$arNewWeb[$OptimalGroup['DOMAIN']]['address'];?>" class="btn btn-auth w-200"><span class="fa-angle-btn"><?=$arNewWeb[$OptimalGroup['DOMAIN']]['name'];?></span></a>
    </div>
</div>