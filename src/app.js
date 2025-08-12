import Main from "./main.js";
import render from "./utils/render.js";
import handleClicks from "./utils/handleClicks.js";
import mount from "./utils/mount.js";

const app = document.body.querySelector('#app');

app.innerHTML = render(Main());

mount(() => {
    // handleClicks();
})