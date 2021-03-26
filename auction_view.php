
<?php
require_once("partial/_dbConnect.php");
    if(isset($_GET['id']))
    {
        $sql="SELECT * FROM auction WHERE auction_id=".$_GET['id'];
        $res=mysqli_query($link,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $title=$row["auction_title"];
            $desc=$row["description"];
        }
        if(mysqli_num_rows($res)==0)
        {

            header("location:http://localhost/OnlineBidding/index.php");
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
    <link type="text/css" href="Assets/Files/CSS/home.css" rel="stylesheet">

    <title>Auction</title>
</head>

<body>
    <?php include("Assets/Components/navbar.php"); ?>
    <div class="row my-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="auctions_elem mt-2">
                <h1 class="mb-3"><b><?php echo $title; ?></b></h1>
                <p><?php echo $desc; ?></p>
                <?php

                $sql="SELECT * FROM product WHERE auction_id=".$_GET['id'];
                // echo $sql;
                $result=mysqli_query($link,$sql);
                while($row=mysqli_fetch_assoc($result))
                {
                echo '<div class="auction_card">
                    <div class="card mb-3 custom_card">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="https://source.unsplash.com/1600x900/?city,USA" class="card_img" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title"><b>'.$row["product_name"].'</b></h4>
                                    <h5 style="color:#ccff00">Current Bid:$'.$row["current_bid"].'</h5>
                                    <p style="color:#03fc84">Base bid:$'.$row["base_bid"].'</p>
                                    <p class="card-text">'.$row["product_details"].'</p>
                                    <a href="http://localhost/OnlineBidding/show_products.php?id='.$row["product_id"].'"><button class="btn checkoutmore">Bid Here</button></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                    ?>
                </div>
                

        </div>
        <div class="col-2"></div>
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
