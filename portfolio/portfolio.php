<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="portstyle.css">
</head>
<body>
    <canvas id="matrix-bg"></canvas>
    <div class="damage-overlay"></div>

    <div class="header-container">
    <div class="header-window">
      <div class="login-content">
        <h2>WELCOME</h2>
        <h1>PLAYER</h1>
      </div>
    </div>
  </div>

  <div class="status-container">
    <div class="status-window">
      <div class="status-content">
        <h2>STATUS</h2>
        <p>NAME: SUNG JIN-WOO &nbsp;&nbsp;&nbsp;&nbsp; LEVEL: 39</p>
        <p>JOB: NONE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FATIGUE: 0</p>
        <p>TITLE: WOLF SLAYER</p>
        <p>HP: 7229</p>
        <div class="bar-container"><div class="hp-bar"></div></div>
        <p>MP: 638</p>
        <div class="bar-container"><div class="mp-bar"></div></div>
        <p>STRENGTH: 97 &nbsp;&nbsp;&nbsp;&nbsp; VITALITY: 59</p>
        <p>AGILITY: 97 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INTELLIGENCE: 51</p>
        <p>SENSE: 81</p>
        <p>PHYSICAL DAMAGE REDUCTION: 20% <span class="highlight">ACTIVATING</span></p>
        <p style="text-align: right">REMAINING POINTS: 0</p>
      </div>
    </div>
  </div>
    <audio id="error" src="https://www.myinstants.com/media/sounds/minecraft-hit-sound.mp3" preload="auto"></audio>
    <audio id="click" src="https://www.myinstants.com/media/sounds/minecraft-click.mp3" preload="auto"></audio>
    <audio id="beep" src="https://www.myinstants.com/media/sounds/beep-6-96243.mp3" preload="auto"></audio>
    <script src="portscript.js"></script>
</body>
</html> 