<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link type="text/css" href="Assets/Files/CSS/show_products.css" rel="stylesheet">

    <title>Show Products</title>
</head>

<body>

    <?php include("Assets/Components/navbar.php") ?>
    <div class="container">
        <div class="auctions_elem mt-2">
            <div class="auction_card">
                <div class="card mb-3 custom_card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="https://source.unsplash.com/1600x900/?city,USA" class="card_img" alt="...">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="card-title"><b>Product Title</b></h4>
                                <p class="card-text">Current Bid</p>
                                <p class="card-text">Base Price</p>
                                <button class="btn checkoutmore">Bidding Option</button>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 custom_card">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body">
                                <p class="card-text">Description</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 custom_card">
                    <div class="row g-0">
                        <div class="col border">
                            <div class="card-body">
                                <p class="card-text">-</p>

                            </div>
                        </div>
                        <div class="col border">
                            <div class="card-body">
                                <p class="card-text">Current Bid</p>
                            </div>
                        </div>
                        <div class="col border">
                            <div class="card-body">
                                <p class="card-text">+</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn checkoutmore" style="margin-left:500px;">Place Bid</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>