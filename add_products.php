<?php
require_once("partial/_dbConnect.php");
session_start();
if (isset($_GET["aid"])) {
    $sql = 'SELECT * FROM auction where user_id =' . $_SESSION["user_id"] . ' AND auction_id = ' . $_GET["aid"];
    echo $sql;
    $res = mysqli_query($link, $sql);
    if (!$res) {
        header("location:index.php?msg=" . "Error finding you auction");
    } else {
        $row = mysqli_num_rows($res);
        if ($row <= 0) {
            header("location:index.php?msg=" . "You cannot access other people's auction");
        }
        $aid = $_GET["aid"];
    }
} else {
    header("location:index.php?msg=" . "To add product it must contain auction id");
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
        <button type="button" class="btn loginbtn" data-bs-toggle="modal" data-bs-target="#product"> Add product </button>
    </div>

    <!-- Modal for adding products -->
    <div class="modal logmodal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content logform">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="" action="login_verify.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Product name:</label>
                            <input type="text" class="form-control" id="username" name="prod_name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Product Description:</b></label>
                            <textarea class="form-control txtarea" name="prod_desc" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Base Bid</label>
                            <input type="text" class="form-control" id="username" name="prod_name">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Product photo</label>
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