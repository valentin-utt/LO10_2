<?php


/**
 * Description of EtuUttAuth
 *
 * @author val-r
 */

include('./Interface/IEtuUttAuth.php');


class EtuUttAuth implements IEtuUttAuth {
    
    function getAccessToken($authCode){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://etu.utt.fr/api/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=authorization_code&client_id=24048099025&client_secret=4f418cf975e0a7bf4f04176553ebcec7&authorization_code=" . $authCode,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/x-www-form-urlencoded",
                "Host: etu.utt.fr",
                "User-Agent: PostmanRuntime/7.11.0",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    function getEtuUttUserInfoRequest($token){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://etu.utt.fr/api/private/user/account?access_token=" . $token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_REFERER => "www.projector.net",
            //CURLOPT_AUTOREFERER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            //CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    
    
}
