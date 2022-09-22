<?php
/*add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('rest-ajax', get_stylesheet_directory_uri() . '/assets/rest-ajax.js', '', '', true);
});*/

class WPC_REST extends WP_REST_Controller
{

    public function register_routes()
    {
        register_rest_route('welia-ajax/v1', '/blog-posts', ['methods' => WP_REST_Server::READABLE, 'callback' => [$this, 'get_blog_posts']]);

        /*register_rest_route('welia-ajax/v1', '/services', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => [$this, 'get_services']
        ]);*/
        
        register_rest_route('welia-ajax/v1', '/providers', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => [$this, 'get_providers']
        ]);
        
        /*register_rest_route('welia-ajax/v1', '/locations', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => [$this, 'get_locations']
        ]);*/
    }

    public function get_blog_posts($request)
    {
		$query = $this->get_filtered_posts_query($request);
		if (!$query->have_posts()) {
			return 0;
		}
		
		ob_start();
		
		while ( $query->have_posts() ) : $query->the_post() ?>
            <div class="blog-card">
				<div class="date flex-column">
					<span class="month"><?= get_the_date( 'M' ) ?></span>
					<span class="day"><?= get_the_date( 'd' ) ?></span>
					<span class="year"><?= get_the_date( 'Y' ) ?></span>
				</div>
				<a href="<?= get_permalink() ?>">
					<div class="img-container">
						<?php the_post_thumbnail() ?>
					</div>
				</a>
				<div class="post-categories">
					<?php $categories = get_the_category(); ?>
					<a href="<?= get_term_link( $categories[ 0 ] ) ?>"><?= $categories[ 0 ]->name ?></a>
					<?php for ( $i = 1; $i < count($categories); $i++ ) { ?>
						<a href="<?= get_term_link( $categories[ $i ] ) ?>"><?= ', ' . $categories[ $i ]->name ?></a>
					<?php } ?>
				</div>
				<div class="card-content flex-column">
					<a href="<?= get_permalink() ?>">
						<h3><?php the_title() ?></h3>
					</a>
					<div class="excerpt"><?php echo wp_strip_all_tags( get_the_excerpt() ) . ' [...]'; ?></div>
					<div class="wp-block-button arrow-link filled-button pink white" data-page="1">
						<a href="<?= get_permalink() ?>" class="wp-block-button__link">Read more</a>
					</div>
				</div>
			</div>
        <?php endwhile;
		wp_reset_postdata();

        $response = new WP_REST_Response(ob_get_contents());
        $response->set_status(200);
		
		ob_end_clean();
		
        return $response;
    }
	
	public function get_providers($request) {
		$query = $this->get_filtered_posts_query($request);
		if (!$query->have_posts()) {
			return 0;
		}
		
		ob_start();
		
		while ( $query->have_posts() ) : $query->the_post();
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
		<?php endwhile;
		wp_reset_postdata();
		
		$response = new WP_REST_Response(ob_get_contents());
        $response->set_status(200);
		
		ob_end_clean();
		
        return $response;
	}

    private function get_filtered_posts_query($request)
    {
        $args = array(
            'post_type' => $request['post_type'],
            'posts_per_page' => $request['per_page'],
            'page' => $request['page'],
        );
						  
		if (isset($request['keyword'])) {
			$args['s'] = $request['keyword'];
		}

		if (isset($request['key'])) {
			$args['meta_query'] = 	array(
										array(
											'key' => $request['key'],
											'value' => $request['value'],
											'compare' => 'LIKE',
										)
									);
			
		}
		if (isset($request['key2'])) {
			$args['meta_query']['relation'] = 'AND';
			array_push($args['meta_query'], array(
												'key' => $request['key2'],
												'value' => $request['value2'],
												'compare' => 'LIKE',
											));
		}
		if (isset($request['taxonomy'])) {
			$termIDs = get_terms(['taxonomy' 	=> 	$request['taxonomy'],
									  'name__like' 	=> 	$request['term'],
									  'fields' 		=> 	'ids', ]);
			
			if ($request['taxonomy'] == 'category') {
				$args['cat'] = $termIDs;
			} else {
				$args['tax_query'] = 	array(
											'taxonomy' 	=> $request['taxonomy'],
											'field'		=> 'term_id',
											'terms' 	=> $termIDs,
										);
			}
        }

        return new WP_Query($args);
    }
}

add_action('rest_api_init', function ()
{
    if (class_exists('WPC_REST'))
    {
        $controller = new WPC_REST();
        $controller->register_routes();
    }
});
