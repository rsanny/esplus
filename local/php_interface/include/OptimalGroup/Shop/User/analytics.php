<?
namespace OptimalGroup;
AddEventHandler('main', 'OnAfterUserAuthorize', array('\OptimalGroup\UserShop', 'Auth'));
AddEventHandler('main', 'OnAfterUserRegister', array('\OptimalGroup\UserShop', 'Register'));
class UserShop {
    function Submit($data){
        global $APPLICATION;
        $APPLICATION->AddViewContent("events_js_script", "<script>OptimalGroup.analytics.Submit(".json_encode($data).");</script>");
    }
    function Auth($arUser){            
        $Analytics = array(
            "ga" => array(
                "category" => "im-lk",
                "action" => "shop-lk"
            ),
            "ym" => "shop-lk"
        );
        self::Submit($Analytics);
    }
    function Register($arFields){
        if($arFields['ID'] > 0){
            $Analytics = array(
                "ga" => array(
                    "category" => "im-lk",
                    "action" => "shop-reg"
                ),
                "ym" => "shop-reg"
            );
            self::Submit($Analytics);
        }
    }
}