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
file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/" . basename(__FILE__, '.php') . "_debug.txt", print_r($this->props, true), FILE_APPEND | LOCK_EX);
    $this->props = array_merge($this->props, $props);
file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/" . basename(__FILE__, '.php') . "_debug.txt", print_r($this->props, true), FILE_APPEND | LOCK_EX);
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
    
//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);
    $arResult = json_decode($res, true);

    if($arResult['Code'] == 404)
    {
      $arResult['Message'] .= '. Подробности по телефону Контакт-центра.';
    }
    
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
    
//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);
    $arResult = json_decode($res, true);
    
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
    
//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);
    $arResult = json_decode($res, true);
    
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

//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);
    $arResult = json_decode($res, true);
    
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

//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);
    $arResult = json_decode($res, true);

    return $arResult;
  }

    public function MakePaymentSplitter($nlsid, $amount, $ord, $email, $phoneNumber, $json = "")
    {
        $arParams = array(
            'nlsid' => $nlsid,
            'amount' => $amount,
            'ord' => $ord,
            'cur' => 810,
            'returnurl' => 'http://' . $_SERVER['SERVER_NAME'] . '/payment_result.php?order=' . $ord,
            'host' => $_SERVER['REMOTE_ADDR'],
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'appid' => $this->props['appid'],
            'uid' => $this->props['uid'],
            'format' => 'json'
        );
        $arParams['sign'] = $this->MakeSign($arParams);

        $url = '/Handlers/API/MakePaymentSplitter.ashx?' . http_build_query($arParams);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->props['server'] . $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($output, true);

        return $result;
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
//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);
    $arResult = json_decode($res, true);
    
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

//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);

    $arResult = json_decode($res, true);
    
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

//    $res = file_get_contents($this->props['server'].$url);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);

    $arResult = json_decode($res, true);
    
    return $arResult;
  }

  public function GetListPaymentSplitter($nlsid)
    {
        $arParams = array(
            'nlsid' => $nlsid,
            'appid' => $this->props['appid'],
            'uid' => $this->props['uid'],
        );
        $arParams['sign'] = $this->MakeSign($arParams);

        $url = '/handlers/api/ListPaymentSplitter.ashx?'.http_build_query($arParams);
$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 10,
    )
));
        $res = file_get_contents($this->props['server'].$url, false, $ctx);

        $arResult = json_decode($res, true);

        return $arResult;
    }
}
