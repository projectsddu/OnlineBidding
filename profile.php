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

    <title>Home Page</title>
</head>

<body style="color:white">
    <?php
    include "Assets/Components/navbar.php";
    ?>
    <div class="container">
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
                                Jenil J Gandhi
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Email:
                            </div>
                            <div class="col-8">
                                jenilgandhi2111@gmail.com
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                City:
                            </div>
                            <div class="col-8">
                                <?php echo $_SESSION["city"]; ?>
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Country:
                            </div>
                            <div class="col-8">
                                <?php echo $_SESSION["country"]; ?>
                            </div>
                        </div>
                        <div class="row rowcol">
                            <div class="col-4">
                                Auctions :
                            </div>
                            <div class="col-8">
                                5
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Total capitalization:
                            </div>
                            <div class="col-8">
                                $35000
                            </div>
                        </div>

                        <div class="row rowcol">
                            <div class="col-4">
                                Total A/C Balance:
                            </div>
                            <div class="col-8">
                                $3527000
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <hr>
            <div class="col container mt-2">
                <h2 class="m-2">Currently Active Auctions</h2>
                <div class="alert login_hov alert-dismissible fade show" role="alert">
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
                            Start from-to
                        </div>
                        <div class="col-2">
                            Add products
                        </div>
                        <div class="col-2">
                            View auction page
                        </div>
                    </div>

                </div>
                <div class="alert login_hov alert-dismissible fade show" role="alert">
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
                            Start from-to
                        </div>
                        <div class="col-2">
                            Add products
                        </div>
                        <div class="col-2">
                            View auction page
                        </div>
                    </div>

                </div>
            </div>

            <div class="col">
                <h2 class="m-4">Ended Auctions</h2>
                <div class="col container">
                <div class="alert login_hov alert-dismissible fade show" role="alert">
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
                            Start from-to
                        </div>
                        <div class="col-2">
                            Add products
                        </div>
                        <div class="col-2">
                            View auction page
                        </div>
                    </div>

                </div>
                </div>
            </div>
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