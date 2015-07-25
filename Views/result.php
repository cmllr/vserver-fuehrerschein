<html>
    <head>
        <link rel="stylesheet" href="./Styles/Base.css">
        <link rel="stylesheet" href="./Lib/CssCheckboxKit_1437741714065090/style.css">
        <title><?php echo $this->Name; ?></title>      
    </head>
    <body class="body">     
        <div class="resultContent">
            <h1><?php echo $this->GetTranslation("ResultTitle"); ?></h1>
            <?php foreach ($questions as $key => $value) : ?>
                <h2><?php echo $value->Text; ?></h2>
                <p> <?php echo $this->GetTranslation("YourAnswers"); ?></p>
                <?php if (count($value->ChoosedAnswers) == 0) : ?>
                    <p><?php echo $this->GetTranslation("NoAnswer"); ?></p>
                <?php endif; ?>
                <?php foreach ($value->ChoosedAnswers as $k => $v) : ?>
                    <?php echo $v->Text; ?> <?php echo ($v->IsTrue) ? $this->GetTranslation("CorrectAnswer") : $this->GetTranslation("WrongAnswer"); ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <p>
                <?php echo $this->GetTranslation("Mistakes") . " " . $mistakePoints; ?>
            </p>
             <p>
                <?php echo $this->GetTranslation("MaximumMistakes") . " " . $this->MaximumAllowedErrors; ?>
            </p>
            <?php
                if ($mistakePoints >= $this->MaximumAllowedErrors) {
                    echo "<h2>".$this->GetTranslation("Fail")."</h2>";
                    echo "<p>".$this->GetTranslation("FailDescription")."</p>";
                } else {
                    echo "<h2>".$this->GetTranslation("Success")."</h2>";
                     echo "<p>".$this->GetTranslation("SuccessDescription")."</p>";
                }
                ?>
            
            <div class="progress">
                <div class="errors" style="width:<?php echo $percentage; ?>%">                    
                </div>
            </div>
        </div>
    </body>
</html>