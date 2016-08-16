<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.
namespace Smuze;
class Order
{
    // Gets order, returns already created order object in JSON
    public static function get($token)
    {
        $order = \Smuze\Smuze::request("GET", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token);
            
        return json_decode($order);
    }


    // Updates order returns updated order object in JSON
    public static function update($token, $cart, $params = null)
    {
        try {        
            if (!$cart) {
                throw new Exception("Cart missing", 1);
            }

            if (!$params) {
                $params = array();
            }
            $params['cart'] = $cart;
            $params = \Smuze\Smuze::jsondata($params);
            $order = \Smuze\Smuze::request("PATCH", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token, $params);
                
            return json_decode($order);
        } catch (Exception $e) {
            echo "ERROR : " . $e;
            return false;
        }
    }

    // Creates order, returns created order object in JSON
    public static function create($cart, $params = null)
    {
        try {        
            if (!$cart) {
                throw new Exception("Cart missing", 1);
            }
            if (!$params) {
                $params = array();
            }
            
            
            $params['cart'] = $cart;
            $params = \Smuze\Smuze::jsondata($params);
            
            $order = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/checkout", $params);
                
            return json_decode($order);
        } catch (Exception $e) {
            echo "ERROR : " . $e;
            return false;
        }
    }

    // Captures order, returns captured order object in JSON
    public static function capture($token){
        // set capture = true
        $params = [];
        $order = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token."/capture", $params);
    }

    // Credits order, returns credited order object in JSON
    public static function credit($token){
        // set capture = true
        $params = [];
        $order = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/checkout/".$token."/credit", $params);
    }

}
