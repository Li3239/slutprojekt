<?php


if (!is_admin()) {
    return;
}

//add menu into dashboard settings
function mytheme_add_settings()
{
    add_submenu_page(
        "options-general.php",
        "Butik001",
        "My Theme Setting",
        "edit_pages",
        "my_butik_id",
        "mytheme_add_setting_callback"
    );
}
add_action('admin_menu', 'mytheme_add_settings');

function mytheme_add_setting_callback()
{
?>
    <div class="wrap">
        <h2 style="margin-bottom: 30px;">My Theme Settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields("butik");
            do_settings_sections("butik");
            submit_button();
            ?>
        </form>
    </div>
<?php
}

//registrerar inställningar tillgängliga på sidan "Butik"
function mytheme_add_settings_init()
{
    //===========================
    // add block  butik_general
    //===========================
    add_settings_section(
        'butik_general',
        'Store General Setting',
        'mytheme_add_settings_section_general',
        'butik'
    );

    //===========================
    //add content into butik_general
    //===========================
    register_setting(
        "butik",
        "store_message"
    );

    add_settings_field(
        "store_message",
        "Store Message",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_message",
            "option_type" => "text"
        )
    );

    //------------------
    // name
    //------------------
    register_setting(
        "butik",
        "store_name"
    );

    add_settings_field(
        "store_name",
        "Store Name",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_name",
            "option_type" => "text"
        )
    );

    //------------------
    // footer infomation
    //------------------
    register_setting(
        "butik",
        "store_footer_info"
    );

    add_settings_field(
        "store_footer_info",
        "Store Footer Infomation",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_footer_info",
            "option_type" => "textarea"
        )
    );
    //------------------
    // address
    //------------------
    register_setting(
        "butik",
        "store_address"
    );

    add_settings_field(
        "store_address",
        "Store Address",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_address",
            "option_type" => "text"
        )
    );
    //------------------
    // tel
    //------------------
    register_setting(
        "butik",
        "store_tel"
    );

    add_settings_field(
        "store_tel",
        "Store phone Number",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_tel",
            "option_type" => "text"
        )
    );
    //------------------
    // email
    //------------------
    register_setting(
        "butik",
        "store_email"
    );

    add_settings_field(
        "store_email",
        "Store Email",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_email",
            "option_type" => "text"
        )
    );

    //------------------
    // copyright
    //------------------
    register_setting(
        "butik",
        "store_copyright"
    );

    add_settings_field(
        "store_copyright",
        "Store Copyright",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_copyright",
            "option_type" => "text"
        )
    );

    //------------------
    // open hours
    //------------------
    register_setting(
        "butik",
        "store_open"
    );

    add_settings_field(
        "store_open",              //id
        "Open Time",               //title(will be shown on setting-butik page)
        "mytheme_section_setting", //callback function
        "butik",                   //page
        "butik_general",           //section
        array(                     //multiple parameter
            "option_name" => "store_open",
            "option_type" => "time"
        )
    );

    //----------------------------
    // store information title 1
    //----------------------------
    register_setting(
        "butik",
        "store_info_title_1"
    );

    add_settings_field(
        "store_info_title_1",       //id
        "Store information title 1", //title(will be shown on setting-butik page)
        "mytheme_section_setting",  //callback function
        "butik",                    //page
        "butik_general",            //section
        array(                      //multiple parameter
            "option_name" => "store_info_title_1",
            "option_type" => "text"
        )
    );

    //----------------------------
    // store information content 1
    //----------------------------
    register_setting(
        "butik",
        "store_info_content_1"
    );

    add_settings_field(
        "store_info_content_1",       //id
        "Store information content 1", //title(will be shown on setting-butik page)
        "mytheme_section_setting",    //callback function
        "butik",                      //page
        "butik_general",              //section
        array(                        //multiple parameter
            "option_name" => "store_info_content_1",
            "option_type" => "textarea"
        )
    );
    //----------------------------
    // store information title 2
    //----------------------------
    register_setting(
        "butik",
        "store_info_title_2"
    );

    add_settings_field(
        "store_info_title_2",       //id
        "Store information title 2", //title(will be shown on setting-butik page)
        "mytheme_section_setting",  //callback function
        "butik",                    //page
        "butik_general",            //section
        array(                      //multiple parameter
            "option_name" => "store_info_title_2",
            "option_type" => "text"
        )
    );

    //----------------------------
    // store information content 2
    //----------------------------
    register_setting(
        "butik",
        "store_info_content_2"
    );

    add_settings_field(
        "store_info_content_2",       //id
        "Store information content 2", //title(will be shown on setting-butik page)
        "mytheme_section_setting",    //callback function
        "butik",                      //page
        "butik_general",              //section
        array(                        //multiple parameter
            "option_name" => "store_info_content_2",
            "option_type" => "textarea"
        )
    );
    //----------------------------
    // store information title 3
    //----------------------------
    register_setting(
        "butik",
        "store_info_title_3"
    );

    add_settings_field(
        "store_info_title_3",       //id
        "Store information title 3", //title(will be shown on setting-butik page)
        "mytheme_section_setting",  //callback function
        "butik",                    //page
        "butik_general",            //section
        array(                      //multiple parameter
            "option_name" => "store_info_title_3",
            "option_type" => "text"
        )
    );

    //----------------------------
    // store information content 3
    //----------------------------
    register_setting(
        "butik",
        "store_info_content_3"
    );

    add_settings_field(
        "store_info_content_3",       //id
        "Store information content 3", //title(will be shown on setting-butik page)
        "mytheme_section_setting",    //callback function
        "butik",                      //page
        "butik_general",              //section
        array(                        //multiple parameter
            "option_name" => "store_info_content_3",
            "option_type" => "textarea"
        )
    );

    //------------------
    // show message checkbox
    //------------------
    register_setting(
        "butik",
        "store_show_message"
    );

    add_settings_field(
        "show_message",           //id
        "Show Message",           //title(will be shown on setting-butik page)
        "mytheme_section_setting", //callback function
        "butik",                   //page
        "butik_general",           //section
        array(                     //multiple parameter
            "option_name" => "store_show_message",
            "option_type" => "checkbox"
        )
    );
}
add_action('admin_init', 'mytheme_add_settings_init');


function mytheme_add_settings_section_general()
{
    echo "<hr>";
    echo "<p> General settings for the store.</p>";
    echo "<hr>";
}

// draw the Settings page
function mytheme_section_setting($args)
{
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);

    //render in HTML
    if ($option_type === 'textarea') {
        // render a textarea element
        echo '<textarea id="' . esc_attr($option_name) . '" 
        name="' . esc_attr($option_name) . '"
        rows="5" 
        cols="50">' . esc_textarea($option_value) . '</textarea>';
    } else {
        // render a input element
        echo '<input type="' . esc_attr($option_type) . '" 
                     id="' . esc_attr($option_name) . '" 
                     name="' . esc_attr($option_name) . '" 
                     value="' . esc_attr($option_value) . '"
              />';
    }
}



// function mytheme_add_top_block_settings_init()
// {
//     add_settings_section(
//         'top_block', 
//         'Top Block Setting', 
//         'mytheme_add_project_top_settings_section_general',
//         'butik'                       
//     );

//     register_setting(
//         "butik",  
//         "top_block_title_1"
//     );

//     add_settings_field(
//         "top_block_title_1",
//         "Title_1",          
//         "mytheme_section_setting",
//         "butik",                  
//         "top_block",              
//         array(                    
//             "option_name" => "top_block_title_1",
//             "option_type" => "text"
//         )
//     );

//     register_setting(
//         "butik", 
//         "top_block_title_2"
//     );

//     add_settings_field(
//         "top_block_title_2",
//         "Title_2",          
//         "mytheme_section_setting",
//         "butik",                  
//         "top_block",              
//         array(                    
//             "option_name" => "top_block_title_2",
//             "option_type" => "text"
//         )
//     );

//     register_setting(
//         "butik",    
//         "top_block_image" 
//     );

//     add_settings_field(
//         "top_block_image",
//         "Image Url",      
//         "mytheme_section_setting", 
//         "butik",                   
//         "top_block",              
//         array(                    
//             "option_name" => "top_block_image",
//             "option_type" => "text"
//         )
//     );

// }
// add_action('admin_init', 'mytheme_add_top_block_settings_init');

// function mytheme_add_project_top_settings_section_general()
// {
//     echo "<hr>";
//     echo "<hr>";
//     echo "<p> Top Block shortcode setting</p>";
//     echo "<hr>";
// }
