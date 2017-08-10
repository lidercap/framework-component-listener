<?php

declare(strict_types=1);

namespace Lidercap\Component\Listener;

/**
 * Event Listener.
 */
class Event
{
    use Behavior\StrictAware;

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
