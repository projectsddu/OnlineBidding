<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
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
    if (!is_empty($auction_name, $auction_description, $start_date, $end_date)) 
    {
        if(check_dates($start_date,$end_date))
        {
            
            if(check_money($reach))
            {
                
                add_auction($auction_name,$auction_description,$start_date,$end_date,$reach);
                $sql="SELECT auction_id from auction WHERE auction_title='".$auction_name."'";
                $res=mysqli_query($link,$sql);
                while($row=mysqli_fetch_assoc($res))
                {
                    $aid=$row["auction_id"];
                    break;
                }
                header("location:add_products.php?aid=" .$aid. " && msg=" . "Successfully created your auction");
                echo "Auction is created";
                
            }
            else
            {
                header("location:host_auction.php?msg=" . "Not enough money to host this kind of auction try adding money");
            }
        }
        else
        {
            header("location:host_auction.php?msg=" . "Start date cannot be greater than end date");
        }
    } 
    else 
    {
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
    <div class="container mt-3">
        <?php
        if ($msg != "") {
            echo '<div class="alert loginbtn alert-dismissible fade show" role="alert">
            <strong>' . $msg . '</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
    </div>
    <!-- Form for auction -->
    <form class="container mt-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><b>Auction Name:</b></label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="auction_name">

        </div>
        <div class="mb-3 ">
            <label for="exampleFormControlTextarea1" class="form-label"><b>Auction Description:</b></label>
            <textarea class="form-control txtarea" name="auction_description" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><b>Start Date:</b></label>
            <input type="date" class="form-control" name="start_date" id="exampleInputEmail1" aria-describedby="emailHelp" name="auction_name">

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><b>End Date:</b></label>
            <input type="date" class="form-control" name="end_date" id="exampleInputEmail1" aria-describedby="emailHelp" name="auction_name">

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"><b>Auction Reach:</b></label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="exampleRadios1" value="city" name="option" checked>
                <label class="form-check-label" for="exampleRadios1">
                    City - $500
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="exampleRadios2" value="country" name="option">
                <label class="form-check-label" for="exampleRadios2">
                    Country - $2000
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="exampleRadios3" value="world" name="option">
                <label class="form-check-label" for="exampleRadios3">
                    Worldwide - $5000
                </label>
            </div>


        </div>
        <button type="submit" class="btn checkoutmore">Submit</button>
    </form>

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