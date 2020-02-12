<section class="fixed-btn hidden-md-down clearfix">
    <a href="#" class="ink-reaction btn-callback js-popUpData" data-fancybox-href="<?=AJAX_PATH;?>form/callback.php"><i></i>Обратный
звонок</a>
    <?php $eUr = explode("?",$_SERVER["REQUEST_URI"])[0];?>
        <?php if($eUr == "/2b58e24bcc6519c7b8f74fa6542bd874/dev_test_data.php"): ?>
        <a href="#" class="chat-label ink-reaction btn-chat" style="background: #383838 !important;" ><i></i>Онлайн-<br>чат</a>
        <?php else:?>
        <a href="#" class="ink-reaction btn-chat" rel="webim"><i></i>Онлайн-<br>чат</a>
    <?php endif;?>

</section>