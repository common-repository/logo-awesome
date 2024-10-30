<?php
    $logos = carbon_get_post_meta( get_the_ID(), 'logo_items' );
    
    $logo_column = carbon_get_post_meta( get_the_ID(), 'logo_style_choice_grid_col' );
    if(!empty($logo_column)) {
    	$logo_column = $logo_column;
    } else {
    	$logo_column = '3';
    }

    $logo_column_gap = carbon_get_post_meta( get_the_ID(), 'logo_style_choice_grid_gap' );
    if(!empty($logo_column_gap)) {
    	$logo_column_gap = $logo_column_gap;
    } else {
    	$logo_column_gap = '12';
    }

?>

<style>
    .logo-post-<?php echo esc_attr(get_the_ID()); ?> .grid {
        gap: <?php echo esc_html($logo_column_gap); ?>px;
    }
</style>
<!-- Content -->
<div class="logo-post-<?php echo esc_attr(get_the_ID()); ?> style-empatbelas">
	<div class="grid grid-cols-12">
		<?php foreach ($logos as $logo) {
        $logo_item_url = $logo['logo_item_url']; ?>
		<div class="col-span-<?php echo esc_attr($logo_column); ?> sm:col-span-12">
			<a href="<?php echo esc_url($logo_item_url); ?> ">
				<?php echo wp_get_attachment_image($logo['logo_item_img'], 'full', '', array( 'class' => 'logo__img' )); ?>
			</a>
		</div>
	   <?php } ?>
	</div>
</div>
<!-- End COntent -->