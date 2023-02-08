<?php

function route($method, $urlList, $requestData)
{
    global $Link;
    switch($method){

        case 'GET':
            $token = substr(getallheaders()['Authorization'], 7);
            $userFromToken = $Link->query("SELECT userId FROM tokens WHERE token = '$token'")->fetch_assoc();
            if(!is_null($userFromToken))
            {
                $getMarkets = $Link->query("SELECT * FROM 'maket_list'");
                echo $getMarkets;
            }
            else
            {
                setHTTPStatus("401", "Unauthorized");
            }

        break;

        case 'POST':

            $token = substr(getallheaders()['Authorization'], 7);
            $userFromToken = $Link->query("SELECT userId FROM tokens WHERE token = '$token'")->fetch_assoc();
            if(!is_null($userFromToken))
            {
                $market = $requestData->body->market;
            // $markets = $Link->query("SELECT market FROM market_list WHERE market = '$market'");
            // if(is_null($markets))
            // {
                $type = $requestData->body->type;
                $keywords = $requestData->body->keywords;
                $userInsertResult = $Link->query("INSERT INTO maket_list(market, type, keywords) VALUES('$market', '$type', '$keywords')");
    
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
            // }
            // else
            // {
            //     //exit
            //     setHTTPStatus("303", "Already exist");
            // }
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