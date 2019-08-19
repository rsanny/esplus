<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/company/disclosure_of_information/disclosure_in_accordance/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/disclosure_of_information/disclosure_in_accordance/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/business/service/contract/(.*)/(.*)/.*#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2&site_section=business',
    'ID' => '',
    'PATH' => '/service/contract/form/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/about/purchase/announcement/(.*)/.*#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/about/purchase/announcement/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/about/purchase/information/(.*)/.*#',
    'RULE' => 'SECTION_ID=$1',
    'ID' => '',
    'PATH' => '/about/purchase/information/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/company/copies_providing/archive/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/copies_providing/archive/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/service/contract/(.*)/(.*)/.*#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2&site_section=home',
    'ID' => '',
    'PATH' => '/service/contract/form/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/electrical-work/(.*)/.*#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/electrical-work/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/business/(.*)/(.*)#',
    'RULE' => '/$1/index.php?site_section=business',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/business/clients/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/clients/index.php?site_section=business',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^={$ClientSection}#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/clients/test.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/tariffs/(.*)/.*#',
    'RULE' => 'SECTION_CODE_PATH=$1',
    'ID' => '',
    'PATH' => '/tariffs/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/company/guide/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/guide/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/partners/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php?site_section=business',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/clients/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/clients/index.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/career/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/career/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/group/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php?site_section=business',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/promo/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/promo/index.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
