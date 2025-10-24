# Event Dispatcher & Hydration

This project includes a small server-side Event Dispatcher which can emit events during a request and hydrate them to the client as JavaScript events.

Files
- `src/EventDispatcher.php` — Simple emitter with `on`, `once`, `off`, `emit` and `getListeners`.
- `src/EventCollector.php` — Collects emitted events during the request for hydration.
- `src/EventHydrator.php` — Renders a safe inline `<script>` that places events on `window.__PHP_EVENTS__` and dispatches them.
- `public/js/event-hydrate.js` — Client-side bridge exposing `window.PHPEventEmitter` (API: `on`, `off`, `emit`) and processes hydrated events.
- `src/Module.php` — Provides `Module::getDispatcher()` and `Module::setDispatcher()` as a shared accessor for the app.

How it works

1. Use the shared dispatcher from anywhere:

```php
use App\\Module;

$dispatcher = Module::getDispatcher();
$dispatcher->emit('flash', ['type' => 'success', 'message' => 'Saved']);
```

2. After all server work is done (typically in your footer partial) call:

```php
\\App\\EventHydrator::render();
```

3. Include the client bridge on the page (already added to the footer):

```html
<script src="/js/event-hydrate.js"></script>
```

4. Listen for events on the client either via the bridge or DOM CustomEvents:

```js
// bridge
window.PHPEventEmitter.on('flash', (payload) => { console.log(payload); });

// DOM
document.addEventListener('flash', (e) => { console.log(e.detail); });
```

Security
- `EventHydrator::render()` uses `json_encode` with JSON_HEX_* flags to reduce injection risk. Avoid emitting raw user-supplied HTML in events.

Notes
- Events are per-request only — they are not persisted across requests unless you implement storage.
- The dispatcher is intentionally minimal. If you want event logging, exception bubbling, or queuing, those can be added.
