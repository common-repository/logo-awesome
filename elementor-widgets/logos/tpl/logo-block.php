<?php

	$args = array (
		'p'              => $logo_awesome_select_logo,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'logo-awesome', // YOUR POST TYPE

	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $logo_awesome_select_logo != '' ) {

		wp_enqueue_style( 'ta-logo-awesome-fontawesome', plugin_dir_url('README.txt') . LOGO_AWESOME_NAME . '/public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-logo-awesome-thaw-flexgrid', plugin_dir_url('README.txt') . LOGO_AWESOME_NAME . '/public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-logo-awesome', plugin_dir_url('README.txt') . LOGO_AWESOME_NAME . '/public/css/logo-awesome-public.css', array(), '', 'all' );

		while ( $query->have_posts() ) {

			$query->the_post();

			$logo_style = carbon_get_post_meta( get_the_ID(), 'logo_style_choice' );

			if($logo_style == 'logo-style-1') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-1.php';
			}
			elseif($logo_style == 'logo-style-2') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-2.php';
			}
			elseif($logo_style == 'logo-style-3') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-3.php';
			}
			elseif($logo_style == 'logo-style-4') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-4.php';
			}
			elseif($logo_style == 'logo-style-5') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-5.php';
			}
			elseif($logo_style == 'logo-style-7') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-7.php';
			}
			elseif($logo_style == 'logo-style-8') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-8.php';
			}
			elseif($logo_style == 'logo-style-10') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-10.php';
			}
			elseif($logo_style == 'logo-style-14') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/logo-style-14.php';
			}
			elseif($logo_style == 'grid-full-image-1') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/grid-full-image-1.php';
			}
			elseif($logo_style == 'grid-card-1') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/grid-card-1.php';
			}
			elseif($logo_style == 'carousel-full-image-1') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/carousel-full-image-1.php';
			}
			elseif($logo_style == 'carousel-card-1') {
				$logo_style_part = LOGO_AWESOME_DIR .'/public/logo-styles/carousel-card-1.php';
			}
			include $logo_style_part;

		} wp_reset_postdata();
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'logo-awesome' );

	}