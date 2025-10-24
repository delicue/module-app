// event-hydrate.js
// Small client-side bridge for PHP-hydrated events.

(function (global) {
    if (global.PHPEventEmitter) return; // don't override

    const listeners = {};

    function on(event, fn) {
        (listeners[event] = listeners[event] || []).push(fn);
    }

    function off(event, fn) {
        if (!listeners[event]) return;
        if (!fn) { delete listeners[event]; return; }
        listeners[event] = listeners[event].filter(f => f !== fn);
    }

    function emit(event, args) {
        const list = listeners[event] || [];
        list.forEach(fn => { try { fn.apply(null, args || []); } catch (e) { /* ignore */ } });
    }

    // Expose simple API
    global.PHPEventEmitter = { on, off, emit };

    // If server already hydrated events into window.__PHP_EVENTS__, process them now
    if (Array.isArray(global.__PHP_EVENTS__) && global.__PHP_EVENTS__.length) {
        global.__PHP_EVENTS__.forEach(e => {
            try {
                emit(e.event, e.args || []);
            } catch (_) {}
            try {
                document.dispatchEvent(new CustomEvent(e.event, { detail: e.args || [] }));
            } catch (_) {}
        });
    }

})(window);
