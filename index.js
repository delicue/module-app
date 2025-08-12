/**
 * This app is made to be used without need for backend influence,
 */

import express from "express";
import path from "path";
import { fileURLToPath } from "url";
import { routes } from "./src/utils/routes.js";
// import createTables from "./database/createTables.js";

const __dirname = path.dirname(fileURLToPath(import.meta.url));

const app = express();
const PORT = 3000;

// Serve static files from the 'src' directory
app.use(express.static(path.join(__dirname, "src")));

// Serve index.html for the root route
Array.from(Object.keys(routes)).forEach(key => {
  app.get(key, (req, res) => {
    res.setHeader("Content-Type", "text/html");
    res.setHeader("title", routes[key].title);
    res.send(routes[key].link());
  });
})

/**
 * API Example with JSON file
 */
// app.get("/api/ducks", async (req, res) => {
//   res.setHeader("Content-Type", "application/json");
//   const response = await import('./data/ducks.json', { with: { type: 'json' } });
//   res.send(response);
// });

app.listen(PORT, () => {
  try {
    console.log('Creating database...');
    // createTables();
  } catch(e) {
    console.log(e.message);
  } finally {
    console.log('Finished creating database.');
  }
  console.log(`Server running at http://localhost:${PORT}`);
});