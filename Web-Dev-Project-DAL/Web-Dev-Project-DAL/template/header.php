<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
?>

<div class="linear-activity hideElement" id="headerLoader">
    <div class="indeterminate"></div>
</div>
<div class="primary-2-background-color header white-color">
    <div class="container ">
        <div class="row innerHeader">
            <div class="desktop-1 tablet-1 mobile-2">

                <img onclick="showMenu();" src="assets/images/menu.png" class="cursor-pointer menu-img" alt="menu" />
            </div>
            <div class="desktop-8 tablet-8 mobile-8 text-center text-align-center-tablet">
                <a href="index.php">
                    <img src="assets/images/shoppingBag-2.png" alt="shoppingBag" class="desktop-header-img-fix" />
                </a>
            </div>
            <div class="hide-desktop tablet-2 mobile-2 text-right">
                <img src="assets/images/Profile.png" onclick="showRightMenu()" class="profile-image cursor-pointer" alt="Profile" />
            </div>
            <div id="rightMenuContent" class="row desktop-3 tablet-12 mobile-12 hide-mobile hide-tablet">
                <?php if(isset($_SESSION['USER_UserID'])){ ?>

                <div class="row text-center text-left-mobile no-padding-mobile mobile-padding-L-10">
                    <div class="desktop-3 tablet-12 mobile-12 mobile-menu-content welcome-name">
                        Welcome <?php echo $_SESSION["USER_FirstName"] ?>
                    </div>
                    <div class="desktop-3 text-center tablet-12 mobile-12 mobile-menu-content text-left-mobile text-left-tablet">
                        <a href="myorders.php">
                            MY Orders
                        </a>
                    </div>
                    <div class="desktop-3 text-center tablet-12 mobile-12 mobile-menu-content text-left-mobile text-left-tablet">
                        <a href="cart.php">
                            CART
                        </a>
                    </div>
                    <div class="desktop-3 text-center tablet-12 mobile-12 mobile-menu-content text-left-mobile text-left-tablet">
                        <a href="logout.php">
                            LOGOUT
                        </a>
                    </div>
                </div>

                <?php
                      }else{
                ?>
                <div class="row text-center text-left-mobile no-padding-mobile mobile-padding-L-10">
                    <div class="desktop-4 tablet-4 mobile-12 mobile-menu-content">
                        <a href="login.php">
                            LOGIN
                        </a>
                    </div>
                    <div class="desktop-4 text-center tablet-4 mobile-12 mobile-menu-content text-left-mobile">
                        <a href="registration.php">
                            REGISTER
                        </a>
                    </div>
                    <div class="desktop-4 text-center tablet-4 mobile-12 mobile-menu-content text-left-mobile">
                        <a href="cart.php">
                            CART
                        </a>
                    </div>
                </div>
                <?php
                      }?>

            </div>
        </div>
        <div id="menuContainer" class="absolute hideElement">
            <img src="assets/images/upArrow.png" class="menu-up-arrow" alt="uparrow" />
            <ul id="menu" class="desktop-4 tablet-4 mobile-12">
                <li id="item_1">
                    GROCERY
                    <span class="float-right">
                        <img src="assets/images/rightArrow.png" alt="rightArrow" />
                    </span>
                    <ul id="sub_item_1" class="ui-menu-subitem hideElement">
                        <li id="sub_item_1_1">
                            Vegetables
                            <span class="float-right">
                                <img src="assets/images/rightArrow.png" alt="rightArrow" />
                            </span>
                            <ul id="sub_item_1_1_1" class="ui-menu-subitem hideElement">
                                <li>
                                    <a href="searchResult.php?q=onion">
                                        Onion
                                    </a>
                                </li>
                                <li>
                                    <a href="searchResult.php?item=Shallot Onions">
                                        Shallot Onions
                                    </a>

                                </li>
                                <li>
                                    <a href="searchResult.php?item=Big Onions">
                                        Big Onions
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="notice primary-background-color"></div>