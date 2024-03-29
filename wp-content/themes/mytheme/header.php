<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= get_option("blogname"); ?>
    </title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@100;300;500&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/c00b9243bd.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>


    </head>

    <body>
        <header>




            <div class="header-section1">

                <h1>MOODY STUDIO</h1>

                <div class="header-icons">

                <a href="">
                    <img src="<?= get_template_directory_uri() . "/resources/images/search.svg"; ?>"
                        class="header-icon" />
                </a>

                <a href="https://slutprojekt.test/my-account/">
                    <img src="<?= get_template_directory_uri() . "/resources/images/person.svg"; ?>"
                        class="header-icon" />
                </a>

                  
                    <div class="basket-icon">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                            <img src="<?= get_template_directory_uri() . "/resources/images/basket.webp"; ?>"
                                class="header-icon" />

                            <div class="cart_count">  
                            <?php
                            $cart_count = WC()->cart->get_cart_contents_count();
                            if ($cart_count > 0) {
                                echo '<span class="cart-count">' . $cart_count . '</span>';
                            }
                            ?>
                            </div>  
                        </a>
                    </div>
                    <!-- End of basket icon with cart count -->
                    <a href="">
                    <img src="<?= get_template_directory_uri() . "/resources/images/favorite.png"; ?>"
                        class="header-icon" />
                    </a>
                </div>


            </div>

            <hr>


            <div class="header-section2">

                <div class="header-menu">
                    <?php
                    $menu = array(
                        'theme_location' => 'header-menu',
                        'menu_id' => 'header-menu',
                        'container' => 'nav',
                        'container_class' => 'menu'
                    );
                    wp_nav_menu($menu);
                    ?>
                </div>

            </div>
            <hr>


        </header>
    </body>



    </html>