<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<h1>Подтверждение адреса электронной почты</h1>
<?
global $SECRET_KEY,$USER;

if(isset($_REQUEST['code'])){
  $USER_ID = (int)$_REQUEST['id'];
  $CONFIRM_CODE = $_REQUEST['code'];
  $arUser = CUser::GetByID($USER_ID)->GetNext();
  if($arUser['ID']){
    $CHECK_CODE = md5($arUser['ID'].'_'.$arUser['EMAIL'].'_'.$SECRET_KEY);
    if($CHECK_CODE == $CONFIRM_CODE){
      $arGroups = CUser::GetUserGroup($arUser['ID']);
      $arGroups[] = 7;
      CUser::SetUserGroup($arUser['ID'], $arGroups);
      $USER->Logout();
      $USER->Authorize($arUser['ID']);

      $arEventFields = array(
        'FIO' => implode(' ', array($arUser['NAME'],$arUser['LAST_NAME'],$arUser['WORK_NAME'],$arUser['WORK_COMPANY'])),
        'PHONE' => $arUser['PERSONAL_PHONE']?$arUser['PERSONAL_PHONE']:$arUser['WORK_PHONE'],
        'EMAIL' => $arUser['EMAIL'],
      );
      CEvent::Send("USER_EMAIL_CONFIRMED", SITE_ID, $arEventFields);

      $arResult['IS_SUCCESS'] = 'Y';
    }else{
      $arResult['IS_ERROR'] = 'Y';
    }
  }
  ?>
  <?if($arResult['IS_SUCCESS']=='Y'):?>
  <p>
    Адрес электронной почты <b>успешно подтвержден</b>! <br>
    Вы можете перейти в <a href="/personal/">личный кабинет</a> и полностью оплатить свои <a href="/personal/order/">заказы</a> или закончить <a href="/order/">оформление текущего заказа</a>.
  </p>
  <?else:?> 
  <p>
    Произошла <b>ошибка при подтверждении</b> адреса электронной почты! <br>
    Вы можете <u>попробовать еще раз</u> или <a href="/contacts/">свяжитесь с администрацией магазина</a> по телефону, указанному в шапке сайта.
  </p>
  <?endif?>
<?
}elseif($_REQUEST['send']=='Y'){
  $_REQUEST['email'] = urldecode($_REQUEST['email']);
  //echo $_REQUEST['email'];
  $arUser = CUser::GetList(($by='sort'),($order='asc'),array('EMAIL'=>$_REQUEST['email']))->GetNext();
  if($arUser['ID']){
    $arEventFields = array(
      'USER_ID'       => $arUser['ID'],
      'LOGIN'         => $arUser['LOGIN'],
      'EMAIL'         => $arUser['EMAIL'],
      'NAME'          => $arUser['NAME'],
      'LAST_NAME'     => $arUser['LAST_NAME'],
      'CONFIRM_CODE'  => md5($arUser['ID'].'_'.$arUser['EMAIL'].'_'.$SECRET_KEY),
      'UPDATE_PASSWORD'  => 'N',
    );
    CEvent::Send("USER_INFO", SITE_ID, $arEventFields);
    $arResult['IS_SUCCESS']='Y';
  }else{
    $arResult['IS_ERROR']='Y';
  }
  ?>
  <?if($arResult['IS_SUCCESS']=='Y'):?>
  <p>
    На Ваш адрес электронной почты был <b>выслан код подтверждения</b>, пожалуйста проверьте почту.<br>
  </p>
  <?else:?>
  <p>
    Пользователя с указанным адресом электронной почты не существует, пожалуйста укажите верный адрес или зарегистрируйтесь заново.
  </p>
  <?endif?>
  <?
}
?>
<?if($arResult['IS_SUCCESS']!='Y'):?>
<form action="">
  <h3>Выслать код подтверждения:</h3>
  <input type="text" name="email" placeholder="email">
  <button type="submit" name="send" value="Y">Отправить</button>
</form>
<?endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>