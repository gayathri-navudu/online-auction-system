<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Auction Items</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .card {
            background:white;
            padding:15px;
            margin:15px;
            border-radius:8px;
            box-shadow:0 0 10px #ccc;
        }
        .btn {
            padding:6px 12px;
            background:green;
            color:white;
            border:none;
            cursor:pointer;
        }
        .price { font-weight:bold; color:blue; }
    </style>
</head>
<body>

<h2>Auction Items</h2>

<?php

$result = mysqli_query($conn, "SELECT * FROM items");

while($row = mysqli_fetch_assoc($result)){

    $item_id = $row['item_id'];
    $end_time = strtotime($row['auction_end']);
    $current_time = time();

    // 🔥 Auto close auction
    if($current_time > $end_time && $row['status'] == 'active'){
        mysqli_query($conn, "UPDATE items SET status='closed' WHERE item_id='$item_id'");
        $row['status'] = 'closed';
    }

    // 🔥 Get highest bid with bidder_id
    $bid_query = mysqli_query($conn,
        "SELECT bidder_id, bid_amount 
         FROM bids 
         WHERE item_id='$item_id'
         ORDER BY bid_amount DESC 
         LIMIT 1"
    );

    $highest_bid = $row['starting_price'];
    $winner_name = "";

    if(mysqli_num_rows($bid_query) > 0){
        $bid_row = mysqli_fetch_assoc($bid_query);
        $highest_bid = $bid_row['bid_amount'];
        $winner_id = $bid_row['bidder_id'];

        // Get winner name from users table
        $user_query = mysqli_query($conn,
            "SELECT name FROM users WHERE user_id='$winner_id'"
        );
        $user_row = mysqli_fetch_assoc($user_query);
        $winner_name = $user_row['name'];
    }

    echo "<div class='card'>";
    echo "<h3>{$row['title']}</h3>";
    echo "<p>{$row['description']}</p>";
    echo "<p class='price'>Current Highest Bid: ₹{$highest_bid}</p>";
    echo "<p><strong>Auction Ends:</strong> {$row['auction_end']}</p>";

    if($row['status'] == 'closed'){

        if($winner_name != ""){
            echo "<p style='color:red;'><strong>Auction Closed</strong></p>";
            echo "<p><strong>Winner:</strong> {$winner_name}</p>";
        } else {
            echo "<p style='color:red;'><strong>Auction Closed - No Bids</strong></p>";
        }

    } else {

        echo "
        <form method='POST' action='place_bid.php'>
            <input type='hidden' name='item_id' value='{$item_id}'>
            <input type='number' name='bid_amount' placeholder='Enter your bid' required>
            <button type='submit' class='btn'>Place Bid</button>
        </form>
        ";
    }

    echo "</div>";
}

?>

</body>
</html>