<?php


// Register Custom Post Type
function custom_subscription_plan() {

    $labels = array(
        'name'                  => _x( 'subscription', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'subscription ', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'subscription ', 'text_domain' ),
        'name_admin_bar'        => __( 'subscription ', 'text_domain' ),
        'archives'              => __( 'subscription Archives', 'text_domain' ),
        'attributes'            => __( 'subscription Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent plan:', 'text_domain' ),
        'all_items'             => __( 'All plan', 'text_domain' ),
        'add_new_item'          => __( 'Add New plan', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New plan', 'text_domain' ),
        'edit_item'             => __( 'Edit plan', 'text_domain' ),
        'update_item'           => __( 'Update plan', 'text_domain' ),
        'view_item'             => __( 'View plan', 'text_domain' ),
        'view_items'            => __( 'View plan', 'text_domain' ),
        'search_items'          => __( 'Search plan', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into plan', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this plan', 'text_domain' ),
        'items_list'            => __( 'plan list', 'text_domain' ),
        'items_list_navigation' => __( 'plan list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter plan list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'plan management', 'text_domain' ),
        'description'           => __( 'plan management Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array('title'),
        'taxonomies'            => array( '', '' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
    );
    register_post_type( 'subscription', $args );

}
add_action( 'init', 'custom_subscription_plan');


// Register Custom Post Type
function addvertisement() {

    $labels = array(
        'name'                  => _x( 'advertisement', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'advertisement ', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'advertisement ', 'text_domain' ),
        'name_admin_bar'        => __( 'advertisement ', 'text_domain' ),
        'archives'              => __( 'advertisement Archives', 'text_domain' ),
        'attributes'            => __( 'advertisement Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent ads:', 'text_domain' ),
        'all_items'             => __( 'All ads', 'text_domain' ),
        'add_new_item'          => __( 'Add New ads', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New ads', 'text_domain' ),
        'edit_item'             => __( 'Edit ads', 'text_domain' ),
        'update_item'           => __( 'Update ads', 'text_domain' ),
        'view_item'             => __( 'View ads', 'text_domain' ),
        'view_items'            => __( 'View ads', 'text_domain' ),
        'search_items'          => __( 'Search ads', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into plan', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this plan', 'text_domain' ),
        'items_list'            => __( 'plan list', 'text_domain' ),
        'items_list_navigation' => __( 'plan list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter plan list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'ads management', 'text_domain' ),
        'description'           => __( 'ads management Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array('title','thumbnail','tags'),
        'taxonomies'            => array( 'category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
    );
    register_post_type( 'adds', $args );

}
add_action( 'init', 'addvertisement');


function filter_subscription_by_template( $post_type, $which ) {

    // Apply this only on a specific post type
    if ( 'subscription' !== $post_type )
        return;

    // A list of taxonomy slugs to filter by
    $taxonomies = array( 'asset-detail');

    foreach ( $taxonomies as $taxonomy_slug ) {

        // Retrieve taxonomy data
        $taxonomy_obj = get_taxonomy( $taxonomy_slug );
        $taxonomy_name = $taxonomy_obj->labels->name;

        // Retrieve taxonomy terms
        $terms = get_terms( $taxonomy_slug );

        // Display filter HTML
        echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
        echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
        foreach ( $terms as $term ) {
            echo
            printf(
                '<option value="%1$s" %2$s>%3$s</option>',
                $term->slug,
                ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
                $term->name
            );
        }
        echo '</select>';
    }

}
add_action( 'restrict_manage_posts', 'filter_subscription_by_template' , 10, 2);
?>