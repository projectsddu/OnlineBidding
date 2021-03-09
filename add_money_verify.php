<?php
session_start();
require_once("partial/_dbConnect.php");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $sql="SELECT money FROM user WHERE user_id=".$_SESSION["user_id"];
        $res=mysqli_query($link,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            $money=$row["money"];
        }
        $sql="UPDATE user SET money=".$money+abs($_POST["money"])." WHERE user_id=".$_SESSION["user_id"];
        echo $sql;
        $res=mysqli_query($link,$sql);
        if(!$res)
        {
            echo "Error adding money";
            header("location:add_money.php?msg="."Error while adding your money please try again!");
        }
        else
        {
            header("location:add_money.php?msg="."Money added successfully!");
        }
    }
    else
    {
        echo "<h1>404 Page Not Found</h1>";
    }

?>