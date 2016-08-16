<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.
namespace Smuze;
class Merchant
{
    public static function createCampaign(){
        $campaign = \Smuze\Smuze::request("POST", \Smuze\Smuze::getApiBase()."/v2/merchant/".$token);
        return json_decode($campaign);
    }
}
