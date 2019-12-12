<?php
    require __DIR__ . "/fs.php";
    require_once __DIR__ . '/vard.php';
    require_once dirname(__DIR__) . '../config.php';
    require_once __DIR__ . '/error_codes.php';

    //ERROR codes:
    // 0 - no error
    // 1 - can't open manifest.json
    // 2 - can't load file to the server

    //gets info from manifest.json files
    //returns struct with data and error code
    function get_info_from_manifest( $path ){
        @$cont = json_decode( file_get_contents( $path ) );
        if( ! $cont ) //if there is no manifest json file - so it means that there's no widget
            return [ 
                "data" => "", 
                "err" => 1,
                "error_text" => $ERROR_TXT[1]
            ];
        $data = [
            "code" => $cont->widget->code,
            "secret_key" => $cont->widget->secret_key,
            "version" => $cont->widget->version
        ];
        return [ "data" => $data, "err" => false ];
    }

    //gets string with version and increase it
    function up_vers( $vers ){  
        if( ! $vers ) 
            return "";
        $cur = explode( ".", $vers );
        $last_index = count( $cur ) - 1 ;
        $cur[ $last_index ] = ++$cur[ $last_index ];
        return implode( ".", $cur );        
    }

    //checks widgets directory if archive has been loaded yet
    //if folder is exists in the widgets directory - returns data
    //else returns false
    function get_data_from_loaded( $name ){
        global $PATH_TO_WIDGETS;
        @$data = get_info_from_manifest( "$PATH_TO_WIDGETS/widgets/$name/manifest.json" );
        if( ! $data || $data[ "err" ] )
            return false;   //No widget with such name in the widgets directory

        $data = get_info_from_manifest( "$PATH_TO_WIDGETS/widgets/$name/manifest.json" );
        if( $data["data"] )
            $data["data"]["version"] = up_vers( $data["data"]["version"] );

        return $data[ "err" ] ? false : $data;   
    }


    //loads archive to the server, unpack and reads info from there
    //also increase version of the widget
    function load_archive( $name ){
        global $TEMP_DIR;
        global $PATH_TO_FOLDER;

        $uploaddir = $_SERVER['DOCUMENT_ROOT']."/automerge/$TEMP_DIR";    //project dir
        $uploadfile = $uploaddir . "/widget.zip";   //filename

        if (! move_uploaded_file($_FILES['archive']['tmp_name'], $uploadfile))
            return [ 
                "data" => "", 
                "err" => 2,
                "error_text" => $ERROR_TXT[ 2 ]
            ];
        //unpack
        $zip = new ZipArchive;
        $zip->open( "$PATH_TO_FOLDER/$TEMP_DIR/widget.zip" );
        $zip->extractTo( "$PATH_TO_FOLDER/$TEMP_DIR/widget" );
        $zip->close();
        
        $data = get_info_from_manifest( "$PATH_TO_FOLDER/$TEMP_DIR/widget/manifest.json" );
        $data["data"]["version"] = up_vers( $data["data"]["version"] );

        return $data;
    }

    //remove the temp folder 
    function clear_temp(){
        global $PATH_TO_FOLDER;
        global $TEMP_DIR;
        return dir_remove( "$PATH_TO_FOLDER/$TEMP_DIR" );
    }
    //remove the temp folder 
    function create_temp(){
        global $PATH_TO_FOLDER;
        global $TEMP_DIR;
        return mkdir( "$PATH_TO_FOLDER/$TEMP_DIR" );
    }

    //check if the widgets directory is exests
    function check_widgets_directory(){
        global $PATH_TO_WIDGETS;
        return is_dir( $PATH_TO_WIDGETS );
    }

    