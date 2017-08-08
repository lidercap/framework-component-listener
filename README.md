Component Listener
==================

Listener de eventos.

Instalação
----------

É recomendado instalar **component-listener** através do [composer](http://getcomposer.org).

```json
{
    "require": {
        "lidercap/framework-component-listener": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@bitbucket.org:lidercap/framework-component-listener.git"
        }
    ]
}
```

Adicionando um listener a um evento
-----------------------------------

Adiciona um evento na fila de eventos a serem lançados e atribui um callback a este evento.

```php
<?php

\Lidercap\Component\Listener\Event::bind('event.name', function(array $args = []) 
{
    // Aqui algo vai o código que se deseja disparar para o evento.

    /**
     * OBS 1: Os argumentos da função sempre deverão ser declarados
     *        como opcionais para não quebrar o código
     */

     /**
     * OBS 2: Os listener de um evento são acumulativos, não substitutivos.
     *        Ou seja, ao chamar o método "bind" uma segunda vez para um 
     *        mesmo evento, um segundo listener estará sendo adicionado.
     */
});

```

Disparando os listeners de um evento
------------------------------------

Dispara a execussão de todos os listeners definidos para um evento.

Os listeners serão executados na ordem em que foram adicionados ao evento.

```php
<?php

\Lidercap\Component\Listener\Event::trigger('event.name', $args);

/**
 * OBS 1: Os argumentos são opcionais.
 */

 /**
  * OBS 2: Caso o modo strict do componente esteja ativado, o disparo
  *        de eventos sem listeners irá lançar uma excessão. Caso contrário,
  *        nenhum efeito ou erro é esperado.
  */

```

Desenvolvimento e Testes
------------------------

Dependências:

 * PHP 7.0.x ou superior
 * Composer
 * Git
 * Make

Para rodar a suite de testes, você deve instalar as dependências externas do projeto e então rodar o PHPUnit.

    $ make install
    $ make test    (sem relatório de coverage)
    $ make testdox (com relatório de coverage)

Responsáveis técnicos
---------------------

 * **André Sabino: <asabino@lidercap.com.br>**
 * **Fernando Villaça: <fvillaca@lidercap.com.br>**
 * **Leonardo Thibes: <lthibes@lidercap.com.br>**
