var APIHost = 'https://web.cs.dal.ca/~gayathrib/csci5709/project/';
var FileHOST = 'https://web.cs.dal.ca/~dpsingh/csci5709/project/';

$(document).ready(function () {
    var url = new URL(location.href);
    var c = url.searchParams.get("oid");
    if (c == null) {
        location.href = "myorders.php";
    }
    $.ajax({
        url: FileHOST + 'assets/controller/ViewParticularOrderController.php',
        method: 'POST',
        data: { 'orderid': c },
        success: function (data) {
            $('#cart_loader_overview,#search_add_product_loader_overview_background').addClass('hideElement');
            console.log(data);
            HTMLElements = '';
            if (data.HasOrder == true) {
                $('#orderID').html(data.order.orderid);
                $('#orderDate').html(data.order.order_date);
                totalAmount = 0;
                for (i = 0; i < data.order.product_details.length; i++) {
                    HTMLElements += '<div class="row">' +
                        '<div class="desktop-2 tablet-4 mobile-4">' +
                        '<img class="productImage" alt="onion" src="assets/images/products/' + data.order.product_details[i].prodid + '.png" />' +
                        '</div>' +
                        '<div class="desktop-4 tablet-4 mobile-4">' +
                        '<div class="row cartproductname">' + data.order.product_details[i].prod_name + ' (' + data.order.product_details[i].store_name + ')</div>' +
                        '<div class="row quantity">' +
                        '<span class="quantity-text-cart">Quantity :</span>' +
                        '<span class="quantity-text-cart">' +
                        data.order.product_details[i].quantity +
                        '</span>' +
                        '</div>' +
                        ' </div>' +
                        '<div class="desktop-6 tablet-4 productnetprice mobile-4"> $' +
                        data.order.product_details[i].price +
                        '</div>' +
                        ' </div>';
                    totalAmount += parseFloat(data.order.product_details[i].price);
                }
                $('#netPrice').html(totalAmount);
                $('#streetAddr1').html(data.order.addr_line1);
                $('#streetAddr2').html(data.order.addr_line2);
                $('#postalCode').html(data.order.city + ', ' + data.order.province + ' ' + data.order.postal_code);
                $('#paymentMode').html('<b>' + data.order.cardtype + '</b> **** ' + data.order.cardno.substring(12, 16));
                $('#cartProducts').html(HTMLElements);
                $('#orderDetailsDoesNotExists').addClass('hideElement');
                $('#OrderDetailsExists').removeClass('hideElement');
            } else {
                $('#orderDetailsDoesNotExists').removeClass('hideElement');
                $('#OrderDetailsExists').addClass('hideElement');
            }

            
        }
    });
});

