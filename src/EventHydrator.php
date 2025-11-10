<?php

namespace App;

class EventHydrator
{
    /**
     * Render a small script tag that places recorded PHP events on window and
     * dispatches them to the DOM and to the optional JS bridge `window.PHPEventEmitter`.
     */
    public static function render(): void
    {
        $events = EventCollector::getEvents(true);
        if (empty($events)) {
            return;
        }

        // JSON-encode safely for inclusion in HTML
        $json = json_encode($events, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        echo "<script>window.__PHP_EVENTS__ = $json; (function(events){\n" .
        // Inline processing: dispatch as CustomEvent and call bridge if available
        "  if(typeof window.PHPEventEmitter === 'object' && typeof window.PHPEventEmitter.emit === 'function') {\n" .
        "    events.forEach(function(e){ window.PHPEventEmitter.emit(e.event, e.args || []); });\n" .
        "  }\n" .
        "  events.forEach(function(e){ try{ document.dispatchEvent(new CustomEvent(e.event, { detail: e.args || [] })); }catch(_){} });\n" .
        "})(window.__PHP_EVENTS__);</script>";
    }
}