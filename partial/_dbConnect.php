<?php

// define('DB_SERVER','localhost');
// define('DB_USERNAME','root');
// define('DB_PASSWORD','');
// define('DB_NAME','DM_PROJECT');

// try to connect databse
$link = mysqli_connect('localhost','root','','DM_PROJECT');

// check connection

if(!$link) {
    die('ERROR: Could not connect'.mysqli_connect_error());
}


// create user table

// $sql = "CREATE TABLE user ( 
//         user_id INT NOT NULL AUTO_INCREMENT , 
//         username VARCHAR(30) NOT NULL , 
//         password VARCHAR(20) NOT NULL , 
//         email VARCHAR(50) NOT NULL , 
//         city VARCHAR(50) NOT NULL , 
//         country VARCHAR(50) NOT NULL , 
//         money INT NULL , 
//         PRIMARY KEY (user_id)
//     )";

// if(mysqli_query($link, $sql)) {
//     echo "success";
// }
// else {
//     echo "unsucess";
// }


// create auction table
// $sql = "CREATE TABLE auction ( 
//         auction_id INT NOT NULL AUTO_INCREMENT , 
//         user_id INT NOT NULL , 
//         valid_date DATE NOT NULL , 
//         description VARCHAR(200) NOT NULL , 
//         auction_url VARCHAR(200) NOT NULL , 
//         auction_city VARCHAR(50) NOT NULL , 
//         auction_country VARCHAR(50) NOT NULL , 
//         PRIMARY KEY (auction_id)
//     )" ;

// if(mysqli_query($link, $sql)) {
//     echo "success";
// }
// else {
//     echo "unsucess";
// }

// create product table
// $sql = "CREATE TABLE product ( 
//         product_id INT NOT NULL AUTO_INCREMENT , 
//         auction_id INT NOT NULL , 
//         product_name VARCHAR(50) NOT NULL , 
//         product_details VARCHAR(200) NOT NULL , 
//         base_bid INT NOT NULL , 
//         current_bid INT NOT NULL , 
//         PRIMARY KEY (product_id)
//     )";
    
// if(mysqli_query($link, $sql)) {
//     echo "success";
// }
// else {
//     echo "unsucess";
// }

// create transaction table

// $sql = "CREATE TABLE transaction ( 
//         t_id INT NOT NULL AUTO_INCREMENT , 
//         user_id INT NOT NULL , 
//         money INT NOT NULL , 
//         auction_id INT NULL , 
//         credit_debit_status BOOLEAN NOT NULL , 
//         PRIMARY KEY (t_id)
//     )";

// if(mysqli_query($link, $sql)) {
//     echo "success";
// }
// else {
//     echo "unsucess";
// }


?>