<?php
// is required to start the function
session_start();

// gets the database 
require_once 'config.php';

//initializes the variables needed 
$error = '';
$username = '';

// was created to always reset the counter to 3 every form submitted
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $_SESSION['login_attempts'] = 3;
}

$attempts_left = $_SESSION['login_attempts'];

// will redirect the user after failing the limit
if ($attempts_left == 0) {
    $error = "You have reached the limit. Try again later";
    header("Location: /Loading/index.php");
    exit;
}

// gets the post from the loginform
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    //checks to see if there are empty inputs
    if (empty($username) || empty($password)) {
        $_SESSION['login_attempts'] -= 1;
        $attempts_left = $_SESSION['login_attempts'];
        $error = "Fill in both fields.";
    } else {
            try {
                $stmt = $pdo->prepare("SELECT id, username, password FROM admin_users WHERE username = :username LIMIT 1");
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();

                // if found then they will check if the information is correct and redirect the user to the mainpage
                if ($stmt->rowCount() === 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $row["password"])) {
                        $_SESSION["admin_logged_in"] = true;
                        $_SESSION["admin_id"] = $row["id"];
                        $_SESSION["admin_username"] = $row["username"];
                        $_SESSION['login_attempts'] = 3;
                        header("Location: /portfolio/portfolio.php");
                        exit;
                } else {
                    // if there is a issue will not redirect and printout error text focuses on the information inside the row
                    $_SESSION['login_attempts']--;
                    $attempts_left = $_SESSION['login_attempts'];
                    $error = "Invalid Credentials not found inside the database";
                }
            } else {
                // if there is a issue will not redirect and printout error text focuses on the information inside the row
                $_SESSION['login_attempts']--;
                $attempts_left = $_SESSION['login_attempts'];
                $error = "Invalid Credentials";
            }
        } catch (PDOException $e) {
                // will catch any errors found 
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
                        <input type="text" name="username" id="username" class="pixel-input" placeholder="Username" autocomplete="off">
                        <input type="password" name="password" id="password" class="pixel-input" placeholder="Password" autocomplete="off">
                    </div>
                    <div id="attempts" class="attempts-text" data-attempts-left="<?php echo htmlspecialchars($attempts_left); ?>"
                        <?php if ($error): ?>style="color: red;"<?php endif; ?>> Attempts remaining: <?php echo htmlspecialchars($attempts_left); ?>
                    </div> 
                    <div class="button-group">
                        <button id="ok-btn" class="pixel-button">OK</button>
                        <button id="cancel-btn" class="pixel-button outlined">CANCEL</button>
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