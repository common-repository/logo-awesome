<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Logo_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       Logo Awesome
 * Plugin URI:        https://logo.themesawesome.com/
 * Description:       Partner & Client Logo Showcase Plugin
 * Version:           1.0.0
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       logo-awesome
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LOGO_AWESOME_VERSION', '1.0.0' );

define( 'LOGO_AWESOME', __FILE__ );

define( 'LOGO_AWESOME_BASENAME', plugin_basename( LOGO_AWESOME ) );

define( 'LOGO_AWESOME_NAME', trim( dirname( LOGO_AWESOME_BASENAME ), '/' ) );

define( 'LOGO_AWESOME_DIR', untrailingslashit( dirname( LOGO_AWESOME ) ) );

define('LOGO_AWESOME_NAME', plugin_basename(dirname(__FILE__)));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-logo-awesome-activator.php
 */
function activate_logo_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-logo-awesome-activator.php';
	Logo_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-logo-awesome-deactivator.php
 */
function deactivate_logo_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-logo-awesome-deactivator.php';
	Logo_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_logo_awesome' );
register_deactivation_hook( __FILE__, 'deactivate_logo_awesome' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-logo-awesome.php';

require plugin_dir_path( __FILE__ ) . 'logo-awesome-post-type.php';

require_once plugin_dir_path( __FILE__ ).'includes/element-helper.php';
require_once plugin_dir_path( __FILE__ ).'includes/hover-collections.php';
require_once plugin_dir_path( __FILE__ ).'public/partials/get-views-part.php';

function logo_awesome_new_elements(){
  require_once plugin_dir_path( __FILE__ ).'elementor-widgets/logos/logo-control.php';
}

add_action('elementor/widgets/widgets_registered','logo_awesome_new_elements');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_logo_awesome() {

	$plugin = new Logo_Awesome();
	$plugin->run();

}
run_logo_awesome();

add_filter('manage_logo-awesome_posts_columns', function($columns) {
	return array_merge($columns, ['shortcode' => esc_html__('Shortcode', 'logo-awesome')]);
});
 
add_action('manage_logo-awesome_posts_custom_column', function($column_key, $post_id) {
	echo '<pre"><code>[logo_awesome id="'. $post_id .'"]</code></pre>';
}, 10, 2);

add_filter( 'single_template', 'logo_awesome_post_custom_template', 50, 1 );
function logo_awesome_post_custom_template( $template ) {

	if ( is_singular( 'logo-awesome' ) ) {
		$template = LOGO_AWESOME_DIR . '/single-logo-awesome.php';
	}
	
	return $template;
}


add_action( 'after_setup_theme', 'logo_awesome_crb_load' );
function logo_awesome_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}
		
add_action( 'elementor/preview/enqueue_styles', function() {
	wp_enqueue_style( 'ta-logo-awesome-swiper', plugin_dir_url( __FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-hovers', plugin_dir_url( __FILE__ ) . 'public/css/hovers.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-fontawesome', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-logo-awesome', plugin_dir_url( __FILE__ ) . 'public/css/logo-awesome-public.css', array(), '1.0.0', 'all' );

	wp_enqueue_script( 'ta-logo-awesome-stopExecution', plugin_dir_url(__FILE__ ) . 'public/js/stopExecution.js', array( 'jquery' ), '', false );
} );

/* Shortcode Function */
function logo_awesome( $atts ) {

	// Get Attributes
	extract( shortcode_atts(
			array(
				'id' => ''   // DEFAULT SLUG SET TO EMPTY
			), $atts )
	);

	// WP_Query arguments
	$args = array (
		'page_id'              =>  $id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'logo-awesome', // YOUR POST TYPE

	);
	ob_start();

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $id != '' ) {

		wp_enqueue_style( 'ta-logo-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-logo-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-logo-awesome', plugin_dir_url(__FILE__ ) . 'public/css/logo-awesome-public.css', array(), '1.0.0', 'all' );

		while ( $query->have_posts() ) {

		$query->the_post();

			$logo_style = carbon_get_post_meta( get_the_ID(), 'logo_style_choice' );

			if($logo_style == 'logo-style-1') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-1.php';
			}
			elseif($logo_style == 'logo-style-2') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-2.php';
			}
			elseif($logo_style == 'logo-style-3') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-3.php';
			}
			elseif($logo_style == 'logo-style-4') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-4.php';
			}
			elseif($logo_style == 'logo-style-5') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-5.php';
			}
			elseif($logo_style == 'logo-style-7') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-7.php';
			}
			elseif($logo_style == 'logo-style-8') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-8.php';
			}
			elseif($logo_style == 'logo-style-10') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-10.php';
			}
			elseif($logo_style == 'logo-style-14') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/logo-style-14.php';
			}
			elseif($logo_style == 'grid-full-image-1') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/grid-full-image-1.php';
			}
			elseif($logo_style == 'grid-card-1') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/grid-card-1.php';
			}
			elseif($logo_style == 'carousel-full-image-1') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/carousel-full-image-1.php';
			}
			elseif($logo_style == 'carousel-card-1') {
				$logo_style_part = dirname( __FILE__ ) .'/public/logo-styles/carousel-card-1.php';
			}
			include_once $logo_style_part;
		}
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'logo-awesome' );

	}


// Restore original Post Data
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode( 'logo_awesome', 'logo_awesome' );

function logo_awesome_select_logo_post() {
	$logos_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'logo-awesome',
	);

	$logos = get_posts($args);

	foreach( $logos as $post ) { setup_postdata( $post );
		$logos_array[$post->ID] = $post->post_title;
	}

	return $logos_array;

	wp_reset_postdata();
}


add_action('wp_head', 'logo_awesome_color_custom_styles', 100);
function logo_awesome_color_custom_styles()
{
	$logo_awesome_custom_args = array(
	'post_type'         => 'logo-awesome',
	'posts_per_page'    => -1,
	);
	$logo_awesome_custom = new WP_Query($logo_awesome_custom_args);
	if ($logo_awesome_custom->have_posts()) : ?>
   
   <style>
		<?php while($logo_awesome_custom->have_posts()) : $logo_awesome_custom->the_post();

		$logo_name_color = carbon_get_post_meta( get_the_ID(), 'logo_name_color' );
		$subtitle_color = carbon_get_post_meta( get_the_ID(), 'subtitle_color' );
		$description_color = carbon_get_post_meta( get_the_ID(), 'description_color' );
		$logo_icon_color = carbon_get_post_meta( get_the_ID(), 'logo_icon_color' );
		$logo_icon_bg_color = carbon_get_post_meta( get_the_ID(), 'logo_icon_bg_color' );
		$logo_icon_color_hover = carbon_get_post_meta( get_the_ID(), 'logo_icon_color_hover' );
		$logo_icon_bg_color_hover = carbon_get_post_meta( get_the_ID(), 'logo_icon_bg_color_hover' );

		$logo_width_item_3d = carbon_get_post_meta( get_the_ID(), 'logo_width_item_3d' );
		if(!empty($logo_width_item_3d)) {
			$logo_width_item_3d = $logo_width_item_3d;
		} else {
			$logo_width_item_3d = "500";
		}

		$logo_column_gap = carbon_get_post_meta( get_the_ID(), 'logo_style_choice_grid_gap' );
		if($logo_column_gap != "" || $logo_column_gap === 0) {
			$logo_column_gap = $logo_column_gap;
		} else {
			$logo_column_gap = 30;
		}

		?>
		<?php if(!empty($logo_name_color)) { ?>
		.logo-post-<?php echo esc_attr(get_the_ID()); ?> .logo-name h1 {
			color: <?php echo esc_html($logo_name_color); ?>;
		}
		<?php } ?>

		<?php if(!empty($subtitle_color)) { ?>
		.logo-post-<?php echo esc_attr(get_the_ID()); ?> .logo-job span {
			color: <?php echo esc_html($subtitle_color); ?>;
		}
		<?php } ?>
		
		<?php if(!empty($description_color)) { ?>
		.logo-post-<?php echo esc_attr(get_the_ID()); ?> .logo-bio p {
			color: <?php echo esc_html($description_color); ?>;
		}
		<?php } ?>

		 <?php if(!empty($logo_icon_color)) { ?>
			.logo-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a, .logo-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item {
				color: <?php echo esc_html($logo_icon_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($logo_icon_bg_color)) { ?>
			.logo-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a, .logo-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item {
				background-color: <?php echo esc_html($logo_icon_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($logo_icon_color_hover)) { ?>
			.logo-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a:hover, .logo-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item:hover, .logo-post-<?php echo esc_attr(get_the_ID()); ?> .logo-block .inner-box:hover .social-icons li a {
				color: <?php echo esc_html($logo_icon_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($logo_icon_bg_color_hover)) { ?>
			.logo-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a:hover, .logo-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item:hover {
				background-color: <?php echo esc_html($logo_icon_bg_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($logo_column_gap)) { ?>
			.logo-post-<?php echo esc_attr(get_the_ID()); ?> .grid {
				gap: <?php echo esc_html($logo_column_gap); ?>px;
			}
		<?php } ?>

		
			.logo-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-container-3d .swiper-slide {
				width: <?php echo esc_attr($logo_width_item_3d); ?>px;
			}

		<?php endwhile; wp_reset_postdata(); ?>
	</style>

	<?php endif;
}