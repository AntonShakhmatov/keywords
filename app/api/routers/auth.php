<?php

function route($method, $urlList, $requestData)
{

    // $ips = array("31.30.162.251");

    // if(!in_array($_SERVER['REMOTE_ADDR'], $ips))
    // {
    // header("HTTP/1.1 401 Unauthorized");
    // exit;
    // }

    if($method == "POST")
    {
        global $Link;
        switch($urlList[1]){
            case "login":
                $login = $requestData->body->login;
                $pass = hash("sha1", $requestData->body->password);

                $user = $Link->query("SELECT id FROM users WHERE login = '$login' AND password = '$pass'")->fetch_assoc();
                if(!is_null($user))
                {
                    $token = bin2hex(random_bytes(32));
                    $userId = $user['id'];
                    $tokenInsertResult = $Link->query("INSERT INTO tokens(token, userId) VALUES('$token', '$userId')");
                    if(!$tokenInsertResult)
                    {
                        setHTTPStatus("400", "Bad Request");
                    }
                    else
                    {
                        echo json_encode(['token' => $token]);
                    }
                }
                    else
                    {
                        setHTTPStatus("400", "Bad Request");
                    }

                    break;
                    case "logout":
                    break;
                    default:
                        setHTTPStatus("404", "There is no such path as 'user/$urlList[1]'");
                    break;
                }
        }
        else
        {
            setHTTPStatus("401", "Change method for POST'");
        }
    }