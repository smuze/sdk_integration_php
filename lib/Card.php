<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.
namespace Smuze;
class Card
{
    public static function auth()
    {
        $card = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/card/".$token);
        return json_decode($card);
    }

    public static function charge()
    {
        $card = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/card/".$token);
        return json_decode($card);
    }

    public static function refund()
    {
        $card = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/card/".$token);
        return json_decode($card);
    }

    public static function dsecure()
    {
        $card = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/card/".$token);
        return json_decode($card);
    }

    public static function void()
    {
        $card = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/card/".$token);
        return json_decode($card);
    }

}
