// Used once 
<?php
require_once 'config.php';

$username = 'admin';
$password = 'trustno1';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (:username, :password)");
$stmt->execute([
    ':username' => $username,
    ':password' => $hashedPassword
]);

echo "Admin user created";