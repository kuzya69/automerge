<?php
    set_time_limit( 0 );
    $code = isset( $_POST[ "code" ] ) ? $_POST[ "code" ] : false;
    shell_exec( __DIR__."/sh/git_reset.sh $code" );
?>
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
        <form class = "chill-form" >
            <h3 class = "chill-form__header" >Oh shit! here we go again!</h3>
            <p class = "chill-form__text" >So, you gotta be happy, cause we've returned to what we'd started. Maybe you would do the merge by yourself...</p>
            <a href = "add.php" >
                <input type = "button" class = "chill-form__button" value = "Return" />
            </a> 
        </form>       
	</body>
</html> 