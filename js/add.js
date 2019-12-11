
//files for drag'n drop
var droppedFile;

//html elements
var $form;
var $name;
var $archive;
var $status; 
var $dropzone;
var $dropzone_bottom;
var $check_form;

$( document ).ready(()=>{
    //init jquery objects
    $form = $( "#archive_form" );
    $name = $( '.chill-form__input[name="name"]' );
    $archive = $( '.dropzone__file[name="archive"]' );
    $status = $( ".dropzone__status" ); 
    $remove_btn = $( ".dropzone__clear" );
    $dropzone = $( ".chill-form__dropzone" );
    $dropzone_bottom = $( ".dropzone__bottom" );

    $check_form = $( "#check_form" );
    $check_form_code = $( "input[name='code']" );
    $check_form_secret = $( "input[name='secret_key']" );
    $check_form_version = $( "input[name='version']" );
    $check_form__widgetinfo = $( "#check-form__new-widget-info" );
    $check_from__cancel = $( "#form__cancel-btn" );

    $dropzone_bottom.hide();
    $check_form.parent().hide();

    //send info to the server with formData
    $form.submit( function( event ){
        event.preventDefault();
        var formData = new FormData(this);
        if (droppedFile)   //if thre is a loaded file - replace it with the new one 
            formData.append( "archive", droppedFile );
        $.ajax({
            url: 'php/check_archive.php',
            type: "POST",
            data: formData,
            success: function ( dataJSON ) {
                if( ! dataJSON )
                    alert( "Error: smth wrong" );
               
                data = JSON.parse( dataJSON );    
                if( data["err"] )
                    alert( "Error: " + data[ "error_text" ] );
                else if( data[ "data" ] ){
                    //alert(  JSON.stringify(data[ "data" ]) );
                    //we gotta show the check form
                    $form.fadeOut();
                    $check_form_code.val( $name.val() );
                    $check_form_code.attr( "readonly", "readonly" );
                    $check_form_secret.val( data[ "data" ]["secret_key"] ); 
                    if( data[ "status" ] == "update" ){
                        $check_form__widgetinfo.hide();
                        $check_form_version.val( data[ "data" ]["version"] );
                    }
                    else{
                        $check_form__widgetinfo.show();
                        $check_form_version.val( "1.0.0" );
                    }
                    $check_form.parent().fadeIn();
                }                    
                else
                    alert( "Error" );
            },
            error: function(msg) {
                error_show( "Error", msg );
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    //Drag'n drop
    $archive.parent().on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
    })
    $archive.parent().on( "dragover dragenter", ()=>{
        $archive.parent().addClass( "dropzone__dragged" );
    });
    $archive.parent().on( "dragleave dragend drop", ()=>{
        $archive.parent().removeClass( "dropzone__dragged" );
    });
    $archive.parent().on( "drop", ( ev )=>{
        var file = ev.originalEvent.dataTransfer.files[0];
        if( file.type == "application/x-zip-compressed" ){
            droppedFile = file;
            $status.html( droppedFile.name );
            $dropzone_bottom.show();
            $dropzone.hide();
        }
        else
            error_show( "File must be a zip archive" );
    });

    $archive.on( "input", ( ev )=>{
        var fullname = $archive.val().replace( /\\/g, '/' );
        var basename = fullname.split('/').reverse()[0];
        $status.html( basename );
        $dropzone.hide();  
        $dropzone_bottom.show();    
    });

    $remove_btn.on( "click", ()=>{
        droppedFile = null;
        $archive.val( "" );
        $dropzone.show();
        $dropzone_bottom.hide();
    });

    $check_from__cancel.on( "click", ()=>{
        $check_form.parent().fadeOut();
        $form.fadeIn();
    });
}); 

function error_show( $text ){
    $( ".chill-modal__text" ).html( $text );
    $( ".chill-modal__error" ).show().click( ()=>{
            $( ".chill-modal__error" ).fadeOut();
        }
    );
}
    
    
    