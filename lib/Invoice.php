<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.
namespace Smuze;
class Invoice
{
    public static function auth()
    {
        $invoice = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/invoice/".$token);
        return json_decode($invoice);
    }

    public static function create()
    {
        $invoice = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/invoice/".$token);
        return json_decode($invoice);
    }

    public static function refund()
    {
        $invoice = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/invoice/".$token);
        return json_decode($invoice);
    }
    
    public static function void()
    {
        $invoice = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/invoice/".$token);
        return json_decode($invoice);
    }

}
