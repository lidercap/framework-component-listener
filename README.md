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

Criando um evento
-----------------

Adiciona um evento na fila de eventos a serem lançados e atribui um callback a este evento.

```php
<?php

\Lidercap\Component\Listener\Event::bind('event.name', function(array $args = []) 
{
    // Aqui algo vai o código que se deseja disparar para o evento.
});

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
