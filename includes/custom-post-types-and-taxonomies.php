<?php

if ( ! function_exists('register_welia_custom_post_types') ) {
    // Register Welia Custom Post Types
    function register_welia_custom_post_types() {       
        // Provider 
        $labels = array(
            'name'                  => _x( 'Providers', 'Post Type General Name', 'welia-health' ),
            'singular_name'         => _x( 'Provider', 'Post Type Singular Name', 'welia-health' ),
            'menu_name'             => __( 'Providers', 'welia-health' ),
            'name_admin_bar'        => __( 'Provider', 'welia-health' ),
            'archives'              => __( 'Provider Archives', 'welia-health' ),
            'attributes'            => __( 'Provider Attributes', 'welia-health' ),
            'parent_item_colon'     => __( 'Parent Provider:', 'welia-health' ),
            'all_items'             => __( 'All Providers', 'welia-health' ),
            'add_new_item'          => __( 'Add New Provider', 'welia-health' ),
            'add_new'               => __( 'Add New', 'welia-health' ),
            'new_item'              => __( 'New Provider', 'welia-health' ),
            'edit_item'             => __( 'Edit Provider', 'welia-health' ),
            'update_item'           => __( 'Update Provider', 'welia-health' ),
            'view_item'             => __( 'View Provider', 'welia-health' ),
            'view_items'            => __( 'View Providers', 'welia-health' ),
            'search_items'          => __( 'Search Provider', 'welia-health' ),
            'not_found'             => __( 'Not found', 'welia-health' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'welia-health' ),
            'featured_image'        => __( 'Featured Image', 'welia-health' ),
            'set_featured_image'    => __( 'Set featured image', 'welia-health' ),
            'remove_featured_image' => __( 'Remove featured image', 'welia-health' ),
            'use_featured_image'    => __( 'Use as featured image', 'welia-health' ),
            'insert_into_item'      => __( 'Insert into provider', 'welia-health' ),
            'uploaded_to_this_item' => __( 'Uploaded to this provider', 'welia-health' ),
            'items_list'            => __( 'Providers list', 'welia-health' ),
            'items_list_navigation' => __( 'Providers list navigation', 'welia-health' ),
            'filter_items_list'     => __( 'Filter Providers list', 'welia-health' ),
        );
        $args = array(
            'label'                 => __( 'Provider', 'welia-health' ),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'taxonomies'            => array( 'provider-category' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-businessperson',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type( 'provider', $args );

        // Location
        $labels = array(
            'name'                  => _x( 'Locations', 'Post Type General Name', 'welia-health' ),
            'singular_name'         => _x( 'Location', 'Post Type Singular Name', 'welia-health' ),
            'menu_name'             => __( 'Locations', 'welia-health' ),
            'name_admin_bar'        => __( 'Location', 'welia-health' ),
            'archives'              => __( 'Location Archives', 'welia-health' ),
            'attributes'            => __( 'Location Attributes', 'welia-health' ),
            'parent_item_colon'     => __( 'Parent Location:', 'welia-health' ),
            'all_items'             => __( 'All Locations', 'welia-health' ),
            'add_new_item'          => __( 'Add New Location', 'welia-health' ),
            'add_new'               => __( 'Add New', 'welia-health' ),
            'new_item'              => __( 'New Location', 'welia-health' ),
            'edit_item'             => __( 'Edit Location', 'welia-health' ),
            'update_item'           => __( 'Update Location', 'welia-health' ),
            'view_item'             => __( 'View Location', 'welia-health' ),
            'view_items'            => __( 'View Locations', 'welia-health' ),
            'search_items'          => __( 'Search Location', 'welia-health' ),
            'not_found'             => __( 'Not found', 'welia-health' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'welia-health' ),
            'featured_image'        => __( 'Featured Image', 'welia-health' ),
            'set_featured_image'    => __( 'Set featured image', 'welia-health' ),
            'remove_featured_image' => __( 'Remove featured image', 'welia-health' ),
            'use_featured_image'    => __( 'Use as featured image', 'welia-health' ),
            'insert_into_item'      => __( 'Insert into Location', 'welia-health' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Location', 'welia-health' ),
            'items_list'            => __( 'Locations list', 'welia-health' ),
            'items_list_navigation' => __( 'Locations list navigation', 'welia-health' ),
            'filter_items_list'     => __( 'Filter Locations list', 'welia-health' ),
        );
        $args = array(
            'label'                 => __( 'Location', 'welia-health' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-location',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type( 'location', $args );

        // Parent Service
        $labels = array(
            'name'                  => _x( 'Parent Services', 'Post Type General Name', 'welia-health' ),
            'singular_name'         => _x( 'Parent Service', 'Post Type Singular Name', 'welia-health' ),
            'menu_name'             => __( 'Parent Services', 'welia-health' ),
            'name_admin_bar'        => __( 'Parent Service', 'welia-health' ),
            'archives'              => __( 'Parent Service Archives', 'welia-health' ),
            'attributes'            => __( 'Parent Service Attributes', 'welia-health' ),
            'parent_item_colon'     => __( 'Parent Parent Service:', 'welia-health' ),
            'all_items'             => __( 'All Parent Services', 'welia-health' ),
            'add_new_item'          => __( 'Add New Parent Service', 'welia-health' ),
            'add_new'               => __( 'Add New', 'welia-health' ),
            'new_item'              => __( 'New Parent Service', 'welia-health' ),
            'edit_item'             => __( 'Edit Parent Service', 'welia-health' ),
            'update_item'           => __( 'Update Parent Service', 'welia-health' ),
            'view_item'             => __( 'View Parent Service', 'welia-health' ),
            'view_items'            => __( 'View Parent Services', 'welia-health' ),
            'search_items'          => __( 'Search Parent Service', 'welia-health' ),
            'not_found'             => __( 'Not found', 'welia-health' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'welia-health' ),
            'featured_image'        => __( 'Featured Image', 'welia-health' ),
            'set_featured_image'    => __( 'Set featured image', 'welia-health' ),
            'remove_featured_image' => __( 'Remove featured image', 'welia-health' ),
            'use_featured_image'    => __( 'Use as featured image', 'welia-health' ),
            'insert_into_item'      => __( 'Insert into Parent Service', 'welia-health' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Parent Service', 'welia-health' ),
            'items_list'            => __( 'Parent Services list', 'welia-health' ),
            'items_list_navigation' => __( 'Parent Services list navigation', 'welia-health' ),
            'filter_items_list'     => __( 'Filter Parent Services list', 'welia-health' ),
        );
        $args = array(
            'label'                 => __( 'Parent Service', 'welia-health' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-excerpt-view',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type( 'parent-service', $args );
    }
    add_action( 'init', 'register_welia_custom_post_types', 0 );
}

if ( ! function_exists( 'register_welia_custom_taxonomies' ) ) {
    // Register Welia Custom Taxonomies
    function register_welia_custom_taxonomies() {
        // Provider Category
        $labels = array(
            'name'                       => _x( 'Provider Categories', 'Taxonomy General Name', 'welia-health' ),
            'singular_name'              => _x( 'Provider Category', 'Taxonomy Singular Name', 'welia-health' ),
            'menu_name'                  => __( 'Provider Categories', 'welia-health' ),
            'all_items'                  => __( 'All Provider Categories', 'welia-health' ),
            'parent_item'                => __( 'Parent Provider Category', 'welia-health' ),
            'parent_item_colon'          => __( 'Parent Provider Category:', 'welia-health' ),
            'new_item_name'              => __( 'New Provider Category', 'welia-health' ),
            'add_new_item'               => __( 'Add New Provider Category', 'welia-health' ),
            'edit_item'                  => __( 'Edit Provider Category', 'welia-health' ),
            'update_item'                => __( 'Update Provider Category', 'welia-health' ),
            'view_item'                  => __( 'View Provider Category', 'welia-health' ),
            'separate_items_with_commas' => __( 'Separate provider categories with commas', 'welia-health' ),
            'add_or_remove_items'        => __( 'Add or remove provider categories', 'welia-health' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'welia-health' ),
            'popular_items'              => __( 'Popular Provider Categories', 'welia-health' ),
            'search_items'               => __( 'Search Provider Categories', 'welia-health' ),
            'not_found'                  => __( 'Not Found', 'welia-health' ),
            'no_terms'                   => __( 'No Provider Categories', 'welia-health' ),
            'items_list'                 => __( 'Provider categories list', 'welia-health' ),
            'items_list_navigation'      => __( 'Provider categories list navigation', 'welia-health' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'provider-category', array( 'provider' ), $args );

        $labels = array(
            'name'                       => _x( 'Location Categories', 'Taxonomy General Name', 'welia-health' ),
            'singular_name'              => _x( 'Location Category', 'Taxonomy Singular Name', 'welia-health' ),
            'menu_name'                  => __( 'Location Categories', 'welia-health' ),
            'all_items'                  => __( 'All Location Categories', 'welia-health' ),
            'parent_item'                => __( 'Parent Location Category', 'welia-health' ),
            'parent_item_colon'          => __( 'Parent Location Category:', 'welia-health' ),
            'new_item_name'              => __( 'New Location Category', 'welia-health' ),
            'add_new_item'               => __( 'Add New Location Category', 'welia-health' ),
            'edit_item'                  => __( 'Edit Location Category', 'welia-health' ),
            'update_item'                => __( 'Update Location Category', 'welia-health' ),
            'view_item'                  => __( 'View Location Category', 'welia-health' ),
            'separate_items_with_commas' => __( 'Separate Location categories with commas', 'welia-health' ),
            'add_or_remove_items'        => __( 'Add or remove Location categories', 'welia-health' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'welia-health' ),
            'popular_items'              => __( 'Popular Location Categories', 'welia-health' ),
            'search_items'               => __( 'Search Location Categories', 'welia-health' ),
            'not_found'                  => __( 'Not Found', 'welia-health' ),
            'no_terms'                   => __( 'No Location Categories', 'welia-health' ),
            'items_list'                 => __( 'Location categories list', 'welia-health' ),
            'items_list_navigation'      => __( 'Location categories list navigation', 'welia-health' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'location-category', array( 'location' ), $args );
    }
    add_action( 'init', 'register_welia_custom_taxonomies', 0 );
}