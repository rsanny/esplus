<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?php 
//session_start();
/*print("<pre>");
print_r($_SERVER);
print("</pre>");*/
/*print("<pre>");
print_r($_SESSION["fixed_session_id"]);
print("</pre>");*/
$filescript = "dev_test_data.php";
$requertUri = $_SERVER["DOCUMENT_ROOT"];
$url_all = $_SERVER["REQUEST_URI"];

$url = explode("?",$url_all)[0];
$urlfolder = explode("$filescript",$url)[0];
$dataPath = "{$requertUri}{$urlfolder}";
require("{$dataPath}classLoginPass.php");
$tSes = LoginPassBasa::ses();
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//use DorrBitt\ClassDebug\ClassDebug;
//$APPLICATION->SetTitle("Test Chat");
?>
<?php 

if(is_array($_POST) && !empty($_POST)){
    $dLogin = LoginPassBasa::trim($_POST["user_1"]);
    $dPass = LoginPassBasa::md5(LoginPassBasa::trim($_POST["pass_1"]));

    if( ($dLogin == LoginPassBasa::login()) && ($dPass == LoginPassBasa::pass())){
        LoginPassBasa::redirect("{$urlfolder}{$filescript}?result={$tSes}");
    }
    else{
        LoginPassBasa::redirect("{$urlfolder}{$filescript}?error={$tSes}"); 
    }
}
$region = LoginPassBasa::name_region();
if(is_array($_GET) && !empty($_GET)){
    $res = LoginPassBasa::login_result();
    $rDostup = ((!empty(LoginPassBasa::userIzSee()) && !empty($res)) && (LoginPassBasa::userIzSee() == $res) && !empty($region)) ? 1 : 0;
}
else{
    $rDostup = ((!empty(LoginPassBasa::userIzSee()) && !empty(LoginPassBasa::login())) && (LoginPassBasa::userIzSee() == LoginPassBasa::login()) && !empty($region)) ? 1 : 0;
}
?>

    <?php if($rDostup == 1):?>
    <a href="<?=$url?>?error=<?=$tSes?>" class="seans-link" style="display:block; width:160px; margin:20px auto;" >завершить сеанс - <?=LoginPassBasa::userIzSee()?></a>



    <?php elseif($rDostup == 0):?>
        <form action="<?=$url?>?s=<?=$tSes?>" method="POST" >
    
    <div class="form" style="width:500px; margin:50px auto;" >
        <div class="row form-group flex-vertical">
            <div class="col col-12 col-md-4 col-lg-5 text-left form-label">
                <label for="SIMPLE_QUESTION_891">Логин <span class="color-orange">*</span></label>
            </div>
            <div class="col col-12 col-md-8 col-lg-7">
                <input id="user_1" type="text" name="user_1" class="form-control" placeholder="" value="">
            </div>
        </div>
        <div class="row form-group flex-vertical">
            <div class="col col-12 col-md-4 col-lg-5 text-left form-label">
                <label for="SIMPLE_QUESTION_646">Пароль <span class="color-orange">*</span></label>
            </div>
            <div class="col col-12 col-md-8 col-lg-7">
            <input id="pass_1" type="password" name="pass_1" class="form-control" placeholder="" value="" >
            </div>
        </div>
    
    <div class="row form-group">
        <div class="col col-12 col-md-8 offset-md-4 col-lg-7 offset-lg-5 text-md-left text-center">
            <button class="btn btn-orange w-170 1" name="web_form_submit" value="Войти" >Войти</button>
        </div>
    </div>
    </div>
    
    </form>
    <?php endif;?>
    <?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>