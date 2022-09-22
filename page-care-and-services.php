<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$categories = get_terms( 'parent-service-category' );

?>

<section class="section providers-hero">
	<h1>Find a provider</h1>
	<p>Search for any Welia Health provider by name, location or specialty.</p>
	<div class="filters flex-row">
		<div class="search-bar">
			<form action="" class="search-bar-form flex-row">
				<input type="image" src="/wp-content/uploads/2022/08/filter-white-icon.svg" width="50px">
				<select id="filter-providers-specialty">
					<option value="" disabled selected>Filter by medical specialty</option>
					<?php foreach( $specialties as $specialty ) : ?>
						<option value="<?= $specialty->name ?>"><?= $specialty->name ?></option>
					<?php endforeach ?>
				</select>
			</form>
		</div>
	</div>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</section>

<section class="featured-services services-archive services section">
    <h2>Featured services</h2>
    <div class="services-wrapper services-swiper flex-row">
        <?php
        $args = array (
            'post_type'              => 'parent-service',
            'tax_query'              => array(
                                            array(
                                                'taxonomy' => 'service-category',
                                                'field'    => 'term_slug',
                                                'terms'    => 'featured-services'
                                            )
                                        )
        );

        $query = new WP_Query( $args );
                
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="icon-card flex-column">
                <img src="<?php the_field( 'icon') ?>">
                <h5><?php the_title() ?></h5>
                <span class="description"><?php the_field( 'short_description' ) ?></span>
                <div class="filled-button blue wp-block-button">
                    <a href="<?php the_permalink() ?>" class="wp-block-button__link">LEARN MORE</a>
                </div>
            </div>
        <?php endwhile;
        
        wp_reset_postdata(); ?>
    </div>
</section>

<section class="additional-services services-archive services section">
    <h2>Additional hospital and clinic services</h2>
    <div class="services-wrapper services-swiper flex-row">
        <?php
        $args = array (
            'post_type'              => 'parent-service',
            'tax_query'              => array(
                                            array(
                                                'taxonomy' => 'service-category',
                                                'field'    => 'term_slug',
                                                'terms'    => 'additional-hospital-and-clinic-services'
                                            )
                                        )
        );

        $query = new WP_Query( $args );
                
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="icon-card flex-column">
                <img src="<?php the_field( 'icon') ?>">
                <h5><?php the_title() ?></h5>
                <span class="description"><?php the_field( 'short_description' ) ?></span>
                <div class="filled-button blue wp-block-button">
                    <a href="<?php the_permalink() ?>" class="wp-block-button__link">LEARN MORE</a>
                </div>
            </div>
        <?php endwhile;
        
        wp_reset_postdata(); ?>
    </div>
</section>