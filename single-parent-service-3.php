<?php
/* 
 *  Template Name: Parent Service 3
 *  Template Post Type: parent-service
 */

get_header();
?>

<section class="section services flex-row">
    <div class="half left">
		<h1><?php the_title() ?></h1>
        <div class="description"><?php the_field( 'description' ) ?></div>
    </div>
    <div class="half right">
        <h2>Explore <?php the_title() ?> services</h2>
        <div class="services-container">
            <?php foreach( get_field( 'services' ) as $service ) : ?>
            	<a href="<?= $service[ 'link' ] ?>" class="before-icon"><?= $service[ 'service' ] ?></a>
            <?php endforeach ?>
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
        centeredSlides: true,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        /*breakpoints: {
            780: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        }*/
    });
</script>

<?php

get_template_part( 'template-parts/take-action' );
get_footer();