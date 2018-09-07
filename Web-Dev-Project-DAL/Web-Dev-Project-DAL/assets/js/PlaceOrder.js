var APIHost = 'https://web.cs.dal.ca/~gayathrib/csci5709/project/';
var FileHOST = 'https://web.cs.dal.ca/~dpsingh/csci5709/project/';
var GloablData = null;
var GlobalSelectedAddress = 0;
var GlobalSelectedCard = 0;
$(document).ready(function () {
    LoadPlaceOrderSection();
})
function LoadPlaceOrderSection() {
    ShowLoader();
    $.ajax({
        url: FileHOST + 'assets/controller/OrderController.php',
        method: 'POST',
        success: function (data) {
            GloablData = data;
            console.log(data);
            if (data.status == 'SUCCESS' && data.address.status == 'SUCCESS' && data.card.status == 'SUCCESS') {
                LoadCartDetails(data);
            } else {
                $('#home_load_add_cart_loader').removeClass('hideElement');
                $('#cart-loader-text').html('Unable to load details this time, please try again later');
            }
        }
    });
}

function ShowLoader() {
    $('#cart-loader-text').html('LOADING');
    $('#CartLoader').removeClass('hideElement');
    $("#results").addClass('hideElement');
}

function HideLoader() {
    $('#CartLoader').addClass('hideElement');
    $("#results").removeClass('hideElement');
}

function LoadCartDetails(data) {
    totalAmount = 0;
    data = GloablData.cart.data;
    $('#cart-loader-text').html('LOADING CART');
    HTMLOutput = '';
    if (data.length == 0) {
        location.href = "cart.php";
    }
    for (i = 0; i < data.length; i++) {
        HTMLOutput += ' <div class="row">' +
            '<div class="desktop-2 tablet-4 mobile-4">' +
            '<img class="productImage" alt="onion" src="assets/images/products/' + data[i].prodid + '.png" />' +
            '</div>' +
            '<div class="desktop-4 tablet-4 mobile-4">' +
            '<div class="row cartproductname">' + data[i].product_details[0].prod_name + '</div>' +
            '<div class="row carproductprice">' +
            '<span class="productinnerprice">' +
            'Price : ' + data[i].price + '$ / lb' +
            '</span>' +
            '<span>' +
            '<img class="storeImage" src="assets/images/stores/' + data[i].storeid + '.png" alt="walmart" />' +
            '</span><span class="store_name_cart">' + data[i].store_details[0].store_name + '</span>' +
            '</div>' +
            '</div>' +
            '<div class="desktop-6 tablet-4 productnetprice mobile-4"> $' +
            data[i].price * data[i].quantity +
            '</div>' +
            '</div>';

        totalAmount += data[i].price * data[i].quantity;
    }
    console.log(HTMLOutput);
    $('#productDetails').html(HTMLOutput);
    $("#TotalPrice").html('$' + totalAmount.toFixed(2));
    LoadAddress(data);
}

function LoadAddress(data) {
    HTMLOutput = '';
    data = GloablData.address.data;
    for (i = 0; i < data.length; i++) {
        HTMLOutput += '<div class="desktop-3 text-left tablet-6 mobile-11 address-module" id="addressBOX_' + data[i].address_id + '">' +
            '<div>' + data[i].addr_line1 + '</div>' +
            '<div>' + data[i].addr_line2 + '</div>' +
            '<div>' + data[i].city + '</div>' +
            '<div>' + data[i].province + '</div>' +
            '<div>' + data[i].postal_code + '</div>' +
            '<div class="row selectedItems" id="addressBOXSelectedItems_' + data[i].address_id + '">' +
            '<div class="desktop-6 tablet-6 mobile-6 selectAddress" onclick="SelectAddress(\'' + data[i].address_id + '\')">' +
            'SELECT' +
            '</div> ' +
            '<div class="desktop-6 tablet-6 mobile-6 deleteAddress" onclick="DeleteAddress(\'' + data[i].address_id + '\')">' +
            'DELETE' +
            '</div>' +
            '</div>' +
            '</div>';
    }
    HTMLOutput += '<div class="desktop-3 text-left tablet-6 mobile-11 address-module add-new-address" onclick="addNewAddress();">ADD NEW ADDRESS</div>';
    console.log(HTMLOutput);
    $('#cartAddressDetails').html(HTMLOutput);
    LoadCard(data);
}

function SelectAddress(aid) {
    $('.selectedModule').removeClass('selectedModule');
    $('.selectedItems').removeClass('hideElement');
    $('#addressBOX_' + aid).addClass('selectedModule');
    $('#addressBOXSelectedItems_' + aid).addClass('hideElement');
    GlobalSelectedAddress = aid;
}

function DeleteAddress(aid) {
    $('#cart_loader_overview,#search_add_product_loader_overview_background, #cart_loader').removeClass('hideElement');
    $('#cart_loader_text').html('UPDATING');
    $.ajax({
        url: FileHOST + 'assets/controller/DeleteAddressController.php',
        method: 'POST',
        data: { "aid": aid },
        success: function (data) {
            GloablData = data;
            console.log(data);
            if (data.status == 'SUCCESS') {
                $('#cart_loader_overview,#search_add_product_loader_overview_background').addClass('hideElement');
                LoadPlaceOrderSection();
            } else {
                $('#cart_loader').addClass('hideElement');
                $('#cart_loader_text').html('Unable to delete address.');
            }
        }
    });
}

function DeleteCard(aid) {
    $('#cart_loader_overview,#search_add_product_loader_overview_background, #cart_loader').removeClass('hideElement');
    $('#cart_loader_text').html('UPDATING');
    $.ajax({
        url: FileHOST + 'assets/controller/DeleteCardController.php',
        method: 'POST',
        data: { "cardid": aid },
        success: function (data) {
            if (data.status == 'SUCCESS') {
                $('#cart_loader_overview,#search_add_product_loader_overview_background').addClass('hideElement');
                LoadPlaceOrderSection();
            } else {
                $('#cart_loader').addClass('hideElement');
                $('#cart_loader_text').html('Unable to delete card.');
            }
        }
    });
}

function LoadCard(data) {
    HTMLOutput = '';
    data = GloablData.card.data;
    for (i = 0; i < data.length; i++) {
        HTMLOutput += '<div class="desktop-3 text-left tablet-6 mobile-11 address-module" id="cardBOX_' + data[i].card_id + '">' +
            '<div>' + data[i].card_number + '</div>' +
            '<div>' + data[i].expiry_date + '</div>' +
            '<div>' + data[i].card_type + '</div>' +
            '<div class="row selectedItemsCards" id="cardBOXSelectedItems_' + data[i].card_id + '">' +
            '<div class="desktop-6 tablet-6 mobile-6 selectAddress" onclick="SelectCard(\'' + data[i].card_id + '\')">' +
            'SELECT' +
            '</div> ' +
            '<div class="desktop-6 tablet-6 mobile-6 deleteAddress" onclick="DeleteCard(\'' + data[i].card_id + '\')">' +
            'DELETE' +
            '</div>' +
            '</div>' +
            '</div>';
    }
    HTMLOutput += '<div class="desktop-3 text-left tablet-6 mobile-11 address-module add-new-address" onclick="addNewCard();">ADD NEW CARD</div>';
    console.log(HTMLOutput);
    $('#CardDetails').html(HTMLOutput);
    HideLoader();
}

function SelectCard(aid) {
    $('.selectedModulecard').removeClass('selectedModulecard');
    $('.selectedItemsCards').removeClass('hideElement');
    $('#cardBOX_' + aid).addClass('selectedModulecard');
    $('#cardBOXSelectedItems_' + aid).addClass('hideElement');
    GlobalSelectedCard = aid;
}

function closeCardBox() {
    $('#card_loader_overview, #search_add_product_loader_overview_background').addClass('hideElement');
}

function addNewCard() {
    $('#card_loader_overview, #search_add_product_loader_overview_background').removeClass('hideElement');
    $('.cardInputElement').val('');
    $('.error').addClass('hideElement');
}

function addCardBox() {

    var elementsToCheck = ['cardNumber', 'expiryMonth', 'expiryYear', 'cvv'];
    everythingOK = true;
    for (i = 0; i < elementsToCheck.length; i++) {
        checkEmptyNess(elementsToCheck[i]);
    }
    if ($('#cardNumber').val().length != 16) {
        $('#cardNumber_error').removeClass('hideElement');
        $('#cardNumber_error').html('Invalid card number format, card number should be of 16 digits');
        everythingOK = false;
    }
    if (parseInt($('#expiryMonth').val()) < 0 || parseInt($('#expiryMonth').val()) > 12) {
        $('#expiryMonth_error').removeClass('hideElement');
        $('#expiryMonth_error').html('Invalid expiry month, expiry month should be in range from 0 till 12');
        everythingOK = false;
    }

    if ($('#cvv').val().length != 3) {
        $('#cvv_error').removeClass('hideElement');
        $('#cvv_error').html('CVV should be of 3 digits');
        everythingOK = false;
    }

    if (everythingOK) {
        $('#card_loader').removeClass('hideElement');
        $.ajax({
            url: FileHOST + 'assets/controller/AddCardController.php',
            method: 'POST',
            data: {
                "card_number": $('#cardNumber').val(), "expiry_date": $('#expiryYear').val() + '-' + $('#expiryMonth').val() + '-01', "cvv": $('#cvv').val()
            },
            success: function (data) {
                $('#card_loader').addClass('hideElement');
                if (data.status == 'SUCCESS') {
                    LoadPlaceOrderSection();
                    closeCardBox();
                } else {
                    $('#address_global_error_card').removeClass('hideElement');
                }
            }
        });
    }
}

function closeCardBox() {
    $('#card_loader_overview, #search_add_product_loader_overview_background').addClass('hideElement');
}

function closeAddressBox() {
    $('#cart_addaddress_loader_overview, #search_add_product_loader_overview_background').addClass('hideElement');
}

function addNewAddress() {
    $('.error').addClass('hideElement');
    $('.addressInputElement').val('');
    $('#cart_addaddress_loader_overview, #search_add_product_loader_overview_background').removeClass('hideElement');
}

function addAddressBox() {
    $('.error').addClass('hideElement');

    var elementsToCheck = ['address_street_address', 'address_appt_number', 'address_postal_code', 'address_city', 'address_province'];
    everythingOK = true;
    for (i = 0; i < elementsToCheck.length; i++) {
        checkEmptyNess(elementsToCheck[i]);
    }
    checkPostalCode();
    if (everythingOK) {
        $('#address_loader').removeClass('hideElement');
        $.ajax({
            url: FileHOST + 'assets/controller/AddAddressController.php',
            method: 'POST',
            data: {
                "addressline1": $('#address_street_address').val(), "addressline2": $('#address_appt_number').val(), "city": $('#address_city').val(), "province": $('#address_province').val(), "postalcode": $('#address_postal_code').val()
            },
            success: function (data) {
                $('#address_loader').addClass('hideElement');
                if (data.status == 'SUCCESS') {
                    LoadPlaceOrderSection();
                    closeAddressBox();
                } else {
                    $('#address_global_error').removeClass('hideElement');
                }
            }
        });
    }
}

function checkPostalCode() {
    var regex1 = RegExp('[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ][0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]');
    if (regex1.test($('#address_postal_code').val()) == false) {
        $('#address_postal_code_error').html('Postal Code is not in correct format, correct format : A0A0A0');
        everythingOK = false;
    }
}

function checkEmptyNess(element) {
    if ($('#' + element).val().trim().length == 0) {
        $('#' + element + '_error').removeClass('hideElement');
        everythingOK = false;
    }
}
function PlaceTheOrder() {
    if (GlobalSelectedAddress == 0) {
        alert('No Address Selected, please select the address');
        return false;
    }

    if (GlobalSelectedCard == 0) {
        alert('No card selected, please select a valid card');
        return false;
    }

    data = GloablData.cart.data;
    console.log(data);
    var Products = [];
    totalAmount = 0;
    for (i = 0; i < data.length; i++) {
        var ProductJSON = new Object();
        ProductJSON.product_id = data[i].prodid;
        ProductJSON.store_id = data[i].storeid;
        ProductJSON.product_order_quantity = data[i].quantity;
        ProductJSON.product_order_price = (data[i].price * data[i].quantity).toString();
        totalAmount += data[i].price * data[i].quantity;
        Products.push(ProductJSON);
    }
    $('#cart_loader_overview,#search_add_product_loader_overview_background, #cart_loader').removeClass('hideElement');
    $('#cart_loader_text').html('PLACING ORDER, PLEASE WAIT');
    $.ajax({
        url: FileHOST + 'assets/controller/PlaceOrder.php',
        method: 'POST',
        data: {
            "address_id": GlobalSelectedAddress.toString(),
            "card_id": GlobalSelectedCard.toString(),
            "order_price": totalAmount.toString(),
            "product_details": JSON.stringify(Products)
        },
        success: function (data) {
            location.href = "orderDetails.php?status=Success&oid=" + data.orderID;
        }
    });
    
}