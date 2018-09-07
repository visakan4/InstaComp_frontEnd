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

if(isset($_SESSION['USER_UserID'])){
    try{
        $RESPONSE['status'] = 'SUCCESS';
        $RESPONSE["cart"] = json_decode(HTTPRequest::HTTPPOST($API_HOST."/getCart", array("user_id" => $_SESSION['USER_UserID'])), true);
        $RESPONSE["address"] = json_decode(HTTPRequest::HTTPPOST($API_HOST."/getAddress", array("user_id" => $_SESSION['USER_UserID'])), true);
        $RESPONSE["card"] = json_decode(HTTPRequest::HTTPPOST($API_HOST."/getCardDetails", array("user_id" => $_SESSION['USER_UserID'])), true);
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