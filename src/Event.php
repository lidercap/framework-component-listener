<?php

declare(strict_types=1);

namespace Lidercap\Component\Listener;

use Lidercap\Core\Pattern;

/**
 * Event Listener.
 */
class Event
{
    use Pattern\Singleton;

    /**
     * Fila de eventos.
     *
     * @var array
     */
    protected static $events = [];

    /**
     * Adiciona um listener na fila de um evento.
     *
     * @param string  $event    Nome do evento.
     * @param Closure $callback Função de callback.
     */
    public static function bind(string $event, Closure $callback)
    {
        self::$events[$event][] = $callback;
    }
}
