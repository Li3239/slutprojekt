<!-- single.php 是用来控制post的， 打开post：http://gritsport.test/hello-world/  hello-world 是post的slug -->
<?php get_header(); ?>
<!-- content -->
<main class="content">
    <?= the_title(); ?>
    <?= the_content(); ?>

    <?php
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
    ?>
</main>
<?php get_footer(); ?>