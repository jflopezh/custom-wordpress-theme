<?php
/* 
 *  Template Name: Location
 *  Template Post Type: location
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

$category = get_the_terms( get_the_ID(), 'location-category' )[0];

?>

<div id="local-alert" class="alert flex-row">
	<img src="/wp-content/uploads/2022/08/alert-icon.svg" width="20px" height="20px">
	<div>
		<span>[Local alert bar]</span> <?= get_field( 'location_alert' ) ?>
	</div>
	<img id="close-local-alert" src="/wp-content/uploads/2022/08/close-alert-icon.svg" width="20px" height="20px">
</div>

<section class="section location-hero dual-hero right-background flex-row relative">
    <div class="hero-content half flex-colum">
        <h1><?php the_title() ?></h1>
		<div class="buttons flex-row">
			<div class="wp-block-button filled-button blue phone desktop tablet">
				<a href="tel:<?php the_field( 'location_phone' ) ?>" class="wp-block-button__link after-icon"><?php the_field( 'location_phone' ) ?></a>
			</div>
			<div class="wp-block-button filled-button blue phone mobile">
				<a href="tel:<?php the_field( 'location_phone' ) ?>" class="wp-block-button__link after-icon">CALL</a>
			</div>
			<div class="wp-block-button outlined-button blue directions">
				<a href="#" class="wp-block-button__link after-icon">Directions</a>
			</div>
		</div>
		<div class="address detail before-icon first">
			<div>
				<?php the_field( 'location_address' ) ?>
			</div>
		</div>
		<div class="office-hours detail before-icon">
			<div>
				<?php the_field( 'location_hours' ) ?>
			</div>
		</div>
		<div class="emergency detail before-icon">
			Dial 911 in case of medical emergency
		</div>
    </div>
    <div class="half background" style="background-image: url('<?php the_post_thumbnail_url( 'large' ) ?>')"></div>
</section>

<section class="location-services section dual-section-65 blue">
	<div class="head flex-row">
		<div class="half">
			<h2>Care and services</h2>
		</div>
		<div class="half">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
			magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<form role="search">
				<input id="location-service-filter" class="wp-block-search__input" type="text" placeholder="Browse by specialty">
			</form>
		</div>
	</div>
	<div class="swiper services-swiper slides-auto">
        <div class="swiper-wrapper services-wrapper">
            <?php foreach ( get_field( 'location_services' ) as $service ) { ?>
                <div class="swiper-slide">
                    <div class="icon-card flex-column">
                        <img src="<?php the_field( 'icon', $service ) ?>">
						<h5><?php echo get_the_title( $service ); ?></h5>
						<span class="description"><?php the_field( 'short_description', $service ) ?></span>
						<div class="filled-button blue wp-block-button">
							<a href="<?php the_permalink( $service ) ?>" class="wp-block-button__link">LEARN MORE</a>
						</div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination blue"></div>
    </div>
	<script>
		var swiper1 = new Swiper(".services-swiper", {
			slidesPerView: 1,
			spaceBetween: 30,
			touchStartPreventDefault: false,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			breakpoints: {
				780: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: "auto",
				}
			}
		});
	</script>
</section>

<section class="classes-and-events section flex-row">
	<div class="half">
		<figure class="wp-block-image size-large">
			<img loading="lazy" width="30" height="30" src="/wp-content/uploads/2022/06/class-icon.svg" alt="">
		</figure>
		<h4>CLASSES AND EVENTS</h4>
		<h3>Get involved</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<a class="wp-block-read-more arrow-link" href="https://ecomrkt.com/" target="_self"><strong>View our full calendar of events</strong></a>
	</div>
	<div class="half">
		<?php echo do_shortcode( '[tribe_events view="list" tribe-bar="false" events_per_page="1"]' ), '</div>'; ?>
	</div>
</section>

<section class="section providers dual-section green">
	<div class="flex-row">
		<div class="half">
			<h2>Our providers</h2>
		</div>
		<div class="half">
			<span class="search">Search or browse hospital providers</span>
			<div class="search-bar">
				<form action="" id="search-providers" class="search-bar-form flex-row">
					<input type="image" src="/wp-content/uploads/2022/06/search-icon.svg">
					<input type="text" name="search" placeholder="Search by first or last name">
				</form>
			</div>
		</div>
	</div>
    <?php 
        $args = array (
            'post_type'              => 'provider',
            'orderby'                => 'none',
            'meta_query'	=> array(
				'relation'		=> 'OR',
				array(
					'key'	 	=> 'provider_mora_campus_details',
					'value'	  	=> get_the_ID(),
					'compare' 	=> 'LIKE',
				),
				array(
					'key'	 	=> 'provider_hinckley_campus_details',
					'value'	  	=> get_the_ID(),
					'compare' 	=> 'LIKE',
				),
				array(
					'key'	 	=> 'provider_pine_city_campus_details',
					'value'	  	=> get_the_ID(),
					'compare' 	=> 'LIKE',
				),
			),
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) : ?>
        	<div class="swiper providers-swiper slides-auto">
            	<div class="swiper-wrapper">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $locations = ucwords( str_replace( "_", " ", implode( ", ", get_field( "provider_locations" ) ) ) ); ?>
					<div class="swiper-slide">
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
					</div>
            <?php endwhile ?>
            	</div>
            	<div class="swiper-pagination green"></div>
       		</div>
			<script>
				var swiper2 = new Swiper(".providers-swiper", {
					slidesPerView: "auto",
					spaceBetween: 30,
					touchStartPreventDefault: false,
					pagination: {
						el: ".swiper-pagination",
						clickable: true,
					},
				});
			</script>
        <?php endif;
    
        wp_reset_postdata() ?>
    <div class="description tablet"><?php the_field( 'description' ) ?></div>
</section>

<section class="section locations related-locations">
    <img src="/wp-content/uploads/2022/06/location-icon.svg" width="25px" height="25px">
    <h4>OTHER LOCATIONS</h4>
    <h3>Also on the <?= $category->name ?> Campus</h3>
    <div class="swiper locations-swiper slides-auto start">
        <div class="swiper-wrapper">
            <?php 
			$args = array (
				'post_type'              => 'location',
				'orderby'                => 'none',
				'tax_query'              => array(
												array(
													'taxonomy' => 'location-category',
													'field'    => 'term_id',
													'terms'    => $category->term_id
												)
											)
			);

			$query = new WP_Query( $args );
		
			while ( $query->have_posts() ) : $query->the_post();?>
                <div class="swiper-slide">
                    <div class="location-card">
                        <div class="card-image">
                            <?php the_post_thumbnail( 'medium' ) ?>
                        </div>
                        <div class="card-content flex-column">
                            <h5><?php the_title() ?></h5>
                            <span class="before-icon address"><?php the_field( 'location_address' ) ?></span>
                            <span class="before-icon"><?php the_field( 'location_description' ) ?></span>
                            <span class="before-icon"><?php the_field( 'location_hours' ) ?></span>
                            <div class="flex-row links">
                                <a href="tel:<?php the_field( 'location_phone' ) ?>" class="before-icon phone"><?php the_field( 'location_phone' ) ?></a>
                                <a href="#" class="before-icon directions">Directions</a>
                            </div>
                            <div class="flex-row card-buttons">
                                <div class="filled-button blue white wp-block-button arrow-link">
                                    <a href="<?php the_permalink() ?>" class="wp-block-button__link">Details</a>
                                </div>
                                <div class="filled-button blue white wp-block-button arrow-link">
                                    <a href="#" class="wp-block-button__link">Schedule an appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; 
				wp_reset_postdata() ?>			
        </div>
        <div class="swiper-pagination blue"></div>
    </div>
	<script>
		var swiper3 = new Swiper(".locations-swiper", {
			slidesPerView: 1,
			spaceBetween: 30,
			touchStartPreventDefault: false,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			breakpoints: {
				780: {
					slidesPerView: "auto",
				}
			}
		});
	</script>
	<div class="communities">
		<h3>Communities we serve</h3>
		Welia Healt - <?php the_title() ?> serves the following communities: <?php the_field( 'location_communities' ) ?>
	</div>	
</section>

<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/assets/css/glightbox.min.css" />
<script src="<?= get_stylesheet_directory_uri() ?>/assets/js/glightbox.min.js"></script>

<section class="section location-gallery">
	<h3><?php the_title() ?> in photos</h3>
	<div class="swiper gallery-swiper">
        <div class="swiper-wrapper">
            <?php 
			foreach ( get_field( 'location_photo_gallery' ) as $image ) : ?>
                <div class="swiper-slide">
                    <a href="<?= $image ?>" class="glightbox" data-gallery="gallery1">
					  <img src="<?= $image ?>" alt="<?php the_title() ?> Gallery Photo"/>
					</a>
                </div>
            <?php endforeach ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
	<script>
		var swiper4 = new Swiper(".gallery-swiper", {
			slidesPerView: 1,
			spaceBetween: 30,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			breakpoints: {
				780: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				}
			}
		});
		
		const lightbox = GLightbox({
			touchNavigation: true,
			loop: true,
			autoplayVideos: true
		});
	</script>
</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<?php

get_template_part( 'template-parts/take-action' );
get_footer();