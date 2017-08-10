<?php

declare(strict_types=1);

namespace Lidercap\Component\Listener\Event;

use Lidercap\Component\Listener\Behavior;
use Lidercap\Component\Listener\Exception;
use Lidercap\Core\Pattern;

class Triggers
{
    use Pattern\Singleton;
    use Behavior\StrictAware;

    /**
     * @var array
     */
    protected $triggers = [];

    /**
     * Adiciona um trigger na fila de um evento.
     *
     * @param string   $event    Nome do evento.
     * @param \Closure $callback Função de callback.
     *
     * @return $this
     */
    public function bind(string $event, \Closure $callback) : self
    {
        $this->triggers[$event][] = $callback;

        return $this;
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
    public function trigger(string $event, array $args = [])
    {
        $triggers = $this->fetch($event);
        foreach ($triggers as $trigger) {
            \call_user_func($trigger, $args);
        }
    }

    /**
     * Recupera a fila de triggers inteira.
     *
     * @return array
     */
    public function fetchAll() : array
    {
        return $this->triggers;
    }

    /**
     * Recupera a fila de triggers de um evento em específico.
     *
     * @param string $event Nome do evento.
     *
     * @throws Exception\EventListenerException para eventos não encontrados, caso
     *                                          o modo strict esteja ativado.
     *
     * @return array
     */
    public function fetch(string $event) : array
    {
        if (!isset($this->triggers[$event])) {
            if ($this->strict) {
                $message = sprintf('Evento não registrado: %s', $event);
                throw new Exception\EventListenerException($message, -1);
            }

            return [];
        }

        return $this->triggers[$event];
    }

    /**
     * Limpa os trigges de um evento em específico.
     *
     * @param string $event Nome do evento.
     *
     * @return $this
     */
    public function clean(string $event) : self
    {
        if (isset($this->triggers[$event])) {
            unset($this->triggers[$event]);
        }

        return $this;
    }

    /**
     * Limpa todos os triggers.
     *
     * @return Triggers
     */
    public function cleanAll() : self
    {
        $this->triggers = [];

        return $this;
    }
}
