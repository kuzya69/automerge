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
        <form class = "chill-form" >
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
                <p class = "dragzone__status" ></p> 
            </label>
            <input type = "submit" class = "chill-form__button" value = "ok" />  
        </form> 
        <div class = "chill-modal__error" >
            <h3 class = "chill-modal__text" ></h3>
        </div>       
	</body>
</html> 