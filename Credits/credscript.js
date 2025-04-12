document.addEventListener("DOMContentLoaded", () => {
    const creditsElement = document.getElementById("credits");
    if (!creditsElement) return;
  
    const credits = `
        Minecraft Clone UI Project
        Inspired by Mojang's Minecraft
  
        -------------------------------------
  
        Design & Development
        Matrix raining background Effect by JavaScript Academy
        
  
        UI Inspiration
        Mojang Studios
  
        Font
        Press Start 2P by Codeman38
  
        Special Thanks
        Minecraft Community
        JavaScript Developers Worldwide
  
        -------------------------------------
  
        “And the player woke up...”
        
        The End
    `;
  
    creditsElement.textContent = credits;
    setTimeout(() => {
        const backButtonContainer = document.getElementById("backButtonContainer");
        backButtonContainer.classList.remove("hidden");
    }, 10000);
  });
  