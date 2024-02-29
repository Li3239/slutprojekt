<footer>
    <section class="container">
        <div class="column-address">
            <span class="footer-address-title">URBAN OUTFITTERS</span>
            <span class="footer-address-info"><?= get_option('store_footer_info'); ?></span>
            <div class="footer-address">
                <span><?= get_option('store_address'); ?></span>
                <span><?= get_option('store_tel'); ?></span>
                <span><?= get_option('store_email'); ?></span>
            </div>
            <?php
            $menu = array(
                'theme_location' => 'footer_social_media',
                'menu_id' => 'footer_social_media',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="column-shopping">
            <span class="category">SHOPPING</span>
            <?php
            $menu = array(
                'theme_location' => 'footer_shopping',
                'menu_id' => 'footer_shopping',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="column-links">
            <span class="category">MORE LINK</span>
            <?php
            $menu = array(
                'theme_location' => 'footer_links',
                'menu_id' => 'footer_links',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu);
            ?>
        </div>
        <div class="column-newsletter">
            <span class="category">Newsletter</span>
            <div class="subscribe">
                <form class="subscribe-form">
                    <input type="email" placeholder="Enter Your Email Address">
                    <button type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div>
    </section>

    <section class="container-copyright">
        <div class="footer-line"></div>
        <span class="site-info">
            <?= get_option("store_copyright") ?>
        </span>
    </section>
</footer>
</body>

</html>

<?php
// submit form input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get email
    $email = $_POST['email'];
    // do something(check email, verify, save...)
    echo ('Your inputed email is : ' . $email);
}

$recent_posts = wp_get_recent_posts(array(
    'numberposts' => 2, // get newest 2 posts
    'post_status' => 'publish' // should be published post
));
if (count($recent_posts) > 0) {
    echo '<ul class="footer-blog-posts">';
    foreach ($recent_posts as $post) {
        echo '<li><a href="' . get_permalink($post["ID"]) . '">' . esc_attr($post["post_title"]) . '</a></li>';
    }
    echo '</ul>';
}

?>