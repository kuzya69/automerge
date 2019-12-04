<?php
/*-------------------------*/
    require_once __DIR__ . '/php/vard.php';
    require __DIR__ . "/check_archive.php";

    //ERROR codes:
    // 0 - no error
    // 1 - can't open manifest json
    // 2 - can't load file to the server

    //clear old income folder
    clear_temp();
    create_temp();

    $name = $_POST[ "name" ];
    $err = "";
    $status = "";

    $data = get_data_from_loaded( $name );     //data from old widget   
    $load_archive_data =  load_archive( $name );
    if( $load_archive_data[ "err" ] )
        echo json_encode( $load_archive_data );

    if( !$data || $data[ "err" ] ){     //first time when widget is been loaded to the server or not
        $data = $load_archive_data;      //take info form loaded archive
        $status = "add";
    }
    else
        $status = "update";    
    
    //return info
    echo json_encode([
        "err" => $data[ "err" ],
        "data" => $data[ "data" ],
        "status" => $status,
    ]);
?>