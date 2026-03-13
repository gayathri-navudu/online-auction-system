<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="form-container">
    <h2>Welcome, <?php echo $_SESSION['user']; ?> 🎉</h2>
<p>You are logged in as <strong><?php echo $_SESSION['role']; ?></strong></p>

<?php
if($_SESSION['role'] == "seller"){
    echo "<a href='add_item.php'><button>Add Item</button></a>";
}
if($_SESSION['role'] == "buyer"){
    echo "<a href='view_items.php'><button>View Items</button></a>";
}
?>
</div>

</body>
</html>