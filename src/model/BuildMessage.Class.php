<?php
/**
 * Created by PhpStorm.
 * User: quentinmangin
 * Date: 13/11/15
 * Time: 16:29
 */

namespace buildMessage;

class buildMessage {

    private $isMessageType;
    private $isTemplateType;
    private $isPrevMessage;
    private $templateType;

    private $facebookToken;
    private $idRecipient;

    public $message;

    function __construct($facebookToken = NULL, $idRecipient = NULL){
        $this->idRecipient      =   $idRecipient;
        $this->facebookToken    =   $facebookToken;

        $this->message          =   '{';
        $this->isMessageType    =   false;
        $this->isTemplateType   =   false;
        $this->isPrevMessage    =   false;
        $this->templateType     =   null;

        $this->message .= '"recipient":{"id":"'.$this->idRecipient.'"}';
    }

    //Set typing indicators or send read receipts using the Send API, to let users know you are processing their request.
    public function typingOnMessage(){
        $this->message .= ',"sender_action":"typing_on"';
    }

    public function addMessageType(){
        $this->isMessageType = true;
        $this->message .= ', "message":{';
    }

    //Send plain text messages
    public function addText($text){
        ($this->isPrevMessage == true) ? $this->message .= ',' : '';

        $this->message .= '"text":"'.$text.'"';

        $this->isPrevMessage = true;
    }

    //Send images messages
    public function addImages($url){
        ($this->isPrevMessage == true) ? $this->message .= ',' : '';

        $this->message .= '"attachment":{"type":"image", "payload":{"url":"'.$url.'"}}';

        $this->isPrevMessage = true;
    }

    //Send audio messages
    public function addAudio($url){
        ($this->isPrevMessage == true) ? $this->message .= ',' : '';

        $this->message .= '"attachment":{"type":"audio", "payload":{"url":"'.$url.'"}}';

        $this->isPrevMessage = true;
    }

    //Send audio messages
    public function addVideo($url){
        ($this->isPrevMessage == true) ? $this->message .= ',' : '';

        $this->message .= '"attachment":{"type":"video", "payload":{"url":"'.$url.'"}}';

        $this->isPrevMessage = true;
    }

    public function addTemplateType($type, $text = null){
        $this->templateType     = $type;
        $this->isTemplateType   = true;

        $this->message .= ',"message": {"attachment":{"type":"template", "payload":{"template_type":"'.$type.'",';

        $this->message .= ($type == 'button')? '"text":"'.$text.'",' : '';
        $this->message .= ($type == 'generic')? '"elements":[' : '';
    }

    public function addTemplate($template){
        $this->message .= $template.',';
    }

    /*
     *
     *
     *
     * */

    public function getMessage(){
        return $this->message;
    }

    private function clean(){
        $this->message = (substr($this->message, -1) == ',') ? substr($this->message, 0, -1) : $this->message;
    }

    public function sendMessage(){

        $this->clean();

        if($this->isMessageType == true){
            $this->message .= '}';
        }

        if($this->isTemplateType == true){
            $this->message .= ($this->templateType != 'button')? ']}' : '';
            $this->message .= '}}';
        }

        $this->message .= '}';

        //Initiate cURL.
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$this->facebookToken);

        //Encode the array into JSON.
        $jsonDataEncoded = $this->message;

        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        //Execute the request
        $result = curl_exec($ch);
    }

}