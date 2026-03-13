<?php
include "db.php";
$result = $conn->query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Auction System</title>
</head>
<body>

<h2>Available Auctions</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div style="border:1px solid black; padding:10px; margin:10px;">
        <h3><?php echo $row['title']; ?></h3>
        <p>Description: <?php echo $row['description']; ?></p>
        <p>Starting Price: ₹<?php echo $row['starting_price']; ?></p>
        <p>Status: <?php echo $row['status']; ?></p>
    </div>
<?php } ?>

</body>
</html>