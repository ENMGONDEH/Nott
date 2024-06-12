<?php
 
include 'config.php';

ini_set('error_logs','off');
error_reporting(0);

function bot($method,$datas=[]){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://api.telegram.org/bot'.API_KEY.'/'.$method );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    return json_decode(curl_exec($ch));
}

function IranTime(){
    date_default_timezone_set("Asia/Tehran");
    return date('H:i:s');
}

function IranDate(){
    date_default_timezone_set("Asia/Tehran");
   return date('Y/m/d');
}

function NewYorkDate(){
    date_default_timezone_set("America/New_York");
   return date('Y/m/d');
}

function NewYorTime(){
    date_default_timezone_set("America/New_York");
    return date('H:i:s');
} 
$update     = json_decode(file_get_contents('php://input'));

if(isset($update->message)){
$message            = $update->message;
$message_id         = $message->message_id;
$text               = $message->text;
$chat_id            = $message->chat->id;
$tc                 = $message->chat->type;
$first_name         = $message->from->first_name;
$from_id            = $message->from->id;
$document           = $message->document;
$photo              = $message->photo;
$username           = $message->from->username;
$contact            = $message->contact;
$contactid          = $contact->user_id;
$contactnum         = $contact->phone_number;
$co_num             = $contact->phone_number;
$user               = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$from_id' LIMIT 1"));
$block              = mysqli_query($connect,"SELECT * FROM `block` WHERE `id` = '$from_id' LIMIT 1");
}

if(isset($update->callback_query)){
$callback_query     = $update->callback_query;
$callback_query_id  = $callback_query->id;
$data               = $callback_query->data;
$fromid             = $callback_query->from->id;
$messageid          = $callback_query->message->message_id;
$chatid             = $callback_query->message->chat->id;
$contact            = $message->contact;
$contactid          = $contact->user_id;
$contactnum         = $contact->phone_number;
$co_num             = $contact->phone_number;
$user               = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$fromid' LIMIT 1"));
$block              = mysqli_query($connect,"SELECT * FROM `block` WHERE `id` = '$fromid' LIMIT 1");
}

function convert($string) {
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    return $englishNumbersOnly;
}

function objectToArrays($object)
{
if (!is_object($object) && !is_array($object))
{
    return $object;
}
if (is_object($object))
{
    $object = get_object_vars($object);
}
return array_map("objectToArrays", $object);
}

function save($filename, $TXTdata)
{
$myfile = fopen($filename, "w") or die("Unable to open file!");
fwrite($myfile, "$TXTdata");
fclose($myfile);
}

function memUsage($units = false){
$status = file_get_contents('/proc/' . getmypid() . '/status');
$matchArr = array();
preg_match_all('~^(VmRSS|VmSwap):\s*([0-9]+).*$~im', $status, $matchArr);
if(!isset($matchArr[2][0]) || !isset($matchArr[2][1])){
return false;
}
$size = intval($matchArr[2][0]) + intval($matchArr[2][1]);
$unit = array('KB','MB','GB','TB','PB');
if($units){
return @round($size/pow(1024,($i=floor(log($size,1024)))),0).' '.$unit[$i];
}else{
return @round($size/pow(1024,($i=floor(log($size,1024)))),0);
}
}

function getMUsage(){
    $mem = memory_get_usage();
    $kb = $mem / 1024;
return substr($kb, 0, -5).' KB';
}

function SendDocument($chat_id, $document, $caption = null){
    bot('SendDocument',[
    'chat_id'=>$chat_id,
    'document'=>$document,
    'caption'=>$caption
]);
}

function RandomString() {
    $characters = 'AaB0Cabzzcdefghijks2evpousxd9911DEFGHIJKL123456MNOP1QRSTUVWXYZ789';
    $randstring = null;
    for ($i = 0; $i < 9; $i++) {
        $randstring .= $characters[
            rand(0, strlen($characters))
        ];
    }
    return $randstring;
}

function GetMe(){
    return Bot('getMe');
}
$botxd          = GetMe(); 
$botid          = getMe() -> result -> username; 
$botname        = getMe() -> result -> first_name; 
$botusername    = getMe() -> result -> username;
$botxdteam      = getMe() -> result -> id;

$get_admin  = mysqli_query($connect,"SELECT * FROM admin");
foreach ($get_admin as $ch_ids){
$ch_name2   = $ch_ids["id"];
$admin[]    = $ch_name2;
}
$settingsdb     = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `settings`"));

 