<?php
session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">OnlineBidding</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     ';

                    if($_SESSION["isset"]==true)
                    {
                        echo '
                        <li class="nav-item" style="width:120px">
                        <a class="nav-link active text-white" aria-current="page" href="host_auction.php">Host Auction</a>
                    </li> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-success" href="profile.php"><b>Profile</a></b></li>
                            <li><a class="dropdown-item text-success" href="add_money.php"><b>Add Money</a></b></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-success" href="http://localhost/OnlineBidding/logout.php"><b>Logout</a></b></li>
                        </ul>
                    </li>
                        ';
                        // fetch current amount of user
                        $sql="SELECT money FROM user where user_id=".$_SESSION["user_id"];
                        // echo $sql;
                        $res=mysqli_query($link,$sql);

                        // fetch total amount currently in max_bid
                        $sql1="SELECT SUM(current_bid) AS sum FROM product WHERE max_bid = ".$_SESSION["user_id"];
                        // echo $sql1;
                        $res1 = mysqli_query($link, $sql1);
                        if($res1)
                        {
                            while($row=mysqli_fetch_assoc($res1))
                            {
                                // store sunm
                                $sum=$row["sum"];
                            }
                        }
                        else {
                            echo "else innnnnnnnn";
                        }
                        // echo $sum;
                        if($res)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // store user current money
                                $money=$row["money"];
                            }
                        }

                        // subtract
                        $money = $money - $sum;
                        echo '<li style="width:120px">
                        <p class="gradient-text-1" id="cur_money" style="font-size:22px;">$
                        <b>'.$money.'</b>
                        </p>
                    </li>';
                    
                        echo '<li style="padding-left: 450px; margin-right:5px">
                        <a href="http://localhost/OnlineBidding/logout.php"><button type="button" class="btn checkoutmore">'.$_SESSION['username'].'</button></a>
                    </li>';
                    }
                    else
                    {
                    echo'<li style="margin-left: 600px;">
                        <button type="button" class="btn loginbtn" data-bs-toggle="modal" data-bs-target="#login"> Login </button>
                    </li>
                    <li style="margin-left: 15px;;">
                        <button type="button" class="btn loginbtn" data-bs-toggle="modal" data-bs-target="#signup"> Sign Up </button>
                    </li>';
                    }

                echo '</ul>
                <form class="d-flex">
                    <input class="form-control me-2"  style="background-color:#181d24;border:1px solid #1b9e88;border-radius:20px;color:#d8134e" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn search" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- modal for login-->
    <div class="modal logmodal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content logform">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="" action="login_verify.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                         
                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Login</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for signup -->
    <div class="modal fade logmodal" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content logform">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SignUp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="signup_verify.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City:</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                        <div class="mb-3">
                            <label for="Email1" class="form-label">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="c_password" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="c_password" name="c_password">
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">SignUp</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    ';
?>