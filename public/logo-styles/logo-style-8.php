<?php
    $logos = carbon_get_post_meta( get_the_ID(), 'logo_items' );
?>
<div id="style-delapan" class="vcenter alignfull logo-post-<?php echo esc_attr(get_the_ID()); ?> style-delapan">
    <div class="section">
        <div class="logo-container">
            <ul class="logo">
                <?php foreach ( $logos as $logo ) {
                $logo_items_socials = $logo['logo_items_socials']; ?>
                <li class="logo__members">
                    <div class="userProfile">
                        <div class="userProfile__thumbnail">
                            <?php echo wp_get_attachment_image( $logo['logo_item_img'], 'full', "", array( "class" => "userProfile__image" ) ); ?>
                        </div>
                    </div>
                    <div class="logo__details">
                        <div class="logo__meta">
                            <?php logo_title_view($logo['logo_item_name']); ?>

                            <?php subtitle_view($logo['subtitle']); ?>
                        </div>
                        <div class="logo__details__summery">
                            <?php logo_bio_view($logo['logo_item_bio']); ?>
                        </div>
                        <div class="socials flex flex-wrap gap-4 justify-center">
                            <?php 
                            foreach ( $logo_items_socials as $logo_items_social ) {
                                if(!empty($logo_items_social['logo_item_social_link'])) {
                                    $icon = "";
                                    if(!empty($logo_items_social['logo_item_social_icon'])) {
                                        $icon = $logo_items_social['logo_item_social_icon']['class'];
                                    } ?>
                            <div class="social-item">
                                <a href="<?php echo esc_url($logo_items_social['logo_item_social_link']); ?>">
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                </a>
                            </div>
                            <?php } 
                            } ?>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
(function( $ ) {
'use strict';
    $(document).ready(function($){
        let members = $(".logo__members");
        let isHover = false;

        setInterval(() => {
          if (!isHover) {
            let min = 1;
            let max = $(members).length;
            let random = Math.floor(Math.random() * (max - min + 1) + min);
            $(".logo__members:nth-child(" + random + ")")
              .addClass("logo__members--show")
              .siblings()
              .removeClass("logo__members--show");
          }
        }, 3000);
        function mediaSize() {
          $(members).hover(
            () => {
              if (window.matchMedia("(min-width: 480px)").matches) {
                $(members).removeClass("logo__members--show");
                isHover = true;
                console.log("hover");
              }
            },
            () => {
              if (window.matchMedia("(min-width: 480px)").matches) {
                isHover = false;
              }
            }
          );
        }
        /* Call the function */
        mediaSize();
        /* Attach the function to the resize event listener */
        window.addEventListener("resize", mediaSize, false);
    });
})( jQuery );
</script>