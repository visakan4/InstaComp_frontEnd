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
    <script src="assets/js/index.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

</head>
<body>


    <!--include the header template-->
    <?php include 'template/header.php'; ?>
    <div id="container_1">
        <div class="container homeContainer">
            <div class="home_text">
                INSTACOMP
            </div>
            <div class="sub_home_text">
                Hyper local product comparison - From Groceries to Automobiles
            </div>
            <div class="search_bar">
                <i class="material-icons absolute">
                    search
                </i>
                <input class="searchBoxText" id="searchBoxText" placeholder="Search anything (eg. onions)" />
            </div>
            <div class="search_bar_results hideElement" id="search_bar_results_container">
                <div class="search_bar_results_loader" id="search_bar_results_loader">
                    <div class="linear-activity" id="home_loader_search_bar">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="search_bar_results_loader_text" id="home_loader_search_bar_text">
                        Loading Results
                    </div>
                </div>
                <div id="search_bar_results_loader_id" class="hideElement">
                </div>
            </div>
        </div>
    </div>

    <!--include the footer template-->
    <?php include 'template/footer.php'; ?>

</body>
</html>