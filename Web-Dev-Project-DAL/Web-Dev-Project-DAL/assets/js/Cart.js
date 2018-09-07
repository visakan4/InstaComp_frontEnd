var APIHost = 'https://web.cs.dal.ca/~gayathrib/csci5709/project/';
var FileHOST = 'https://web.cs.dal.ca/~dpsingh/csci5709/project/';

$(document).ready(function () {
    LoadCart();
});
function LoadCart() {
    $('#cartProducts, #totalSubItemsCart').addClass('hideElement');
    $('#CartLoader').removeClass('hideElement');
    $.ajax({
        url: FileHOST + 'assets/controller/GetCartController.php',
        method: 'POST',
        success: function (data) {
            console.log(data);
            if (data.status == 'SUCCESS') {
                HTMLOutput = '';
                
                totalAmount = 0;
                if (data.data.length == 0) {
                    $('#CartLoader').removeClass('hideElement');
                    $('#home_load_add_cart_loader').addClass('hideElement');
                    $('#cart-loader-text').html('CART IS EMPTY');
                } else {
                    
                    data = data.data;
                    $('#cart-loader-text').html('LOADING CART');
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
                    $('#cartProducts, #totalSubItemsCart, #CheckoutBtn').removeClass('hideElement');
                    $('#CartLoader').addClass('hideElement');
                    $('#cartProducts').html(HTMLOutput);
                    $("#totalAmountCart").html('$' + totalAmount.toFixed(2));
                }
               
            } else {
                location.href = FileHOST;
            }
        }
    });
}
function deleteCart(cartID) {
    $('#cart_loader_overview, #cart_loader, #search_add_product_loader_overview_background').removeClass('hideElement');
    $.ajax({
        url: FileHOST + 'assets/controller/DeleteCartController.php',
        method: 'POST',
        data: { 'cartid': cartID },
        success: function (data) {
            if (data.status == 'SUCCESS') {
                $('#cart_loader_overview, #cart_loader, #search_add_product_loader_overview_background').addClass('hideElement');
                LoadCart();
            } else {
                $('#cart_loader').addClass('hideElement');
                $('#ADDProductToCartText').html('Unable to update the cart, please try again later');
            }
        }
    });
}
