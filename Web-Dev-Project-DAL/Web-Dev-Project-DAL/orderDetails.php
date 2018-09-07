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
    <script src="assets/js/particularOrder.js"></script>
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
    <form id="form1" action="checkout.php">
        <!--include the header template-->
        <?php include 'template/header.php'; ?>

        <div class="placeorder primary-2-background-color">
            <div class="placeOrderImages">
                <img id="placeorderfruitimage" alt="fruits" src="assets/images/fruits.png" />
            </div>
            <div class="container white-background-color placeorderbox">
                <div class="row mobile-12 tablet-12 desktop-12" id="OrderDetailsExists">
                    <div class="row">
                        <div class="breadcrumbs pt50px p10px">
                            <ul>
                                <li class="breadcrumbs_link ">
                                    <a href="index.php" class="primary-2-color">
                                        HOME
                                    </a>
                                </li>
                                <li class="breadcrumbs_link primary-2-color">></li>
                                <li class="breadcrumbs_link ">
                                    <a href="myorders.php" class="primary-2-color">
                                        MY ORDERS
                                    </a>
                                </li>
                                <li class="breadcrumbs_link primary-2-color">></li>
                                <li class="breadcrumbs_link " id="orderID">
                                    Order #000001
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="breadcrumbs pt10px p10px">
                            <ul>
                                <li class="breadcrumbs_link ">
                                    Order Date
                                </li>
                                <li class="breadcrumbs_link primary-2-color">:</li>
                                <li class="breadcrumbs_link " id="orderDate">
                                    July 5 2018
                                </li>

                            </ul>
                        </div>
                    </div>

                    <?php if($_GET['status'] == 'Success'){ ?>
                    <div class="row successRow">
                        <div class="row">
                            <div class=" desktop-12 tablet-12 mobile-12">
                                Your order has been successfully placed
                            </div>
                        </div>
                    </div>

                    <?php } ?>



                    <div class="row cartProducts p10px" id="cartProducts">
                        
                    </div>
                    <div class="row">
                        <div class="desktop-12 mobile-12 tablet-12 totalPriceOrderDetails">
                            Total Price : $
                            <span id="netPrice"></span>
                        </div>
                    </div>

                    <div class="row cartProducts p10px">
                        <div class="row">
                            <div class="desktop-2 tablet-4 mobile-4">

                                <span>Address :</span>
                            </div>
                            <div class="desktop-4 tablet-4 mobile-4">

                                <div class="row quantity">
                                    <div class="quantity-text-cart" id="streetAddr1"> 1333 South Park Street </div>
                                </div>

                                <div class="row quantity">
                                    <div class="quantity-text-cart" id="streetAddr2"> Park Victoria </div>
                                </div>


                                <div class="row quantity">
                                    <div class="quantity-text-cart" id="postalCode"> Halifax,NS B3J2K9</div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row cartProducts p10px">
                        <div class="row">
                            <div class="desktop-2 tablet-4 mobile-4">
                                <span>Payment Mode :</span>
                            </div>

                            <div class="desktop-4 tablet-4 mobile-4">
                                <div class="row quantity">
                                    <div class="quantity-text-cart" id="paymentMode">Card</div>
                                </div>
                            </div>

                        </div>

                    </div>




                </div>
                <div class="hideElement" id="orderDetailsDoesNotExists">
                    Order details not found for this order
                </div>
            </div>
           
        </div>


        <!--include the footer template-->
        <?php include 'template/footer.php'; ?>

    </form>


</body>
</html>
