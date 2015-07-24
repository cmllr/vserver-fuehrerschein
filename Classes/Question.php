<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author fury
 */
class Question {
    public $Text;
    public $Answers;
    public $Image;
    public $Identifier;
    public $ChoosedAnswers;
    public $IsMarked;
    public $ErrorPoints;
    public function __construct($text,$answers,$identifier,$image,$errorPoints) {
        $this->Text = $text;
        $this->Answers = $answers;
        $this->Identifier = $identifier;
        $this->Image = $image;
        $this->ErrorPoints = $errorPoints;
    }
}
