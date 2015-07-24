<html>
    <head>
        <link rel="stylesheet" href="./Styles/Base.css">
        <link rel="stylesheet" href="./Lib/CssCheckboxKit_1437741714065090/style.css">
        <title><?php echo $this->Name; ?></title>     
    </head>
    <body class="body">
        <div class="header">
            <p class="topic"><?php echo $this->SetName; ?></p>
            <p class="time">Restzeit: 23:59</p>
        </div>
        <form class="content" action="index.php?q=<?php echo $question->Identifier; ?>" method="post">
            <input id="marked" name="marked" type="checkbox" <?php echo ($question->IsMarked) ? "checked" : ""; ?>>
            <input type="hidden" id="question" value="<?php echo $question->Identifier; ?>">
            <div class="questionText"><?php echo $question->Text; ?></div>
            <?php if (!is_null($question->Image)): ?>
                <img class="questionImage" src="<?php echo $question->Image; ?>"></img>
            <?php endif; ?>
            <ul class="answers">
                <?php foreach ($question->Answers as $key => $value) : ?>
                    <li><input type="checkbox" name="answer<?php echo $key; ?>" id="answer<?php echo $key; ?>" class="css-checkbox" <?php echo (isset($question->ChoosedAnswers[$key])) ? "checked" : ""; ?>/><label for="answer<?php echo $key; ?>" class="css-label"><?php echo $value->Text; ?></label></li>
                <?php endforeach; ?>
            </ul>
            <div class="buttons">
                 <input type="submit" class="button button-danger" name="submit" value="<?php echo $this->GetTranslation("Submit"); ?>">
                <input type="submit" class="button button-mark" name="mark" value="<?php echo $this->GetTranslation("Mark"); ?>">
                <input type="submit" class="button button-next" value="<?php echo $this->GetTranslation("Next"); ?>">
            </div>
        </form>
        <div class="tab">
            <ul class='tabs'>
                <li><a href='#tab1'><?php echo $this->SetName; ?></a></li>
            </ul>
            <div id='tab1' class='tabPane'>
                <?php for ($i = 0; $i < count($this->QuestionSet); $i++) : ?>
                    <a href='index.php?q=<?php echo $i; ?>'><div class="question <?php echo $this->QuestionSet[$i]->IsMarked? "marked" : "";?>" id="<?php echo $i; ?>"><?php echo $i + 1; ?></div></a>
                    <?php endfor; ?>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <script>
            $(".button-mark").click(function () {
                var target = $(".question#" + $("#question").val());
                var white = "rgb(255, 255, 255)";
                var marked = $(this).css("background-color");
                $("#marked").trigger("click");
                if (target.css("background-color") === white)
                    $(".question#" + $("#question").val()).css("background-color", marked);
                else
                    $(".question#" + $("#question").val()).css("background-color", white);
                
            });
            $('ul.tabs').each(function () {
                // For each set of tabs, we want to keep track of
                // which tab is active and it's associated content
                var $active, $content, $links = $(this).find('a');

                // If the location.hash matches one of the links, use that as the active tab.
                // If no match is found, use the first link as the initial active tab.
                $active = $($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                $active.addClass('active');

                $content = $($active[0].hash);

                // Hide the remaining content
                $links.not($active).each(function () {
                    $(this.hash).hide();
                });

                // Bind the click event handler
                $(this).on('click', 'a', function (e) {
                    // Make the old tab inactive.
                    $active.removeClass('active');
                    $content.hide();

                    // Update the variables with the new link and content
                    $active = $(this);
                    $content = $(this.hash);

                    // Make the tab active.
                    $active.addClass('active');
                    $content.show();

                    // Prevent the anchor's default click action
                    e.preventDefault();
                });
            });
        </script>
    </body>
</html>