<?php
/**
 * Created by PhpStorm.
 * User: quentinmangin
 * Date: 13/11/15
 * Time: 16:29
 */

namespace TemplateElement;

class TemplateElement {

    private $haveButton;
    private $isGenericElement;

    public $element;

    function __construct(){
        $this->element              =   '';
        $this->haveButton             =   false;
        $this->isGenericElement     =   false;
    }

    public function createGenericElement($titre,$itemUrl,$imageUrl,$subtitle){

        if(mb_detect_encoding($subtitle,'ISO-8859-1',true)) {
            $subtitle = iconv('ISO-8859-1', 'UTF-8//TRANSLIT', $subtitle);
        }

        if(mb_detect_encoding($titre,'ISO-8859-1',true)) {
            $titre = iconv('ISO-8859-1', 'UTF-8//TRANSLIT', $titre);
        }

        $this->element .= '{';
        $this->element .= (strlen($titre)) ? '"title":"'.$titre.'",' : '';
        $this->element .= (strlen($itemUrl)) ? '"item_url":"'.$itemUrl.'",' : '';
        $this->element .= (strlen($imageUrl)) ? '"image_url":"'.$imageUrl.'",' : '';
        $this->element .= (strlen($subtitle)) ? '"subtitle":"'.$subtitle.'",' : '';

        $this->isGenericElement = true;
    }

    public function addButton($type, $url, $title, $payload){
        
        if($this->haveButton == false){
            $this->element .= '"buttons":[';
            $this->haveButton = true;
        }
        
        $this->element .= '{';
        $this->element .= (strlen($type)) ? '"type":"'.$type.'",' : '';
        $this->element .= (strlen($url)) ? '"url":"'.$url.'",' : '';
        $this->element .= (strlen($title)) ? '"title":"'.$title.'",' : '';
        $this->element .= (strlen($payload)) ? '"payload":"'.$payload.'",' : '';
        $this->clean();
        $this->element .= '},';
    }

    public function getElement(){
        $this->clean();
        ($this->haveButton == true) ? $this->element .= ']' : '';
        $this->element .= '}';
        return $this->element;
    }

    private function clean(){
        $this->element = (substr($this->element, -1) == ',') ? substr($this->element, 0, -1) : $this->element;
    }
}