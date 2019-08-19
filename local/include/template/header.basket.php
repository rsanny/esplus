<?
$inCart = \OptimalGroup\Catalog::InCart();
?>
<span><?=count($inCart['CART']);?></span>
<a href="/cart/" class="btn btn-orange btn-square"><i class="icon-cart btn-icon"></i></a>