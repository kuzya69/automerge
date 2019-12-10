<html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="js/jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/add.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Russo+One&display=swap&subset=cyrillic,latin-ext" rel="stylesheet">
        
        <script src="js/add.js" ></script>
        <title>Мерге</title>
	</head>
	<body>
        <form class = "chill-form" id = "archive_form" >
            <label class = "chill-form__label" >
                <h3 class = "chill-form__header" >Input the name of the widget</h3>
                <input class = "chill-form__input" name = "name" required ></input> 
            </label>
            <label class = "chill-form__label" >
                <h3 class = "chill-form__header" >Drag the archive of the widget here:</h3>
                <div class = "chill-form__dropzone" >
                    <div class = "dropzone__picture" ></div>
                    <input type = "file" class = "dropzone__file" name = "archive" accept="application/zip" hidden />    
                </div>
            </label>
            <div class = "dropzone__bottom" >
                <p class = "dropzone__status" >Element</p>
                <div class = "dropzone__clear" >remove</div> 
            </div>
            <input type = "submit" class = "chill-form__button" value = "ok" />  
        </form> 
        <div class = "chill-modal__error" >
            <h3 class = "chill-modal__text" ></h3>
        </div> 

        <div class = "check_form_wrapper" >
            <form class = "chill-form" id = "check_form" method = "GET" action = "process.php" >
                <h3 class = "chill-form__header" >Please, check info, that will be written into the manifest.json:</h3>
                <h3 class = "chill-form__importantinfo" id = "check-form__new-widget-info" >This widget is being loading for the <b>first</b> time. The data in the inputs has been grabed from loaded widget's manifest.json. In 99,99% situations it <b>must be changed</b> to the correct data</h3>
                
                <h3 class = "chill-form__header" >Code:</h3>
                <input class = "chill-form__input" name = "code" accept="application/zip" required />
                <h3 class = "chill-form__header" >Secret_key:</h3>
                <input class = "chill-form__input" name = "secret_key" accept="application/zip" required />
                <h3 class = "chill-form__header" >Version:</h3>
                <input class = "chill-form__input" name = "version" accept="application/zip" required />

                <div class = "form__btnset" >
                    <input type = "submit" class = "chill-form__button inline-btn" value = "ok" />  
                    <input type = "button" id = "form__cancel-btn" class = "chill-form__button inline-btn" value = "cancel" />
                </div>  
            </form>
        </div> 

	</body>
</html> 