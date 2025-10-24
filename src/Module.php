<?php

namespace App;

use App\EventDispatcher;

class Module
{
    protected static ?EventDispatcher $dispatcher = null;

    /** Set the shared EventDispatcher instance */
    public static function setDispatcher(EventDispatcher $dispatcher): void
    {
        self::$dispatcher = $dispatcher;
    }

    /** Get (or lazily create) the shared EventDispatcher instance */
    public static function getDispatcher(): EventDispatcher
    {
        if (self::$dispatcher === null) {
            self::$dispatcher = new EventDispatcher();
        }
        return self::$dispatcher;
    }
}
