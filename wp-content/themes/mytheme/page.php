<?php get_header(); ?>
<!-- CONTENT -->
<main class="content">


    <div class="home-section1">


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
    </div>


    <?= the_content() ?>
    <?php
    // get_template_part('templates/main_content_template/hero_section');
    // do_action("mytheme_page_content_loaded");
    
    ?>

</main>
<?php get_footer(); ?>