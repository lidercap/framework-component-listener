<?php

declare(strict_types=1);

namespace Lidercap\Component\Listener\Event\Trigger;

use Lidercap\Core\Pattern;

class Trigger
{
    use Pattern\Singleton;

    /**
     * @var array
     */
    protected static $events = [];

    /**
     * Recupera a fila de listeners inteira.
     *
     * @return array
     */
    public static function fetchAll() : array
    {
        return self::$events;
    }

    /**
     * Recupera a fila de listeners de um evento em específico.
     *
     * @param string $event Nome do evento.
     *
     * @throws Exception\EventListenerException para eventos não encontrados, caso
     *                                          o modo strict esteja ativado.
     *
     * @return array
     */
    public static function fetch(string $event) : array
    {
        if (!isset(self::$events[$event])) {
            if (self::$strict) {
                $message = sprintf('Evento não registrado: %s', $event);
                throw new Exception\EventListenerException($message, -1);
            }

            return [];
        }

        return self::$events[$event];
    }
}
