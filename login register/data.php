<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/4829/4829008.png">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <title>Server Monitoring</title>
  <style>
    body {
      font-family:"Open Sans";
      background-image:url('https://www.racksolutions.com/news//app/uploads/AdobeStock_87909563.jpg');
      margin: 0;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color:white;
      padding: 10px 20px;
      color: white;
      position: fixed;
      top: 0;
      width: 100%;
      box-sizing: border-box;
    }
    .navbar img {
      width: 50px;
      height: 50px;
    }
    .navbar h1 {
      margin: 0;
      margin-left: 10px;
      color: black;
    }
    .navbar button {
      color: white;
      background-color: #222D51;
      height: 50px;
      width: 150px;
      border-radius: 5px;
      font-family: "Open Sans";
      font-size: large;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
    .navbar button:hover {
      background-color: white;
      color: #222D51;
      border: 2px solid #222D51;
    }
    .server {
      margin: 10px 0;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
      opacity: 80%;
    }
    .server p {
      margin: 5px 0;
    }
    .status-up {
      color: green;
      font-weight: bold;
    }
    .status-down {
      color: red;
      font-weight: bold;
    }
    .container {
      background-color: white;
      border-radius: 5px;
      width: 700px;
      margin-top:130px;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      opacity: 90%;
    }
    .content {
      display: flex;
      justify-content: center;
    }
    h2 {
      text-align: center;
      text-decoration: underline;
    }
  </style>
</head>
<body>
    <div class="navbar">
      <div style="display: flex; align-items: center;">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwhhDo0NZ9iWcEgTHVMjJWGnWIOunvh-a0Pg&s" alt="logo">
        <h1>Server Monitoring Dashboard</h1>
      </div>
      <button onclick="window.location.href='landing.php'">Logout</button>
    </div>

    <div class="content">
       <div class="container">
          <h2>Server Status<i class="fa-solid fa-heartbeat" style="margin-left:5px;"></i></h2>
          <div id="status-container">
               <!-- Server statuses will be displayed here -->
          </div>
       </div>
    </div>

  <script>
    async function fetchServerStatus() {
      try {
        // Fetch server status from the backend
        const response = await fetch('http://127.0.0.1:5000/server-status');
        const servers = await response.json();

        // Update the web interface
        const statusContainer = document.getElementById('status-container');
        statusContainer.innerHTML = ''; // Clear previous content

        servers.forEach(server => {
          const serverElement = document.createElement('div');
          serverElement.classList.add('server');
          serverElement.innerHTML = `
            <p><strong>${server.name}</strong> (${server.ip})</p>
            <p>Status: <span class="${server.status === 'up' ? 'status-up' : 'status-down'}">
              ${server.status.toUpperCase()}
            </span></p>
          `;
          statusContainer.appendChild(serverElement);
        });
      } catch (error) {
        console.error('Error fetching server status:', error);
      }
    }

    // Poll the server status every 2 seconds
    setInterval(fetchServerStatus, 2000);
    fetchServerStatus(); // Initial call
  </script>
</body>
</html>