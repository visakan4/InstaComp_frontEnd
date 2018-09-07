<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
require_once('assets/Configuration.php');
$FILE_HOST = Configuration::FILEHOST();
if(isset($_SESSION['USER_UserID']) == false){
    header("Location: ".$FILE_HOST."/login.php?notloggedin=true");
    die();
}
?>
<!Doctype Html>
<html lang="en">
<head>
    <title>
        InstaComp - Your One Stop for All Item Comparison
    </title>

    <link rel="stylesheet" href="assets/css/reset.css" />
    <link rel="stylesheet" href="assets/css/instaComp.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--include bootstrap and css files-->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" />
    <script src="assets/js/init.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet" />

    <script src="assets/js/myorders.js"></script>

</head>
<body>
    <div class="search_card_add_product_background" id="search_add_product_loader_overview_background"></div>
    <div class="search_card_add_product_outer_container" id="cart_loader_overview">
        <div class="search_card_add_product_container">
            <div class="search_card_add_product_Center">
                <div class="linear-activity" id="cart_loader">
                    <div class="indeterminate"></div>
                </div>
                <div class="fruit_add_cart_loader">
                    <img id="placeorderfruitimage" alt="fruits" src="assets/images/fruits.png" />
                </div>
                <div class="add_product_cart_Text" id="cart_loader_text">
                    LOADING PLEASE WAIT
                </div>
            </div>
        </div>
    </div>
    <form id="form1" action="placeorder.php">
        <!--include the header template-->
        <?php include 'template/header.php'; ?>

        <div class="placeorder primary-2-background-color">
            <div class="container orderContainer white-background-color ">
                <div class="row mobile-12 tablet-12 desktop-12 ">
                    <div class="row">
                        <div class="breadcrumbs p10px">
                            <ul>
                                <li class="breadcrumbs_link ">
                                    <a href="index.php" class="primary-2-color">
                                        HOME
                                    </a>
                                </li>
                                <li class="breadcrumbs_link primary-2-color">></li>
                                <li>My Orders</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row" id="orderDetails">
                    
                    </div>
              
                </div>
            </div>
        </div>

        <!--include the footer template-->
        <?php include 'template/footer.php'; ?>

    </form>

</body>
</html>