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
$APIResponse = array();
if(isset($_SESSION['USER_UserID'])){
    try{
        $RESPONSE = json_decode(HTTPRequest::HTTPPOST($API_HOST."/getOrder", array("user_id" => $_SESSION['USER_UserID'])), true);
        $APIResponse['HasOrder'] = false;
        foreach($RESPONSE["data"] as $item) {
            if($item['orderid'] == $_POST['orderid']){
                $APIResponse['HasOrder'] = true;
                $APIResponse['order'] = $item;
                break;
            }
        }
    }
    catch(Exception $e){
        $APIResponse['HasOrder'] = false;
    }
}else{
    $APIResponse['HasOrder'] = false;
}

header('Content-Type: application/json');
echo json_encode($APIResponse);

?>