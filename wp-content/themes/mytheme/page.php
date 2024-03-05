<?php get_header(); ?>
<!-- CONTENT -->
<main class="content">

    <?php do_shortcode("shortcode_home_top_1"); ?>







    <?= the_content() ?>
    <?php
    // get_template_part('templates/main_content_template/hero_section');
    // do_action("mytheme_page_content_loaded");
    
    ?>

    <div class="column-newsletter">

        <div class="subscribe">
            <form class="subscribe-form1">
                <input type="email" placeholder="Enter your e-mail Address">
                <button type="submit" class="email">
                <img src="<?php echo get_template_directory_uri(); ?>/resources/images/homeemail.png" alt="">
                </button>

            </form>
        </div>



</main>
<?php get_footer(); ?>

<?php
// submit form input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get email
    $email = $_POST['email'];
    // do something(check email, verify, save...)
    echo ('Your inputed email is : ' . $email);
}

$recent_posts = wp_get_recent_posts(
    array(
        'numberposts' => 2, // get newest 2 posts
        'post_status' => 'publish' // should be published post
    )
);
if (count($recent_posts) > 0) {
    echo '<ul class="footer-blog-posts">';
    foreach ($recent_posts as $post) {
        echo '<li><a href="' . get_permalink($post["ID"]) . '">' . esc_attr($post["post_title"]) . '</a></li>';
    }
    echo '</ul>';
}

?>