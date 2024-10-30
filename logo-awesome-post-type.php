<?php
/*-----------------------------------------------------------------------------------*/
/* TImeline Awesome Post Type
/*-----------------------------------------------------------------------------------*/


add_action('init', 'logo_awesome_register');

function logo_awesome_register() {

	$labels = array(
		'name'                => esc_html_x( 'Logos', 'Post Type General Name', 'logo-awesome' ),
		'singular_name'       => esc_html_x( 'Logos', 'Post Type Singular Name', 'logo-awesome' ),
		'menu_name'           => esc_html__( 'Logos', 'logo-awesome' ),
		'parent_item_colon'   => esc_html__( 'Parent Logos:', 'logo-awesome' ),
		'all_items'           => esc_html__( 'All Logos', 'logo-awesome' ),
		'view_item'           => esc_html__( 'View Logos', 'logo-awesome' ),
		'add_new_item'        => esc_html__( 'Add New Logos', 'logo-awesome' ),
		'add_new'             => esc_html__( 'Add New', 'logo-awesome' ),
		'edit_item'           => esc_html__( 'Edit Logos', 'logo-awesome' ),
		'update_item'         => esc_html__( 'Update Logos', 'logo-awesome' ),
		'search_items'        => esc_html__( 'Search Logos', 'logo-awesome' ),
		'not_found'           => esc_html__( 'Not found', 'logo-awesome' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'logo-awesome' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => 'logos',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'rewrite'            => array( 'slug' => 'logos' ),
		'supports'           => array('title'),
		'menu_position'       => 7,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'menu_icon'           => 'dashicons-marker',


	);
	register_post_type( 'logo-awesome', $args );

}


require dirname( __FILE__ ) .'/includes/hover-collections.php';

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'logo_awesome_field_in_post' );
function logo_awesome_field_in_post() {

	require dirname( __FILE__ ) .'/logo-awesome-ctrl.php';

	Container::make( 'post_meta', 'logo_repeater_cont', esc_html('Logo Awesome') )
	->where( 'post_type', '=', 'logo-awesome' )
	->set_priority( 'high' )
	->add_tab(  __( 'Layout' ), array(
		Field::make( 'select', 'logo_style_choice', esc_html__( 'Select Style', 'logo-awesome' ) )
		->add_options( array(
			'grid-full-image-1' => 'Grid Full Image',
			'grid-card-1' => 'Grid Card',
			'carousel-full-image-1' => 'Carousel Full Image',
			'carousel-card-1' => 'Carousel Card',
			'logo-style-3' => 'Unique Tilu',
			'logo-style-8' => 'Unique Tujuh',
			'logo-style-14' => 'Unique Salapan',
		) ),

		Field::make( 'select', 'logo_style_choice_grid_col', esc_html__( 'Select Grid Column', 'logo-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'grid-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'grid-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-15',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-14',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-5',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-7',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'12' => '1',
			'6' => '2',
			'4' => '3',
			'3' => '4',
		) ),
		Field::make( 'text', 'logo_style_choice_grid_gap', esc_html__( 'Padding', 'logo-awesome' ) )
		->set_attribute( 'placeholder', '30' )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'grid-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'grid-card-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-14',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-5',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'logo-style-7',
				'compare' => '=',
			),
		) ),

		Field::make( 'select', 'logo_style_choice_car_col', esc_html__( 'Select Column', 'logo-awesome' ) )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		) ),

		Field::make( 'text', 'logo_style_grid_padding', esc_html__( 'Space Items', 'logo-awesome' ) )
		->set_attribute( 'placeholder', '30' )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
		) ),

		Field::make( 'select', 'logo_hover_image', esc_html__( 'Select Hover Image', 'logo-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
		) )
		->add_options(
			logo_awesome_hover_effect()
		),

		Field::make( 'checkbox', 'logo_use_arrow', esc_html__( 'Use Arrow Navigation', 'logo-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
		) )
		->set_width( 33 )
		->set_option_value( 'yes' ),

		Field::make( 'checkbox', 'logo_use_pagination', esc_html__( 'Use Pagination', 'logo-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
		) )
		->set_width( 33 )
		->set_option_value( 'yes' ),

		Field::make( 'checkbox', 'logo_use_autoplay', esc_html__( 'Use Autoplay', 'logo-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-full-image-1',
				'compare' => '=',
			),
			array(
				'field' => 'logo_style_choice',
				'value' => 'carousel-card-1',
				'compare' => '=',
			),
		) )
		->set_width( 33 )
		->set_option_value( 'yes' ),
	))
	->add_tab(  esc_html__( 'Content', 'logo-awesome' ), array(

		Field::make( 'complex', 'logo_items', esc_html__( 'Client Items', 'logo-awesome' ) )
		->set_layout( 'tabbed-horizontal' )
		->add_fields( array(
				Field::make( 'text', 'logo_item_name', esc_html__( 'Client Name', 'logo-awesome' ) )
				->set_attribute( 'placeholder', 'John Doe' )
				->set_width( 33 ),

				Field::make( 'text', 'subtitle', esc_html__( 'Subtitle', 'logo-awesome' ) )
				->set_attribute( 'placeholder', 'Subtitle' )
				->set_width( 33 ),

				Field::make( 'text', 'logo_item_url', esc_html__( 'Client Url', 'logo-awesome' ) )
				->set_attribute( 'placeholder', 'https://' )
				->set_width( 33 ),

				Field::make( 'select', 'logo_hover_image', esc_html__( 'Select Hover Image', 'logo-awesome' ) )
				->set_conditional_logic( array(
					'relation' => 'OR',
					array(
						'field' => 'parent.logo_style_choice',
						'value' => 'grid-full-image-1',
						'compare' => '=',
					),
					array(
						'field' => 'parent.logo_style_choice',
						'value' => 'grid-card-1',
						'compare' => '=',
					),
				) )
				->set_width( 50 )
				->add_options(
					logo_awesome_hover_effect()
				),

				Field::make( 'textarea', 'logo_item_bio', esc_html__( 'Description', 'logo-awesome' ) )
				->set_attribute( 'placeholder', 'Put your text here...' )
				->set_width( 80 ),

				Field::make( 'image', 'logo_item_img', esc_html__( 'Logo Image', 'logo-awesome' ) )
				->set_width( 20 ) ,
				Field::make( 'separator', 'logo_custom_option', 'Optional' ),
				Field::make( 'complex', 'logo_items_socials', esc_html__( 'Logo Social', 'logo-awesome' ) )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(

					Field::make( 'icon', 'logo_item_social_icon', esc_html__( 'Icon', 'logo-awesome' ) )
					->set_width( 40 ),
					Field::make( 'text', 'logo_item_social_link', esc_html__( 'Logo Link', 'logo-awesome' ) )
					->set_attribute( 'placeholder', 'http://' )
					->set_width( 40 ),
				))
				->set_default_value( array(
					array(
					),
				) ),


				Field::make( 'textarea', 'logo_desc', esc_html__( 'Logo Description', 'logo-awesome' ) )
				->set_attribute( 'placeholder', 'Put your text here...' )
				->set_conditional_logic( array(
					array(
						'field' => 'parent.logo_style_choice',
						'value' => 'logo-style-3',
						'compare' => '=',
					)
				) ),

				Field::make( 'icon', 'social_site_icon', esc_html__( 'Icon', 'logo-awesome' ) )
				->set_conditional_logic( array(
					array(
						'field' => 'parent.logo_style_choice',
						'value' => 'vertical-7',
						'compare' => '=',
					)
				) ),
				Field::make( 'text', 'logo_item_subtitle', esc_html__( 'Subtitle', 'logo-awesome' ) )
				->set_conditional_logic( array(
					array(
						'field' => 'parent.logo_style_choice',
						'value' => 'vertical-2',
						'compare' => '=',
					)
				) )
				->set_width( 35 ),
		) )
		->set_default_value( array(
			array(
			),
		) ),
	))
	->add_tab(  esc_html__( 'Customize', 'logo-awesome' ), array(
		Field::make( 'html', 'asfafaf' )
   		->set_html( '<p>In order to customize colors, let&#39;s upgrade to pro</p><a href="https://1.envato.market/kBNQn" target="_blank" class="btn-buy">Upgrade to Pro</a>' )
	));

	// For Gutenberg Blocks
	Block::make( esc_html( 'Logo Awesome' ) )
	->add_fields( array(
		Field::make( 'association', 'logo_gutenberg_block', esc_html__( 'Logo Awesome Post', 'logo-awesome' ) )
		->set_min( 1 )
		->set_max( 1 )
		->set_types( array(
			array(
				'type'      => 'post',
				'post_type' => 'logo-awesome',
			)
		) )
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		require dirname( __FILE__ ) .'/gutenberg-blocks/logo-block.php';
	} );

}