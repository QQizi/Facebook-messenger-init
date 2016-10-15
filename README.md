# Facebook-messenger-init

### Version
1.0

### Installation

```
composer require qq/facebook-messenger-init
```


### Usages

```
<?php

require 'vendor/autoload.php';

@define('ACCESS_TOKEN','YOUR_FACEBOOK_ACCESS_TOKEN');

$BuildMessage = new \BuildMessage\BuildMessage(ACCESS_TOKEN,$senderID);
$BuildMessage->addMessageType();
$BuildMessage->addText('Welcome on my Facebook Bot');
$BuildMessage->sendMessage();

```