<?php
    require("partial/_dbConnect.php");
    if($_SERVER["SERVER_METHOD"] == "GET")
    {
        echo "404 Page not found";
    }
    else
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
        $res = mysqli_query($link,$sql);
        if(mysqli_num_rows($res) == 1)
        {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['isset'] = true;
            while($row = mysqli_fetch_assoc($res))
            {
                $_SESSION["city"] = $row["city"];
                $_SESSION["country"] = $row["country"];
                $_SESSION['user_id'] = $row["user_id"];
            }
            echo "verified";
            header("location:http://localhost/OnlineBidding/index.php?msg="."Successfully loggedin!!");
        }
        else
        {
            header("location:http://localhost/OnlineBidding/index.php?msg="."Wrong Username or Password!!");
        }
    }
?>