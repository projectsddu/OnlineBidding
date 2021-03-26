<?php

namespace MyApp;

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'DM_PROJECT');

// try to connect databse

// use mysqli;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Auction implements MessageComponentInterface
{
    protected $clients;
    protected $auction_mapping;
    protected $user_product_mapping;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->auction_mapping = [];
        // $this->user_mapping=[];
        echo "Server has started........";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // $conn will bring the user to auction mapping
        $this->clients->attach($conn);
        echo "Connection opened with:";
    }
    public function print_ar($arr)
    {
        foreach ($arr as $key => $val) {
            echo "\n PID:" . $key . "\n Connection:";
            foreach ($val as $v) {
                echo $v . " ";
            }
        }
    }
    public function onMessage(ConnectionInterface $conn, $msg)
    {
        echo "On message function!";
        $data = json_decode($msg, true);
        if ($data["type"] == "connection") {
            if (count($this->auction_mapping[$data["pid"]]) == 0) {
                echo "\nIndside here";
                $this->auction_mapping[$data["pid"]] = [];
                array_push($this->auction_mapping[$data["pid"]], $conn);
                // $this->print_ar($this->auction_mapping);
            } else {
                array_push($this->auction_mapping[$data["pid"]], $conn);
                // $this->print_ar($this->auction_mapping);
            }
            // echo $this->auction_mapping[$data["pid"]];
        } else {
            //bid raised 
            $pid = $data["pid"];
            $uid = $data["uid"];
            $bid_amount = $data["bid_amount"];
            echo $pid . "\n" . $uid . "\n" . $bid_amount;
            $subscribers = $this->auction_mapping[$pid];

            $sql = "UPDATE product SET current_bid = " . $bid_amount . " , max_bid = " . $uid . " WHERE product_id = " . $pid;
            // echo $sql;
            $link = mysqli_connect('127.0.0.1', DB_USERNAME, DB_PASSWORD, DB_NAME);

            // check connection

            if (!$link) {
                die('ERROR: Could not connect' . mysqli_connect_error());
            }
            $res = mysqli_query($link, $sql);
            if(!$res) {
                echo "error.";
            }

            foreach ($subscribers as $subscriber) {
                $subscriber->send($bid_amount);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {

        $this->clients->detach($conn);
        unset($this->users[$conn->resourceId]);
        unset($this->subscriptions[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
