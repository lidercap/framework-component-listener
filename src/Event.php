<?php

declare(strict_types=1);

namespace Lidercap\Component\Listener;

use Lidercap\Component\Listener\Event\Triggers;

/**
 * Event Listener.
 */
class Event
{
    /**
     * Ativa/desativa o strict mode do componente.
     *
     * @param bool $strict
     */
    public static function strictMode(bool $strict)
    {
        Triggers::getInstance()->setStrict($strict);
    }

    /**
     * Adiciona um trigger na fila de um evento.
     *
     * @param string   $event    Nome do evento.
     * @param \Closure $callback Função de callback.
     */
    public static function bind(string $event, \Closure $callback)
    {
        Triggers::getInstance()->bind($event, $callback);
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
        Triggers::getInstance()->trigger($event, $args);
    }
}
