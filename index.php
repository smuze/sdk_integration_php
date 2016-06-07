<?php
//
// █▀▀ █▀▄▀█ █  █ ▀▀█ █▀▀ 
// ▀▀█ █ ▀ █ █  █ ▄▀  █▀▀ .inc
// ▀▀▀ ▀   ▀  ▀▀  ▀▀▀ ▀▀▀ 
// Created 2016-06-03 Auth JS.

require_once('init.php');


\Smuze\Smuze::setPrivateKey("#YOUR PRIVATE KEY");


// CREATE ORDER 
$parmas = array();
$params['order_id'] = "1231233213213213";
$params['purchase_currency'] = "SEK";
$cart = array('items' => 
	[
		array(
			"sku" => "1231231231231232131231",
			"name" => "Smuze cup",
			"quantity" => 1,
			"unit_price" => 12300
		)
	]
);
$order = \Smuze\Order::create($cart, $params);



// GET ORDER
$order_token = "zu2X9q8LA4YnLcBP5GridNs4";
$order = \Smuze\Order::get($order_token);




// // UPDATE ORDER 
$parmas = array();
$params['order_id'] = "1231233213213213";
$cart = array('items' => 
	[
		array(
			"sku" => "1231231231231232131231",
			"name" => "Smuze cup",
			"quantity" => 1,
			"unit_price" => 12300
		),
		array(
			"sku" => "131231231232323213212",
			"name" => "Smuze shirt",
			"quantity" => 1,
			"unit_price" => 31200
		)
	]
);


$cart = $order->cart;
$cart->items[0]->quantity = 2;
$order = \Smuze\Order::update($order_token, $cart);











		