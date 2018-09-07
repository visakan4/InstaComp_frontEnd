$(document).ready(function () {
    initMenuClick('item_1', 'sub_item_1');
    initMenuClick('item_2', 'sub_item_2');
    initMenuClick('sub_item_1_1', 'sub_item_1_1_1');
    initMenuClick('sub_item_1_2', 'sub_item_1_2_1');
    initMenuClick('sub_item_1_3', 'sub_item_1_3_1');
    initMenuClick('sub_item_2_1', 'sub_item_2_1_1');
    initMenuClick('sub_item_2_1_1', 'sub_item_2_1_1_1');
    initMenuClick('sub_item_2_1_2', 'sub_item_2_1_1_2');
    loadLocalStoragePreviouslySearchedItems();
})

function initMenuClick(source, destination) {
    $('#' + source).on('click', function (e) {
        if ($('#' + destination).hasClass('hideElement')) {
            $('#' + destination).removeClass('hideElement');
        } else {
            $('#' + destination).addClass('hideElement');
        }
        e.stopImmediatePropagation();
    });
}

function showMenu() {
    if ($('#menuContainer').hasClass('hideElement')) {
        $('#menuContainer').removeClass('hideElement');
    } else {
        $('#menuContainer').addClass('hideElement');
    }
}

function showRightMenu() {
    if ($('#rightMenuContent').hasClass('hide-mobile hide-tablet')) {
        $('#rightMenuContent').removeClass('hide-mobile hide-tablet');
    } else {
        $('#rightMenuContent').addClass('hide-mobile hide-tablet');
    }
}

function validate() {
    validated = true;
    // this is the funciton for the register script
    validateEmptyFields();
}

function validateEmptyFields() {
    // this function will validate the address
    // we are only checking the validity of the fields
    // whether they are empty or not ?

    // validate all the fields
    displayValidationText("placeOrderName", "Name");
    displayValidationText("address1", "Address 1");
    displayValidationText("address2", "Address 2");
    displayValidationText("postalCode", "Postal Code");
    displayValidationText("phoneNumber", "Phone Number");
    displayValidationText("cardName", "Card Name");
    displayValidationText("cardNumber", "Card Number");
    displayValidationText("cardExpiry", "Card Expiry");
    displayValidationText("cvv", "CVV");
    validatePostalCode("postalCode");
    validatePhoneNumber("phoneNumber");

    // credit card validation
    // source : https://stackoverflow.com/a/40775759
    ValidateCreditCardNumber("cardNumber");
    validateMMYY("cardExpiry");
    validateCVV("cvv");

    if (validated) {
        alert('Everything validated. Process flow will now go through PHP');
    }
}

function validateCVV(elementID) {
    regex = /[0-9][0-9][0-9]/;
    if (regex.test($('#' + elementID).val()) == false) {
        $('#' + elementID + 'Error').text('Invalid CVV number')
        $('#' + elementID + 'Error').fadeIn();
        $('#' + elementID).addClass('errorInputPlaceOrder');
        validated = false;
    }
}

function ValidateCreditCardNumber(elementID) {

    var ccNum = document.getElementById(elementID).value;
    var visaRegEx = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    var mastercardRegEx = /^(?:5[1-5][0-9]{14})$/;
    var amexpRegEx = /^(?:3[47][0-9]{13})$/;
    var discovRegEx = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
    var isValid = false;

    if (visaRegEx.test(ccNum)) {
        isValid = true;
    } else if (mastercardRegEx.test(ccNum)) {
        isValid = true;
    } else if (amexpRegEx.test(ccNum)) {
        isValid = true;
    } else if (discovRegEx.test(ccNum)) {
        isValid = true;
    }

    if (!isValid) {
        $('#' + elementID + 'Error').text('Invalid Card number')
        $('#' + elementID + 'Error').fadeIn();
        $('#' + elementID).addClass('errorInputPlaceOrder');
        validated = false;
    }
}

function validateMMYY(elementID) {
    allCorrect = true;
    try {
        var mmyy = $('#' + elementID).val();
        str = mmyy.split('/');
        month = parseInt(str[0]);
        year = parseInt(str[1]);
        if (month >= 1 && month <= 12) {
            if (year >= 18 && year <= 99) {
                allCorrect = true;
            } else {
                allCorrect = false;
            }
        } else {
            allCorrect = false;
        }

    } catch (Exception) {
        allCorrect = false;

    }

    if (!allCorrect) {
        $('#' + elementID + 'Error').text('Invalid Date format, please enter a valid date format');
        $('#' + elementID + 'Error').fadeIn();
        $('#' + elementID).addClass('errorInputPlaceOrder');
        validated = false;
    }
}

function validatePostalCode(elementID) {
    if (/[a-zA-z]{1}\d{1}[a-zA-z]{1}\s{0,1}\d{1}[a-zA-z]{1}\d{1}/.test($('#' + elementID).val().trim().toLowerCase()) == false) {
        $('#' + elementID + 'Error').text('Postal Code is not in correct format')
        $('#' + elementID + 'Error').fadeIn();
        $('#' + elementID).addClass('errorInputPlaceOrder');
        validated = false;
    } else {
        $('#' + elementID).val($('#' + elementID).val().trim());
    }
}

function validatePhoneNumber(elementID) {
    if (/\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*/.test($('#' + elementID).val().trim().toLowerCase()) == false) {
        $('#' + elementID + 'Error').text('Phone Number is not in correct format')
        $('#' + elementID + 'Error').fadeIn();
        $('#' + elementID).addClass('errorInputPlaceOrder');
        validated = false;
    } else {
        $('#' + elementID).val($('#' + elementID).val().trim());
    }
}

function displayValidationText(elementID, elementName) {
    if ($('#' + elementID).val().trim().length == 0) {
        $('#' + elementID + 'Error').fadeIn();
        $('#' + elementID).addClass('errorInputPlaceOrder');
        $('#' + elementID + 'Error').text(elementName + " is required");
        validated = false;
    } else {
        $('#' + elementID).val($('#' + elementID).val().trim());
        $('#' + elementID + 'Error').fadeOut();
        $('#' + elementID).removeClass('errorInputPlaceOrder');
    }
}

function loadLocalStoragePreviouslySearchedItems() {
    // check if the localstorage key exists
    var localStorageItem = '';
    var item = null;
    if (localStorage.getItem('site.local.searchedItem') == undefined) {
        // for demo purpose
        // create a local stub
        //item = []
        //var product = {
        //    imageLink: 'assets/images/potatoOnions.png',
        //    link: 'product.php?item=onoins',
        //    name: 'onions'
        //}
        //item.push(product);
        //item.push(product);
        //localStorage.setItem('site.local.searchedItem', JSON.stringify(item));
    } else {
        // get the items
        item = JSON.parse(localStorage.getItem('site.local.searchedItem'));
    }
    // add the item to HTML file
    for (icount = 0; icount < item.length; icount++) {
        console.log(item[icount].imageLink);
        $('.searchedItem').append('<div class="searchedImg"><a href="' + item[icount].link + '"><img class="searchedImage" src = "' + item[icount].imageLink + '"></img></a></div>');
    }

    console.log(item);
}