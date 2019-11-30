
<html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="js/index/jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="test.css">
		<title>Мерге</title>

        <script src="js/index/notice" ></script>
        <script src="js/index/init" ></script>
	</head>
	<body>
        <form class = "chill-form" name = "postform" method = "POST" enctype="multipart/form-data" >
            <div class = "chill-form__label" id="form-label" >New</div>
            <h3 class = "chill-form__header" >Automerge</h3>
            <input 
                type = "text" 
                name = "name" 
                class = "chill-form__input" 
                placeholder = "Название виджета" 
                required pattern="[A-Za-z0-9_-]{2,}" 
                title="Input name of the widget" 
            />
            <input type = "file" name = "arch" class = "chill-form__file" placeholder = "Архивчик" accept="application/zip" required />    
            <input type = "button" class = "chill-form__button" value = "Проверить" />
            <div class = "addition_info" >
                <input type = "hash" name = "hash" class = "chill-form__input" placeholder = "Input the code" />
                <input type = "version" name = "version" class = "chill-form__input" placeholder = "Input the version" pattern = "(\d+\.)+\d" />
            </div>
        </form>	
        <div class = "chill-notice" >
            <h3 class = "chill-notice__header" >Error</h3>
            <p class = "chill-notice__text" ></p>
        </div>
	</body>
</html> 