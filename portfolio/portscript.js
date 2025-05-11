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
    if (beepSound) {
        beepSound.currentTime = 0;
        beepSound.volume = 0.1;
        beepSound.play();
    }
}

function updateTip() {
    const tipElement = document.getElementById('tip-text');
    if (tipElement) {
        const randomTip = tips[Math.floor(Math.random() * tips.length)];
        tipElement.textContent = `Tip: ${randomTip}`;
        playBeep();
    }
}

// update tip every 4 sec
setInterval(updateTip, 4000);
updateTip();

// Only play click sound on button click, do not block form submission
const clickSound = document.getElementById('click');
document.addEventListener('click', function(e) {
    if (e.target.tagName === 'BUTTON' && clickSound) {
        clickSound.currentTime = 0;
        clickSound.volume = 0.2;
        clickSound.play();
    }
});

// Remove or comment out login-specific and overlay code that is not used on this page
// (No .login-container, .close-btn, #cancel-btn, #ok-btn, #username, #password, #attempts, etc. on this page)
// This ensures no JS errors and no event listeners block form submission 