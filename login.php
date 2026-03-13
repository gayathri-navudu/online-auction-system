<?php
session_start();
include("db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['user_id'];

        // Role Based Redirect
        if($row['role'] == "buyer"){
            header("Location: buyer_dashboard.php");
        } else {
            header("Location: seller_dashboard.php");
        }
        exit();

    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Auction System - Login</title>
    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            text-align:center;
        }

        .title{
            color:white;
            font-size:32px;
            margin-bottom:30px;
        }

        .login-box{
            background:white;
            padding:40px;
            width:350px;
            border-radius:10px;
            box-shadow:0px 5px 20px rgba(0,0,0,0.2);
        }

        .login-box h2{
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:10px;
            margin:10px 0;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:10px;
            background:#4e73df;
            border:none;
            color:white;
            font-size:16px;
            border-radius:5px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            background:#2e59d9;
        }

        .error{
            color:red;
            margin-bottom:10px;
        }

        .register-link{
            margin-top:15px;
        }

        .register-link a{
            color:#4e73df;
            text-decoration:none;
            font-weight:bold;
        }

        .register-link a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="title">Online Auction System</div>

    <div class="login-box">
        <h2>Login</h2>

        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="login">Login</button>
        </form>

        <!-- ✅ REGISTER LINK ADDED -->
        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>

    </div>
</div>

</body>
</html>