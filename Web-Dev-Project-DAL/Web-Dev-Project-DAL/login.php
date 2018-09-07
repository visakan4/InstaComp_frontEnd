<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('template/HTTPRequest.php');
require_once('assets/Configuration.php');
$HAS_ERROR = false;
$ERROR_REASON = '';

$API_HOST = Configuration::APIHOST();
$FILE_HOST = Configuration::FILEHOST();
//echo $_SERVER["REQUEST_METHOD"];
if(isset($_SESSION['USER_UserID'])){
    header("Location: ".$FILE_HOST."/");
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $username = stop_sql_injection_attacks($_POST["email"]);
        $password = stop_sql_injection_attacks($_POST["password"]);

        if($username != '' && $password != ''){
            $response = HTTPRequest::HTTPPOST($API_HOST."/checkLogin", array("user_id" =>$username, "password" => $password));
            $Response_JSON = json_decode($response, true);
            if($Response_JSON['status'] == "SUCCESS"){
                if($Response_JSON['data'][0]['loginStatus']  == 'LOGIN_SUCCESS'){
                    $HAS_ERROR = false;
                    $_SESSION["USER_FirstName"] = $Response_JSON['data'][0]['firstname'];
                    $_SESSION["USER_LastName"] = $Response_JSON['data'][0]['lastname'];
                    $_SESSION["USER_UserID"] =$Response_JSON['data'][0]['userid'];
                    header("Location: ".$FILE_HOST);
                    die();
                }else{
                    $HAS_ERROR = true;
                    $ERROR_REASON = 'Invalid Email id and password';
                }

            }
            if($response == false){
                $HAS_ERROR  = true;
                $ERROR_REASON = 'Unable to connect to the database, please try again later';
            }
        }
    }
    catch(Exception $e){
        $ERROR_REASON = 'Unable to connect to the database, please try again later';
    }
}

function stop_sql_injection_attacks($param) {      // prevent sql injection attacks, source:  https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

    $param = htmlspecialchars($param);
    $param = stripslashes($param);
    $param = trim($param);
    return $param;
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>INSTACOMP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /><!-- to force internet explorer compatibility mode off , "https://stackoverflow.com/questions/3449286/force-ie-compatibility-mode-off-using-tags?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa" -->
    <meta name="HandledFriendly" content="true" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" />
    <script src="assets/js/init.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet" />

    <link rel="stylesheet" type=" text/css" href="assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/instaComp.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/registration.css" />
</head>
<body>
    <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
        <!-- remove top navigation for project-->
        <div class="top">
            <?php
            include 'template/header.php';  // php template to retrieve & display navigation menu to user
            ?>
        </div>
        <!-- remove top navigation for project-->

        <div class="container loginBox">
            <?php if($_GET["notloggedin"] == true){ ?>
            <div class="loginText">PLEASE LOGIN TO CONTINUE</div>
            <?php } ?>

            <div class="row">
                <span class="registerTitle">LOGIN</span>
                <br />
                <br />
            </div>
            <?php
            if($HAS_ERROR == true){
                echo '<div class="row errorMessage" id="ErrorMessage"><div class="desktop-12 mobile-12 tablet-12" id="login_php_global_error">'.$ERROR_REASON.'</div></div>' ;
            }
            ?>
            <div class="row errorMessage hideElement" id="ErrorMessage">
                <div class="desktop-12 mobile-12 tablet-12" id="login_php_global_error"></div>
            </div>


            <div class="row">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                <div class="desktop-3 mobile-3 tablet-3">
                    <!--left column with label, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <label>Email</label>
                </div>
                <div class="desktop-9 mobile-9 tablet-9">
                    <!--right column with text input, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <input type="text" id="login_php_email" name="email" placeholder="someone@email.com." />
                </div>
            </div>


            <div class="row">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                <div class="desktop-3 mobile-3 tablet-3">
                    <label>Password</label>
                </div>
                <div class="desktop-9 mobile-9 tablet-9">
                    <input type="password" id="login_php_password" name="password" placeholder="Minimum 8 characters." />
                </div>
            </div>


            <div class="row login_php_button_actions">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->

                <div class="desktop-3 mobile-3 tablet-3"></div>
                <div class="desktop-9 mobile-9 tablet-9">
                    <input type="submit" name="submit" value="LOGIN" onclick="return CheckLogin_ValidationErrors();" />
                </div>
            </div>
            <div class="row registerRow">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                <div class="desktop-3 mobile-3 tablet-3"></div>

                <div class="desktop-9 mobile-9 tablet-9">
                    <a href="registration.php" class="RegisterText">
                        REGISTER

                    </a>
                </div>
            </div>
        </div>

        <!-- remove footer for project-->
        <div class="bottom">
            <?php include 'template/footer.php'; ?>
        </div>
        <!-- remove footer for project-->
    </form>
</body>
</html>


<script>
    var host = "https://web.cs.dal.ca/~gayathrib/csci5709/project";

    function CheckLogin_ValidationErrors() {
        console.log('validating');
        var email = $('#login_php_email').val();
        var password = $('#login_php_password').val();
        if (email.trim().length == 0) {
            $('#login_php_global_error').html('Email is required');
            ShowErrorDIV();
            return false;
        }
        if (password.trim().length == 0) {
            $('#login_php_global_error').html('Password is required');
            ShowErrorDIV();
            return false;
        }
        if (password.trim().length < 8) {
            $('#login_php_global_error').html('Invalid Password');
            ShowErrorDIV();
            return false;
        }
        return true;
    }

    function ShowErrorDIV() {
        $('#ErrorMessage').removeClass('hideElement');
    }

    function HideErrorDiv() {
        $('#ErrorMessage').addClass('hideElement');
    }

    function ValidateEmailIDAndPasswordFromServer() {
        HideErrorDiv();
        $('#headerLoader').removeClass('hideElement');
        $.ajax({
            url: host + '/checkLogin',
            method: "POST",
            data: { 'user_id': $('#login_php_email').val(), 'password': $('#login_php_password').val() },
            success: function (data) {
                $('#headerLoader').addClass('hideElement');
                console.log(data);
            }
        }).fail(function () {
            $('#headerLoader').addClass('hideElement');
            $('#login_php_global_error').html('An internal error occured, please check back later');
            ShowErrorDIV();
        });
    }
</script>