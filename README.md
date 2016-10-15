# Facebook-messenger-init

### Version
1.0

### Installation

```
composer require qq/facebook-messenger-init
```


### Usages

```php
<?php

require 'vendor/autoload.php';

@define('ACCESS_TOKEN','YOUR_FACEBOOK_ACCESS_TOKEN');

$BuildMessage = new \BuildMessage\BuildMessage(ACCESS_TOKEN,$senderID);
$BuildMessage->addMessageType();
$BuildMessage->addText('Welcome on my Facebook Bot');
$BuildMessage->sendMessage();
```

### Methods

#### Typing message event 
```php
$BuildMessage->typingOnMessage();
```

#### Send audio message
```php
$BuildMessage->addMessageType();
$BuildMessage->addAudio('URL_AUDIO_FILE');
```

#### Send image message
```php
$BuildMessage->addMessageType();
$BuildMessage->addImages('URL_IMAGE_FILE');
```

#### Send video message
```php
$BuildMessage->addMessageType();
$BuildMessage->addVideo('URL_VIDEO_FILE');
```

#### Add quick replies
```php
$BuildMessage->addMessageType();
$BuildMessage->addText('How do you think this package is ?');
$QuickReply = new \QuickReply\QuickReply();
$QuickReply->addQuickReply();
$QuickReply->addReply('text','Dope','PAYLOAD_DOPE','');
$QuickReply->addReply('text','Super dope','PAYLOAD_SUPER_DOPE','');
$BuildMessage->addTemplate($QuickReply->getElement());
$BuildMessage->sendMessage();
```
