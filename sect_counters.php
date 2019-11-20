<?
global $OptimalGroup;
?>
<? if ($OptimalGroup['DOMAIN'] == "oren"):?>
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