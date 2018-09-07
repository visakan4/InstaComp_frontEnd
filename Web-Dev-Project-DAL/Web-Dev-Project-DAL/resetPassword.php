<?php
/**
 * Created by PhpStorm.
 * User: Collins
 * Date: 20/06/2018
 * Time: 12:22 PM
 */
// REQUIRED

//Create a connection with PDO options
//use \Phalcon\Db\Adapter\Pdo\Mysql;
//$config =
//    [
//        'host'     => 'db.cs.dal.ca',
//        'dbname'   => 'sappal',
//        'password'     => 'B00786813',
//        'username' => 'sappal',
//        'options'  => [
//            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
//            PDO::ATTR_CASE               => PDO::CASE_LOWER,
//        ]
//    ]
//;
//$connection=new Mysql($config);


$error_confirmPassword = $error_password =$userMessage= "";
$checkValidations=true; // assuming that login form is free from errors and is validated
$confirmPassword = $password = ""; // source: https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

$confirmPassword = stop_sql_injection_attacks($_POST["confirmPassword"]);
$password =stop_sql_injection_attacks($_POST["password"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {       //Post- request method ,source: https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

    if (strlen($password)<8 || empty($password))        // if length of password < 8 characters, source:  https://gist.github.com/bmcculley/9339529
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

}

if((isset($_POST['submit'])) and $checkValidations==true){
    // form is validated and register button is clicked

    $userMessage="Password updated successfully!";
    // login again, redirect to login or home page
}

function stop_sql_injection_attacks($param) {      // prevent sql injection attacks,source, source:  https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

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
    <link rel="stylesheet" href="css/registration.css" />
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
        include 'template/header.php';  // php template to retrieve & display navigation menu to user
        ?>
    </div>
    <!-- remove top navigation for project-->
    <div class="containerRegistration">
        <!-- setting container for inner elements, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->
        <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">

            <div class="row">
                <span class="registerTitle">RESET PASSWORD</span>
                <br />
                <br />
            </div>

            <div class="row">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                <div class="column25">
                    <!--left column with label, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <label>Password</label>
                </div>
                <div class="column75">
                    <!--right column with text input, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <input type="password" name="password" placeholder="Minimum 8 characters." value="<?php echo $password;?>" />
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
                    <input type="password" name="confirmPassword" placeholder="Both Passwords should match." value="<?php echo $confirmPassword;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_confirmPassword;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">

                <input type="submit" name="submit" value="RESET" />

            </div>

            <div class="row">
                <br />
                <span class="userMessage">
                    <?php echo $userMessage;?>
                </span>
                <br />
            </div>
        </form>
    </div>
    <!-- remove footer for project-->
    <div class="bottom">
        <?php include 'template/footer.php'; ?>
    </div>
    <!-- remove footer for project-->
</body>
</html>