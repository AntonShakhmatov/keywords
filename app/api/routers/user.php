<?php

function route($method, $urlList, $requestData)
{
    global $Link;
    switch($method){
        case 'GET':
            $token = substr(getallheaders()['Authorization'], 7);

            // $ips = array("31.30.162.251");

            // if(!in_array($_SERVER['REMOTE_ADDR'], $ips))
            // {
            // header("HTTP/1.1 401 Unauthorized");
            // exit;
            // }
            
            $userFromToken = $Link->query("SELECT userId FROM tokens WHERE token = '$token'")->fetch_assoc();
            if(!is_null($userFromToken))
            {
                $token1 = "5824228201:AAEBCYaNaQEGnqfdrazTDjG4PNiW8dAsXI8";
                $t_web='https://api.telegram.org/bot'.$token1.'/';
                $update_method=$t_web."getupdates";

                $response = file_get_contents($update_method);
                $response = json_decode($response, true);
                $results = $response['result'];
                
                foreach($results as $result)
            {
                // $chat_id = $result['message']['chat']['id'];
                // $name = $result['message']['chat']['first_name'];
                // $surname = $result['message']['chat']['last_name'];
                // $text = $result['message']['text'];
                // $chat_id = $result['my_chat_member']['chat']['id'];
                // $name = $result['messmy_chat_memberage']['chat']['title'];
                // $text = $result['message']['text'];
                // // $receivingData = $Link->query("INSERT INTO receiver(chat_id, first_name, last_name, text) VALUES('$chat_id', '$name', '$surname', '$text')");
                // $receivingData = $Link->query("INSERT INTO receiver(chat_id, first_name) VALUES('$chat_id', '$name')");
                // $userInsertResults = $Link->query("INSERT INTO updates SELECT * FROM receiver AS r WHERE NOT EXISTS(SELECT * FROM updates AS u WHERE u.chat_id = r.chat_id)");

                // $txt = $text;
                $search = $Link->query("SELECT keywords FROM maket_list");

                if (false !== strpos($txt, $search)) {
                //true
                } else {
                //false
                }

                echo json_encode($result['message']['chat']);
            }
            }
            else
            {
                setHTTPStatus("401", "Unauthorized");
            }

        break;

        case 'POST':
        $login = $requestData->body->login;
        $user = $Link->query("SELECT id FROM users WHERE login = '$login'")->fetch_assoc();

        if(is_null($user))
        {
            $password = hash("sha1", $requestData->body->password);
            $userInsertResult = $Link->query("INSERT INTO users(login, password) VALUES('$login', '$password')");

            if(!$userInsertResult)
            {
                //400
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
            //exit
            setHTTPStatus("303", "Already exist");
        }

        break;

        default:

        break;
    }
}