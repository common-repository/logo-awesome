<?php get_header();

$template = get_template();

if ( have_posts() ):

wp_enqueue_style( 'ta-logo-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
wp_enqueue_style( 'ta-logo-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
wp_enqueue_style( 'ta-logo-awesome', plugin_dir_url(__FILE__ ) . 'public/css/logo-awesome-public.css', array(), '', 'all' );

while ( have_posts() ) : the_post();

	$logo_style = carbon_get_post_meta( get_the_ID(), 'logo_style_choice' );

	if($logo_style == 'logo-style-1') {
		echo '<div class="logo-container">';
			include_once dirname( __FILE__ ) .'/public/logo-styles/logo-style-1.php';
		echo '</div>';
	}
	elseif($logo_style == 'logo-style-2') {
		echo '<div class="logo-container">';
			include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-2.php';
		echo '</div>';
	}
	elseif($logo_style == 'logo-style-3') {
		echo '<div class="logo-container">';
			include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-3.php';
		echo '</div>';
	}
	elseif($logo_style == 'logo-style-4') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-4.php';
	}
	elseif($logo_style == 'logo-style-5') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-5.php';
	}
	elseif($logo_style == 'logo-style-7') {
		echo '<div class="logo-container">';
			include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-7.php';
		echo '</div>';
	}
	elseif($logo_style == 'logo-style-8') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-8.php';
	}
	elseif($logo_style == 'logo-style-10') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-10.php';
	}
	elseif($logo_style == 'logo-style-14') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/logo-style-14.php';
	}
	elseif($logo_style == 'grid-full-image-1') {
		echo '<div class="logo-container">';
		  include_once  dirname( __FILE__ ) .'/public/logo-styles/grid-full-image-1.php';
		echo '</div>';
	}
	elseif($logo_style == 'grid-card-1') {
		echo '<div class="logo-container">';
			include_once  dirname( __FILE__ ) .'/public/logo-styles/grid-card-1.php';
		echo '</div>';
	}
	elseif($logo_style == 'carousel-full-image-1') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/carousel-full-image-1.php';
	}
	elseif($logo_style == 'carousel-card-1') {
		include_once  dirname( __FILE__ ) .'/public/logo-styles/carousel-card-1.php';
	}
   

$template = get_template();

endwhile; 
endif;
wp_reset_postdata();
get_footer(); ?>