<?
class __ESPLUSAuth {
    function OnUserLoginExternal( & $args ) {
        $login = "'" . $args[ 'LOGIN' ] . "'";
        $ApiPath = $_SESSION[ 'BXExtra' ][ 'REGION' ][ 'IBLOCK' ][ 'API_URL' ] ? : 'https://lkk-ekb.esplus.ru';
        if ( $args[ 'PASSWORD_ORIGINAL' ] == 'Y' ) {
            $pass = "'" . md5( $args[ 'PASSWORD' ] ) . "'";
        } else {
            $pass = "'" . $args[ 'PASSWORD' ] . "'";
        }
        $PersonalData = false;
        if ( $_REQUEST[ 'USER_TYPE' ] == 'fiz' ) {
            $res = file_get_contents(($ApiPath) . "/Services/Auth.asmx/Safe?part=&login=" . urlencode( $login ) . "&password=" . urlencode( $pass ) . "&format=json" );
            $PersonalData = file_get_contents(($ApiPath) . "/Handlers/API/GetAbonentInfo.ashx?nlsid=" . urlencode( $login ) . "&format=json" );
        } else {
            //$res = file_get_contents(($_SESSION['BXExtra']['REGION']['IBLOCK']['API_URL']?:'https://lkk-ekb.esplus.ru')."/Services/ArtifitialAuth.asmx/AuthHubSafe?part=&login=".urlencode($login)."&password=".urlencode($pass)."&format=json");
            $res = file_get_contents( ( $_SESSION[ 'BXExtra' ][ 'REGION' ][ 'IBLOCK' ][ 'API_URL' ] ? : 'https://lkk-ekb.esplus.ru' ) . "/Services/ArtifitialAuth.asmx/Safe?part=&login=" . urlencode( $login ) . "&password=" . urlencode( $pass ) . "&format=json" );
        }

        $res = json_decode( substr( $res, 1, -2 ), 1 );
        if ( $res[ 'd' ] == 'true' ) {
            if ( stripos( $args[ 'LOGIN' ], '@' ) !== false ) {
                $email = $args[ 'LOGIN' ];
            } else {
                $email = $args[ 'LOGIN' ] . '@esplus.ru';
            }
            $arFields = Array(
                "LOGIN" => $email,
                "NAME" => $args[ 'LOGIN' ],
                "PASSWORD" => $pass,
                "EMAIL" => $email,
                "GROUP_ID" => 7,
                "ACTIVE" => "Y",
                "EXTERNAL_AUTH_ID" => "ESPLUS",
                "LID" => SITE_ID
            );

            $oUser = new CUser;
            $res = CUser::GetList( $O, $B, Array( "LOGIN_EQUAL_EXACT" => $arFields[ 'LOGIN' ], "EXTERNAL_AUTH_ID" => "ESPLUS" ) );
            if ( !( $ar_res = $res->Fetch() ) )
                $ID = $oUser->Add( $arFields );
            else {
                $ID = $ar_res[ "ID" ];
                $oUser->Update( $ID, $arFields );
            }
            if ( $ID > 0 ) {
                // можно авторизовывать
                $arArgs[ "store_password" ] = "N";
                return $ID;
            }
        }
        return false;
    }

    function OnExternalAuthList() {
        return Array(
            Array( "ID" => "ESPLUS", "NAME" => "Esplus" )
        );
    }
}
?>