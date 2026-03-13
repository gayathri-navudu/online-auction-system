<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$item_id = $_POST['item_id'];
$bid_amount = $_POST['bid_amount'];
$bidder_id = $_SESSION['user_id'];

// 🔥 Check if auction closed
$check_status = mysqli_query($conn,
    "SELECT status FROM items WHERE item_id='$item_id'"
);
$status_row = mysqli_fetch_assoc($check_status);

if($status_row['status'] == 'closed'){
    echo "<script>
            alert('Auction is closed!');
            window.location='view_items.php';
          </script>";
    exit();
}

// 🔥 Get current highest bid
$result = mysqli_query($conn,
    "SELECT MAX(bid_amount) AS highest 
     FROM bids WHERE item_id='$item_id'"
);
$row = mysqli_fetch_assoc($result);
$highest = $row['highest'];

if(!$highest){
    $item = mysqli_query($conn,
        "SELECT starting_price FROM items WHERE item_id='$item_id'"
    );
    $item_row = mysqli_fetch_assoc($item);
    $highest = $item_row['starting_price'];
}

if($bid_amount > $highest){

    mysqli_query($conn,
        "INSERT INTO bids (item_id, bidder_id, bid_amount, bid_time)
         VALUES ('$item_id','$bidder_id','$bid_amount', NOW())"
    );

    echo "<script>
            alert('Bid placed successfully!');
            window.location='view_items.php';
          </script>";

} else {

    echo "<script>
            alert('Your bid must be higher than current highest bid!');
            window.location='view_items.php';
          </script>";
}
?>