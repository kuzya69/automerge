function show_error( header, text ){
    $title = $( ".chill-notice__header" );
    $text = $( ".chill-notice__text" );
    $title.html( header );
    $text.html( text );
    $text.parent().fadeIn();
}