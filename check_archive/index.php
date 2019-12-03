<?php
    $header = "hbkhkjh";
    $std_text = "Please, check the info of the widget. It would be loaded to repo and then would be merged";

    $is_new = isset( $_POST[ "is_new" ] ) ? $_POST[ "is_new" ] : false;
    $data = isset( $_POST[ "data" ] ) ?  $_POST[ "data" ] : false;
    
    //means that there is an error so we would redirect user to the form with error
    if( ! $data ){
        header("Location: localhost/");
    }
    $text = "";
?>
<html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="../js/index/jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="check_archive.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Russo+One&display=swap&subset=cyrillic,latin-ext" rel="stylesheet">
        
        <script src="check_archive.js" ></script>
        <title>Мерге</title>
	</head>
	<body>
        <form class = "chill-form" >
            <h3 class = "chill-form__header" ><?=$header?></h3>
            <div class = "chill-form__text" ><?=$text?></div> 
                
            <div class = "chill-info__line" >
                <div class = "info-line info-line-key" > name:</div>
                <div class = "info-line info-line-val" > amo_smth</div>
            </div>
            <div class = "chill-info__line" >
                <div class = "info-line info-line-key" > secret_key:</div>
                <div class = "info-line info-line-val" > welknewklfwnelkenknweklnwejbjh34gui2dguib</div>
            </div>
            <div class = "chill-info__line" >
                <div class = "info-line info-line-key" > version:</div>
                <div class = "info-line info-line-val" > 1.0.5</div>
            </div>
            <input type = "submit" class = "chill-form__button" value = "ok" />
            <a class = "chill-form__link" >
                <button class = "chill-form__button" >Cancel</button>  
            </a>  
        </form>     
	</body>
</html> 