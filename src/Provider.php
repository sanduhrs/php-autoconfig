<?php

namespace sanduhrs\Autoconfig;

/**
 * Class Provider
 *
 * @package sanduhrs\Autoconfig
 */
class Provider
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string[]
     */
    protected $domains;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $displayShortName;

    /**
     * @var string
     */
    protected $identity;

    /**
     * @var \sanduhrs\Autoconfig\Server[]
     */
    protected $incomingServers;

    /**
     * @var \sanduhrs\Autoconfig\Server[]
     */
    protected $outgoingServers;

    /**
     * Provider constructor.
     *
     * @param string $id
     * @param array $options
     */
    public function __construct($id = '', $options = [])
    {
        $options += [
            'domains' => [],
            'displayName' => '',
            'displayShortName' => '',
            'identity' => '',
            'incomingServers' => [],
            'outgoingServers' => [],
        ];

        $this->id = $id;
        $this->domains = $options['domains'];
        $this->displayName = $options['displayName'];
        $this->displayShortName = $options['displayShortName'];
        $this->identity = $options['identity'];
        $this->incomingServers = $options['incomingServers'];
        $this->outgoingServers = $options['outgoingServers'];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * @param string[] $domains
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setDomains(array $domains)
    {
        $this->domains = $domains;
        return $this;
    }

    /**
     * @param string $domain
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function addDomain($domain)
    {
        array_push($this->domains, $domain);
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayShortName()
    {
        return $this->displayShortName;
    }

    /**
     * @param string $displayShortName
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setDisplayShortName($displayShortName)
    {
        $this->displayShortName = $displayShortName;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param string $identity
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @return \sanduhrs\Autoconfig\Server[]
     */
    public function getIncomingServers()
    {
        return $this->incomingServers;
    }

    /**
     * @param \sanduhrs\Autoconfig\Server[] $servers
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setIncomingServers($servers)
    {
        $this->incomingServers = $servers;
        return $this;
    }

    /**
     * @return \sanduhrs\Autoconfig\Server[]
     */
    public function getOutgoingServers()
    {
        return $this->outgoingServers;
    }

    /**
     * @param \sanduhrs\Autoconfig\Server[] $servers
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setOutgoingServers($servers)
    {
        $this->outgoingServers = $servers;
        return $this;
    }

    /**
     * @param \sanduhrs\Autoconfig\Server $server
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function addIncomingServer($server)
    {
        array_push($this->incomingServers, $server);
        return end($this->incomingServers);
    }

    /**
     * @param \sanduhrs\Autoconfig\Server $server
     *
     * @return \sanduhrs\Autoconfig\Server
     */
    public function addOutgoingServer($server)
    {
        array_push($this->outgoingServers, $server);
        return end($this->outgoingServers);
    }

    /**
     * @param \sanduhrs\Autoconfig\Server\Pop3Server $server
     *
     * @return \sanduhrs\Autoconfig\Server\Pop3Server
     */
    public function addPop3Server($server)
    {
        return $this->addIncomingServer($server);
    }

    /**
     * @param \sanduhrs\Autoconfig\Server\ImapServer $server
     *
     * @return \sanduhrs\Autoconfig\Server\ImapServer
     */
    public function addImapServer($server)
    {
        return $this->addIncomingServer($server);
    }

    /**
     * @param \sanduhrs\Autoconfig\Server\SmtpServer $server
     *
     * @return \sanduhrs\Autoconfig\Server\SmtpServer
     */
    public function addSmtpServer($server)
    {
        return $this->addOutgoingServer($server);
    }
}
