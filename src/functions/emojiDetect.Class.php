<?php
/**
 * Created by PhpStorm.
 * User: quentinmangin
 * Date: 13/11/15
 * Time: 16:29
 */

namespace EmojiDetect;

class EmojiDetect {

    public $connexion;
    public $application;

    function __construct(){
        include('src/functions/emoji.php');
    }

    public function checkEmoji($message){
        $this->listeEmoji = array();
        $this->checkRejex($message);
        return $this->listeEmoji;
    }

    private function checkRejex($message){
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        preg_match($regexEmoticons, $message, $matches_emo);
        
        if (!empty($matches_emo[0])) {
            array_push($this->listeEmoji,$this->matchEmoji($matches_emo[0]));
            $messageSanitize = str_replace($matches_emo[0], '', $message);
            $this->checkRejex($messageSanitize);
        }

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        preg_match($regexSymbols, $message, $matches_sym);
        if (!empty($matches_sym[0])) {
            array_push($this->listeEmoji,$this->matchEmoji($matches_sym[0]));
            $messageSanitize = str_replace($matches_sym[0], '', $message);
            $this->checkRejex($messageSanitize);
        }

        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        preg_match($regexTransport, $message, $matches_trans);
        if (!empty($matches_trans[0])) {
            array_push($this->listeEmoji,$this->matchEmoji($matches_trans[0]));
            $messageSanitize = str_replace($matches_trans[0], '', $message);
            $this->checkRejex($messageSanitize);
        }

        $regexMisc = '/[\x{2600}-\x{26FF}]/u';
        preg_match($regexMisc, $message, $matches_misc);
        if (!empty($matches_misc[0])) {
            array_push($this->listeEmoji,$this->matchEmoji($matches_misc[0]));
            $messageSanitize = str_replace($matches_misc[0], '', $message);
            $this->checkRejex($messageSanitize);
        }

        // Match Dingbats
        $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
        preg_match($regexDingbats, $message, $matches_bats);
        if (!empty($matches_bats[0])) {
            array_push($this->listeEmoji,$this->matchEmoji($matches_bats[0]));
            $messageSanitize = str_replace($matches_bats[0], '', $message);
            $this->checkRejex($messageSanitize);
        }

        return true;
    }

    private function matchEmoji($emoji){
        $data = emoji_docomo_to_unified($emoji);
        $code = emoji_unified_to_html($data);

        return $code;
    }
}