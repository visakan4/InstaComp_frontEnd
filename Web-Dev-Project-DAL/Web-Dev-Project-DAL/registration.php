<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}

$error_firstName =$error_lastName= $error_email = $error_password = $error_PhoneNumber = $error_confirmPassword="";
$checkValidations=true; // assuming that registration form is free from errors and is validated
$firstName =$lastName= $email = $password = $confirmPassword= $userMessage=""; // source: https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

$firstName = stop_sql_injection_attacks($_POST["firstName"]);
$lastName = stop_sql_injection_attacks($_POST["lastName"]);
$email = stop_sql_injection_attacks($_POST["email"]);
$password =stop_sql_injection_attacks($_POST["password"]);
$confirmPassword = stop_sql_injection_attacks($_POST["confirmPassword"]);
$contactNumber = stop_sql_injection_attacks($_POST["contactNumber"]);


if ($_SERVER["REQUEST_METHOD"] == "POST") {       //Post- request method, source: https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

    if (!(preg_match("/^[a-zA-Z]+$/",$firstName))|| empty($firstName))  // only letters in first name,source:source: https://stackoverflow.com/questions/4939722/php-preg-match-with-regex-only-single-hyphens-and-spaces-between-words-continue?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
    {
        if(empty($firstName))
        {
            $error_firstName = "First Name is required !";
            $checkValidations=false;    // validation fails

        }

        else
        {
            $error_firstName = "Only letters accepted in first name";
            $checkValidations=false;    // error in first name. validation fails
        }

    }

    else if (!preg_match("/^[a-zA-Z]+[\s]*[a-zA-Z]*$/",$lastName) || empty($lastName))  // only letters and white space in last name, source: https://stackoverflow.com/questions/4939722/php-preg-match-with-regex-only-single-hyphens-and-spaces-between-words-continue?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
    {
        if(empty($lastName))
        {
            $error_lastName = "Last Name is required !";
            $checkValidations=false;    // validation fails

        }
        else
        {
            $error_lastName = "Only letters and white space accepted in last name";
            $checkValidations = false;
        }
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)  || empty($email))        //to validate email:  source: https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete
    {

        if(empty($email))
        {
            $error_email = "Email is required !";
            $checkValidations=false;    // validation fails

        }
        else
        {
            $error_email = "Invalid email";
            $checkValidations = false;
        }
    }

    else if (strlen($password)<8 || empty($password))        // if length of password < 8 characters, source:  https://gist.github.com/bmcculley/9339529
    {
        if(empty($password))
        {
            $error_password = "Password is required !";
            $checkValidations=false;    // validation fails

        }
        else
        {
            $error_password = "Minimum 8 characters in password ";
            $checkValidations = false;
        }
    }

    else if ( (strlen($confirmPassword)<8 || ($_POST["password"]!=$_POST["confirmPassword"])) ||empty($confirmPassword))    // if passwords don't match
    {
        if(empty($confirmPassword))
        {
            $error_confirmPassword = "Confirm Password is required !";
            $checkValidations=false;    // validation fails

        }
        else
        {
            $error_confirmPassword = "Password and confirm password do not match";
            $checkValidations = false;
        }
    }

    else if(strlen($contactNumber) != 10 ){

        if(empty($contactNumber))
        {
            $error_PhoneNumber = "Phone number is required !";
            $checkValidations=false;    // validation fails

        }
        else
        {
            $error_PhoneNumber = "PHone number is in incorrect format, correct format is XXXXXXXXXX (10 digits)";
            $checkValidations = false;
        }
    }


}
if((isset($_POST['submit'])) and $checkValidations==true){
    // form is validated and register button is clicked

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once('template/HTTPRequest.php');
    require_once('assets/Configuration.php');

    $ERROR_REASON = '';

    $API_HOST = Configuration::APIHOST();
    $FILE_HOST = Configuration::FILEHOST();
    //echo $_SERVER["REQUEST_METHOD"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try{
            $response = json_decode(HTTPRequest::HTTPPOST($API_HOST."/setUser", array("firstname" =>$firstName, "lastname" => $lastName,"email" => $email,"password" => $password,"contact" => $contactNumber)), true);
            if($response['status'] == "SUCCESS"){
                if($response['data'][0]['userStatus'] == 'USER_NOT_ADDED'){
                    $ERROR_REASON = $response['errors'][0];
                }else{
                    $ERROR_REASON = 'Registration Successful, please login to continue';
                }
            }else{
                $ERROR_REASON = 'Unable to register this time, please try again later';
            }

        }
        catch(Exception $e){
            $ERROR_REASON = 'Unable to connect to the database, please try again later';
        }
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

    <link rel="stylesheet" href="assets/css/reset.css" />
    <link rel="stylesheet" href="assets/css/instaComp.css" />
    <link rel="stylesheet" href="assets/css/registration.css" />

</head>
<body>

    <!-- remove top navigation for project-->
    <div class="top">
        <?php
        include 'template/header.php';     // php template to retrieve & display navigation menu to user
        ?>
    </div>
    <!-- remove top navigation for project-->
    <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">

        <div class="containerRegistration">
            <!--creating outer div class for registration, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $checkValidations = true){
                echo "<div class='RegistrationMessage'><div class='row'>".$ERROR_REASON."</div></div>";
            }
            ?>

            <div class="row">
                <span class="registerTitle">REGISTER</span>
                <br />
                <br />
            </div>


            <div class="row">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                <div class="column25">
                    <!--left column with label, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <label>First Name</label>
                </div>
                <div class="column75">
                    <!--right column with text input, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <input type="text" class="RegistrationBox" name="firstName" placeholder="Only letters accepted." value="<?php echo $firstName;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_firstName;?>
                    </span>
                    <br />
                </div>
            </div>


            <div class="row">
                <!-- row created,source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->
                <div class="column25">
                    <label>Last Name</label>
                </div>
                <div class="column75">
                    <input type="text" name="lastName" class="RegistrationBox" placeholder="Only letters and white space accepted" value="<?php echo $lastName;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_lastName;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">
                <div class="column25">
                    <label>Email</label>
                </div>
                <div class="column75">
                    <input type="text" name="email" class="RegistrationBox" placeholder="someone@email.com." value="<?php echo $email;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_email;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">
                <div class="column25">
                    <label>Password</label>
                </div>
                <div class="column75">
                    <input type="password" name="password" class="RegistrationBox" placeholder="Minimum 8 characters." value="<?php echo $password;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_password;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">
                <div class="column25">
                    <label>Confirm Password</label>
                </div>
                <div class="column75">
                    <input type="password" name="confirmPassword" class="RegistrationBox" placeholder="Both Passwords should match." value="<?php echo $confirmPassword;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_confirmPassword;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">
                <div class="column25">
                    <label>Contact Number</label>
                </div>
                <div class="column75">
                    <input type="number" name="contactNumber" class="RegistrationBox" placeholder="Please enter your 10 digit contact number" value="<?php echo $contactNumber;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_PhoneNumber;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">
                <!-- row created, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->

                <input type="submit" name="submit" value="REGISTER" />

            </div>

            <div class="row">
                <br />
                <span class="userMessage">
                    <?php echo $userMessage;?>
                </span>
                <br />
            </div>
        </div>
    </form>
    <!-- remove footer for project-->
    <div class="bottom">
        <?php include 'template/footer.php'; ?>
    </div>
    <!-- remove footer for project-->

</body>
</html>