<?php
class My_Base_Custom_Post_Type
{
    public $supports = array( 'title', 'editor', );
    public $post_type = 'post_type';
    public function __construct() {
        add_action( 'init', array( $this, 'custom_post_type' ), 5 );
    }
	// без локализации
    public function custom_post_type() {
        register_post_type( $this->post_type, array(
            'labels' => array(
                'name' => __("CPT", 'my-plugin-textdomain'),
                'singular_name' => __("Item", 'my-plugin-textdomain'),
                'add_new' => _x("Add New", 'pluginbase', 'my-plugin-textdomain' ),
                'add_new_item' => __("Add New Base Item", 'my-plugin-textdomain' ),
                'edit_item' => __("Edit Base Item", 'my-plugin-textdomain' ),
                'new_item' => __("New Base Item", 'my-plugin-textdomain' ),
                'view_item' => __("View Base Item", 'my-plugin-textdomain' ),
                'search_items' => __("Search Base Items", 'my-plugin-textdomain' ),
                'not_found' =>  __("No base items found", 'my-plugin-textdomain' ),
                'not_found_in_trash' => __("No base items found in Trash", 'my-plugin-textdomain' ),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'supports' => $this->supports,
            'hierarchical' => 'false'
        ));
    }
	public static function plugin_activation() {
	}
	public static function plugin_deactivation( ) {
	}
}
?>