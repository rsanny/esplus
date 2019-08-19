<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$protocol = \Bitrix\Main\Config\Option::get("main", "mail_link_protocol", 'https', $arParams["SITE_ID"]);
$serverName = "//".$arParams[ 'SERVER_NAME' ];
//$arParams
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<style type="text/css">
        body,html {
            padding: 0;
            margin: 0;
            color: #657480;
        }
        body,html,.body td {
            font-size: 14px;
            line-height: 18px;
            font-family: "Tahoma", "Geneva", sans-serif;
        }
        .body {
            background:#fff; 
            padding:20px 0;
            margin: 0;
            min-width: 700px;
        }
        .main-table {
            margin:0 auto; 
            border: 0;
        }
        .footer {
            color: #657480;
            padding: 0 0 20px;
            border-top: 1px solid #f15922;
            font-size: 14px;
        }
        .color-white {color: #ffffff;}
        .color-orange {color: #f15922}
        .color-gray {color: #657480}
        .btn {
            background-color: #f15922;
            text-decoration: none;
            font-size: 14px;
            line-height: 1;
            text-align: center;
            padding: 15px 0;
            display: block;
            color: #ffffff !important;
            width: 200px;
            border-radius: 5px;
        }
        .btn-td {            
            text-align: center;
            padding: 10px;
            vertical-align: middle;
        }
        .btn-menu {
            display: block;
            font-size: 14px;
            text-decoration: none;
            height: 20px;
            line-height: 20px;
            color: #ffffff;
        }
        .footer-icon {
            display: inline-block;
            vertical-align: middle;
            font-size: 10px;
        }
        .footer-icon {
            padding-right: 10px;
        }
        .footer-icon--start {
            padding: 0 10px 0 20px;
        }
    </style>
</head>
<body>
    <div class="body">
        <div style="letter-spacing: 496px; line-height: 0; mso-hide: all">&nbsp;</div><!-- nbsp is 4px wide -->
        <table class="main-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <tr>
                    <td style="background: #fff; padding: 20px 10px;">
                        <table class="main-table" width="700" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="<?=$serverName;?>">
                                            <img src="/local/media/images/logo.png" height="64">
                                        </a>                                    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #f15922; padding: 0 10px">
                        <table class="main-table" width="700" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="25%" class="btn-td" nowrap><a href="https://esplus.ru/?site_section=home" class="btn-menu">Для дома</a></td>
                                <td width="25%" class="btn-td" nowrap><a href="https://esplus.ru/?site_section=business" class="btn-menu">Для бизнеса</a></td>
                                <td width="25%" class="btn-td" nowrap><a href="https://shop.esplus.ru/" class="btn-menu">Интернет-магазин</a></td>
                                <td width="25%" class="btn-td" nowrap><a href="https://shop.esplus.ru/clients/" class="btn-menu">Помощь и поддержка</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 10px">
                        <table class="main-table" width="700" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
<!-- ***************** END HEADER  ********************-->                        