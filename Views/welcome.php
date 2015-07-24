<html>
    <head>
        <link rel="stylesheet" href="./Styles/Base.css">
        <link rel="stylesheet" href="./Lib/CssCheckboxKit_1437741714065090/style.css">
        <title><?php echo $this->Name;?></title>      
    </head>
    <body class="body">     
        <div class="welcomeText">
            <h1><?php echo $this->GetTranslation("WelcomeTitle");?></h1>
            <p>
                <?php echo $this->GetTranslation("WelcomeText");?>
            </p>
            <a href="?q=0" class="button button-next"><?php echo $this->GetTranslation("StartTest");?></a>
        </div>
    </body>
</html>