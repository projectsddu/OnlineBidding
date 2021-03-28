<?php
error_reporting(0);
require_once("partial/_dbConnect.php");
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
$msg = "";

if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
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

<body>
  <?php
  include("Assets/Components/navbar.php");
  ?>

  <div id="MainElement" class="row mt-3">
    <div class="col-2" id="advertise"></div>
    <div class="col-8" id="Main">
      <!-- if messages -->
      <?php
      if ($msg != "") {
        echo '<div class="alert loginbtn alert-dismissible fade show" role="alert">
            <strong>' . $msg . '</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
      ?>
      <!-- end message -->
      <!-- Welcome element -->
      <div class="welcome_elem">
        <h1><b>Find out auctions near you!</b></h1>
        <p>Submit your area and check the reach of the auctions.There might be many auctions which do not ship internationally or even within the country so read the availablity before participating in the auction.<b>Happy Shopping!</b></p>
        <form action="sudo.php">
          <div class="input-group mb-3">
            <input type="text" class="form-control input_a" placeholder="Type cities near you...." aria-label="" aria-describedby="basic-addon2">
            <span class="input-group-text sides" type="submit" id="basic-addon2"><a href="sudo.php" style="text-decoration:none;color:#ffffff">Go</a></span>
          </div>
        </form>
      </div>
      <!-- End of welcome element -->
      <!-- Auction near you -->
      <div class="auctions_elem mt-2">
        <h1 class="mb-3"><b>Auctions we found in your area!</b></h1>
        <p>Carefully read the auction terms , some auction houses have <b>secret terms</b> and some might include a participation fee. Some might have transfer fees or some might charge shipping charges.</p>
        <?php

        if (isset($_SESSION['city'])) {

          $sql = "SELECT * FROM auction WHERE auction_city='" . $_SESSION['city'] . "' AND reach='city' AND valid_date>=".date("Y-m-d")."  ORDER BY auction_cap DESC";
          // echo $sql;
          $res = mysqli_query($link, $sql);
          $i = 3;

          while ($row = mysqli_fetch_assoc($res)) {
            // $i--;
            if ($i == 0) {
              break;
            }
            echo '
        <div class="auction_card">
          <div class="card mb-3 custom_card">
            <div class="row g-0">
              <div class="col-md-5">
                <img src="https://source.unsplash.com/1600x900/?city,USA" class="card_img" alt="...">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="card-title"><b>' . $row["auction_title"] . '</b></h4>
                  <p class="card-text">' . $row["description"] . '</p>
                  <a href="http://localhost/OnlineBidding/auction_view.php?id=' . $row["auction_id"] . '"><button class="btn checkoutmore">View Auction</button></a>
                  <p class="card-text"><small class="text-muted">Valid till ' . $row["valid_date"] . '</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      ';
          }
        }
        else
        {
          echo "<h3>Login to view auctions</h3>";
        }

        ?>
      </div>
      <!-- End of auction near you element -->

      <!-- Auctions in your country -->
      <div class="auctions_elem_1 mt-3">
        <h1 class="mb-3"><b>Auctions we found in your country!</b></h1>
        <p>Carefully read the auction terms , some auction houses have <b>secret terms</b> and some might include a participation fee. Some might have transfer fees or some might charge shipping charges. Although nationwide auctions are quite expensive to bid on but you could push your limits!.</p>
        <?php
        if($_SESSION["isset"]==true)
        {
        $sql = "SELECT * FROM auction WHERE auction_country='" . $_SESSION['country'] . "' AND reach='country' AND valid_date>=".date("Y-m-d")."  ORDER BY auction_cap DESC";
        // echo $sql;
        $res = mysqli_query($link, $sql);
        $i = 3;
        while ($row = mysqli_fetch_assoc($res)) {
          // $i--;
          if ($i == 0) {
            break;
          }
          echo '
        <div class="auction_card">
          <div class="card mb-3 custom_card">
            <div class="row g-0">
              <div class="col-md-5">
                <img src="https://source.unsplash.com/1600x900/?city,USA" class="card_img" alt="...">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h4 class="card-title"><b>' . $row["auction_title"] . '</b></h4>
                  <p class="card-text">' . $row["description"] . '</p>
                  <a href="http://localhost/OnlineBidding/auction_view.php?id=' . $row["auction_id"] . '"><button class="btn checkoutmore">View Auction</button></a>
                  <p class="card-text"><small class="text-muted">Valid till ' . $row["valid_date"] . '</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      ';
        }
      }
        else
        {
          echo "<h3>Login to view auctions</h3>";
        }
        ?>
      </div>
      <!-- End of auctions in your country -->
      <!-- Worldwide auctions -->
      <div class="auctions_elem_3 mt-3">
        <h1 class="mb-3"><b>Auctions Hosted Internationally</b></h1>
        <p>International auctions are far more expensive to bid upon, People around the globe bid for it. Carefully read the instructions of the auction before bidding</p>
        <?php
         $sql = "SELECT * FROM auction WHERE reach='world' AND valid_date>=".date("Y-m-d")." ORDER BY auction_cap DESC ";
         // echo $sql;
         $res = mysqli_query($link, $sql);
         $i = 3;
         while ($row = mysqli_fetch_assoc($res)) {
          //  $i--;
           if ($i == 0) {
             break;
           }
           echo '
           <div class="auction_card">
             <div class="card mb-3 custom_card">
               <div class="row g-0">
                 <div class="col-md-5">
                   <img src="https://source.unsplash.com/1600x900/?city,USA" class="card_img" alt="...">
                 </div>
                 <div class="col-md-7">
                   <div class="card-body">
                     <h4 class="card-title"><b>' . $row["auction_title"] . '</b></h4>
                     <p class="card-text">' . $row["description"] . '</p>
                     <a href="http://localhost/OnlineBidding/auction_view.php?id=' . $row["auction_id"] . '"><button class="btn checkoutmore">View Auction</button></a>
                     <p class="card-text"><small class="text-muted">Valid till ' . $row["valid_date"] . '</small></p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         ';
        }
        ?>
      </div>
      <!-- End of world-wide auctions -->
      <!-- Host your auction -->
      <div class="card text-center mt-4 mb-4 offer_card">
        <div class="card-header">
          <h3>Host your auction now</h3>
        </div>
        <div class="card-body">
          <h5 class="card-title">Special Offers for auction out there</h5>
          <p class="card-text">Host your auctions at the cheapest price ever. Wanna Kick out your old and antique stuff at good price host a auction now </p>
          <a href="host_auction.php" class="btn loginbtn">Host Here</a>
        </div>
        
        <div class="card-footer text-muted">
          Special offer valid till today
        </div>
      </div>
      <!-- End of host your auction -->
    </div>
    <div class="col-2" id="your_auction"></div>
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