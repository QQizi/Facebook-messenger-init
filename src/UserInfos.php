<?php
/**
 * Created by PhpStorm.
 * User: quentinmangin
 * Date: 13/11/15
 * Time: 16:29
 */

namespace UserInfos;

class UserInfos {

    public $user;

    private $facebookToken;

    function __construct($facebookToken = NULL, $sender = NULL){

        $this->facebookToken        =   $facebookToken;

        $this->user                 =   new \stdClass();
        $this->user->id             =   $sender;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v2.6/".$sender."?fields=first_name,last_name,profile_pic,locale,timezone,gender&access_token=".$this->facebookToken);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->user->infos = json_decode(curl_exec($ch));
        curl_close($ch);
    }

    public function getUser(){
        return $this->user;
    }
}