<?php
/* 
 *  Template Name: Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>

<section class="section connections">
	<div>
        <span class="blue">Welia Health</span>
        <span class="pink">&nbsp;Connections</span>
        <span class="subtitle">helping you live life well</span>
	</div>
</section>

<section class="filters section">
    <div class="flex-column">
		<div>
			<h1>At Welia Health, we are committed to helping our communities live life well.</h1>
			<p>We invite you to bookmark this page to explore our growing library of health and wellness posts.</p>
		</div>
		<div>
			<span>Search, sort, subscribe</span>
			<div class="search-bar">
				<form action="" id="search-posts" class="search-bar-form flex-row">
					<input type="image" src="/wp-content/uploads/2022/07/search-pink-icon.svg" width="50px">
					<input type="text" name="search" placeholder="Fever">
				</form>
			</div>
			<div class="search-bar">
				<form action="" id="search-posts-cat" class="search-bar-form flex-row">
					<input type="image" src="/wp-content/uploads/2022/07/filter-pink-icon.svg" width="50px">
					<input type="text" name="search" placeholder="Filter by Category">
				</form>
			</div>
			<div class="search-bar">
				<form action="" id="subscribe" class="search-bar-form flex-row">
					<input type="image" src="/wp-content/uploads/2022/07/mail-pink-icon.svg" width="50px">
					<input type="text" name="search" placeholder="Email address to subscribe">
				</form>
			</div>
		</div>
    </div>
</section>

<section class="blog-archive section blog">
    <div id="posts-wrapper" class="flex-row">
		<span class="fill tablet"></span>
        <?php 
			$args = [
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 5,
			];

			$query = new WP_Query( $args );

			$max_pages = ceil( $query->found_posts / 5 );
		 ?>
        <?php while ( $query->have_posts() ) : 
			$query->the_post();
            get_template_part( 'template-parts/blog-card' );
        endwhile;
		wp_reset_postdata() ?>
    </div>
	<?php if ( $max_pages > 1) : ?>
		<div id="load-more" class="wp-block-button arrow-link filled-button pink white" data-page="1" data-max-pages="<?= $max_pages ?>">
			<a class="wp-block-button__link">Load more articles</a>
		</div>
	<?php endif ?>
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