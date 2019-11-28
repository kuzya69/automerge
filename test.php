<?php
    require_once __DIR__ . '/vard.php';

    file_put_contents( "llog.txt", $_POST );

    /*$PATH_TO_FOLDER = __DIR__;
    $PATH_TO_WIDGETS = "C:/Users/alarin/Desktop/widgets";
    $widget_name = "amo_1c"; 
    $PATH_TO_OLD_VRS_WIDGET = "$PATH_TO_WIDGETS/widgets/$widget_name";
    $PATH_TO_NEW_VRS_WIDGET = $PATH_TO_FOLDER."/".$widget_name;
    

    $widget = array(
        "name" => $widget_name,
        "code" => "",
        "secret_key" => "",
        "version" => ""
    );

    //get updates from git
    shell_exec( __DIR__."/git_pull.sh" );

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

    $cont->widget->code = $widget[ "code" ];
    $cont->widget->secret_key = $widget[ "secret_key" ];
    $cont->widget->version = $widget[ "version" ];
    $manifest_inner = json_encode( $cont, JSON_PRETTY_PRINT  );
    file_put_contents( $PATH_TO_NEW_VRS_WIDGET."/manifest.json", $manifest_inner );

    //remove folder
    function rmRec($path) {
        if (is_file($path)) 
            return unlink($path);
        if (is_dir($path)) {
            foreach(scandir($path) as $p) if (($p!='.') && ($p!='..'))
                rmRec($path.DIRECTORY_SEPARATOR.$p);
            return rmdir($path); 
        }
        return false;
    }
    //copy files
    function my_copy_all($from, $to) {
        if (is_dir($from)) {
            @mkdir($to);
            $d = dir($from);
            while (false !== ($entry = $d->read())) {
                if ($entry == "." || $entry == "..") 
                    continue;
                my_copy_all("$from/$entry", "$to/$entry");
            }
            $d->close();
        }
        else 
            copy($from, $to);
    }

    //manifest is right. Now it's time to load all data form new forlder to "widgets" folder
    rmRec( $PATH_TO_OLD_VRS_WIDGET );
    my_copy_all( $PATH_TO_NEW_VRS_WIDGET, $PATH_TO_OLD_VRS_WIDGET  );

    shell_exec( __DIR__."/git_pull.sh" );*/



    
    