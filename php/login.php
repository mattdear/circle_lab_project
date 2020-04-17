<?php
session_start();
include("functions.php");
$un = $_POST["username"];
$pw = $_POST["password"];

try {

    if ($un != "admin" && $pw != "admin") {
        // The no matching records supplied!
        popUpError("Invalid Username or Password");

    } else {
        // Correct password : set up the authentication session variable
        // and store the username in it along with session token
        $token = bin2hex(random_bytes(32));
        $_SESSION["token"] = $token;
        $_SESSION["gatekeeper"] = $un;

        // Redirect to the main menu
        header("Location: homepage.php");
    }
} catch (PDOException $e) {
    echo "Error: $e";
}