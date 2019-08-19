<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader,
    Bitrix\Main\Context;

class ESplusAuth extends CBitrixComponent {
    private function PostResult($postData, $type){
        if (empty($type))
            return ['Code'=>'type'];
        $url = $this->api['URL'].$type.'?'.http_build_query($postData);
        pr($url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_TIMEOUT, 10);        
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }
    private function checkRegistration(){
        $arError = false;
        foreach ($this->postForm as $code=>$value){
            if (
                $code == 'personalAccount' && empty($value) ||
                $code == 'number' && empty($value) ||
                $code == 'emailAddress' && empty($value) ||
                $code == 'emailAddress' && !filter_var($value, FILTER_VALIDATE_EMAIL) ||
                $code == 'password' && empty($value)
            ){
                $arError['FIELDS'][$code] = $code;
            }
        }
        if (!$this->postForm['agree']){
            $arError['VISIBLE'][] = 'Необходимо принять условия обработки данных';
        }
        return $arError;
        
    }
    private function checkLogin(){
        $arError = false;
        if (empty($this->postForm['login']) || !filter_var($this->postForm['login'], FILTER_VALIDATE_EMAIL))
            $arError['FIELDS']['login'] = "login";
        
        return $arError;
    }
    private function checkAuth(){
        $arError = false;
        if (!$this->postForm['password'])
            $arError[] = 'password';
        if ($this->postForm['type'] == 'home' && !$this->postForm['login'])
            $arError[] = 'login';
        elseif ($this->postForm['type'] == 'bussines' && !$this->postForm['login-yur'])
            $arError[] = 'login';
        
        return $arError;
    }
    private function ClearPostFields($postData){        
        unset($postData['login-yur']);
        unset($postData['method']);
        unset($postData['type']);
        unset($postData['agree']);
        
        return $postData;
    }
    private function MakePost(){
        $request = Context::getCurrent()->getRequest();
        $post = $request->getPostList()->toArray();
        $this->arResult['POST'] = 
        $this->postForm = $post[$this->arParams['FORM_NAME']];
        $arError = false;
        if ($request->isPost() && check_bitrix_sessid()) { 
            $postData = array_merge($this->postForm, [
                'format' => 'json',
                'uid' => $this->api['UID'],
                'sign' => $this->api['SIGN']
            ]);
            $postType = $this->postForm['method'];   
            
            switch ($this->postForm['method'])
            {
                case 'Authentication':
                    $arError = $this->checkAuth();
                    if ($this->postForm['type'] != 'home' && $postData['login-yur']){
                        $postData['login'] = $postData['login-yur'];
                    }
                break;
                case 'Registration':
                    $arError = $this->checkRegistration();                    
                    if (!$postData['newsSubscription']){
                        $postData['newsSubscription'] = "False";
                    }
                    if (!$postData['receiptSubscription']){
                        $postData['receiptSubscription'] = "False";
                    }
                break;
                    
                case 'ForgotPassword':
                    $arError = $this->checkLogin();
                break;
            }
            if (!$arError) {
                $clearPostData = $this->ClearPostFields($postData);
                $PostResult = $this->PostResult($clearPostData, $postType);
                pr($PostResult);
                switch ($PostResult['Code'])
                {
                    case '200000':
                        $sSuccess = $PostResult?:true;
                    break;     
                    /*case '403002':
                        $arError['VISIBLE'][] = 'Адрес электронной почты не подтвержден';
                    break;
                    case '4043005':
                        $arError['VISIBLE'][] = 'Учетная запись не найдена';
                    break;
                    case '401003':
                        $arError['VISIBLE'][] = 'Слишком много попыток входа. Попробуйте чуть позже';
                    break;
                    case '401007':
                        $arError['VISIBLE'][] = 'Требуется подтверждение учетной записи';
                    break;                   
                    case '4002516':
                        $arError['VISIBLE'][] = 'Под данные характеристики подходит больше одного объекта обслуживания';
                    break;
                    case '4042516':
                        $arError['VISIBLE'][] = 'Информация об объекте(-ах) обслуживания не найдена';
                    break;
                    case '401011':
                        $arError['VISIBLE'][] = 'Объект обслуживания уже привязан к учетной записи';
                    break;
                    case '401009':
                        $arError['VISIBLE'][] = 'Адрес указанной электронной почты уже используется';
                    break;*/
                    case '401001':
                        if ($postType == "Registration")
                            $arError['VISIBLE'][] = 'Пароль должен содержать как минимум 8 символов, цифры и буквы латинского алфавита';                        
                        else 
                            $arError['VISIBLE'][] = 'Неверный логин или пароль';
                    break;
                        
                    case 'type':
                        $arError[] = 'Неверный тип данных';
                    break;

                    default:
                        $arError['VISIBLE'][$PostResult['Code']] = $PostResult['Message'];
                    break;
                }
            }
            if ($arError)
                $this->arResult['ERRORS'] = $arError;
            else 
                $this->arResult['SUCCESS'] = $sSuccess;
            
        }
    }
    
    public function executeComponent()
    {
        $this->api = [
            'URL' => 'https://api.esplus.ru/v1/Account/',
            'SIGN' => '123j4hg1k2j3hg4k12gf34j12h3g4kj12hg4',
            'UID' => 'ad3336d1f29f466dbefcd01a34c14db1',
        ];
        $this->arResult['USER_TYPE'] = 'fiz';
        if ($this->arParams['SITE_TYPE'] == 'business')
            $this->arResult['USER_TYPE'] = 'yur';
        $this->MakePost();
        $this->includeComponentTemplate();
        return $this->arResult;
    }
}