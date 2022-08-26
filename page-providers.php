<?php
/* 
 *  Template Name: Providers
 */
get_header();


$locations = get_terms( [ 'taxonomy' => 'location-category', 'hide_empty' => false ] );
$specialties = get_terms( [ 'taxonomy' => 'provider-category', 'hide_empty' => false ] );

?>

<section class="section providers-hero">
	<h1>Find a provider</h1>
	<p>Search for any Welia Health provider by name, location or specialty.</p>
	<div class="filters flex-row">
		<div class="search-bar">
			<form action="" class="search-bar-form flex-row">
				<input type="image" src="/wp-content/uploads/2022/06/search-icon.svg" width="50px">
				<input id="filter-providers" type="text" name="search" placeholder="Search by name or keyword">
			</form>
		</div>
		<div class="search-bar">
			<form action="" class="search-bar-form flex-row">
				<input type="image" src="/wp-content/uploads/2022/08/filter-white-icon.svg" width="50px">
				<select id="filter-providers-location">
					<option value="" disabled selected>Filter by location</option>
					<?php foreach( $locations as $location ) : ?>
						<option value="<?= $location->name ?>"><?= $location->name ?></option>
					<?php endforeach ?>
				</select>
			</form>
		</div>
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

<section class="providers-archive providers section">
   <?php 
        $args = array (
            'post_type'              => 'provider',
            'orderby'                => 'none'
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) : ?>
        	<div id="providers-wrapper" class="wrapper providers-wrapper">
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