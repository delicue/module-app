<?php

namespace App;

use App\EventCollector;

/**
 * Simple Event Dispatcher / Emitter
 *
 * Usage:
 *   $d = new EventDispatcher();
 *   $d->on('saved', function($model){ echo "Saved: " . $model->id; });
 *   $d->emit('saved', $model);
 */
class EventDispatcher
{
    /** @var array<string, callable[]> */
    protected array $listeners = [];

    /** Register a listener for an event */
    public function on(string $event, callable $listener): void
    {
        $this->listeners[$event][] = $listener;
    }

    /** Register a one-time listener */
    public function once(string $event, callable $listener): void
    {
        $self = $this;
        $wrapper = null;
        $wrapper = function (...$args) use (&$wrapper, $event, $listener, $self) {
            $self->off($event, $wrapper);
            return $listener(...$args);
        };
        $this->on($event, $wrapper);
    }

    /** Remove a listener. If no listener provided, remove all listeners for the event */
    public function off(string $event, ?callable $listener = null): void
    {
        if (!isset($this->listeners[$event])) {
            return;
        }

        if ($listener === null) {
            unset($this->listeners[$event]);
            return;
        }

        // Remove matching listeners (compare by string representation when possible)
        $this->listeners[$event] = array_values(array_filter($this->listeners[$event], function ($l) use ($listener) {
            // Try strict comparison for closures and callables
            return $l !== $listener;
        }));

        if (empty($this->listeners[$event])) {
            unset($this->listeners[$event]);
        }
    }

    /** Emit an event with optional arguments */
    public function emit(string $event, mixed ...$args): void
    {
        // Record the event for hydration to the client
        EventCollector::record($event, $args);

        if (empty($this->listeners[$event])) {
            return;
        }

        // Call listeners in the order they were registered
        foreach ($this->listeners[$event] as $listener) {
            try {
                $listener(...$args);
            } catch (\Throwable $e) {
                // Swallow listener exceptions to avoid breaking other listeners.
                // In a real app you might log this.
            }
        }
    }

    /** Get listeners (for testing/debugging) */
    public function getListeners(?string $event = null): array
    {
        if ($event === null) {
            return $this->listeners;
        }
        return $this->listeners[$event] ?? [];
    }
}
