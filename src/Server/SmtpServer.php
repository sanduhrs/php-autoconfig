<?php

namespace sanduhrs\Autoconfig\Server;

use sanduhrs\Autoconfig\Server;

class SmtpServer extends Server
{

    /**
     * SmtpServer constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $options += [
            'type' => 'smtp',
            'port' => '465',
            'socketType' => self::SOCKET_TYPE_SSL,
            'authentication' => self::AUTHENTICATION_PLAIN,
        ];
        parent::__construct($options);
    }
}
