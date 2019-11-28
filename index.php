
<html>
	<head>
		<meta  http-equiv = "Content-Type" name = "chill" content="text/html charset = UTF-8" />
        <script src="jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="test.css">
		<title>Мерге</title>
	</head>
	<body>
        <form class = "chill-form" >
            <h3 class = "chill-form__header" >
            <input type = "text" name = "classes"  id = "#widget_name" class = "chill-form__input" placeholder = "Название виджета" />
            <input type = "file" name = "arch" id = "#arch" class = "chill-form__file" placeholder = "Архивчик" />    
            <input type = "submit" id = "#btn" class = "chill-form__button" value = "Проверить" />
        </form>	
		
	</body>
</html> 

<script>
    $(document).on('click', '#btn', function(){
        console.log(1231);
        var formData = new FormData();
        formData.append( "arch", document.getElementById("#arch").files[0] ); 
        formData.append( "name", document.getElementById("#widget_name").value );   

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "test.php");
        xhr.send(formData);
    });
</script>
    
    
    