<?php
/* 
 *  Template Name: Providers
 */
get_header();
?>

<section class="section providers-hero">
	<h1>Find a provider</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
	incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
	exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
	dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
	<div class="filters flex-row">
		<div class="search-bar">
			<form action="" id="search-providers-name" class="search-bar-form flex-row">
				<input type="image" src="/wp-content/uploads/2022/07/search-pink-icon.svg" width="50px">
				<input type="text" name="search" placeholder="Fever">
			</form>
		</div>
		<div class="search-bar">
			<form action="" id="search-providers-location" class="search-bar-form flex-row">
				<input type="image" src="/wp-content/uploads/2022/07/filter-pink-icon.svg" width="50px">
				<input type="text" name="search" placeholder="Filter by Category">
			</form>
		</div>
		<div class="search-bar">
			<form action="" id="search-providers-specialty" class="search-bar-form flex-row">
				<input type="image" src="/wp-content/uploads/2022/07/filter-pink-icon.svg" width="50px">
				<input type="text" name="search" placeholder="Email address to subscribe">
			</form>
		</div>
	</div>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
</section>

<section class="providers-archive providers section">
   <?php 
        $args = array (
            'post_type'              => 'provider',
            'orderby'                => 'none'
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) : ?>
        	<div class="providers-wrapper">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $locations = ucwords( str_replace( "_", " ", implode( ", ", get_field( "provider_locations" ) ) ) ); ?>
				<div class="provider-card relative">
					<a href="<?= get_permalink() ?>">
						<div class="card-image" style="background-image: url(<?= get_field( 'provider_photo' ) ?>)">
						</div>
					</a>
					<div class="card-content flex-column">
						<div class="provider-info">
							<h5><?= get_field( 'provider_name' ) ?>, <?= get_field('provider_primary_credentials') ?></h5>
							<p><?= get_field( 'provider_primary_specialty' ) ?></p>
						</div>
						<div class="provider-info">
							<h5>Specialty</h5>
							<p class="specialties"><?= implode( ", ", get_field( 'provider_specialties' ) ) ?></p>
						</div>
						<div class="provider-info">
							<h5>Where I practice</h5>
							<p><?= $locations ?></p>
						</div>
						<div class="buttons">
							<div class="filled-button green wp-block-button">
								<a href="<?= get_permalink() ?>" class="wp-block-button__link">Learn More</a>
							</div>
							<div class="filled-button green wp-block-button">
								<a href="#" class="wp-block-button__link">Appointment</a>
							</div>
						</div>
					</div>
				</div>
            <?php endwhile ?>
       		</div>
        <?php endif;
    
        wp_reset_postdata() ?>
</section>

<?php 
get_template_part( 'template-parts/take-action' );
get_footer();
?>