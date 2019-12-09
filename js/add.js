
//files for drag'n drop
var droppedFile;

//html elements
var $form;
var $name;
var $archive;
var $status; 
var $dropzone;
var $dropzone_bottom;

$( document ).ready(()=>{
    //init jquery objects
    $form = $( ".chill-form" );
    $name = $( '.chill-form__input[name="hash"]' );
    $archive = $( '.dropzone__file[name="archive"]' );
    $status = $( ".dropzone__status" ); 
    $remove_btn = $( ".dropzone__clear" );
    $dropzone = $( ".chill-form__dropzone" );
    $dropzone_bottom = $( ".dropzone__bottom" );

    $dropzone_bottom.hide();  

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
                    alert(  JSON.stringify(data[ "data" ]) );
                    document.location.href = "process.php?code=" + data[ "data" ][ "code" ] + 
                                            "&secret_key=" + data[ "data" ]["secret_key"] +
                                            "&version=" + data[ "data" ]["version"];   //???? don't know about this, but I don't care about sequrity
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
}); 

function error_show( $text ){
    $( ".chill-modal__text" ).html( $text );
    $( ".chill-modal__error" ).show().click( ()=>{
            $( ".chill-modal__error" ).fadeOut();
        }
    );
}

    
    
    