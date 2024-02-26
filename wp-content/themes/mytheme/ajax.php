<?php

function init_ajax()
{
    add_action("wp_ajax_mytheme_getbyajax", "mytheme_getbyajax");
    add_action("wp_ajax_nopriv_mytheme_getbyajax", "mytheme_getbyajax");

    add_action("wp_enqueue_scripts", "mytheme_enqueue_scripts");
}
//add_action("init", "init_ajax");


function mytheme_enqueue_scripts()
{
    wp_enqueue_script("mytheme_jquery", get_template_directory_uri() . "/resources/js/jquery.js", array(), false, array());
    wp_enqueue_script("mytheme_ajax", get_template_directory_uri() . "/resources/js/ajax.js", array("mytheme_jquery"), false, array());

    $minarray = array();
    wp_localize_script("mytheme_ajax", "ajax_variables", array(
        "ajaxUrl" => admin_url("admin-ajax.php"),
        "nonce" => wp_create_nonce("mytheme_ajax_nonce"),
        "kalleanka" => 123
    ));
}

function mytheme_getbyajax()
{
    //get value from js : searchwords in ajax.php
    if(isset($_POST["search"]) == false) {
        wp_send_json_error();
        return;
    }
    
    $searchwords = $_POST["search"];
    $result = array();

    if($searchwords == "kalle anka") {
        // ajax.php -> success -> result
        $result["stad"] = "Ankeborg";
        $result["product"] = "<div></div>";
    }

    // $result = array();
    // $result["minvariable"] = 99;
    $json = json_encode($result);
    wp_send_json($json);
}
