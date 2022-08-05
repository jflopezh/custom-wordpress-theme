<?php
/* 
 *  Template Name: Post
 *  Template Post Type: post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<section class="section post-image">
    <div class="relative">
        <?php the_post_thumbnail( 'full' ); ?>
        <div class="date flex-column">
            <span class="month"><?php echo get_the_date( 'M' ) ?></span>
            <span class="day"><?php echo get_the_date( 'd' ) ?></span>
            <span class="year"><?php echo get_the_date( 'Y' ) ?></span>
        </div>
    </div>
</section>

<section class="section post">
    <div class="container">
        <h1><?php the_title() ?></h1>
        <div class="meta">
            <span><?php the_date() ?>&nbsp;&nbsp;/&nbsp;&nbsp;</span>
            <span><?php the_category( ", " ) ?>&nbsp;&nbsp;/&nbsp;&nbsp;</span>
            <span><?php echo round( ( str_word_count(trim( get_the_content() ) ) ) / 300 ) . '-minute read'; ?></span>
        </div>
		<?php if ( get_field( 'show_blog_byline' ) ) : ?>
			<div class="author flex-row">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), "100x100" ); ?>
				<div class="author-info flex-column">
					<h5 class="name"><?php the_author() ?>, MD</h5>
					<span class="category">Family Medicine</span>
					<div class="arrow-link wp-block-button filled-button white pink">
						<a href="#" class="wp-block-button__link">Full bio</a>
					</div>
				</div>
			</div>
		<?php endif ?>
        <div class="content">
            <?php the_content() ?>
        </div>
    </div>
</section>

<section class="section blog">
    <img src="/wp-content/uploads/2022/07/lecture-icon.svg" width="25px" height="25px">
    <h4>Welia Health Connections</h4>
    <h3>Read related articles</h3>
    <?php
        $args = array (
            'post_type'              => 'post',
            'nopaging'               => false,
            'posts_per_page'         => '12',
            'order'                  => 'DESC',
            'orderby'                => 'date',
            'cat'          => implode( ',', wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) ) )
        );
    
        $query = new WP_Query( $args );
    
        if ( $query->have_posts() ) {
            echo '<div class="swiper blog-swiper">
                            <div class="swiper-wrapper">';
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<div class="swiper-slide">
                                <div class="blog-card">
                                    <a href="'. get_permalink() .'">
                                        <div class="img-container">
                                            '. get_the_post_thumbnail() .'
                                        </div>
                                    </a>
                                    <div class="card-content flex-column">
                                        <div class="post-categories">';
                $categories = get_the_category();
                echo 					'<a href="'. get_term_link( $categories[ 0 ] ) .'">'. $categories[ 0 ]->name .'</a>';
                for ( $i = 1; $i < count($categories); $i++ ) {
                    echo 				', <a href="'. get_term_link( $categories[ $i ] ) .'">'. $categories[ $i ]->name .'</a>';
                }
                echo				'</div>
                                        <a href="'. get_permalink() .'">
                                            <h3>'. get_the_title() .'</h3>
                                        </a>
                                    </div>
                                </div>
                            </div>';
            }
            echo '	</div>
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
                                    },
                                    1024: {
                                        slidesPerView: 3,
                                        spaceBetween: 20
                                    }
                                }
                            });
                        </script>';
        }
    
        wp_reset_postdata();
    ?>
</section>

<?php get_template_part( 'template-parts/newsletter-subscription' ) ?>

<section class="section explore flex-row">
    <div class="blue wp-block-button arrow-link mobile">
        <a href="" class="wp-block-button__link">Visit the birthing center</a>
    </div>
    <div class="image half">

    </div>
    <div class="half right">
        <img src="/wp-content/uploads/2022/07/explore-icon.svg" width="30px" height="30px">
        <h4>EXPLORE THE SITE</h4>
        <h3>The birthing center</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        <div class="flex-row">
			<div class="blue wp-block-button arrow-link">
				<a href="" class="wp-block-button__link">Visit the birthing center</a>
			</div>
			<div class="blue wp-block-button arrow-link desktop">
				<a href="" class="wp-block-button__link">Schedule appointment</a>
			</div>
		</div>
    </div>
</section>

<?php get_footer(); ?>