<?php

namespace DorrBitt\catalogPriceType;
/*
* array price [ ID элементва (товара) ID типа цены]
*/
Class CatalogPriceType {

  public static function priceElement($id_tovar,$catalog_group_id){
      return GetCatalogProductPrice($id_tovar, $catalog_group_id);
      }
}

/*
$db_res = CCatalogGroup::GetGroupsList(array("GROUP_ID"=>2, "BUY"=>"Y"));
    while ($ar_res = $db_res->Fetch()){
    echo $ar_res["CATALOG_GROUP_ID"].", ";
    }
*/
?>