<?php
    set_time_limit( 0 );
    
    require_once __DIR__ . '/vard.php';
    require_once __DIR__ . '/fs.php';
    require_once dirname(__DIR__) . '/config.php';

    $code = isset( $_GET[ "code" ] ) ? $_GET[ "code" ] : false;
    $secret_key = isset( $_GET[ "secret_key" ] ) ? $_GET[ "secret_key" ] : false;
    $version = isset( $_GET[ "version" ] ) ? $_GET[ "version" ] : false;

    $LOADED_WIDGET = dirname( __DIR__ )."/$TEMP_DIR/widget/";
    $OLD_WIDGET = "$PATH_TO_WIDGETS/widgets/$code";

    if( !( $code && $secret_key && $version ) )
        exit( "No data" );

    //get updates from git
    shell_exec( dirname(__DIR__)."/sh/git_pull.sh $PATH_TO_WIDGETS" );

    //refresh manifest.json in the new folder
    $cont = json_decode( file_get_contents( "$LOADED_WIDGET/manifest.json" ) );
    if( ! $cont )
        exit( "New widget folder not found!" );

    //set vals and record all to new manifest.json
    $cont->widget->code = $code;
    $cont->widget->secret_key = $secret_key;
    $cont->widget->version = $version;
    $manifest_inner = json_encode( $cont, JSON_PRETTY_PRINT );

    file_put_contents( "$LOADED_WIDGET/manifest.json", $manifest_inner );

    //manifest is right. Now it's time to load all data form new forlder to "widgets" folder
    dir_copy( $LOADED_WIDGET ,$OLD_WIDGET );
    dir_remove( $LOADED_WIDGET );

    //new branch, commit and push
    shell_exec( dirname(__DIR__)."/sh/git_push.sh $PATH_TO_WIDGETS $code $version alarin@team.amocrm.ru olbert" );

    header("Location: ready.php?code=$code&version=$version");



    
    