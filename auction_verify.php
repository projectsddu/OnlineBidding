<?php

session_start();


function check_dates($dt1,$dt2)
    {
        if($dt1 < $dt2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function is_empty($auction_name,$auction_description,$start_date,$end_date)
    {
        if(strlen($auction_description) == 0 || strlen($auction_name) == 0 || strlen($start_date) == 0 || strlen($end_date) == 0)
        {
            return true;
        }
        else
        {
            
            return false;
        }
    }

    function check_money($option)
    {
        include "partial/_dbConnect.php";
        
        if($_SESSION["isset"] == true)
        {
            // fetch current amount of user
            $sql = "SELECT money FROM user where user_id = ".$_SESSION["user_id"];
            // echo $sql;
            $res = mysqli_query($link,$sql);
            if($res)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    // store user current money
                    $money = $row["money"];
                }
            }

            // subtract
            $money = $money;
                        
            if($option == "city")
            {
                $money = $money-500;
                if($money >= 0)
                {
                    // echo $money;
                    $mon = $money;
                    $sql = "UPDATE user SET money = ".$money." WHERE user_id = ".$_SESSION["user_id"];
                    // echo $sql;
                    $res = mysqli_query($link,$sql);
                    if(!$res)
                    {
                        echo "Errror!!!!!!!";
                    }
                    return true;
                }
                else
                {
                    return false;
                }
                            
            }
            if($option == "country")
            {
                $money = $money - 2000;
                if($money >= 0)
                {
                // echo $money;
                    $mon = $money;
                    $sql = "UPDATE user SET money = ".$money." WHERE user_id = ".$_SESSION["user_id"];
                    $res = mysqli_query($link,$sql);
                    if(!$res)
                    {
                        echo "Errror!!!!!!!";
                    }
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                $money = $money - 5000;
                if($money >= 0)
                {
                    // echo $money; 
                    $mon = $money;
                    $sql = "UPDATE user SET money = ".$money." WHERE user_id = ".$_SESSION["user_id"];
                    $res =  mysqli_query($link,$sql);
                    if(!$res)
                    {
                        echo "Errror!!!!!!!";
                    }
                    return true;
                }
                else
                {
                    return false;
                }
            }
                                        
        }
                    
    }
    
    function add_auction($auction_name,$auction_description,$start_date,$end_date,$reach)
    {
        include "partial/_dbConnect.php";
        $sql = "INSERT INTO auction (auction_id, user_id, valid_date, description, auction_cap, auction_city, auction_country, auction_title, start_date,reach) VALUES (NULL, ".$_SESSION['user_id'].", '".$end_date."', '".$auction_description."', 0, '".$_SESSION['city']."', '".$_SESSION['country']."', '$auction_name', '".$start_date."','$reach')";
        // echo $sql;
        $sql1 = "INSERT INTO transaction (t_id,user_id,money,auction_id,credit_debit_status) VALUES (NULL,".$_SESSION['user_id'].",500,-1,1)";
        $res1 = mysqli_query($link,$sql1);

        $res = mysqli_query($link,$sql);
        if(!$res)
        {
            echo "Errorrr1!!!!!!!";
        }
        if(!$res1)
        {
            echo "Errorrr2!!!!!!!";
        }
    }

?>