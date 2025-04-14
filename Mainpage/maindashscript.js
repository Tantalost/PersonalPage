let worlds = [
    {
      name: "Portfolio",
      date: "13/07/2022, 1:31 pm",
      mode: "Creative",
      version: "1.19",
      img: "https://i.redd.it/xf9lfoq75lf31.png"
    },
    {
      name: "CV/Resume/Biodata",
      date: "13/07/2022, 1:30 pm",
      mode: "Survival",
      version: "1.19",
      img: "https://assetsio.gnwcdn.com/pack__1_.png?width=1200&height=1200&fit=bounds&quality=70&format=jpg&auto=webp"
    },
    {
      name: "Web Scraper",
      date: "01/01/2023, 12:00 pm",
      mode: "Survival",
      version: "1.20",
      img: "https://cdn1.iconfinder.com/data/icons/social-black-buttons/512/anonymous-512.png"
    },
    {
      name: "Creative Fun",
      date: "10/05/2023, 3:45 pm",
      mode: "Creative",
      version: "1.18",
      img: "https://cdn1.iconfinder.com/data/icons/social-black-buttons/512/anonymous-512.png"
    },
    {
      name: "Survival Island",
      date: "20/09/2023, 10:15 am",
      mode: "Survival",
      version: "1.17",
      img: "https://cdn1.iconfinder.com/data/icons/social-black-buttons/512/anonymous-512.png"
    }
  ];
  
  let selectedWorldIndex = null;
  
  function renderWorlds() {
    const list = document.getElementById("worldList");
    list.innerHTML = "";
    worlds.forEach((world, index) => {
      const entry = document.createElement("div");
      entry.className = "world-entry";
      if (selectedWorldIndex === index) entry.classList.add("selected");
      entry.onclick = () => {
        selectedWorldIndex = index;
        renderWorlds();
      };
      entry.innerHTML = `
        <img src="${world.img}" alt="preview" />
        <div class="world-info">
          <strong>${world.name}</strong><br>
          <small>${world.date}</small><br>
          <small>${world.mode} Mode, Version: ${world.version}</small>
        </div>
      `;
      list.appendChild(entry);
    });
  }
  
function playWorld() {
    if (selectedWorldIndex !== null) {
      alert(`Playing world: ${worlds[selectedWorldIndex].name}`);
    } else {
      alert("No world selected.");
    }
}
  
function createWorld() {
    selectedWorldIndex = null;
        document.getElementById("modalTitle").textContent = "Create World";
        document.getElementById("worldName").value = "";
        document.getElementById("worldMode").value = "Creative";
        document.getElementById("worldVersion").value = "1.19";
        document.getElementById("worldModal").style.display = "flex";
}
  
function editWorld() {
    if (selectedWorldIndex === null) {
      alert("Select a world to edit.");
      return;
    }
    const world = worlds[selectedWorldIndex];
    document.getElementById("modalTitle").textContent = "Edit World";
    document.getElementById("worldName").value = world.name;
    document.getElementById("worldMode").value = world.mode;
    document.getElementById("worldVersion").value = world.version;
    document.getElementById("worldModal").style.display = "flex";
  }
  
  function deleteWorld() {
    if (selectedWorldIndex === null) {
      alert("Select a world to delete.");
      return;
    }
    const confirmed = confirm(`Are you sure you want to delete ${worlds[selectedWorldIndex].name}?`);
    if (confirmed) {
      worlds.splice(selectedWorldIndex, 1);
      selectedWorldIndex = null;
      renderWorlds();
    }
  }
  
  function recreateWorld() {
    if (selectedWorldIndex === null) {
      alert("Select a world to re-create.");
      return;
    }
    const world = worlds[selectedWorldIndex];
    const newWorld = { ...world, name: `${world.name} (copy)`, date: new Date().toLocaleString() };
    worlds.push(newWorld);
    renderWorlds();
  }
  
  function saveWorld() {
    const name = document.getElementById("worldName").value;
    const mode = document.getElementById("worldMode").value;
    const version = document.getElementById("worldVersion").value;
    const date = new Date().toLocaleString();
    const img = "https://via.placeholder.com/64";
  
    if (selectedWorldIndex === null) {
      worlds.push({ name, mode, version, date, img });
    } else {
      worlds[selectedWorldIndex] = { ...worlds[selectedWorldIndex], name, mode, version };
    }
  
    closeModal();
    renderWorlds();
  }
  
function closeModal() {
    document.getElementById("worldModal").style.display = "none";
}
  
function cancel() {
    alert("Returning to home screen...");
    window.location.href = "/Mainpage/maindash.html";
}
  
window.onload = renderWorlds;