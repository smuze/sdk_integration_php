<?php
require_once('init.php');
\Smuze\Smuze::setPrivateKey("NtBN34veWVpWrRyezLBxH69d");


// SERVE ORDER
if (count($_GET["token"]) > 0) {
    $order = \Smuze\Order::get($_GET["token"]);
    echo json_encode($order);
    die;
}

if (isset($_POST["create_order"])){
    $cart = array('items' => 
        [
            array(
                "sku" => "1231232311231231232131231",
                "name" => "Smuze cup",
                "quantity" => 1,
                "unit_price" => 1000000
            ),
            array(
                "sku" => "1231232311231231232131231",
                "name" => "Smuze cup",
                "quantity" => 1,
                "unit_price" => 1000000
            )
        ]
    );
    $params['order_id'] = "123311";
    $params['purchase_currency'] = "SEK";
    $order = \Smuze\Order::create($cart, $params);
    echo json_encode($order);
    die;
}



if (count((int)$_POST["amount"]) > 0 && count($_POST["token"]) > 0) {
    $order = \Smuze\Order::get($_POST["token"]);
    $cart = $order->cart;
    $cart->items = json_decode(preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', json_encode($cart->items))); // Clean null values
    $cart->items[0]->quantity = (int)$_POST["amount"];
    $order = \Smuze\Order::update($_POST["token"], $cart);
    echo json_encode($order);
    die;
}







// Build the cart
$cart = array('items' => 
    [
        array(
            "sku" => "3123123",
            "name" => "Smuze cup",
            "quantity" => 1,
            "unit_price" => 25000,
            "discount_rate"=> 0,
            "vat_rate"=> 25
        )
    ]
);



// Set the params see full available list at 
// https://smuze.com/se/documentation/checkout/params
$params['order_id'] = "1321";
$params['purchase_currency'] = "SEK";
$order = \Smuze\Order::create($cart, $params);







// Get Current order
//$order = \Smuze\Order::get("43npgpm1eNuWbhsMN14kqYA8");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Getting started with Smuze Checkout</title>
        <!-- jQuery and Bootstrap is used in this example but is not required to use Smuze Checkout -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    </head>
    <body>
        



        <div class="container">
            <div class="row">

                <div class="col-xs-offset-2 col-xs-8">
                    <h1>Integrate your Smuze Checkout</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#1D9EDA;">
                            <div class="panel-title">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <h5 style="color:white; text-transform: uppercase;"><b>My cart</b></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-2 hidden-xs"><img class="img-responsive" src="http://placehold.it/100x70">
                                </div>
                                <div class="col-xs-4">
                                    <h4 class="product-name"><strong>Smuze Cup</strong></h4><h4 class="hidden-xs"><small>A very nice smuze cup</small></h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-6 text-right">
                                        <h6><strong>10.00 <span class="text-muted">x</span></strong></h6>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control input-sm" value="1">
                                    </div>
                                    <div class="col-xs-2">
                                        <button type="button" class="btn btn-link btn-xs">
                                            <span class="glyphicon glyphicon-trash"> </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="text-center">
                                    <div class="col-xs-3">
                                        <button type="button" onclick="updateCart()" class="btn btn-default btn-sm btn-block">
                                            Update cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-offset-2 col-xs-8">
                    <script id="smuze-script" type="text/javascript" src="http://localhost:3000/js/v2/checkout_dev.js">
                        // See full list of available params 
                        // https://smuze.com/se/documentation/checkout/params
                        smuze.style = {"mainColor" : "b64348", "secondColor":"8e3438", "padding": "0"} // red
                        smuze.style = {"padding": "0"} 
                        smuze.token = "<? echo $order->id; ?>";
                        smuze.onSuccess = function(){
                            // Do some ajax trigger
                            alert("Order has been processed")
                        }
                    </script>
                    <script>
                        function updateCart(){
                          smuze.suspend()

                          $.ajax({
                            type: "POST",
                            url: "index.php",
                            data: {
                                amount: $("input").val(),
                                token : smuze.token
                            },
                            success: function(result){
                                console.log(result)
                                setTimeout(function(){
                                    smuze.resume()
                                },1000)
                            }
                          });
                          // Modify order ajax
                          
                        }
                    </script>
                </div>
            </div>
        </div>




</body>
</html>