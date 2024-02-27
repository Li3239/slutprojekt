<?php
/*
** 1. Add shortcodes.php in init.php
** 2. Add defined shortcode in some page by writing 【[/]shortcode】 ：【[mytheme_box]】
** 3. Use shortcodes for swish，klana etc.
*/
function mytheme_shortcode_draw_box($attr)
{
    //在page中引用shortcode【[mytheme_box]】时，第一项为缺省值，如果parameter【$attr)】未指定时使用这个数组指定的内容
    // 如果parameter【$attr)】指定时，使用方法：【[mytheme_box color="lime" size="5"]】，使用用户指定的内容
    // 只有一个color参数时，在dashboard的页面编辑器中选中【shortcode】然后填入【[mytheme_box green]】既可以显示绿色的box
    $attr = shortcode_atts(
        array(
            "color" => "green",
            "size" => 1
        ),
        $attr,
        "mytheme_box"
    );
    return '<div style="width:100px; height:100px; background:' . $attr["color"] . '"></div>';
}
// 第一个参数定义了shortcode的名称【[mytheme_box]】
add_shortcode("mytheme_box", "mytheme_shortcode_draw_box");



// 中间使用逗号➕空格区分  ： 必须与explode(', ', $atts['images']);一致！！！
// [mytheme_shortcode_projects_block images="http://.../gallery1.png, http://.../gallery2.png"]
// 页面编辑器中调用：[mytheme_shortcode_projects_block images="image1.jpg, image2.jpg, image3.jpg"]
// [mytheme_shortcode_projects_block title="AAA" overlay_title="Sample Project" images="http://projectlorum.test/wp-content/uploads/2024/01/gallery1.png, http://projectlorum.test/wp-content/uploads/2024/01/gallery2.png, http://projectlorum.test/wp-content/uploads/2024/01/gallery3.png, http://projectlorum.test/wp-content/uploads/2024/01/gallery4.png, http://projectlorum.test/wp-content/uploads/2024/01/image-18.png"]
// function customer_projects_block($atts)
function customer_projects_block()
{
    //---------------------------------- 
    // 方法一: 通过 settings.php 设置各变量
    //---------------------------------- 
    $arr = array(
        "title" => "Our Project",
        "hover_title" => "Sample Project"
    );
    //  1. project_block_title ：Our Projects
    if (empty(get_option("project_block_title")) != true) {
        $arr["title"] = get_option("project_block_title");
    }
?>
    <div class="shop-hero">
        <span class="shop-hero-title"><?php get_option("store_shop_hero_title"); ?></span>
        <span class="shop-hero-sub-title"><?php get_option("store_shop_hero_sub_title"); ?></span>
        <span class="shop-hero-info"><?php get_option("store_shop_hero_info"); ?></span>
    </div>
<?php
}
add_shortcode('mytheme_shortcode_projects_block', 'customer_projects_block');


function customer_contact_block()
{
    //---------------------------------- 
    // 方法一: 通过 settings.php 设置各变量
    //---------------------------------- 
    $arr = array(
        "title" => "Contact Us",
        "image" => get_template_directory_uri() . "/assets/images/contact_image.png"
    );

    //  1. contact_block_title ：Contact Us
    if (empty(get_option("contact_block_title")) != true) {
        $arr["title"] = get_option("contact_block_title");
    }
    //  2. contact_block_image_url: image
    if (empty(get_option("contact_block_image_url")) != true) {
        $arr["image"] = get_option("contact_block_image_url");
    }
    //---------------------------------- 
    // 方法一: 通过 customizepage.php 设置img
    //---------------------------------- 
    // 获取'main_section_heading'设置的值，如果没有设置，则返回默认值'Default Main Heading'
    $main_section_image = get_theme_mod('main_section_image', '');

?>
    <div class="contact-block">
        <div class="line-0">
            <p><?= $arr["title"]; ?></p>
        </div>
        <div class="line-1">
            <div class="contact-form">
                <form action="" method="post">
                    <input size="40" class="form-input-name" autocomplete="name" placeholder="Name" value="" type="text" name="your-name">
                    <input size="40" class="form-input-phone" id="form-input-need" placeholder="Phone Number*" value="" type="tel" name="your-phone">
                    <input size="40" class="form-input-email" autocomplete="email" placeholder="E-mail*" value="" type="email" name="your-email">
                    <input size="40" class="form-input-interested-in" placeholder="Interested In" value="" type="text" name="your-interested-in">
                    <textarea cols="40" rows="10" class="form-input-message" placeholder="Message*" name="your-message"></textarea>
                </form>
            </div>
            <div class="contact-img">
                <!-- <img src="<?= esc_url($arr["image"]); ?>" alt="contact image"> -->
                <img src="<?= esc_url($main_section_image); ?>" alt="contact image">
            </div>
        </div>
        <div class="line-2">
            <div class="send-email-div">
                <p>SEND EMAIL</p>
            </div>
            <div class="arrow-div">
                <img src="<?= get_template_directory_uri() . "/assets/images/arrow-2-right-long.png"; ?>" alt="">
            </div>
        </div>
    </div>
<?php
}
add_shortcode('mytheme_shortcode_contact_block', 'customer_contact_block');


function customer_top_block()
{
    //  1. top_block_title_1 ：Title(Project)
    //  2. top_block_title_2:  Title(Lorum)
    //  3. top_block_image:   url of image
    //---------------------------------- 
    // 方法一: 通过 settings.php 设置各变量
    //---------------------------------- 
    $arr = array(
        "title_1" => "PROJECT",
        "title_2" => "Lorum",
        "image_url" => get_template_directory_uri() . "/assets/images/top_image.png"
    );
    //  1. top_block_title_1 ：PROJECT
    if (empty(get_option("top_block_title_1")) != true) {
        $arr["title_1"] = get_option("top_block_title_1");
    }
    //  2. top_block_title_2 ：Lorum
    if (empty(get_option("top_block_title_2")) != true) {
        $arr["title_2"] = get_option("top_block_title_2");
    }
    //  3. top_block_image: url of image
    if (empty(get_option("top_block_image")) != true) {
        $arr["image_url"] = get_option("top_block_image");
    }
?>

    <div class="top-block">
        <div class="top-left-column">
            <p class="top-title-1"><?= $arr["title_1"]; ?></p>
            <p class="top-title-2"><?= $arr["title_2"]; ?></p>
            <div class="top-arrow-div">
                <p class="arrow-left"></p>
                <p class="arrow-right"></p>
            </div>
            <div class="top-date-div">
                <p class="date-left">01</p>
                <img alt="line3" src="<?= get_template_directory_uri() . "/assets/images/line3.png" ?>">
                <p class="date-right">02</p>
            </div>
        </div>
        <div class="top-right-column">
            <div class="top-cover">
                <img alt="" src=<?= $arr["image_url"]; ?>>
                <div class="overlay">
                    <p>VIEW PROJECTS</p>
                </div>
            </div>
        </div>
    </div>

<?php
}
add_shortcode('mytheme_shortcode_top_block', 'customer_top_block');

// ============================
// 用来定义 about block 
// ============================
function customer_about_block()
{
    //---------------------------------- 
    // 方法一: 通过 settings.php 设置各变量
    //---------------------------------- 
    $arr = array(
        "title" => "ABOUT",
        "desc" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
        "image_url_1" => get_template_directory_uri() . "/assets/images/about_image1.png",
        "image_url_2" => get_template_directory_uri() . "/assets/images/about_image2.png",
        "image_url_3" => get_template_directory_uri() . "/assets/images/about_image3.png"
    );

    //  1. about_block_title ：Title(About)
    if (empty(get_option("about_block_title")) != true) {
        $arr["title"] = get_option("about_block_title");
    }
    //  2. about_block_desc:  Title(Lorem Ipsum is simply dummy ...)
    if (empty(get_option("about_block_desc")) != true) {
        $arr["desc"] = get_option("about_block_desc");
    }
    //  3. about_block_image_1:   url of image 1
    if (empty(get_option("about_block_image_1")) != true) {
        $arr["image_url_1"] = get_option("about_block_image_1");
    }
    //  4. about_block_image_2:   url of image 2
    if (empty(get_option("about_block_image_2")) != true) {
        $arr["image_url_2"] = get_option("about_block_image_2");
    }
    //  5. about_block_image_3:   url of image 3
    if (empty(get_option("about_block_image_3")) != true) {
        $arr["image_url_3"] = get_option("about_block_image_3");
    }
?>
    <div class="about-block">
        <div class="about-column-left">
            <img class="image-upp" src=<?= $arr["image_url_1"]; ?> alt="about image 1">
            <img class="image-down" src=<?= $arr["image_url_2"]; ?> alt="about image 2">
        </div>
        <div class="about-column-middle">
            <img src=<?= $arr["image_url_3"]; ?> alt="about image 3">
        </div>
        <div class="about-column-right">
            <h2 class="about-title"><?= $arr["title"]; ?></h2>
            <p class="about-desc"><?= $arr["desc"]; ?></p>
            <div class="about-readmore-block">
                <p>READ MORE</p>
            </div>
        </div>
    </div>
<?php
}
add_shortcode('mytheme_shortcode_about_block', 'customer_about_block');



// ============================
// 用来定义 Main focus block 
// ============================
function customer_focus_block()
{
    //---------------------------------- 
    // 方法一: 通过 settings.php 设置各变量
    //---------------------------------- 
    $arr = array(
        "title" => "Main Focus/Mission Statement",
        "desc_1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed efficitur, lectus et facilisis placerat.",
        "desc_2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed efficitur, lectus et facilisis placerat, magna mauris porttitor tortor, a auctor est felis ut nisl."
    );

    //  1. focus_block_title ：Title(Main Focus/Mission Statement)
    if (empty(get_option("focus_block_title")) != true) {
        $arr["title"] = get_option("focus_block_title");
    }
    //  2. focus_block_desc_1:  Desc 1(Lorem Ipsum is simply dummy ...)
    if (empty(get_option("focus_block_desc_1")) != true) {
        $arr["desc_1"] = get_option("focus_block_desc_1");
    }
    //  3. focus_block_desc_2:  Desc 2(Lorem Ipsum is simply dummy ...)
    if (empty(get_option("focus_block_desc_2")) != true) {
        $arr["desc_2"] = get_option("focus_block_desc_2");
    }
?>
    <div class="focus-block">
        <div>
            <div class="focus-line-1">
                <p><?= $arr["title"]; ?></p>
            </div>
            <div class="focus-line-2">
                <div class="column-left">
                    <p class="column-title">1</p>
                    <p class="column-desc"><?= $arr["desc_1"]; ?></p>
                </div>

                <div class="column-right">
                    <p class="column-title">2</p>
                    <p class="column-desc"><?= $arr["desc_2"]; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php
}
add_shortcode('mytheme_shortcode_focus_block', 'customer_focus_block');
