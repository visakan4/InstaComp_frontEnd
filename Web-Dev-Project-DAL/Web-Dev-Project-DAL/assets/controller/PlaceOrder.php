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
if(isset($_SESSION['USER_UserID'])){
    try{
        json_decode(HTTPRequest::HTTPPOST($API_HOST."/setOrder",
            array(
                "user_id" => $_SESSION['USER_UserID'],
                "address_id" => $_POST['address_id'],
	            "card_id" => $_POST['card_id'],
	            "order_price" => $_POST['order_price'],
	            "order_status" => "ORDER_PLACED",
	            "product_details" => json_decode($_POST['product_details'],true)
            )), true);

        json_decode(HTTPRequest::HTTPPOST($API_HOST."/deleteCartByUserId",
            array(
                "user_id" => $_SESSION['USER_UserID']
            )), true);

        // get the last order id for that user
        $RESPONSE_tmp = json_decode(HTTPRequest::HTTPPOST($API_HOST."/getOrder", array("user_id" => $_SESSION['USER_UserID'])), true);
        $RESPONSE['orderID'] = end($RESPONSE_tmp['data'])['orderid'];

    }
    catch(Exception $e){
        $RESPONSE['status'] = 'FAIL';
    }
}else{
    $RESPONSE['status'] = 'FAIL';
}

header('Content-Type: application/json');
echo json_encode($RESPONSE);

?>