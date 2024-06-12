<?php
 
function is_join($id)
{
                    global $Channels;
                    $in_ch = [];
                    foreach ($Channels as $ch_id)
{
                    $type = bot("getChatMember" , ["chat_id" => "@$ch_id" , "user_id" => $id]);
                    $type = (is_object($type)) ? $type->result->status : $type['result']['status'];
                    if($type == 'creator' || $type ==  'administrator' || $type ==  'member')
{
                    $in_ch[$ch_id] = $type;
}
else
{
                    $keyboard = [];
                    foreach ($Channels as $ch_id)
{
                    $ch_info = bot("getChat", ["chat_id"=>"@$ch_id"]);//get channel
                    $ch_name = (is_object($ch_info)) ? $ch_info->result->title : $ch_info['result']['title'];//channel name
                    $keyboard[] = [['text' => $ch_name, 'url' => "https://t.me/$ch_id"]];
}
$keyboard[]         = [['text'=>'✅ Done','callback_data'=>'join']];
$text               = "♨️ You must be a member of our channel to use the robot";
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"$text" ,'parse_mode' => 'MarkDown', 'reply_markup' => 
json_encode(['inline_keyboard' => $keyboard])]);
break;
}
}
return true;
}

function check_join($id)
{
                    global $Channels;
                    $in_ch = [];
                    foreach ($Channels as $ch_id)
{
                    $type = bot("getChatMember" , ["chat_id" => "@$ch_id" , "user_id" => $id]);
                    $type = (is_object($type)) ? $type->result->status : $type['result']['status'];
                    if($type == 'creator' || $type ==  'administrator' || $type ==  'member')
{
                    $in_ch[$ch_id] = $type;
}
else
{
return false;
break;
}
}
return true;
}
 
if (in_array($from_id, $admin)) {
$home = json_encode([
'keyboard'=>[
    [['text'=>'👁 Watch Ads'],['text'=>'🤖 Message Bots']],
    [['text'=>'💰 Balance'],['text'=>'🙌🏻 Referrals']],
    [['text'=>'📊 My Ads']],
    [['text'=>'⚙️ Panel']],
],
'resize_keyboard'=>true,
]);
} else {
$home = json_encode([
'keyboard'=>[
    [['text'=>'👁 Watch Ads'],['text'=>'🤖 Message Bots']],
    [['text'=>'💰 Balance'],['text'=>'🙌🏻 Referrals']],
    [['text'=>'📊 My Ads']],
],
'resize_keyboard'=>true,
]);
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
$home_1 = json_encode([
'keyboard'=>[
    [['text'=>'👁‍🗨  Ads'],['text'=>'🤖 Message bot']],
    [['text'=>'Back 🔙']],
],
'resize_keyboard'=>true,
]);
$home_2 = json_encode([
'keyboard'=>[
    [['text'=>'➕ Deposit'],['text'=>'➖ Withdraw']],
    [['text'=>'Back 🔙']],
],
'resize_keyboard'=>true,
]);

$datez = time();
if(!empty($from_id) && !in_array($from_id, $admin)) {
$Spamlist = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM spam WHERE id = '$from_id'"));
if ($Spamlist["id"] != true) {
$connect->query("INSERT INTO spam (id, block, spam, timee) VALUES ('$from_id', '$datez', '0', '$datez')");
}}

if(!empty($Spamlist)){
if(time() < $Spamlist['block']){
$connect->close();
die();
}else{
$timer = $Spamlist['timee'] + 5;
$sp=++$Spamlist['spam'];
if ($datez <= $timer) {
if($Spamlist['spam']>=6){
$times = time() + 60;
$connect->query("UPDATE spam SET block='".$times."',spam=0 WHERE id=".$Spamlist['id']);
bot('sendmessage', [
'chat_id' => $Spamlist['id'],
'text' => '
❗️ Your account was blocked for 60 seconds due to bot spam, please do not spam again
',
'reply_to_message_id' => $message_id,
'parse_mode' => 'html',
'reply_markup' => null,
'disable_web_page_preview' => false,
]);
$lsdjllxdspame= $Spamlist['id'];
bot('sendmessage', [
'chat_id' => $admin[0],
'text' => "
😈 spamer :
".$Spamlist['id']."
",
'reply_to_message_id' => null,
    'parse_mode' => 'MarkDown',
    'reply_markup' => null,
    'disable_web_page_preview' => false,
]);
$connect->close();
die();
}else{
$connect->query("UPDATE spam SET spam=$sp WHERE id=".$Spamlist['id']);
}
} else {
$connect->query("UPDATE spam SET spam=1,timee=$datez WHERE id=".$Spamlist['id']);
}}}

if(in_array($from_id, $admin)){
if(strpos($text,"'") or strpos($text,"fuckyou") or strpos($text,"*") or strpos($text,"**") or strpos($text,"%") and !in_array($from_id, $admin)){
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 20");
exit;
}}
if(strpos($text,"'") or strpos($text,"fuckyou") or strpos($text,"*") or strpos($text,"**") or strpos($text,"%") and !in_array($from_id, $admin)){
$connect->query("UPDATE user SET step = 'none' WHERE id = '$from_id' LIMIT 20");
exit;
}

elseif(preg_match('/^starttasks_(.*)/', $data , $match)){
$use = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `adbot` WHERE `id` = '$match[1]' LIMIT 1"));
if($use['id'] == true){
$bot_rand   = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `adbot` where id = '$match[1]' LIMIT 1"));
$id_xd      = $bot_rand['id'];
$id_xd2     = $bot_rand['bot'];
$id_xd3     = $bot_rand['user'];
$id_xd99    = $bot_rand['username'];
if(check_join("$fromid")=='true'){
if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `bots` WHERE `cod` = '$id_xd99' AND `id` = '$fromid' LIMIT 1")) <= 0){
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
1️⃣ Enter the link below and send us a message from the bot
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"🤖 start bot 🤖",'url'=>"$id_xd2"]],
]
])
]);
$connect->query("UPDATE `user` SET `xdteam` = '$id_xd3' WHERE `id` = '$fromid' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'kooobs' WHERE `id` = '$fromid' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$fromid,
'text'=>"
🥲 No tasks were found to complete

👍 Do the tasks again later
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$fromid,
'text'=>"
Error in operation
",
]);
}}else{
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
Error in operation
",
]);
}}

elseif(preg_match('/^ernviwe_(.*)/', $data , $match)){
if(check_join("$fromid")=='true'){
if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `view` WHERE `cod` = '$match[1]' AND `id` = '$fromid' LIMIT 1")) <= 0){
bot('answercallbackquery', [
'callback_query_id' =>$callback_query_id,
'text' => "💰 You earned 0.03",
'show_alert' =>false
]);
$vie        = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `ads` WHERE `id` = '$match[1]' LIMIT 1"));
$allsee     = $vie['allsee'] + 1;
$see        = $vie['see'];
$idxd       = $vie['id'];
$idxd2      = $idxd + 1;
$pooke2     = 0.03;
$getcoinxd  = $user['coin'] + $pooke2;
if($allsee >= $see){
bot('deleteMessage',[
'chat_id' => "@$channelseen",
'message_id' => $idxd,
]);
bot('deleteMessage',[
'chat_id' => "@$channelseen",
'message_id' => $idxd2,
]);
}
$connect->query("UPDATE `user` SET `coin` = '$getcoinxd' WHERE `id` = '$fromid' LIMIT 1");
$connect->query("UPDATE `ads` SET `allsee` = '$allsee' WHERE `id` = '$match[1]' LIMIT 1");
$connect->query("INSERT INTO `view` (`id` , `cod`) VALUES ('$fromid' , '$match[1]')");
}else{
bot('answercallbackquery', [
'callback_query_id' =>$callback_query_id,
'text' => 'You have already seen this post',
'show_alert' =>true
]);
}}else{
bot('answercallbackquery', [
'callback_query_id' =>$callback_query_id,
'text' => 'Start the BOT first.',
'show_alert' =>true
]);
}}
if($data == 'join'){
if(check_join("$fromid")=='true'){
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
⏳
",
]);
bot('sendmessage',[
'chat_id'=>$chatid,
'text'=>"
✅ Your membership is your confirmation and you can use the robot now
",
'reply_to_message_id'=>$messageid,
'reply_markup'=>$home
]);
}elseif(check_join("$fromid")!='true'){
bot('answercallbackquery', [
'callback_query_id' =>$callback_query_id,
'text' => "❌ You are not a member of our channels",
'show_alert' =>true
]);
}
}

elseif(strpos($data,"hagh|" ) !== false ){
$exit    = explode("|",$data);
$id      = $exit[1];
$use     = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$id' LIMIT 1"));
if($use['en'] == "english"){
$xd_text_tm = "
✅ Your deposit has been made, now you can see it in your wallet
";
}
if($use['en'] == "persian"){
$xd_text_tm = "
✅ #واریزی شما انجام شد همکنون میتوانید در ولت خود مشاهده کنید
";
}
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' => "
✅ The deposit was DONE
",
]);
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"
$xd_text_tm
",
]);
}

elseif(strpos($data,"acept|" ) !== false ){
$exit    = explode("|",$data);
$id      = $exit[1];
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' => "
📍 Now send the number of coins deposited by the user so that I can deposit it to his main account

⚠️ To cancel the operation, send the /start command
",
]);
$connect->query("UPDATE `user` SET `m7` = '$id' WHERE `id` = '$chatid' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'kosinline' WHERE `id` = '$chatid' LIMIT 1");
}

elseif($data == 'losertm'){
bot('EditMessageText',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
closed
",
]);
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
خوش اومدید
",
'reply_markup'=>$home_pr
]);
$connect->query("UPDATE `user` SET `en` = 'persian' WHERE `id` = '$chatid' LIMIT 1");	
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$chatid' LIMIT 1");
exit;	
}

if ($settingsdb['bot'] == "off" and !in_array($from_id, $admin) && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
📍 The bot is off for updating!
",
]);
exit;
}

if(preg_match('/^send (.*)/', $user['step'] , $match)){
$usqid=$user['id'];
if(check_join("$usqid")=='true'){
$data   = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$match[1]' LIMIT 1"));
$member = $data['member'] + 1;
$setcoi = $settingsdb['zircoin'];
$coin   = $data['coin'] + $setcoi;
if($data['en'] == "persian"){
bot('sendmessage',[
'chat_id'=>$match[1],
'text'=>"
🎉 تبریک ، کاربر {$user['id']} با استفاده از لینک شما عضو ربات شد و شما $setcoi موجودی کسب کردید
",
'parse_mode'=>'Markdown',
]);
$connect->query("UPDATE `user` SET `member` = '$member' , `coin` = '$coin' WHERE `id` = '$match[1]' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '{$user['id']}' LIMIT 1");
}
 
if($data['en'] == "english"){
bot('sendmessage',[
'chat_id'=>$match[1],
'text'=>"
🎉 Congratulations, user {$user['id']} joined the bot using your link and you earned $setcoi balance
",
'parse_mode'=>'Markdown',
]);
$connect->query("UPDATE `user` SET `member` = '$member' , `coin` = '$coin' WHERE `id` = '$match[1]' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '{$user['id']}' LIMIT 1");
}
}}

if($text == "/language" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🇺🇸 Choose your language
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"🇮🇷 فارسی",'callback_data'=>"chlangpersian"]],
]
])
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
exit;
}

elseif(check_join("$from_id")!='true'){
if($user['id'] != true)
$connect->query("INSERT INTO `user` (`id`) VALUES ('$from_id')");
    
is_join("$from_id");
exit;
}

elseif($user['step'] == 'kooobs' && $text != "Back 🔙" && $tc == 'private'){
$key        = $user['xdteam'];
$keye1      = $message->forward_from->id;
$keye2      = $message->forward_from->first_name;
$keye3      = $message->forward_from->username;
$use        = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `adbot` WHERE `user` = '$key' LIMIT 1"));
if($use['id'] == true){
if($key == $keye1){
$bot_rand   = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `adbot` where user = '$key' LIMIT 1"));
$sta        = $bot_rand['start'];
$idblog     = $bot_rand['id'];
$adminster  = $bot_rand['cr'];
$lsts       = $bot_rand['allstart'];
$all        = $lsts + 1;
$pok        = 0.03;
$kosmos     = $bot_rand['username'];
$coinuser   = $user['coin'];
$allcoinuse = $coinuser + $pok;
$use2       = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$adminster' LIMIT 1"));
if($all >= $sta){
$connect->query("DELETE FROM `adbot` WHERE `id` = '{$idblog}' LIMIT 1 ");
if($use2['en'] == "english"){
bot('sendmessage',[
'chat_id'=>$adminster,
'text'=>"
✅ done

Your order was placed for starter with code $idblog
",
]);
}
if($use2['en'] == "persian"){
bot('sendmessage',[
'chat_id'=>$adminster,
'text'=>"
✅ انجام شد

سفارش شما برای استارت با کد $idblog انجام شد
",
]);
}
}
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💰 You earned 0.03
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🤖 Message Bots"],],
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("INSERT INTO `bots` (`id` , `cod`) VALUES ('$from_id' , '$kosmos')");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `coin` = '$allcoinuse' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `adbot` SET `allstart` = '$all' WHERE `id` = '$idblog' LIMIT 1");	
}}}

if($text == "/start" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⭐️ Start making money online with $botname

⭐️ Your trust is our most important asset
",
'reply_markup'=>$home
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
exit;
}

elseif($text == "👁 Watch Ads" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🔥 To earn money, you can earn money by viewing other people's posts for free

⭐️ Just enter the channel below and earn money
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"👁 Start earning",'url'=>"https://t.me/$channelseen"]],
]
])
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
}

elseif($text == "Back 🔙" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
👈🏻 We are back to the main menu
",
'reply_markup'=>$home
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
exit;
}

elseif($text == "📊 My Ads" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📊 Choose a category to register ads
",
'reply_markup'=>$home_1
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
}

elseif($text == "👁‍🗨  Ads" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
👁‍🗨 Please select the desired number of visits
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👁‍🗨 10 | 💸 0.30"],['text'=>"👁‍🗨 30 | 💸 0.90"]],
[['text'=>"👁‍🗨 100 | 💸 7.0"],['text'=>"👁‍🗨 200 | 💸 12.0"]],
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'e1' WHERE `id` = '$from_id' LIMIT 1");	
}

elseif($user['step'] == 'e1' && $text != "🔙 برگشت" && $tc == 'private'){
if($text == "👁‍🗨 10 | 💸 0.30" or $text == "👁‍🗨 30 | 💸 0.90" or $text == "👁‍🗨 100 | 💸 7.0" or $text == "👁‍🗨 200 | 💸 12.0"){
# xd - tashkish
if($text == "👁‍🗨 10 | 💸 0.30"){
$xd = 10;
$xd2 = "0.30";
}
if($text == "👁‍🗨 30 | 💸 0.90"){
$xd = 30;
$xd2 = "0.90";
}
if($text == "👁‍🗨 100 | 💸 7.0"){
$xd = 100;
$xd2 = "7.0";
}
if($text == "👁‍🗨 200 | 💸 12.0"){
$xd = 200;
$xd2 = "12.0";
}
if($user['coin'] >= $xd2){
# xd - run
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📝 Now forward your post
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `m1` = '$xd' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `m2` = '$xd2' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `step` = 'e2' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 You do not have enough balance to register this ad
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⌨️ Please use the keyboard
",
]);
}}

elseif($user['step'] == 'e2' && $text != "🔙 برگشت" && $tc == 'private'){
$coin   = $user['coin'];
$count  = $user['m1'];
$amcoin = $user['m2'];
if($coin >= $amcoin){
$allxdteam = $coin - $amcoin;
if($message->forward_from_chat == true){
$id = bot('ForwardMessage',[
'chat_id'=>"@$channelseen",   
'from_chat_id'=>$from_id,
'message_id'=>$message_id,
])->result->message_id;
$link = "https://t.me/$channelseen/$id";
bot('sendmessage',[
'chat_id'=>"@$channelseen", 
'text'=>"
💸 Click to earn
",
'reply_to_message_id'=>$id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"💰 0.03",'callback_data'=>"ernviwe_$id"]],
]
])
]);
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ successfully
",
'reply_markup'=>$home_1
]);
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ You can see your ad now
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"👀",'url'=>"$link"]],
]
])
]);
$connect->query("INSERT INTO `ads` (`id` , `see` , `allsee` , `cr` , `m1`) VALUES ('$id' , '$count' , '0' , '$from_id' , 'xdteam')");
$connect->query("UPDATE `user` SET `coin` = '$allxdteam' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❗️ Your message must be forwarded
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❗️ Your coin is low
",
]);
}}

elseif($text == "🤖 Message bot" && $tc == 'private'){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🤖 Please select the starting number
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🤖 5 | 💸 0.20"],['text'=>"🤖 10 | 💸 0.40"]],
[['text'=>"🤖 50 | 💸 2.5"],['text'=>"🤖 100 | 💸 6.0"]],
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'e3' WHERE `id` = '$from_id' LIMIT 1");	
}
elseif($user['step'] == 'e3' && $text != "Back 🔙" && $tc == 'private'){
if($text == "🤖 5 | 💸 0.20" or $text == "🤖 10 | 💸 0.40" or $text == "🤖 50 | 💸 2.5" or $text == "🤖 100 | 💸 6.0"){
# xd - tashkish
if($text == "🤖 5 | 💸 0.20"){
$xd = 5;
$xd2 = "0.20";
}
if($text == "🤖 10 | 💸 0.40"){
$xd = 10;
$xd2 = "0.40";
}
if($text == "🤖 50 | 💸 2.5"){
$xd = 50;
$xd2 = "2.5";
}
if($text == "🤖 100 | 💸 6.0"){
$xd = 100;
$xd2 = "6.0";
}
if($user['coin'] >= $xd2){
# xd - run
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Now forward a message from your bot
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `m1` = '$xd' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `m2` = '$xd2' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `step` = 'e4' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 You do not have enough balance to register this ad
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⌨️ Please use the following keyboard
",
]);
}}
elseif($user['step'] == 'e4' && $text != "Back 🔙" && $tc == 'private'){
$coin   = $user['coin'];
$count  = $user['m1'];
$amcoin = $user['m2'];
if($coin >= $amcoin){
$allxdteam = $coin - $amcoin;
// if($message->forward_from_id == true){
$keye = $message->forward_from->id;
$keye2 = $message->forward_from->first_name;
$keye3 = $message->forward_from->username;
$checkbot      = $message->forward_from->is_bot;
if($checkbot == true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Now send your registration link in $keye2 bot
",
]);
$connect->query("UPDATE `user` SET `m3` = '$keye' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `m4` = '$keye3' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `step` = 'e5' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🤖 Please send a message from a bot
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
Your coins are not enough
",
]);
}}
elseif($user['step'] == 'e5' && $text != "Back 🔙" && $tc == 'private'){
$coin   = $user['coin'];
$count  = $user['m1'];
$amcoin = $user['m2'];
$addadi = $user['m3'];
$susers = $user['m4'];
if($coin >= $amcoin){
$allxdteam = $coin - $amcoin;
if(strpos($text,"$susers") !== false && strpos($text,"t.me") !== false && strpos($text,"/") !== false){
$cod2 = RandomString();
$cod  = "$cod2$from_id";
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ It was registered
",
'reply_markup'=>$home_1
]);
$connect->query("INSERT INTO `adbot` (`id` , `start` , `allstart` , `user` , `username` , `bot` , `cr`) VALUES ('$cod' , '$count' , '0' , '$addadi' , '$susers' , '$text' , '$from_id')");
$connect->query("UPDATE `user` SET `coin` = '$allxdteam' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Please send the link below your collection from the respective bot
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 You cannot register an ad with this inventory
",
]);
}}

elseif($text == "🤖 Message Bots" && $tc == 'private'){
$bot_rand = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `adbot` ORDER BY rand() LIMIT 1"));
$id_xd = $bot_rand['id'];
$id_xd2 = $bot_rand['username'];
$alltask = mysqli_num_rows(mysqli_query($connect,"select `id` from `adbot`"));
if($alltask >= 1){
if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `bots` WHERE `cod` = '$id_xd2' AND `id` = '$from_id' LIMIT 1")) <= 0){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⏳ Receiving information
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
1️⃣ Please select the following task first

2️⃣ Enter the link below

3️⃣ Send us a message about it

💸 Congratulations, you made money so easily
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"• Start •",'callback_data'=>"starttasks_$id_xd"]],
]
])
]);
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🥲 No tasks were found to complete

👍 Do the tasks again later
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🥲 No tasks were found to complete

👍 Do the tasks again later
",
]);
}}

elseif($text == "🙌🏻 Referrals" && $tc == 'private'){
$link = "https://t.me/$botusername?start=$from_id";
$coin = $settingsdb['zircoin'];
$memz = $user['member'];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🔎 You have $memz referrals.

To introduce people to the bot, send them this link
$link

💵 You can earn $coin balance by bringing each member to the robot
",
'disable_web_page_preview' => true,
]);
}

elseif($text == "💰 Balance" && $tc == 'private'){
$coin   = $user['coin'];
$member = $user['member'];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💰 Coin » $coin
🙌🏻 Referrals » $member

🔸Set your wallet
",
'reply_markup'=>$home_2
]);
}

elseif($text == "➕ Deposit" && $tc == 'private'){
if ($settingsdb['d1'] == "on" or in_array($from_id,$admin)){
if($user['wall'] != null){
if($settingsdb['wallet'] != null){
$w = $settingsdb['wallet'];
$a = $settingsdb['arz'];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💸 Please transfer the amount you want to deposit in the currency of $a to the address ($w) and then send us the transaction code in this section.

📝 Address » $w
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'bytest' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❗️ Admin wallet address is not set
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 To make a deposit and withdrawal transaction in the robot, you must first register your wallet

To register the wallet, send the command (/setwallet).
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 not available
",
]);
}} 
elseif($text == "/setwallet" && $tc == 'private'){
$a = $settingsdb['arz'];
if($user['wall'] != null){
$xd_tm = $user['wall'];
}else{
$xd_tm = "wallet not set";
}
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⚙️ Send us your wallet ($a) address

✅ You can change your address later with this command
📝 Your current address » $xd_tm

❗️ To cancel the operation, send the /start command
",
]);
$connect->query("UPDATE `user` SET `step` = 'xdteamsetwall' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == 'xdteamsetwall' && $text != "/start" && $tc == 'private'){
if(!preg_match('/^[ آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]+$/i',$text)){
if(strlen($text) == 42){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ It was set
",
]);
$connect->query("UPDATE `user` SET `wall` = '$text' WHERE `id` = '$from_id' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
Incorrect input
",
]);
}}}

elseif($user['step'] == 'bytest' && $text != "Back 🔙" && $tc == 'private'){
$kid = $admin[0];
$use = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$kid' LIMIT 1"));
if(!preg_match('/^[ آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]+$/i',$text)){
if(strlen($text) >= 41 && strlen($text) <= 130){
if($use['en'] == "persian"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Your request has been registered, after the admin's approval, the deposit amount will be deposited into your account
",
'reply_markup'=>$home_2
]);
bot('sendmessage',[
'chat_id'=>$admin[0],
'text'=>"
💳 #واریزی جدید »

👤 کاربر » $from_id
📋 شناسه پرداخت » $text
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"❌ رد کردن",'callback_data'=>"losertm"],['text'=>"✅ تایید کردن",'callback_data'=>"acept|$from_id"]],
]
])
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}
if($use['en'] == "english"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Your request has been registered, after the admin's approval, the deposit amount will be deposited into your account
",
'reply_markup'=>$home_2
]);
bot('sendmessage',[
'chat_id'=>$admin[0],
'text'=>"
💳 #new deposit »

👤 User » $from_id
📋 Payment ID » $text
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"❌ Reject",'callback_data'=>"losertm"],['text'=>"✅ Confirm",'callback_data'=>"acept|$from_id"]],
]
])
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Incorrect input
",
]);
}}}

elseif($user['step'] == 'kosinline' && $text != "/start" && $tc == 'private'){
$kid_xdteam     = $user['m7'];
$use            = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$kid_xdteam' LIMIT 1"));
if($use['en'] == "english"){
$text_xd = "✅ Your payment has been confirmed";
}
if($use['en'] == "persian"){
$text_xd = "✅ پرداخت شما تایید شد";
}
if(preg_match("/^[0-10-9]+$/", $text && strpos($text,".") !== false)) {
$last_xd        = $use['coin'];
$new_xd         = $text;
$all_xd         = $last_xd + $new_xd;
bot('sendmessage',[
'chat_id'=>$kid_xdteam,
'text'=>"
$text_xd
",
]);
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Inventory transfer was done
",
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
$connect->query("UPDATE `user` SET `coin` = '$all_xd' WHERE `id` = '$kid_xdteam' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❗️ Just send the number

Example » 5.0
",
]);
}}

elseif($text == "➖ Withdraw" && $tc == 'private'){
if ($settingsdb['d2'] == "on" or in_array($from_id,$admin)){
$coin = $user['coin'];
$minm = $settingsdb['min'];
if($coin >= $minm){
if($user['wall'] != null){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💸 Send your withdrawal amount

For example » 0.5

⚠️ It will be sent to the registered wallet (check your wallet address)
✅ To register the wallet, send the /setwallet command
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"Back 🔙"]],
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'bardashtxd' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 To make a deposit and withdrawal transaction in the robot, you must first register your wallet

✅ To register the wallet, send the command (/setwallet).
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💵 did not reach the minimum withdrawal

💰 minimum withdrawal is $minm
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⏳ The withdrawal option has been turned off
",
]);
}}

elseif($user['step'] == 'bardashtxd' && $text != "Back 🔙" && $tc == 'private'){
$coin       = $user['coin'];
$coin_xd    = $text;
$min_xd     = $settingsdb['min'];
$all_coin   = $coin - $text;
$your_walle = $user['wall'];
$arz_yeh_xd = $settingsdb['arz'];
$kid        = $admin[0];
$use        = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$kid' LIMIT 1"));
if(preg_match("/^[0-10-9]+$/", $text && strpos($text,".") !== false)) {
if($user['wall'] != null){
if($coin >= $text){
if($coin_xd >= $min_xd){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Withdrawal request has been sent for the wallet ($your_walle), after the wallet is approved by the admin, $arz_yeh_xd $text will be deposited for you
",
'reply_markup'=>$home
]);
if($use['en'] == "persian"){
bot('sendmessage',[
'chat_id'=>$admin[0],
'text'=>"
🔰 #برداشتی جدید

👤 کاربر » $from_id
💲 مبلغ برداشتی » $text
💳 ولت » $your_walle
💶 ارز درخواستی » $arz_yeh_xd

💸 برداشت $arz_yeh_xd $text 

💰 موجودی فعلی کاربر » $all_coin 

✅ پس از واریزی روی دکمه زیر بزنید
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"❌ کنسل",'callback_data'=>"losertm"],['text'=>"✅ پرداخت شد",'callback_data'=>"hagh|$from_id"]],
]
])
]);
}
if($use['en'] == "english"){
bot('sendmessage',[
'chat_id'=>$admin[0],
'text'=>"
🔰 #new_collection

👤 User » $from_id
💲 Withdrawal amount » $text
💳 wallet » $your_walle
💶 requested » $arz_yeh_xd

💸 $arz_yeh_xd $text

💰 Current user balance » $all_coin

After depositing, click on the button below
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"❌ Cancle",'callback_data'=>"losertm"],['text'=>"✅ Done",'callback_data'=>"hagh|$from_id"]],
]
])
]);
}
$connect->query("UPDATE `user` SET `coin` = '$all_coin' WHERE `id` = '$from_id' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⚙️ Minimum withdrawal is $min_xd
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
You cannot withdraw this amount because your balance is not suitable
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 To make a deposit and withdrawal transaction in the robot, you must first register your wallet

✅ To register the wallet, send the command (/setwallet).
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❗️ Just send the number

Example » 5.0
",
]);
}}

if($text == "/creator"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
XD TEAM | @yeh_xd | Copyright XD TEAM
",
]);
}

elseif($text == 'main menu' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
• we came back
",
'reply_markup'=>$home
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
exit;
}

# ADMIN panel
$panel_admin_1 = json_encode([
'keyboard'=>[
    [['text'=>'• statistics •'],['text'=>'⚙️ Settings']],
    [['text'=>'💸 Currencies'],['text'=>'👤 Users']],
    [['text'=>'📨 Public posting'],['text'=>'📨 Public forwarding']],
    [['text'=>'main menu']],
],
'resize_keyboard'=>true,
]);
$panel_admin_tzn = json_encode([
'keyboard'=>[
    [['text'=>'• Current information •']],
    [['text'=>'👨🏼‍💼 Add admin'],['text'=>'👨🏼‍💼 Remove admin']],
    [['text'=>'📍 Subcategory'],['text'=>'📍 Robot']],
    [['text'=>'• panel •']],
],
'resize_keyboard'=>true,
]);
$panel_admin_arz = json_encode([
'keyboard'=>[
    [['text'=>'💳 Wallet'],['text'=>'💵 Currency type']],
    [['text'=>'🔸 Deposit'],['text'=>'🔸 Withdraw']],
    [['text'=>'⚙️ Current settings ⚙️'],['text'=>'💰 minimum withdrawal']],
    [['text'=>'• panel •']],
],
'resize_keyboard'=>true,
]);
$panel_admin_users = json_encode([
'keyboard'=>[
    [['text'=>'💬 User information']],
    [['text'=>'➖ Coin deduction'],['text'=>'➕ Coin Increase']],
    [['text'=>'🔴 Block'],['text'=>'🟢 Unblock']],
    [['text'=>'• panel •']],
],
'resize_keyboard'=>true,
]);

if($text == '• panel •' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
• we came back
",
'reply_markup'=>$panel_admin_1
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
exit;
}

if($text == '⚙️ Panel' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
welcome
",
'reply_markup'=>$panel_admin_1
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
exit;
}

elseif($text == '⚙️ Settings' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
welcome
",
'reply_markup'=>$panel_admin_tzn
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
exit;
}

elseif($text == '• Current information •' and $tc == 'private' and in_array($from_id,$admin)){
$alladmi = mysqli_num_rows(mysqli_query($connect,"select `id` from `admin`"));
$se = $admin[0];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
👨🏼‍💼 Owner » $se

👤 Administrators » $alladmi
",
'reply_markup'=>$panel_admin_tzn
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}

elseif($text == '👨🏼‍💼 Add admin' and $tc == 'private' and in_array($from_id,$admin)){
if($from_id == $admin[0]){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
👤 please send her numer ID first
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"⚙️ Settings"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'addadminxd1' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
Only the owner has access
",
]);
}}
 
elseif($user['step'] == 'addadminxd1' && $text != "⚙️ Settings" && $tc == 'private'){
$use = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$text' LIMIT 1"));
$use2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `admin` WHERE `id` = '$text' LIMIT 1"));
if($use2['id'] != true){
if($use['id'] == true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ The user ($text) was placed in the list of admins
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_tzn
]);
$connect->query("INSERT INTO `admin` (`id` , `cr`) VALUES ('$text' , '$from_id')");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❗️ This user is not in the robot, start the robot first and then try again
",
]);
}}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🥲 This user is admin
",
]);
}} 
elseif($text == '👨🏼‍💼 Remove admin' and $tc == 'private' and in_array($from_id,$admin)){
if($from_id == $admin[0]){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
👤 Send the numeric ID of the admin
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"⚙️ Settings"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'addadmi2nxd12' WHERE `id` = '$from_id' LIMIT 1");	
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
Only the owner has access
",
]);
}}

elseif($user['step'] == 'addadmi2nxd12' && $text != "⚙️ Settings"){
$use = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `admin` WHERE `id` = '$text' LIMIT 1"));
if($use['id'] == true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ The $text user is no longer an admin
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_tzn
]);
$connect->query("DELETE FROM `admin` WHERE `id` = '{$text}' LIMIT 1 ");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
This user is not an admin that I want to enter
",
]);
}}

elseif($text == '📍 Robot' and $tc == 'private' and in_array($from_id,$admin)){
if($settingsdb['bot'] != "off"){
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
🥱 Your bot has been turned off successfully
",
]);
$connect->query("UPDATE `settings` SET `bot` = 'off'");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
✅ Your robot has been turned on successfully
",
]);
$connect->query("UPDATE `settings` SET `bot` = 'on'");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}}

elseif($text == '📍 Subcategory' and $tc == 'private' and in_array($from_id,$admin)){
$coin = $settingsdb['zircoin'];
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
💰 current coin » $coin

Enter the new coin to enter the new subset
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"⚙️ Settings"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'stzircoin' WHERE `id` = '$from_id' LIMIT 1");
}

elseif($user['step'] == 'stzircoin' && $text != "⚙️ Settings"){
if(preg_match("/^[0-10-9]+$/", $text && strpos($text,".") !== false)) {
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
Changes have been made
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_tzn
]);
$connect->query("UPDATE `settings` SET `zircoin` = '$text'");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
📍 Sending the number is allowed
",
'reply_to_message_id'=>$message_id,
]);
}}

elseif($text == '• statistics •' and $tc == 'private' and in_array($from_id,$admin)){
$all_admin = mysqli_num_rows(mysqli_query($connect,"select `id` from `admin`"));
$all_adbot = mysqli_num_rows(mysqli_query($connect,"select `id` from `adbot`"));
$all_ads   = mysqli_num_rows(mysqli_query($connect,"select `id` from `ads`"));
$all_block = mysqli_num_rows(mysqli_query($connect,"select `id` from `block`")); 
$all_bots  = mysqli_num_rows(mysqli_query($connect,"select `id` from `bots`"));
$all_spam  = mysqli_num_rows(mysqli_query($connect,"select `id` from `spam`"));
$all_user  = mysqli_num_rows(mysqli_query($connect,"select `id` from `user`"));
$all_view  = mysqli_num_rows(mysqli_query($connect,"select `id` from `view`"));

if($settingsdb['bot'] != "off"){
$xd_off = "ON";
}else{
$xd_off = "OFF";
}
if($settingsdb['d1'] != "off"){
$xd_d1 = "ON";
}else{
$xd_d1 = "OFF";
}
if($settingsdb['d2'] != "off"){
$xd_d2 = "ON";
}else{
$xd_d2 = "OFF";
}
if($settingsdb['wallet'] != null){
$xd_wallet = $settingsdb['wallet'];
}else{
$xd_wallet = "Not set";
}

$min = $settingsdb['min'];
$zir = $settingsdb['zircoin'];
$arz = $settingsdb['arz'];

bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
• Statistics of your robot so far »

🤖 Robot status » $xd_off

➕ Inventory increase » $xd_d1
➖ Balance withdrawal » $xd_d2

💳 Registered wallet » $xd_wallet
💸 Minimum withdrawal » $min
💲 Currency type » $arz
🫂 Subcategory bonus » $zir
———————
👨🏼‍💼 admins » $all_admin
🤖 Bot ads in queue » $all_adbot
👁‍🗨 View ads in queue » $all_ads
🚫 Blocks » $all_block
♨️ Spams » $all_spam
👤 Users » $all_user

🔸 $all_bots bot start task has been done
🔹 $all_view task viewing has been done

🆔 @yeh_XD
",
'reply_to_message_id'=>$message_id,
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}

elseif($text == '👤 Users' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
welcome
",
'reply_markup'=>$panel_admin_users
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
exit;
}

elseif($text == '💬 User information' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Please send the numerical ID of your desired account
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'uetalat' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == 'uetalat' && $text != "👤 Users"){
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$text' LIMIT 1"));
$use2   = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `block` WHERE `id` = '$text' LIMIT 1"));
if($use2['id'] == true){
$hojjat = "blocked";
}else{
$hojjat = "free";
}
if($use['id'] == true){
if($use['en'] == "persian"){
$hojjat_2 = "🇮🇷 Persian";
}
if($use['en'] == "english"){
$hojjat_2 = "🇺🇸 English";
}
$bbcc   = mysqli_num_rows(mysqli_query($connect,"select `id` from `bots` WHERE `id` = '$text'"));
$view   = mysqli_num_rows(mysqli_query($connect,"select `id` from `view` WHERE `id` = '$text'"));
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
• $text user information is as follows:

📍 This user's status is $hojjat
🌎 Language » $hojjat_2
💰 Inventory » {$use['coin']}
💳 Wakket » {$use['wall']}
👥 Subcategories » {$use['member']}

👁‍🗨 The number of viewing tasks » $view
🤖 number of start bot tasks » $bbcc
",
]);
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
This user is not in the bot
",
]);
}}

elseif($text == '➕ Coin Increase' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Please send the numerical ID of your desired account
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'pppp1' WHERE `id` = '$from_id' LIMIT 1");
} 
elseif($user['step'] == 'pppp1' && $text != "👤 Users"){
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$text' LIMIT 1"));
if($use['id'] == true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Now send the amount of coins to be deposited
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `m6` = '$text' WHERE `id` = '$from_id' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'pppp2' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❌ This user is not in the database
",
'reply_to_message_id'=>$message_id,
]);
}}
elseif($user['step'] == 'pppp2' && $text != "👤 Users"){
if(preg_match("/^[0-10-9]+$/", $text && strpos($text,".") !== false)) {
$acc    = $user['m6'];
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$acc' LIMIT 1"));
$coin   = $use['coin'];
$all    = $coin + $text;
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ The operation was done
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_users
]);
$connect->query("UPDATE `user` SET `coin` = '$all' WHERE `id` = '$acc' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Enter the amount of the input coin as in the example below » 5.0
",
]);
}}

elseif($text == '➖ Coin deduction' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Please send the numerical ID of your desired account
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'pppp3' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == 'pppp3' && $text != "👤 Users"){
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$text' LIMIT 1"));
if($use['id'] == true){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Now send the fractional number of coins
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `m6` = '$text' WHERE `id` = '$from_id' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'pppp4' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
This user is not in the database
",
'reply_to_message_id'=>$message_id,
]);
}}
elseif($user['step'] == 'pppp4' && $text != "👤 Users"){
if(preg_match("/^[0-10-9]+$/", $text && strpos($text,".") !== false)) {
$acc    = $user['m6'];
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `user` WHERE `id` = '$acc' LIMIT 1"));
$coin   = $use['coin'];
$all    = $coin - $text;
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ The operation was done
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_users
]);
$connect->query("UPDATE `user` SET `coin` = '$all' WHERE `id` = '$acc' LIMIT 1");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Enter the amount of the input coin as in the example below » 5.0
",
]);
}}

elseif($text == '🟢 Unblock' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Please send the numerical ID of your desired account
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'pppp5' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == "pppp5" && $text != "👤 Users"){
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `block` WHERE `id` = '$text' LIMIT 1"));
if($use['id'] == true){
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"The person was successfully released",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_users
]);
$connect->query("DELETE FROM `block` WHERE `id` = '{$text}' LIMIT 1 ");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
This user is not blocked
",
]);
}}

elseif($text == '🔴 Block' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
📍 Please send the numerical ID of your desired account
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"👤 Users"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'pppp6' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == "pppp6" && $text != "👤 Users"){
$use    = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `block` WHERE `id` = '$text' LIMIT 1"));
if($use['id'] == true){
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
This user is blocked
",
]);
}else{
bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
✅ It was blocked , DONE
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$panel_admin_users
]);
$connect->query("INSERT INTO `block` (`id`) VALUES ('$text')");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}}

elseif($text == '💸 Currencies' and $tc == 'private' and in_array($from_id,$admin)){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
welcome
",
'reply_markup'=>$panel_admin_arz
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
exit;
}

elseif($text == '💵 Currency type' and $tc == 'private' and in_array($from_id,$admin)){
$ab_xdteam = $settingsdb['arz'];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💲 Current bot currency » $ab_xdteam

If you want to change the currency type of the robot, send its name
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"💸 Currencies"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 's1' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == "s1" && $text != "💸 Currencies"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Robot currency exchange operation was done
",
'reply_markup'=>$panel_admin_arz
]);
$connect->query("UPDATE `settings` SET `arz` = '$text'");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}

elseif($text == '💳 Wallet' and $tc == 'private' and in_array($from_id,$admin)){
if($settingsdb['wallet'] != null){
$xd_team = $settingsdb['wallet'];
}else{
$xd_team = "NOT SET";
} 
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💳 Your current WALLET » $xd_team

If you want to change your wallet address, send us the new address
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"💸 Currencies"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 's2' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == "s2" && $text != "💸 Currencies"){
if(!preg_match('/^[ آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]+$/i',$text)){
if(strlen($text) == 42){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Your new wallet has been registered
",
'reply_markup'=>$panel_admin_arz
]);
$connect->query("UPDATE `settings` SET `wallet` = '$text'");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
❌ The input is incorrect, check the number of characters
",
]);
}}}

elseif($text == '🔸 Withdraw' and $tc == 'private' and in_array($from_id,$admin)){
if($settingsdb['d2'] != "off"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🥱 The Withdraw off
",
]);
$connect->query("UPDATE `settings` SET `d2` = 'off'");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ It turned on
",
]);
$connect->query("UPDATE `settings` SET `d2` = 'on'");
}}

elseif($text == '🔸 Deposit' and $tc == 'private' and in_array($from_id,$admin)){
if($settingsdb['d1'] != "off"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
🥱 turned off
",
]);
$connect->query("UPDATE `settings` SET `d1` = 'off'");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ It turned on
",
]);
$connect->query("UPDATE `settings` SET `d1` = 'on'");
}}

elseif($text == '💰 minimum withdrawal' and $tc == 'private' and in_array($from_id,$admin)){
$xd_team = $settingsdb['min'];
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
💲 Minimum currency withdrawal » $xd_team

At least submit a new impression Example » 5.0
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"💸 Currencies"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 's3' WHERE `id` = '$from_id' LIMIT 1");
}
elseif($user['step'] == "s3" && $text != "💸 Currencies"){
if(preg_match("/^[0-10-9]+$/", $text && strpos($text,".") !== false)) {
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
It was done
",
'reply_markup'=>$panel_admin_arz
]);
$connect->query("UPDATE `settings` SET `min` = '$text'");
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
}else{
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
Error in input
",
]);
}} 
elseif($text == '⚙️ Current settings ⚙️' and $tc == 'private' and in_array($from_id,$admin)){
if($settingsdb['d1'] != "off"){
$xd_d1 = "on";
}else{
$xd_d1 = "off";
}
if($settingsdb['d2'] != "off"){
$xd_d2 = "on";
}else{
$xd_d2 = "off";
}
if($settingsdb['wallet'] != null){
$xd_wallet = $settingsdb['wallet'];
}else{
$xd_wallet = "not set";
}

$min = $settingsdb['min'];

bot('sendmessage',[       
'chat_id'=>$from_id,
'text'=>"
➕ Inventory increase » $xd_d1
➖ Balance withdrawal » $xd_d2

💳 Registered wallet » $xd_wallet
💸 minimum withdrawal » $min",
]);
}

elseif ($text == '📨 Public posting' and $tc == 'private' and in_array($from_id,$admin)) {
$send = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `sendall` LIMIT 1"));
if($send['vaz'] == "off"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"🔆 Please submit your text or media cannot include glass button!",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"• panel •"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'sendtoasll' WHERE `id` = '$from_id' LIMIT 1");
}else{

if($send['step'] == "send"){
$noo = "Public posting";
}
if($send['step'] == "forward"){
$noo = "Public forward";
}
if($send['vaz'] == "on"){
$noo2 = "sending..";
}else{
$noo2 = "There is a problem";
}

bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⚠️ You have a ($noo) in the queue...

♻️ Status » $noo2

📝 Sending user » {$send['sd']}
👤 Users in the send list » {$send['mandeh']}
✅ Sent users » {$send['user']}

⏳ Almost {$send['xdhojjat']} minutes left to send
",
]);
}}
elseif ($user['step'] == 'sendtoasll' && $text != "• panel •") {
$caption = $update->message->caption;
if(isset($message->photo)){
$photo = $message->photo[count($message->photo)-1]->file_id;
$xd = "1";
$xd1 = "Image";
}
if(isset($message->text)){
$xd = "2";
$xd1 = "Text";
}
if(isset($message->video)){
$photo = $message->video->file_id;
$xd = "3";
$xd1 = "the movie";
}
if(isset($message->document)){
$photo = $message->document->file_id;
$xd = "4";
$xd1 = "file";
}
if(isset($message->audio)) {
$photo = $message->audio->file_id;
$xd = "5";
$xd1 = "sound";
}
if(isset($message->voice)) {
$photo = $message->voice->file_id;
$xd = "6";
$xd1 = "voice";
}
if(isset($message->sticker)) {
$photo = $message->sticker->file_id;
$xd = "7";
$xd1 = "sticker";
}
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
✅ Your $xd1 has been set for public posting
",
'reply_markup'=>$panel_admin_1
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");
$connect->query("UPDATE `sendall` SET step = 'send' , `text` = '$text$caption' , `chat` = '$photo' , `abcd` = '$xd' , `vaz` = 'on' , `sd` = '$from_id' LIMIT 1");			
}

elseif ($text == '📨 Public forwarding' and $tc == 'private' and in_array($from_id,$admin)){
$send = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `sendall` LIMIT 1"));
if($send['vaz'] == "off"){
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"Please forward your message.",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"• panel •"]]
],
'resize_keyboard'=>true
])
]);
$connect->query("UPDATE `user` SET `step` = 'fortoasdll' WHERE `id` = '$from_id' LIMIT 1");		
}else{

if($send['step'] == "send"){
$noo = "Public posting";
}
if($send['step'] == "forward"){
$noo = "Public forward";
}
if($send['vaz'] == "on"){
$noo2 = "sending..";
}else{
$noo2 = "There is a problem";
}

bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"
⚠️ You have a ($noo) in the queue...

♻️ Status » $noo2

📝 Sending user » {$send['sd']}
👤 Users in the send list » {$send['mandeh']}
✅ Sent users » {$send['user']}

⏳ Almost {$send['xdhojjat']} minutes left to send
",
]);
}}
elseif ($user['step'] == 'fortoasdll' && $text != "• panel •") {
bot('sendmessage',[
'chat_id'=>$from_id,
'text'=>"✔️ Your message has been successfully set as public forwarding",
'reply_markup'=>$panel_admin_1
]);
$connect->query("UPDATE `user` SET `step` = 'none' WHERE `id` = '$from_id' LIMIT 1");	
$connect->query("UPDATE `sendall` SET `step` = 'forward' , `text` = '$message_id' , `chat` = '$from_id' , `vaz` = 'on' , `sd` = '$from_id' LIMIT 1");		
}
 