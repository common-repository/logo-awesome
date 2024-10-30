<?php

// Logo Title
function logo_title_view($content) { ?>
	<div class="logo-name">
		<h1><?php echo esc_html($content); ?></h1>
	</div>
<?php }

// Logo Avatar
function logo_avatar_view($content) { ?>
	<div class="logo-avatar">
		<?php echo wp_get_attachment_image( $content, 'full' ); ?>
	</div>
<?php }

// Logo Job
function subtitle_view($content) { ?>
	<div class="logo-job">
		<span><?php echo esc_html($content); ?></span>
	</div>
<?php }

// Logo Bio
function logo_bio_view($content) { ?>
	<div class="logo-bio">
		<p><?php echo wp_specialchars_decode($content); ?></p>
	</div>
<?php }

// Logo Title
function logo_style_script($post_id) {
	$carousel_style = carbon_get_post_meta( $post_id, 'logo_style_choice' );
	$logo_column = carbon_get_post_meta( $post_id, 'logo_style_choice_car_col' );
	$spacebetween = carbon_get_post_meta( $post_id, 'logo_style_grid_padding' );
	if($spacebetween != "" || $spacebetween === 0) {
		$spacebetween = $spacebetween;
	} else {
		$spacebetween = 30;
	}

	$logo_use_arrow = carbon_get_post_meta( $post_id, 'logo_use_arrow' );
	$logo_use_pagination = carbon_get_post_meta( $post_id, 'logo_use_pagination' );
	$logo_use_autoplay = carbon_get_post_meta( $post_id, 'logo_use_autoplay' ); ?>
	<script>
		(function( $ ) {
		'use strict';

			$(document).ready(function() {
			    var swiper = new Swiper('.logo-post-<?php echo esc_attr($post_id); ?> .swiper-container', {
			    	<?php if($carousel_style == 'carousel-full-image-1' || $carousel_style == 'carousel-card-1') { ?>
			    	slidesPerView: <?php echo intval($logo_column); ?>,
			    	loop: true,
			    	<?php } ?>
			    	spaceBetween: <?php echo intval($spacebetween); ?>,
			    	<?php if($logo_use_autoplay == true) { ?>
			    	autoplay: {
				        delay: 2500,
				        disableOnInteraction: false,
			      	},
			      	<?php } ?>
				    breakpoints: {
				      	480: {
				        	slidesPerView: 1,
				        	spaceBetween: 0,
				      	},
				      	640: {
			    		<?php if ($carousel_style == 'carousel-full-image-1' || $carousel_style == 'carousel-card-1') { ?>
				        	slidesPerView: <?php echo intval($logo_column); ?>,
				        <?php } ?>
				        	spaceBetween: <?php echo intval($spacebetween); ?>,
				      	}
				    },
				    <?php if($logo_use_pagination == true) { ?>
			      	pagination: {
			      		clickable: true,
			        	el: '.logo-post-<?php echo esc_attr($post_id); ?> .swiper-pagination',
			      	},
			      	<?php } ?>
				    <?php if($logo_use_arrow == true) { ?>
			      	navigation: {
				        nextEl: '.logo-post-<?php echo esc_attr($post_id); ?> .swiper-button-next',
				        prevEl: '.logo-post-<?php echo esc_attr($post_id); ?> .swiper-button-prev',
			      	},
			      	<?php } ?>
			    });
			});

		})( jQuery );
	</script>
	<?php
}