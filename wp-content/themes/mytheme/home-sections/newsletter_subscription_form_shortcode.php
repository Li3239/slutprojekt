<?php

function newsletter_subscription_form_shortcode() {
    ob_start(); ?>

    <div class="newsletter-subscription-form">
        <div class="left-content">
            <p class="sign-up-text">SIGN UP FOR THE NEWSLETTER</p>
            <p class="subscribe-text">Subscribe for the latest stories and promotions</p>
        </div>
        <div class="right-content">
            <form action="#" method="post">
                <input type="email" name="email" placeholder="Enter your e-mail address" required>
                <button type="submit"><img src="<?php echo get_template_directory_uri() . '/resources/images/email.png'; ?>" alt="Subscribe"></button>            </form>
        </div>
    </div>

    <?php
    return ob_get_clean();
}