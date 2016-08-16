<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.

namespace Smuze;

class Smuze
{
    public static $privateKey;
    
    public static $apiBase = 'http://localhost:3000/api/';
    //public static $apiBase = 'https://9860a4c2.ngrok.io/api';


    public static $apiVersion = null;

    public static $accountId = null;

    const VERSION = '1.0';
    
    public static function getApiBase()
    {
        return self::$apiBase;
    }

    public static function getPrivateKey()
    {
        return self::$privateKey;
    }

    public static function setPrivateKey($privateKey)
    {
        self::$privateKey = $privateKey;
    }

    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }


    public static function getAccountId()
    {
        return self::$accountId;
    }

    public static function setAccountId($accountId)
    {
        self::$accountId = $accountId;
    }
    
    public function jsondata($data){
		return json_encode($data); 		
	}
    
    public function request($method, $url, $params = null, $headers = null){
		if (!$params) {
            $params = array();
        }
        if (!$headers) {
            $headers = array();
        }

        return Smuze::doRequest($method, $url, $params, $headers);
	}
	
	private function doRequest($method, $url, $params, $headers){
		
		$myPrivateKey = $privateKey;
        if (!$myPrivateKey) {
            $myPrivateKey = Smuze::$privateKey;
        }
		

        if (!$myPrivateKey) {
            echo "Missing Private Key";
        }


        if (!$headers) {
            $headers = array(
                'Authorization: '.Smuze::$privateKey,
                'Content-Type: application/json'                                                                               
            );
        }
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
		curl_close($curl);
		
        
        return $result;
	}
}
