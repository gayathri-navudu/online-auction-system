<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "seller"){
    header("Location: login.php");
    exit();
}

$seller_id = $_SESSION['user_id'];

// Add Item
if(isset($_POST['add_item'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $end_date = $_POST['end_date'];

    $sql = "INSERT INTO items (title, description, starting_price, seller_id, auction_end, status)
            VALUES ('$title', '$description', '$price', '$seller_id', '$end_date', 'active')";

    mysqli_query($conn, $sql);
}

// Fetch Seller Items
$result = mysqli_query($conn, "SELECT * FROM items WHERE seller_id='$seller_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Panel</title>
    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f4f6f9;
        }

        .navbar{
            background:#1cc88a;
            color:white;
            padding:15px 30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .navbar a{
            color:white;
            text-decoration:none;
            margin-left:15px;
            font-weight:bold;
        }

        .container{
            padding:40px;
        }

        .form-box{
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
            max-width:500px;
            margin-bottom:40px;
        }

        input, textarea{
            width:100%;
            padding:10px;
            margin:8px 0;
            border-radius:5px;
            border:1px solid #ccc;
        }

        button{
            padding:10px 20px;
            background:#4e73df;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#2e59d9;
        }

        .items{
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap:20px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        .price{
            color:#1cc88a;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>Seller Panel - Online Auction</div>
    <div>
        Welcome, <?php echo $_SESSION['user']; ?> 👋
        <a href="seller_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

    <div class="form-box">
        <h2>Add New Item</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Item Title" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" name="price" placeholder="Starting Price" required>
            <input type="datetime-local" name="end_date" required>
            <button type="submit" name="add_item">Add Item</button>
        </form>
    </div>

    <h2>Your Items</h2>

    <div class="items">

    <?php
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "
            <div class='card'>
                <h3>{$row['title']}</h3>
                <p>{$row['description']}</p>
                <p class='price'>₹{$row['starting_price']}</p>
                <p><strong>Ends:</strong> {$row['auction_end']}</p>
                <p><strong>Status:</strong> {$row['status']}</p>
            </div>
            ";
        }
    } else {
        echo "<p>No items added yet.</p>";
    }
    ?>

    </div>

</div>

</body>
</html>