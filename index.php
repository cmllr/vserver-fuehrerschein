<html>
    <head>
        <link rel="stylesheet" href="./Styles/Base.css">
        <link rel="stylesheet" href="./Lib/CssCheckboxKit_1437741714065090/style.css">
        <title></title>     
    </head>
    <body class="body">
        <div class="header">
            <p class="topic">Grundstoff</p>
            <p class="time">Restzeit: 23:59</p>
        </div>
        <div class="content">
            <div class="questionText">Warum mach ich das eigentlich?</div>
            <img class="questionImage" src="http://i0.kym-cdn.com/photos/images/newsfeed/000/096/044/trollface.jpg?1296494117"></img>
            <ul class="answers">
                <li><input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox" /><label for="checkboxG1" class="css-label">CSS hier, CSS da</label></li>
                <li><input type="checkbox" name="checkboxG2" id="checkboxG2" class="css-checkbox" /><label for="checkboxG2" class="css-label">Programmieren ist immer gut</label></li>
                <li><input type="checkbox" name="checkboxG3" id="checkboxG3" class="css-checkbox" /><label for="checkboxG3" class="css-label">begehrt das trollin</label></li>
            </ul>
        </div>
        <div class="buttons">
            <a class="button button-danger">Abgeben</a>
            <a class="button button-mark">Markieren</a>
            <a class="button button-next">Nächste Frage</a>
        </div>
        <div class="tab">
            <ul class='tabs'>
                <li><a href='#tab1'>Grundstoff</a></li>
            </ul>

            <div id='tab1' class='tabPane'>
                <?php for ($i = 1; $i < 21; $i++) : ?>
                <a href='#'><div class="question"><?php echo $i;?></div></a>
                <?php endfor; ?>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <script>
            $('ul.tabs').each(function() {
                // For each set of tabs, we want to keep track of
                // which tab is active and it's associated content
                var $active, $content, $links = $(this).find('a');

                // If the location.hash matches one of the links, use that as the active tab.
                // If no match is found, use the first link as the initial active tab.
                $active = $($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                $active.addClass('active');

                $content = $($active[0].hash);

                // Hide the remaining content
                $links.not($active).each(function() {
                    $(this.hash).hide();
                });

                // Bind the click event handler
                $(this).on('click', 'a', function(e) {
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