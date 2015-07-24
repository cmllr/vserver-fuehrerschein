<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Answer
 *
 * @author fury
 */
class Answer {
    public $Text;
    public $IsTrue;
    public function __construct($text,$isTrue) {
        $this->Text = $text;
        $this->IsTrue = $isTrue;
    }
}
