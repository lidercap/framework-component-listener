<?php

declare(strict_types=1);

namespace Lidercap\Component\Listener\Behavior;

/**
 * @codeCoverageIgnore
 */
trait StrictAware
{
    /**
     * @var bool
     */
    protected static $strict = false;

    /**
     * Ativa/desativa o modo strict do componente.
     *
     * @param bool $strict
     */
    public static function strictMode(bool $strict)
    {
        self::$strict = $strict;
    }
}
