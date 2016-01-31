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
    private $MaximumAllowedErrors;

    public function __construct() {
        $this->UpdateSession();
        $this->SetName = $this->GetTranslation("vServer-FührerscheinB");
        $this->Name = $this->GetTranslation("VServerDriverLicense");
        $this->MaximumAllowedErrors = 10;
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
                        $answers[$index] = $currentQuestion->Answers[$index];
                    }
                }
                $currentQuestion->ChoosedAnswers = $answers;
                $currentQuestion->IsMarked = isset($_POST["marked"]);
                //next question, please
                $wantedIndex = 0;

                $_SESSION["QuestionSet"] = $this->QuestionSet;
                
                if (!isset($_POST["save"])) {
                    if (!isset($_POST["mark"]))
                        $question = (isset($this->QuestionSet[$currentIndex++])) ? $this->QuestionSet[$currentIndex++] : null;
                    else
                        $question = $currentQuestion;
                    if (isset($_POST["submit"])) {
                        //user wants to see his shitty result
                        $question = null;
                    }
                    if ($question == $currentQuestion && !isset($_POST["mark"]))
                        $question = null;
                }
                else {
                    $question = $currentQuestion;
                }
            }
            if (!is_null($question)) {
                include "./Views/question.php";
            } else {
                $this->CalculateResult();
            }
        }
    }

    private function CalculateResult() {
        $mistakePoints = 0;
        $maximumErrorPoints = 0;
        $questions = $_SESSION["QuestionSet"];
        foreach ($questions as $key => $value) {
            $maximumErrorPoints += $value->ErrorPoints;
            if (empty($value->ChoosedAnswers)) {
                $mistakePoints = $mistakePoints + $value->ErrorPoints;
            } else {
                foreach ($value->ChoosedAnswers as $k => $v) {
                    if (!$v->IsTrue) {
                        $mistakePoints = $mistakePoints + $value->ErrorPoints;
                        break;
                    }
                }
            }
        }
        $percentage = 0;
        if ($mistakePoints != 0) {
            $percentage = (100 / ($maximumErrorPoints / $mistakePoints));
        }
        session_destroy();
        include "./Views/result.php";
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
        $this->QuestionSet = json_decode(file_get_contents("./Questions/vserver.json"));
    }

    private function GetQuestion($identifier) {
        return isset($this->QuestionSet[$identifier]) ? $this->QuestionSet[$identifier] : null;
    }

    private function GetTranslation($value) {
        //TODO: Session
        $data = json_decode(file_get_contents("./Language/de-de.json"));
        if (property_exists($data, $value)) {
            return $data->{$value};
        } else {
            return $value;
        }
    }

}
