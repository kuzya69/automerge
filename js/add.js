//files for drag'n drop
var droppedFile;

$( document ).ready(()=>{
    //init jquery objects
    var $form = $( ".chill-form" );
    var $name = $( '.chill-form__input[name="hash"]' );
    var $archive = $( '.dropzone__file[name="archive"]' );
    var $status = $( ".dragzone__status" ); 

    //send info to the server with formData
    $form.submit( function( event ){
        event.preventDefault();
        var formData = new FormData(this);
        if (droppedFile)   //if thre is a loaded file - replace it with the new one 
            ajaxData.append( "archive", droppedFile );
        $.ajax({
            url: 'php/check_archive.php',
            type: "POST",
            data: formData,
            success: function ( dataJSON ) {
                if( ! dataJSON )
                    console.log( "Error: smth wrong" );
               
                data = JSON.parse( dataJSON );    
                if( data["err"] )
                    console.log( "Error: " + data[ "error_text" ] );
                else if( data[ "data" ] )
                    console.dir(  data[ "data" ] );
                else
                    console.log( "Error" );
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
        }
        else
            error_show( "File must be a zip archive" );
    });

    $archive.on( "input", ( ev )=>{
        var fullname = $archive.val().replace( /\\/g, '/' );
        var basename = fullname.split('/').reverse()[0];
        $status.html( basename );        
    });
}); 

function error_show( $text ){
    $( ".chill-modal__text" ).html( $text );
    $( ".chill-modal__error" ).show().click( ()=>{
            $( ".chill-modal__error" ).fadeOut();
        }
    );
}

    
    
    