import { routes } from "../utils/routes.js";


export default function Nav() {
    let items = '';
    Array.from(Object.keys(routes)).forEach((routeKey) => {
        items += `<li><a href="${routeKey}">${routes[routeKey].title}</a></li>`;
    });
    return /*html*/`
        <nav>
            <ul>
                ${items}
            </ul>
        </nav>
    `;
}