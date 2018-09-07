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

if(isset($_SESSION['USER_UserID'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try{
            $response = json_decode(HTTPRequest::HTTPPOST($API_HOST."/deleteCart", array("cart_id" => $_POST['cartid'])), true);
            $RESPONSE = $response;
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