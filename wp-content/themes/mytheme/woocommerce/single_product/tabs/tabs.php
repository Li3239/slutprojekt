<?php
if ( ! empty( $product_tabs ) ) : ?>
<div class="woocommerce-tabs wc-tabs-wrapper">
    <ul class="tabs wc-tabs" role="tablist">
        <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
            <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                <a href="#tab-<?php echo esc_attr( $key ); ?>">
                    <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
            <?php
            if ( isset( $product_tab['callback'] ) ) {
                call_user_func( $product_tab['callback'], $key, $product_tab );

                // Display product title
                echo '<div class="product-details">';
                echo '<h2>' . get_the_title() . '</h2>';

                // Display product price
                global $product;
                echo '<div class="product-price">';
                echo '<p>' . $product->get_price_html() . '</p>';
                echo '</div>';

                // Display product color
                echo '<div class="product-color">';
                echo '<p>' . esc_html__( 'Color:', 'your-textdomain' ) . ' ' . $product->get_attribute( 'color' ) . '</p>';
                echo '</div>';

                // Display product image
                echo '<div class="product-image">';
                echo '<p>' . $product->get_image() . '</p>';
                echo '</div>';

                // Display stock status
                echo '<div class="stock-status">';
                echo '<p>' . esc_html__( 'Stock Status:', 'your-textdomain' ) . ' ' . $product->get_stock_status() . '</p>';
                echo '</div>';

                // Display product size
                echo '<div class="product-size">';
                echo '<p>' . esc_html__( 'Size:', 'your-textdomain' ) . ' ' . $product->get_attribute( 'size' ) . '</p>';
                echo '</div>';

                echo '</div>'; // Close product-details div
            }
            ?>
        </div>
    <?php endforeach; ?>

    <?php do_action( 'woocommerce_product_after_tabs' ); ?>
</div>
<?php endif; ?>
