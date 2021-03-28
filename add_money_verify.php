<?php
session_start();
require_once("partial/_dbConnect.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        $sql = "SELECT money FROM user WHERE user_id = ".$_SESSION["user_id"];
        $res = mysqli_query($link,$sql);
        while($row = mysqli_fetch_assoc($res))
        {
            $money = $row["money"];
        }
        $total_money = $money + abs($_POST['money']);
        $sql = "UPDATE user SET money = ".$total_money." WHERE user_id = ".$_SESSION['user_id'];
        // echo $sql;
        $res = mysqli_query($link,$sql);
        $sql1 = "INSERT INTO transaction (t_id,user_id,money,auction_id,credit_debit_status) VALUES (NULL,".$_SESSION['user_id'].",".abs($_POST['money']).",1,1)";
        
        $res1 = mysqli_query($link,$sql1);
        if(!$res and !$res1)
        {
            echo "Error adding money";
            header("location:add_money.php?msg="."Error while adding your money please try again!");
        }
        else
        {
            header("location:add_money.php?msg="."Money Added Successfully!");
        }
    }
    else
    {
        echo "<h1>404 Page Not Found</h1>";
    }

?>