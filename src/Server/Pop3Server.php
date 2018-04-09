<?php

namespace sanduhrs\Autoconfig\Server;

use sanduhrs\Autoconfig\Server;

class Pop3Server extends Server
{

    /**
     * Pop3Server constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $options += [
            'type' => 'pop3',
            'port' => '995',
            'socketType' => self::SOCKET_TYPE_SSL,
            'authentication' => self::AUTHENTICATION_PLAIN,
        ];
        parent::__construct($options);
    }
}
