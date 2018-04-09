<?php

namespace sanduhrs\Autoconfig;

/**
 * Class Server
 *
 * @package sanduhrs\Autoconfig
 */
class Server
{

    const AUTHENTICATION_PASSWORD_CLEARTEXT = 'password-cleartext';

    const AUTHENTICATION_PLAIN = 'plain';

    const AUTHENTICATION_PASSWORD_ENCRYPTED = 'password-encrypted';

    const AUTHENTICATION_SECURE = 'secure';

    const AUTHENTICATION_NTLM = 'NTLM';

    const AUTHENTICATION_GSSAPI = 'GSSAPI';

    const AUTHENTICATION_CLIENT_IP_ADDRESS = 'client-IP-address';

    const AUTHENTICATION_TLS_CLIENT_CERT = 'TLS-client-cert';

    const AUTHENTICATION_OAUTH2 = 'OAuth2';

    const AUTHENTICATION_NONE = 'none';

    const SOCKET_TYPE_PLAIN = 'PLAIN' ;

    const SOCKET_TYPE_SSL = 'SSL';

    const SOCKET_TYPE_STARTTLS = 'STARTTLS';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $socketType;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $authentication;

    /**
     * @var string
     */
    protected $password;

    /**
     * Provider constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $options += [
            'hostname' => '',
            'port' => '',
            'socketType' => '',
            'username' => '',
            'authentication' => '',
            'password' => '',
        ];

        $this->hostname = $options['hostname'];
        $this->port = $options['port'];
        $this->socketType = $options['socketType'];
        $this->username = $options['username'];
        $this->authentication = $options['authentication'];
        $this->password = $options['password'];
        $this->type = $options['type'];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getSocketType()
    {
        return $this->socketType;
    }

    /**
     * @param string $socketType
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setSocketType($socketType)
    {
        $this->socketType = $socketType;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @param string $authentication
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
