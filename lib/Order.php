<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.
namespace Smuze;
class Order
{
    
    public static function create($cart, $params = null)
    {
    	if (!$cart) {
    		//throw("Cart missing", 123);
    		return false;
        }
    	if (!$params) {
            $params = array();
        }
        
        
        $params['cart'] = $cart;
        $params = \Smuze\Smuze::jsondata($params);
        
        $order = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/checkout", $params);
        	
        return $order;
    }

    public static function get($token)
    {
       
        $order = \Smuze\Smuze::request("GET", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token);
            
        return json_decode($order);
    }



    public static function update($token, $cart, $params = null)
    {
        if (!$cart) {
            return false;
        }
        if (!$params) {
            $params = array();
        }
        
        
        $params['cart'] = $cart;
        $params = \Smuze\Smuze::jsondata($params);
        
        $order = \Smuze\Smuze::request("PATCH", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token, $params);
            
        return $order;
    }



    public static function capture($token){
        // set capture = true
        $params = [];
        $order = \Smuze\Smuze::request("PATCH", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token."/capture", $params);
    }

    public static function credit($token){
        // set capture = true
        $params = [];
        $order = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token."/credit", $params);
    }


}
