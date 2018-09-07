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

    <script>
        $(document).keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();
                validate();
            }
        });
    </script>
</head>
<body>
    <form id="form1" action="placeorder.php">
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
                        LOADING PLEASE WAIT
                    </div>
                </div>
            </div>
        </div>
        <div class="search_card_add_product_outer_container mt10px hideElement" id="card_loader_overview">
            <div class="search_card_add_product_container">
                <div class="placeorder_card_add_Address_center addAddresOverLay">
                    <div class="linear-activity hideElement" id="card_loader">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="add_product_cart_Text add_address_text" id="cart_loader_text">
                        ADD NEW CARD
                    </div>
                    <div id="address_global_error_card" class="error">
                        Unable to add card, please try again later
                    </div>
                    <div>
                        <input id="cardNumber" class="cardInputElement" placeholder="Card Number" type="number" />
                        <div id="cardNumber_error" class="error">
                            Card Number is required
                        </div>
                        <input id="expiryMonth" class="cardInputElement" placeholder="Expiry Month" type="number" />
                        <div id="expiryMonth_error" class="error">
                            Expiry Month is required
                        </div>
                        <input id="expiryYear" class="cardInputElement" placeholder="Expiry Year" type="text" />
                        <div id="expiryYear_error" class="error">
                            Expiry Year is required
                        </div>
                        <input id="cvv" class="cardInputElement" placeholder="CVV" />
                        <div id="cvv_error" class="error">
                            CVV is required
                        </div>
                    </div>
                    <div class="row">
                        <div class="desktop-6 text-center addressActions" onclick="addCardBox();">
                            ADD CARD
                        </div>
                        <div class="desktop-6 text-center addressActions" onclick="closeCardBox();">
                            CANCEL
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search_card_add_product_outer_container mt10px hideElement" id="cart_addaddress_loader_overview">
            <div class="search_card_add_product_container">
                <div class="placeorder_card_add_Address_center addAddresOverLay">
                    <div class="linear-activity hideElement" id="address_loader">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="add_product_cart_Text add_address_text" id="cart_loader_text">
                        ADD NEW ADDRESS
                    </div>
                    <div id="address_global_error" class="error">
                        Unable to add address, please try again later
                    </div>
                    <div>
                        <input id="address_street_address" class="addressInputElement" placeholder="Street Address" type="text" />
                        <div id="address_street_address_error" class="error">
                            Street Name is required
                        </div>
                        <input id="address_appt_number" class="addressInputElement" placeholder="Appartment Number" type="text" />
                        <div id="address_appt_number_error" class="error">
                            Appartment Name is required
                        </div>
                        <input id="address_postal_code" class="addressInputElement" placeholder="Postal Code" type="text" />
                        <div id="address_postal_code_error" class="error">
                            Postal Code is required
                        </div>
                        <input id="address_city" class="addressInputElement" placeholder="City" />
                        <div id="address_city_error" class="error">
                            City is required
                        </div>
                        <input id="address_province" class="addressInputElement" placeholder="Province" />
                        <div id="address_province_error" class="error">
                            Province is required
                        </div>
                    </div>
                    <div class="row">
                        <div class="desktop-6 text-center addressActions" onclick="addAddressBox();">
                            ADD ADDRESS
                        </div>
                        <div class="desktop-6 text-center addressActions" onclick="closeAddressBox();">
                            CANCEL
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--include the header template-->
        <?php include 'template/header.php'; ?>

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
                                <li>Place Order</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row cartItemsHeader p10px">
                        Your Cart Items
                    </div>
                    <div class="CartLoader row hideElement" id="CartLoader">
                        <div class="linear-activity" id="home_load_add_cart_loader">
                            <div class="indeterminate"></div>
                        </div>
                        <div class="cart-loader-text" id="cart-loader-text">
                            LOADING
                        </div>
                    </div>
                    <div id="results">
                        <div class="row cartProducts p10px no-border" id="productDetails">
                            
                        </div>
                        <div class="row p10px subitems">
                            <div class="desktop-6 tablet-6 hide-mobile"></div>
                            <div class="desktop-6 tablet-6 mobile-12">
                                <div class="row subitemP">
                                    <div class="desktop-6 mobile-9 tablet-6 subitemright">
                                        Total Price :
                                    </div>
                                    <div class="desktop-4 mobile-2 tablet-6 subitemleft" id="TotalPrice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row cartItemsHeader p10px">
                            Your Address
                        </div>
                        <div class="cartAddress">
                            <div class="row" id="cartAddressDetails">
                                
                            </div>
                        </div>
                        <div class="row cartItemsHeader p10px">
                            Your card details
                        </div>
                        <div class="row cartAddress" id="CardDetails">
                            
                        </div>
                        <div class="row">
                            <div class="desktop-12 mobile-12 tablet-12 placeorderbtn">
                                <input type="button" class="white-color primary-2-background-color" onclick="return PlaceTheOrder();" value="PLACE ORDER" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!--include the footer template-->
        <?php include 'template/footer.php'; ?>

    </form>
    <script src="assets/js/PlaceOrder.js"></script>
</body>
</html>