<?php

include_once 'helpers/header.php';

global $Link;
header('Content-type: application/json');
$Link = mysqli_connect('127.0.0.1', 'root', '', 'markets');

if(!$Link){
    setHTTPStatus("500", "Database connection error" . mysqli_connect_error());
}

function getData($method){
    $data = new stdClass();
    if($method != "GET")
    {
        $data->body = json_decode(file_get_contents('php://input'));
    }
        $data->parameters = [];
        $dataGet = $_GET;
        foreach($dataGet as $key => $value){
            if($key !='q')
            {
                $data->parameters[$key] = $value;
            }
        }
    return $data;
}

function getMethod()
{
    return $_SERVER['REQUEST_METHOD'];
}

$message = [];
$message["users"] = [];

$url = isset($_GET['q']) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urlList = explode('/', $url);

$router = $urlList[0];
$requestData = getData(getMethod());
$method = getMethod();

if(file_exists(realpath(dirname(__FILE__)).'/routers/' . $router . '.php' ))
{
    include_once 'routers/' . $router . '.php';
    route($method, $urlList, $requestData);
}
else
{
    setHTTPStatus("404", "Not found");
}
