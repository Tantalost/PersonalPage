<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Loading</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <canvas id="matrix-bg"></canvas>
    <div class="loading-container">
        <div class="tip-container">
            <div id="tip-text">Tip: Loading...</div>
        </div>
        <div class="loading-window">
            <div class="window-header">
                <span class="close-btn">×</span>
            </div>
            <div class="loading-content">
                <div class="loading-bar-container">
                    <div class="loading-bar">
                        <div class="progress"></div>
                    </div>
                </div>
                <div class="loading-text">LOADING SYSTEM...</div>
            </div>
        </div>
    </div>
    <audio id="beep" src="https://www.myinstants.com/media/sounds/beep-6-96243.mp3" preload="auto"></audio>
    <script src="script.js"></script>
</body>
</html> 