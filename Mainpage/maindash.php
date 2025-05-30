<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select World</title>
  <link rel="stylesheet" href="/Mainpage/maindashstyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1>Select World</h1>
    <div class="scrollable-element">
    <div class="world-list" id="worldList"></div>
    </div>

    <div class="button-row">
        <div class="button-row-top">
          <button onclick="playWorld()">Play Selected World</button>
          <button onclick="createWorld()">Create New World</button>
        </div>
        <div class="button-row-bottom">
          <button onclick="editWorld()">Edit</button>
          <button onclick="deleteWorld()">Delete</button>
          <button onclick="recreateWorld()">Re-Create</button>
          <button onclick="cancel()">Cancel!</button>
        </div>
      </div>

  <div id="worldModal" class="modal">
    <div class="modal-content">
      <h2 id="modalTitle">Create World</h2>
      <label>Name: <input type="text" id="worldName"></label>
      <label>Mode:
        <select id="worldMode">
          <option>Creative</option>
          <option>Survival</option>
        </select>
      </label>
      <label>Version: <input type="text" id="worldVersion"></label>
      <div class="modal-buttons">
        <button onclick="saveWorld()">Save</button>
        <button onclick="closeModal()">Cancel</button>
      </div>
    </div>
  </div>

  <script src="/Mainpage/maindashscript.js"></script>
</body>
</html>