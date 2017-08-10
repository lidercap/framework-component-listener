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
    protected $strict = false;

    /**
     * Ativa/desativa o modo strict do componente.
     *
     * @param bool $strict
     *
     * @return $this
     */
    public function setStrict(bool $strict = true) : self
    {
        $this->strict = $strict;

        return $this;
    }
}
