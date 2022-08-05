<?php
/**
 * Welia Health Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Welia Health
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_WELIA_HEALTH_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'welia-health-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_WELIA_HEALTH_VERSION, 'all' );

}

/**
 * Register Custom Post Types and Taxonomies
 */
include 'includes/custom-post-types-and-taxonomies.php';

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function enqueue_welia_scripts() {
    wp_register_script( 'welia_scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), CHILD_THEME_WELIA_HEALTH_VERSION, false );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-core'); 
    wp_enqueue_script( 'welia_scripts' );

	wp_localize_script( 'welia_scripts', 'siteConfig', [
		'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
		'ajax_nonce' => wp_create_nonce( 'loadmore_post_nonce' ),
	] );
}

add_action( 'wp_enqueue_scripts', 'enqueue_welia_scripts', 15);

function add_type_attribute($tag, $handle, $src) {
    if ( 'welia_scripts' !== $handle ) {
        return $tag;
    }
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

function register_menus() {
	register_nav_menus([
		'main_menu' => __( 'Main Menu', 'welia-health' ),
		'desktop_user_menu' => __( 'Desktop User Menu', 'welia-health' ),
		'desktop_action_menu' => __( 'Desktop Action Menu', 'welia-health' ),
		'tablet_user_menu' => __( 'Tablet User Menu', 'welia-health' ),
		'mobile_user_menu' => __( 'Mobile User Menu', 'welia-health' ),
        'footer_menu' => __( 'Footer Menu', 'welia-health' ),
	]);
}

add_action( 'init', 'register_menus' );

function wpbsearchform( $form ) {
   
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="image" src="'. get_site_url() .'/wp-content/uploads/2022/06/search-icon.png" alt="Submit Form" width="25px" height="25px"/>
    <input type="text" placeholder="Site Search" value="' . get_search_query() . '" name="s" id="s" />
    </div>
    </form>';
   
    return $form;
}
   
add_shortcode('wpbsearch', 'wpbsearchform');

function full_site_search( $form ) {
   
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="image" src="'. get_site_url() .'/wp-content/uploads/2022/06/search-icon.png" alt="Submit Form" width="25px" height="25px"/>
    <input type="text" placeholder="What are you looking for?" value="' . get_search_query() . '" name="s" id="s" />
    </div>
    </form>';
   
    return $form;
}
   
add_shortcode('full_site_search', 'full_site_search');

function recent_blog_posts( $atts ) {
	$output = '';

	$args = array (
		'post_type'              => 'post',
		'nopaging'               => false,
		'posts_per_page'         => $atts['quantity'],
		'order'                  => 'DESC',
		'orderby'                => 'date',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		$output .= '<div class="swiper blog-swiper">
						<div class="swiper-wrapper">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$output .= '<div class="swiper-slide">
							<div class="blog-card">
								<a href="'. get_permalink() .'">
									<div class="img-container">
										'. get_the_post_thumbnail() .'
									</div>
								</a>
								<div class="card-content flex-column">
									<div class="post-categories">';
			$categories = get_the_category();
			$output .= 					'<a href="'. get_term_link( $categories[ 0 ] ) .'">'. $categories[ 0 ]->name .'</a>';
			for ( $i = 1; $i < count($categories); $i++ ) {
				$output .= 				', <a href="'. get_term_link( $categories[ $i ] ) .'">'. $categories[ $i ]->name .'</a>';
			}
			$output .=				'</div>
									<a href="'. get_permalink() .'">
										<h3>'. get_the_title() .'</h3>
									</a>
								</div>
							</div>
						</div>';
		}
		$output .= '	</div>
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
									spaceBetween: 30
								}
							}
						});
					</script>';
	}

	wp_reset_postdata();

	return $output;
}

add_shortcode( 'recent_blog_posts', 'recent_blog_posts' );

/*
 * Load More Posts
 */
function ajax_script_post_load_more( bool $initial_request = false ) {
	if ( ! $initial_request && ! check_ajax_referer( 'loadmore_post_nonce', 'ajax_nonce', false ) ) {
		wp_send_json_error( __( 'Invalid security token sent.', 'text-domain' ) );
		wp_die( '0', 400 );
	}

	$is_ajax_request = ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
						strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';
	$page_no = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$page_no = ! empty( $_POST['page'] ) ? filter_var( $_POST['page'], FILTER_VALIDATE_INT ) + 1 : $page_no;

	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 5, // Number of posts per page - default
		'paged'          => $page_no,
		'cat'			 => $_POST['cat'],
	];

	$query = new WP_Query( $args );;

	if ( $query->have_posts() ):
		while ( $query->have_posts() ): $query->the_post(); ?>
			<div class="blog-card">
                <div class="date flex-column">
                    <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                    <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                    <span class="year"><?php echo get_the_date( 'Y' ) ?></span>
                </div>
				<a href="<?php echo get_permalink() ?>">
					<div class="img-container">
						<?php the_post_thumbnail() ?>
					</div>
				</a>
                <div class="post-categories">
                    <?php $categories = get_the_category(); ?>
                    <a href="<?php echo get_term_link( $categories[ 0 ] ) ?>"><?php echo $categories[ 0 ]->name ?></a>
                    <?php for ( $i = 1; $i < count($categories); $i++ ) { ?>
                        <a href="<?php echo get_term_link( $categories[ $i ] ) ?>"><?php echo ', ' . $categories[ $i ]->name ?></a>
                    <?php } ?>
                </div>
				<div class="card-content flex-column">
                    <a href="<?php echo get_permalink() ?>">
                        <h3><?php the_title(); echo $catid?></h3>
                    </a>
                    <div class="excerpt"><?php echo wp_strip_all_tags( get_the_excerpt() ) . ' [...]'; ?></div>
					<div class="wp-block-button arrow-link filled-button pink white" data-page="1">
						<a href="<?php echo get_permalink() ?>" class="wp-block-button__link">Read more</a>
					</div>
				</div>
			</div>
		<?php endwhile;
	else:
		wp_die( '0' );
	endif;

	wp_reset_postdata();

	if ( $is_ajax_request && ! $initial_request ) {
		wp_die();
	}
}

add_action( 'wp_ajax_nopriv_load_more', 'ajax_script_post_load_more' );
add_action( 'wp_ajax_load_more', 'ajax_script_post_load_more' );

/*
 * Filter excerpt
 */
function mytheme_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );

function new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length($excerpt) {
    return $excerpt = wp_trim_words(wp_strip_all_tags( $excerpt ), 20);
}
add_filter("get_the_excerpt", "custom_excerpt_length", 999);