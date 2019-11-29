
<html>
	<head>
		<meta  http-equiv = "Content-Type" name = "chill" content="text/html charset = UTF-8" />
        <script src="jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="test.css">
		<title>Мерге</title>
	</head>
	<body>
        <form class = "chill-form" name = "postform" method = "POST" enctype="multipart/form-data" >
            <h3 class = "chill-form__header" >
            <input type = "text" name = "name"  id = "widget_name" class = "chill-form__input" placeholder = "Название виджета" />
            <input type = "file" name = "arch" id = "arch" class = "chill-form__file" placeholder = "Архивчик" />    
            <input type = "submit" id = "btn" class = "chill-form__button" value = "Проверить" />
        </form>	
		
	</body>
</html> 

<script>
    $( document ).ready(()=>{
        $( "form[name='postform']" ).submit( function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            if( ! $("#arch")[0].files ){
                alert( "No archives" );
                return;
            }

            console.dir( JSON.stringify( formData ) );

            $.ajax({
                url: 'test.php',
                type: "POST",
                data: formData,
                async: false,
                success: function (msg) {
                    alert(msg);
                },
                error: function(msg) {
                    alert('Ошибка!');
                },
                cache: false,
                contentType: false,
                processData: false
            });

            
        });
    }); 
</script>
    
    
    