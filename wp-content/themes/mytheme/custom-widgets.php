<?php
//========================
// Regiter widgets
//========================
if (!function_exists('my_custom_widgets_init')) {
    function my_custom_widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Custom Sidebar', 'my-moody-studio-theme'),
            'id' => 'sidebar001',
            'description' => esc_html__('Add widgets here to appear in your sidebar.', 'my-moody-studio-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
    }
    add_action('widgets_init', 'my_custom_widgets_init');
}