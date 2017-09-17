<?php
class curl{
	public $url;
	public function __construct($url){
		$this->url=$url;
	}
	public function curlget(){
		$client=curl_init();
		curl_setopt($client,CURLOPT_HEADER,0);
		curl_setopt($client,CURLOPT_HTTPGET,1);
		curl_setopt($client,CURLOPT_URL,$this->url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
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