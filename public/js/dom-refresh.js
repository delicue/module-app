// dom-refresh.js
// This script polls the server for changes to a PHP file and reloads the DOM if updated.

const POLL_INTERVAL = 2000; // ms

const SCAN_ENDPOINT = '/scan-changes.php'; // Endpoint to check for file changes
let lastHash = null;

async function checkForUpdate() {
    try {
        const response = await fetch(SCAN_ENDPOINT);
        const newHash = await response.text();
        if (lastHash && newHash && newHash !== lastHash) {
            location.reload(); // Refresh the page
        }
        lastHash = newHash;
    } catch (e) {
        // Handle error silently
    }
}

setInterval(checkForUpdate, POLL_INTERVAL);