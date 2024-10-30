<?php
wp_enqueue_style( 'ta-logo-awesome-swiper', plugin_dir_url( __DIR__ ) . 'css/swiper.css', array(), '', 'all' );
wp_enqueue_style( 'ta-logo-awesome-hovers', plugin_dir_url(__DIR__ ) . 'css/hovers.css', array(), '', 'all' );

$logos = carbon_get_post_meta( get_the_ID(), 'logo_items' );

$logo_use_arrow = carbon_get_post_meta( get_the_ID(), 'logo_use_arrow' );

$logo_hover_image = carbon_get_post_meta( get_the_ID(), 'logo_hover_image' );

?>
<div class="logo-post-<?php echo esc_attr(get_the_ID()); ?>">
    <div class="logo-content main-container ta-image-hover ta-has-card swiper-container">
        <div class="logo-wrapper swiper-wrapper">
	        <?php 
	        foreach ( $logos as $logo ) {

		        $logo_item_url = $logo['logo_item_url'];
		        if(!empty($logo_item_url)) {
		            $logo_item_url = $logo_item_url;
		        } else {
		            $logo_item_url = "#";
		        }

                $logo_items_socials = $logo['logo_items_socials'];
	        ?>
            <div class="logo-block-item swiper-slide">
                <div class="item-wrap">
                    
                    <figure class="<?php if(!empty($logo_hover_image)) { echo esc_attr($logo_hover_image); } else { ?>imghvr-reveal-down<?php } ?>">
                        <?php echo wp_get_attachment_image( $logo['logo_item_img'], 'full' ); ?>
                        <figcaption>
                            <div class="caption-inside">
                                <ul class="socials">
                                    <?php 
                                    foreach ($logo_items_socials as $logo_items_social) {
                                        if(!empty($logo_items_social['logo_item_social_link'])) {
                                        $icon = "";
                                        if (!empty($logo_items_social['logo_item_social_icon']))
                                        {
                                            $icon = $logo_items_social['logo_item_social_icon']['class'];
                                        } ?>
                                    <li class="social-item">
                                        <a href="<?php echo esc_url($logo_items_social['logo_item_social_link']); ?>" class="link-social">
                                            <i class="icon6 <?php echo esc_attr($icon); ?>"></i>
                                        </a>
                                    </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </div>
                        </figcaption>
                    </figure>

                    <div class="logoy__content">
                        <a href="<?php echo esc_url($logo_item_url); ?>" class="link_client">
                            <?php logo_title_view($logo['logo_item_name']); ?>
                        </a>
                        <?php subtitle_view($logo['subtitle']); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
        <?php if($logo_use_arrow == true) { ?>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <?php } ?>
    </div>
</div>

<?php wp_enqueue_script( 'logo-awesome-swiper-min', plugin_dir_url(__DIR__ ) . 'js/swiper.min.js', array( 'jquery' ), '', false ); ?>

<?php logo_style_script(get_the_ID()); ?>