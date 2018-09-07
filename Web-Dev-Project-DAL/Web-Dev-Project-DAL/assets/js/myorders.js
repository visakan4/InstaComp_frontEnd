var APIHost = 'https://web.cs.dal.ca/~gayathrib/csci5709/project/';
var FileHOST = 'https://web.cs.dal.ca/~dpsingh/csci5709/project/';

$(document).ready(function () {
    FetchAllOrders();
})

function FetchAllOrders() {
    $.ajax({
        url: FileHOST + 'assets/controller/GetAllOrders.php',
        method: 'POST',
        success: function (data) {
            $('#search_add_product_loader_overview_background, #cart_loader_overview').addClass('hideElement');
            orders = data.data;
            HTML = '';
            if (orders.length > 0) {
                for (i = 0; i < orders.length; i++) {
                    HTML += '<div class="row p10px orderRow">' +
                        '<div class="row desktop-12 tablet-12 mobile-12">' +
                        'Order Number :' +
                        '<span> ' + orders[i].orderid + '</span>' +
                        '</div>' +
                        '<div class="row desktop-12 tablet-12 mobile-12">' +
                        'Date Of Order :' +
                        '<span>' + orders[i].order_date + '</span>' +
                        '</div>' +
                        '<div class="row desktop-12 tablet-12 mobile-12">' +
                        'Status :' +
                        '<span>' + orders[i].order_status + '</span>' +
                        '</div>' +
                        '<div class="row btnOrderRow">' +
                        '<span>' +
                        '<input type="button" class="trackBtn" onclick="window.location=\'orderDetails.php?oid=' + orders[i].orderid + '\';" return false;" value="Track Order" />' +
                        '</span>' +
                        '</div>' +
                        '</div>';
                }
                $('#orderDetails').html(HTML);
            } else {
                $('#orderDetails').html("<div class='noMyOrders'>There are currently no orders placed</div>");
            }
        }
    });
}