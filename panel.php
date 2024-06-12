<?php
 
include 'update.php';
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
 