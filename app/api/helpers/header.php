<?php

function setHTTPStatus($status = "200", $message = null)
{
    switch($status)
    {
        default:
        case "102":
            $status = "HTTP/1.0 102 Is existing";
            break;
        case "200":
            $status = "HTTP/1.0 200 OK";
            break;
        case "400":
            $status = "HTTP/1.0 400 Bad Request";
            break;   
        case "401":
            $status = "HTTP/1.0 401 Unauthorized";
            break;   
        case "404":
            $status = "HTTP/1.0 404 Not found";
            break;   
        case "500":
            $status = "HTTP/1.0 500 Internal Server Error";
            break;    
    }
    header($status);;
    if(!is_null($message))
    {
        echo json_encode(['message' => $message]);
    }
}