# Facebook-messenger-init

### Version
1.1

### Installation

```
composer require qq/izzi-facebook-messenger-init
```


### Usages

```php
<?php

require 'vendor/autoload.php';

$BuildMessage = new \BuildMessage\BuildMessage(YOUR_FACEBOOK_ACCESS_TOKEN,$senderID);
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

## Add quick replies text only
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

##### Add quick replies text and images
```php
$QuickReply->addReply('text','Dope','PAYLOAD_DOPE','URL_IMAGE_1');
$QuickReply->addReply('text','Super dope','PAYLOAD_SUPER_DOPE','URL_IMAGE_2');
```

##### Add quick replies location
```php
$QuickReply->addReply('location','Localisation','','');
```

## Add generic template
```php
$BuildMessage = new \BuildMessage\BuildMessage(ACCESS_TOKEN,$sender);
$BuildMessage->addTemplateType('generic');
$firstTemplateElement = new \TemplateElement\TemplateElement();
$firstTemplateElement->createGenericElement('This package is dope like that','DOPE_IMAGE','Description of how dope is this package');
$buttonTemplate->addButton("web_url", "https://giphy.com/gifs/viceprincipals-danny-mcbride-vice-principals-hbo-l46CcJYJWRg1jB3Y4", "Super dope !", "");
$buttonTemplate->addButton("web_url", "https://giphy.com/gifs/hip-hop-rap-lAk8drorgcS9W", "More than dope", "");
$BuildMessage->addTemplate($firstTemplateElement->getElement());
$BuildMessage->sendMessage();
```

You can add multiple template to a message

## Add button template
```php
$BuildMessage = new \BuildMessage\BuildMessage(ACCESS_TOKEN,$sender);
$BuildMessage->addTemplateType('button','No seriously, how dope is this package ?');
$buttonTemplate = new \TemplateElement\TemplateElement();
$buttonTemplate->addButton("web_url", "https://giphy.com/gifs/viceprincipals-danny-mcbride-vice-principals-hbo-l46CcJYJWRg1jB3Y4", "Super dope !", "");
$buttonTemplate->addButton("web_url", "https://giphy.com/gifs/hip-hop-rap-lAk8drorgcS9W", "More than dope", "");
$BuildMessage->addTemplate($buttonTemplate->getElement());
$BuildMessage->sendMessage();
```

## Get user infos
```php
$User   =   new \UserInfos\UserInfos($sender);
$User->getUser()->infos->first_name
```

See : https://developers.facebook.com/docs/messenger-platform/user-profile