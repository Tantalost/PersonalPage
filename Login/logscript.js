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

// tips
const tips = [
    "Bisaya si Eric",
    "I'm Inside your walls",
    "Dont use sir jason's password",
    "Hero's Never Fail",
    "RadioHead only",
    "Viva La Vida",
    "What's your name Boy!",
    "Reality is an illusion",
    "I want to break free",
    "Sir Jason pa internship"
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

// update tip every 4 sec
setInterval(updateTip, 4000);
updateTip();

// login info eto lang puede
let attemptsLeft = 3;

const loginContainer = document.querySelector('.login-container');
const damageOverlay = document.querySelector('.damage-overlay');
const errorSound = document.getElementById('error');
const clickSound = document.getElementById('click');

function playSound(audio) {
    audio.currentTime = 0;
    audio.volume = 0.2;
    audio.play();
}

function showDamageEffect() {
    damageOverlay.classList.add('damage');
    loginContainer.classList.add('shake');
    setTimeout(() => {
        damageOverlay.classList.remove('damage');
        loginContainer.classList.remove('shake');
    }, 200);
}

function updateAttempts() {
    document.getElementById('attempts').textContent = `Attempts remaining: ${attemptsLeft}`;
}

function clearInputs() {
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
}

window.addEventListener('DOMContentLoaded', () => {
    const errorBox = document.getElementById('attempts');
    if (errorBox) {
        attemptsLeft = parseInt(errorBox.getAttribute('data-attempts-left'), 10);
        
        if (attemptsLeft < 3) {
            playSound(errorSound);
            showDamageEffect();
        }
    
        if (attemptsLeft <= 0) {
            playSound(errorSound);
            showDamageEffect();
        
            setTimeout(() => {
                alert('Access Denied: Too many failed attempts');
                window.location.href = '/Loading/index.php';
            }); 
        }
    }

    const loginForm = document.querySelector('form');
    if (loginForm) {
        loginForm.addEventListener('submit', () =>{
            playSound(clickSound);
        })
    }
})

document.getElementById('cancel-btn').addEventListener('click', () => {
    playSound(clickSound);
    clearInputs();
});

document.querySelector('.close-btn').addEventListener('click', () => {
    playSound(clickSound);
    window.location.href = '/Loading/index.html';
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        clearInputs();
        playSound(clickSound);
    } else if (e.key === 'Enter') {
        document.getElementById('ok-btn').click();
    }
}); 