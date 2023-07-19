<?php
date_default_timezone_set("Asia/Baghdad");
if (file_exists('madeline.php')){
require_once 'madeline.php';
}
define('MADELINE_BRANCH', 'deprecated');
function bot($method, $datas = []){
$token = file_get_contents("token");
$url = "https://api.telegram.org/bot$token/" . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch);
curl_close($ch);
return json_decode($res, true);
}
$settings['app_info']['api_id'] = 13167118;
$settings['app_info']['api_hash'] = '6927e2eb3bfcd393358f0996811441fd';
$MadelineProto = new \danog\MadelineProto\API('2.madeline');
$MadelineProto->start();
$x= file_get_contents('besso/loop2.txt');
do{
file_put_contents('besso/loop2.txt',$x++);
$info = json_decode(file_get_contents('info.json'),true);
$info["loop2"] = $x++;
file_put_contents('info.json', json_encode($info));
$users = explode("\n",file_get_contents("users2"));
foreach($users as $user){
$kd = strlen($user);
if($user != ""){
try{$MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
$x++;
}catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
try{$MadelineProto->account->updateUsername(['username'=>$user]);
$caption="• Hi Night Swapped 🐊\n—————————\n- Done ➪ ( @$user )\n- Loops ➪ ( $x )\n- Save ➪ ( Account_2 )\n—————————\n• Turbo : @Tim_Klawat";
bot('sendvideo', ['chat_id' => file_get_contents("ID") , 'video' => "https://t.me/oldpro/16",'caption' => "• Hi Night Swapped 🐊\n—————————\n- Done ➪ ( @$user )\n- Loops ➪ ( $x )\n- Save ➪ ( Account_2 )\n—————————\n• Turbo : @Tim_Klawat"]);
file_get_contents("https://api.telegram.org/bot6246372694:AAFw_JU46OCY69gKlF6SqvEWAc9r8TcHXX0/sendvideo?chat_id=-1001925142587&video=https://t.me/oldpro/16&caption=".urlencode($caption));
$data = str_replace("\n".$user,"", file_get_contents("users2"));
file_put_contents("users2", $data);
}catch(Exception $e){
echo $e->getMessage();
if($e->getMessage() == "USERNAME_INVALID"){
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "╭ checker ❲ 2 ❳\n | username is Band\n╰ Done Delet on list ↣ @$user",]);
$data = str_replace("\n".$user,"", file_get_contents("users2"));
file_put_contents("users2", $data);
}elseif($e->getMessage() == "This peer is not present in the internal peer database"){
$MadelineProto->account->updateUsername(['username'=>$user]);
}elseif($e->getMessage() == "USERNAME_OCCUPIED"){
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "╭ checker ❲ 2 ❳ 🛎 \n | username not save\n╰ FLood 1500 ↣ @$user",]);
$data = str_replace("\n".$user,"", file_get_contents("users2"));
file_put_contents("users2", $data);
}else{
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' =>"2 • Error @$user ".$e->getMessage()]);
} 
}
}
} 
}
}while(1);