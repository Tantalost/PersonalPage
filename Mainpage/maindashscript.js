let worlds = [
    {
      name: "Portfolio",
      date: "10/05/2025, 7:00 pm",
      mode: "Creative",
      version: "3.1",
      img: "https://i.redd.it/xf9lfoq75lf31.png"
    },
    {
      name: "CV/Resume/Biodata",
      date: "13/07/2022, 1:30 pm",
      mode: "Survival",
      version: "8.1",
      img: "https://assetsio.gnwcdn.com/pack__1_.png?width=1200&height=1200&fit=bounds&quality=70&format=jpg&auto=webp"
    },
    {
      name: "Web Scraper",
      date: "01/01/2023, 12:00 pm",
      mode: "Survival",
      version: "1.2",
      img: "https://media.licdn.com/dms/image/v2/C5603AQEU8b-iJvTZrg/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1645491449277?e=2147483647&v=beta&t=OQijFzsKNkJOEe5ZFjZ7pnw499SHhyd87Bsh57Sjems"
    },
    {
      name: "Github Profile",
      date: "10/05/2023, 3:45 pm",
      mode: "Creative",
      version: "6.2",
      img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhBGIIU8c_gA8qeLyRlg1xyY4TQFv76tJdPC8MUFiOHr_KVbOw5phcx94PMSmbJRvE1ts&usqp=CAU"
    },
    {
      name: "Random Coffee Place Decider",
      date: "20/09/2023, 10:15 am",
      mode: "Survival",
      version: "1.1",
      img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC7V2ugGxpGeu8Zn5ISLKtQS0CcCdWufIhXw&s"
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
    window.location.href = "../Dashboard/dashboard.php";
}
  
window.onload = renderWorlds;