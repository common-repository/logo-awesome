<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class logo_awesome_post_block extends Widget_Base {

	public function get_name() {
		return 'logo_awesome-post-block';
	}

	public function get_title() {
		return esc_html__( 'Logos', 'logo-awesome' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'logo_awesome-general-category' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------
			POST BLOCK INDEX
			1. POST SETTING
		-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/*  1. POST SETTING
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'section_logo_awesome_post_block_post_setting',
			[
				'label' => esc_html__( 'Post Setting', 'logo-awesome' ),
			]
		);

		$this->add_control(
			'logo_awesome_select_logo',
			[
				'label' => esc_html__( 'Select Logo', 'logo-awesome' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => logo_awesome_select_logo_post(),
				'description' => esc_html__( 'Select post order by (default to latest post).', 'logo-awesome' ),
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------
			end of post block post setting
		-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
		'section_logo_awesome_block_setting',
			[
				'label' => esc_html__( 'Title', 'logo-awesome' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_logo_awesome_fff_setting',
			[
				'name' => 'fff_schemes_notice',
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( '<p>In order to customize fonts, let&#39;s upgrade to pro</p><br /><a href="https://1.envato.market/kBNQn" class="btn-buy" target="_blank">Upgrade to Pro</a>', 'logo-awesome' ), Settings::get_url() ),
				'content_classes' => 'fasgag',
				'render_type' => 'ui',
			]
		);
	}

	protected function render() {

		$instance = $this->get_settings();

		/*-----------------------------------------------------------------------------------*/
		/*  VARIABLES LIST
		/*-----------------------------------------------------------------------------------*/

		/* POST SETTING VARIBALES */
		$logo_awesome_select_logo 			= ! empty( $instance['logo_awesome_select_logo'] ) ? $instance['logo_awesome_select_logo'] : '';


		/* end of variables list */


		/*-----------------------------------------------------------------------------------*/
		/*  THE CONDITIONAL AREA
		/*-----------------------------------------------------------------------------------*/

		include ( plugin_dir_path(__FILE__).'tpl/logo-block.php' );

		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new logo_awesome_post_block() );