<?php
    if( ! isset( $_GET[ "name" ] ) )
        exit();
    $name = $_GET[ "name" ];

    require_once __DIR__ . '/vard.php';
    require_once __DIR__ . '/fs.php';
    require_once __DIR__ . '/config.php';

    if( ! is_dir($PATH_TO_WIDGETS) )
        exit(json_encode( ["err" => "No widgets directory"] ));

    $PATH_TO_OLD_VRS_WIDGET = "$PATH_TO_WIDGETS/widgets/$name";
    $widget = array(
        "name" => $name,
        "code" => "",
        "secret_key" => "",
        "version" => ""
    );

    //get manifest.json
    @$cont = json_decode( file_get_contents( "$PATH_TO_OLD_VRS_WIDGET/manifest.json" ) );
    if( ! $cont )
        exit();

    $widget[ "code" ] = $cont->widget->code;
    $widget[ "secret_key" ] = $cont->widget->secret_key;
    function up_vers( $vers ){
        $cur = explode( ".", $vers );
        $last_index = count( $cur ) - 1 ;
        $cur[ $last_index ] = ++$cur[ $last_index ];
        return implode( ".", $cur );        
    }
    $widget["version"] = up_vers( $cont->widget->version );
    echo json_encode( ["data" => $widget] );