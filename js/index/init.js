
$( document ).ready(()=>{
    //init jquery objects
    var $hash = $( '.chill-form__input[name="hash"]' );
    var $version = $( '.chill-form__input[name="version"]' );
    var $name = $('.chill-form__input[name="name"]');
    var $form = $( "form[name='postform']" );
    var $label = $("#form-label");
    var $spoiler = $('.addition_info'); 

    var name_regexp = /[A-Za-z0-9_-]{2,}/;

    //set listeners
    $name.on('blur', () =>{         
        if( ! name_regexp.test( $name.val() ) ){
            $label.fadeOut();
            return;
        }
        $.ajax({
            url: 'get_widget_info.php',
            type: "GET",
            data: {name: $name.val()},
            dataType: "json",
            success: function (data) {
                if( data[ "err" ] ){
                    $hash.val( "" );
                    $version.val( "" );
                    $label.fadeIn();
                    console.log( data[ "err" ] );
                    return;
                }
                $hash.val( data.secret_key );
                $version.val( data.version );
                $label.fadeOut();
            },
            error: function ( e ) {
                console.dir( e );
                alert( "Request error!" );
                $hash.val( "" );
                $version.val( "" );
                $label.fadeIn();
            }
        }); 
        $spoiler.fadeIn();   
    });

    //hide form, if the name-input is on focus
    $name.on('focus', ()=>{
        $spoiler.fadeOut();  
        $label.fadeOut();  
    });

    //send info to the server with formData
    $form.submit(()=>{
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

    //set error titles
    $name.on('input invalid', function(){
        this.setCustomValidity('');
        if (this.validity.valueMissing) 
            this.setCustomValidity("Input this stuff, plz!!!");
        if (this.validity.typeMismatch);
            this.setCustomValidity("Nipralna bled!");
        if (this.validity.patternMismatch);
            this.setCustomValidity("Name must be started with '_amo' and consist at least 2 chars or more"); 
    });
    $hash.on('input invalid', function(){
        this.setCustomValidity("Wrong hash!")
    });
    $version.on('input invalid', function(){
        this.setCustomValidity("Wrong version!")    
    });

    //hide as default
    $label.hide();
    $spoiler.hide();
}); 

    
    
    