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

                    <img src="<?= get_template_directory_uri() . "/resources/images/search.svg"; ?>"
                        class="header-icon" />
                    <img src="<?= get_template_directory_uri() . "/resources/images/person.svg"; ?>"
                        class="header-icon" />
                    <img src="<?= get_template_directory_uri() . "/resources/images/basket.webp"; ?>"
                        class="header-icon" />
                    <img src="<?= get_template_directory_uri() . "/resources/images/favorite.png"; ?>"
                        class="header-icon" />

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

    <div class="home-section1">


        <div class="home-top">
            <img src="<?= get_template_directory_uri() . "/resources/images/delievery.svg"; ?>" class="header-icon" />
            <h2>FREE SHIPPING</h2>
        </div>

        <div class="home-top">
            <img src="<?= get_template_directory_uri() . "/resources/images/moneyback.svg"; ?>" class="header-icon" />
            <h2>100% MONEY BACK</h2>
        </div>

        <div class="home-top">
            <img src="<?= get_template_directory_uri() . "/resources/images/support.svg"; ?>" class="header-icon" />
            <h2>SUPPORT 24/7</h2>
        </div>
    </div>

    </html>