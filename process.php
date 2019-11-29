<?php
    require_once __DIR__ . '/vard.php';
    require_once __DIR__ . '/fs.php';
    require_once __DIR__ . '/config.php';

    file_put_contents( "log.txt", $_POST[ "name"]  );

   // die( "stopped" );

    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/automerge';    //project dir
    $uploadfile = '/'.$uploaddir . $_POST['name'].".zip";   //filename

    if (! move_uploaded_file($_FILES['arch']['tmp_name'], $uploadfile)) 
        exit( "File can't be loaded. Plz, don't kill me!" );

    $widget_name = $_POST['name']; 
    $PATH_TO_OLD_VRS_WIDGET = "$PATH_TO_WIDGETS/widgets/$widget_name";
    $PATH_TO_NEW_VRS_WIDGET = $PATH_TO_FOLDER."/".$widget_name;

    $widget = array(
        "name" => $widget_name,
        "code" => "",
        "secret_key" => "",
        "version" => ""
    );

    die( "stopped" );

    //get updates from git
    //shell_exec( __DIR__."/git_pull.sh" );

    //get old manifest.json
    $cont = json_decode( file_get_contents( "$PATH_TO_OLD_VRS_WIDGET/manifest.json" ) );
    if( ! $cont )
        exit( "Widget is being loading for the first time. Please, create a folder in the 'widgets' with manifest.json file. It's needed for some fields: code, secret_key and verion" );

    $widget[ "code" ] = $cont->widget->code;
    $widget[ "secret_key" ] = $cont->widget->secret_key;

    function up_vers( $vers ){
        $cur = explode( ".", $vers );
        $last_index = count( $cur ) - 1 ;
        $cur[ $last_index ] = ++$cur[ $last_index ];
        return implode( ".", $cur );        
    }
    $widget["version"] = up_vers( $cont->widget->version );

    //refresh manifest.json in the new folder
    $cont = json_decode( file_get_contents( $PATH_TO_NEW_VRS_WIDGET."/manifest.json" ) );
    if( ! $cont )
        exit( "New widget folder not found!" );

    //set vals and record all to new manifest.json
    $cont->widget->code = $widget[ "code" ];
    $cont->widget->secret_key = $widget[ "secret_key" ];
    $cont->widget->version = $widget[ "version" ];
    $manifest_inner = json_encode( $cont, JSON_PRETTY_PRINT  );
    file_put_contents( $PATH_TO_NEW_VRS_WIDGET."/manifest.json", $manifest_inner );

    //manifest is right. Now it's time to load all data form new forlder to "widgets" folder
    dir_remove( $PATH_TO_OLD_VRS_WIDGET );
    dir_copy( $PATH_TO_NEW_VRS_WIDGET, $PATH_TO_OLD_VRS_WIDGET  );
    dir_remove( $PATH_TO_NEW_VRS_WIDGET );

    //new branch, commit and push
    shell_exec( __DIR__."/git_push.sh" );



    
    