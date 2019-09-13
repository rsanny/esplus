<?
//2018-03-06T15:18:35+03:00
//$_REQUEST['RESULT_ID'] = 11419;

if ($arResult["isFormNote"] == "Y" && $_REQUEST['RESULT_ID']){
    $date = new DateTime();
    $date->add(new DateInterval('PT3M'));
    $Time = $date->format('c');
    $arrVALUES = CFormResult::GetDataByIDForHTML($_REQUEST['RESULT_ID']);
    //pr($arrVALUES);
    if ($arrVALUES['form_dropdown_SIMPLE_QUESTION_533']){
        $rsAnswer = CFormAnswer::GetByID($arrVALUES['form_dropdown_SIMPLE_QUESTION_533']);
        $arAnswer = $rsAnswer->Fetch();
        
        $FormData = array(
            "PHONE" => str_replace(array(" ", "-",")","("),"",$arrVALUES['form_text_2']),
            "NAME" => $arrVALUES['form_text_1'],
            "SUBJECT" => $arAnswer['MESSAGE']
        );
    }
    
    if ($FormData){
        $XmlPost = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
        <callcase>
                <title>'.$FormData['NAME'].'</title>
                <comment>No comments</comment>
                <state>
                        <id>adjourned</id>
                </state>
                <scheduledTime>'.$Time.'</scheduledTime>
                <phoneNumbers>
                        <phoneNumber phoneNumberType="MOBILE">'.$FormData['PHONE'].'</phoneNumber>
                </phoneNumbers>
                <callForm>
                    <group id="groupID"/>
                    <attribute id="theme" group="groupID">
                            <value>'.$FormData['SUBJECT'].'</value>
                    </attribute>
                </callForm>
        </callcase>';
        //pr($XmlPost);
        $BranchCode = "corebo00000000000m4bmi64r0vrvjgk";
        $url = "178.208.148.6:8080";
        $username = 'wsrest';
        $password = '123';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://'.$url.'/fx/api/xml/callcases/?project='.$BranchCode);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_TIMEOUT, 4);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $XmlPost);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $FormData['TIME'] = $Time;
        $json_result = array(
            "RESPONSE" => $result,
            "RESPONSE_INFO" => $info,
            "FORM" => $FormData
        );
        \OptimalGroup\Core::saveJSON($json_result,"callback");
        //pr($info);
    }
}
?>