// Matrix background effect galing youtube
const canvas = document.getElementById('matrix-bg');
const ctx = canvas.getContext('2d');

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resizeCanvas();
window.addEventListener('resize', resizeCanvas);

const chars = '0123456789';
const fontSize = 14;
const columns = Math.floor(canvas.width / fontSize);
const drops = new Array(columns).fill(1);
const maxSpeed = 2;

ctx.fillStyle = 'rgba(0, 255, 0, 0.1)';
ctx.font = `${fontSize}px 'Press Start 2P'`;

function drawMatrix() {
    ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#0f0';
    
    drops.forEach((y, i) => {
        const char = chars[Math.floor(Math.random() * chars.length)];
        const x = i * fontSize;
        ctx.fillText(char, x, y * fontSize);
        
        if (y * fontSize > canvas.height && Math.random() > 0.975) {
            drops[i] = 0;
        }
        drops[i] += Math.random() * maxSpeed;
    });
}

setInterval(drawMatrix, 50);

// tips ko
const tips = [
    "Trust no one",
    "Look behind you",
    "Don't feed the AI after midnight",
    "The cake is a lie",
    "Save early, save often",
    "Check your surroundings",
    "Passwords are like underwear",
    "Reality is an illusion",
    "Follow the white rabbit",
    "There is no spoon"
];

const beepSound = document.getElementById('beep');

function playBeep() {
    beepSound.currentTime = 0;
    beepSound.volume = 0.1;
    beepSound.play();
}

function updateTip() {
    const tipElement = document.getElementById('tip-text');
    const randomTip = tips[Math.floor(Math.random() * tips.length)];
    tipElement.textContent = `Tip: ${randomTip}`;
    playBeep();
}

function updateProgress(progress) {
    const progressBar = document.querySelector('.progress');
    progressBar.style.width = `${progress}%`;
}

// loading nya
let progress = 0;
const loadingInterval = setInterval(() => {
    progress += Math.floor(Math.random() * 3) + 1;
    if (progress >= 100) {
        progress = 100;
        clearInterval(loadingInterval);
        setTimeout(() => {
            window.location.href = '/Login/login.html';
        }, 300);
    }
    updateProgress(progress);
}, 200);

// changes the tips every 4 secs
setInterval(updateTip, 4000);
updateTip(); 