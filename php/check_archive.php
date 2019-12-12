<?php
    require_once __DIR__ . '/vard.php';
    require_once __DIR__ . "/archive_kit.php";
    require_once __DIR__ . "/error_codes.php";
    require_once dirname(__DIR__) . "/config.php";

    //ERROR codes:
    // 0 - no error
    // 1 - can't open manifest json
    // 2 - can't load file to the server
    // 3 - no widgets dir

    //check if widgets dir is exists
    if( ! check_widgets_directory() )
        exit( json_encode([
                "err" => 3,
                "error_text" => $ERROR_TXT[3],
                "data" => "",
                "status" => "",
            ])
        );

    //clear old income folder
    clear_temp();
    create_temp();

    $name = $_POST[ "name" ];

    $data = get_data_from_loaded( $name );     //data from old widget   
    $load_archive_data =  load_archive( $name );
    if( $load_archive_data[ "err" ] )
        exit( json_encode( $load_archive_data ) );

    if( !$data || $data[ "err" ] ){     //first time when widget is been loaded to the server or not
        $data = $load_archive_data;      //take info form loaded archive
        $data[ "status" ] = "add";
    }
    else
        $data[ "status" ] = "update"; 
        
    //get updates from git
    shell_exec( dirname(__DIR__)."/sh/git_pull.sh $PATH_TO_WIDGETS" );
    
    //return info
    exit( json_encode( $data ) );
?>