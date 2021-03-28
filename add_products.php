<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once("partial/_dbConnect.php");
session_start();

$msg = $aid = "";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // echo "yes";
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $base_bid = $_POST["base_bid"];

    // echo $product_name." ".$product_description." ".$base_bid."<br>";

    // validate all fields check that empty or not..

    $flag = false;
    if (strlen($product_name) == 0 || strlen($product_description) == 0 || strlen($base_bid) == 0) {

        // echo "Fields can't be empty...";
        header("location:add_products.php?aid=" . $_GET['aid'] . " && msg=" . "Fields can't be empty!");
        $flag = true;
    }

    // validate base_bid
    if (!is_numeric($base_bid)) {
        // echo "bid amount must be numeric.";
        header("location:add_products.php?aid=" . $_GET['aid'] . " && msg=" . "Bid amount must be numeric!!");
        $flag = true;
    }

    // update database
    if (!$flag) {
        $sql="INSERT INTO product (product_id, auction_id, product_name, product_details, base_bid, current_bid, max_bid) VALUES (NULL,$aid,'$product_name', '$product_description', $base_bid, 0, -1)";
        // echo $sql;
        $res = mysqli_query($link, $sql);
        // var_dump($res);
    }
}

if (isset($_GET["aid"])) {
    $sql = 'SELECT * FROM auction where user_id =' . $_SESSION["user_id"] . ' AND auction_id = ' . $_GET["aid"];
    // echo $sql;
    $res = mysqli_query($link, $sql);
    if (!$res) {
        // echo "Here errot";
        header("location:index.php?msg=" . "Error finding you auction.");
    } else {
        $row = mysqli_num_rows($res);
        if ($row <= 0) {
            header("location:index.php?msg=" . "You cannot access other people's auction.");
        }
        $aid = $_GET["aid"];
        // echo "kono";
    }
} else {
    header("location:index.php?msg=" . "To add product it must contain auction id.");
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

    <!-- show products -->

    <div class="col container mt-2">
        <h2 class="m-2">Currently Added Products:</h2>
        <span>
            <div class="container m-4">
            <button type="button" class="btn loginbtn" data-bs-toggle="modal" data-bs-target="#product"> Add product </button>
            </div>
        </span>
        <?php
        $sql = "SELECT * FROM product WHERE auction_id = " . $aid;
        // echo $sql;
        $res = mysqli_query($link, $sql);

        if (mysqli_num_rows($res) == 0) {
            echo '<div class="container mt-3"> 
            <div class="alert loginbtn alert-dismissible fade show" role="alert">
            <strong> No Products has been added yet..</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          </div>';
        } else {
            echo '<div class="alert login_hov_fill container fade show" role="alert">
                    <div class="row">
                        <div class="col-2 add_border">
                            <b>Product Name</b>
                        </div>
                    
                        <div class="col-2 add_border">
                            <b>Base Bid</b>
                        </div>
                        <div class="col-2 add_border">
                            <b>Current Bid</b>
                        </div>
                        <div class="col-2" style="margin-left: 50px;">
                            <b>View Product Page</b>
                        </div>
                    </div>

                </div>';

            while ($row = mysqli_fetch_assoc($res)) {

                echo '<div class="alert login_hov alert-dismissible fade show" role="alert">
                    <div class="row">
                        <div class="col-2 add_border">
                            ' . $row["product_name"] . '
                        </div>
                    
                        <div class="col-2 add_border" style="margin-left: 10px;">
                        ' . $row["base_bid"] . '
                        </div>
                        <div class="col-2 add_border" style="margin-left: 25px;">
                        ' . $row["current_bid"] . '
                        </div>
                        <div class="col-2 add_border " style="margin-left:-18px;">
                            <a href="show_products.php?id=' . $row["product_id"] . '" > <button class="btn product_btn"> <b>View Product Page </b></button></a> 
                        </div>
                    </div>

                </div>';
            }
        }

        ?>
    </div>



    <!-- Modal for adding products -->
    <div class="modal logmodal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content logform">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Add Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="" action="<?php echo 'add_products.php?aid=' . $_GET['aid']; ?>" enctype='multipart/form-data'>
                        <div class="mb-3">
                            <label for="username" class="form-label"><b>Product Name:</b></label>
                            <input type="text" class="form-control" id="username" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Product Description:</b></label>
                            <textarea class="form-control txtarea" name="product_description" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label"><b>Base Bid:</b></label>
                            <input type="text" class="form-control" id="username" name="base_bid">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label"><b>Product Photo:</b></label>
                            <br><input type="file" />
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of modal -->
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