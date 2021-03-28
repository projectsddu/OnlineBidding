<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
function isEmptyData($username, $city, $country, $password, $c_password)
{
    if (empty($username) || empty($city) || empty($country) || empty($password) || empty($c_password)) {
        echo "Fields can not be empty.";
        return true;
    }
}

function validate_username($username)
{
    include "partial/_dbConnect.php";

    $sql = "SELECT username FROM user WHERE username = '" . $username . "'";
    // echo $sql;

    $res = mysqli_query($link, $sql);

    if (mysqli_num_rows($res) == 0) {
        return true;
    } else {
        return false;
    }
}

//validate password
function validate_password($password, $c_password)
{
    if (!strcmp($password, $c_password) && strlen($password) >= 8) {
        // echo "correct";
        return true;
    } else {
        return false;
    }
}

// validate user
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password = $_POST["c_password"];

    $empty_status = isEmptyData($username, $city, $country, $password, $c_password);
    // call fucntion
    $username_status = validate_username($username);
    $password_status = validate_password($password, $c_password);
    if (!$username_status || !$password_status || $empty_status) {
        // echo "error";
        if($username_status) {
            header("location: index.php?msg="."Username is already taken.");
        }
        else if($password_status) {
            header("location: index.php?msg="."Password does not match.");
        }
        else {
            header("location: index.php?msg="."Fields can not be empty.");
        }
    } else {
        include "partial/_dbConnect.php";

        $link = mysqli_connect('localhost','root','','DM_PROJECT');

        // check connection

        if (!$link) {
            die('ERROR: Could not connect' . mysqli_connect_error());
        }

        $sql = "INSERT INTO user (username, password, email, city, country, money) VALUES ('" . $username . "', '" . $password . "', '" . $email . "', '" . $city . "', '" . $country . "', 0)";
        // echo $sql;
        $res = mysqli_query($link, $sql);
        if (!$res) {
            echo "error";

        } else {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['isset'] = true;
            $_SESSION["city"] = $city;
            $_SESSION["country"] = $country;
            $sql = "SELECT * FROM user WHERE username = '".$username."'";
            $res = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($res))
            {
                $_SESSION['user_id'] = $row["user_id"];
            }
            header("location: index.php?msg="."You are logged in");
        }

        // echo "success";
    }
} else {
    echo "Error 404.";
}
