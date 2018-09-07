<?php
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    require_once('assets/Configuration.php');
    $FILE_HOST = Configuration::FILEHOST();
    header("Location: ".$FILE_HOST."/");
    die();
?>