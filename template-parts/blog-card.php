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