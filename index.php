
<html>
	<head>
		<meta  http-equiv = "Content-Type" name = "chill" content="text/html charset = UTF-8" />
        <script src="jquery.js" ></script>
        <link rel="stylesheet" type="text/css" href="test.css">
		<title>Мерге</title>
	</head>
	<body>
        <form class = "chill-form" name = "postform" method = "POST" enctype="multipart/form-data" >
            <div class = "chill-form__label" id="form-label" >New</div>
            <h3 class = "chill-form__header" >
            <input 
                type = "text" 
                name = "name" 
                class = "chill-form__input" 
                placeholder = "Название виджета" 
                required pattern="[A-Za-z0-9_-]{2,}" 
                title="Input name of the widget" 
            />
            <input type = "file" name = "arch" class = "chill-form__file" placeholder = "Архивчик" accept="application/zip" required />    
            <input type = "submit" class = "chill-form__button" value = "Проверить" />
            <div class = "addition_info" id = "spoiler" >
                <input type = "hash" name = "hash" class = "chill-form__input" placeholder = "Input the code" pattern = "[a-zA-Z0-9]{64}" />
                <input type = "version" name = "version" class = "chill-form__input" placeholder = "Input the version" pattern = "(\d+\.)+\d" />
            </div>
        </form>	
	</body>
</html> 

<script>
    $( document ).ready(()=>{
        var $hash = $( '.chill-form__input[name="hash"]' );
        var $version = $( '.chill-form__input[name="version"]' );
        var $name = $('.chill-form__input[name="name"]');

        $name.on('blur', function() {           
            if( ! /[A-Za-z0-9_-]{2,}/.test( $name.val() ) ){
                $("#form-label").fadeOut();
                return;
            }
            //get info
            $.ajax({
                url: 'get_widget_info.php',
                type: "GET",
                data: {name: $name.val()},
                dataType: "json",
                success: function (data) {
                    if( !data ){
                        $hash.val( "" );
                        $version.val( "" );
                        $("#form-label").fadeIn();
                        return;
                    }
                    $hash.val( data.secret_key );
                    $version.val( data.version );
                    $("#form-label").fadeOut();
                },
                error: function () {
                    $hash.val( "" );
                    $version.val( "" );
                    $("#form-label").fadeIn();
                }
            }); 

            //show/hide spoiler
            if( /[A-Za-z0-9_-]{2,}/.test( $name.val() ) )
                $( "#spoiler" ).fadeIn();
            else
                $( "#spoiler" ).fadeOut();    
        })
        $name.on('focus', function() {
            $( "#spoiler" ).fadeOut();  
            $("#form-label").fadeOut();  
        })

        //send formData on button click
        $( "form[name='postform']" ).submit( function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: 'process.php',
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

        $name.on('input invalid', function() {
            this.setCustomValidity('')
            if (this.validity.valueMissing) 
                this.setCustomValidity("Input this stuff, plz!!!")
            if (this.validity.typeMismatch) 
                this.setCustomValidity("Nipralna bled!")
            if (this.validity.patternMismatch) 
                this.setCustomValidity("Name must be started with '_amo' and consist at least 2 chars or more")    
        })
        $('.chill-form__input[name="hash"]').on('input invalid', function() {
            this.setCustomValidity("Wrong hash!")    
        })
        $('.chill-form__input[name="version"]').on('input invalid', function() {
            this.setCustomValidity("Wrong version!")    
        })
        $("#form-label").hide();
        $('.addition_info').hide();
    }); 

    
</script>
    
    
    