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
    use Behavior\StrictAware;

    /**
     * @var array
     */
    protected static $events = [];

    /**
     * Adiciona um listener na fila de um evento.
     *
     * @param string   $event    Nome do evento.
     * @param \Closure $callback Função de callback.
     */
    public static function bind(string $event, \Closure $callback)
    {
        self::$events[$event][] = $callback;
    }

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

    /**
     * Lança todos os triggers de um evento.
     *
     * @param string $event Nome do evento.
     * @param array  $args  Lista de argumentos a serem passados para o Closure de callback.
     *
     * @throws Exception\EventListenerException para eventos não encontrados, caso
     *                                          o modo strict esteja ativado.
     */
    public static function trigger(string $event, array $args = [])
    {
        $triggers = self::fetch($event);
        foreach ($triggers as $trigger) {
            \call_user_func($trigger, $args);
        }
    }
}
