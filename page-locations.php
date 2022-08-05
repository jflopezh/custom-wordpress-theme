<?php
/* 
 *  Template Name: Locations
 */
get_header();

$categories = get_terms( 'location-category' );
?>

<section class="section dual-hero right-background flex-row">
    <div class="hero-content half">
        <h1><?php the_title() ?></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <p>Mora  |  Hinckely  |  Pine City</p>
    </div>
    <div class="half background" style="background-image: url('/wp-content/uploads/2022/07/map.jpg')">
		<?php echo do_shortcode( '[wpgmza id="1"]' ); ?>
	</div>
</section>

<section class="locations-archive locations section">
    <?php foreach ( $categories as $category ) :
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

                if ( $query->have_posts() ) : ?>
                    <div class="<?= $category->slug ?>-locations">
                        <h2><?= $category->name?></h2>
                            <div class="locations-wrapper locations-swiper flex-row">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="location-card">
                            <div class="card-image">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div>
                            <div class="card-content flex-column">
                                <h5><?php the_title(); ?></h5>
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
                    <?php endwhile; ?>
                    </div>
                <? endif;
                
                wp_reset_postdata();
            ?>
        </div>
    <?php endforeach; ?>
</section>

<?php 
get_template_part( 'template-parts/take-action' );
get_footer();
?>

<script>
	jQuery(document).ready(function() {
		if (jQuery( window ).width() > 780) {
			jQuery(".hero-content").eq(0).outerHeight(jQuery(".background").eq(0).outerHeight());
		}
	});
</script>