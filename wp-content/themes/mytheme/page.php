<?php get_header(); ?>
<!-- CONTENT -->
<main class="content">

    <?php do_shortcode("shortcode_home_top_1"); ?>

    <!-- <div class="home-section1">


        <div class="home-top">
            <img src="<?= get_template_directory_uri() . "/resources/images/delievery.svg"; ?>"
                class="header-icon" />
            <h2>FREE SHIPPING</h2>
        </div>

        <div class="home-top">
            <img src="<?= get_template_directory_uri() . "/resources/images/moneyback.svg"; ?>"
                class="header-icon" />
            <h2>100% MONEY BACK</h2>
        </div>

        <div class="home-top">
            <img src="<?= get_template_directory_uri() . "/resources/images/support.svg"; ?>"
                class="header-icon" />
            <h2>SUPPORT 24/7</h2>
        </div>
    </div> -->





    <?= the_content() ?>
    <?php
    // get_template_part('templates/main_content_template/hero_section');
    // do_action("mytheme_page_content_loaded");
    
    ?>

    <div class="column-newsletter">

        <div class="subscribe">
            <form class="subscribe-form1">
                <input type="email" placeholder="Enter your e-mail Address">
                <button type="submit" class="email"><img src="resources/images/email.php" alt=""></button>
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