<?php
define('REFERER_PC','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36');
class curl{
	public $url;
	public $rCookie;
	public function __construct($url){
		$this->url=$url;
	}
	public function curlget($sendCookie,$sReferer){
		$client=curl_init();
		curl_setopt($client,CURLOPT_HEADER,0);
		curl_setopt($client,CURLOPT_HTTPGET,1);
		curl_setopt($client,CURLOPT_URL,$this->url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
		if(empty($sReferer)){
			curl_setopt($client,CURLOPT_REFERER,REFERER_PC);
		}
		else
		{
			curl_setopt($client,CURLOPT_REFERER,$sReferer);
		}
		if(!empty($sendCookie)){
			curl_setopt($client,CURLOPT_COOKIE,$sendCookie);
		}
		$this->rCookie=tempnam('./temp','rcookie');
		curl_setopt($client,CURLOPT_COOKIEJAR,$this->rCookie);
		$data=curl_exec($client);
		curl_close($client);
		return $data;
	}
	public function curlpost($formvalue){
		$client=curl_init();
		curl_setopt($client,CURLOPT_POST,1);
		curl_setopt($client,CURLOPT_URL,$this->url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($client,CURLOPT_POSTFIELDS,$formvalue);
		$data=curl_exec($client);
		curl_close($client);
		return $data;
	}
}
?>