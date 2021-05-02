<?php
function login($user,$pass){
	       
$http = curl_init();
curl_setopt($http,CURLOPT_URL,'https://www.instagram.com/');
curl_setopt($http,CURLOPT_RETURNTRANSFER,1);
curl_setopt($http,CURLOPT_HEADER,1);
curl_setopt($http,CURLOPT_HTTPHEADER,array('User-Agent: Mozilla/5.0 (Linux; Android 7.0; Griffe T2 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36'));
$response = curl_exec($http);
$header_size = curl_getinfo($http, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
$head = array(
	'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36',
	'x-csrftoken: '.$cookies['csrftoken'],
	'mid: '.$cookies['mid']);
//print_r ($head);
//$http = curl_init();
curl_setopt($http,CURLOPT_URL,'https://www.instagram.com/accounts/login/ajax/');
curl_setopt($http,CURLOPT_RETURNTRANSFER,1);
curl_setopt($http,CURLOPT_HTTPHEADER,$head);
$data = array(
	    'username'=>$user,
            'enc_password'=>'#PWD_INSTAGRAM_BROWSER:0:1589682409:'.$pass,
            'queryParams'=>'{}',
            'optIntoOneTap'=>'false',
);
curl_setopt($http,CURLOPT_POST,1);
curl_setopt($http,CURLOPT_POSTFIELDS,$data);
//$yy = curl_exec($http);
$response = curl_exec($http);
$header_size = curl_getinfo($http, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
						     
$CookieStr = "";
foreach($matches[1] as $item) {
$CookieStr .= $item."; ";}
//print ($CookieStr);

if (strpos($CookieStr,'sessionid')!==false){
	   	     
return $CookieStr;}

else{
return 'False';}

}

