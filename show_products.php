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
            $auction_id=$row["auction_id"];
        }
        $sql1="SELECT * FROM auction WHERE auction_id=".$auction_id;
        $res=mysqli_query($link,$sql1);
        while($row=mysqli_fetch_assoc($res))
        {
            $city=$row["auction_city"];
            $country=$row["auction_country"];
            $seller=$row["user_id"];
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
                                    <p class="card-text"><b>Current Bid</b>:$<span id="curr_bid"><?php echo $current_bid; ?></span></p>
                                    <p class="card-text" id="base_p"><b >Base Price</b>:$<?php echo $base_bid;?></p>
                                    <button class="btn checkoutmore">Bidding Option</button>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-3 custom_card">
                        <div class="place_bids">
                            <div class="row mt-3" style="width:30%;margin-left:270px">
                                <div class="col-2"><button id="minus" class="btn cust_btn_1"><b>-</b></button></div>
                                <div class="col-8 txt mt-2" id="cur_bid"><b><?php
                                
                                echo '10';
                                
                                
                                ?>%</b></div>
                                <div class="col-2"><button id="plus" class="btn cust_btn_1"><b>+</b></button></div>
                            </div>
                            <div class="row my-2" style="margin-left:300px">
                            <div class="col-3"><b>Current Bid:</b></div>
                            <div class="col-2" id="current_bid"><?php
                            
                            if($current_bid==0)
                            {
                                echo $base_bid;
                            }
                            else
                            {
                                echo $current_bid+$current_bid*0.1;
                            }
                            
                            ?></div>
                            </div>
                            <div class="row my-2">
                                <button class="btn checkoutmore plc_bid" id="place_bid">Place Bid</button>
                            </div>
                            <div class="row">
                                <p class="text-center">If the current bid is $0 then you cannot increase bid more than base price.Thenafter the bid could be raised till whatever extend you want.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 custom_card">
                        <div class="row g-0">
                            <div class="col">
                                <div class="card-body">
                                <ul>
                                   <li><h4 class="card-text"><b>Description</b></h4>
                                    <p><?php echo $desc; ?></p></li>
                                    <li><h4 class="card-text"><b>City:</b></h4><p><?php echo $city; ?></p></li>
                                    <li><h4 class="card-text"><b>Country of origin:</b></h4><p><?php echo $country; ?></p></li>
                                    <li><h4 class="card-text"><b>Seller:</b></h4><p><?php echo $seller; ?></p></li>
                                </ul>
                                </div>
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