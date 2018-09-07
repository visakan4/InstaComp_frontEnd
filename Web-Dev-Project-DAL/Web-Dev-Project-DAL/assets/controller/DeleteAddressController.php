<?php

if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
//echo $root;
require_once('../../template/HTTPRequest.php');
require_once('../Configuration.php');

$API_HOST = Configuration::APIHOST();
$FILE_HOST = Configuration::FILEHOST();

$RESPONSE = '';

if(isset($_SESSION['USER_UserID'])){
    try{
        $RESPONSE = json_decode(HTTPRequest::HTTPPOST($API_HOST."/deleteAddress",
            array(
                "address_id" =>  $_POST['aid']
            )), true);
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