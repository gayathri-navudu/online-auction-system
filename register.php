<?php
include("db.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES ('$name', '$email', '$password', '$role')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Registration Successful! Please Login');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Auction System - Register</title>
    <style>
        body{
            font-family: Arial;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }

        .main-title{
            color:white;
            font-size:32px;
            font-weight:bold;
            margin-bottom:20px;
        }

        .box{
            background:white;
            padding:40px;
            width:350px;
            border-radius:10px;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input, select{
            width:100%;
            padding:10px;
            margin:10px 0;
            border-radius:5px;
            border:1px solid #ccc;
        }

        button{
            width:100%;
            padding:10px;
            background:#4e73df;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#2e59d9;
        }

        a{
            text-decoration:none;
            color:#4e73df;
        }

        a:hover{
            text-decoration:underline;
        }

        p{
            text-align:center;
            margin-top:15px;
        }
    </style>
</head>
<body>

<div class="main-title">
    🏷️ Online Auction System
</div>

<div class="box">
    <h2>Create Account</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select>

        <button type="submit" name="register">Register</button>
    </form>

    <p>
        Already have account? <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>