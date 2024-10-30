<?php
namespace Elementor;

function logo_awesome_general_elementor_init(){
	Plugin::instance()->elements_manager->add_category(
		'logo_awesome-general-category',
		[
			'title'  => 'Logo Awesome',
			'icon' => 'font'
		],
		1
	);
}
add_action('elementor/init','Elementor\logo_awesome_general_elementor_init');
