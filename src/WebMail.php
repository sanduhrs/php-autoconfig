<?php

namespace sanduhrs\Autoconfig;

/**
 * Class WebMail
 *
 * @package sanduhrs\Autoconfig
 */
class WebMail
{

    /**
     * @var string
     */
    protected $loginPageUrl;

    /**
     * @var string
     */
    protected $loginPageInfoUrl;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string[]
     */
    protected $usernameField;

    /**
     * @var string[]
     */
    protected $passwordField;

    /**
     * @var string[]
     */
    protected $loginButton;

    /**
     * WebMail constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $options += [
            'loginPageUrl' => '',
            'loginPageInfoUrl' => '',
            'username' => '',
            'usernameField' => ['', ''],
            'passwordField' => ['', ''],
            'loginButton' => ['', ''],
        ];

        $this->loginPageUrl = $options['loginPageUrl'];
        $this->loginPageInfoUrl = $options['loginPageInfoUrl'];
        $this->username = $options['username'];
        $this->usernameField = $options['usernameField'];
        $this->passwordField = $options['passwordField'];
        $this->loginButton = $options['loginButton'];
    }

    /**
     * @return string
     */
    public function getLoginPageUrl()
    {
        return $this->loginPageUrl;
    }

    /**
     * @param string $url
     *
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setLoginPageUrl($url)
    {
        $this->loginPageUrl = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getLoginPageInfoUrl()
    {
        return $this->loginPageInfoUrl;
    }

    /**
     * @param string $url
     *
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setLoginPageInfoUrl($url)
    {
        $this->loginPageInfoUrl = $url;
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
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsernameField()
    {
        return $this->usernameField;
    }

    /**
     * @param string $id
     * @param string $name
     *
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setUsernameField($id, $name)
    {
        $this->usernameField = [$id, $name];
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordField()
    {
        return $this->passwordField;
    }

    /**
     * @param string $id
     * @param string $name
     *
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setPasswordField($id, $name)
    {
        $this->passwordField = [$id, $name];
        return $this;
    }

    /**
     * @return string
     */
    public function getLoginButton()
    {
        return $this->loginButton;
    }

    /**
     * @param string $id
     * @param string $name
     *
     * @return \sanduhrs\Autoconfig\WebMail
     */
    public function setLoginButton($id, $name)
    {
        $this->loginButton = [$id, $name];
        return $this;
    }
}
