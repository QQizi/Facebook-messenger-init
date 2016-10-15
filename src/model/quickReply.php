<?php
/**
 * Created by PhpStorm.
 * User: quentinmangin
 * Date: 13/11/15
 * Time: 16:29
 */

namespace QQizi\QuickReply;

class QuickReply {

    public $element;

    function __construct(){
        $this->element              =   '';
    }

    public function addQuickReply(){
        $this->element .= ',"quick_replies":[';
    }

    public function addReply($content_type, $title, $payload, $image_url){
        $this->element .= '{';
        $this->element .= (strlen($content_type)) ? '"content_type":"'.$content_type.'",' : '';
        $this->element .= (strlen($title)) ? '"title":"'.$title.'",' : '';
        $this->element .= (strlen($payload)) ? '"payload":"'.$payload.'",' : '';
        $this->element .= (strlen($image_url)) ? '"image_url":"'.$image_url.'",' : '';
        $this->clean();
        $this->element .= '},';
    }

    public function getElement(){
        $this->clean();
        $this->element .= ']';

        return $this->element;
    }

    private function clean(){
        $this->element = (substr($this->element, -1) == ',') ? substr($this->element, 0, -1) : $this->element;
    }
}