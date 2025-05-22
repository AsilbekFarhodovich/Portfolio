<?php
ob_start();
error_reporting(0);
date_Default_timezone_set('Asia/Tashkent');

/*
Ushbu script @AlijonovUz ( Alijonov Abdulbosit ) tomonidan tuzib chiqilgan.
Manba: @AlijonovUz

Har doimgiday manba bilan olamiz ( choparlar ).
*/

define("AlijonovUz",'6472378795:AAHj44D5SFYvBl9gEqS-C5liUaDULbLtsfs');
$AlijonovUz = "5504419408";
$earnbot = "XBuilderUzBot";
$admins = file_get_contents("tizim/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$AlijonovUz);
$bot = bot('getme',['bot'])->result->username;
$soat = date('H:i');
$clock = date('H:i:s');
$sana = date("d.m.Y");

require ("sql.php");

function bot($method,$datas=[]){
	$url = "https://api.telegram.org/bot".AlijonovUz."/".$method;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
	$res = curl_exec($ch);
	if(curl_error($ch)){
		var_dump(curl_error($ch));
	}else{
		return json_decode($res);
	}
}


function getAdmin($chat){
$url = "https://api.telegram.org/bot".AlijonovUz."/getChatAdministrators?chat_id=@".$chat;
$result = file_get_contents($url);
$result = json_decode ($result);
return $result->ok;
}

function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}

function token($str,$begin,$end){
for($i = $begin; $i < $end; $i++) $str[$i] = '*';
return $str;
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$get = file_get_contents("tizim/kanal.txt");
$ex = explode("\n",$get);
if($get == null){
return true;
	}else{
for($i=0;$i<=count($ex) -1;$i++){
$url = explode("\n",$get)[$i]; 
$a = json_decode(file_get_contents("https://api.telegram.org/bot".AlijonovUz."/getchat?chat_id=$url"));
$name = $a->result->title;
     $ret = bot("getChatMember",[
         "chat_id"=>"$url",
         "user_id"=>$id,
         ]);
$stat = $ret->result->status;
         if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
      $array['inline_keyboard']["$i"][0]['text'] = "✅ ". $name;
      $array['inline_keyboard']["$i"][0]['url'] = "https://t.me/".str_replace('@','',$url);
         }else{
  $array['inline_keyboard']["$i"][0]['text'] = "❌ ". $name;
      $array['inline_keyboard']["$i"][0]['url'] = "https://t.me/".str_replace('@','',$url);
$uns = true;
}
}
$array['inline_keyboard']["$i"][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "result";
if($uns == true){
     bot('sendMessage',[
         'chat_id'=>$id,
         'text'=>"⛔️ <b>Botdan to'liq foydalanish uchun</b> quyidagi kanallarga obuna bo'ling:",
'parse_mode'=>html,
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode($array),
]);  
exit();
return false;
}else{
return true;
}
}
}

function send($cid,$text,$key){
return bot('sendMessage',[
'chat_id'=>$cid,
'text'=>$text,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$key
]);
}

function edit($cid2,$mid2,$text,$key){
return bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>$text,
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>$key
]);
}

function delete($cid2,$mid2){
return bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
}

function getName($id){
$getname = bot('getchat',['chat_id'=>$id])->result->first_name;
if(!empty($getname)){
return $getname;
}else{
return bot('getchat',['chat_id'=>$id])->result->title;
}}

$alijonov = json_decode(file_get_contents('php://input'));
$message = $alijonov->message;
$cid = $message->chat->id;
$name = $message->chat->first_name;
$tx = $message->text;
$step = file_get_contents("step/$cid.step");
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$uid = $message->from->id;
$name = $message->from->first_name;
$familya = $message->from->last_name;
$premium = $message->from->is_premium;
$bio = $message->from->about;
$username = $message->from->username;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$reply = $message->reply_to_message->text;
$nameru = "<a href='tg://user?id=$uid'>$name $familya</a>";

$contact = $message->contact;
$contact_id = $contact->user_id;
$contact_user = $contact->username;
$contact_name = $contact->first_name;
$phone = $contact->phone_number;

$doc = $alijonov->message->document;
$doc_id = $doc->file_id;

//inline uchun metodlar
$data = $alijonov->callback_query->data;
$qid = $alijonov->callback_query->id;
$id = $alijonov->inline_query->id;
$query = $alijonov->inline_query->query;
$query_id = $alijonov->inline_query->from->id;
$cid2 = $alijonov->callback_query->message->chat->id;
$mid2 = $alijonov->callback_query->message->message_id;
$callfrid = $alijonov->callback_query->from->id;
$callname = $alijonov->callback_query->from->first_name;
$calluser = $alijonov->callback_query->from->username;
$surname = $alijonov->callback_query->from->last_name;
$about = $alijonov->callback_query->from->about;
$frid= $update->callback_query->from->id;
$nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";

if(file_get_contents("tizim/holat.txt")){
	}else{
if(file_put_contents("tizim/holat.txt",'✅'));
}
if(file_get_contents("tizim/admins.txt")){
}else{
	if(file_put_contents("tizim/admins.txt",$AlijonovUz));
}
if(file_get_contents("tizim/taklif.txt")){
}else{
	if(file_put_contents("tizim/taklif.txt",'100'));
}
if(file_get_contents("tizim/valyuta.txt")){
	}else{
		if(file_put_contents("tizim/valyuta.txt","so'm"));
}

if(file_get_contents("tizim/bonusmin.txt")){
	}else{
		if(file_put_contents("tizim/bonusmin.txt","2"));
}
if(file_get_contents("tizim/bonusmax.txt")){
	}else{
		if(file_put_contents("tizim/bonusmax.txt","10"));
}
if(file_get_contents("tizim/bonusstatus.txt")){
	}else{
		if(file_put_contents("tizim/bonusstatus.txt","❌"));
}
if(file_get_contents("tizim/oraliqvaqt.txt")){
	}else{
		if(file_put_contents("tizim/oraliqvaqt.txt","1"));
}
if(file_get_contents("tizim/bonusoladi.txt")){
	}else{
		if(file_put_contents("tizim/bonusoladi.txt","20"));
}

if(file_get_contents("tizim/guruh1.txt")){
	}else{
		if(file_put_contents("tizim/guruh1.txt","Kiritipmagan"));
}
if(file_get_contents("tizim/cvip.txt")){
	}else{
if(file_put_contents("tizim/cvip.txt",'3000'));
}
if(file_get_contents("tizim/cashback.txt")){
	}else{
if(file_put_contents("tizim/cashback.txt",'3'));
}
if(file_get_contents("tizim/cash.txt")){
	}else{
		if(file_put_contents("tizim/cash.txt","O'chirilgan"));
}

if(file_get_contents("tizim/cc.txt")){
	}else{
		if(file_put_contents("tizim/cc.txt","50000"));
}
if(file_get_contents("tizim/fc.txt")){
	}else{
		if(file_put_contents("tizim/fc.txt","30000"));
}

if(file_get_contents("tizim/k-matn.txt")){
 }else{
  if(file_put_contents("tizim/k-matn.txt","🚫 Haftalik konkurs o'z nihoyasiga yetdi..."));
}
if(file_get_contents("tizim/k-top.txt")){
}else{
if(file_put_contents("tizim/k-top.txt","10"));
}

$res = mysqli_query($connect,"SELECT*FROM user_id WHERE user_id=$cid");
while($a = mysqli_fetch_assoc($res)){
$user_id = $a['user_id'];
$reg = $a['reg'];
}

$res = mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid");
while($a = mysqli_fetch_assoc($res)){
$kab_id = $a['user_id'];
$pul = $a['pul'];
$pul2 = $a['pul2'];
$odam = $a['odam'];
$gmail = $a['gmail'];
$ban = $a['ban'];
}

$res = mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid");
while($a = mysqli_fetch_assoc($res)){
$cc = $a['cc'];
$fc = $a['fc'];
}

$res = mysqli_query($connect,"SELECT*FROM uid WHERE user_id = $cid");
while($a = mysqli_fetch_assoc($res)){
$fid = $a['uid'];
}

$res = mysqli_query($connect,"SELECT*FROM api WHERE user_id = $cid");
while($a = mysqli_fetch_assoc($res)){
$api_id = $a['user_id'];
$api = $a['api'];
}

$res = mysqli_query($connect,"SELECT*FROM status WHERE user_id=$chat_id");
while($a = mysqli_fetch_assoc($res)){
$status = $a['status'];
$kun = $a['kun'];
$stat_id = $a['user_id'];
}

$step = file_get_contents("step/$cid.step");
$baza = file_get_contents("step/$cid.txt");
$cid3 = file_get_contents("step/$cid.id");
$qoida = file_get_contents("tizim/qoida.txt");
$holat = file_get_contents("tizim/holat.txt");
$kanal = file_get_contents("tizim/kanal.txt");
$taklif = file_get_contents("tizim/taklif.txt");
$card_cc = file_get_contents("tizim/cc.txt");
$card_fc = file_get_contents("tizim/fc.txt");
$promo = file_get_contents("tizim/kanal2.txt");
$guruh1 = file_get_contents("tizim/guruh1.txt");
$gr1_id = file_get_contents("tizim/gr1.txt");
$gpul = file_get_contents("tizim/gpul.txt");
$payme = file_get_contents("tizim/payme.txt");
$check = file_get_contents("tizim/check.txt");
$user = file_get_contents("tizim/user.txt");
$valyuta = file_get_contents("tizim/valyuta.txt");
$cVip = file_get_contents("tizim/cvip.txt");
$cashback = file_get_contents("tizim/cashback.txt");
$cash = file_get_contents("tizim/cash.txt");

$kbonus = file_get_contents("tizim/kanal3.txt");
$bonusmin = file_get_contents("tizim/bonusmin.txt");
$bonusmax = file_get_contents("tizim/bonusmax.txt");
$bonusoladi = file_get_contents("tizim/bonusoladi.txt");
$bonustime = file_get_contents("tizim/bonustime.time");
$bonusvaqti = file_get_contents("tizim/oraliqvaqt.txt");
$bonusstatus = file_get_contents("tizim/bonusstatus.txt");

$kod = file_get_contents("step/kod.txt");
$money = file_get_contents("step/money.txt");
$post = file_get_contents("step/mid.txt");
$date = file_get_contents("tizim/bonustime.time");
$post1 = file_get_contents("step/mesid.txt");

$kategoriya = file_get_contents("bot/kategoriya.txt");
$royxat = file_get_contents("bot/$kategoriya/royxat.txt");
$type = file_get_contents("bot/$kategoriya/$royxat/turi.txt");
$narx = file_get_contents("bot/$kategoriya/$royxat/narx.txt");
$kunlik = file_get_contents("bot/$kategoriya/$royxat/kunlik.txt");
$tavsif = file_get_contents("bot/$kategoriya/$royxat/tavsif.txt");
$til = file_get_contents("bot/$kategoriya/$royxat/til.txt");
$versiya = file_get_contents("bot/$kategoriya/$royxat/versiya.txt");

$turi = file_get_contents("tizim/turi.txt");
$addition = file_get_contents("tizim//addition.txt");
$wallet = file_get_contents("tizim//wallet.txt");
$test = file_get_contents("step/test.txt");

$kmatn = file_get_contents("tizim/k-matn.txt");
$ktop = file_get_contents("tizim/k-top.txt");


$auto = file_get_contents("step/auto.txt");
$auto2 = file_get_contents("step/auto2.txt");
$key = uniqid(uniqid());
$mt = file_get_contents("step/$cid.mt");
$kodi = file_get_contents("gmail/$cid.kod");
$mt2 = file_get_contents("step/$cid.mt2");
mkdir("step");
mkdir("tizim");
mkdir("bonus");
mkdir("games");
mkdir("games/kosti");
mkdir("games/slot");
mkdir("games/numbers");
mkdir("bonus/bonus");
mkdir("bonus/fayl");
mkdir("bot");
mkdir("baza");
mkdir("bots");

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📢 Kanallar"],['text'=>"🏆 Konkurs"]],
[['text'=>"📊 Statistika"],['text'=>"✉ Xabar yuborish"]],
[['text'=>"⚙ Asosiy sozlamalar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"◀️ Orqaga"]]
]
]);

$asosiy = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"*️⃣ Birlamchi sozlamalar"]],
[['text'=>"🤖 Bot holati"],['text'=>"🤖 Botlar"]],
[['text'=>"🎲 O'yin sozlamalari"]],
[['text'=>"📋 Adminlar"],['text'=>"📓 Qoidalar"]],
[['text'=>"💳 Hamyonlar"],['text'=>"⚙ Avto to'lov"]],
[['text'=>"⚙ Boshqarish"]],
]
]);

$menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🛠 Botlarni boshqarish"]],
[['text'=>"💵 Pul ishlash"],['text'=>"📱 Kabinet"]],
[['text'=>"🛒 Bot do'koni"],['text'=>"📋 Ma'lumotlar"]],
[['text'=>"🏆 Referal konkurs"]],
]
]);

$menus = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🛠 Botlarni boshqarish"]],
[['text'=>"💵 Pul ishlash"],['text'=>"📱 Kabinet"]],
[['text'=>"🛒 Bot do'koni"],['text'=>"📋 Ma'lumotlar"]],
//[['text'=>"🏆 Referal konkurs"]],
[['text'=>"⚙ Boshqarish"]],
]
]);

$boshqar = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕ Yangi bot ochish"]],
[['text'=>"⚙ Botlarni sozlash"],['text'=>"💵 To'lovlar"]],
[['text'=>"◀️ Orqaga"]],
]
]);

$back = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]
]);

$bosh = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙ Boshqarish"]],
]
]);

if(in_array($cid, $admin)){
	$menu = $menus;
}else{
	$menu = $menu;
}

if(in_array($cid2, $admin)){
	$menyu = $menus;
}else{
	$menyu = $menu;
}


if($text){
	if($ban == "ban"){
	exit();
}else{
}
}
if($data){
$ban = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['ban'];
	if($ban == "ban"){
	exit();
}else{
}
}

if($text){
 if($holat == "❌"){
	if(in_array($cid,$admin)){
}else{
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"⛔️ <b>Bot vaqtinchalik o'chirilgan!</b>

<i>Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!</i>",
'parse_mode'=>'html',
]);
exit();
}
}else{
}
}

if($data){
 if($holat == "❌"){
	if(in_array($cid2,$admin)){
}else{
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"⛔️ Bot vaqtinchalik o'chirilgan!

Botda ta'mirlash ishlari olib borilayotgan bo'lishi mumkin!",
		'show_alert'=>true,
		]);
exit();
}
}else{
}
}

if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = $cid");
$rew = mysqli_fetch_assoc($result);
if($rew){
}else{
mysqli_query($connect,"INSERT INTO user_id(`user_id`,`reg`) VALUES ('$cid','$sana | $soat')");
}
}

if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM kabinet WHERE user_id = $cid");
$rew = mysqli_fetch_assoc($result);
if($rew){
}else{
mysqli_query($connect,"INSERT INTO kabinet(`user_id`,`pul`,`pul2`,`odam`,`ban`) VALUES ('$cid','1000','0','0','unban')");
}
}

if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM card WHERE user_id = $cid");
$rew = mysqli_fetch_assoc($result);
if($rew){
}else{
mysqli_query($connect,"INSERT INTO card(`user_id`,`cc`,`fc`) VALUES ('$cid','0','0')");
}
}

if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM status WHERE user_id = $cid");
$row = mysqli_fetch_assoc($result);
if(!$row){
mysqli_query($connect,"INSERT INTO status(`user_id`,`status`,`kun`) VALUES ('$cid','Oddiy','0')");
}
}
if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM api WHERE user_id = $cid");
$rew = mysqli_fetch_assoc($result);
if($rew){
}else{
mysqli_query($connect,"INSERT INTO api(`user_id`,`api`) VALUES ('$cid','$key')");
}
}

if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM uid WHERE user_id = $cid");
$rew = mysqli_fetch_assoc($result);
if($rew){
}else{
mysqli_query($connect,"INSERT INTO uid(user_id) VALUES ('$cid')");
}
}

if($text == "/start"){
	if(mb_stripos($user_id,$cid)!==false){
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"🖥 <b>Asosiy menyudasiz.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$menyu,
		]);
exit();
}else{
	bot('sendMessage',[
		'chat_id'=>$cid,
    'text'=>"💎 <b>Salom $name!</b>

@$bot ga xush kelibsiz!",
    'parse_mode'=>'html',
		'reply_markup'=>$menyu,
		]);
		sleep(3);
		bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🔥 Reklama!</b>

⚠️ Reklama xabarlari sinovdan o'tkazilmoqda... ",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"❓ Reklama xabarlari","callback_data"=>"rekinfo"]],
]
])
]);
exit();
}
}

if(mb_stripos($text,"RISE")!==false){
$id = str_replace("/start RISE","",$text);
$refid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM uid WHERE uid = $id"))['user_id'];
if(strlen($refid)>0 and $refid>0){
if($refid == $cid){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥 <b>Asosiy menyudasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
exit();
}else{
if(mb_stripos($user_id,"$cid")!==false){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"🖥 <b>Asosiy menyudasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu
]);
exit();
}else{
if($kanal == null){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id=$refid"))['pul'];
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $refid"))['odam'];
$a = $pul + $taklif;
$b = $odam + 1;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $refid");
mysqli_query($connect,"UPDATE kabinet SET odam = $b WHERE user_id = $refid");
mysqli_query($connect,"UPDATE user_id SET refid = $refid WHERE user_id = $cid");
$text = "📳 <b>Sizda yangi</b> <a href='tg://user?id=$cid'>taklif</a> <b>mavjud!</b>

Hisobingizga $taklif $valyuta qo'shildi!";
}else{
file_put_contents("step/$cid.id",$refid);
file_put_contents("step/$cid.txt",$refid);
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $refid"))['odam'];
$a = $odam + 1;
mysqli_query($connect, "UPDATE kabinet SET odam = '$a' WHERE user_id = $refid");
mysqli_query($connect,"UPDATE user_id SET refid = $refid WHERE user_id = $cid");
$text = "📳 <b>Sizda yangi</b> <a href='tg://user?id=$cid'>taklif</a> <b>mavjud!</b>";
}
bot('sendMessage',[
'chat_id'=>$cid,
    'text'=>"💎 <b>Salom $name!</b>

@$bot ga xush kelibsiz!",
    'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
sleep(3);
bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🔥 Reklama!</b>

⚠️ Reklama xabarlari sinovdan o'tkazilmoqda... ",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"❓ Reklama xabarlari","callback_data"=>"rekinfo"]],
]
])
]);
bot('SendMessage',[
'chat_id'=>$refid,
'text'=>$text,
'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($data == "result"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
if(joinchat($cid2)==true ){
$baza = file_get_contents("step/$cid2.txt");
$cid3 = file_get_contents("step/$cid2.id");
if($baza != $cid3){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"✅ Asosiy menyidasiz.",
		'show_alert'=>false,
		]);
bot('SendMessage',[
'chat_id'=>$cid2,
	'text'=>"🖥 <b>Asosiy menyuga qaytdingiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$menyus,
]);
exit();
}else{
	$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid3"))['pul'];
	$a = $pul + $taklif;
	mysqli_query($connect, "UPDATE kabinet SET pul = '$a' WHERE user_id = $cid3");
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"✅ Asosiy menyidasiz.",
		'show_alert'=>false,
		]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"🖥 <b>Asosiy menyudasiz.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
bot('SendMessage',[
'chat_id'=>$cid3,
'text'=>"✅ <b>Hisobingizga $taklif $valyuta qo'shildi!</b>",
'parse_mode'=>'html',
]);
unlink("step/$cid2.txt");
unlink("step/$cid2.id");
exit();
}
}
}

if($data == "rekinfo"){
delete($cid2, $mid2);
if(joinchat($cid2)=="true"){
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"🛠️ Reklamalar sinovdan o'tkazilmoqda...",
		'show_alert'=>false,
		]);
bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>💬 Bu yerda</b> sizning reklamangiz, bo'lishi mumkin.

📣 <b><u>Reklama xizmati:</u> @$user</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Yopish","callback_data"=>"yopish"]],
]
])
]);
}
}

if($text == "◀️ Orqaga"){
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"🖥 <b>Asosiy menyuga qaytdingiz.</b>",
		'parse_mode'=>'html',
		'reply_markup'=>$menyu,
		]);
unlink("step/$cid.step");
unlink("step/$cid.mt");
unlink("lik/$cid.lik");
exit();
}

if($text == "📱 Kabinet" and joinchat($cid)==true){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"🗄 <b>Kabinetingizga xush kelibsiz!
├─🔎 UID: <code>$fid</code>
├─💵 Balansingiz:</b> $pul $valyuta
├─👥 <b>Takliflaringiz soni:</b> $odam ta
├─👑<b> Statusingiz:</b> $status
└─➕ <b>Kiritgan pullaringiz:</b> $pul2 $valyuta",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ Pul kiritish",'callback_data'=>"oplata"],['text'=>"🔁 Pul o'tkazish",'callback_data'=>"almashish"]],
	[['text'=>"👑 Premium",'callback_data'=>"premium"]],
	[['text'=>"↘️",'callback_data'=>"kabinet2"],['text'=>"⚙️",'callback_data'=>"sozlama"]],
]
])
]);
exit();
}



if($data == "kabinet"){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$fid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM uid WHERE user_id = $cid2"))['uid'];
$pul2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul2'];
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['odam'];
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
	bot('editMessageText',[
	'message_id'=>$mid2,
	'chat_id'=>$cid2,
'text'=>"🗄 <b>Kabinetingizga xush kelibsiz!
├─🔎 UID: <code>$fid</code>
├─💵 Balansingiz:</b> $pul $valyuta
├─👥 <b>Takliflaringiz soni:</b> $odam ta
├─👑<b> Statusingiz:</b> $status
└─➕ <b>Kiritgan pullaringiz:</b> $pul2 $valyuta",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ Pul kiritish",'callback_data'=>"oplata"],['text'=>"🔁 Pul o'tkazish",'callback_data'=>"almashish"]],
	[['text'=>"👑 Premium",'callback_data'=>"premium"]],
	[['text'=>"↘️",'callback_data'=>"kabinet2"],['text'=>"⚙️",'callback_data'=>"sozlama"]],
]
])
]);
exit();
}

if($data == "kabinet2"){
	$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$fid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM uid WHERE user_id = $cid2"))['uid'];
$pul2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul2'];
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['odam'];
$cc = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['cc'];
$fc = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['fc'];
	bot('editMessageText',[
	'message_id'=>$mid2,
	'chat_id'=>$cid2,
	'text'=>"🗄 <b>Kabinetingizga xush kelibsiz!
├─🔎 UID: <code>$fid</code>
├─💵 Balansingiz:</b> $pul $valyuta
├─👥 <b>Takliflaringiz soni:</b> $odam ta
├─👑<b> Statusingiz:</b> $status
└─➕ <b>Kiritgan pullaringiz:</b> $pul2 $valyuta

📦 <u>QUTI:</u>
├─ 🎫 $cc <b>CreateCard</b>
└─ 🎫 $fc <b>FeeCard</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ Pul kiritish",'callback_data'=>"oplata"],['text'=>"🔁 Pul o'tkazish",'callback_data'=>"almashish"]],
	[['text'=>"👑 Premium",'callback_data'=>"premium"]],
	[['text'=>"↖️",'callback_data'=>"kabinet"],['text'=>"⚙️",'callback_data'=>"sozlama"]],
	]
])
]);
exit();
}

if($data == "premium"){
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['kun'];
	if($status == "Premium"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>💎 PREMIUM narxi - $cVip $valyuta

Amal qilish muddati - $kun kun</b>",
'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"Uzaytirish",'callback_data'=>"puzaytirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}else{
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>👑 PREMIUM
———————————————————
PREMIUM nima va qanday imkoniyatni taqdim etadi?

   PREMIUM - foydalanuvchiga 1 oy davomida botning to'liq imkoniyatlaridan foydalanish, to'lovlar uchun doimiy chegirma va PREMIUM xaridi uchun sovg'alarni taqdim qiladi.
   PREMIUM'ga foydalanuvchi 1 oy davomida faqat 1 marta ulanishi mumkin. PREMIUM'ga ulanish ikki usul orqali amalga oshirilishi mumkin.
   

👑 PREMIUM foydalanuvchilar uchun taqdim qilinadigan imkoniyatlar va sovg'alar:

— Barcha botlar 2x arzon,
— Tugma bosib pul ishlash.
— Botni o'tkazish imkoniyati,
— Pul o'tkazish imkoniyati,
— Botlarning Bonus sifatida 45 kunlik to'lovi bepul.
— 1 CreateCard.

Yuqoridagi imkoniyatlar ro'yxatiga qo'shimcha imkoniyatlar qo'shilishi mumkin va bu imkoniyatlar allaqachon aktiv PREMIUM'da bo'lganlar uchun ham taqdim etiladi.

💎 PREMIUM narxi - $cVip $valyuta /1 FeeCard

Haqiqatdan ham sotib olmoqchimisiz?</b>",
'parse_mode'=>"html",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"Sotib olish $cVip $valyuta",'callback_data'=>"shop"]],
[['text'=>"Sotib olish 1 FeeCard",'callback_data'=>"fcshop"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}
}

if($data == "puzaytirish"){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
	if($pul >= $cVip){
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['kun'];
$a = $kun + 30;
mysqli_query($connect,"UPDATE status SET kun = $a WHERE user_id = $cid2");
$b = $pul - $cVip;
mysqli_query($connect,"UPDATE kabinet SET pul = $b WHERE user_id = $cid2");
	bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
     'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"💎 <b>PREMIUM ni amal qilish muddati uzaytirildi.</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}else{
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hisobingizda yetarli mablag' mavjud emas!",
		'show_alert'=>true,
		]);
	}
}

if($data == "shop"){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$cc = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['cc'];
	if($pul >= $cVip){		
mysqli_query($connect,"UPDATE status SET kun = '30' WHERE user_id = $cid2");
mysqli_query($connect,"UPDATE status SET status = 'Premium' WHERE user_id = $cid2");
$a = $pul - $cVip;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $cid2");
$b = $cc + 1;	
mysqli_query($connect,"UPDATE card SET cc = $b WHERE user_id = $cid2");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
     'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"💎 <b>PREMIUM - statusga muvaffaqiyatli o'tdingiz.</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}else{
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hisobingizda yetarli mablag' mavjud emas!",
		'show_alert'=>true,
		]);
	}
}

if($data == "fcshop"){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['fc'];
$cc = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['cc'];
	if($pul >= 1){		
mysqli_query($connect,"UPDATE status SET kun = '30' WHERE user_id = $cid2");
mysqli_query($connect,"UPDATE status SET status = 'Premium' WHERE user_id = $cid2");
$a = $pul - 1;
mysqli_query($connect,"UPDATE card SET fc = $a WHERE user_id = $cid2");	
$b = $cc + 1;	
mysqli_query($connect,"UPDATE card SET cc = $b WHERE user_id = $cid2");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
     'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"💎 <b>VIP - statusga muvaffaqiyatli o'tdingiz.</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]],
]
])
]);
}else{
	bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Hisobingizda yetarli mablag' mavjud emas!",
		'show_alert'=>true,
		]);
	}
}

if($data == "sozlama"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🏷 HASH kalit",'callback_data'=>"kalit"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]]
]
])
]);
}

if($data == "kalit"){
	$api = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM api WHERE user_id = $cid2"))['api'];
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🏷 <b>Sizning HASH kalitingiz:</b> <pre>$api</pre>

‼️ <i>Diqqat, HASH kalitni qayta o'rnatsangiz (yangisiga almashtirsangiz), eski HASH kalitdan foydalanib bo'lmaydi.</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔄 Qayta o'rnatish",'callback_data'=>"reset_api"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]]
]
])
]);
}

if($data == "reset_api"){
mysqli_query($connect, "DELETE FROM `api` WHERE user_id = '$cid2'");
mysqli_query($connect,"INSERT INTO api(`user_id`,`api`) VALUES ('$cid2','$key')");
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
   'text'=>"✅ <b><u>HASH Kalitingiz yangisiga almashtirildi!</u>

🏷 Sizning yangi HASH kalitingiz:</b> <pre>$key</pre>

‼️ <i>Diqqat, HASH kalitni qayta o'rnatsangiz (yangisiga almashtirsangiz), eski HASH kalitdan foydalanib bo'lmaydi.</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔄 Qayta o'rnatish",'callback_data'=>"reset_api"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"sozlama"]]
]
])
]);
}

if($data == "almashish"){
	$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
	if($status != "Oddiy"){
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
	if($pul >= "0"){
			bot('deleteMessage',[			
			'chat_id'=>$cid2,
			'message_id'=>$mid2,
			]);
			bot('sendMessage',[
			'chat_id'=>$cid2,
				'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>",
			'parse_mode'=>'html',
			'reply_markup'=>$back,
			]);		
			file_put_contents("step/$cid2.step",'almashish');
			exit();
		}else{
			bot('answerCallbackQuery',[
			'callback_query_id'=>$qid,
			'text'=>"Hisobingizda minimal o'tkazma uchun yetarli mablag' mavjud emas.

Minimal o'tkazma miqdori: 0 $valyuta",
			'show_alert'=>true,
			]);
		}
}else{
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
    'text'=>"?? Ushbu bo'lim PREMIUM foydalanuvchilar uchun!",
    'show_alert'=>true,
    ]);
}
}

	if($step == "almashish"){		
if(is_numeric($text)=="true"){	
if($text >= "0"){
	if($pul >= $text){	
			bot('SendMessage',[
			'chat_id'=>$cid,
			'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:</b>",
			'parse_mode'=>'html',
			]);		
				file_put_contents("step/$cid.step","tran-$text");
				exit();
		}else{	
			bot('SendMessage',[
			'chat_id'=>$cid,
				'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>",
			'parse_mode'=>'html',
			]);		
			exit();
}
}else{
bot('SendMessage',[
			'chat_id'=>$cid,
				'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>",
			'parse_mode'=>'html',
			]);		
			exit();
}
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
			'text'=>"<b>Qancha mablag'ingizni o'tkazmoqchisiz?</b>",
			'parse_mode'=>'html',
			]);		
			exit();
}
}



if(mb_stripos($step, "tran-")!==false){
$ex = explode("-",$step);
$miqdor = $ex[1];
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
	bot('SendMessage',[
			'chat_id'=>$cid,
			'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
			'parse_mode'=>'html',
]);
exit();
}else{
$pul2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $text"))['pul'];
$a = $pul2 + $miqdor;
$b = $pul - $miqdor;
mysqli_query($connect, "UPDATE kabinet SET pul = '$a' WHERE user_id = $text");
mysqli_query($connect, "UPDATE kabinet SET pul = '$b' WHERE user_id = $cid");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"$cid <b>tomonidan hisobingizga $miqdor $valyuta o'tkazildi.</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"$text <b>ga $miqdor $valyuta o'tkazildi. Hisobingizdan $miqdor $valyuta olib tashlandi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
unlink("step/$cid.step");
exit();
}
}

$turi = file_get_contents("tizim/turi.txt");
$more = explode("\n",$turi);
$soni = substr_count($turi,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=['text'=>"🔹️ PAYME",'callback_data'=>"payme"];
$keys[]=["text"=>"$title","callback_data"=>"pay-$title"];
$keysboard2 = array_chunk($keys, 2);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"kabinet"]];
$payment = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}

if($data == "payme"){
if($payme != null){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"💵 <b>To'lov miqdorini kiriting:</b>

<i>Minimal miqdor:</i> 1000 UZS",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid2.step","payme");
exit();
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"To'lov tizimi aktiv holatda emas!",
	'show_alert'=>true,
	]);
}
}

if($step == "payme"){
if(is_numeric($text)){
if($text >= 1000){
$amount = $text;
$card = $payme;
$description = "@$bot uchun to'lov!";
$json = json_decode(file_get_contents("https://".$_SERVER['SERVER_NAME']."/RiseBuilder/payme.php?parol=RiseBuilder&action=create&amount=".$amount."&description=".urlencode($description)."&card=".$card.""),true);
$url = $json['_result']['_details']['_pay_url'];
$check_id = $json['_result']['_details']['_id'];
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>To'lov miqdori qabul qilindi.</b>

Endi esa pastdagi tugma orqali to'lov qiling va to'lovingizni tasdiqlang!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💵 To'lov qilish (Ilova/Brauzer)",'url'=>"$url"]],
[['text'=>"💵 To'lov qilish (Telegram)",'web_app'=>['url'=>"$url"]]],
[['text'=>"✅ To'lovni tekshirish",'callback_data'=>"checkout=$check_id=$amount"]]
]
])
]);
unlink("step/$cid.step");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"💵 <b>To'lov miqdorini kiriting:</b>

<i>Minimal miqdor:</i> 1000 UZS",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"💵 <b>To'lov miqdorini kiriting:</b>

<i>Minimal miqdor:</i> 1000 UZS",
'parse_mode'=>'html',
]);
exit();
}
}

if(mb_stripos($data,"checkout=")!==false){
$check_id = explode("=", $data)[1];
$amount = explode("=", $data)[2];
if(mb_stripos($check, $check_id) !== false){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚠ Ushbu toʻlov amalga oshirilgan!",
'show_alert'=>true
]);
exit();
}else{
$json = json_decode(file_get_contents("https://".$_SERVER['SERVER_NAME']."/RiseBuilder/payme.php?parol=RiseBuilder&id=$check_id&action=info"), true);
$pay_time = $json['mess'];
if(empty($pay_time)){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"⚠ Ushbu to'lov amalga oshirilmagan!",
'show_alert'=>true,
]);
exit();
}else{
file_put_contents("tizim/check.txt", "\n".$check_id,FILE_APPEND);
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$pul2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul2'];
$a = $pul + $amount;
$b = $pul2 + $amount;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $cid2");
mysqli_query($connect,"UPDATE kabinet SET pul2 = $b WHERE user_id = $cid2");
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"✅ <b>Hisobingizga $amount $valyuta qabul qilindi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menu,
]);
bot('sendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"✅ <b><a href='https://t.me/$calluser'>Foydalanuvchi</a> PAYME to'lov tizimi orqali to'lov qildi va hisobiga $amount $valyuta qo'shildi!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
exit();
}
}
}

if($data == "oplata"){
	if($turi == null){
			bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"To'lov tizimlari topilmadi!",
	'show_alert'=>true,
	]);
}else{
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
                'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>$payment
]);
}
}

if($data == "orqa"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>"html",
        'reply_markup'=>$payment
]);
}

if(mb_stripos($data, "pay-")!==false){
	$ex = explode("-",$data);
	$tur = $ex[1];
	$addition = file_get_contents("tizim/$tur/addition.txt");
   $wallet = file_get_contents("tizim/$tur/wallet.txt");
   $fid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM uid WHERE user_id = $cid2"))['uid'];
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>📋 To'lov tizimi:</b> $tur

<i>💳 Hamyon ( yoki karta ):</i> <code>$wallet</code>
<i>📝 Izoh:</i> <code>user$fid</code>

<b>Qo'shimcha:</b> $addition",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"money-$turi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if(mb_stripos($data, "money-")!==false){
$ex = explode("-",$data);
$turi = $ex[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"💵 <b>To'lov miqdorini kiriting:</b>",
	'parse_mode'=>'html',
'reply_markup'=>$back,
	]);	file_put_contents("step/$cid2.step","oplata-$turi");
exit();
}

if(mb_stripos($step, "oplata-")!==false){
$ex = explode("-",$step);
$turi = $ex[1];
if(is_numeric($text)=="true"){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"🧾 <b>To'lovingizni chek yoki skreenshotini shu yerga yuboring:</b>",
	'parse_mode'=>'html',
	]);
file_put_contents("step/$cid.step","rasm-$text-$turi");
exit();
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"💵 <b>To'lov miqdorini kiriting:</b>",
	'parse_mode'=>'html',
]);
exit();
}
}

if(mb_stripos($step, "rasm-")!==false){
	$ex = explode("-",$step);
	$miqdor = $ex[1];
        $turi = $ex[2];
bot('forwardMessage',[
'chat_id'=>$AlijonovUz,
'from_chat_id'=>$cid,
'message_id'=>$mid,
]);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<b>Foydalanuvchi hisobini to'ldirmoqchi!

To'lov tizimi:</b> $turi
<b>Foydalanuvchi:</b> <a href='tg://user?id=$cid'>$cid</a>
<b>To'lov miqdori:</b> $miqdor $valyuta",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"on-$cid-$miqdor"],['text'=>"❌",'callback_data'=>"off-$cid-$miqdor"]],
]
])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"❇️ <b>Hisobni to'ldirganingiz haqida ma'lumot asosiy adminga yuborildi. <u>Agar to'lovni amalga oshirganingiz haqida ma'lumot mavjud bo'lsa,</u> hisobingiz to'ldiriladi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu
]);
unlink("step/$cid.step");
exit();
}

if(mb_stripos($data, "on-")!==false){
	$ex = explode("-",$data);
	$id = $ex[1];
   $miqdor = $ex[2];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $id"))['pul'];
$pul2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $id"))['pul2'];
$a = $pul + $miqdor;
$b = $pul2 + $miqdor;
if($cash == "Yoqilgan"){
$refid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM user_id WHERE user_id = $id"))['refid'];
$pul3 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $refid"))['pul'];
$c = $cashback / 100 * $miqdor;
$jami = $pul3 + $c;
mysqli_query($connect,"UPDATE kabinet SET pul = $jami WHERE user_id = $refid");
}
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $id");
mysqli_query($connect,"UPDATE kabinet SET pul2 = $b WHERE user_id = $id");
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$id,
	'text'=>"💵 <b>Hisobingiz $miqdor $valyuta ga to'ldirildi!</b>",
	'parse_mode'=>'html',
	]);
	bot('SendMessage',[
	'chat_id'=>$refid,
	'text'=>"💵 <b>Do'stingiz hisobini to'ldirganligi uchun sizga $cashback% cashback berildi!</b>",
	'parse_mode'=>'html',
	]);
		bot('SendMessage',[
	'chat_id'=>$AlijonovUz,
	'text'=>"💵 <b>Foydalanuvchi (</b>$id<b>) hisobi $miqdor $valyuta ga to'ldirildi.</b>",
	'parse_mode'=>'html',
	]);      
	exit();
}

if(mb_stripos($data, "off-")!==false){
	$ex = explode("-",$data);
	$id = $ex[1];
        $miqdor = $ex[2];
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>⚠️ Bekor qilindi.</b>

<i>Foydalanuvchi:</i> $id
<i>Miqdor:</i> $miqdor $valyuta",
	'parse_mode'=>'html',
	]);		
}

if($text == "🏆 Referal konkurs" and joinchat($cid)==true){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>$kmatn,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🏆 TOP - $ktop",'callback_data'=>"top"]],
]])
]);
exit();
}

if($data=="konkurs" and joinchat($cid2)=="true" ){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>$kmatn,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🏆 TOP - $ktop",'callback_data'=>"top"]],
]])
]);
exit();
}

if($data =="top"){
$res = mysqli_query($connect,"SELECT * FROM kabinet ORDER BY odam DESC LIMIT $ktop");
while($roww = mysqli_fetch_assoc($res)){
$id = $roww['user_id'];
$name = getName($id);
$name = str_replace(["𒐫","<",">"],[null, null, null],$name);
$member = $roww['odam'];
$stat = mysqli_num_rows($res);
$top .= "<b><a href='tg://user?id=$id'>$name</a></b>  -  <pre>$member</pre> odam\n";
}
$ids = explode("\n","\n$top");
$soi = substr_count($top,"\n");
$soni = $soi;
foreach($ids as  $id){
$keyboards = [];
$text = "";
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$ids[$i]);
$text .= "<b>$i)</b> ".$ids[$i]."\n";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🏆 TOP-$ktop referal reytingi:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
 'inline_keyboard'=>[
[['text'=>"▶️ Orqaga",'callback_data'=>"konkurs"]]
]
])
]);
exit();
}
}


if($text == "🎮 Oʻyinlar" and joinchat($cid)==true){
	$res = mysqli_query($connect, "SELECT * FROM `game_dice`");
$us = mysqli_num_rows($res);
$text = "<b>👇🏻 Quyidagi oʻyinlardan birini tanlang!

<i>Yodingizda saqlang, oʻyinda yutqazgan pullaringizni qaytarib ololmaysiz!</i></b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🎲 Kosti $us ta", 'callback_data'=>"game_dice"]]
]
]);
send($cid,$text,$key);
exit;
}

if($data == "back_games"){
delete($cid2,$mid2);
$res = mysqli_query($connect, "SELECT * FROM `game_dice`");
$us = mysqli_num_rows($res);
$text = "<b>👇🏻 Quyidagi oʻyinlardan birini tanlang!

<i>Yodingizda saqlang, oʻyinda yutqazgan pullaringizni qaytarib ololmaysiz!</i></b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🎲 Kosti $us ta", 'callback_data'=>"game_dice"]]
]
]);
send($cid2,$text,$key);
exit;
}

if($data == "game_dice"){
delete($cid2,$mid2);
$text = "<b>👇🏻 Quyidagi tugmalardan birini tanlang!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid2,$text,$key);
exit;
}

if($data == "search_dice"){
delete($cid2,$mid2);
$result = mysqli_query($connect, "SELECT * FROM `game_dice`");
while($row = mysqli_fetch_assoc($result)){
$game_id = $row['dice_id'];
$owner = $row['owner'];
$member = $row['member'];
}
if((mb_stripos($owner,$cid2)!==false) or (mb_stripos($member,$cid2)!==false)){
$text = "<b>❌ Sizda tugallanmagan oʻyin mavjud. Iltimos oʻyin tugallanishini kuting!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid2,$text,$key);
exit;
}else{
$result = mysqli_query($connect,"SELECT * FROM `game_dice` WHERE `status` = 'active' ORDER BY RAND() LIMIT 1");
$row = mysqli_fetch_assoc($result);
if($row){
$dice_id = $row['dice_id'];
$amount = $row['rate'];
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
if($money >= $amount and $amount <= $money){
$text = "<b>✅ Faol oʻyin topildi!

🆔 Oʻyin ID raqami: #$dice_id
💰 Miqdor: $amount $valyuta
💸 Hisobingizda mavjud: $money $valyuta

🎮 Oʻyinni boshlashni xohlaysizmi?</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Ha",'callback_data'=>"startgame=$dice_id"]],
[['text'=>"🔎 Boshqa oʻyin izlash", 'callback_data'=>"search_dice"]]
]
]);
send($cid2,$text,$key);
exit;
}else{
$text = "<b>🎮 Oʻyin topildi, lekin oʻyinni boshlash uchun hisobingizda mablagʻ yetarli emas. Oʻyindagi miqdor $amount $valyuta sizning hisobingiz esa $money $valyuta. Hisobingizni toʻldirib qayta urunib koʻring!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Boshqa oʻyin izlash", 'callback_data'=>"search_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid2,$text,$key);
exit;
}
}else{
$text = "<b>🎮 Faol oʻyinlar topilmadi. Qayta urunib koʻring yoki oʻzingiz oʻyin yarating!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid2,$text,$key);
exit;
}
}
}

if($data == "create_dice"){
delete($cid2,$mid2);
$result = mysqli_query($connect, "SELECT * FROM `game_dice`");
while($row = mysqli_fetch_assoc($result)){
$game_id = $row['dice_id'];
$owner = $row['owner'];
$member = $row['member'];
}
if((mb_stripos($owner,$cid2)!==false) or (mb_stripos($member,$cid2)!==false)){
$text = "<b>❌ Sizda tugallanmagan oʻyin mavjud. Iltimos oʻyin tugallanishini kuting!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid2,$text,$key);
exit;
}else{
file_put_contents("step/$cid2.step",'stavka');
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$text = "<b>🎲 Oʻyin ikki oʻyinchi uchun moʻljallangan.

👥 Oʻyinchilar navbat bilan tosh tashlashadi. Eng katta qiymatga ega toshni tashlagan foydalanuvchi oʻyin gʻolibi hisoblanadi. Gʻolib tikilgan summani ikki barobari miqdorini oladi. Oʻyin durrang boʻlgan taqdirda oʻyinchilarga qaytadan tosh tashlash imkoniyati beriladi va bu gʻolib aniqlanmagunicha takrorlanaveradi.

❇️ Minimal pul tikish miqdori: 5 $valyuta
🎫 Sizning balansingiz: $money $valyuta

👌🏻 Oʻyinni boshlash uchun stavka miqdorini kiriting!</b>";
send($cid2,$text,$back);
exit;
}
}

if($step == "stavka" and $text!= "/start" and $text!= "◀️ Ortga"){
if(is_numeric($text)){
$result = mysqli_query($connect, "SELECT * FROM `game_dice`");
while($row = mysqli_fetch_assoc($result)){
$game_id = $row['dice_id'];
$owner = $row['owner'];
$member = $row['member'];
}
if((mb_stripos($owner,$cid)!==false) or (mb_stripos($member,$cid)!==false)){
$text = "<b>❌ Sizda tugallanmagan oʻyin mavjud. Iltimos oʻyin tugallanishini kuting!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid,$text,$key);
exit;
}else{
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$min = "5";
if($text >= $min and $min <= $text){
if($money >= $text and $text <= $money){
$rate = $text;
unlink("step/$cid.step");
$text = "<b>🎲 Oʻyin ikki oʻyinchi uchun moʻljallangan.

👥 Oʻyinchilar navbat bilan tosh tashlashadi. Eng katta qiymatga ega toshni tashlagan foydalanuvchi oʻyin gʻolibi hisoblanadi. Gʻolib tikilgan summani ikki barobari miqdorini oladi. Oʻyin durrang boʻlgan taqdirda oʻyinchilarga qaytadan tosh tashlash imkoniyati beriladi va bu gʻolib aniqlanmagunicha takrorlanaveradi.

❇️ Minimal pul tikish miqdori: 5 $valyuta
🎫 Sizning balansingiz: $money $valyuta
♻ Sizning stavkangiz: $text $valyuta

👌🏻 Oʻyinni boshlash uchun «✅ Oʻyinni boshlash» tugmasini bosing!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Oʻyinni boshlash",'callback_data'=>"start_dice=$rate"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid,$text,$key);
exit;
}else{
$text = "<b>🎮 Oʻyinni boshlash uchun hisobingizda yetarli mablagʻ mavjud emas!

💸 Boshqa miqdor kiriting.</b>";
send($cid,$text,$back);
exit;
}
}else{
$text = "<b>⚠️ Pul miqdori notoʻgʻri kiritilmoqda!

⬇️ Minimal pul miqdori: 5 $valyuta

🔢 Boshqa miqdor kiriting.</b>";
send($cid,$text,$back);
exit;
}
}
}else{
$text = "<b>⚠️ Pul miqdori faqat raqamdan tashkil topgan boʻlishi kerak!</b>";
send($cid,$text,$back);
exit;
}
}

if(mb_stripos($data, "start_dice")!==false){
delete($cid2,$mid2);
$explode = explode("start_dice=",$data);
$rate = explode("=",$data)[1];
$result = mysqli_query($connect, "SELECT * FROM `game_dice`");
while($row = mysqli_fetch_assoc($result)){
$game_id = $row['dice_id'];
$owner = $row['owner'];
$member = $row['member'];
}
if((mb_stripos($owner,$cid2)!==false) or (mb_stripos($member,$cid2)!==false)){
$text = "<b>❌ Sizda tugallanmagan oʻyin mavjud. Iltimos oʻyin tugallanishini kuting!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($cid2,$text,$key);
exit;
}else{
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
if($money >= $rate and $rate <= $money){
$explode = explode("start_dice=",$data);
$rate = explode("=",$data)[1];
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$money -= $rate;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$money' WHERE `user_id` = '$cid2'");
mysqli_query($connect, "INSERT INTO `game_dice` (`owner`,`member`,`rate`,`score1`,`score2`,`status`) VALUES ('$cid2','null','$rate','null','null','active')");
$text = "<b>🎲 Oʻyinchi oʻyiningizga ulanishi kutilmoqda...

👤 Oʻyinchi qidirilayotganda siz bot funksiyalaridan foydalanishda davom etishingiz mumkin, oʻyinchi ulanishi bilanoq biz sizga bu haqida xabar beramiz.</b>";
send($cid2,$text,$menu);
exit;
}else{
$text = "🎮 Oʻyinni boshlash uchun hisobingizda yetarli mablagʻ mavjud emas!

💸 Hisobingizni toʻldirib qayta urunib koʻring.";
answer($qid,$text);
exit;
}
}
}

if(mb_stripos($data, "startgame")!==false){
delete($cid2,$mid2);
$explode = explode("startgame=",$data);
$game_id = explode("=",$data)[1];
$result = mysqli_query($connect, "SELECT * FROM `game_dice` WHERE `dice_id` = '$game_id'");
$row = mysqli_fetch_assoc($result);
$game_id = $row['dice_id'];
$owner = $row['owner'];
$rate = $row['rate'];
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
if($money >= $rate and $rate <= $money){
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$cid2'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$money -= $rate;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$money' WHERE `user_id` = '$cid2'");
mysqli_query($connect, "UPDATE `game_dice` SET `member` = '$cid2' WHERE `dice_id` = '$game_id'");
mysqli_query($connect, "UPDATE `game_dice` SET `status` = 'exist' WHERE `dice_id` = '$game_id'");
$text = "<b>👏🏻 Oʻyin boshlandi!

🆔 Oʻyin ID raqami: #$game_id
👤 <i>#$owner</i> oʻyinchisi siz bilan oʻynamoqda
💸 Pul miqdori: $rate $valyuta

😉 U avval toshni tashlaydi, navbatingizni kuting!</b>";
send($cid2,$text,$home);
$text = "<b>👏🏻 Oʻyin boshlandi!

🆔 Oʻyin ID raqami: #$game_id
?? <i>#$cid2</i> oʻyinchisi siz bilan oʻynamoqda
💸 Pul miqdori: $rate $valyuta</b>";
send($owner,$text,$home);
$text = "<b>👇🏻 Siz birinchi boʻlib toshni tashlaysiz!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🎲 Toshni tashlash", 'callback_data'=>"brosat=$game_id"]],
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]]
]
]);
send($owner,$text,$key);
exit;
}else{
$text = "🎮 Oʻyinni boshlash uchun hisobingizda yetarli mablagʻ mavjud emas!

💸 Hisobingizni toʻldirib qayta urunib koʻring.";
answer($qid,$text);
exit;
}
}

if(mb_stripos($data, "brosat")!==false){
delete($cid2,$mid2);
$explode = explode("brosat=",$data);
$game_id = explode("=",$data)[1];
$result = mysqli_query($connect, "SELECT * FROM `game_dice` WHERE `dice_id` = '$game_id'");
$row = mysqli_fetch_assoc($result);
$owner = $row['owner'];
$member = $row['member'];
$dice = bot('sendDice',[
'chat_id'=>$owner,
'emoji'=>"🎲"
]);
$score = $dice->result->dice->value;
mysqli_query($connect, "UPDATE `game_dice` SET `score1` = '$score' WHERE `dice_id` = '$game_id'");
$text = "<b>🎲 Siz toshni tashladingiz, endi navbat sizning raqibingizda!</b>";
send($owner,$text,$home);
$text = "<b>🎲 Endi navbat sizda. Omad! 👌🏻</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🎲 Toshni tashlash", 'callback_data'=>"brosad=$game_id"]],
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]]
]
]);
send($member,$text,$key);
exit;
}


if(mb_stripos($data, "brosad")!==false){
delete($cid2,$mid2);
$explode = explode("brosad=",$data);
$game_id = explode("=",$data)[1];
$result = mysqli_query($connect, "SELECT * FROM `game_dice` WHERE `dice_id` = '$game_id'");
$row = mysqli_fetch_assoc($result);
$owner = $row['owner'];
$member = $row['member'];
$rate = $row['rate'];
$score1 = $row['score1'];
$dice = bot('sendDice',[
'chat_id'=>$member,
'emoji'=>"🎲"
]);
$score = $dice->result->dice->value;
mysqli_query($connect, "UPDATE `game_dice` SET `score2` = '$score' WHERE `dice_id` = '$game_id'");
$text = "<b>🎲 Siz toshni tashladingiz!</b>";
send($member,$text,$home);
if($score == $score1 or $score1 == $score){
$text = "<b>⏸ Natijalar teng! U avval toshni tashlaydi, navbatingizni kuting!</b>";
send($member,$text,$home);
$text = "<b>⏸ Natijalar teng! Siz birinchi boʻlib toshni tashlaysiz!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🎲 Toshni tashlash", 'callback_data'=>"brosat=$game_id"]],
[['text'=>"🚫 Oʻyinni bekor qilish",'callback_data'=>"game_cancel=$game_id"]]
]
]);
send($owner,$text,$key);
exit;
}else{
if($score >= $score1 or $score1 <= $score){
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$member'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$amount = $rate + $rate;
$money += $amount;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$money' WHERE `user_id` = '$member'");
$text = "<b>😊 Siz gʻalaba qozondingiz!

😍 Yutugʻingiz: $rate $valyuta

🆔 Oʻyin ID raqami: #$game_id
💸 Pul miqdori: $rate $valyuta
✅ Yutgan ishtirokchi: <i>#$member</i> - 🎲 $score ball toʻpladi
⭕ Yutkazgan ishtirokchi: <i>#$owner</i> - 🎲 $score1 ball toʻpladi

💰 Balansingiz: $money $valyuta</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($member,$text,$key);
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$owner'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$text = "<b>😢 Siz yutkazdingiz!

🆔 Oʻyin ID raqami: #$game_id
💸 Pul miqdori: $rate $valyuta
✅ Yutgan ishtirokchi: <i>#$member</i> - 🎲 $score ball toʻpladi
⭕ Yutkazgan ishtirokchi: <i>#$owner</i> - 🎲 $score1 ball toʻpladi

💰 Balansingiz: $money $valyuta</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($owner,$text,$key);
mysqli_query($connect, "DELETE FROM `game_dice` WHERE `dice_id` = '$game_id'");
}else{
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$owner'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$amount = $rate + $rate;
$money += $amount;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$money' WHERE `user_id` = '$owner'");
$text = "<b>?? Siz gʻalaba qozondingiz!

😍 Yutugʻingiz: $rate $valyuta

🆔 Oʻyin ID raqami: #$game_id
💸 Pul miqdori: $rate $valyuta
✅ Yutgan ishtirokchi: <i>#$owner</i> - 🎲 $score1 ball toʻpladi
⭕ Yutkazgan ishtirokchi: <i>#$member</i> - 🎲 $score ball toʻpladi

💰 Balansingiz: $money $valyuta</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($owner,$text,$key);
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$member'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$text = "<b>😢 Siz yutkazdingiz!

🆔 Oʻyin ID raqami: #$game_id
💸 Pul miqdori: $rate $valyuta
✅ Yutgan ishtirokchi: <i>#$owner</i> - 🎲 $score1 ball toʻpladi
⭕ Yutkazgan ishtirokchi: <i>#$member</i> - 🎲 $score ball toʻpladi

💰 Balansingiz: $money $valyuta</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($member,$text,$key);
mysqli_query($connect, "DELETE FROM `game_dice` WHERE `dice_id` = '$game_id'");
}
}
}

if(mb_stripos($data, "game_cancel")!==false){
delete($cid2,$mid2);
$explode = explode("game_cancel=",$data);
$game_id = explode("=",$data)[1];
$result = mysqli_query($connect, "SELECT * FROM `game_dice` WHERE `dice_id` = '$game_id'");
$row = mysqli_fetch_assoc($result);
$owner = $row['owner'];
$member = $row['member'];
$rate = $row['rate'];
if($owner != "null"){
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$owner'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$money += $rate;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$money' WHERE `user_id` = '$owner'");
$text = "<b>🎮 Ushbu oʻyin bekor qilindi!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($owner,$text,$key);
}
if($member != "null"){
$result = mysqli_query($connect,"SELECT * FROM `kabinet` WHERE `user_id` = '$member'");
$row = mysqli_fetch_assoc($result);
$money = $row['pul'];
$money += $rate;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$money' WHERE `user_id` = '$member'");
$text = "<b>🎮 Ushbu oʻyin bekor qilindi!</b>";
$key = json_encode([
'inline_keyboard'=>[
[['text'=>"🔎 Izlash", 'callback_data'=>"search_dice"]],
[['text'=>"➕ Yangi oʻyin yaratish", 'callback_data'=>"create_dice"]],
[['text'=>"◀️ Ortga", 'callback_data'=>"back_games"]]
]
]);
send($member,$text,$key);
}
mysqli_query($connect, "DELETE FROM `game_dice` WHERE `dice_id` = '$game_id'");
exit;
}

if($text == "💵 Pul ishlash" and joinchat($cid)==true){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔗 Takliflar",'callback_data'=>"taklif"],['text'=>"🎮 Oʻyinlar",'callback_data'=>"back_games"]],
	[['text'=>"✉️ Guruhlar",'callback_data'=>"guruhlar"],['text'=>"🔘 Tugma",'callback_data'=>"clicker"]],
]
])
]);
exit();
}

if($data == "ishlash"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔗 Takliflar",'callback_data'=>"taklif"],['text'=>"🎮 Oʻyinlar",'callback_data'=>"back_games"]],
	[['text'=>"✉️ Guruhlar",'callback_data'=>"guruhlar"],['text'=>"🔘 Tugma",'callback_data'=>"clicker"]],
]
])
]);
exit();
}

if($data == "taklif"){
	$fid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM uid WHERE user_id = $cid2"))['uid'];
	$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['odam'];
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"⚡️ <b>Sizning taklif havolalaringiz:</b>

<pre>https://t.me/$bot?start=RISE$fid</pre>
<pre>tg://resolve?domain=$bot&start=RISE$fid</pre>

<b>1 ta taklif uchun $taklif $valyuta beriladi.

Sizning takliflaringiz: $odam ta</b>",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"↗️ Ulashish",'url'=>"https://t.me/share/url?url=https://t.me/$bot?start=RISE$fid"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"ishlash"]]
]
])
]);
}

if($data == "guruhlar"){
	if($guruh1 != null){
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>👇 Quyidagilar guruhlarga odam qo'shib pul ishlashingiz mumkin.</b>


<b>Har bir yangi foydalanuvchi uchun: $gpul $valyuta</b>",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"1️⃣ - GURUH",'url'=>"https://t.me/".str_replace('@','',$guruh1).""]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"ishlash"]]
]
])
]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"guruh aktiv holatda emas!",
	'show_alert'=>true,
	]);
	}
	}

if($data == "clicker"){
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>👇 Quyidagilardan birini tanlang:

<u>💎 Tugma bosib pul ishlashingiz mumkin!</u></b>",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"👑 CLiCKER — (x1 - 1 $valyuta)",'callback_data'=>"clickbos"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"ishlash"]]
]
])
]);
}

if($data == "clickbos"){
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
if($status == "Premium"){
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
'text'=>"<b>➕ Xisobingizga 1 $valyuta qo‘shildi!</b>",
'show_alert'=>false,
]);
$a = $pul + 1;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $cid2");
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"😊 «CLICKER» tugmasidan foydalanish uchun Premium ta’rifga obuna bo‘ling!",
'show_alert'=>true,
]);
}
}

if($text== "🛒 Bot do'koni" and joinchat($cid)==true){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⬇️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎫 CreateCard sotib olish",'callback_data'=>"Limit_olish"]],
[['text'=>"🎫 FeeCard sotib olish",'callback_data'=>"Fee"]],
]])
]);
exit();
}

if($data=="ccmarket" and joinchat($ciid2)==true){
bot("editMessageText",[
"chat_id"=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>⬇️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎫 CreateCard sotib olish",'callback_data'=>"Limit_olish"]],
[['text'=>"🎫 FeeCard sotib olish",'callback_data'=>"Fee"]],
]])
]);
exit();
}

if($data=="Limit_olish" and joinchat($cid2)=="true"){
$limit1 = file_get_contents("tizim/cc.txt");
$limit2 = $limit1 * 2;
$limit3 = $limit1 * 3;
$limit4 = $limit1 * 4;
$limit5 = $limit1 * 20;
bot("editMessageText",[
"chat_id"=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>✅ CreateCard sotib olish uchun narxlar bilan tanishing!</b>

<b>🪫 [1] dona CreateCard</b> - $limit1 $valyuta
<b>🪫 [2] dona CreateCard</b> - $limit2 $valyuta
<b>🪫 [3] dona CreateCard</b> - $limit3 $valyuta
<b>🪫 [4] dona CreateCard</b> - $limit4 $valyuta
<b>🔋 [20] dona CreateCard</b> - $limit5 $valyuta

<b>⬇️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🪫 1",'callback_data'=>"limit=1=$limit1"],['text'=>"🪫 2",'callback_data'=>"limit=2=$limit2"],['text'=>"🪫 3",callback_data=>"limit=3=$limit3"]],
[['text'=>"🪫 4",'callback_data'=>"limit=4=$limit4"],['text'=>"🔋 20",'callback_data'=>"limit=20=$limit5"]],
[['text'=>"◀️ Ortga",'callback_data'=>"ccmarket"]],
]])
]);
exit();
}

if($data=="Fee" and joinchat($cid2)=="true"){
$limit1 = file_get_contents("tizim/fc.txt");;
$limit2 = $limit1 * 2;
$limit3 = $limit1 * 3;
$limit4 = $limit1 * 4;
$limit5 = $limit1 * 20;
bot("editMessageText",[
"chat_id"=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>✅ FeeCard sotib olish uchun narxlar bilan tanishing!</b>

<b>🪫 [1] dona FeeCard</b> - $limit1 $valyuta
<b>🪫 [2] dona FeeCard</b> - $limit2 $valyuta
<b>🪫 [3] dona FeeCard</b> - $limit3 $valyuta
<b>🪫 [4] dona FeeCard</b> - $limit4 $valyuta
<b>🔋 [20] dona FeeCard</b> - $limit5 $valyuta

<b>⬇️ Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🪫 1",'callback_data'=>"Fee=1=$limit1"],['text'=>"🪫 2",'callback_data'=>"Fee=2=$limit2"],['text'=>"🪫 3",callback_data=>"Fee=3=$limit3"]],
[['text'=>"🪫 4",'callback_data'=>"Fee=4=$limit4"],['text'=>"🔋 20",'callback_data'=>"Fee=20=$limit5"]],
[['text'=>"◀️ Ortga",'callback_data'=>"ccmarket"]],
]])
]);
exit();
}

if(mb_stripos($data,"limit=")!==false){
$raqami=explode("=",$data)[1];
$narxi=explode("=",$data)[2];
$limit = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['cc'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
if($pul < $narxi){
bot("answerCallbackQuery",[
"callback_query_id"=>$qid,
"text"=>"Hisobingizda yetarli mablag' mavjud emas.",
"show_alert"=>true,
]);
}else{
$limiti = $limit + $raqami;
mysqli_query($connect, "UPDATE `card` SET `cc` = '$limiti' WHERE `user_id` = '$cid2'");
$puli = $pul - $narxi;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$puli' WHERE `user_id` = '$cid2'");
bot("editMessageText",[
"chat_id"=>$cid2,
'message_id'=>$mid2,
'text'=>"<i>✅ Siz <b>$raqami-raqamli</b> CreateCard xarid qildingiz!</i>

<b>Sizning limitingiz [$raqami]ta koʻpaydi.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Ortga",'callback_data'=>"Limit_olish"]],
]])
]);
}}

if(mb_stripos($data,"Fee=")!==false){
$raqami=explode("=",$data)[1];
$narxi=explode("=",$data)[2];
$limit = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['fc'];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
if($pul < $narxi){
bot("answerCallbackQuery",[
"callback_query_id"=>$qid,
"text"=>"Hisobingizda yetarli mablag' mavjud emas.",
"show_alert"=>true,
]);
}else{
$limiti = $limit + $raqami;
mysqli_query($connect, "UPDATE `card` SET `fc` = '$limiti' WHERE `user_id` = '$cid2'");
$puli = $pul - $narxi;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$puli' WHERE `user_id` = '$cid2'");
bot("editMessageText",[
"chat_id"=>$cid2,
'message_id'=>$mid2,
'text'=>"<i>✅ Siz <b>$raqami-raqamli</b> FeeCard xarid qildingiz!</i>

<b>Sizning FeeCard [$raqami]ta koʻpaydi.</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Ortga",'callback_data'=>"Fee"]],
]])
]);
}}

if($text == "🛠 Botlarni boshqarish" and joinchat($cid)==true){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"🤖 <b>Botlarni boshqarish bo'limiga xush kelibsiz!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$boshqar,
]);
exit();
}

if($soat == "00:00"){
$res = mysqli_query($connect, "SELECT * FROM `kunlik`");
while($a = mysqli_fetch_assoc($res)){
$useri= $a['useri'];
$id = $a['user_id'];
$kun = $a['kun'];
if($kun != "0"){
$day = $kun - 1;
mysqli_query($connect, "UPDATE kunlik SET kun = '$day' WHERE useri = '$useri'");
}
}
}

if($soat == "01:00"){
$res = mysqli_query($connect, "SELECT * FROM `status`");
while($a = mysqli_fetch_assoc($res)){
$id = $a['user_id'];
$kun = $a['kun'];
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $id"))['status'];
if($status == "Premium"){
$day = $kun - 1;
mysqli_query($connect, "UPDATE status SET kun='$day' WHERE user_id = $id");
}
}
}

if($soat == "01:00"){
$res = mysqli_query($connect, "SELECT * FROM `status`");
while($a = mysqli_fetch_assoc($res)){
$id = $a['user_id'];
$status = $a['status'];
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $id"))['kun'];
if($status == "Premium"){
if($kun == "0"){
mysqli_query($connect,"UPDATE status SET kun = '0' WHERE user_id = $id");
mysqli_query($connect,"UPDATE status SET status = 'Oddiy' WHERE user_id = $id");
}
}
}
}

if(isset($message)){
	if(mb_stripos($kun, "-")!==false){
		mysqli_query($connect, "UPDATE kunlik SET kun = '0' WHERE useri = $useri ");
}
}

if($soat == $auto){
$res = mysqli_query($connect, "SELECT * FROM `kunlik`");
while($a = mysqli_fetch_assoc($res)){
$useri = $a['useri'];
$turi = $a['turi'];
$tokeni = $a['tokeni'];
$avto = $a['avto'];
if($auto2 == $turi and $avto == "✅"){
$kod = file_get_contents("bot/$auto2.php");
$kod = str_replace("API_TOKEN", "$tokeni", $kod);
$kod = str_replace("ADMIN_ID", "$id", $kod);
file_put_contents("bots/$useri/index.php","$kod");	
unlink("step/auto.txt");
unlink("step/auto2.txt");
}
}
}

if($soat == "00:00"){
deleteFolder("step");
deleteFolder("lik");
}

if($data == "boshqarish"){	
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🤖 Botlarni boshqarish bo'limiga xush kelibsiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqar,
]);
exit();
}


if($text == "⚙ Botlarni sozlash" and joinchat($cid)==true){
$bot = file_get_contents("baza/$cid/bots.txt");
if($bot != null){
$more = explode("\n",$bot);
$soni = substr_count($bot,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"⚙ $for. $title","callback_data"=>"settings=$title"];
$key2 = array_chunk($key, 1);
$key2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]];
$sozlash = json_encode([
'inline_keyboard'=>$key2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$sozlash,
]);
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📂 <b>Sizda hech qanday bot yo'q!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot qo'shish",'callback_data'=>"apilar"]],
]
])
]);
exit();
}
}

if($data == "botlar"){
$bot = file_get_contents("baza/$cid2/bots.txt");
if($bot != null){
$more = explode("\n",$bot);
$soni = substr_count($bot,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"⚙ $for. $title","callback_data"=>"settings=$title"];
$key2 = array_chunk($key, 1);
$key2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]];
$sozlash = json_encode([
'inline_keyboard'=>$key2,
]);
}
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
    'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
    'parse_mode'=>'html',
    'reply_markup'=>$sozlash,
]);
exit();
}else{
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
	bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"📂 <b>Sizda hech qanday bot yo'q!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot qo'shish",'callback_data'=>"apilar"]],
]
])
]);
exit();
}
}

if(mb_stripos($data,"settings=") !== false){
    $ex = explode("=",$data);
    $ismi = $ex[1];
$turi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['turi'];
$tokeni = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['tokeni'];
$token = token("$tokeni", 15,32);
$vaqti = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['vaqti'];
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['kun'];
$times = "$sana — $soat";
$b_time = explode(" — ",$times)[1];
$s_time = explode(":",$b_time)[0]*60;
$m_time = explode(":",$b_time)[1];
$minutes = $s_time + $m_time;
$minus = 24*60;
$qoldi = ($minus - $minutes)*60;
$hours = str_pad(floor($qoldi / (60*60)), 2, '0', STR_PAD_LEFT);
$minutes = str_pad(floor(($qoldi - $hours*60*60)/60), 2, '0', STR_PAD_LEFT);
if(($kun == "0") or (mb_stripos($kun, "-") !== false)){
	$tolov = "Muddati tugagan!";
}else{
	$tolov = "$kun kun, $hours soat, $minutes daqiqa.";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"✅ <b>@$ismi tanlandi!

🔑 Bot tokeni:</b> <code>$token</code>
🗓 <b>Bot ochilgan vaqt:</b> $vaqti
📂<b> Bot turi:</b> <i>$turi</i>

⏳ <b>To'lov holati:</b> <i>$tolov</i>
  
🔽 <i>Quyidagi tugmalar yordamida botingizni sozlashingiz mumkin:</i>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"⚙ Qo'shimcha sozlamalar",'callback_data'=>"sozlamalar=$ismi"]],
[['text'=>"⬆️ Yangilash",'callback_data'=>"yangilash=$ismi"],['text'=>"🔁 Botni o'tkazish | 👑",'callback_data'=>"trans=$ismi"]],
[['text'=>"🗑 O'chirish",'callback_data'=>"ochirish=$ismi"],['text'=>"◀️ Orqaga",'callback_data'=>"botlar"]],
]
])
]);
}

if(mb_stripos($data, "sozlamalar=") !== false){
    $ex = explode("=",$data);
    $ismi = $ex[1];
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"🔑 Tokenni yangilash",'callback_data'=>"token=$ismi"]],
[['text'=>"💡 Avto yangilanish",'callback_data'=>"avto=$ismi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"settings=$ismi"]],
]
])
]);
}


if(mb_stripos($data,"avto=") !== false){
    $ex = explode("=",$data);
    $ismi = $ex[1];
    $avto = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['avto'];
if($avto == "✅"){
$avto2 = "«✅»";
$avtos2 = "❌";
}
if($avto == "❌"){
$avto2 = "✅";
$avtos2 = "«❌»";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"💡 <b>Avto yangilanish holati:</b> $avto",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"$avto2",'callback_data'=>"avton=$ismi"],['text'=>"$avtos2",'callback_data'=>"avtoff=$ismi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"sozlamalar=$ismi"]],
]
])
]);
}

if(mb_stripos($data, "avton=") !== false){
$ex = explode("=",$data);
$ismi = $ex[1];
mysqli_query($connect, "UPDATE kunlik SET avto = '✅' WHERE useri = '$ismi'");
$avto = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['avto'];
if($avto == "✅"){
$avto2 = "«✅»";
$avtos2 = "❌";
}
if($avto == "❌"){
$avto2 = "✅";
$avtos2 = "«❌»";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"💡 <b>Avto yangilanish holati:</b> $avto",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"$avto2",'callback_data'=>"avton=$ismi"],['text'=>"$avtos2",'callback_data'=>"avtoff=$ismi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"sozlamalar=$ismi"]],
]
])
]);
}

if(mb_stripos($data, "avtoff=") !== false){
$ex = explode("=",$data);
$ismi = $ex[1];
mysqli_query($connect, "UPDATE kunlik SET avto = '❌' WHERE nomi = '$ismi'");
$avto = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE nomi = '$ismi'"))['avto'];
if($avto == "✅"){
$avto2 = "«✅»";
$avtos2 = "❌";
}
if($avto == "❌"){
$avto2 = "✅";
$avtos2 = "«❌»";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"💡 <b>Avto yangilanish holati:</b> $avto",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"$avto2",'callback_data'=>"avton=$ismi"],['text'=>"$avtos2",'callback_data'=>"avtoff=$ismi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"sozlamalar=$ismi"]],
]
])
]);
}

if(mb_stripos($data,"yangilash=") !== false){
  $ex = explode("=",$data);
    $ismi = $ex[1];
    $turi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['turi'];
    $tokeni = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['tokeni'];
    
    $get = json_decode(file_get_contents("https://api.telegram.org/bot$tokeni/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/RiseBuilder/bots/$ismi/index.php"))->result;
if($get){
    $kod = file_get_contents("bot/$turi.php");
    $kod = str_replace("API_TOKEN", "$tokeni", $kod);
    $kod = str_replace("ADMIN_ID", "$cid2", $kod);
file_put_contents("bots/$ismi/index.php","$kod");
if($turi=="MakerBot"){
file_put_contents("bots/$ismi/botlar/SarmoyaBot.php",file_get_contents("botlar/SarmoyaBot.php"));
file_put_contents("bots/$ismi/botlar/ObunachiBot.php",file_get_contents("botlar/ObunachiBot.php"));
file_put_contents("bots/$ismi/botlar/SpecialSMM Lite.php",file_get_contents("botlar/SpecialSMM Lite.php"));
file_put_contents("bots/$ismi/botlar/PulBot Lite.php",file_get_contents("botlar/PulBot Lite.php"));
file_put_contents("bots/$ismi/botlar/TurfaBot.php",file_get_contents("botlar/TurfaBot.php"));
file_put_contents("bots/$ismi/botlar/GramAPIBot.php",file_get_contents("botlar/GramAPIBot.php"));
file_put_contents("bots/$ismi/botlar/AvtoNakrutka.php",file_get_contents("botlar/AvtoNakrutka.php"));
file_put_contents("bots/$ismi/botlar/Obunachi Lite.php",file_get_contents("botlar/Obunachi Lite.php"));
file_put_contents("bots/$ismi/botlar/Reklamachi.php",file_get_contents("botlar/Reklamachi.php"));
file_put_contents("bots/$ismi/botlar/SpecialMember.php",file_get_contents("botlar/SpecialMember.php"));
file_put_contents("bots/$ismi/botlar/NamozVAQT.php",file_get_contents("botlar/NamozVAQT.php"));
file_put_contents("bots/$ismi/botlar/AutoNumber.php",file_get_contents("botlar/AutoNumber.php"));
file_put_contents("bots/$ismi/botlar/VideoDown.php",file_get_contents("botlar/VideoDown.php"));
file_put_contents("bots/$ismi/botlar/KonstruktorBot.php",file_get_contents("botlar/KonstruktorBot.php"));
file_put_contents("bots/$ismi/botlar/ConvertorBot.php",file_get_contents("botlar/ConvertorBot.php"));
file_put_contents("bots/$ismi/botlar/ValyutaKursProBot.php",file_get_contents("botlar/ValyutaKursProBot.php"));
file_put_contents("bots/$ismi/botlar/KonspektBot.php",file_get_contents("botlar/KonspektBot.php"));
file_put_contents("bots/$ismi/botlar/NikBot.php",file_get_contents("botlar/NikBot.php"));
#mini
mkdir("bots/$ismi/mini");
file_put_contents("bots/$ismi/mini/SarmoyaBot.php",file_get_contents("mini/SarmoyaBot.php"));
file_put_contents("bots/$ismi/mini/ObunachiBot.php",file_get_contents("mini/ObunachiBot.php"));
file_put_contents("bots/$ismi/mini/SpecialSMM Lite.php",file_get_contents("mini/SpecialSMM Lite.php"));
file_put_contents("bots/$ismi/mini/PulBot Lite.php",file_get_contents("mini/PulBot Lite.php"));
file_put_contents("bots/$ismi/mini/TurfaBot.php",file_get_contents("mini/TurfaBot.php"));
file_put_contents("foydalanuvchi//$ccid/$ex/mini/GramAPIBot.php",file_get_contents("mini/GramAPIBot.php"));
file_put_contents("bots/$ismi/mini/AvtoNakrutka.php",file_get_contents("mini/AvtoNakrutka.php"));
file_put_contents("bots/$ismi/mini/Obunachi Lite.php",file_get_contents("mini/Obunachi Lite.php"));
file_put_contents("bots/$ismi/mini/Reklamachi.php",file_get_contents("mini/Reklamachi.php"));
file_put_contents("bots/$ismi/mini/SpecialMember.php",file_get_contents("mini/SpecialMember.php"));
file_put_contents("bots/$ismi/mini/NamozVAQT.php",file_get_contents("mini/NamozVAQT.php"));
file_put_contents("bots/$ismi/mini/AutoNumber.php",file_get_contents("mini/AutoNumber.php"));
file_put_contents("bots/$ismi/mini/VideoDown.php",file_get_contents("mini/VideoDown.php"));
}
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"<b>✅ Botingiz muvaffaqiyatli yangilandi.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"➡️ Botga o'tish",'url'=>"https://t.me/$ismi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"settings=$ismi"]],
]
])
]);
}else{
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⚠️ <b>Diqqat, Botingiz yangilanish uchun yaroqsiz! Iltimos, botingizning tokenini yangilang!</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"🔑 Tokenni yangilash",'callback_data'=>"token=$ismi"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"settings=$ismi"]],
]
])
]);
}
}

if(mb_stripos($data,"ochirish=") !== false){
    $ex = explode("=",$data);
    $ismi = $ex[1];
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"<b>⚠️ @$ismi ni o'chirib yuborishga ishonchingiz komilmi? </b>

<i> ‼️ Diqqat, Botingizni o'chirganingizdan so'ng bu botga bog'liq bo'lgan barcha ma'lumotlar yo'q qilinadi va buni qayta tiklashning imkoni bo'lmaydi, hamda, bot uchun sarflagan pullaringiz qaytarib berilmaydi!</i>",
    'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Ha, roziman",'callback_data'=>"ha=$ismi"]],
[['text'=>"❌ Yo‘q, o‘chirilmasin",'callback_data'=>"settings=$ismi"]],
]
])
]);
}

if(mb_stripos($data,"ha=") !== false){
    $ex = explode("=",$data);
    $ismi = $ex[1];
    $turi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['turi'];
    $tokeni = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['tokeni'];
    mysqli_query($connect,"DELETE FROM kunlik WHERE useri = '$ismi'"); 
    $bots = file_get_contents("baza/$cid2/bots.txt");
    $a = str_replace("\n".$ismi."","",$bots);
    file_put_contents("baza/$cid2/bots.txt","$a");
   $bots2 = file_get_contents("baza/$cid2/bots2.txt");
  $b = str_replace("\n".$turi."","",$bots2);
  file_put_contents("baza/$cid2/bots2.txt","$b");
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
   'text'=>"🗑 <b>@$ismi ni o'chirish yakunlandi.</b>",
    'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"botlar"]],
]
])
]);
deleteFolder("bots/$ismi");
}

if(mb_stripos($data,"token=") !== false){
    $ex = explode("=",$data);
    $ismi = $ex[1];     
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🔑 Botingizni yangi tokenini yuboring:</b>

<i>Diqqat, yangi token tanlangan botga tegishli bo'lmasa, qabul qilinmaydi!</i>",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid2.step","token=$ismi");
}

if(mb_stripos($step, "token=")!==false){
	$ex = explode("=",$step);
	$ismi = $ex[1];
    $tokeni = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['tokeni'];
   $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
   if(mb_stripos($text, ":")!==false){
	if($ismi == $user){
    $kod = file_get_contents("bots/$ismi/index.php");
    $kod = str_replace("$tokeni", "$tx", $kod);
file_put_contents("bots/$ismi/index.php","$kod");
mysqli_query($connect, "UPDATE kunlik SET tokeni = '$tx' WHERE useri = '$ismi'");
$get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/RiseBuilder/bots/$ismi/index.php"))->result;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>Yangi token qabul qilindi.</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqar,
]);
unlink("step/$cid.step");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Token qabul qilinmadi, qayta urinib ko'ring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Token qabul qilinmadi, qayta urinib ko'ring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if(mb_stripos($data,"trans=") !== false){
$ex = explode("=",$data);
$ismi = $ex[1];
$statuse = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
if($statuse == "Premium"){
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>@$ismi ni kimga o'tkazmoqchisiz?</b>

<i>Kerakli foydalanuvchi ID raqamini yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>$back,
]);
file_put_contents("step/$cid2.step","trans=$ismi");
exit();
}else{
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
    'text'=>"👑 Ushbu bo'lim PREMIUM foydalanuvchilar uchun!",
    'show_alert'=>true,
    ]);
}
	}

if(mb_stripos($step, "trans=")!==false){
$ex = explode("=",$step);
$ismi = $ex[1];
$turi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['turi'];
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}else{
$bots = file_get_contents("baza/$text/bots2.txt");
if(($text == $cid) or (mb_stripos($bots, $turi) !== false)){
if($text == $cid){
$sabab = "Bu ID o'zingizga tegishli!";
}else{
$sabab = "Foydalanuvchida bu turdagi bot mavjud!";
} 
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"⛔ <b>@$ismi ni $text ga o'tkaza olmaysiz.</b>

<i>Sababi: $sabab</i>",
'parse_mode'=>'html',
]);
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📑 <b>@$ismi ni $text ga o'tkazishga ishonchingiz komilmi?</b>

<i>Bot ushbu foydalanuvchiga o'tgach, botning to'liq boshqaruviga ega bo'ladi!</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"confirm=$ismi=$text"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"settings=$ismi"]],
]
])
]);
unlink("step/$cid.step");
exit();
}
}
}

if(mb_stripos($data, "confirm=")!==false){
$ex = explode("=",$data);
$ismi = $ex[1];
$id = $ex[2];
mkdir("baza/$id");
$turi = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$ismi'"))['turi'];
file_put_contents("baza/$id/bots.txt", "\n".$ismi, FILE_APPEND);
file_put_contents("baza/$id/bots2.txt", "\n".$turi, FILE_APPEND);
$bots = file_get_contents("baza/$cid2/bots.txt");
$a = str_replace("\n".$ismi."","",$bots);
file_put_contents("baza/$cid2/bots.txt","$a");
$bots2 = file_get_contents("baza/$cid2/bots2.txt");
$b = str_replace("\n".$turi."","",$bots2);
file_put_contents("baza/$cid2/bots2.txt","$b");
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
     'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>✅ Botingiz $id ga o'tkazildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$boshqar,
]);
bot('SendMessage',[
'chat_id'=>$id,
'text'=>"🔔 <b>Sizga bot o'tkazishdi!

🔗  Havola:</b> @$ismi
📨 <b>Yuboruvchi:</b> <a href='tg://user?id=$cid2'>$callname</a>

<i>Bot to'liq sizni boshqaruvingizga o'tishi uchun, yangilab olishni unutmang!</i>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
]);
exit();
}

if($text == "💵 To'lovlar" and joinchat($cid) == true){
$bot = file_get_contents("baza/$cid/bots.txt");
if($bot != null){
$more = explode("\n",$bot);
$soni = substr_count($bot,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"💵 $for. $title","callback_data"=>"tolovlar=$title"];
$key2 = array_chunk($key, 2);
$key2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]];
$sozlash = json_encode([
'inline_keyboard'=>$key2,
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$sozlash,
]);
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📂 <b>Sizda hech qanday bot yo'q!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot qo'shish",'callback_data'=>"orqaga"]],
]
])
]);
exit();
}
}

if($data == "tolov"){
$bot = file_get_contents("baza/$cid2/bots.txt");
if($bot != null){
$more = explode("\n",$bot);
$soni = substr_count($bot,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"💵 $for. $title","callback_data"=>"tolovlar=$title"];
$key2 = array_chunk($key, 2);
$key2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"boshqarish"]];
$sozlash = json_encode([
'inline_keyboard'=>$key2,
]);
}
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
    'text'=>"📋 <b>Quyidagilardan birini tanlang:</b>",
    'parse_mode'=>'html',
    'reply_markup'=>$sozlash,
]);
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"📂 <b>Sizda hech qanday bot yo'q!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi bot qo'shish",'callback_data'=>"orqaga"]],
]
])
]);
exit();
}
}

if(mb_stripos($data,"tolovlar=") !== false){
    $ex = explode("=",$data);
    $bot = $ex[1];
    $narx = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$bot'"))['narxi'];
    $n31 = $narx * 31;
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"✅ @$bot <b>tanlandi!

🗓 1 kunlik to'lov:</b> $narx $valyuta
    <b>31 kunlik to'lov:</b> $n31 $valyuta",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
    [['text'=>"➕ To'lov qilish",'callback_data'=>"tolash=$bot=$narx"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"tolov"]],
]
])
]);
}

if(mb_stripos($data,"tolash=") !== false){
    $ex = explode("=",$data);
    $bot = $ex[1];
    $narx = $ex[2];
    $n3 = $narx * 3;
    $n7 = $narx * 7;
    $n10 = $narx * 10;
    $n31 = $narx * 31;
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
    'text'=>"⏱ <b>Yuklanmoqda...</b>",
    'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>🗓 Necha kunlik to'lovni amalga oshirmoqchisiz?</b>

<i>1 kunlik to'lov - $narx $valyuta
3 kunlik to'lov - $n3 $valyuta
7 kunlik to'lov - $n7 $valyuta
10 kunlik to'lov - $n10 $valyuta
31 kunlik to'lov - $n31 $valyuta</i>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
    [['text'=>"1",'callback_data'=>"narx=1=$bot=$narx"],['text'=>"3",'callback_data'=>"narx=3=$bot=$n3"],['text'=>"7",'callback_data'=>"narx=7=$bot=$n7"],['text'=>"10",'callback_data'=>"narx=10=$bot=$n10"],['text'=>"31",'callback_data'=>"narx=31=$bot=$n31"]],
    [['text'=>"◀️ Orqaga",'callback_data'=>"tolovlar=$bot"]],
]
])
]);
}

if(mb_stripos($data, "narx=") !== false){
$ex = explode("=",$data);
$day = $ex[1];
$bot = $ex[2];
$narx = $ex[3];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = '$cid2'"))['pul'];
$kun = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kunlik WHERE useri = '$bot'"))['kun'];
if($pul >= $narx){
$a = $pul - $narx;
$b = $kun + $day;
mysqli_query($connect, "UPDATE kabinet SET pul = '$a' WHERE user_id = '$cid2'");
mysqli_query($connect, "UPDATE kunlik SET kun = '$b' WHERE useri = '$bot'");
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"✅ <b>Botingiz uchun $day kunlik to'lov to'landi!</b>

<i>Hisobingizdan $narx $valyuta olib tashlandi</i>",
            'parse_mode'=>'html',
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"tolovlar=$bot"]],
    ]
    ])
    ]);
}else{
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Hisobingizda yetarli mablag' mavjud emas!",
	'show_alert'=>true,
	]);
}
}


if($text == "➕ Yangi bot ochish" and joinchat($cid)==true){
	if(in_array($cid, $admin)){$q = "➕ Qo‘shish";}
$kategoriya = file_get_contents("bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$royxatt = file_get_contents("bot/$title/royxat.txt");
	$sonii = substr_count($royxatt,"\n");
$key[]=["text"=>"$title - ($sonii/$sonii)","callback_data"=>"bolim=$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"$q",'callback_data'=>"AdKat"]];
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
		if($kategoriya == null){
			bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"🤷‍♂️ <b>Bo'limlar mavjud emas!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bolim
    ]);
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"📋 <b>Quyidagi bo‘limlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bolim
    ]);
exit();
}
}

if($data == "orqaga"){
	if(in_array($cid2, $admin)){$q = "➕ Qo‘shish";}
$kategoriya = file_get_contents("bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$royxatt = file_get_contents("bot/$title/royxat.txt");
	$sonii = substr_count($royxatt,"\n");
$keya[]=["text"=>"$title - ($sonii/$sonii)","callback_data"=>"bolim=$title"];
$keyboard2 = array_chunk($keya, 1);
$keyboard2[] = [['text'=>"$q",'callback_data'=>"AdKat"]];
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"📋 <b>Quyidagi bo‘limlardan birini tanlang:</b>",
'parse_mode'=>"html",
	'reply_markup'=>$bolim
]);
exit();
}

if(mb_stripos($data, "bolim=")!==false){
 $ex = explode("=",$data);
 $kat = $ex[1];
 if(in_array($cid2, $admin)){ $del = "🗑️"; 
$edit = "📝"; 
$add = "➕";}
$royxat = file_get_contents("bot/$kat/royxat.txt");
$ids = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
foreach($ids as  $id){
$keyboards = [];
$text = "";
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$ids[$i]);
$nomi=$ids[$i];
if($nomi=="MakerBot"){$ism="$bot Lite";
}else{$ism=$nomi;}
$narx=file_get_contents("bot/$kat/$nomi/narx.txt");
if($statuse=="Premium"){$narx=$narx/2;}
$text .= "<b>$i.</b> $ism - $narx $valyuta\n";
$keyboards[]=["text"=>"$i","callback_data"=>"ichki=$nomi=$kat"];
}
$key = array_chunk($keyboards, 4);
$key[] = [['text'=>"$del",'callback_data'=>"delKate-$kat"],['text'=>"$add",'callback_data'=>"addb-$kat"],['text'=>"$edit",'callback_data'=>"tah-$kat"]];
$key[] = [['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]];
$kee = json_encode([
'inline_keyboard'=>$key,
]);
}

if($royxat != null){
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"🛠️ <b>Quyidagi botlardan birini tanlang:</b>\n\n$text",
'parse_mode'=>'html',
'reply_markup'=>$kee
]);
bot('answerCallbackQuery',[
 'callback_query_id'=>$qid,
 'text'=>"« $kat » bo‘limiga xush kelibsiz.",
 'show_alert'=>false,
 ]);
 }
 
 if($royxat == null){
    if(in_array($cid2, $admin)){
    	 bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>" <b>📂 Botlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$del",'callback_data'=>"delKate-$kat"],['text'=>"$add",'callback_data'=>"addb-$kat"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]]
]
]),
]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"📂 Botlar mavjud emas!",
	'show_alert'=>true,
	]);
}
}
}

if(mb_stripos($data, "delKate-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📁 <b>Kategoriya nomi:</b> $kat
	
<i>O'chirib tashlashga ishonchingiz komilmi?</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🗑️ O‘chirish",'callback_data'=>"delKat-$kat"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]]
]
])
]);
}

if(mb_stripos($data, "ichki=")!==false){
	if(in_array($cid2, $admin)){
		$s1 = "🗑️"; $s3 = "📝";}
$ex = explode("=",$data);
$royxat = $ex[1];
$kategoriya = $ex[2];
$type = file_get_contents("bot/$kategoriya/$royxat/turi.txt");
$narx = file_get_contents("bot/$kategoriya/$royxat/narx.txt");
$kunlik = file_get_contents("bot/$kategoriya/$royxat/kunlik.txt");
$tavsif = file_get_contents("bot/$kategoriya/$royxat/tavsif.txt");
$versiya = file_get_contents("bot/$kategoriya/$royxat/versiya.txt");
$til = file_get_contents("bot/$kategoriya/$royxat/til.txt");
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$statuse = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $cid2"))['status'];
if($statuse != "Oddiy"){
	$narx = $narx / 2;
	$eskinarx = file_get_contents("bot/$kategoriya/$royxat/narx.txt");
	$newup = "<del>$eskinarx $valyuta</del> <b>$narx $valyuta</b>";
	$newus = "45";
	$pre = "💎 <b>Premium foydalanuvchilar uchun chegirma: -50%</b>";
	}else{
		$narx = file_get_contents("bot/$kategoriya/$royxat/narx.txt");
		$newup = "$narx $valyuta";
		$newus = "31";
		}
		$cc = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = '$cid2'"))['cc'];
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<i> $royxat</i>

💬 Interfeys tili: <i>$til</i>
💵 <b>Narxi:</b> $newup

🎁 <b>Bonus sifatida $newus kunlik
🗓 Kunlik to'lov narxi:</b> $kunlik $valyuta

*️⃣ Qo'shimcha ma'lumotlar: <i>$tavsif</i>

🔝 Versiya: <i>$versiya</i>

💵 Balansingiz: $pul $valyuta
🎟️ <b>Kartalaringiz:</b> $cc ta\n\n$pr",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Botni yaratish",'callback_data'=>"tanla=$type=$narx=$kunlik=$royxat=$kategoriya"]],
[['text'=>"$s1",'callback_data'=>"delBota-$kategoriya-$royxat-$type"],['text'=>"$s3",'callback_data'=>"tahrirlash-$kategoriya-$royxat"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bolim=$kategoriya"]],
]
])
]);
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"« $royxat » nomli bot tanlandi ✅",
	'show_alert'=>false,
	]);
}

if($data == "RiseBuilder"){
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"🔒 Kechirasiz, ushbu bot aktiv holatda emas!",
	'show_alert'=>true,
	]);
}

if(mb_stripos($data, "tanla=")!==false){
	$ex = explode("=",$data);
	$type = $ex[1];
	$narx = $ex[2];
	$kunlik = $ex[3];
	$royxat = $ex[4];
	$kategoriya = $ex[5];
	$text = "🤷🏻‍♂ <b>Qaysi usul bilan yaratmoqchisiz?</b>

⬇️ <u>Quyidagilardan birini tanlang:</u>";
$keyBot = json_encode([
'inline_keyboard'=>[
[['text'=>"💵 Balans orqali - $narx $valyuta",'callback_data'=>"bots=$type=$narx=$kunlik=$royxat=$kategoriya"]],
[['text'=>"🎫 CreateCard orqali - 1 ta",'callback_data'=>"carda=$type=$narx=$kunlik=$royxat=$kategoriya"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"ichki=$royxat=$kategoriya"]]
]]);
	edit($cid2, $mid2, $text, $keyBot);
	}
	if(mb_stripos($data, "delBota-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	$roy = $ex[2];
	$type = $ex[3];
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🗑️ <i>O'chirib tashlashga ishonchingiz komilmi?</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"✅ O‘chirish",'callback_data'=>"delBot-$kat-$roy-$type"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]]
]
])
]);
}

if(mb_stripos($data, "bots=")!==false){
	$ex = explode("=",$data);
	$turi = $ex[1];
	$narx = $ex[2];
	$kun = $ex[3];
	$kategoriya = $ex[4];
	$royxat = $ex[5];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$botlar = file_get_contents("baza/$cid2/bots2.txt");
if(mb_stripos($botlar, $turi) !== false){
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Limitga yetib kelgansiz!",
	'show_alert'=>true,
	]);
	}else{
 if($pul >= $narx){
 bot('deleteMessage',[
    'chat_id'=>$cid2,
    'message_id'=>$mid2,
]);
    bot('SendMessage',[
   'chat_id'=>$cid2,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:</b>

<i>Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing:</i>",
'parse_mode'=>'html',
    'reply_markup'=>$back
    ]);
    file_put_contents("step/$cid2.step","bots=$turi=$narx=$kun");
exit();
    }else{
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
    'text'=>"Kechirasiz, hisobingizda yetarli mablag' mavjud emas.",
    'show_alert'=>true,
    ]);
}
}
}

if(mb_stripos($step, "bots=")!==false){
$ex = explode("=",$step);
	$turi = $ex[1];
	$narx = $ex[2];
	$kun = $ex[3];
	if($status == "Premium"){
		$tkuni = "45";
		}elseif($status === "Oddiy"){
			$tkuni = "31";
			}
    if(mb_stripos($tx, ":")!==false){
      $msg =  bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
])->result->message_id;
bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
        ]);
       bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"<b>✅ Siz yuborgan bot tokeni qabul qilindi!</b>",
       'parse_mode'=>'html',
        ]);
    $kod = file_get_contents("bot/$turi.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
    $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
    mkdir("bots/$user");
    mkdir("baza/$cid");
    file_put_contents("bots/$user/index.php", $kod);
    
    if($turi=="MakerBot"){
mkdir("bots/$user/botlar");
file_put_contents("bots/$user/botlar/SarmoyaBot.php",file_get_contents("botlar/SarmoyaBot.php"));
file_put_contents("bots/$user/botlar/ObunachiBot.php",file_get_contents("botlar/ObunachiBot.php"));
file_put_contents("bots/$user/botlar/SpecialSMM Lite.php",file_get_contents("botlar/SpecialSMM Lite.php"));
file_put_contents("bots/$user/botlar/PulBot Lite.php",file_get_contents("botlar/PulBot Lite.php"));
file_put_contents("bots/$user/botlar/TurfaBot.php",file_get_contents("botlar/TurfaBot.php"));
file_put_contents("bots/$user/botlar/GramAPIBot.php",file_get_contents("botlar/GramAPIBot.php"));
file_put_contents("bots/$user/botlar/AvtoNakrutka.php",file_get_contents("botlar/AvtoNakrutka.php"));
file_put_contents("bots/$user/botlar/Obunachi Lite.php",file_get_contents("botlar/Obunachi Lite.php"));
file_put_contents("bots/$user/botlar/Reklamachi.php",file_get_contents("botlar/Reklamachi.php"));
file_put_contents("bots/$user/botlar/SpecialMember.php",file_get_contents("botlar/SpecialMember.php"));
file_put_contents("bots/$user/botlar/NamozVAQT.php",file_get_contents("botlar/NamozVAQT.php"));
file_put_contents("bots/$user/botlar/AutoNumber.php",file_get_contents("botlar/AutoNumber.php"));
file_put_contents("bots/$user/botlar/VideoDown.php",file_get_contents("botlar/VideoDown.php"));
file_put_contents("bots/$user/botlar/KonstruktorBot.php",file_get_contents("botlar/KonstruktorBot.php"));
file_put_contents("bots/$user/botlar/ConvertorBot.php",file_get_contents("botlar/ConvertorBot.php"));
file_put_contents("bots/$user/botlar/ValyutaKursProBot.php",file_get_contents("botlar/ValyutaKursProBot.php"));
file_put_contents("bots/$user/botlar/KonspektBot.php",file_get_contents("botlar/KonspektBot.php"));
file_put_contents("bots/$user/botlar/NikBot.php",file_get_contents("botlar/NikBot.php"));
#mini
mkdir("bots/$user/mini");
file_put_contents("bots/$user/mini/SarmoyaBot.php",file_get_contents("mini/SarmoyaBot.php"));
file_put_contents("bots/$user/mini/ObunachiBot.php",file_get_contents("mini/ObunachiBot.php"));
file_put_contents("bots/$user/mini/SpecialSMM Lite.php",file_get_contents("mini/SpecialSMM Lite.php"));
file_put_contents("bots/$user/mini/PulBot Lite.php",file_get_contents("mini/PulBot Lite.php"));
file_put_contents("bots/$user/mini/TurfaBot.php",file_get_contents("mini/TurfaBot.php"));
file_put_contents("bots/$user/mini/GramAPIBot.php",file_get_contents("mini/GramAPIBot.php"));
file_put_contents("bots/$user/mini/AvtoNakrutka.php",file_get_contents("mini/AvtoNakrutka.php"));
file_put_contents("bots/$user/mini/Obunachi Lite.php",file_get_contents("mini/Obunachi Lite.php"));
file_put_contents("bots/$user/mini/Reklamachi.php",file_get_contents("mini/Reklamachi.php"));
file_put_contents("bots/$user/mini/SpecialMember.php",file_get_contents("mini/SpecialMember.php"));
file_put_contents("bots/$user/mini/NamozVAQT.php",file_get_contents("mini/NamozVAQT.php"));
file_put_contents("bots/$user/mini/AutoNumber.php",file_get_contents("mini/AutoNumber.php"));
file_put_contents("bots/$user/mini/VideoDown.php",file_get_contents("mini/VideoDown.php"));
}

    $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/RiseBuilder/bots/$user/index.php"))->result;
    if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;       
        file_put_contents("baza/$cid/bots.txt", "\n".$user, FILE_APPEND);
        file_put_contents("baza/$cid/bots2.txt", "\n".$turi, FILE_APPEND);
	     mysqli_query($connect, "INSERT INTO kunlik(`user_id`,`useri`,`turi`,`tokeni`,`vaqti`,`narxi`,`kun`,`avto`) VALUES ('$cid','$user','$turi','$tx','$sana | $soat','$kun','$tkuni','❌')");       
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"ℹ️ Botingiz tayyor. Quyidagi tugma orqali botingizga o'tishingiz mumkin.",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"➡️ Botga o'tish",'url'=>"https://t.me/$user"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]]
    ]
    ])
    ]);
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid"))['pul'];
$a = $pul - $narx;
mysqli_query($connect, "UPDATE kabinet SET pul = '$a' WHERE user_id = $cid");
unlink("step/$cid.step");
exit();
}else{
		bot('editMessageText',[
	'chat_id'=>$cid,
'message_id'=>$msg,
	'text'=>"⛔️ <b>Kechirasiz token qabul qilinmadi!</b>

<i>Qayta urinib ko'ring:</i>",
	'parse_mode'=>'html',
]);
exit();
}
}else{
	bot('sendMessage',[
	'chat_id'=>$cid,
'text'=>"⛔️ <b>Kechirasiz token qabul qilinmadi!</b>

<i>Qayta urinib ko'ring:</i>",
	'parse_mode'=>'html',
]);
exit();
}
}

if(mb_stripos($data, "carda=")!==false){
	$ex = explode("=",$data);
	$turi = $ex[1];
	$narx = $ex[2];
	$kun = $ex[3];
	$kategoriya = $ex[4];
	$royxat = $ex[5];
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid2"))['cc'];
$botlar = file_get_contents("baza/$cid2/bots2.txt");
if(mb_stripos($botlar, $turi) !== false){
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Limitga yetib kelgansiz!",
	'show_alert'=>true,
	]);
	}else{
 if($pul >= 1){
 bot('deleteMessage',[
    'chat_id'=>$cid2,
    'message_id'=>$mid2,
]);
    bot('SendMessage',[
   'chat_id'=>$cid2,
    'text'=>"<b>🔑 Botingizni tokenini yuboring:</b>

<i>Token haqida ma'lumotga ega bo'lmasangiz qo'llanma bilan tanishib chiqing:</i>",
'parse_mode'=>'html',
    'reply_markup'=>$back
    ]);
    file_put_contents("step/$cid2.step","carda=$turi=$narx=$kun");
exit();
    }else{
bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
    'text'=>"Kechirasiz, hisobingizda yetarli CreateCard mavjud emas.",
    'show_alert'=>true,
    ]);
}
}
}

if(mb_stripos($step, "carda=")!==false){
	if($status == "Premium"){
		$tkuni = "45";
		}elseif($status === "Oddiy"){
			$tkuni = "31";
			}
$ex = explode("=",$step);
	$turi = $ex[1];
	$narx = $ex[2];
	$kun = $ex[3];
    if(mb_stripos($tx, ":")!==false){
      $msg =  bot('SendMessage',[
        'chat_id'=>$cid,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
])->result->message_id;
bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
        ]);
       bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"<b>✅ Siz yuborgan bot tokeni qabul qilindi!</b>",
       'parse_mode'=>'html',
        ]);
    $kod = file_get_contents("bot/$turi.php");
    $kod = str_replace("API_TOKEN", "$tx", $kod);
    $kod = str_replace("ADMIN_ID", "$cid", $kod);
    $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
    mkdir("bots/$user");
    mkdir("baza/$cid");
    file_put_contents("bots/$user/index.php", $kod);
    if($turi=="MakerBot"){
mkdir("bots/$user/botlar");
file_put_contents("bots/$user/botlar/SarmoyaBot.php",file_get_contents("botlar/SarmoyaBot.php"));
file_put_contents("bots/$user/botlar/ObunachiBot.php",file_get_contents("botlar/ObunachiBot.php"));
file_put_contents("bots/$user/botlar/SpecialSMM Lite.php",file_get_contents("botlar/SpecialSMM Lite.php"));
file_put_contents("bots/$user/botlar/PulBot Lite.php",file_get_contents("botlar/PulBot Lite.php"));
file_put_contents("bots/$user/botlar/TurfaBot.php",file_get_contents("botlar/TurfaBot.php"));
file_put_contents("bots/$user/botlar/GramAPIBot.php",file_get_contents("botlar/GramAPIBot.php"));
file_put_contents("bots/$user/botlar/AvtoNakrutka.php",file_get_contents("botlar/AvtoNakrutka.php"));
file_put_contents("bots/$user/botlar/Obunachi Lite.php",file_get_contents("botlar/Obunachi Lite.php"));
file_put_contents("bots/$user/botlar/Reklamachi.php",file_get_contents("botlar/Reklamachi.php"));
file_put_contents("bots/$user/botlar/SpecialMember.php",file_get_contents("botlar/SpecialMember.php"));
file_put_contents("bots/$user/botlar/NamozVAQT.php",file_get_contents("botlar/NamozVAQT.php"));
file_put_contents("bots/$user/botlar/AutoNumber.php",file_get_contents("botlar/AutoNumber.php"));
file_put_contents("bots/$user/botlar/VideoDown.php",file_get_contents("botlar/VideoDown.php"));
file_put_contents("bots/$user/botlar/KonstruktorBot.php",file_get_contents("botlar/KonstruktorBot.php"));
file_put_contents("bots/$user/botlar/ConvertorBot.php",file_get_contents("botlar/ConvertorBot.php"));
file_put_contents("bots/$user/botlar/ValyutaKursProBot.php",file_get_contents("botlar/ValyutaKursProBot.php"));
#mini
mkdir("bots/$user/mini");
file_put_contents("bots/$user/mini/SarmoyaBot.php",file_get_contents("mini/SarmoyaBot.php"));
file_put_contents("bots/$user/mini/ObunachiBot.php",file_get_contents("mini/ObunachiBot.php"));
file_put_contents("bots/$user/mini/SpecialSMM Lite.php",file_get_contents("mini/SpecialSMM Lite.php"));
file_put_contents("bots/$user/mini/PulBot Lite.php",file_get_contents("mini/PulBot Lite.php"));
file_put_contents("bots/$user/mini/TurfaBot.php",file_get_contents("mini/TurfaBot.php"));
file_put_contents("bots/$user/mini/GramAPIBot.php",file_get_contents("mini/GramAPIBot.php"));
file_put_contents("bots/$user/mini/AvtoNakrutka.php",file_get_contents("mini/AvtoNakrutka.php"));
file_put_contents("bots/$user/mini/Obunachi Lite.php",file_get_contents("mini/Obunachi Lite.php"));
file_put_contents("bots/$user/mini/Reklamachi.php",file_get_contents("mini/Reklamachi.php"));
file_put_contents("bots/$user/mini/SpecialMember.php",file_get_contents("mini/SpecialMember.php"));
file_put_contents("bots/$user/mini/NamozVAQT.php",file_get_contents("mini/NamozVAQT.php"));
file_put_contents("bots/$user/mini/AutoNumber.php",file_get_contents("mini/AutoNumber.php"));
file_put_contents("bots/$user/mini/VideoDown.php",file_get_contents("mini/VideoDown.php"));
}
    $get = json_decode(file_get_contents("https://api.telegram.org/bot$tx/setwebhook?url=https://".$_SERVER['SERVER_NAME']."/RiseBuilder/bots/$user/index.php"))->result;
    if($get){
        $user = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->username;
        $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->first_name;
        $id = json_decode(file_get_contents("https://api.telegram.org/bot$tx/getme"))->result->id;       
        file_put_contents("baza/$cid/bots.txt", "\n".$user, FILE_APPEND);
        file_put_contents("baza/$cid/bots2.txt", "\n".$turi, FILE_APPEND);
	     mysqli_query($connect, "INSERT INTO kunlik(`user_id`,`useri`,`turi`,`tokeni`,`vaqti`,`narxi`,`kun`,`avto`) VALUES ('$cid','$user','$turi','$tx','$sana | $soat','$kun','$tkuni','❌')");       
        bot('editMessageText',[
        'chat_id'=>$cid,
        'message_id'=>$mid + 1,
        'text'=>"ℹ️ Botingiz tayyor. Quyidagi tugma orqali botingizga o'tishingiz mumkin.",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>"➡️ Botga o'tish",'url'=>"https://t.me/$user"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqaga"]]
    ]
    ])
    ]);
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM card WHERE user_id = $cid"))['cc'];
$a = $pul - 1;
mysqli_query($connect, "UPDATE card SET cc = '$a' WHERE user_id = $cid");
unlink("step/$cid.step");
exit();
}else{
		bot('editMessageText',[
	'chat_id'=>$cid,
'message_id'=>$msg,
	'text'=>"⛔️ <b>Kechirasiz token qabul qilinmadi!</b>

<i>Qayta urinib ko'ring:</i>",
	'parse_mode'=>'html',
]);
exit();
}
}else{
	bot('sendMessage',[
	'chat_id'=>$cid,
'text'=>"⛔️ <b>Kechirasiz token qabul qilinmadi!</b>

<i>Qayta urinib ko'ring:</i>",
	'parse_mode'=>'html',
]);
exit();
}
}

if($text == "📋 Ma'lumotlar" and joinchat($cid)==true){
bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"👑 <b>@$bot orqali telegram tarmogʻida hech qanday dasturlash tillarisiz mukammal botlar yarata olasiz.

🤖 Shu kabi bot yaratish uchun menga murojaat qiling.</b>",
		'parse_mode'=>'html',
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"📕 Qoidalar",'callback_data'=>"qoida"]],
[['text'=>"☎️ Murojaat",'callback_data'=>"faq"]],
[['text'=>"☎️ Texnik Yordam",'url'=>"tg://user?id=$AlijonovUz"]],
]
])
]);
exit();
}

if($data == "malumot"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
		'chat_id'=>$cid2,
		'text'=>"👑 <b>@$bot orqali telegram tarmogʻida hech qanday dasturlash tillarisiz mukammal botlar yarata olasiz.

🤖 Shu kabi bot yaratish uchun menga murojaat qiling.</b>",
		'parse_mode'=>'html',
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"📕 Qoidalar",'callback_data'=>"qoida"]],
[['text'=>"☎️ Murojaat",'callback_data'=>"faq"]],
[['text'=>"☎️ Texnik Yordam",'url'=>"tg://user?id=$AlijonovUz"]],
]
])
]);
exit();
}

if($data == "qoida"){
	if($qoida == null){
		bot('answerCallbackQuery',[
		'callback_query_id'=>$qid,
		'text'=>"Qoidalar qo'shilmagan!",
		'show_alert'=>true,
]);
}else{
	bot('editMessageText',[
		'chat_id'=>$cid2,
                'message_id'=>$mid2,
		'text'=>$qoida,
		'parse_mode'=>'html',
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malumot"]],
]
])
]);
}
}

if($data == "faq" and joinchat($cid2)==true){
	$mt = file_get_contents("step/$cid2.mt");
if($mt == null){
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Murojaat maqsadini yuboring:</b>

<i>Maks. belgilar soni: 16</i>",
'parse_mode'=>'html',
'reply_markup'=>$back
]);
file_put_contents("step/$cid2.step","maqsadi");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid2,
    'text'=>"<b>Sizda aktiv murojaat mavjud. Quyidagi tugma orqali murojaatingiz ma'lumotlarini ko'rishingiz mumkin:</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[          
[['text'=>"$mt",'callback_data'=>"mt"]],           
]
])      
]);
exit();
}
}

if($data == "yordam"){
$mt = file_get_contents("step/$cid2.mt");
if($mt == null){
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Murojaat maqsadini yuboring:</b>

<i>Maks. belgilar soni: 16</i>",
'parse_mode'=>'html',
'reply_markup'=>$back
]);
file_put_contents("step/$cid2.step","maqsadi");
exit();
}else{
bot('deleteMessage',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
    'text'=>"<b>Sizda aktiv murojaat mavjud. Quyidagi tugma orqali murojaatingiz ma'lumotlarini ko'rishingiz mumkin:</b>",
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[          
[['text'=>"$mt",'callback_data'=>"mt"]],           
]
])      
]);
exit();
}
}

if($step == "maqsadi"){
if(strlen($text)<"16"){
file_put_contents("step/$cid.mt",$text);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Murojaat matnini yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","matni");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Murojaat maqsadini yuboring:</b>

<i>Maks. belgilar soni: 16</i>",
'parse_mode'=>'html',
]);
exit();
}
}

if($step == "matni"){
file_put_contents("step/$cid.mt2",$text);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
    'text'=>"<b>Yangi murojaat:

Maqsad:</b> $mt

<b>Matn:</b> $text",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
       'reply_markup'=>json_encode([
          'inline_keyboard'=>[
            [['text'=>"Javob berish",'callback_data'=>"javob-$cid"]],           
            ]
           ])      
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Murojaatingiz asosiy adminga yuborildi.</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyu
]);
unlink("step/$cid.step");
exit();
}

if($data == "mt"){
	$mt = file_get_contents("step/$cid2.mt");
	$mt2 = file_get_contents("step/$cid2.mt2");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"$mt
	
$mt2",
   'parse_mode'=>'html',
	'reply_markup'=>json_encode([
   'inline_keyboard'=>[          
[['text'=>"O'chirish",'callback_data'=>"delmt"]],   
[['text'=>"Orqaga",'callback_data'=>"yordam"]],  
]
])      
]);
}

if($data == "delmt"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>Murojaat o'chirib tashlandi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
   'inline_keyboard'=>[             
[['text'=>"Orqaga",'callback_data'=>"yordam"]],  
]
])      
]);
unlink("step/$cid2.mt");
unlink("step/$cid2.mt2");
}


if(mb_stripos($data, "javob-")!==false){
  $ex = explode("-",$data);
  $id = $ex[1];
$mt = file_get_contents("step/$id.mt");
if($mt != null){
  bot('deleteMessage',[
    'chat_id'=>$cid2,
    'message_id'=>$mid2,
    ]);
    bot('sendMessage',[
      'chat_id'=>$cid2,
      'text'=>"<b>Javob matnini kiriting:</b>",
      'parse_mode'=>'html',
      'reply_markup'=>$back,
    ]);
   file_put_contents("step/$cid2.step","javob-$id");
  exit();
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Ushbu murojaatga javob berilgan yoki murojaat o'chirib tashlangan!",
'show_alert'=>true,
]);
}
}

if(mb_stripos($step, "javob-")!==false){
$ex = explode("-",$step);
$id = $ex[1];
  bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>$text,
    'parse_mode'=>'html',
  'reply_markup'=>json_encode([
          'inline_keyboard'=>[
[['text'=>"📨 Yordam",'callback_data'=>"yordam"]],           
]
])      
]);
  bot('sendMessage',[
    'chat_id'=>$AlijonovUz,
    'text'=>"<b>Javob yuborildi.</b>",
    'parse_mode'=>'html',
    'reply_markup'=>$menus,
    ]);
    unlink("step/$cid.step");
    unlink("step/$id.mt");
    unlink("step/$id.mt2");
    exit();
}


//<--- Admin panel ----->

if($text == "⚙ Boshqarish"){
	if(in_array($cid,$admin)){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Boshqaruv panelidasiz:</b>",
   'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
unlink("step/$cid.txt");
unlink("step/test.txt");
exit();
}
}

if($data == "yopish"){
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
}

if($data == "foydalanuvchi"){
$baza = file_get_contents("step/$cid2.txt");
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['pul'];
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['odam'];
$ban = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['ban'];
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $baza"))['status'];
$uid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['id'];
if($ban == unban){
	$bans = "🔔 Banlash";
}
if($ban == "ban"){
	$bans = "🔕 Bandan olish";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"✅ <b>Foydalanuvchi topildi!

📝 ID:</b> <a href='tg://user?id=$baza'>$baza</a>
🔐 <b>Balans: $pul $valyuta
🖇️ Takliflar: $odam ta
🎯 Status: $status
🆔 UID raqami:</b> <code>$uid</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
	[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
	]
	])
]);
unlink("step/$cid2.step");
exit();
}

if($text == "🔎 Foydalanuvchini boshqarish"){
			if(in_array($cid,$admin)){
	bot('SendMessage',[
'chat_id'=>$cid,
	'text'=>"<b>Kerakli foydalanuvchining ID raqamini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh
	]);
file_put_contents("step/$cid.step",'iD');
exit();
}
}

if($step == "iD"){
			if(in_array($cid,$admin)){
$user = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $text"));
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Foydalanuvchi topilmadi.</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}else{
file_put_contents("step/$cid.txt",$text);
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $text"))['pul'];
$odam = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $text"))['odam'];
$ban = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $text"))['ban'];
$status = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM status WHERE user_id = $text"))['status'];
$uid = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $text"))['id'];
if($ban == unban){
	$bans = "🔔 Banlash";
}
if($ban == "ban"){
	$bans = "🔕 Bandan olish";
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qidirilmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
'text'=>"<b>Qidirilmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Foydalanuvchi topildi!

📝 ID:</b> <a href='tg://user?id=$text'>$text</a>
🔐 <b>Balans: $pul $valyuta
🖇️ Takliflar: $odam ta
🎯 Status: $status
🆔 UID raqami:</b> <code>$uid</code>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"$bans",'callback_data'=>"ban"]],
	[['text'=>"➕ Pul qo'shish",'callback_data'=>"plus"],['text'=>"➖ Pul ayirish",'callback_data'=>"minus"]]
	]
	])
]);
unlink("step/$cid.step");
exit();
}
}
}


//qo'shish
if($data == "plus"){
$baza = file_get_contents("step/$cid2.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<a href='tg://user?id=$baza'>$baza</a> <b>ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
file_put_contents("step/$cid2.step",'plus');
}

if($step == "plus"){
	if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$baza,
'text'=>"<b>Adminlar tomonidan hisobingiz $text $valyuta to'ldirildi</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $text $valyuta qo'shildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['pul'];
$pul2 = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['pul2'];
$a = $pul + $text;
$b = $pul2 + $text;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $baza");
mysqli_query($connect,"UPDATE kabinet SET pul2 = $b WHERE user_id = $baza");
unlink("step/$cid.txt");
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'protect_content'=>true,
]);
exit();
}
}
}

//ayirish
if($data=="minus"){
$baza = file_get_contents("step/$cid2.txt");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<a href='tg://user?id=$baza'>$baza</a> <b>ning hisobiga qancha pul ayirmoqchisiz?</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
file_put_contents("step/$cid2.step",'minus');
}

if($step == "minus"){
	if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
bot('sendMessage',[
'chat_id'=>$baza,
'text'=>"<b>Adminlar tomonidan hisobingizdan $text $valyuta olib tashlandi</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $text $valyuta olib tashlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$pul = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['pul'];
$a = $pul - $text;
mysqli_query($connect,"UPDATE kabinet SET pul = $a WHERE user_id = $baza");
unlink("step/$cid.txt");
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($data=="ban"){
$baza = file_get_contents("step/$cid2.txt");
if($AlijonovUz == $baza){
bot('answerCallbackQuery',[
'callback_query_id'=>$qid,
'text'=>"Asosiy adminlarni blocklash mumkin emas!",
'show_alert'=>true,
]);
}else{
$ban = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $baza"))['ban'];
	if($ban == "ban"){
		mysqli_query($connect,"UPDATE kabinet SET ban = 'unban' WHERE user_id = $baza");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($baza) bandan olindi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
}else{
mysqli_query($connect,"UPDATE kabinet SET ban = 'ban' WHERE user_id = $baza");
mysqli_query($connect, "DELETE FROM `kunlik` WHERE user_id = '$baza'");
bot('editMessageText',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>Foydalanuvchi ($baza) banlandi!</b>",
'parse_mode'=>"html",
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"foydalanuvchi"]]
]
])
]);
deleteFolder("baza/$baza");
deleteFolder("bots/$baza");
}
}
}

if($text == "✉ Xabar yuborish"){
	if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yuboriladigan xabar turini tanlang;</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"📤 Oddiy",'callback_data'=>"send"],['text'=>"📤 Forward",'callback_data'=>"send2"]],
	[['text'=>"📤 Userga",'callback_data'=>"user"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
	]
	])
	]);
	exit();
}
}

if($data == "user"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Foydalanuvchi iD raqamini kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bosh,
]);
file_put_contents("step/$cid2.step",'user');
exit();
}

if($step == "user"){
	if(in_array($cid,$admin)){
if(is_numeric($text)=="true"){
file_put_contents("step/$cid.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Xabaringizni kiriting:</b>",
	'parse_mode'=>'html',
	]);
file_put_contents("step/$cid.step",'xabar');
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($step == "xabar"){
	if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$baza,
	'text'=>"$text",
        'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'protect_content'=>true,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Xabaringiz yuborildi ✅</b>",
       'parse_mode'=>'html',
        'reply_markup'=>$panel,
	]);
	unlink("step/$cid.step");
	unlink("step/$cid.txt");
	exit();
}
}

if($data == "send"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
    'text'=>"*Xabar matnini kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>$bosh,
    ]);
file_put_contents("step/$cid2.step","sendpost");
exit();
}

if($step == "sendpost"){
	if(in_array($cid,$admin)){
  unlink("step/$chat_id.step");
$res = mysqli_query($connect,"SELECT * FROM `user_id`");
bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"✅ <b>Xabar Yuborish Boshlandi!</b>",
'parse_mode'=>'html',
  ]);
$x=0;
$y=0;
while($a = mysqli_fetch_assoc($res)){
$id = $a['user_id'];
	$key=$message->reply_markup;
	$keyboard=json_encode($key);
	$ok=bot('copyMessage',[
'from_chat_id'=>$chat_id,
'chat_id'=>$id,
'message_id'=>$mid,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻️ Yangilash",'url'=>"https://t.me/$bot?start"]],
]]),
])->ok;
if($ok==true){
}else{
$okk=bot('copyMessage',[
'from_chat_id'=>$chat_id,
'chat_id'=>$id,
'message_id'=>$mid,
])->ok;
}
if($okk==true or $ok==true){
$x=$x+1;
bot('editMessageText',[
  'chat_id'=>$chat_id,
'message_id'=>$mid,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}elseif($okk==false){
mysqli_query($connect, "DELETE FROM `user_id` WHERE user_id = '$id'");
mysqli_query($connect, "DELETE FROM `kabinet` WHERE user_id = '$id'");
mysqli_query($connect, "DELETE FROM `kunlik` WHERE user_id = '$id'");
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
}
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
exit();
}


if($data == "send2"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
    'text'=>"*Xabar matnini kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>$bosh,
    ]);
file_put_contents("step/$cid2.step","sendfwrd");
exit();
}

if($step == "sendfwrd"){
	if(in_array($cid,$admin)){
  unlink("step/$chat_id.step");
$res = mysqli_query($connect,"SELECT * FROM `user_id`");
bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"✅ <b>Xabar Yuborish Boshlandi!</b>",
'parse_mode'=>'html',
  ]);
$x=0;
$y=0;
while($a = mysqli_fetch_assoc($res)){
$id = $a['user_id'];
	$key=$message->reply_markup;
	$keyboard=json_encode($key);
	$ok=bot('ForwardMessage',[
'from_chat_id'=>$chat_id,
'chat_id'=>$id,
'message_id'=>$mid,
])->ok;
if($ok==true){
}else{
$okk=bot('ForwardMessage',[
'from_chat_id'=>$chat_id,
'chat_id'=>$id,
'message_id'=>$mid,
])->ok;
}
if($okk==true or $ok==true){
$x=$x+1;
bot('editMessageText',[
  'chat_id'=>$chat_id,
'message_id'=>$mid,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}elseif($okk==false){
mysqli_query($connect, "DELETE FROM `user_id` WHERE user_id = '$id'");
mysqli_query($connect, "DELETE FROM `kabinet` WHERE user_id = '$id'");
mysqli_query($connect, "DELETE FROM `kunlik` WHERE user_id = '$id'");
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
}
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
exit();
}

if($text == "📊 Statistika"){
	if(in_array($cid,$admin)){
$res = mysqli_query($connect, "SELECT * FROM `user_id`");
$us = mysqli_num_rows($res);
$res1 = mysqli_query($connect, "SELECT * FROM `kunlik`");
$us1 = mysqli_num_rows($res1);
$soni = substr_count($kanal,"@");
$kategoriya = file_get_contents("bot/kategoriya.txt");
$more = substr_count($kategoriya,"\n");
$start_time = round(microtime(true) * 1000);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"",
'parse_mode'=>'html',
]);
$end_time = round(microtime(true) * 1000);
$ping = $end_time - $start_time;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"💡 <b>O'rtacha yuklanish:</b> <code>$ping</code>
👥 <b>Foydalanuvchilar:</b> $us ta
🤖 <b>Yaratilgan botlar:</b> $us1 ta
📢 <b>Kanallar :</b> $soni ta
📂 <b>Kategoriyalar :</b> $more ta",
'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🏆Takliflar Reyting",'callback_data'=>"treyting"]],
	[['text'=>"🏆Pul Reyting",'callback_data'=>"preyting"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
exit();
}
}

if($data =="treyting"){
	$res = mysqli_query($connect,"SELECT * FROM `kabinet`ORDER BY odam DESC LIMIT 10");
while($roww = mysqli_fetch_assoc($res)){
$id = $roww['user_id'];
$pul = $roww['pul'];
$member = $roww['odam'];
$stat = mysqli_num_rows($res);
$top .= "<a href='tg://user?id=$id'>$id</a>  -  <i>$member</i> odam\n";
}
$ids = explode("\n","\n$top");
$soi = substr_count($top,"\n");
$soni = $soi;
foreach($ids as  $id){
$keyboards = [];
$text = "";
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$ids[$i]);
$text .= "<b>$i)</b> ".$ids[$i]."\n";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🏆Top referal reyting:

$text</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($data =="preyting"){
	$res = mysqli_query($connect,"SELECT * FROM `kabinet`ORDER BY pul DESC LIMIT 50");
while($roww = mysqli_fetch_assoc($res)){
$id = $roww['user_id'];
$pul = $roww['pul'];
$member = $roww['odam'];
$stat = mysqli_num_rows($res);
$top .= "<a href='tg://user?id=$id'>$id</a> - <i>$pul</i> $valyuta\n";
}
$ids = explode("\n","\n$top");
$soi = substr_count($top,"\n");
$soni = $soi;
foreach($ids as  $id){
$keyboards = [];
$text = "";
for ($i = 1; $i <= $soni; $i++) {
$title = str_replace("\n","",$ids[$i]);
$text .= "<b>$i)</b> ".$ids[$i]." \n";
}
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>TOP-50 balanslar reytingi

$text</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($text == "/kod"){
		if(in_array($cid,$admin)){
bot('sendDocument',[
'chat_id'=>$AlijonovUz,
'document'=>new CURLFile(__FILE__),
'caption'=>"<b>@$bot kodi</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($text == "🤖 Bot holati"){
	if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Hozirgi holat:</b> $holat",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"holat-✅"],['text'=>"❌",'callback_data'=>"holat-❌"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
exit();
}
}

if(mb_stripos($data, "holat-")!==false){
$ex = explode("-",$data);
$xolat = $ex[1];
file_put_contents("tizim/holat.txt",$xolat);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       	'text'=>"<b>Hozirgi holat:</b> $xolat",
	'parse_mode'=>'html',
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"holat-✅"],['text'=>"❌",'callback_data'=>"holat-❌"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
}

$delturi = file_get_contents("tizim/turi.txt");
$delmore = explode("\n",$delturi);
$delsoni = substr_count($delturi,"\n");
$key=[];
for ($delfor = 1; $delfor <= $delsoni; $delfor++) {
$title=str_replace("\n","",$delmore[$delfor]);
$key[]=["text"=>"$title - ni o'chirish","callback_data"=>"wallet-$title"];
$keyboard2 = array_chunk($key, 1);
$keyboard2[] = [['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]];
$keyboard2[] = [['text'=>"Yopish",'callback_data'=>"yopish"]];
$delpay = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}

if($text == "💳 Hamyonlar"){
if(in_array($cid,$admin)){
if($turi == null){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$delpay
]);
exit();
}
}
}

if($data == "hamyon"){
$wallets = file_get_contents("tizim/turi.txt");
if($wallets == null){
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Yangi to'lov tizimi qo'shish",'callback_data'=>"new"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
exit();
}else{
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
		'reply_markup'=>$delpay
]);
exit();
}
}

if(mb_stripos($data,"wallet-")!==false){
	$ex = explode("-",$data);
	$tur = $ex[1];
$turi = file_get_contents("tizim/turi.txt");
	$k = str_replace("\n".$tur."","",$turi);
   file_put_contents("tizim/turi.txt",$k);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"$tur - <b>To'lov tizimi olib tashlandi.</b>",
		'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"hamyon"]],
]
])
]);
deleteFolder("tizim/$tur");
}

	/*$test = file_get_contents("step/test.txt");
   $k = str_replace("\n".$test."","",$turi);
   file_put_contents("tizim/turi.txt",$k);
deleteFolder("tizim/$test");
unlink("step/test.txt");
exit();*/

if($data == "new"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
   ]);
   bot('sendMessage',[
   'chat_id'=>$cid2,
   'text'=>"<b>Yangi to'lov tizimi nomini yuboring:</b>",
   'parse_mode'=>'html',
   'reply_markup'=>$bosh
	]);
	file_put_contents("step/$cid2.step",'turi');
	exit();
}

if($step == "turi"){
		if(in_array($cid,$admin)){
	if(isset($text)){
		mkdir("tizim/$text");
file_put_contents("tizim/turi.txt","$turi\n$text");
	file_put_contents("step/test.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Ushbu to'lov tizimidagi hamyoningiz raqamini yuboring:</b>",
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'wallet');
	exit();
}
}
}


if($step == "wallet"){
			if(in_array($cid,$admin)){
	    if(is_numeric($text)=="true"){
file_put_contents("tizim/$test/wallet.txt","$wallet\n$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Ushbu to'lov tizimi orqali hisobni to'ldirish bo'yicha ma'lumotni yuboring:</b>

<i>Misol uchun, Ushbu to'lov tizimi orqali pul yuborish jarayonida izoh kirita olmasligingiz mumkin. Ushbu holatda, biz bilan bog'laning. Havola: @BestUserUZ</i>",
'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'addition');
	exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}
}
}

if($step == "addition"){
	if(in_array($cid,$admin)){
	if(isset($text)){
file_put_contents("tizim/$test/addition.txt","$addition\n$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yangi to'lov tizimi qo'shildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
	]);
	unlink("step/$cid.step");
	unlink("step/test.txt");
	exit();
}
}
}

if($text == "📢 Kanallar"){
	if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
	[['text'=>"*⃣ Qo'shimcha kanallar",'callback_data'=>"qoshimcha"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}

if($data == "kanallar"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔐 Majburiy obunalar",'callback_data'=>"majburiy"]],
	[['text'=>"*⃣ Qo'shimcha kanallar",'callback_data'=>"qoshimcha"]],
	[['text'=>"Yopish",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}

if($data == "majburiy"){	
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Majburiy obunalarni sozlash bo'limidasiz:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Qo'shish",'callback_data'=>"qoshish"]],
[['text'=>"📑 Ro'yxat",'callback_data'=>"royxat"],['text'=>"🗑 O'chirish",'callback_data'=>"ochirish"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]]
]
])
]);
}

if($data == "qoshish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<i>Kanalingiz manzilini yuborishdan avval botni kanalingizga admin qilib olishingiz kerak!</i>

📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> <code>@Hackerlar_Time</code>",
'parse_mode'=>'html',
'reply_markup'=>$bosh,
]);
file_put_contents("step/$cid2.step","add-channel");
exit();
}

if($step == "add-channel"){
if(in_array($cid,$admin)){
if(isset($text)){		
if(mb_stripos($text, "@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
if($kanal == null){
file_put_contents("tizim/kanal.txt",$text);
}else{
file_put_contents("tizim/kanal.txt","\n".$text,FILE_APPEND);
}
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>$text qo'shildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu kanalda admin emas!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kanal manzilini to'g'ri yuboring:</b>
Namuna: <code>@Hackerlar_Time</code>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($data == "ochirish"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
'text'=>"<b>O'chirilishi kerak bo'lgan kanalning manzilini yuboring:

Namuna:</b> <code>@Hackerlar_Time</code>",
'parse_mode'=>'html',
'reply_markup'=>$boshqarish,
]);
file_put_contents("step/$cid2.step","remove-channel");
exit();
}

if($step == "remove-channel"){
if(in_array($cid,$admin)){
if(isset($text)){	
if(mb_stripos($text, "@")!==false){
if(mb_stripos($kanal, $text)!==false){
$soni = substr_count($kanal,"@");
if($soni != "1"){
$files = file_get_contents("tizim/kanal.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("tizim/kanal.txt",$file);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>$text o'chirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>$text o'chirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
unlink("tizim/kanal.txt");
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ro'yxatdan topilmadi!</b>
Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kanal manzilini to'g'ri yuboring:</b>
Namuna: <code>@Hackerlar_Time</code>",
'parse_mode'=>'html',
]);
exit();
}
}
}
}

if($data == "royxat"){
$soni = substr_count($kanal,"@");
if($kanal == null){
$text = "<b>Hech qanday kanallar ulanmagan!</b>";
}else{
$text = "<b>📢 Kanallar ro'yxati:</b>

$kanal

<b>Ulangan kanallar soni:</b> $soni ta";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>$text,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Orqaga",'callback_data'=>"majburiy"]],
]
])
]);
}

if($text == "📓 Qoidalar"){
	if(in_array($cid,$admin)){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
]);
file_put_contents("step/$cid.step",'qoida');
exit();
}
}

if($step == "qoida"){
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("tizim/qoida.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}
}
}

if($text == "🤖 Botlar"){
	if(in_array($cid,$admin)){
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"🤖 <b>Botlarni sozlash bo'limidasiz:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"📂 Kategoriyalar",'callback_data'=>"kategoriya"]],
	[['text'=>"🤖 Botlarni sozlash",'callback_data'=>"BotSet"]],
	[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"toza"]],
	[['text'=>"⬆️ Avto yangilash",'callback_data'=>"updateavto"]],
]
])
]);
exit();
}
}

if($data == "bbosh"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"🤖 <b>Botlarni sozlash bo'limidasiz:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"📂 Kategoriyalar",'callback_data'=>"kategoriya"]],
	[['text'=>"🤖 Botlarni sozlash",'callback_data'=>"BotSet"]],
	[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"toza"]],
	[['text'=>"⬆️ Avto yangilash",'callback_data'=>"updateavto"]],
]
])
]);
exit();
}

if($data == "updateavto"){
	if(in_array($cid2,$admin)){
	bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Yangilanish vaqtini yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
]);
file_put_contents("step/$cid2.step",'auto');
exit();
}
}

if($step == "auto"){
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("step/auto.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yangilanadigan bot turini yuboring:</b>",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step",'auto2');
exit();
}
}
}

if($step == "auto2"){
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("step/auto2.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"✅ <b>Avto yangilanish o'rnatildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
unlink("step/$cid2.step");
exit();
}
}
}

if($data == "toza"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>⚠️ Ushbu holatda bo'limlarni tozalasangiz, keyinchalik qayta tiklab bo'lmaydi</b>

Shu bilan birgalikda bo'lim, va botlarni barchasi o'chiriladi!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"barcha2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]],
]])
]);
}

if($data=="barcha2"){
	if(in_array($cid2,$admin)){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Barcha malumotlar tozlalandi</b>",
'parse_mode'=>"html",
]);
deleteFolder("bot");
}
}

if($data == "kategoriya"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🤖 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ Kategoriya qo'shish",'callback_data'=>"AdKat"]],
	[['text'=>"📄 Kategoriyalar ro'yxati",'callback_data'=>"listKat"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]
])
]);
}

if($data == "BotSet"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🤖 <b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"➕ Bot qo'shish",'callback_data'=>"AdBot"]],
	[['text'=>"📄 Botlar ro'yxati",'callback_data'=>"listBot"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]]
]
])
]);
}

if($data == "listKat"){
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title - ⚙","callback_data"=>"setKat-$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🤖 <b>Quyidagi kategoriyalardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$key,
]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Kategoriyalar mavjud emas!",
	'show_alert'=>true,
]);
}
}

if(mb_stripos($data, "setKat-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📁 <b>Kategoriya nomi:</b> $kat",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"✏ Tahrirlash",'callback_data'=>"tah-$kat"]],
	[['text'=>"🗑 O'chirish",'callback_data'=>"delKat-$kat"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"listKat"]]
]
])
]);
}

if(mb_stripos($data, "tah-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📁 <b>Kategoriya nomi:</b> $kat
	
<i>Quyidagilardan birini tanlang:</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"✏ Nomni o'zgartirish",'callback_data'=>"tahrir-$kat"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"listKat"]]
]
])
]);
}


if(mb_stripos($data, "tahrir-")!==false){
	$kat = explode("-",$data)[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Hozirgi holat:</b> $kat

<i>Yangi qiymatni yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","tahrir-$kat");
exit();
}

if(mb_stripos($step, "tahrir-")!==false){
if(in_array($cid,$admin)){
if(isset($text)){		
	$kat = explode("-",$step)[1];
	$a = str_replace($kat,$text,$kategoriya);
	file_put_contents("bot/kategoriya.txt",$a);
	rename("bot/$kat","bot/$text");
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
exit();
}
}
}

if(mb_stripos($data, "delKat-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	$k = str_replace("\n".$kat."","",$kategoriya);
   file_put_contents("bot/kategoriya.txt",$k);
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>O'chirish yakunlandi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"listKat"]]
]
])
]);
deleteFolder("bot/$kat");
}

if($data == "listBot"){
$kategoriya = file_get_contents("bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"setBot-$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($kategoriya != null){
bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🤖 <b>Quyidagi botlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$key,
]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Hech narsa topilmadi!",
	'show_alert'=>true,
]);
}
}

if(mb_stripos($data, "setBot-")!==false){
$ex = explode("-",$data);
$kat = $ex[1];
$royxat = file_get_contents("bot/$kat/royxat.txt");
$kategoriya = file_get_contents("bot/kategoriya.txt");
$more = explode("\n",$royxat);
$soni = substr_count($royxat,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title - ⚙","callback_data"=>"bset-$title-$kat"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]];
$key = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}
if($royxat != null){
bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"🤖 <b>Quyidagi botlardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$key,
]);
}else{
	bot('answerCallbackQuery',[
	'callback_query_id'=>$qid,
	'text'=>"Botlar mavjud emas!",
	'show_alert'=>true,
]);
}
}

if(mb_stripos($data, "bset-")!==false){
	$ex = explode("-",$data);
	$roy = $ex[1];
	$kat = $ex[2];
	$narx = file_get_contents("bot/$kat/$roy/narx.txt");
	$kunlik = file_get_contents("bot/$kat/$roy/kunlik.txt");
	$tavsif = file_get_contents("bot/$kat/$roy/tavsif.txt");
	$versiya = file_get_contents("bot/$kat/$roy/versiya.txt");
	$type = file_get_contents("bot/$kat/$roy/turi.txt");
	$tili = file_get_contents("bot/$kat/$roy/til.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📄 Bot nomi: <b>$roy</b>

💬 Bot tili: <b>$tili</b>
💵 Narxi: <b>$narx $valyuta</b>
🗓 Kunlik to'lov: <b>$kunlik $valyuta</b>

Qo'shimcha ma'lumotlar: <b>$tavsif</b>

🔝 Joriy versiya: <b>$versiya</b>

🎁 <i>Bonus sifatida 31 kunlik to'lov bepul taqdim etiladi!</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"✏ Tahrirlash",'callback_data'=>"tahrirlash-$kat-$roy"]],
	[['text'=>"🗑 O'chirish",'callback_data'=>"delBot-$kat-$roy-$type"]],
	[['text'=>"◀️ Orqaga",'callback_data'=>"listBot"]]
]
])
]);
}

if(mb_stripos($data, "tahrirlash-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	$roy = $ex[2];
	$narx = file_get_contents("bot/$kat/$roy/narx.txt");
	$kunlik = file_get_contents("bot/$kat/$roy/kunlik.txt");
	$tavsif = file_get_contents("bot/$kat/$roy/tavsif.txt");
	$versiya = file_get_contents("bot/$kat/$roy/versiya.txt");
	$type = file_get_contents("bot/$kat/$roy/turi.txt");
	$tili = file_get_contents("bot/$kat/$roy/til.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"📄 Bot nomi: <b>$roy</b>

💬 Bot tili: <b>$tili</b>
💵 Narxi: <b>$narx $valyuta</b>
🗓 Kunlik to'lov: <b>$kunlik $valyuta</b>

Qo'shimcha ma'lumotlar: <b>$tavsif</b>

🔝 Joriy versiya: <b>$versiya</b>

🎁 <i>Bonus sifatida 31 kunlik to'lov bepul taqdim etiladi!</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"✏ Nomni o'zgartirish",'callback_data'=>"nomi-$kat-$roy"]],
	[['text'=>"✏ Narxni o'zgartirish",'callback_data'=>"editBot-narx-$kat-$roy"],['text'=>"✏ Kunlik to'lovni o'zgartirish",'callback_data'=>"editBot-kunlik-$kat-$roy"]],
	[['text'=>"✏ Tavsifni o'zgartirish",'callback_data'=>"editBot-tavsif-$kat-$roy"]],
	[['text'=>"✏ Turini o'zgartirish",'callback_data'=>"editBot-turi-$kat-$roy"],['text'=>"✏ Bot tilini o'zgartirish",'callback_data'=>"editBot-til-$kat-$roy"]],
	[['text'=>"✏ Versiyani o'zgartirish",'callback_data'=>"editBot-versiya-$kat-$roy"]],
	[['text'=>"✏ Scriptni o'zgartirish",'callback_data'=>"script-$type"],['text'=>"◀️ Orqaga",'callback_data'=>"listBot"]]
]
])
]);
}

if(mb_stripos($data, "nomi-")!==false){
	$kat = explode("-",$data)[1];
	$roy = explode("-",$data)[2];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Hozirgi holat:</b> $roy

<i>Yangi qiymatni yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","nomi-$kat-$roy");
exit();
}

if(mb_stripos($step, "nomi-")!==false){
if(in_array($cid,$admin)){
if(isset($text)){		
	$kat = explode("-",$step)[1];
	$roy = explode("-",$step)[2];
	$royxat = file_get_contents("bot/$kat/royxat.txt");
	$a = str_replace($roy,$text,$royxat);
	file_put_contents("bot/$kat/royxat.txt",$a);
	rename("bot/$kat/$roy","bot/$kat/$text");
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
exit();
}
}
}

if(mb_stripos($data, "editBot-")!==false){
	$ex = explode("-",$data)[1];
	$kat = explode("-",$data)[2];
	$roy = explode("-",$data)[3];
$holat = file_get_contents("bot/$kat/$roy/$ex.txt");
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Hozirgi holat:</b> $holat

<i>Yangi qiymatni yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","editBot-$ex-$kat-$roy");
exit();
}

if(mb_stripos($step, "editBot-")!==false){
if(in_array($cid,$admin)){
if(isset($text)){		
	$ex = explode("-",$step)[1];
	$kat = explode("-",$step)[2];
	$roy = explode("-",$step)[3];
	file_put_contents("bot/$kat/$roy/$ex.txt",$text);
	bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
exit();
}
}
}

if(mb_stripos($data, "script-")!==false){
	$ex = explode("-",$data)[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<i>Yangi qiymatni yuboring:</i>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","kod-$ex");
exit();
}

if(mb_stripos($step, "kod-")!==false){
$ex = explode("-",$step);
$type = $ex[1];
if(in_array($cid,$admin)){
if(isset($doc)){		
$url = json_decode(file_get_contents('https://api.telegram.org/bot'.AlijonovUz.'/getFile?file_id='.$doc_id),true);
$path=$url['result']['file_path'];
$file = 'https://api.telegram.org/file/bot'.AlijonovUz.'/'.$path;
$ok = file_put_contents("bot/$type.php",file_get_contents($file));
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
        'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}
}
}

if(mb_stripos($data, "delBot-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	$roy = $ex[2];
	$type = $ex[3];
	$royxat = file_get_contents("bot/$kat/royxat.txt");
	$k = str_replace("\n".$roy."","",$royxat);
   file_put_contents("bot/$kat/royxat.txt",$k);
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>O'chirish yakunlandi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"◀️ Orqaga",'callback_data'=>"listBot"]]
]
])
]);
deleteFolder("bot/$kat/$roy");
unlink("bot/$type.php");
}


if($data == "AdKat"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Kategoriya uchun nom yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step",'AdKat');
exit();
}

if($step == "AdKat"){
if(in_array($cid,$admin)){
if(isset($text)){		
$kategoriya = file_get_contents("bot/kategoriya.txt");
file_put_contents("bot/kategoriya.txt","$kategoriya\n$text");
mkdir("bot/$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>nomli kategoriya qo'shildi.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}
}
}
	
if($data == "AdBot"){
$kategoriya = file_get_contents("bot/kategoriya.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$keys=[];
for ($for = 1; $for <= $soni; $for++) {
$title=str_replace("\n","",$more[$for]);
$keys[]=["text"=>"$title","callback_data"=>"addb-$title"];
$keysboard2 = array_chunk($keys, 1);
$keysboard2[] = [['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]];
$AdBot = json_encode([
'inline_keyboard'=>$keysboard2,
]);
}

	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>Quyidagi kategoriyalardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$AdBot
]);
}

if(mb_stripos($data, "addb-")!==false){
	$ex = explode("-",$data);
	$kat = $ex[1];
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('sendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Tanlandi.</b>

Bot uchun nom yuboring:",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","AdBot-$kat");
exit();
}

if(mb_stripos($step, "AdBot-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
if(in_array($cid,$admin)){
if(isset($text)){		
$royxat = file_get_contents("bot/$kat/royxat.txt");
file_put_contents("bot/$kat/royxat.txt","$royxat\n$text");
mkdir("bot/$kat/$text");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>nomi qabul qilindi.</b>

Bot turini yuboring:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","turi-$kat-$text");
exit();
}
}
}

//@AlijonovUz

if(mb_stripos($step, "turi-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("bot/$kat/$roy/turi.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>nomi qabul qilindi.</b>

Bot uchun narx yuboring:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","narxi-$kat-$roy-$text");
exit();
}
}
}

if(mb_stripos($step, "narxi-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if(in_array($cid,$admin)){
if(is_numeric($text)==true){		
file_put_contents("bot/$kat/$roy/narx.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>$valyuta narxi qabul qilindi.</b>

Botning kunlik to'lov narxini kiriting:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","kunlik-$kat-$roy-$type");
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
	'parse_mode'=>'html',
]);
exit();
}
}
}

if(mb_stripos($step, "kunlik-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if(in_array($cid,$admin)){
if(is_numeric($text)==true){		
file_put_contents("bot/$kat/$roy/kunlik.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>$valyuta kunlik to'lov narxi qabul qilindi.</b>

Bot versiyasini kiriting:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","versiya-$kat-$roy-$type");
exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
	'parse_mode'=>'html',
]);
exit();
}
}
}

if(mb_stripos($step, "versiya-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("bot/$kat/$roy/versiya.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>versiya qabul qilindi.</b>

Bot tilini kiriting:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","tili-$kat-$roy-$type");
exit();
}
}
}


if(mb_stripos($step, "tili-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("bot/$kat/$roy/til.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>bot tili qabul qilindi.</b>

Bot uchun tavsif kiriting:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","tavsif-$kat-$roy-$type");
exit();
}
}
}

if(mb_stripos($step, "tavsif-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if(in_array($cid,$admin)){
if(isset($text)){		
file_put_contents("bot/$kat/$roy/tavsif.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi.</b>

Bot scriptini yuboring:",
	'parse_mode'=>'html',
]);
file_put_contents("step/$cid.step","script-$kat-$roy-$type");
exit();
}
}
}

if(mb_stripos($step, "script-")!==false){
$ex = explode("-",$step);
$kat = $ex[1];
$roy = $ex[2];
$type = $ex[3];
if(in_array($cid,$admin)){
if(isset($doc)){		
$url = json_decode(file_get_contents('https://api.telegram.org/bot'.AlijonovUz.'/getFile?file_id='.$doc_id),true);
$path=$url['result']['file_path'];
$file = 'https://api.telegram.org/file/bot'.AlijonovUz.'/'.$path;
$ok = file_put_contents("bot/$type.php",file_get_contents($file));
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Yangi bot qo'shildi.</b>",
	'parse_mode'=>'html',
        'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}
}
}
	
if($text == "📋 Adminlar"){
if(in_array($cid,$admin)){
	if($cid == $AlijonovUz){
	bot('SendMessage',[
	'chat_id'=>$AlijonovUz,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
	[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}else{	
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}
}

if($data == "admins"){
if($cid2 == $AlijonovUz){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);	
bot('SendMessage',[
	'chat_id'=>$AlijonovUz,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"➕ Yangi admin qo'shish",'callback_data'=>"add"]],
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
	[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}else{
bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);	
bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
   [['text'=>"📑 Ro'yxat",'callback_data'=>"list"]],
[['text'=>"Orqaga",'callback_data'=>"boshqarish"]]
	]
	])
	]);
	exit();
}
}

if($data == "list"){
$add = str_replace($AlijonovUz,"",$admins);
if($admins == $AlijonovUz){
	$text = "<b>Yordamchi adminlar topilmadi!</b>";
}else{
		$text = "<b>👮 Adminlar ro'yxati:</b>
$add";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>$text,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Orqaga",'callback_data'=>"admins"]],
]
])
]);
}

if($data == "add"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","add-admin");
exit();
}
if($step == "add-admin" and $cid == $AlijonovUz){
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>

Boshqa ID raqamni kiriting:",
'parse_mode'=>'html',
]);
exit();
}elseif((mb_stripos($admins, $text)!==false) or ($text != $AlijonovUz)){
if($admins == null){
file_put_contents("tizim/admins.txt",$text);
}else{
file_put_contents("tizim/admins.txt","\n".$text,FILE_APPEND);
}
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<code>$text</code> <b>adminlar ro'yxatiga qo'shildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi adminlari ro'yxatida mavjud!</b>

Boshqa ID raqamni kiriting:",
'parse_mode'=>'html',
]);
exit();
}
}

if($data == "remove"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","remove-admin");
exit();
}

if($step == "remove-admin" and $cid == $AlijonovUz){
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = '$text'");
$row = mysqli_fetch_assoc($result);
if(!$row){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>

Boshqa ID raqamni kiriting:",
'parse_mode'=>'html',
]);
exit();
}elseif((mb_stripos($admins, $text)!==false) or ($text != $AlijonovUz)){
$files = file_get_contents("tizim/admins.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("tizim/admins.txt",$file);
bot('SendMessage',[
'chat_id'=>$AlijonovUz,
'text'=>"<code>$text</code> <b>adminlar ro'yxatidan olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel
]);
unlink("step/$cid.step");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi adminlari ro'yxatida mavjud emas!</b>

Boshqa ID raqamni kiriting:",
'parse_mode'=>'html',
]);
exit();
}
}

if($data == "qoshimcha"){	
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
'text'=>"<b>Quyidagilardan birini tanlang:</b>

- bonus uchun kanal: $kbonus
- guruh: $guruh1",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🆕️ Bonus uchun",'callback_data'=>"kbonus"]],
[['text'=>"1️⃣ - GURUH",'callback_data'=>"guruh1"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]]
]
])
]);
}

if($data == "kbonus"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<i>Kanalingiz manzilini yuborishdan avval botni kanalingizga admin qilib olishingiz kerak!</i>

📢 <b>Kerakli kanalni manzilini yuboring:

Namuna:</b> <code>@Hackerlar_Time</code>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step","kbonus");
	exit();
}

if(($step == "kbonus") and (in_array($cid,$admin))){
if(mb_stripos($text,"@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
file_put_contents("tizim/kanal3.txt","@$ch_user");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qabul qilindi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu kanalda admin emas!</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kanal manzilini to'g'ri yuboring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($data == "guruh1"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<i>Guruhingiz manzilini yuborishdan avval botni kanalingizga admin qilib olishingiz kerak!</i>

📢 <b>Kerakli guruh manzilini yuboring:

Namuna:</b> <code>@RiseBuilderUzChat</code>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step","guruh1");
	exit();
}

if(($step == "guruh1") and (in_array($cid,$admin))){
if(mb_stripos($text,"@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
$ch_id = $get->result->id;
if(getAdmin($ch_user)== true){
file_put_contents("tizim/guruh1.txt","@$ch_user");
file_put_contents("tizim/gr1.txt","$ch_id");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Qabul qilindi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.step");
exit();
}else{
	bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu guruhda admin emas!</b>",
'parse_mode'=>'html',
]);
exit();
}
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>guruh manzilini to'g'ri yuboring:</b>",
'parse_mode'=>'html',
]);
exit();
}
}

if($text == "⚙ Avto to'lov"){
	if(in_array($cid, $admin)){
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"<b>Quyidagi to'lov tizimlaridan birini tanlang:</b>",
		'parse_mode'=>'html',
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
	 [['text'=>"🔹️ PAYME",'callback_data'=>"avtopay"]],
		[['text'=>"Orqaga",'callback_data'=>"yopish"]],
		]
		])
		]);
		exit();
	}
}

if($data == "avtopay"){
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>Quyidagilardan birini tanlang:</b>",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
		'inline_keyboard'=>[
	    [['text'=>"🗑 O'chirish",'callback_data'=>"delpay"],['text'=>"🔹️ PAYME Card",'callback_data'=>"editpay"]],
		[['text'=>"Orqaga",'callback_data'=>"boshqarish"]],
		]
		])
	]);
}

if($data == "delpay"){
	unlink("tizim/payme.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"✅ <b>PAYME hamyon faolsizlantirildi!</b>
	
	Qayta faollashtirish uchun, PAYME hamyon qo'shishingiz kerak!",
	'parse_mode'=>'html',
			'reply_markup'=>json_encode([
		'inline_keyboard'=>[	   
		[['text'=>"Orqaga",'callback_data'=>"avtopay"]],
		]
		])
	]);
}

if($data == "editpay"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('SendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi qiymatni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bosh
]);
file_put_contents("step/$cid2.step","autopay");
exit();
}

if($step == "autopay"){
	if(in_array($cid, $admin)){
		if(isset($text)){
			file_put_contents("tizim/payme.txt", $text);
			bot('sendMessage',[
			'chat_id'=>$cid,
			'text'=>"<b>Qabul qilindi!</b>",
			'parse_mode'=>'html',
			'reply_markup'=>$panel
			]);
			unlink("step/$cid.step");
			exit();
		}
	}
}

if($text == "⚙ Asosiy sozlamalar"){
		if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>⚙️ Asosiy sozlamalar bo'limiga xush kelibsiz!</b>

<i>Nimani o'zgartiramiz?</i>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	exit();
}
}

if($text == "*️⃣ Birlamchi sozlamalar"){
		if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>*️⃣  Birlamchi sozlamalar bo'limidasiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko'rish",'callback_data'=>"holat"]],
[['text'=>"💶 Valyuta",'callback_data'=>"valyuta"],['text'=>"💸 Taklif narxi",'callback_data'=>"narx"]],
[['text'=>"📎 Admin useri",'callback_data'=>"admin"]],
[['text'=>"👑 Premium",'callback_data'=>"pprice"],['text'=>"➕ A'zo narxi",'callback_data'=>"gpul"]],
[['text'=>"🎫 CreateCard",'callback_data'=>"price_cc"],['text'=>"🎫 FeeCard",'callback_data'=>"price_fc"]],
[['text'=>"🔹️ Cashbackni sozlash",'callback_data'=>"cashback"]],
] 
])
]);
exit();
}
}

if($data == "birlamchi"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>*️⃣  Birlamchi sozlamalar bo'limidasiz.</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holatni ko'rish",'callback_data'=>"holat"]],
[['text'=>"💶 Valyuta",'callback_data'=>"valyuta"],['text'=>"💸 Taklif narxi",'callback_data'=>"narx"]],
[['text'=>"📎 Admin useri",'callback_data'=>"admin"]],
[['text'=>"👑 Premium",'callback_data'=>"pprice"],['text'=>"➕ A'zo narxi",'callback_data'=>"gpul"]],
[['text'=>"🎫 CreateCard",'callback_data'=>"price_cc"],['text'=>"🎫 FeeCard",'callback_data'=>"price_fc"]],
[['text'=>"🔹️ Cashbackni sozlash",'callback_data'=>"cashback"]],
]
])
]);
exit();
}

if($data == "holat"){
bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"<b>Kuting...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Hozirgi birlamchi sozlamalar:</b>

<i>1. Valyuta - $valyuta
2. Taklif narxi - $taklif $valyuta
3. Admin useri: $user
4. Guruhga odaml qo'shuv narxi $gpul $valyuta
5. Premium narxi: $cVip $valyuta
6. CreateCard narxi: $card_cc $valyuta
7. FeeCard narxi: $card_fc $valyuta </i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"birlamchi"]],
]
])
]);
}

if($data == "cashback"){
if($cash == "Yoqilgan"){
$b = "«✅»";
$c = "❌";
}else{
$b = "✅";
$c = "«❌»";
}
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Hozirgi holat:</b>

<i>1. Cashback - $cashback%
2. Holati - $cash</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔹️ Cashback",'callback_data'=>"cash"]],
[['text'=>"$b",'callback_data'=>"cas-on"],['text'=>"$c",'callback_data'=>"cas-off"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"birlamchi"]],
]
])
]);
}

if(mb_stripos($data, "cas-")!==false){
	$ex = explode("-", $data)[1];
if($ex == "on"){
	$a = "Yoqilgan";
}else{
	$a = "O'chirilgan";
}
if($ex == "on"){
$b = "«✅»";
$c = "❌";
}else{
$b = "✅";
$c = "«❌»";
}
file_put_contents("tizim/cash.txt",$a);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       'text'=>"<b>Hozirgi holat:</b>

<i>1. Cashback - $cashback%
2. Holati - $a</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔹️ Cashback",'callback_data'=>"cash"]],
[['text'=>"$b",'callback_data'=>"cas-on"],['text'=>"$c",'callback_data'=>"cas-off"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"birlamchi"]],
]
])
]);
}

if($data == "price_cc"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh2,
	]);
	file_put_contents("step/$cid2.step",'price_cc');
	exit();
}

if($step == "price_cc"){
		if(in_array($cid,$admin)){
			if(isset($text) and is_numeric($text)==true){
	file_put_contents("tizim/cc.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh2
	]);
	exit();
}
}
}

if($data == "price_fc"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'price_fc');
	exit();
}

if($step == "price_fc"){
		if(in_array($cid,$admin)){
			if(isset($text) and is_numeric($text)==true){
	file_put_contents("tizim/fc.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh2
	]);
	exit();
}
}
}

if($data == "cash"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'cashback');
	exit();
}

if($step == "cashback"){
	if(in_array($cid,$admin)){
	if(isset($text)){
file_put_contents("tizim/cashback.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qabul qilindi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "pprice"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'pprice');
	exit();
}

if($step == "pprice"){
		if(in_array($cid,$admin)){
			if(isset($text) and is_numeric($text)==true){
	file_put_contents("tizim/cvip.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$panel2,
	]);
	unlink("step/$cid.step");
	exit();
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh2
	]);
	exit();
}
}
}

if($data == "valyuta"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'valyuta');
	exit();
}

if($step == "valyuta"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/valyuta.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "admin"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'admin');
	exit();
}

if($step == "admin"){
		if(in_array($cid,$admin)){
	if(isset($text)){
        file_put_contents("tizim/user.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "narx"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'taklif');
	exit();
}

if($step == "taklif"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/taklif.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "gpul"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'gpul');
	exit();
}

if($step == "gpul"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/gpul.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "minbonus"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'bonusmin');
	exit();
}

if($step == "bonusmin"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/bonusmin.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "maxbonus"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'bonusmax');
	exit();
}

if($step == "bonusmax"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/bonusmax.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "oladib"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'oladib');
	exit();
}

if($step == "oladib"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/bonusoladi.txt",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($data == "bonustime"){
	bot('deleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	  'text'=>"📝 <b>Yangi qiymatni yuboring:</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$bosh,
	]);
	file_put_contents("step/$cid2.step",'bonustime');
	exit();
}

if($step == "bonustime"){
		if(in_array($cid,$admin)){
	if(isset($text)){
	file_put_contents("tizim/bonustime.time",$text);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
	'parse_mode'=>'html',
	'reply_markup'=>$asosiy,
	]);
	unlink("step/$cid.step");
	exit();
}
}
}

if($text == "🎲 O'yin sozlamalari"){
		if(in_array($cid,$admin)){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🎲 O'yin sozlamalar bo'limidasiz.
	
1. Bonus oladi: $bonusoladi nafar
2. Minimal yutuq miqdori: $bonusmin $valyuta
3. Maksimal yutuq miqdori: $bonusmax $valyuta
4. O'yin holati: $bonusstatus

Navbatdagi o'yin $bonustime</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👥 Oladiganlar",'callback_data'=>"oladib"]],
[['text'=>"🔻 Min.",'callback_data'=>"minbonus"],['text'=>"🔺 Max.",'callback_data'=>"maxbonus"]],
[['text'=>"🧭 Keyingi o'yin soati",'callback_data'=>"bonustime"]],
[['text'=>"✅ Holatni o'zgartish",'callback_data'=>"bonusholat"]]
] 
])
]);
exit();
}
}

if($data == "bonusholat"){
	bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
	'text'=>"<b>Hozirgi holat:</b> $bonusstatus",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"statusbonus-✅"],['text'=>"❌",'callback_data'=>"statusbonus-❌"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
exit();
}

if(mb_stripos($data, "statusbonus-")!==false){
$ex = explode("-",$data);
$bonusstatus = $ex[1];
file_put_contents("tizim/bonusstatus.txt",$bonusstatus);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
       	'text'=>"<b>Hozirgi holat:</b> $bonusstatus",
	'parse_mode'=>'html',
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"statusbonus-✅"],['text'=>"❌",'callback_data'=>"statusbonus-❌"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]]
]
])
]);
}

if($soat == $bonustime){
$status = file_get_contents("tizim/bonusstatus.txt");
if($status == "✅"){
$soat = date('H:i',strtotime('+12 hour'));
file_put_contents("tizim/bonustime.time",$soat);
bot('deleteMessage',[
'chat_id'=>"$kbonus",
'message_id'=>$post1,
]);
$mes = bot('sendmessage',[
'chat_id'=>"$kbonus",
'text'=>"<b>🚀 O'yin boshlandi!</b>

🏦 Yutib olingan pullar: <b>0</b> $valyuta
👥 Oʻyinda qatnashganlar: <b>0/$bonusoladi</b> ta
🧭 Navbatdagi o'yin: <b>$bonustime</b> da

🛠 Bot admini: <b>@$user</b>

🤖 <b>Bizning bot: @$bot</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎰 Bonus olish","url"=>"https://t.me/$bot?start=bonus"]],
]])
])->result->message_id;
file_put_contents("step/mesid.txt",$mes);
file_put_contents("bonus/bonus/member.txt",$bonusoladi);
file_put_contents("bonus/bonus/olindi.txt","");
file_put_contents("bonus/bonus/yutuq.txt","");
}else{
}
}

if($text == "/start bonus"){
$s = file_get_contents("bonus/bonus/yutuq.txt");
if(mb_stripos($s,$cid)!==false){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>🙅‍♂ Bu o‘yinda ishtirok etgansiz!</b>",
'parse_mode'=>"html",
]);
}else{
$r=["limon","olma","banan","nok"];
$nom=$r[rand(0,2)];
if($nom=="limon"){
$tur="limon";
$arr=json_encode([
'inline_keyboard'=>[
[['text'=>"🍏",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍋",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=$tur"],['text'=>"🍐",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍌",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"]],
]]);
}
if($nom=="olma"){
$tur="olma";
$arr=json_encode([
'inline_keyboard'=>[
[['text'=>"🍋",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍌",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍏",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=$tur"],['text'=>"🍐",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"]],
]]);
}
if($nom=="nok"){
$tur="nok";
$arr=json_encode([
'inline_keyboard'=>[
[['text'=>"🍌",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍋",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍐",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=$tur"],['text'=>"🍏",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"]],
]]);
}
if($nom=="banan"){
$tur="banan";
$arr=json_encode([
'inline_keyboard'=>[
[['text'=>"🍐",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍌",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=$tur"],['text'=>"🍏",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"],['text'=>"🍋",'callback_data'=>"yutuq=".rand($bonusmin,$bonusmax)."=null"]],
]]);
}
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"🤖 Mevalar ichidan <b>$nom</b>ni toping:",
'parse_mode'=>"html",
'reply_markup'=>$arr,
]);
file_put_contents("bonus/fayl/$cid.code",$tur);
}}

if((stripos($data,"yutuq=")!==false)){
$pulingiz=explode("=",$data)[1];
$t=explode("=",$data)[2];
$s=file_get_contents("bonus/bonus/yutuq.txt");
$so=file_get_contents("bonus/bonus/olindi.txt");
$o=file_get_contents("bonus/bonus/member.txt");
$cc=file_get_contents("bonus/bonus/yutuq.txt");
$c=substr_count($cc,"\n");
if($c==$o or $o==$c or $c == "$o" or $o == "$c"){
bot('deletemessage',[
'chat_id'=>"$kbonus",
'message_id'=>$post1,
]);
$mes = bot('sendmessage',[
'chat_id'=>"$kbonus",
'text'=>"<b>🙅‍♂ Oʻyin tugadi!</b>

🏦 Yutib olingan pullar: <b>$so</b> $valyita
👥 Oʻyinda qatnashganlar: <b>$c/$o</b> ta
🧭 Navbatdagi o'yin: <b>$date</b> da

🛠 Bot admini: <b>@$user</b>

🤖 <b>Bizning bot: @$bot</b>",
'parse_mode'=>'html',
])->result->message_id;
sleep(10);
file_put_contents("step/mesid.txt",$mes);
deleteFolder("bonus/fayl");
deleteFolder("bonus/bonus");
}else{
if(mb_stripos($s,$cid2)!==false){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🙅‍♂ Bu o‘yinda ishtirok etgansiz!</b>",
'parse_mode'=>'html',
]);
}else{
$yt = file_get_contents("bonus/fayl/$cid2.code");
if($t == $yt){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
$frid= $alijonov->callback_query->from->id;
$os = file_get_contents("bonus/bonus/olindi.txt");
file_put_contents("bonus/bonus/olindi.txt",$os+$pulingiz);
$olindi = file_get_contents("bonus/bonus/olindi.txt");
$p = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM kabinet WHERE user_id = $cid2"))['pul'];
$bonus = $p + $pulingiz;
mysqli_query($connect, "UPDATE kabinet SET pul = '$bonus' WHERE user_id = $cid2");
$yutuq = file_get_contents("bonus/bonus/yutuq.txt");
file_put_contents("bonus/bonus/yutuq.txt",$yutuq."\n".$frid);
$yutuq = substr_count(file_get_contents("bonus/bonus/yutuq.txt"),"\n");
$berilgan = file_get_contents("bonus/bonus/member.txt");
bot('sendDice',[
'emoji'=>"🎰",
'chat_id'=>$cid2,
])->result->dice->value;
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>💰 Sizga $pulingiz $valyuta taqdim etildi!</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>"$kbonus",
'message_id'=>$post1,
'text'=>"<b>🎲 O'yin boshlandi!</b>

🏦 Yutib olingan pullar: <b>$olindi</b> $vslyuta
?? Oʻyinda qatnashganlar: <b>$yutuq/$berilgan</b> ta
🧭 Navbatdagi o'yin: <b>$bonustime</b> da

🛠 Bot admini: <b>@$user</b>

🤖 <b>Bizning bot: @$bot</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🎰 Bonus olish","url"=>"https://t.me/$bot?start=bonus"]],
]])
]);
}else{
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>🤷🏻‍♂ Boshqa mevani tandladingiz!</b>",
'parse_mode'=>'html',
]);
unlink("bonus/fayl/$cid2.code");
}
}
}
}

$new = $message->new_chat_member;
$newid = $new->id;
$uid = $message->from->id;
$is_bot = $new->is_bot;
$is_bot = $message->new_chat_member->is_bot;
$left = $message->left_chat_member;
$leftid = $left->id;
$group = "$gr1_id";

if(isset($new) and $is_bot == false){
if($newid !== $uid){
if($cid==$group or $group==$cid){
if(file_exists("add/$uid/qoshdi.txt")){
$res = mysqli_query($connect, "SELECT * FROM `kabinet` WHERE `user_id` = '$uid'"); 
$a = mysqli_fetch_assoc($res); 
$us = $a['pul']; 
$miqdor = $us + $gpul;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$miqdor' WHERE `user_id` = '$uid'");
file_get_contents("https://api.telegram.org/bot".AlijonovUz."/sendMessage?chat_id=$cid&text=<b>☑️ Guruhga odam qo'shdingiz va sizga $gpul $valyuta berildi</b>&parse_mode=html");
}else{
file_get_contents("https://api.telegram.org/bot".AlijonovUz."/sendMessage?chat_id=$uid&text=<b>☑️ Guruhga odam qo'shdingiz va sizga $gpul $valyuta berildi</b>&parse_mode=html");
$res = mysqli_query($connect, "SELECT * FROM `kabinet` WHERE `user_id` = '$uid'"); 
$a = mysqli_fetch_assoc($res); 
$us = $a['pul']; 
$miqdor = $us + $gpul;
mysqli_query($connect, "UPDATE `kabinet` SET `pul` = '$miqdor' WHERE `user_id` = '$uid'");
}
}else{
file_get_contents("https://api.telegram.org/bot".AlijonovUz."/sendMessage?chat_id=$uid&text=<b>🙁 Afuskiy men $guruh1 ga odam qo'shsangiz pul beraman!</b>&parse_mode=html");
}
}
}

if($text == "🏆 Konkurs"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Konkurs matni",'callback_data'=>"textkon"]],
[['text'=>"🗑️ Tozalash",'callback_data'=>"delkon"],['text'=>"🏆 TOP soni",'callback_data'=>"topkon"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]],
]]),
]);
exit();
}}

if($data=="setkonkurs"){
bot('editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'text'=>"<b>📋 Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Konkurs matni",'callback_data'=>"textkon"]],
[['text'=>"🗑️ Tozalash",'callback_data'=>"delkon"],['text'=>"🏆 TOP soni",'callback_data'=>"topkon"]],
[['text'=>"Yopish",'callback_data'=>"yopish"]],
]]),
]);
exit();
}

if($data=="textkon"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi qiymatni kiriting:</b>",
'parse_mode'=>html,
'reply_markup'=>$bosh2,
]);
file_put_contents("step/$cid2.step",'k-matn');
exit();
}

if($step=="k-matn"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli saqlandi</b>",
'parse_mode'=>html,
'reply_markup'=>$panel2
]);
file_put_contents("tizim/k-matn.txt",$text);
}

if($data=="topkon"){
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
bot('sendMessage',[
'chat_id'=>$cid2,
'text'=>"<b>Yangi qiymatni kiriting:</b>",
'parse_mode'=>html,
'reply_markup'=>$bosh2,
]);
file_put_contents("step/$cid2.step",'k-top');
exit();
}

if($step=="k-top"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli saqlandi</b>",
'parse_mode'=>html,
'reply_markup'=>$panel2
]);
file_put_contents("tizim/k-top.txt",$text);
}

if($data=="delkon"){
bot('Editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'parse_mode'=>html,
'text'=>"⁉️ <b>O'chirasizmi?</b>",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅",'callback_data'=>"delref"],['text'=>"❌",'callback_data'=>"setkonkurs"]],
]]),
]);
exit();
}

if($data=="delref"){
$yu = mysqli_query($connect,"SELECT * FROM kabinet");
while($do = mysqli_fetch_assoc($yu)){
$id = $do['user_id'];
mysqli_query($connect,"UPDATE kabinet SET odam = '0' WHERE user_id = $id");
}
$num = mysqli_num_rows($yu);
bot('Editmessagetext',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
'parse_mode'=>html,
'text'=>"✅ <b>$num ta foydalanuvchi referallari tozalandi.</b>",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"▶️ Orqaga",'callback_data'=>"setkonkurs"]],
]]),
]);
exit();
}

?>