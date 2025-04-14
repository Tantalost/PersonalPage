if (!sessionStorage.getItem('loggedIn')) {
    window.location.href = '/Dashboard/dashboard.html';
} else {
    const username = sessionStorage.getItem('username');
    document.querySelector('.minecraft-logo h1').textContent = `Welcome, ${username}`;
}

const clickSound = document.getElementById('click');

function playClick() {
    clickSound.currentTime = 0;
    clickSound.volume = 0.2;
    clickSound.play();
}

document.getElementById('start-btn').addEventListener('click', () => {
    playClick();
    setTimeout(() => {
        window.location.href = '../Mainpage/maindash.html';
    }, 200);
});

document.getElementById('credits-btn').addEventListener('click', () => {
    playClick();
    setTimeout(() => {
        window.location.href = '../Credits/credits.html';
    }, 200);
});

document.getElementById('exit-btn').addEventListener('click', () => {
    playClick();
    setTimeout(() => {
        const confirmExit = confirm('Are you sure you want to exit?');
        if (confirmExit) {
            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('username');
            window.location.href = '../Loading/index.html';
        }
    }, 200);
});

document.querySelectorAll('.minecraft-button').forEach(button => {
    button.addEventListener('mouseenter', () => {
        button.style.transform = 'scale(1.02)';
    });

    button.addEventListener('mouseleave', () => {
        button.style.transform = 'scale(1)';
    });

    button.addEventListener('mousedown', () => {
        button.style.transform = 'scale(0.98)';
    });

    button.addEventListener('mouseup', () => {
        button.style.transform = 'scale(1.02)';
    });
});

const splashTexts = [
    "Bisaya si Eric",
    "As seen on TV!",
    "Jason Catadman",
    "I know where you live",
    "More Cofee Please!",
    "Chicken Jockey",
    "Made with love!",
    "I am inevitable",
    "Don't look behind you!",
    "Mibomboclat!"
];

function updateSplashText() {
    const splashElement = document.querySelector('.splash-text');
    const randomSplash = splashTexts[Math.floor(Math.random() * splashTexts.length)];
    splashElement.style.opacity = '0';
    
    setTimeout(() => {
        splashElement.textContent = randomSplash;
        splashElement.style.opacity = '1';
    }, 200);
}

setInterval(updateSplashText, 2000); 