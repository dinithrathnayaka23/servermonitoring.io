import os
import subprocess
import threading
import time
from flask import Flask, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Enable CORS for frontend-backend communication

# List of servers to monitor
SERVERS = [
    {"name": "Faculty Server", "ip": "192.248.11.37"},
    {"name": "Cloudfire", "ip": "1.1.1.1"},
    {"name":"Invalid","ip":"256.1.2.3"}
]

# Shared data structure to store server statuses
server_status = {}

# Function to continuously ping servers
def ping_servers():
    global server_status
    while True:
        for server in SERVERS:
            ip = server["ip"]
            try:
                # Run the ping command
                response = subprocess.run(
                    ["ping", "-n", "1", ip],
                    stdout=subprocess.PIPE,
                    stderr=subprocess.PIPE,
                    text=True
                )
                # Update server status
                server_status[ip] = "up" if response.returncode == 0 else "down"
            except Exception as e:
                print(f"Error pinging {ip}: {e}")
                server_status[ip] = "down"
        time.sleep(2)  # Wait for 2 seconds before the next round of pings

# Start a thread to continuously monitor server statuses
monitor_thread = threading.Thread(target=ping_servers, daemon=True)
monitor_thread.start()

# API endpoint to get the latest server statuses
@app.route('/server-status', methods=['GET'])
def get_server_status():
    statuses = [
        {
            "name": server["name"],
            "ip": server["ip"],
            "status": server_status.get(server["ip"], "unknown"),
        }
        for server in SERVERS
    ]
    return jsonify(statuses)

if __name__ == '__main__':
    app.run(host="0.0.0.0", port=5000)
