import Header from "./partials/header.js";
import Footer from "./partials/footer.js";
import Router from "./utils/router.js";
import Nav from "./partials/nav.js";

export default function Main()
{
    return /*html*/ `
        ${Header()}
        ${Nav()}
        ${Router()}
        ${Footer()}
    `
}