<?php

namespace sanduhrs\Autoconfig;

use DOMDocument;
use sanduhrs\Autoconfig\Server\ImapServer;
use sanduhrs\Autoconfig\Server\Pop3Server;
use sanduhrs\Autoconfig\Server\SmtpServer;

/**
 * Class Autoconfig
 *
 * @package sanduhrs\Autoconfig
 *
 * @see https://developer.mozilla.org/en-US/docs/Mozilla/Thunderbird/Autoconfiguration
 * @see https://wiki.mozilla.org/Thunderbird:Autoconfiguration:ConfigFileFormat
 */
class Autoconfig
{

    const VERSION = '0.1.0';

    const AUTOCONFIG_VERSION = '1.1';

    const AUTOCONFIG_DOMAIN_PREFIX = 'autoconfig';

    const AUTOCONFIG_FILE_NAME = 'config-v1.1.xml';

    const AUTOCONFIG_PATH = 'mail/';

    const AUTOCONFIG_WELL_KNOWN_PATH = '.well-known/autoconfig/mail/';

    const PLACEHOLDER_EMAIL_ADDRESS = '%EMAILADDRESS%';

    const PLACEHOLDER_EMAIL_LOCAL_PART = '%EMAILLOCALPART%';

    const PLACEHOLDER_EMAIL_DOMAIN = '%EMAILDOMAIN%';

    const PLACEHOLDER_REAL_NAME = '%REALNAME%';

    /**
     * @var \sanduhrs\Autoconfig\Provider
     */
    protected $provider;

    /**
     * @var \sanduhrs\Autoconfig\WebMail
     */
    protected $webMail;

    /**
     * @var string
     */
    protected $clientConfigUpdate;

    /**
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param $id
     * @param array $options
     *
     * @return \sanduhrs\Autoconfig\Provider
     */
    public function setProvider($id, $options = [])
    {
        $this->provider = new Provider($id, $options);
        return $this->provider;
    }

    /**
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function getWebMail()
    {
        return $this->webMail;
    }

    /**
     * @param array $options
     *
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setWebMail($options = [])
    {
        $this->webMail = new WebMail($options);
        return $this->webMail;
    }

    /**
     * @return string
     */
    public function getClientConfigUpdate()
    {
        return $this->clientConfigUpdate;
    }

    /**
     * @param string $url
     *
     * @return \sanduhrs\Autoconfig\Autoconfig
     */
    public function setClientConfigUpdate($url)
    {
        $this->clientConfigUpdate = $url;
        return $this;
    }

    /**
     * @param array $options
     *
     * @return \sanduhrs\Autoconfig\Autoconfig
     */
    public function addImapServer($options)
    {
        $this->provider->addImapServer(new ImapServer($options));
        return $this;
    }

    /**
     * @param array $options
     *
     * @return \sanduhrs\Autoconfig\Autoconfig
     */
    public function addPop3Server($options)
    {
        $this->provider->addPop3Server(new Pop3Server($options));
        return $this;
    }

    /**
     * @param array $options
     *
     * @return \sanduhrs\Autoconfig\Autoconfig
     */
    public function addSmtpServer($options)
    {
        $this->provider->addSmtpServer(new SmtpServer($options));
        return $this;
    }

    /**
     * @return string
     */
    public function toXml()
    {
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        $clientConfig = $xml->createElement('clientConfig');
        $clientConfig->setAttribute('version', self::AUTOCONFIG_VERSION);
        $xml->appendChild($clientConfig);

        $provider = $xml->createElement('emailProvider');
        $provider->setAttribute('id', $this->provider->getId());
        foreach ($this->provider->getDomains() as $domain) {
            $element = $xml->createElement('domain', $domain);
            $provider->appendChild($element);
        }
        $element = $xml->createElement(
            'displayName',
            $this->provider->getDisplayName()
        );
        $provider->appendChild($element);
        $element = $xml->createElement(
            'displayShortName',
            $this->provider->getDisplayShortName()
        );
        $provider->appendChild($element);

        /** @var \sanduhrs\Autoconfig\Server $server */
        foreach ($this->provider->getIncomingServers() as $server) {
            $element = $xml->createElement('incomingServer');
            foreach (['hostname', 'port', 'socketType', 'username', 'authentication', 'password'] as $name) {
                $attribute = $xml->createElement(
                    $name,
                    $server->{'get' . ucfirst($name)}()
                );
                $element->setAttribute('type', $server->getType());
                $element->appendChild($attribute);
            }
            $provider->appendChild($element);
        }

        /** @var \sanduhrs\Autoconfig\Server $server */
        foreach ($this->provider->getOutgoingServers() as $server) {
            $element = $xml->createElement('outgoingServer');
            foreach (['hostname', 'port', 'socketType', 'username', 'authentication', 'password'] as $name) {
                $attribute = $xml->createElement(
                    $name,
                    $server->{'get' . ucfirst($name)}()
                );
                $element->setAttribute('type', $server->getType());
                $element->appendChild($attribute);
            }
            $provider->appendChild($element);
        }

        $clientConfig->appendChild($provider);

        $webMail = $xml->createElement('webMail');
        $loginPage = $xml->createElement('loginPage');
        $loginPage->setAttribute('url', $this->webMail->getLoginPageUrl());
        $webMail->appendChild($loginPage);

        $loginPageInfo = $xml->createElement('loginPageInfo');
        $loginPageInfo->setAttribute('url', $this->webMail->getLoginPageInfoUrl());
        $webMail->appendChild($loginPageInfo);

        $username = $xml->createElement('username', $this->webMail->getUsername());
        $loginPageInfo->appendChild($username);

        foreach (['usernameField', 'passwordField', 'loginButton'] as $value) {
            $element = $xml->createElement($value);
            list($name, $id) = $this->webMail->getUsernameField();
            $element->setAttribute('id', $id);
            $element->setAttribute('name', $name);
            $loginPageInfo->appendChild($element);
        }

        $clientConfig->appendChild($webMail);

        $clientConfigUpdate = $xml->createElement('clientConfigUpdate');
        $clientConfigUpdate->setAttribute('url', $this->getClientConfigUpdate());
        $clientConfig->appendChild($clientConfigUpdate);

        return $xml->saveXML();
    }

    /**
     * @return string
     */
    public function serve()
    {
        header("Content-Type: application/xml; charset=utf-8");
        print $this->toXml();
    }
}
