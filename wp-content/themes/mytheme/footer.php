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

        <div class="column-post">
            <span class="category">FROM THE BLOG</span>
            <?php
            // 设置查询参数
            $args = array(
                'post_type' => 'post', // 查询文章类型为 "post"
                'posts_per_page' => 2, // 限制显示的文章数量为2
                'orderby' => 'date', // 根据日期排序
                'order' => 'DESC', // 降序排列，确保最新的文章先显示
            );
            // 创建一个新的WP_Query实例
            $latest_posts = new WP_Query($args);
            if ($latest_posts->have_posts()) {
                while ($latest_posts->have_posts()) {
                    // the_post()：获取全局$post对象为当前循环文章
                    $latest_posts->the_post(); 

                    // 输出文章的内容
                    $comment_count = get_comments_number();
                    echo '<div class="custom-latest-post">';
                    echo '<div>';
                    echo '  <p class="post-date-day">' . get_the_date('j') . '</p>';
                    echo '  <p class="post-date-month">' . get_the_date('M') . '</p>';
                    echo '</div>';
                    echo '  <ul class="post-article">';
                    echo '    <li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                    echo '  </ul>';
                    if ($comment_count > 0) {
                        echo '  <p class="post-comment-quantity">' . $comment_count . ' Comments</p>';
                    }
                    echo '</div>';
                    echo '<div class="footer-line"></div>';
                }
            } else {
                // 没有找到文章
                echo '<p>No post found.</p>';
            }
            // 重置查询数据
            wp_reset_postdata();
            ?>
        </div>

        <!-- <div class="column-newsletter">
            <span class="category">Newsletter</span>
            <div class="subscribe">
                <form class="subscribe-form">
                    <input type="email" placeholder="Enter Your Email Address">
                    <button type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div> -->
    </section>

    <section class="container-copyright">
        <div class="footer-line"></div>
        <span class="site-info">
            <?= get_option("store_copyright") ?>
        </span>
    </section>
</footer>
<?php wp_footer(); ?>
</body>

</html>

<?php
// submit form input
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // get email
//     $email = $_POST['email'];
//     // do something(check email, verify, save...)
//     echo ('Your inputed email is : ' . $email);
// }
?>