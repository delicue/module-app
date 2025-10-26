<?php
declare(strict_types=1);

namespace App;

use App\EventDispatcher;

final class Module
{
    /**
     * Shared EventDispatcher instance (lazy-initialized).
     */
    private static ?EventDispatcher $dispatcher = null;

    /**
     * Set (or clear) the shared EventDispatcher instance.
     */
    public static function setDispatcher(?EventDispatcher $dispatcher): void
    {
        self::$dispatcher = $dispatcher;
    }

    /**
     * Get (or lazily create) the shared EventDispatcher instance.
     */
    public static function getDispatcher(): EventDispatcher
    {
        return self::$dispatcher ??= new EventDispatcher();
    }
}
