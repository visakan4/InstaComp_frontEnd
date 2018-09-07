<?php

if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
//echo $root;
require_once('../../template/HTTPRequest.php');
require_once('../Configuration.php');

$ERROR_REASON = '';

$API_HOST = Configuration::APIHOST();
$FILE_HOST = Configuration::FILEHOST();

$RESPONSE = array();
$RESPONSE['status'] = 'SUCCESS';
$RESPONSE['responsetext'] = '';
$RESPONSE['isloggedin'] = false;
$RESPONSE['redirecttologinpage'] = false;

if(isset($_SESSION['USER_UserID'])){
    $RESPONSE['isloggedin'] = true;
    $RESPONSE['redirecttologinpage'] = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try{
            $ProdID = $_POST['pid'];
            $StoreID = $_POST['sid'];
            $Price = $_POST['price'];
            $Quantity = $_POST['quantity'];
            //$response = json_decode(HTTPRequest::HTTPPOST($API_HOST."/setCart", array("user_id" => $_SESSION['USER_UserID'], "product_id" => "1", "store_id" => "1", "product_store_quantity" => "1","product_store_price" => "0.2")), true);
            $response = json_decode(HTTPRequest::HTTPPOST($API_HOST."/setCart", array("user_id" => $_SESSION['USER_UserID'], "product_id" => $ProdID, "store_id" => $StoreID, "product_store_quantity" => $Quantity,"product_store_price" =>$Price)), true);
            //$response = json_decode(HTTPRequest::HTTPPOST($API_HOST."/getCart", array("user_id" => $_SESSION['USER_UserID'])), true);
            $RESPONSE['status'] = $response["status"];

            }
        catch(Exception $e){
            $RESPONSE['status'] = 'FAIL';
            $RESPONSE['responsetext'] = 'Unable to add product this time, please try again later';
        }
    }else{
        $RESPONSE['status'] = 'FAIL';
        $RESPONSE['responsetext'] = 'Invalid Request';
    }
}else{
    $RESPONSE['isloggedin'] = false;
    $RESPONSE['redirecttologinpage'] = true;
    $RESPONSE['responsetext'] = 'Please login to add products to cart';
}

header('Content-Type: application/json');
echo json_encode($RESPONSE);

?>