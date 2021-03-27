<?php
require_once("partial/_dbConnect.php");
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
$msg = "";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auction_name = $_POST["auction_name"];
    $auction_description = $_POST["auction_description"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $reach = $_POST["option"];

    // echo $auction_description.$auction_name.$start_date.$end_date."kljasndfjkasdnfk".$reach;
    include "auction_verify.php";
    if (!is_empty($auction_name, $auction_description, $start_date, $end_date)) {
        if (check_dates($start_date, $end_date)) {

            if (check_money($reach)) {

                add_auction($auction_name, $auction_description, $start_date, $end_date);
                $msg = "Your auction is successfully created";
            } else {
                header("location:host_auction.php?msg=" . "Not enough money to host this kind of auction try adding money");
            }
        } else {
            header("location:host_auction.php?msg=" . "Start date cannot be greater than end date");
        }
    } else {
        header("location:host_auction.php?msg=" . "Fields cannot be empty!");
    }
}

// fetch username, money, city, country
$sql = "SELECT * FROM user WHERE user_id = " . $_SESSION["user_id"];
// echo $sql;

$res = mysqli_query($link, $sql);

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $username = $row['username'];
        $email = $row['email'];
        $city = $row['city'];
        $country = $row['country'];
        $total_money = $row['money'];
    }
}

// fetch number of auctions

$sql1 = "SELECT * FROM auction WHERE user_id = " . $_SESSION["user_id"];
// echo $sql1;
$res1 = mysqli_query($link, $sql1);

$auctions_count = mysqli_num_rows($res1);


// fetch capitalization

// fetch total amount currently in max_bid
// $sql1 = "SELECT SUM(current_bid) AS sum FROM product WHERE max_bid = " . $_SESSION["user_id"];
// // echo $sql1;
// $res1 = mysqli_query($link, $sql1);
// if ($res1) {
//     while ($row = mysqli_fetch_assoc($res1)) {
//         // store sunm
//         $sum = $row["sum"];
//     }
// } else {
//     echo "else innnnnnnnn";
// }

$total_cap = 0;

$sql5 = "SELECT SUM(current_bid) AS sum 
        FROM (auction AS a INNER JOIN product AS p ON a.auction_id = p.auction_id)
        WHERE user_id = ".$_SESSION['user_id'];
        

$res5 = mysqli_query($link,$sql5);

if ($res5) {
    while ($row = mysqli_fetch_assoc($res5)) {
        // store sunm
        $total_cap= $row["sum"];
    }
} else {
    echo "else innnnnnnnn";
}

if($total_cap == NULL)
{
    $total_cap = 0;
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
    <link type="text/css" href="Assets/Files/CSS/show_products.css" rel="stylesheet">

    <title>Home Page</title>
</head>

<body style="color:white">
    <?php
    include "Assets/Components/navbar.php";
    ?>
    <div class="container mb-4">
        <div class="profile mt-3 custom_card_1">
            <div class="row">
                <div class="col-3 m-2">
                    <div class="cont">
                        <img src="https://source.unsplash.com/1600x900/?city,USA" alt="Avatar" class="image">
                        <div class="middle">
                            <div class="text">
                                <div class="upload-btn-wrapper">
                                    <button class="btn btn1">Change profile image</button>
                                    <input type="file" name="myfile" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 m-4">
                    <!-- Details here -->
                    <div class="col">

                        <div class="row rowcol">
                            <div class="col-4">
                                Name:
                            </div>
                            <div class="col-8">
                                <?php echo $username; ?>
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Email:
                            </div>
                            <div class="col-8">
                                <?php echo $email; ?>
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                City:
                            </div>
                            <div class="col-8">
                                <?php
                                // echo $_SESSION["city"]; 
                                ?>
                                <?php echo $city; ?>
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Country:
                            </div>
                            <div class="col-8">
                                <?php
                                // echo $_SESSION["country"]; 
                                ?>
                                <?php echo $country; ?>
                            </div>
                        </div>
                        <div class="row rowcol">
                            <div class="col-4">
                                Auctions :
                            </div>
                            <div class="col-8">
                                <?php echo $auctions_count; ?>
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Total capitalization:
                            </div>
                            <div class="col-8">
                                <?php echo $total_cap; ?>
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Total A/C Balance:
                            </div>
                            <div class="col-8">
                                <?php echo $total_money; ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <hr>
            <h2 class="m-2">Currently Active Auctions</h2>

            <?php

            $sql = "SELECT * FROM auction WHERE user_id = " . $_SESSION['user_id'] . " AND valid_date > '" . date("Y/m/d") . "'";
            // echo $sql;
            $res = mysqli_query($link, $sql);

            if (mysqli_num_rows($res) == 0) {
                // echo "there is no auction hosted by user.";
                echo '<div class="container mt-3"> 
                    <div class="alert loginbtn alert-dismissible fade show" role="alert">
                    <strong> There is no auction hosted by user. &nbsp; &nbsp;
                    <a href="host_auction.php"> <button class="btn add_product_btn" style="width: 200px;"> <b>Go to Host Auction</b></button></a>
                    </strong>

                </div>
                </div>';
            } else {
                echo '<div class="col container mt-2">
                            
                            <div class="alert login_hov_fill alert-dismissible fade show" role="alert">
                                <div class="row">
                                    <div class="col-2">
                                        Auction_name
                                    </div>
                                    <div class="col-2">
                                        Auction_products
                                    </div>
                                    <div class="col-2">
                                        Capitalization
                                    </div>
                                    <div class="col-2">
                                        End Date
                                    </div>
                                    <div class="col-2">
                                        Add products
                                    </div>
                                    <div class="col-2">
                                        View auction page
                                    </div>
                                </div>

                            </div>
                            
                        </div>';
                while ($row = mysqli_fetch_assoc($res)) {

                    // fetch no of products
                    $sql2 = "SELECT * FROM product WHERE auction_id = " . $row['auction_id'];
                    // echo $sql2; 
                    $res2 = mysqli_query($link, $sql2);
                    $no_of_products = mysqli_num_rows($res2);

                    $sql3 = "SELECT SUM(current_bid) AS sum FROM product WHERE auction_id = " . $row['auction_id'];
                    // echo $sql1;
                    $res3 = mysqli_query($link, $sql3);
                    if ($res3) {
                        while ($row3 = mysqli_fetch_assoc($res3)) {
                            // store sunm
                            $capital = $row3["sum"];
                        }
                    }
                    else {
                        echo "errorrrrrrrrrrrrrrrrrr";
                    }
                    echo '<div class="col container mt-2">
                            
                            <div class="alert login_hov alert-dismissible fade show" role="alert">
                                <div class="row">
                                    <div class="col-2">
                                        ' . $row["auction_title"] . '
                                    </div>
                                    <div class="col-2">
                                        ' . $no_of_products . '
                                    </div>
                                    <div class="col-2">
                                    ' . $capital . '
                                    </div>
                                    <div class="col-2">
                                    ' . $row["valid_date"] . '
                                    </div>
                                    <div class="col-2">
                                        <a href="add_products.php?aid=' . $row["auction_id"] . '" > <button class="btn add_product_btn" style="margin-right: 20px;"> <b>Add Product </b></button></a> 
                                        </div>
                                    <div class="col-2">
                                    <a href="auction_view.php?id=' . $row["auction_id"] . '" > <button class="btn auction_btn" style="width: 180px;"> <b>View Auction</b></button></a> 
                                    </div>
                                    </div>
                                </div>

                            </div>
                            
                        ';
                };
            }

            ?>
            <hr>
            <h2 class="m-4">Ended Auctions</h2>
            <?php

            $sql = "SELECT * FROM auction WHERE user_id = " . $_SESSION['user_id'] . " AND valid_date < '" . date("Y/m/d") . "'";
            // echo $sql;
            $res = mysqli_query($link, $sql);

            if (mysqli_num_rows($res) == 0) {
                // echo "there is no auction hosted by user.";
                echo '<div class="container mt-3"> 
                    <div class="alert loginbtn alert-dismissible fade show" role="alert">
                    <strong> There is no auction hosted by user. &nbsp; &nbsp;
                    <a href="host_auction.php"> <button class="btn add_product_btn" style="width: 200px;"> <b>Go to Host Auction</b></button></a>
                    </strong>
                
                </div>
                </div>';
            } else {
                echo '<div class="col container mt-2">
                
                <div class="alert login_hov_fill alert-dismissible fade show" role="alert">
                    <div class="row">
                        <div class="col-2">
                            Auction_name
                        </div>
                        <div class="col-2">
                            Auction_products
                        </div>
                        <div class="col-2">
                            Capitalization
                        </div>
                        <div class="col-2">
                            End Date
                        </div>
                        <div class="col-2">
                            Add products
                        </div>
                        <div class="col-2">
                            View auction page
                        </div>
                    </div>

                </div>
                
            </div>';
                while ($row = mysqli_fetch_assoc($res)) {

                    // fetch no of products
                    $sql2 = "SELECT * FROM product WHERE auction_id = " . $row['auction_id'];
                    // echo $sql2; 
                    $res2 = mysqli_query($link, $sql2);
                    $no_of_products = mysqli_num_rows($res2);

                    $sql3 = "SELECT SUM(current_bid) AS sum FROM product WHERE auction_id = " . $row['auction_id'];
                    // echo $sql1;
                    $res3 = mysqli_query($link, $sql3);
                    if ($res3) {
                        while ($row3 = mysqli_fetch_assoc($res3)) {
                            // store sunm
                            $capital = $row3["sum"];
                        }
                    }
                    else {
                        echo "errorrrrrrrrrrrrrrrrrr";
                    }

                    echo '<div class="col container mt-2">
                
                        <div class="alert login_hov alert-dismissible fade show" role="alert">
                            <div class="row">
                                <div class="col-2">
                                    ' . $row["auction_title"] . '
                                </div>
                                <div class="col-2">
                                    ' . $no_of_products . '
                                </div>
                                <div class="col-2">
                                ' . $capital . '
                                </div>
                                <div class="col-2">
                                ' . $row["valid_date"] . '
                                </div>
                                <div class="col-2">
                                    <a href="add_products.php?aid=' . $row["auction_id"] . '" > <button class="btn add_product_btn" style="margin-right: 20px;"> <b>Add Product </b></button></a> 
                                    </div>
                                <div class="col-2">
                                <a href="auction_view.php?id=' . $row["auction_id"] . '" > <button class="btn auction_btn" style="width: 180px;"> <b>View Auction</b></button></a> 
                                </div>
                                </div>
                            </div>

                        </div>
                
            ';
                }
                echo '</div>';
                echo '</div>';
            }

            ?>



        </div>
    </div>

    <!-- End of form for auction  -->
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