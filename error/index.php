<?php
    $text = isset( $_GET[ "error_text" ] ) ? $_GET[ "error_text" ] : "";
?>
<html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="../js/index/jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="error.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Russo+One&display=swap&subset=cyrillic,latin-ext" rel="stylesheet">
        
        <script src="error.js" ></script>
        <title>Мерге</title>
	</head>
	<body>
        <div class = "chill-form" >
            <h3 class = "chill-form__header" >Error:</h3>
            <div class = "chill-form__text" ><?=$text?></div>
            <a class = "chill-form__link" >
                <button class = "chill-form__button" >No, please</button>  
            </a>
        </div>
	</body>
</html> 