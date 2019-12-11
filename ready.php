<html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="js/jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/add.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Russo+One&display=swap&subset=cyrillic,latin-ext" rel="stylesheet">
        <title>Мерге</title>
	</head>
	<body>
        <form class = "chill-form" action = "rollback.php" method = "POST" >
            <input type = 'hidden' name = "code" value = '<?=$_GET['code']?>' />
            <input type = 'hidden' name = "version" value = '<?=$_GET['version']?>' />
            <h3 class = "chill-form__header" >Merge is ready!</h3>
            <p class = "chill-form__text" >Check it on gitlab/hub whatever you use... Also, if you think, that this perfect merge is piece of shit - you can rollback.</p>
            
            <div class = "form__btnset" >
                <a href = "add.php"  class = "chill-form__button inline-btn" >ok</a>  
                <input type = "submit" class = "chill-form__button inline-btn btn-cancel" value = "Rollback" /> 
            </div>
        </form>       
	</body>
</html> 