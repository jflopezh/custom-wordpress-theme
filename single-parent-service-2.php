<?php
/* 
 *  Template Name: Parent Service 2
 *  Template Post Type: parent-service
 */

get_header();
?>

<section class="section background-img-hero dual-hero flex-row .no-stack-mobile" style="background-image: url('<?php the_post_thumbnail_url( 'large' ) ?>');">
    <div class="hero-content half">
        <h1><?php the_title() ?> services</h1>
        <p><?php the_field( 'hero_text' ) ?></p>
    </div>
    <div class="half"></div>
</section>

<?php if ( get_field( 'display_schedule_button' ) ) : ?>
	<div class="schedule arrow-link wp-block-button filled-button white blue">
		<a href="#" class="wp-block-button__link">Schedule an appointment</a>
	</div>
<?php endif ?>

<section class="section providers dual-section-65 green">
	<div class="head flex-row">
		<div class="half">
			<h2><?php the_field( 'providers_title' ) ?></h2>
		</div>
		<div class="half">
			<div class="description"><?php the_field( 'description' ) ?></div>
		</div>
	</div>
	<span class="search"><?php the_field( 'search_providers' ) ?></span>
	<div class="search-bar">
		<form action="" id="search-providers" class="search-bar-form flex-row">
			<input type="image" src="/wp-content/uploads/2022/06/search-icon.svg">
			<input type="text" name="search" placeholder="Search by first or last name">
		</form>
	</div>
    <?php 
        $args = array (
            'post_type'              => 'provider',
            'orderby'                => 'none',
            'tax_query'              => array(
                                            array(
                                                'taxonomy' => 'provider-category',
                                                'field'    => 'term_id',
                                                'terms'    => get_field( 'providers_categories' )
                                            )
                                        )
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
				var swiper = new Swiper(".providers-swiper", {
					slidesPerView: "auto",
					spaceBetween: 30,
					pagination: {
						el: ".swiper-pagination",
						clickable: true,
					},
				});
			</script>
        <?php endif;
    
        wp_reset_postdata() ?>
</section>

<section class="section left-background dual-hero services flex-row">
    <div class="half background" style="background-image: url('<?php the_field( 'services_image' ) ?>');">
    </div>
    <div class="right">
        <h2>Explore <?php the_title() ?> services</h2>
        <div class="services-container">
            <?php foreach( get_field( 'services' ) as $service ) : ?>
            	<a href="<?= $service[ 'link' ] ?>" class="before-icon"><?= $service[ 'service' ] ?></a>
            <?php endforeach ?>
        </div>
        <div class="search-bar">
            <form action="" id="search-services" class="search-bar-form flex-row">
                <input type="image" src="/wp-content/uploads/2022/06/search-icon.svg">
                <input type="text" name="search" placeholder="<?php the_field( 'services_searchbar_placeholder' ) ?>">
            </form>
        </div>
    </div>
</section>

<?php if( have_rows( 'faqs' ) ) : ?>
	<section class="section parent-service-faqs">
		<img src="/wp-content/uploads/2022/06/info-square-icon.svg" width="25px" height="25px">
		<h4>FAQs</h4>
		<h3>What patients are asking about <?php the_title() ?> services</h3>
		<div class="faqs-container">
			<?php foreach ( get_field( 'faqs' ) as $key => $faq ) { ?>
				<div class="faq">
					<div class="question" data-answer="<?php echo $key ?>">
						<h5 class="after-icon flex-row"><?php echo $faq['faq_question']; ?></h5>
					</div>
					<div id="answer<?php echo $key ?>" class="answer">
						<p><?php echo $faq['faq_answer']; ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>
<?php endif ?>

<section class="section blog dual-section-30 pink">
    <?php
        $args = array (
            'post_type'              => 'post',
            'nopaging'               => false,
            'posts_per_page'         => '12',
            'order'                  => 'DESC',
            'orderby'                => 'date',
            'cat'          => implode( ',', get_field( 'blog_categories' ) )
        );
        
        $query = new WP_Query( $args );
    
        if ( $query->have_posts() ) : ?>
            <div class="swiper blog-swiper">
            	<div class="swiper-wrapper">
					<?php while ( $query->have_posts() ) : $query->the_post();
						$categories = get_the_category(); ?>
						<div class="swiper-slide">
							<div class="blog-card">
								<a href="<?= get_permalink() ?>">
									<div class="img-container">
										<?= get_the_post_thumbnail() ?>
									</div>
								</a>
								<div class="card-content flex-column">
									<div class="post-categories">
										<?php echo '<a href="' . get_term_link( $categories[ 0 ] ) . '">' . $categories[ 0 ]->name . '</a>';
										for ( $i = 1; $i < count($categories); $i++ ) :
											echo ', <a href="' . get_term_link( $categories[ $i ] ) . '">' . $categories[ $i ]->name . '</a>';
										endfor ?>
									</div>
									<a href="<?= get_permalink() ?>">
										<h3><?= get_the_title() ?></h3>
									</a>
								</div>
							</div>
						</div>
					<?php endwhile ?>
            	</div>
				<div class="swiper-pagination pink"></div>
			</div>
			<script>
				var swiper = new Swiper(".blog-swiper", {
					slidesPerView: 1,
					spaceBetween: 30,
					pagination: {
						el: ".swiper-pagination",
						clickable: true,
					},
					breakpoints: {
						780: {
							slidesPerView: 2,
							spaceBetween: 20
						}
					}
				});
			</script>
        <?php endif;
    
        wp_reset_postdata();
    ?>

    <div class="filled-button white pink wp-block-button arrow-link">
        <a href="" class="wp-block-button__link">Read more from the blog</a>
    </div>
</section>

<?php get_template_part( 'template-parts/newsletter-subscription' ) ?>

<section class="section locations">
    <img src="/wp-content/uploads/2022/06/location-icon.svg" width="25px" height="25px">
    <h4>LOCATIONS </h4>
    <h3>Where we provide <?php the_title() ?> services</h3>
    <div class="swiper locations-swiper">
        <div class="swiper-wrapper">
            <?php foreach ( get_field( 'locations' ) as $location ) { ?>
                <div class="swiper-slide">
                    <div class="location-card">
                        <div class="card-image">
                            <?php echo get_the_post_thumbnail( $location, 'medium' ); ?>
                        </div>
                        <div class="card-content flex-column">
                            <h5><?php echo get_the_title( $location ); ?></h5>
                            <span class="before-icon address"><?php the_field( 'location_address', $location ) ?></span>
                            <span class="before-icon"><?php the_field( 'location_description', $location ) ?></span>
                            <span class="before-icon"><?php the_field( 'location_hours', $location ) ?></span>
                            <div class="flex-row links">
                                <a href="tel:<?php the_field( 'location_phone', $location ) ?>" class="before-icon phone"><?php the_field( 'location_phone', $location ) ?></a>
                                <a href="#" class="before-icon directions">Directions</a>
                            </div>
                            <div class="flex-row card-buttons">
                                <div class="filled-button blue white wp-block-button arrow-link">
                                    <a href="<?php the_permalink( $location ) ?>" class="wp-block-button__link">Details</a>
                                </div>
                                <div class="filled-button blue white wp-block-button arrow-link">
                                    <a href="#" class="wp-block-button__link">Schedule an appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination blue"></div>
    </div>
</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".locations-swiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            780: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        }
    });
</script>

<?php

get_template_part( 'template-parts/take-action' );
get_footer();