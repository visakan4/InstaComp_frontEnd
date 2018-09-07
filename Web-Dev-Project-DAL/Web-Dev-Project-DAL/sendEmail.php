<?php
/**
 * Created by PhpStorm.
 * User: Collins
 * Date: 20/06/2018
 * Time: 7:24 PM
 */

$error_email = "";
$checkValidations=true; // assuming that login form is free from errors and is validated
$email = $userMessage=""; // https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

$email = stop_sql_injection_attacks($_POST["email"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {       //Post- request method, source: https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)  || empty($email))        //to validate email, source:  https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete
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

}

if((isset($_POST['submit'])) and $checkValidations==true){
    // form is validated and register button is clicked
    $userMessage="Email sent successfully !";

}

function stop_sql_injection_attacks($param) {      // prevent sql injection attacks, source : https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

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
        <!--creating container for inner elements, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->
        <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">

            <div class="row">
                <span class="registerTitle">PASSWORD RECOVERY</span>
                <br />
                <br />
            </div>


            <div class="row">
                <!-- row created, source:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                <div class="column25">
                    <!--left column with label: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <label>Enter Email</label>
                </div>
                <div class="column75">
                    <!--right column with text input:  https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive */-->
                    <input type="text" name="email" placeholder="someone@email.com." value="<?php echo $email;?>" />
                    <br />
                    <span class="error">
                        <?php echo $error_email;?>
                    </span>
                    <br />
                </div>
            </div>

            <div class="row">
                <!-- row created, source: https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->

                <div class="column25"></div>
                <div class="desktop-sendemail-buttons">
                    <input type="submit" name="submit" value="SEND EMAIL" />
                </div>
            </div>

            <div class="row">
                <br />
                <span class="userMessage">
                    <?php echo $userMessage;?>
                </span>
            </div>


        </form>

        <div class="row">
            <!-- row created, source:https://www.w3schools.com/css/tryit.asp?filename=trycss_form_responsive-->

            <div class="column25"></div>
            <div class="desktop-sendemail-buttons">
                <input type="submit" name="submit" value="CANCEL" onclick="window.location.href='login.php'" />
            </div>
        </div>
    </div>

    <!-- remove footer for project-->
    <div class="bottom">
        <?php include 'template/footer.php'; ?>
    </div>
    <!-- remove footer for project-->
</body>
</html>
