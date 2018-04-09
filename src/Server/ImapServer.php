<?php

namespace sanduhrs\Autoconfig\Server;

use sanduhrs\Autoconfig\Server;

/**
 * Class ImapServer
 *
 * @package sanduhrs\Autoconfig\Server
 */
class ImapServer extends Server
{

    /**
     * ImapServer constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $options += [
            'type' => 'imap',
            'port' => '993',
            'socketType' => self::SOCKET_TYPE_SSL,
            'authentication' => self::AUTHENTICATION_PLAIN,
        ];
        parent::__construct($options);
    }
}
