<?php

session_start();

require_once 'config.php';

//Redirect to the mainpage if already logged in
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: maindash.php");
    exit;
}

// Variables
$error = '';
$username = '';
$password = '';

// POST request
if ($_SERVER["REQUEST METHOD"] === "POST"){
    // removes whitespace   
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    // Validate input
    if(empty($username) || empty($password)){
        $error = "Incorrect credentials";
    } else {
        try {
            $stmt =$pdo->prepare('SELECT id, username, password FROM admin_user WHERE username = :username LIMIT 1');
            $stmt ->bindParam(':username', $username, PDO::PARAM_STR);

            $stmt->execute();

            if($stmt->rowCount() === 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $row["password"])) {
                    $_SESSION["admin_logged_in"] = true;
                    $_SESSION["admin_id"] = $row["id"];
                    $_SESSION["admin_username"] = $row["username"];

                    header("Location: maindash.php");
                    exit;
                } else {
                    $error = "Invalid credentials";
                }
            } else {
                $error = "Invalid credentials";
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            $error = "Internal error";
        }
    }
}

?>