<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
    require_once("partial/_dbConnect.php");
    if(isset($_GET['id']))
    {
        $sql="SELECT * FROM product WHERE product_id=".$_GET["id"];
        $res=mysqli_query($link,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $title=$row['product_name'];
            $desc=$row["product_details"];
            $base_bid=$row["base_bid"];
            $current_bid=$row["current_bid"];

        }
    }
    else
    {
        header("location:http://localhost/OnlineBidding/index.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link type="text/css" href="Assets/Files/CSS/show_products.css" rel="stylesheet">
    <script src="Assets/Files/JS/ws.js"></script>
    <title>Show Products</title>
</head>

<body>

    <?php include("Assets/Components/navbar.php") ?>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 my-4">
            <div class="auctions_elem mt-2">
                <div class="auction_card">
                    <div class="card mb-3 custom_card">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="https://source.unsplash.com/1600x900/?city,USA" class="card_img" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title" style="border-bottom:2px solid #66fcf1 ; padding-bottom:10px"><b><?php echo $title; ?></b></h4>
                                    <p class="card-text"><b>Current Bid</b>:$<?php echo $current_bid; ?></p>
                                    <p class="card-text" id="base_p"><b >Base Price</b>:$<?php echo $base_bid;?></p>
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
                                    <h4 class="card-text"><b>Description</b></h4>
                                    <p><?php echo $desc; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 custom_card">
                        <div class="place_bids">
                            <div class="row mt-3" style="width:30%;margin-left:270px">
                                <div class="col-2"><button id="minus" class="btn cust_btn_1"><b>-</b></button></div>
                                <div class="col-8 txt mt-2" id="cur_bid"><b><?php
                                
                                $cur_price=$current_bid;
                                if($current_bid==0)
                                {
                                    $cur_price=$base_bid;
                                }
                                else
                                {
                                    $cur_price=$base_bid+(int)$base_bid*0.1;
                                }
                                echo $cur_price;
                                
                                
                                ?></b></div>
                                <div class="col-2"><button id="plus" class="btn cust_btn_1"><b>+</b></button></div>
                            </div>
                            <div class="row my-2">
                                <button class="btn checkoutmore plc_bid">Place Bid</button>
                            </div>
                            <div class="row">
                                <p class="text-center">The bid must be in increments of 10% of the current bid. ex:if the current bid is $100 next bid must be $110. </p>
                            </div>
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