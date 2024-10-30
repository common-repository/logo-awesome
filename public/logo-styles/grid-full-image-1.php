<?php

wp_enqueue_style( 'ta-logo-awesome-hovers', plugin_dir_url(__DIR__ ) . 'css/hovers.css', array(), '', 'all' );

$logos = carbon_get_post_meta( get_the_ID(), 'logo_items' );
$logo_column = carbon_get_post_meta( get_the_ID(), 'logo_style_choice_grid_col' );
if(!empty($logo_column)) {
    $logo_column = $logo_column;
} else {
    $logo_column = 4;
} ?>
<div class="logo-post-<?php echo esc_attr(get_the_ID()); ?>">
    <div class="logo-content main-container grid grid-cols-12 ta-image-hover">
        <?php 
            foreach ( $logos as $logo ) {

            $logo_hover_image = $logo['logo_hover_image'];
            $logo_item_url = $logo['logo_item_url'];
            if(!empty($logo_item_url)) {
                $logo_item_url = $logo_item_url;
            } else {
                $logo_item_url = "#";
            }

            $logo_items_socials = $logo['logo_items_socials'];
            $logo_6_hover_color = $logo['logo_6_hover_color']; ?>
        <div class="logo-block-item col-span-<?php echo esc_attr($logo_column); ?> sm:col-span-12">
            <a href="<?php echo esc_url($logo_item_url); ?>">
                <div class="item-wrap">
                    <figure class="<?php if(!empty($logo_hover_image)) { echo esc_attr($logo_hover_image); } else { ?>imghvr-reveal-down<?php } ?>">
                        <?php echo wp_get_attachment_image( $logo['logo_item_img'], 'full' ); ?>
                        <figcaption>
                            <div class="caption-inside">
                                <div class="logoy__content">
                                    <?php logo_title_view($logo['logo_item_name']); ?>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>