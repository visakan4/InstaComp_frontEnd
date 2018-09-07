searchResult = '';
var APIHost = 'https://web.cs.dal.ca/~gayathrib/csci5709/project/';
var FileHOST = 'https://web.cs.dal.ca/~dpsingh/csci5709/project/';
var TotalSuperStores = [];
$(document).ready(function () {
    searchResult = decodeURI(getQueryVariable('q'));
    printSearchResults(searchResult);
});

// function source : https://css-tricks.com/snippets/javascript/get-url-variables/
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) { return pair[1]; }
    }
    return (false);
}

function printSearchResults(searchResult) {
    $('#productSearchName').text(decodeURI(getQueryVariable('q')));
    $('#home_loader_search_bar').removeClass('hideElement');
    $('#search_results').addClass('hideElement');
    try {
        $.ajax({
            url: APIHost + 'getSearchResults/' + searchResult,
            method: 'GET',
            success: function (data) {
                JSONObj = data;
                console.log(data);
                if (JSONObj.status == 'SUCCESS') {
                    totalUniqueSuperStores = [];
                    totalUniqueSuperStoresType = [];
                    if (JSONObj.data.length > 0) {

                        $('#search_results_products').html('');
                        for (j = 0; j < JSONObj.data.length; j++) {

                            JSONObjInner = JSONObj.data[j];
                            if (JSONObjInner.length > 0) {
                                // set the item to localstorage (for previous searches)
                                item = []
                                if (localStorage.getItem('site.local.searchedItem') != undefined) {
                                    item = JSON.parse(localStorage.getItem('site.local.searchedItem'));
                                }
                                var product = {
                                    imageLink: 'assets/images/products/' + JSONObjInner[0].prodid + '.png',
                                    link: 'searchResult.php?q=' + searchResult,
                                    name: JSONObjInner[0].prod_name
                                }
                                item.push(product);
                                if (item.length > 5) {
                                    item.shift();
                                }
                                localStorage.setItem('site.local.searchedItem', JSON.stringify(item));

                                HTMLOutput = '';
                                HTMLOutput += '<div class="text-left search_product_row">';
                                HTMLOutput += ' <div class="desktop-12  mobile-12 tablet-11 product-link">';
                                HTMLOutput += '<div class="row">';
                                HTMLOutput += '<div class="f10">' + JSONObjInner[0].category_name + '</div>'
                                HTMLOutput += '<div class="row pT20">';
                                HTMLOutput += '<div class="row pT20  desktop-2">';
                                HTMLOutput += '<div><img class="product_results_image" src="assets/images/products/' + JSONObjInner[0].prodid + '.png" /></div>';
                                HTMLOutput += calculateDistance(JSONObjInner[0]);
                                HTMLOutput += '</div>';
                                HTMLOutput += '<div class="desktop-10 mobile-12 tablet-12">';
                                HTMLOutput += '<div class="product-search-header">' + JSONObjInner[0].prod_name + '</div>';
                                HTMLOutput += '<div class="best-product-div">';
                                HTMLOutput += '<span>Best Price : $ ' + JSONObjInner[0].price + '</span><span class="product_search_store_type"> ' + JSONObjInner[0].store_type + '</span>';
                                if (totalUniqueSuperStores.includes(JSONObjInner[0].storeid) == false) {
                                    totalUniqueSuperStores.push(JSONObjInner[0].storeid);
                                    totalUniqueSuperStoresType.push(JSONObjInner[0].store_name);
                                }
                                HTMLOutput += '<span  class="product_store_image_search"><img class="best-price-product" src="assets/images/stores/' + JSONObjInner[0].storeid + '.png" /></span><span class="product_search_store_type"> ' + JSONObjInner[0].store_name + '</span>';
                                HTMLOutput += '<span class="product-addtocart-btn" onclick="addToCart(\'' + JSONObjInner[0].prodid + '\', \'' + JSONObjInner[0].storeid + '\', \'' + JSONObjInner[0].price + '\');"><span><i class="material-icons product-addtocart-size">shopping_cart</i></span><span>ADD TO CART</span></span></div>';
                                if (JSONObjInner.length > 1) {
                                    HTMLOutput += ' <div class="product-othersuperstore-text">Other superstore prices';
                                    for (i = 1; i < JSONObjInner.length; i++) {
                                        HTMLOutput += '<div class="best-product-div product-other-superstore-prices">' +
                                            '<span>Price : $ ' + JSONObjInner[i].price + ' </span>' +
                                            '<span class="product_search_store_type">' + JSONObjInner[i].store_type + ' </span>' +
                                            '<span class="product_store_image_search"><img class="best-price-product" src="assets/images/stores/' + JSONObjInner[i].storeid + '.png" /></span><span class="product_search_store_type"> ' + JSONObjInner[i].store_name + '</span>' +
                                            '<span class="product-addtocart-btn" onclick="addToCart(\'' + JSONObjInner[i].prodid + '\', \'' + JSONObjInner[i].storeid + '\', \'' + JSONObjInner[i].price + '\');">' +
                                            '<span><i class="material-icons product-addtocart-size">shopping_cart</i></span>' +
                                            '<span>ADD TO CART</span>' +
                                            '</span>' +
                                            '</div>';
                                        if (totalUniqueSuperStores.includes(JSONObjInner[i].storeid) == false) {
                                            totalUniqueSuperStores.push(JSONObjInner[i].storeid);
                                            totalUniqueSuperStoresType.push(JSONObjInner[i].store_name);
                                        }
                                    }

                                    HTMLOutput += '</div>';
                                }
                            }

                            HTMLOutput += '</div></div></div></div>';
                            $('#search_results_products').append(HTMLOutput);
                        }
                        TotalSuperStores = totalUniqueSuperStores;
                        console.log(totalUniqueSuperStores);
                        $.each(totalUniqueSuperStores, function (index, value) {
                            HTMLOutput = ' <div class="row product-page-filter product-page-filter-superstores "><span><input id="Checkbox_' + value + '" type="checkbox" /></span><span class=""><img class="filter-image" src="assets/images/stores/' + value + '.png" /></span><span class="product_search_store_type"> ' + totalUniqueSuperStoresType[index] + '</span></div>';
                            $('#search_superstore').append(HTMLOutput);
                        });

                        $('#home_loader_search_bar, #search_loading_text, home_loader_search_bar').addClass('hideElement');
                        $('#search_results').removeClass('hideElement');
                    } else {
                        $('#home_loader_search_bar').addClass('hideElement');
                        $('#search_loading_text').html('No Results Found');
                        $('#search_results').addClass('hideElement');
                    }
                }
            }
        }).fail(function () {
            $('#home_loader_search_bar').addClass('hideElement');
            $('#search_loading_text').html('Unable to fetch the results this time, please try again later');
            $('#search_results').addClass('hideElement');
        });
    } catch (Exception) {
        $('#home_loader_search_bar').addClass('hideElement');
        $('#search_loading_text').html('An error occured while fetching search results, please try again later');
        $('#search_results').addClass('hideElement');
    }
}

function addToCart(productid, storeid, price) {
    $('#search_add_product_loader_overview_background, #search_add_product_loader_overview').removeClass('hideElement');
    $('#ADDProductToCartText').html('ADDING PRODUCT TO CART');
    $.ajax({
        url: FileHOST + 'assets/controller/addToCartController.php',
        method: 'POST',
        data: { 'pid': productid, 'sid': storeid, 'price': price, 'quantity': 1 },
        success: function (data) {
            console.log(data);
            if (data.status == 'FAIL') {
                $('#search_add_product_loader_overview_background').addClass('hideElement');
                $('#ADDProductToCartText').html(data.responsetext);
            } else {
                location.href = "cart.php";
            }
        }
    });
}
function calculateDistance(data) {
    getLocation();
    if (localStorage.getItem('HasGeoLocation') == false) {
        return '';
    }
    distance = getDistanceFromLatLonInKm(localStorage.getItem('user.lat'), localStorage.getItem('user.long'), data.store_lat, data.store_long);
    return ' <div class="product-search-description">Distance from your location: ' + distance.toFixed(2) + 'km</div >';
}


// source : https://www.w3schools.com/html/html5_geolocation.asp
function getLocation() {
    if (navigator.geolocation) {
        localStorage.setItem('HasGeoLocation', true);
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        localStorage.setItem('HasGeoLocation', false);
    }
}

function showPosition(position) {
    localStorage.setItem('user.lat', position.coords.latitude);
    localStorage.setItem('user.long', position.coords.longitude);
}

// source : https://stackoverflow.com/a/27943
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2)
        ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI / 180)
}

function applyFilter() {
    var checked = [];
    for (i = 0; i < TotalSuperStores.length; i++) {
        if ($('#Checkbox_' + TotalSuperStores[i]).is(':checked') == true) {
            checked.push(TotalSuperStores[i]);
        }
    }

    console.log(checked);

    var outputData = [];
    if (checked.length == 0) {
        alert('Please select atleast 1 item to filter');
    } else {
        $('#search_add_product_loader_overview_background, #search_add_product_loader_overview').removeClass('hideElement');
        $('#ADDProductToCartText').html('UPDATING RESULTS, PLEASE WAIT');
        $.ajax({
            url: APIHost + 'getSearchResults/' + searchResult,
            method: 'GET',
            success: function (data) {
                $('#clearResults').removeClass('hideElement');
                $('#search_add_product_loader_overview_background, #search_add_product_loader_overview').addClass('hideElement');
                JSONObj = data;
                console.log(data);
                for (j = 0; j < data.data.length; j++) {
                    innerElements = [];
                    for (i = 0; i < data.data[j].length; i++) {
                        if ($.inArray(data.data[j][i].storeid, checked) > -1) {
                            innerElements.push(data.data[j][i]);
                        }
                    }
                    outputData.push(innerElements);
                }
                data = outputData;
                console.log(outputData);

                $('#search_results_products').html('');
                for (j = 0; j < data.length; j++) {

                    JSONObjInner = data[j];
                    if (JSONObjInner.length > 0) {
                        // set the item to localstorage (for previous searches)
                        item = []
                        if (localStorage.getItem('site.local.searchedItem') != undefined) {
                            item = JSON.parse(localStorage.getItem('site.local.searchedItem'));
                        }
                        var product = {
                            imageLink: 'assets/images/products/' + JSONObjInner[0].prodid + '.png',
                            link: 'searchResult.php?q=' + searchResult,
                            name: JSONObjInner[0].prod_name
                        }
                        item.push(product);
                        if (item.length > 5) {
                            item.shift();
                        }
                        localStorage.setItem('site.local.searchedItem', JSON.stringify(item));

                        HTMLOutput = '';
                        HTMLOutput += '<div class="text-left search_product_row">';
                        HTMLOutput += ' <div class="desktop-12  mobile-12 tablet-11 product-link">';
                        HTMLOutput += '<div class="row">';
                        HTMLOutput += '<div class="f10">' + JSONObjInner[0].category_name + '</div>'
                        HTMLOutput += '<div class="row pT20">';
                        HTMLOutput += '<div class="row pT20  desktop-2">';
                        HTMLOutput += '<div><img class="product_results_image" src="assets/images/products/' + JSONObjInner[0].prodid + '.png" /></div>';
                        HTMLOutput += calculateDistance(JSONObjInner[0]);
                        HTMLOutput += '</div>';
                        HTMLOutput += '<div class="desktop-10 mobile-12 tablet-12">';
                        HTMLOutput += '<div class="product-search-header">' + JSONObjInner[0].prod_name + '</div>';
                        HTMLOutput += '<div class="best-product-div">';
                        HTMLOutput += '<span>Best Price : $ ' + JSONObjInner[0].price + '</span><span class="product_search_store_type"> ' + JSONObjInner[0].store_type + '</span>';
                        if (totalUniqueSuperStores.includes(JSONObjInner[0].storeid) == false) {
                            totalUniqueSuperStores.push(JSONObjInner[0].storeid);
                            totalUniqueSuperStoresType.push(JSONObjInner[0].store_name);
                        }
                        HTMLOutput += '<span  class="product_store_image_search"><img class="best-price-product" src="assets/images/stores/' + JSONObjInner[0].storeid + '.png" /></span><span class="product_search_store_type"> ' + JSONObjInner[0].store_name + '</span>';
                        HTMLOutput += '<span class="product-addtocart-btn" onclick="addToCart(\'' + JSONObjInner[0].prodid + '\', \'' + JSONObjInner[0].storeid + '\', \'' + JSONObjInner[0].price + '\');"><span><i class="material-icons product-addtocart-size">shopping_cart</i></span><span>ADD TO CART</span></span></div>';
                        if (JSONObjInner.length > 1) {
                            HTMLOutput += ' <div class="product-othersuperstore-text">Other superstore prices';
                            for (i = 1; i < JSONObjInner.length; i++) {
                                HTMLOutput += '<div class="best-product-div product-other-superstore-prices">' +
                                    '<span>Price : $ ' + JSONObjInner[i].price + ' </span>' +
                                    '<span class="product_search_store_type">' + JSONObjInner[i].store_type + ' </span>' +
                                    '<span class="product_store_image_search"><img class="best-price-product" src="assets/images/stores/' + JSONObjInner[i].storeid + '.png" /></span><span class="product_search_store_type"> ' + JSONObjInner[i].store_name + '</span>' +
                                    '<span class="product-addtocart-btn" onclick="addToCart(\'' + JSONObjInner[i].prodid + '\', \'' + JSONObjInner[i].storeid + '\', \'' + JSONObjInner[i].price + '\');">' +
                                    '<span><i class="material-icons product-addtocart-size">shopping_cart</i></span>' +
                                    '<span>ADD TO CART</span>' +
                                    '</span>' +
                                    '</div>';
                                if (totalUniqueSuperStores.includes(JSONObjInner[i].storeid) == false) {
                                    totalUniqueSuperStores.push(JSONObjInner[i].storeid);
                                    totalUniqueSuperStoresType.push(JSONObjInner[i].store_name);
                                }
                            }

                            HTMLOutput += '</div>';
                        }
                    }

                    HTMLOutput += '</div></div></div></div>';
                    $('#search_results_products').append(HTMLOutput);
                }
            }
        });
    }

}

function clearResults() {
    location.href = location.href;
}