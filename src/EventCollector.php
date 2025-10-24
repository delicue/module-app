<?php

namespace App;

/**
 * Collect events emitted during a single request so they can be hydrated to the client.
 */
class EventCollector
{
    /** @var array<int, array{event:string,args:array}> */
    protected static array $events = [];

    public static function record(string $event, array $args = []): void
    {
        self::$events[] = [
            'event' => $event,
            'args' => $args,
        ];
    }

    /**
     * Get and optionally clear the collected events
     *
     * @param bool $clear
     * @return array<int, array{event:string,args:array}>
     */
    public static function getEvents(bool $clear = true): array
    {
        $out = self::$events;
        if ($clear) {
            self::$events = [];
        }
        return $out;
    }

    public static function clear(): void
    {
        self::$events = [];
    }
}
