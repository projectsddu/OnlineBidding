<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link type="text/css" href="Assets/Files/CSS/home.css" rel="stylesheet" >

    <title>Hello, world!</title>
  </head>
  <body>
    <?php
    // include("assets/Components/navbar.php");
    ?>

    <div id="MainElement" class="row mt-3">
        <div class="col-2" id="advertise"></div>
        <div class="col-8" id="Main">
            <!-- Welcome element -->
            <div class="welcome_elem">
              <h1><b>Check out auctions near you!</b></h1>
              <p>Submit your area and check the reach of the auctions.There might be many auctions which do not ship internationally or even within the country so read the availablity before participating in the auction.<b>Happy Shopping!</b></p>  
              <form action="sudo.php">
              <div class="input-group mb-3">
  <input type="text" class="form-control input_a" placeholder="Type cities near you...." aria-label="" aria-describedby="basic-addon2">
  <span class="input-group-text sides" type="submit" id="basic-addon2"><a href="sudo.php" style="text-decoration:none;color:#ffffff">Go</a></span>
</div>
              </form>
            </div>
            <!-- End of welcome element -->
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