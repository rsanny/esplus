<?
global $OptimalGroup;
?>
<? if ($OptimalGroup['DOMAIN'] == "oren"):?>
<?php $eUr = explode("?",$_SERVER["REQUEST_URI"])[0];?>
<?php if($eUr == "/2b58e24bcc6519c7b8f74fa6542bd874/dev_test_data.php"): ?>
<script src="https://nccchat.esplus.ru/chatlib/client.js"></script>
<script src="https://nccchat.esplus.ru/js/oren.js"></script>
<?php else:?>

<script type="text/javascript">
webim = {
    accountName: "esplusru",
    domain: "esplusru.webim.ru",
    location: "tpluskirov"
};
(function () {
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "https://esplusru.webim.ru/js/button.js?123";
    document.getElementsByTagName("head")[0].appendChild(s);
})();
</script>
<? endif;?>
<? endif;?>