<?php

function route($method, $urlList, $requestData)
{

    // $ips = array("31.30.162.251");

    // if(!in_array($_SERVER['REMOTE_ADDR'], $ips))
    // {
    // header("HTTP/1.1 401 Unauthorized");
    // exit;
    // }

    global $Link;
    $token1 = "5824228201:AAEBCYaNaQEGnqfdrazTDjG4PNiW8dAsXI8";

    switch($method){

        case 'POST':

        $token = substr(getallheaders()['Authorization'], 7);
        $userFromToken = $Link->query("SELECT userId FROM tokens WHERE token = '$token'")->fetch_assoc();
        if(!is_null($userFromToken))
        { 
            $updates = $Link->query("SELECT * FROM updates");

            foreach($updates as $row){
                $chat_ids[] = $row['chat_id'];
            }
            $text = $requestData->body->text;

            foreach($chat_ids as $chat_id){
                $fp=fopen("https://api.telegram.org/bot{$token1}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
                echo $fp;    
            }

            if(!$fp)
            {
                setHTTPStatus("400", "Bad Request");
            }
            else
            {
                setHTTPStatus("200", "Success");
            }

            echo json_encode($requestData);
        }
        else
        {
            setHTTPStatus("401", "Unauthorized");
        }

        break;

        default:

        break;
    }
}