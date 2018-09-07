<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('assets/Configuration.php');
$FILE_HOST = Configuration::FILEHOST();
if(isset($_GET['q']) == false){
    header("Location: ".$FILE_HOST);
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
    <script src="assets/js/Search.js"></script>
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
    <form id="form1" action="checkout.php">
        <!--include the header template-->
        <?php include 'template/header.php'; ?>
        <div class="search_card_add_product_background hideElement" id="search_add_product_loader_overview_background"></div>
        <div class="search_card_add_product_outer_container hideElement" id="search_add_product_loader_overview">
            <div class="search_card_add_product_container">
                <div class="search_card_add_product_Center">
                    <div class="linear-activity" id="home_load_add_cart_loader">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="fruit_add_cart_loader">
                        <img id="placeorderfruitimage" alt="fruits" src="assets/images/fruits.png" />
                    </div>
                    <div class="add_product_cart_Text" id="ADDProductToCartText">
                        ADDING PRODUCT TO CART
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
                        <div class="linear-activity" id="home_loader_search_bar">
                            <div class="indeterminate"></div>
                        </div>

                        <div class="breadcrumbs pt50px p10px">
                            <ul>
                                <li class="breadcrumbs_link ">
                                    <a href="index.php" class="primary-2-color">
                                        HOME
                                    </a>
                                </li>
                                <li class="breadcrumbs_link primary-2-color">></li>
                                <li>
                                    Search result for
                                    <span id="productSearchName"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="desktop-12 mobile-12 tablet-12 search_results_loader_text" id="search_loading_text">
                                Loading Results
                            </div>
                        </div>
                    </div>
                    <div class="row clearResults hideElement" id="clearResults" onclick="clearResults();">
                        CLEAR RESULTS
                    </div>
                    <div class="row hideElement" id="search_results">
                        <div class="desktop-9 mobile-12 tablet-12" id="search_results_products">
                            <div class="text-left search_product_row">
                                <div class="desktop-12  mobile-12 tablet-11 product-link">
                                    <div class="row">
                                        <div class="f10">
                                            Grocery > Vegetables
                                        </div>
                                        <div class="row pT20">
                                            <div class="desktop-2">
                                                <div>
                                                    <img src="assets/images/shallot_onion.png" />
                                                </div>
                                                <div class="product-search-description">
                                                    Distance from your location : 0.2m
                                                </div>
                                            </div>
                                            <div class="desktop-10 mobile-12 tablet-12">
                                                <div class="product-search-header">
                                                    Onions
                                                </div>
                                                <div class="best-product-div">
                                                    <span>
                                                        Best Price : $0.3 / lb
                                                    </span>
                                                    <span>
                                                        <img class="best-price-product" src="assets/images/walmart.png" />
                                                    </span>
                                                    <span class="product-addtocart-btn">
                                                        <span>
                                                            <i class="material-icons product-addtocart-size">
                                                                shopping_cart
                                                            </i>
                                                        </span>
                                                        <span>
                                                            ADD TO CART
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="product-othersuperstore-text">
                                                    Other superstore prices

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices product-other-superstore-last-price ">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-left">
                                <div class="desktop-12  mobile-12 tablet-11 product-link">
                                    <div class="row">
                                        <div class="f10">
                                            Grocery > Vegetables
                                        </div>
                                        <div class="row pT20">
                                            <div class="desktop-2">
                                                <div>
                                                    <img src="assets/images/shallot_onion.png" />
                                                </div>
                                                <div class="product-search-description">
                                                    Distance from your location : 0.2m
                                                </div>
                                            </div>
                                            <div class="desktop-10 mobile-12 tablet-12">
                                                <div class="product-search-header">
                                                    Onions
                                                </div>
                                                <div class="best-product-div">
                                                    <span>
                                                        Best Price : $0.3 / lb
                                                    </span>
                                                    <span>
                                                        <img class="best-price-product" src="assets/images/walmart.png" />
                                                    </span>
                                                    <span class="product-addtocart-btn">
                                                        <span>
                                                            <i class="material-icons product-addtocart-size">
                                                                shopping_cart
                                                            </i>
                                                        </span>
                                                        <span>
                                                            ADD TO CART
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="product-othersuperstore-text">
                                                    Other superstore prices

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices product-other-superstore-last-price ">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="text-left">
                                <div class="desktop-12  mobile-12 tablet-11 product-link">
                                    <div class="row">
                                        <div class="f10">
                                            Grocery > Vegetables
                                        </div>
                                        <div class="row pT20">
                                            <div class="desktop-2">
                                                <div>
                                                    <img src="assets/images/shallot_onion.png" />
                                                </div>
                                                <div class="product-search-description">
                                                    Distance from your location : 0.2m
                                                </div>
                                            </div>
                                            <div class="desktop-10 mobile-12 tablet-12">
                                                <div class="product-search-header">
                                                    Onions
                                                </div>
                                                <div class="best-product-div">
                                                    <span>
                                                        Best Price : $0.3 / lb
                                                    </span>
                                                    <span>
                                                        <img class="best-price-product" src="assets/images/walmart.png" />
                                                    </span>
                                                    <span class="product-addtocart-btn">
                                                        <span>
                                                            <i class="material-icons product-addtocart-size">
                                                                shopping_cart
                                                            </i>
                                                        </span>
                                                        <span>
                                                            ADD TO CART
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="product-othersuperstore-text">
                                                    Other superstore prices

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <div class="best-product-div product-other-superstore-prices product-other-superstore-last-price ">
                                                        <span>
                                                            Price : $0.3 / lb
                                                        </span>
                                                        <span>
                                                            <img class="best-price-product" src="assets/images/walmart.png" />
                                                        </span>
                                                        <span class="product-addtocart-btn">
                                                            <span>
                                                                <i class="material-icons product-addtocart-size">
                                                                    shopping_cart
                                                                </i>
                                                            </span>
                                                            <span>
                                                                ADD TO CART
                                                            </span>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="desktop-3 mobile-12 tablet-12 filter-box">

                            <div class="product-page-filter">
                                FILTER
                            </div>

                            <div class="product-page-filter">
                                BY SUPERSTORE
                            </div>
                            <div id="search_superstore"></div>



                            <div class="product-page-filter hideElement">
                                BY PRIORITY
                            </div>

                            <div class="row product-page-filter product-page-filter-superstores hideElement">
                                <span>
                                    <input id="Checkbox1" type="checkbox" />
                                </span>
                                <span class="product-page-filter-priority">
                                    BY LOCATION
                                </span>

                            </div>
                            <div class="row product-page-filter product-page-filter-superstores hideElement">
                                <span>
                                    <input id="Checkbox1" type="checkbox" />
                                </span>
                                <span class="product-page-filter-priority">
                                    BY PRICE
                                </span>
                            </div>

                            <div class="product-page-filter product-page-filter-button" onclick="applyFilter()">
                                APPLY FILTER
                            </div>
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