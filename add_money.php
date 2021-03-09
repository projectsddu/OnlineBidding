<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
$msg = "";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

require "partial/_dbConnect.php";
$sql="SELECT money FROM user WHERE user_id=".$_SESSION["user_id"];
$res=mysqli_query($link,$sql);
while($row=mysqli_fetch_assoc($res))
{
    $money=$row["money"];
}
// echo $money;
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

    <title>Add money</title>
</head>

<body>
    <?php include "Assets/Components/navbar.php"; ?>
    <div class="container mt-3">
    <?php
    if ($msg != "") {
        echo '<div class="alert loginbtn alert-dismissible fade show" role="alert">
            <strong>' . $msg . '</strong>
          <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>
    </div>
    <!-- Add money page starts here -->
    <div class="auctions_elem container">
    
        <div class="row m-1">
            <!-- Current balance info -->
            <div class="col-7 auctions_elem_1 ">

                <div class="col">
                    <div class="row-2">
                        <h3 id="bid_lead">OnlineBidding Balance</h3>
                    </div>
                    <div class="row-6">
                        <p class="gradient-text money_text">$<?php echo $money ?></p>
                    </div>
                    <div class="row-2 add_terminate">
                        <p>Add money to spend instantly on the auctions otherwise you will have to add money on each transaction.</p>
                    </div>
                </div>

            </div>
            <!-- End of current balance info -->
            <!-- Start of add money -->
            <div class="col-4 auctions_elem_1" style="margin-left:55px">

                <form action="add_money_verify.php" method="POST" class="mt-4">

                    <div class="input-group mb-3">
                        <span class="input-group-text" style="background-color:#2f2f30;color:white;border:2px solid #be054f">$</span>
                        <input type="text" name="money" class="form-control" aria-label="Amount (to the nearest dollar)">

                    </div>
                    <button class="btn checkoutmore" style="width:340px">Add Money</button>
                </form>


            </div>
            <!-- End of add money -->
        </div>

    </div>
    <!-- Add money page ends here -->









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