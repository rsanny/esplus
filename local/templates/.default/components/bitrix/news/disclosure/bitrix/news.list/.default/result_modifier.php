<?
$arSectionsId = 
    $arItems = 
    $arResult['FILTERED'] = 
    $arResult['SECTIONS'] = array();
foreach ($arResult['ITEMS'] as $arItem){
    $arSectionsId[] = $arItem['IBLOCK_SECTION_ID'];
}
if ($arSectionsId){
    $arSectionsId = array_unique($arSectionsId);
    $rsSect = CIBlockSection::GetList(
        array('SORT' => 'ASC'),
        array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'], 
            'DEPTH_LEVEL'=>$arParams['CURRENT_SECTION']['DEPTH_LEVEL'] + 1,
            'ID' => $arSectionsId
        )
    );
    while ($arSect = $rsSect->GetNext()){
        $arResult['SECTIONS'][$arSect['ID']] = $arSect;
    }
    foreach ($arResult['ITEMS'] as $arItem){
        $hasSection = $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']];
        if ($hasSection){
            $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
        }
        else {
            $arResult['FILTERED'][] = $arItem;
        }
    }
}

function ShowFileItem($arItem){
    if ($arItem['PROPERTIES']['PAGE_LINK']['VALUE']){
        $fileSrc = $arItem['PROPERTIES']['PAGE_LINK']['VALUE'];
        $fileExt = GetFileExtension($fileSrc);
        $fileType = "link";
        $target = ' target="_blank"';
    }
    else {
        $arFile = CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
        $fileSrc = $arFile['SRC'];
        $fileExt = $arFile['CONTENT_TYPE'];
        $fileType = "pdf";
        $target = "";
    }
    if (strpos($fileExt,"word") !== false || strpos($fileExt,"doc") !== false)
        $fileType = "doc";
    if (strpos($fileExt,"spreadsheetml") !== false || strpos($fileExt,"excel") !== false || strpos($fileExt,"xls") !== false)
        $fileType = "exl";
    $name = $arItem['PREVIEW_TEXT']?$arItem['PREVIEW_TEXT']:$arItem['NAME'];
    return '<a href="'. $fileSrc .'" class="file-item--small"'.$target.'>
        <span><i class="icon-file--'. $fileType.'"></i></span>
        <b>'.$name.'</b>
    </a>';
}