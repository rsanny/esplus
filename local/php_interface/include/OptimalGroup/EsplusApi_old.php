<?
class esplusApi {
  private $props = array(
    'server' => 'https://lkk-ekb.esplus.ru',
  );
  public function __construct($props)
  {
    if(!!$_SESSION['BXExtra']['REGION']['IBLOCK']['API_URL'])
    {
      $props['server'] = $_SESSION['BXExtra']['REGION']['IBLOCK']['API_URL'];
    }
    $this->props = array_merge($this->props, $props);
  }
  
  /*Логирование, Добавлено 27.05.2019*/
  private function Logging($func, $arParams)
  {
    $date = date("d.m.Y H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $sub = array_shift((explode('.', $_SERVER['HTTP_HOST'])));
    $url = $_SERVER['REQUEST_URI'];
    
    $fname = "/home/bitrix/log/".$sub."/log.txt";
    $content =  "\n".$date.
                "\t".str_pad($func, 20).
                "\t".$this->props['uid'].
                "\t".$this->props['key'].
                "\t".str_pad($ip, 15).
                "\t".$url.
                "\t".json_encode($arParams, JSON_UNESCAPED_UNICODE);
                
    if (!file_exists('/home/bitrix/log/'.$sub)) {
        mkdir('/home/bitrix/log/'.$sub, 0777, true);
    }
    $fp = fopen($fname,"a");
    fwrite($fp,$content);
    fclose($fp);
    if(filesize($fname) > 1048576){
        rename($fname, "/home/bitrix/log/".$sub."/log_".time().".txt") ;
    }
  }
  
  private function MakeSign($arParams)
  {
    $sign = $this->props['uid'];
    ksort($arParams);
    foreach($arParams as $key => $value)
    {
      $sign .= strtolower($key).'='.$value;
    }
    $sign .= $this->props['key'];
    return md5($sign);
  }

  
  public function GetAbonentInfo($nlsid)
  {
    $arParams = array(
      'nlsid' => $nlsid,
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
    );
    $arParams['sign'] = $this->MakeSign($arParams);
    $url = '/Handlers/API/GetAbonentInfo.ashx?'.http_build_query($arParams);
    
    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);

    if($arResult['Code'] == 404)
    {
      $arResult['Message'] .= '. Подробности по телефону Контакт-центра.';
    }
    
    $this->Logging("GetAbonentInfo", $arParams);
    
    return $arResult;
  }

  public function GetCountersInfo($nlsid)
  {
    $arParams = array(
      'nlsid' => $nlsid,
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
    );
    $arParams['sign'] = $this->MakeSign($arParams);
    $url = '/Handlers/API/GetCountersInfo.ashx?'.http_build_query($arParams);
    
    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("GetCountersInfo",$arParams);
    
    return $arResult;
  }

  public function GetBillState($nlsid)
  {
    $arParams = array(
      'nlsid' => $nlsid,
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
    );
    $arParams['sign'] = $this->MakeSign($arParams);

    $url = '/handlers/api/getbillstate.ashx?'.http_build_query($arParams);
    
    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("GetBillState",$arParams);
    
    return $arResult;
  }

  public function SendRounds($nlsid, $id, $Serial, $Sh1, $Sh2)
  {
    $arParams = array(
      'nlsid' => $nlsid,
      'id' => $id,
      'serial' => $Serial,
      'sh1' => $Sh1,
      'sh2' => $Sh2,
      'channel' => $this->props['channel'],
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
    );
    $arParams['sign'] = $this->MakeSign($arParams);

    $url = '/handlers/api/sendrounds.ashx?'.http_build_query($arParams);

    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("SendRounds",$arParams);
    
    return $arResult;
  }

  public function MakePayment($nlsid, $amount, $ord, $email, $phoneNumber)
  {
    $arParams = array(
      'nlsid' => $nlsid,
      'amount' => $amount,
      'ord' => $ord,
      'cur' => 810,
      'returnurl' => 'http://'.$_SERVER['SERVER_NAME'].'/payment_result.php?order='.$ord,
      'host' => $_SERVER['REMOTE_ADDR'],
      'email' => $email,
      'phoneNumber' => $phoneNumber,
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
      'format' => 'json'
    );
    $arParams['sign'] = $this->MakeSign($arParams);

    $url = '/Handlers/API/MakePayment.ashx?'.http_build_query($arParams);

    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("MakePayment",$arParams);
    
    return $arResult;
  }

  public function Registration($nlsid, $house, $litera, $flat, $extflat, $email, $password, $spamacception)
  {
    $arParams = array(
      'registration' => '{"nlsid":"'.$nlsid.'","house":"'.$house.'","litera":"'.$litera.'","flat":"'.$flat.'","email":"'.$email.'","extraflat":"'.$extflat.'","spamacception":"'.$spamacception.'","password":"'.md5($password).'"}',
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
      'clientType' => 'site'
    );
    $arParams['sign'] = $this->MakeSign($arParams);

    $url = '/Handlers/API/Mobile/Individuals/Registration.ashx?'.http_build_query($arParams);
    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("Registration",$arParams);
    
    return $arResult;
  }

  public function RecoveryPassword($login)
  {
    $arParams = array(
      'login' => $login,
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
    );
    
    $arParams['sign'] = $this->MakeSign($arParams);

    $url = '/Handlers/API/Mobile/Individuals/RecoveryPassword.ashx?'.http_build_query($arParams);

    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("RecoveryPassword",$arParams);
    
    return $arResult;
  }

  public function CheckPayment($ord)
  {
    $arParams = array(
      'ord' => $ord,
      'appid' => $this->props['appid'],
      'uid' => $this->props['uid'],
    );
    
    $arParams['sign'] = $this->MakeSign($arParams);

    $url = '/Handlers/API/GetPaymentState.ashx?'.http_build_query($arParams);

    $res = file_get_contents($this->props['server'].$url);

    $arResult = json_decode($res, true);
    
    $this->Logging("CheckPayment",$arParams);
    
    return $arResult;
  }
}