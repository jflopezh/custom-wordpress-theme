<?php
/* 
 *  Template Name: Provider 
 *  Template Post Type: provider
 */
     
$locations = get_field( 'provider_locations' );

get_header();
?>

<section class="section provider">
    <div class="mobile basic-info">
        <h1 class="name"><?php echo get_the_title(), ', ', get_field( 'provider_primary_credentials' ); ?></h1>
        <span class="category"><?= get_the_terms( get_the_ID(), 'provider-category' )[0]->name ?></span> &nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="specialty"><?php the_field( 'provider_primary_specialty' ) ?></span>
    </div>
    <div class="introduce flex-row relative">
        <div class="photo">
			<img src="<?php the_field( 'provider_photo' ) ?>" width="250px" height="250px">
        </div>
        <div class="flex-column">
            <div class="basic-info">
                <h1 class="name"><?php echo get_the_title(), ', ', get_field( 'provider_primary_credentials' ); ?></h1>
                <span class="category"><?= get_the_terms( get_the_ID(), 'provider-category' )[0]->name ?></span> | 
                <span class="specialty"><?php the_field( 'provider_primary_specialty' ) ?></span>
            </div>
            <div class="cta wp-block-button arrow-link arrow-link blue white">
                <a href="#" class="wp-block-button__link">Schedule an appointment</a>
            </div>
        </div>
    </div>
</section>

<section class="section provider-details flex-row">
    <div class="quotes flex-column">
        <img src="/wp-content/uploads/2022/06/quot-icon.svg" width="20px">
        <h4>PROVIDER QUOTES</h4>
        <h3>Advice I give my patients</h3>
        <div class="quote flex-row">
            <img src="/wp-content/uploads/2022/06/quot-icon.svg" width="40px">
            <div class="flex-column relative">
                <img class="mobile" src="/wp-content/uploads/2022/06/quot-icon.svg" width="40px">
                <p>"<?php the_field("provider_advice") ?>"</p>
                <span>~ <?php echo get_the_title(), ', ', get_field( 'provider_primary_credentials' ); ?></span>
            </div>
        </div>
    </div>
    <div class="locations-contact flex-column blue">
        <div class="contact-cards-wrapper">
        <?php
            foreach ( $locations as $location ) {
                $location_output = ucwords( str_replace( "_" ," " , $location ) );
                $location_details = get_field( 'provider_' . $location . '_campus_details' );
                foreach ( $location_details as $detail ) { 
                    $location_post = get_page_by_title( $location_output . ' ' . $detail , OBJECT, 'location' );
                    if ( $location_post != null ) : ?>
                        <div class="contact-card">
                            <div class="location flex-row">
                                <img src="/wp-content/uploads/2022/06/location-icon.svg" width="40px" height="40px">
								<a href="<?php get_permalink( $location_post ) ?>"><h3><?= get_the_title( $location_post ) ?></h3></a>
                            </div>
                            <div class="details flex-row">
                                <a href="tel: <?php the_field( 'location_phone', $location_post->ID ) ?>" class="phone">
                                    <button>
                                        <?php the_field( 'location_phone', $location_post->ID ) ?>
                                        <img src="/wp-content/uploads/2022/06/phone-icon.svg" width="16px" height="16px">
                                    </button>
                                </a>
                                <a href="<?php get_permalink( $location_post ) ?>" class="directions">
                                    <button>
                                        Directions
                                        <img src="/wp-content/uploads/2022/06/directions-icon.svg" width="16px" height="16px">
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php endif; 
                }
            }
        ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="section provider-info">
    <div class="info-row">
        <h2>About Me</h2>
        <table>
            <tr>
                <td>Medical interests</td>
                <td><?php the_field( 'provider_specialties' ); ?></td>
            </tr>
            <tr>
                <td>In practice since</td>
                <td><?php the_field( 'provider_first_year_practicing' ) ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?php the_field( 'provider_gender' ) ?></td>
            </tr>
        </table>
    </div>
    <div class="info-row">
        <h2>Education and background</h2>
        <table>
            <tr>
                <td>Education</td>
                <td><?php the_field( 'provider_education' ) ?></td>
            </tr>
            <tr>
                <td>Additional Training</td>
                <td><?php the_field( 'provider_additional_training' ) ?></td>
            </tr>
            <tr>
                <td>Certifications</td>
                <td><?php the_field( 'provider_certifications' ) ?></td>
            </tr>
            <tr>
                <td>Licenses</td>
                <td><?php the_field( 'provider_licenses' ) ?></td>
            </tr>
            <tr>
                <td>Professional Accomplishments</td>
                <td><?php the_field( 'provider_professional_interests_or_additional_accomplishments' ) ?></td>
            </tr>
        </table>
    </div><div class="info-row">
        <h2>Where I practice</h2>
        <table>
            <?php                
                foreach ( $locations as $location ) {
                    $location_output = ucwords( str_replace( "_" ," " , $location ) );
                    $location_details = get_field( 'provider_' . $location . '_campus_details' );
                    echo    '<tr>
                                <td>' . $location_output . '</td>
                                <td>' . $location_output . ' ' . $location_details[ 0 ] . '</td>
                            </tr>';
                    for ( $i = 1; $i < count( $location_details ); $i++) {
                        echo '<tr>
                                <td></td>
                                <td>' . $location_output . ' ' . $location_details[ $i ] . '</td>
                            </tr>';
                    }
                }
            ?>
        </table>
    </div><div class="info-row">
        <table>
            <tr>
                <td class="notes"><h2>Notes</h2></td>
                <td><?php the_field( 'provider_notes' ) ?></td>
            </tr>
        </table>
    </div>
</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    if (jQuery(window).width() < 780) {
        jQuery(".locations-contact").eq(0).addClass("swiper");
        jQuery(".contact-cards-wrapper").eq(0).addClass("swiper-wrapper");
        jQuery(".contact-card").addClass("swiper-slide");
        var swiper = new Swiper(".locations-contact", {
        slidesPerView: "auto",
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        });
    }
</script>

<?php 
	
get_template_part( 'template-parts/take-action' );	
get_footer();