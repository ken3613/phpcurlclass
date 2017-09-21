<?php
define('UA_PC','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36');
define('COOKIEMETHOD_NULL',0);
define('COOKIEMETHOD_STRING',1);
define('COOKIEMETHOD_FILE',2);
class curl{
	public $url;
	public $rCookie;
	public $sCookieMethod;
	public function __construct($url,$sCookieMethod){
		$this->url=$url;
		$this->sCookieMethod=$sCookieMethod;
	}
	public function curlget($sendCookie,$sReferer,$sUA){
		$client=curl_init();
		curl_setopt($client,CURLOPT_HEADER,0);
		curl_setopt($client,CURLOPT_HTTPGET,1);
		curl_setopt($client,CURLOPT_URL,$this->url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
		if(!empty($sReferer)){
			curl_setopt($client,CURLOPT_REFERER,$sReferer);
		}
		if(!empty($sUA)){
			curl_setopt($client,CURLOPT_USERAGENT,$sUA);
		}
		switch($this->sCookieMethod){
			case 0:
				break;
			case 1:
				curl_setopt($client,CURLOPT_COOKIE,$sendCookie);
				break;
			case 2:
				curl_setopt($client,CURLOPT_COOKIEFILE,$sendCookie);
				break;
			default:
				break;
		}
		$this->rCookie=tempnam('./temp','rcookie');
		curl_setopt($client,CURLOPT_COOKIEJAR,$this->rCookie);
		$data=curl_exec($client);
		curl_close($client);
		return $data;
	}
	public function curlpost($formvalue,$sendCookie,$sReferer,$sUA){
		$client=curl_init();
		curl_setopt($client,CURLOPT_POST,1);
		curl_setopt($client,CURLOPT_URL,$this->url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($client,CURLOPT_POSTFIELDS,$formvalue);
		if(!empty($sReferer)){
			curl_setopt($client,CURLOPT_REFERER,$sReferer);
		}
		if(!empty($sUA)){
			curl_setopt($client,CURLOPT_USERAGENT,$sUA);
		}
		switch($this->sCookieMethod){
			case 0:
				break;
			case 1:
				curl_setopt($client,CURLOPT_COOKIE,$sendCookie);
				break;
			case 2:
				curl_setopt($client,CURLOPT_COOKIEFILE,$sendCookie);
				break;
			default:
				break;
		}
		$this->rCookie=tempnam('./temp','rcookie');
		curl_setopt($client,CURLOPT_COOKIEJAR,$this->rCookie);
		$data=curl_exec($client);
		curl_close($client);
		return $data;
	}
}
?>