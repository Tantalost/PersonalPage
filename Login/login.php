<?php
session_start();
require_once 'config.php';

$error = '';
$username = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (empty($username) || empty($password)) {
        $error = "Fill in both fields.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, username, password FROM admin_users WHERE username = :username LIMIT 1");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row["password"])) {
                    $_SESSION["admin_logged_in"] = true;
                    $_SESSION["admin_id"] = $row["id"];
                    $_SESSION["admin_username"] = $row["username"];
                    header("Location: maindash.php");
                    exit;
                } else {
                    $error = "Invalid Credentials";
                }
            } else {
                $error = "Invalid Credentials";
            }
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            $error = "An error occurred. Please try again later.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="logstyle.css">
</head>
<body>
    <canvas id="matrix-bg"></canvas>
    <div class="damage-overlay"></div>
    <div class="login-container">
        <div class="tip-container">
            <div id="tip-text">Tip: Loading...</div>
        </div>
        <div class="login-window">
            <div class="window-header">
                <span class="close-btn">×</span>
            </div>
            <div class="login-content">
                <h1>I don't trust you yet...</h1>
                <form method="POST" action="login.php">
                    <div class="input-group">
                        <input type="text" name="username" id="username" class="pixel-input" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" autocomplete="off">
                        <input type="password" name="password" id="password" class="pixel-input" placeholder="Password" autocomplete="off">
                    </div>
                    <?php if (!empty($error)): ?>
                        <p class="attempts-text" style="color: red;" data-attempts-left="<?= $attempts_left ?? 3 ?>">
                            <?= htmlspecialchars($error) ?>
                        </p>
                    <?php endif; ?>

                    <div class="button-group">
                        <button type="submit" id="ok-btn" class="pixel-button">OK</button>
                        <button type="submit" id="cancel-btn" class="pixel-button outlined">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <audio id="error" src="https://www.myinstants.com/media/sounds/minecraft-hit-sound.mp3" preload="auto"></audio>
    <audio id="click" src="https://www.myinstants.com/media/sounds/minecraft-click.mp3" preload="auto"></audio>
    <audio id="beep" src="https://www.myinstants.com/media/sounds/beep-6-96243.mp3" preload="auto"></audio>
    <script src="/Login/logscript.js"></script>
</body>
</html> 