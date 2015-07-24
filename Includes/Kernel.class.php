<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kernel
 *
 * @author fury
 */
class Kernel {

    private $QuestionSet;
    private $SetName;
    private $Name;

    public function __construct() {
        $this->UpdateSession();
        $this->SetName = $this->GetTranslation("VServerCatalogue");
        $this->Name = $this->GetTranslation("VServerLicense");

        if (!isset($_GET["q"])) {
            include './Views/welcome.php';
        } else {
            $question = null;
            if (empty($_POST)) {
                $question = $this->GetQuestion((int) $_GET["q"]);
            } else {
                $currentIndex = (int) $_GET["q"];
                //save the result
                $currentQuestion = (isset($this->QuestionSet[$currentIndex])) ? $this->QuestionSet[$currentIndex] : null;
                $answers = array();
                $currentQuestion->ChoosedAnswers = array();
                foreach ($_POST as $key => $value) {
                    if (strpos($key, "answer") !== false) {
                        $index = str_replace("answer", "", $key);
                        $answers[] = $currentQuestion->Answers[$index];
                    }
                }
                if (!is_array($currentQuestion->ChoosedAnswers)) {
                    $currentQuestion->ChoosedAnswers = $answers;
                }
                var_dump($this->QuestionSet[$currentIndex]);              
                //next question, please
                $wantedIndex = 0;
                $question = (isset($this->QuestionSet[$currentIndex++])) ? $this->QuestionSet[$currentIndex++] : null;
            }
            var_dump($question);
            $_SESSION["QuestionSet"] = $this->QuestionSet;
            if (!is_null($question)) {
                include "./Views/question.php";
            } else {
                echo "Ende";
            }
        }
    }

    private function UpdateSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["QuestionSet"])) {
            $this->QuestionSet = array();
            $this->SetUpQuestions();
            $_SESSION["QuestionSet"] = $this->QuestionSet;
        } else {
            $this->QuestionSet = $_SESSION["QuestionSet"];
        }
    }

    private function SetUpQuestions() {
        $answers = array(
            new Answer("Antwort 1", true),
            new Answer("Antwort 2", false)
        );
        $q = new Question("Frage 1", $answers, 0, "http://i0.kym-cdn.com/photos/images/newsfeed/000/096/044/trollface.jpg?1296494117");
        $q2 = new Question("Frage 2", $answers, 1, null);
        $this->QuestionSet[] = $q;
        $this->QuestionSet[] = $q2;
    }

    private function GetQuestion($identifier) {
        return isset($this->QuestionSet[$identifier]) ? $this->QuestionSet[$identifier] : null;
    }

    private function GetTranslation($value) {
        //TODO
        return $value;
    }

}
