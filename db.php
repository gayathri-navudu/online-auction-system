<?php
$conn = new mysqli("localhost", "root", "", "auctiondb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>