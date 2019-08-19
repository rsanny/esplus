<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$protocol = \Bitrix\Main\Config\Option::get("main", "mail_link_protocol", 'https', $arParams["SITE_ID"]);
$serverName = "//".$arParams[ 'SERVER_NAME' ];
//$arParams
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<style type="text/css">
		#outlook a {padding:0;}
        body,
        html {
            padding: 0;
            margin: 0;
            font-size: 12px;
            line-height: 18px;
            font-family: "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        }
        .body {
            background:#fff; 
            padding:20px 0;
            margin: 0;
        }
        .main-table {
            margin:0 auto; 
            border: 0;
        }
        .footer {
            background: #333333;
            color: #fff;
            padding: 38px 0;
        }
        .color-white {color: #fff;}
    </style>
</head>
<body>
    <div class="body">
        <table class="main-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <tr>
                    <td style="background: #fff; padding: 20px 0; border-bottom: 2px solid #d8e1e9">
                        <table class="main-table" width="900" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="<?=$serverName;?>">
                                            <img src="<?=$serverName;?>/local/media/images/logo.png" height="64">
                                        </a>                                    
                                    </td>
                                    <td align="right" style="font-size: 20px;">
                                        <? /*<b><?=$_SESSION['BXExtra']['REGION']['IBLOCK']['PHONE'];?></b>*/?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br><br>
                        <table class="main-table" width="900" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
<!-- ***************** END HEADER  ********************-->                        