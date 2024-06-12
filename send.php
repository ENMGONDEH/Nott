<?php
 
## کرون 1 مین بزنید روش
include '../config.php';

$send = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `sendall` LIMIT 1"));

function bot($method,$datas=[]){
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL,'https://api.telegram.org/bot'.API_KEY.'/'.$method );
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
return json_decode(curl_exec($ch));
}
if($send['step'] == 'send'){
$alluser = mysqli_num_rows(mysqli_query($connect,"select id from `user`"));
$users = mysqli_query($connect,"SELECT id FROM `user` LIMIT 100 OFFSET {$send['user']}");
if($send['abcd'] == "1"){
while($row = mysqli_fetch_assoc($users))
bot('sendphoto',[
'chat_id'=>$row['id'],
'photo'=>$send['chat'],
'caption'=>$send['text'],
]);
}
if($send['abcd'] == "2"){
while($row = mysqli_fetch_assoc($users))
bot('sendmessage',[
'chat_id'=>$row['id'],        
'text'=>$send['text'],
]);	
}
if($send['abcd'] == "3"){
while($row = mysqli_fetch_assoc($users))
bot('sendvideo',[
'chat_id'=>$row['id'],
'video'=>$send['chat'],
'caption'=>$send['text'],
]);
}
if($send['abcd'] == "4"){
while($row = mysqli_fetch_assoc($users))
bot('sendDocument',[
'chat_id'=>$row['id'],
'document'=>$send['chat'],
'caption'=>$send['text'],
]);
}
if($send['abcd'] == "5"){
while($row = mysqli_fetch_assoc($users))
bot('sendaudio',[
'chat_id'=>$row['id'],
'audio'=>$send['chat'],
'caption'=>$send['text'],
]);
}
if($send['abcd'] == "6"){
while($row = mysqli_fetch_assoc($users))
bot('sendvoice',[
'chat_id'=>$row['id'],
'voice'=>$send['chat'],
'caption'=>$send['text'],
]);
}
if($send['abcd'] == "7"){
while($row = mysqli_fetch_assoc($users))
bot('sendsticker',[
'chat_id'=>$row['id'],
'sticker'=>$send['chat'],
'caption'=>$send['text'],
]);
}
$a_1 = $send['user'];
$a_2 = $a_1 + 100;
$a_3 = $alluser - $a_2;
$a_4 = $a_3 / 100;
$connect->query("UPDATE `sendall` SET `xdhojjat` = '$a_4' LIMIT 1");
$connect->query("UPDATE `sendall` SET `mandeh` = '$a_3' LIMIT 1");
$connect->query("UPDATE `sendall` SET `user` = `user` + 100 LIMIT 1");
if($send['user'] + 100 >= $alluser){
$kon = $send['sd'];
bot('sendmessage',[
'chat_id'=>$kon,
'text'=>"
The message has been sent to all users.
✅ پیام برای همه کابران ارسال شد",
]);
$connect->query("UPDATE `sendall` SET `step` = 'none' , `text` = '' , `user` = '0' , `chat` = '' , `vaz` = 'off' LIMIT 1");	
}
}
## forward
elseif($send['step'] == 'forward'){
$alluser = mysqli_num_rows(mysqli_query($connect,"select id from `user`"));
$users = mysqli_query($connect,"SELECT id FROM `user` LIMIT 100 OFFSET {$send['user']}");
while($row = mysqli_fetch_assoc($users))
bot('ForwardMessage',[
'chat_id'=>$row['id'],   
'from_chat_id'=>$send['chat'],
'message_id'=>$send['text'],
]);	
$a_1 = $send['user'];
$a_2 = $a_1 + 100;
$a_3 = $alluser - $a_2;
$a_4 = $a_3 / 100;
$connect->query("UPDATE `sendall` SET `xdhojjat` = '$a_4' LIMIT 1");
$connect->query("UPDATE `sendall` SET `mandeh` = '$a_3' LIMIT 1");
$connect->query("UPDATE `sendall` SET `user` = `user` + 100 LIMIT 1");
if($send['user'] + 100 >= $alluser){
$kon = $send['sd'];
  bot('sendmessage',[
      'chat_id'=>$kon,
      'text'=>"
      DONE
      ✅ پیام برای همه کابران فوروارد شد",
 ]);
$connect->query("UPDATE `sendall` SET `step` = 'none' , `text` = '' , `user` = '0' , `chat` = '' , `vaz` = 'off' LIMIT 1");		
}
} 