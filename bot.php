<?php 
include 'update.php';

if (mysqli_num_rows($block) > 0) exit();

if($user['en'] == "english"){
include 'lang/en.php';
}

if($user['en'] == "persian"){
include 'lang/fr.php';
} 
if (in_array($from_id, $admin)) {
$home_pr = json_encode([
'keyboard'=>[
    [['text'=>'👁 دیدن تبلیغات'],['text'=>'🤖 استارت ربات']],
    [['text'=>'💰 حساب'],['text'=>'🙌🏻 عضوگیری']],
    [['text'=>'📊 تبلیغات']],
    [['text'=>'⚙️ مدیریت']],
],
'resize_keyboard'=>true,
]);
} else {
$home_pr = json_encode([
'keyboard'=>[
    [['text'=>'👁 دیدن تبلیغات'],['text'=>'🤖 استارت ربات']],
    [['text'=>'💰 حساب'],['text'=>'🙌🏻 عضوگیری']],
    [['text'=>'📊 تبلیغات']],
],
'resize_keyboard'=>true,
]);
}
if (in_array($from_id, $admin)) {
$home_en = json_encode([
'keyboard'=>[
    [['text'=>'👁 Watch Ads'],['text'=>'🤖 Message Bots']],
    [['text'=>'💰 Balance'],['text'=>'🙌🏻 Referrals']],
    [['text'=>'📊 My Ads']],
    [['text'=>'⚙️ Panel']],
],
'resize_keyboard'=>true,
]);
} else {
$home_en = json_encode([
'keyboard'=>[
    [['text'=>'👁 Watch Ads'],['text'=>'🤖 Message Bots']],
    [['text'=>'💰 Balance'],['text'=>'🙌🏻 Referrals']],
    [['text'=>'📊 My Ads']],
],
'resize_keyboard'=>true,
]);
}

if(strpos($text,'#' ) !== false or strpos($text,"'" ) !== false){
exit;}
 
elseif(preg_match('/^(\/start) (.*)/', $text , $match) and $user['id'] != true and $match[2] > 0 and $tc == 'private'){
$use = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$from_id' LIMIT 1"));
if($use['id'] != true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🇺🇸 Choose your language

🇮🇷 زبان خودرا انتخاب کنید
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"🇺🇸 ENGLISH",'callback_data'=>"chlangenglish"],['text'=>"🇮🇷 فارسی",'callback_data'=>"chlangpersian"]],
]
])
]);
$connect->query("INSERT INTO `user` (`id` , `step`) VALUES ('$from_id' , 'send $match[2]')");
exit;
}}

if($text == "/start" && $tc == 'private'){
$use = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$from_id' LIMIT 1"));
if($use['id'] != true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🇺🇸 Choose your language

🇮🇷 زبان خودرا انتخاب کنید
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"🇺🇸 ENGLISH",'callback_data'=>"chlangenglish"],['text'=>"🇮🇷 فارسی",'callback_data'=>"chlangpersian"]],
]
])
]);
$connect->query("INSERT INTO `user` (`id`) VALUES ('$from_id')");
exit;
}}
 
if($data == 'chlangenglish'){
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' => "
English language was selected

change » /language
",
]);
bot('sendmessage',[
'chat_id'=>$chatid,
'text'=>"
🔥 Welcome to $botname Bot!

⭐️ This robot helps you earn by doing tasks for free
",
'reply_markup'=>$home_en
]);
$connect->query("UPDATE `user` SET `en` = 'english' WHERE `id` = '$chatid' LIMIT 1");	
}
 
if($data == 'chlangpersian'){
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' => "
زبان فارسی برای شما انتخاب شد

جهت تغیر زبان دستور /language را استفاده کنید
",
]);
bot('sendmessage',[
'chat_id'=>$chatid,
'text'=>"
🔥 به ربات $botname خوش آمدید

⭐️ این ربات به شما کمک می کند تا با انجام وظایف به صورت رایگان درآمد کسب کنید
",
'reply_markup'=>$home_pr
]);
$connect->query("UPDATE `user` SET `en` = 'persian' WHERE `id` = '$chatid' LIMIT 1");	
}
$use2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$from_id' LIMIT 1"));
if($use2['id'] != true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🇺🇸 Choose your language

🇮🇷 زبان خودرا انتخاب کنید
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"🇺🇸 ENGLISH",'callback_data'=>"chlangenglish"],['text'=>"🇮🇷 فارسی",'callback_data'=>"chlangpersian"]],
]
])
]);
$connect->query("INSERT INTO `user` (`id`) VALUES ('$from_id')");
exit;
}

 