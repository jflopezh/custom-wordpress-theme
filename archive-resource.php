<?php
/* 
 *  Template Name: Resources
 */

get_header();

$categories = get_terms( [ 'taxonomy' => 'resource-category', 'hide_empty' => false, 'orderby'  => 'id' ] ); 
?>

<section class="resources section">
	<h1>Patient and visitor resources</h1>
	<div class="flex-row">
		<p>Find important information you may need whether you are a Welia Health patient or caregiver, family or loved one.</p>
		<form action="" class="search-bar-form flex-row">
			<input type="image" class="select" src="/wp-content/uploads/2022/08/select-white-icon.svg" width="40px">
			<select id="select-resource" name="resources">
				<option value="" disabled selected>Select resource</option>
				<?php foreach( $categories as $category ) : ?>
					<option value="<?= get_term_link( $category ) ?>"><?= $category->name ?></option>
				<?php endforeach ?>
			</select>
		</form>
	</div>
	<div class="resources-wrapper wrapper">
		<?php foreach( $categories as $category ) : ?>
			<div class="icon-card flex-column">
				<img src="<?= get_field( 'icon', $category ) ?>">
				<h5><?= $category->name ?></h5>
				<span class="description"><?= $category->description ?></span>
				<div class="filled-button blue wp-block-button" style="--color: <?= get_field( 'color', $category ) ?>;">
					<a href="<?= get_term_link( $category ) ?>" class="wp-block-button__link"><?= get_field( 'button_text', $category ) ?></a>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<div class="flex-row">
		<h5>Not finding what you're looking for?</h5>
		<form action="" class="search-bar-form flex-row">
			<input type="image" src="/wp-content/uploads/2022/06/search-icon.svg" width="50px">
			<input type="text" name="search" placeholder="Search">
		</form>
		<div class="wp-block-button filled-button arrow-link arrow-link blue white">
        	<a href="#" class="wp-block-button__link">CONTACT US</a>
        </div>
	</div>
</section>

<?php 
get_template_part( 'template-parts/take-action' );
get_footer();