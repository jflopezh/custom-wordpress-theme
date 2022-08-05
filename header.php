<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>
<header>
	<div id="top-header" class="flex-column">
		<span><b>ALERT:</b> Link to announcement or expand downward</span>
		<div id="alert" <?php if (is_admin_bar_showing()) { echo 'class="admin-bar"'; } ?>>
			<div class="inner">
				Lorem ipsum dolor sit amet consectetur adipiscing elit vitae class, sollicitudin ad risus tellus neque pretium 
				suspendisse pharetra, eu iaculis nascetur feugiat habitasse hendrerit turpis primis. Habitant blandit dignissim 
				fermentum torquent in fames cum lacus, scelerisque tempor felis vestibulum nisl tincidunt ac iaculis natoque, dictum 
				ullamcorper himenaeos gravida at non hendrerit. Neque mollis tempor parturient praesent aliquet maecenas est, euismod 
				bibendum fringilla habitant phasellus quisque, mi luctus volutpat aliquam conubia etiam.
			</div>
		</div>
	</div>
	<div id="middle-header" class="desktop flex-row">
		<div class="left-middle-header">
			<a href="<?php echo site_url() ?>">
				<img src="/wp-content/uploads/2021/03/imageedit_14_9147562725.png" width="250px" height="78.71px"/>
			</a>
		</div>
		<div class="right-middle-header flex-column">
			<div class="user-menu">
				<?php
					$user_menu = array(
						'theme_location' => 'desktop_user_menu',
						'menu_id' => 'desktop-user-menu',
						'menu_class' => 'header-menu'
					);
					wp_nav_menu($user_menu);
				?>
			</div>
			<div class="action-menu">
				<?php
					$action_menu = array(
						'theme_location' => 'desktop_action_menu',
						'menu_id' => 'desktop-action-menu',
						'menu_class' => 'header-menu'
					);
					wp_nav_menu($action_menu);
				?>
			</div>
		</div>
	</div>
	<div id="bottom-header" class="desktop flex-row">
		<div class="search-bar search-button">
			<img src="/wp-content/uploads/2022/06/search-icon.png" width="25px" height="25px"/>
			<span>Site Search</span>
		</div>
		<span class="separator"></span>
		<div id="main-menu">
			<?php
				$main_menu = array(
					'theme_location' => 'main_menu',
					'menu_id' => 'main-menu',
					'menu_class' => 'header-menu'
				);
				wp_nav_menu($main_menu);
			?>
		</div>
	</div>
	<div id="mobile-middle-header" class="tablet flex-row">
		<a href="<?php echo site_url() ?>">
			<img src="/wp-content/uploads/2022/06/welia-health-logo-mobile.png" width="136px" height="42px">
		</a>
		<div class="navigate flex-row">
			<button class="search search-button">
				<img src="/wp-content/uploads/2022/06/search-icon.png" width="24px" height="24px">
			</button>
			<button id="toggle-menu">
				<img src="/wp-content/uploads/2022/06/toggle-menu-icon.png" width="24px" height="24px">
			</button>
		</div>
	</div>
	<div id="telephone-banner" class="tablet flex-row">
		<div class="mobile mychart flex-row">
			<img src="/wp-content/uploads/2022/06/mychart-menu-icon.svg" width="20px" height="20px">
			<a>MyChart</a>
		</div>
		<span style="white-space: nowrap;">320 679 1212</span>
	</div>
	<div id="icon-menu" class="tablet">
		<?php
			$tablet_user_menu = array(
				'theme_location' => 'tablet_user_menu',
				'menu_id' => 'tablet_user_menu',
				'menu_class' => 'header-menu'
			);
			wp_nav_menu($tablet_user_menu);
		?>
		<div class="mobile">
			<?php
				$mobile_user_menu = array(
					'theme_location' => 'mobile_user_menu',
					'menu_id' => 'mobile_user_menu',
					'menu_class' => 'header-menu'
				);
				wp_nav_menu($mobile_user_menu);
			?>
		</div>
	</div>
	<div id="off-canvas-outter">
		<div id="off-canvas-menu" class="tablet <?php if (is_admin_bar_showing()) { echo 'admin-bar'; } ?>">
			<button id="close-menu">
				<img src="/wp-content/uploads/2022/06/close-menu-icon.png" width="20px" height="20px">
			</button>
			<?php
				$off_canvas_menu = array(
					'theme_location' => 'main_menu',
					'menu_class' => 'off-canvas-menu'
				);
				wp_nav_menu($off_canvas_menu);
			?>
		</div>
		<div id="off-canvas-outside"></div>
	</div>
	<div id="full-site-search">
		<img id="close-search-button" src="/wp-content/uploads/2022/07/close-icon.svg" width="55px" height="55px">
		<h2>Search</h2>
		<h3>What can we help you find?</h3>
		<p>Here you can look up a healthcare provider, a clinic location, 
			information about a condition/treatment, events, or other infromation.</p>
		<div class="search-bar">
			<?php echo do_shortcode('[full_site_search]') ?>
		</div>
		<div class="examples">
			<h5>Examples</h5>
			<ul>
				<li>"Matt Schultz" for a Provider by name</li>
				<li>"Diabetes" for a Condition</li>
				<li>"Mental Health" for a Provider by specialty</li>
				<li>"Pine City" for a Location</li>
				<li>"Support group” for an Event</li>
			</ul>
		</div>
	</div>
</header>
    
