(function () {
    function showFlash(args) {
        var data = Array.isArray(args) ? args[0] : args;
        if (Array.isArray(data) && data.length) data = data[0];
        var msg = (data && data.message) ? data.message : String(data || '');
        var el = document.getElementById('php-flash');
        if (!el) return;
        el.textContent = msg;
        el.classList.remove('hidden');
        setTimeout(function () {
            el.classList.add('hidden');
        }, 5000);
    }

    // Always listen for DOM CustomEvent dispatched by the hydrator
    document.addEventListener('flash', function (e) {
        showFlash(e.detail);
    });

    // If the JS bridge exists, register on it. If not yet present, poll briefly.
    if (window.PHPEventEmitter && typeof window.PHPEventEmitter.on === 'function') {
        window.PHPEventEmitter.on('flash', showFlash);
    } else {
        var _i = setInterval(function () {
            if (window.PHPEventEmitter && typeof window.PHPEventEmitter.on === 'function') {
                window.PHPEventEmitter.on('flash', showFlash);
                clearInterval(_i);
            }
        }, 50);
    }
})();