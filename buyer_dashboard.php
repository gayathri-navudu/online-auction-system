<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer"){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard</title>
    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f4f6f9;
        }

        .navbar{
            background:#4e73df;
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

        .card{
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
            text-align:center;
            max-width:400px;
        }

        .btn{
            display:inline-block;
            margin-top:15px;
            padding:10px 20px;
            background:#1cc88a;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        .btn:hover{
            background:#17a673;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div>Online Auction System</div>
    <div>
        Welcome, <?php echo $_SESSION['user']; ?> 👋
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>Buyer Dashboard</h2>
        <p>You can browse and bid on available auction items.</p>
        <a href="view_items.php" class="btn">View Auction Items</a>
    </div>
</div>

</body>
</html>