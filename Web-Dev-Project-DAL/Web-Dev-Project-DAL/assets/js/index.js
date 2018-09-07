// source : https://schier.co/blog/2014/12/08/wait-for-user-to-stop-typing-using-javascript.html
var APIHost = 'https://web.cs.dal.ca/~gayathrib/csci5709/project/';
var FileHOST = 'https://web.cs.dal.ca/~dpsingh/csci5709/project/';
$(document).ready(function () {
    // Init a timeout variable to be used below
    var timeout = null;
    $('#searchBoxText').val('');
    // Listen for keystroke events
    $('#searchBoxText').keyup(function () {
        clearTimeout(timeout);
        $('#searchBoxText').val($('#searchBoxText').val().trim());
        if ($('#searchBoxText').val().trim().length == 0) {
            $('#search_bar_results_container, #home_loader_search_bar_text, #home_loader_search_bar, #search_bar_results_loader').addClass('hideElement');
        } else {
            $('#search_bar_results_container, #home_loader_search_bar_text, #home_loader_search_bar, #search_bar_results_loader').removeClass('hideElement');
            $('#search_bar_results_loader_id').addClass('hideElement');
            $('#home_loader_search_bar_text').html('Loading results');
            $('#search_bar_results_container').slideDown();
            // Make a new timeout set to go off in 800ms
            timeout = setTimeout(function () {
                CallSearchFunction();
            }, 500);
        }

    });
});

function CallSearchFunction() {
    try {
        $('#search_bar_results_loader_id').html('');
        HTMLResults = '';
        GetProductSearchSource();
    } catch (Exception) {
        console.log(Exception);
        $('#home_loader_search_bar').addClass('hideElement');
        $('#home_loader_search_bar_text').html('Unable to view results this time, please try again later ');
    }
}

function GetProductSearchSource() {
    var results = '';
    try {
        $.ajax({
            url: APIHost + 'getSearchResults/' + $('#searchBoxText').val(),
            method: 'GET',
            success: function (data) {
                JSONObj = data;
                if (JSONObj.status == 'SUCCESS') {
                    if (JSONObj.data.length > 0) {
                        for (i = 0; i < JSONObj.data.length; i++) {
                            if (JSONObj.data[i].length > 0) {
                                HTMLResults = '';
                                HTMLResults += '<a class="search_results_redirect_link" href=\'' + FileHOST + '/searchResult.php?q=' + encodeURI(JSONObj.data[i][0].prod_name) + '\'><div class="search_results_row">';
                                HTMLResults += '<div class="search_results_category">' + JSONObj.data[i][0].category_name + '</div>';
                                HTMLResults += '<div class="row no-margin">';
                                HTMLResults += '<div class="desktop-4"><img class="search_results_image" src="' + FileHOST + '/assets/images/products/' + JSONObj.data[i][0].prodid + '.png" /></div>';
                                HTMLResults += '<div class="desktop-8"><div class="search_results_product_header search_results_product_name">' + JSONObj.data[i][0].prod_name + '</div></div>';
                                HTMLResults += '</div></div></a>';
                                $('#search_bar_results_loader_id').append(HTMLResults);
                                HTMLResults = '';
                            }
                        }

                        $('#search_bar_results_loader').addClass('hideElement');
                        $('#search_bar_results_loader_id').removeClass('hideElement');
                    } else {
                        $('#home_loader_search_bar').addClass('hideElement');
                        $('#home_loader_search_bar_text').html('No results found');
                    }
                } else {
                    $('#home_loader_search_bar').addClass('hideElement');
                    $('#home_loader_search_bar_text').html('Unable to view results this time, please try again later');
                }
            }
        });
    } catch (Exception) {
        $('#home_loader_search_bar').addClass('hideElement');
        $('#home_loader_search_bar_text').html('Unable to view results this time, please try again later');
    }

}