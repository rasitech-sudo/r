<?php
$content = file_get_contents("php://input");
$token = '1771488083:AAHJdUxf4PZm7RlcXZc9qJmQWJhWuRczYek';
$apiLink = "https://api.telegram.org/bot$token/"; 
$update = json_decode($content, true);
if(!@$update["message"]) $val = $update['callback_query'];
else $val = $update;
$chat_id = $val['message']['chat']['id'];
$text = $val['message']['text'];
$update_id = $val['update_id'];
$sender = $val['message']['from'];

if ($text == "/start") {
    file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Halo, saya Robot QR. Silahkan ketik sesuatu untuk dibuat.");
    return false;
} else if ($text == "/donasi") {
    file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Untuk donasi developer, silahkan kunjungi: https://saweria.co/rasitech");
    return false;
} else if ($text == "/about") {
    file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Bot ini dibuat oleh @RasiTechChannel. Bot ini diintegrasikan dengan API SimSimi langsung.");
    return false;
} else if ($text == "/versi") {
    file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Bot ini versi 1.0.0");
    return false;
} else {
    $endpointSimSimi = file_get_contents("https://fdciabdul.tech/api/ayla/?pesan=".urlencode($text));
    $pesan = json_decode($endpointSimSimi);
    $pesan = $pesan->jawab;
    if (!empty($pesan)) {
        file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=$pesan");
    } else {
        file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=Maaf. Simi tidak mengerti apa yang kamu katakan :(");
    }
    
}
