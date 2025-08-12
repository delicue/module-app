import Home from "../pages/index.js"
import About from "../pages/about.js"
import { routes } from "./routes.js";

export default function Router()
{
    const currentUrl = window.location.pathname;
    
    return /*html*/`
        ${routes[currentUrl].link()}
    `
}