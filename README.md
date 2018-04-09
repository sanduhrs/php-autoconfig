# Autoconfiguration

This is an implementation of [Mozilla's Autoconfiguration](https://developer.mozilla.org/en-US/docs/Mozilla/Thunderbird/Autoconfiguration).
The goal is to provide email clients all necessary information to make it as 
easy as possible for the user to configure their email clients securely.

> In many cases, people should be able to download and install Thunderbird, 
> enter their real name, email address and password in the Account Setup Wizard 
> and have a fully functioning mail client and get and send their mail as 
> securely as possible.
– https://developer.mozilla.org/en-US/docs/Mozilla/Thunderbird/Autoconfiguration

A full usage example:

    <?php
    require __DIR__ . '/vendor/autoload.php';
    
    use sanduhrs\Autoconfig\Autoconfig;
    
    $autoconfig = new Autoconfig();
    $autoconfig->setClientConfigUpdate('https://example.com/config.xml');
    
    // Add provider configuration.
    $provider = $autoconfig->setProvider('example.com');
    $provider
      ->addDomain('example.com')
      ->addDomain('example.net')
      ->addDomain('example.org')
      ->setDisplayName('The example.com display name')
      ->setDisplayShortName('example.com short name');
    
    // Common configuration.
    $common = [
      'hostname' => 'mail.example.com',
      'username' => 'user@example.com',
      'password' => 'a84wzrswm4tro8sm',
    ];
    
    // Add servers in order of priority.
    // Default SSL/TLS secured configuration.
    $autoconfig->addImapServer($common);
    // A STARTTLS secured configuration.
    $autoconfig->addImapServer($common + [
      'port' => 143,
      'socketType' => 'STARTTLS',
    ]);
    // A plain text configuration.
    $autoconfig->addImapServer($common + [
      'port' => 143,
      'socketType' => 'plain',
    ]);
    
    $autoconfig->addPop3Server($common);
    $autoconfig->addPop3Server($common + [
      'port' => 110,
      'socketType' => 'plain',
    ]);
    
    $autoconfig->addSmtpServer($common);
    $autoconfig->addSmtpServer($common + [
      'port' => 25,
      'socketType' => 'plain',
    ]);
    
    // Add web mail configuration.
    $webMail = $autoconfig->setWebMail();
    $webMail
      ->setLoginPageUrl('https://example.com/webmail')
      ->setLoginPageInfoUrl('https://example.com/webmail')
      ->setUsername($common['username'])
      ->setUsernameField('username', 'username')
      ->setPasswordField('password', 'password')
      ->setLoginButton('login', 'login');
    
    print $autoconfig->toXml();

## License
GPL 2 or later https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
