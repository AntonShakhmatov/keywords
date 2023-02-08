<?php

global $Link;
header('Content-type: application/json');
// $Link = mysqli_connect("127.0.0.1", "root", "", "user");

$token = "5927059581:AAGf-oKJD9qPupvP_nsyt9OABZhwcoRVTvA";//токен бота
$t_web='https://api.telegram.org/bot'.$token.'/';//api метод база
$update_method=$t_web."getupdates";//получать обновления сообщений

$response = file_get_contents($update_method);//получаем json со всеми письмами
$response = json_decode($response, true);
$results = $response['result'];
foreach($results as $result)
{
    $chat_ids[] = $result['message']['chat']['id'];
    $names = $result['message']['chat']['first_name'];
    $surnames = $result['message']['chat']['last_name'];
    // $userInsertResult = $Link->query("INSERT INTO updates(chat_id, first_name, last_name) VALUES('$chat_id', '$name', '$surname') ");
    $text = "Алина до тебя доходят сообщения?";
}

// foreach($chat_ids as $chat_id){
//     $fp=fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
//     echo $fp;    
// }

    echo $_SERVER['REMOTE_ADDR'];
    // var_dump($chat_id);

    // if(!$fp)
    // {
    //     setHTTPStatus("400", "Bad Request");
    // }
    // else
    // {
    //     setHTTPStatus("200", "Success");
    // }

    // echo json_encode($requestData);

    // sender

    // $userId = $userFromToken['userId'];
    // $user = $Link->query("SELECT chat_id FROM users WHERE id = '$userId'")->fetch_assoc();
    // $chat_id = $user['chat_id'];
    // $text = $requestData->body->text;
    // $fp=fopen("https://api.telegram.org/bot{$token1}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
    // return $fp;   

