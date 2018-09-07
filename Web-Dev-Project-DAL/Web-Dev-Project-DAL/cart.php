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
    <script src="assets/js/Cart.js"></script>
   
</head>
<body>
    <form id="form1" action="checkout.php">
        <!--include the header template-->
        <?php include 'template/header.php'; ?>
         <div class="search_card_add_product_background hideElement" id="search_add_product_loader_overview_background"></div>
         <div class="search_card_add_product_outer_container hideElement" id="cart_loader_overview">
            <div class="search_card_add_product_container">
                <div class="search_card_add_product_Center">
                    <div class="linear-activity" id="cart_loader">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="fruit_add_cart_loader">
                        <img id="placeorderfruitimage" alt="fruits" src="assets/images/fruits.png" />
                    </div>
                    <div class="add_product_cart_Text" id="cart_loader_text">
                        UPDATING CART, PLEASE WAIT
                    </div>
                </div>
            </div>
        </div>
        <div class="placeorder primary-2-background-color">
            <div class="placeOrderImages">
                <img id="placeorderfruitimage" alt="fruits" src="assets/images/fruits.png" />
            </div>
            <div class="container white-background-color placeorderbox">
                <div class="row mobile-12 tablet-12 desktop-12 ">
                    <div class="row">
                        <div class="breadcrumbs pt50px p10px">
                            <ul>
                                <li class="breadcrumbs_link ">
                                    <a href="index.php" class="primary-2-color">
                                        HOME
                                    </a>
                                </li>
                                <li class="breadcrumbs_link primary-2-color">></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row cartItemsHeader p10px">
                        Your Cart Items
                    </div>
                    <div class="CartLoader row" id="CartLoader">
                        <div class="linear-activity" id="home_load_add_cart_loader">
                            <div class="indeterminate"></div>
                        </div>
                        <div class="cart-loader-text" id="cart-loader-text">
                            LOADING CART
                        </div>
                    </div>
                     
                    <div class="row cartProducts p10px hideElement" id="cartProducts">
                        <div class="row">
                            <div class="desktop-2 tablet-4 mobile-4">
                                <img class="productImage" alt="onion" src="assets/images/shallot_onion.png" />
                            </div>
                            <div class="desktop-4 tablet-4 mobile-4">
                                <div class="row cartproductname">Shallot Onions</div>
                                <div class="row carproductprice">
                                    <span class="productinnerprice">
                                        Price : 0.4$ / lb
                                    </span>
                                    <span>
                                        <img class="storeImage" src="assets/images/walmart.png" alt="walmart" />
                                    </span>
                                </div>
                                <div class="row quantity">
                                     <span class="quantity-text-cart">
                                        Quantity : 
                                    </span><select class="quantityCheckoutPageSelect" id="quantity"><option value="1" >1</option></select><i class="material-icons cart-delete-icon" onclick="alert('Product delete detected');">delete</i>
                                </div>
                            </div>
                            <div class="desktop-6 tablet-4 productnetprice mobile-4">
                                $ 0.8
                            </div>
                        </div>
                        <div class="row">
                            <div class="desktop-2 tablet-4 mobile-4">
                                <img alt="onion" class="productImage" src="assets/images/calcotOnions.png" />
                            </div>
                            <div class="desktop-4 tablet-4 mobile-4">
                                <div class="row cartproductname">Calcot Onions</div>
                                <div class="row carproductprice">
                                    <span class="productinnerprice">
                                        Price : 0.6$ / lb
                                    </span>
                                    <span>
                                        <img class="storeImage" src="assets/images/walmart.png" alt="walmart" />
                                    </span>
                                </div>
                                <div class="row quantity">
                                    <span class="quantity-text-cart">
                                        Quantity : 
                                    </span>
                                    <select class="quantityCheckoutPageSelect" id="quantity"><option value="1" >1</option><option value="2" >2</option></select> <i class="material-icons cart-delete-icon" onclick="alert('Product delete detected');">delete</i>
                                </div>
                            </div>
                            <div class="desktop-6 tablet-4 productnetprice mobile-4">
                                $1.2
                            </div>
                        </div>
                    </div>
                    <div class="row p10px subitems hideElement" id="totalSubItemsCart">
                        <div class="desktop-6 tablet-6 hide-mobile"></div>
                        <div class="desktop-6 tablet-6 mobile-12">
                            <div class="row subitemP">
                                <div class="desktop-6 mobile-9 tablet-6 subitemright">
                                    Total Price :
                                </div>
                                <div class="desktop-4 mobile-2 tablet-6 subitemleft" id="totalAmountCart">
                                    $ 2.3
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="row hideElement" id="CheckoutBtn">
                        <div class="desktop-12 mobile-12 tablet-12 placeorderbtn">
                            <input type="button" class="white-color primary-2-background-color" onclick="location.href='placeorder.php'" value="CHECKOUT" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--include the footer template-->
        <?php include 'template/footer.php'; ?>

    </form>

</body>
</html>