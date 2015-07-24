<?php

new My_Custom_Post_Type();


class My_Custom_Post_Type
{
    public $post_type = 'my_cpt';
    
	public function __construct() {
        $post = new My_Base_Custom_Post_Type();
        $post->post_type = $this->post_type;
        $post->supports = array( 'title', 'editor', 'thumbnail');
		add_action('post_edit_form_tag', array( $this, 'post_edit_form_tag'));
        add_action('add_meta_boxes', array( $this, 'add_pdf_meta_boxes'));
        add_action('save_post', array( $this, 'save_pdf_data'));
		
		add_filter('manage_edit-'.$post->post_type.'_columns', array( $this, 'add_preview_column'), 4);
		add_action( 'manage_'.$post->post_type.'_posts_custom_column' , array( $this, 'preview_size'), 5, 2 );
		add_action('admin_head',  array( $this, 'preview_width'));
		
		add_theme_support( 'post-thumbnails' );
    }
    public function add_preview_column( $columns ){
		$preview = array( 'preview' => 'Изображение' );
		$columns = array_slice( $columns, 0, 1, true ) + $preview + array_slice( $columns, 1, NULL, true );
		return $columns;
    }
    public function preview_size( $column, $post_ID ) {
        if (has_post_thumbnail()){
            the_post_thumbnail(array(100, 100));
		}
    }
	public function preview_width() {
        echo '<style type="text/css">
        .wp-list-table .column-preview { width: 120px; }
        </style>';
    }
    function post_edit_form_tag() {
        echo ' enctype="multipart/form-data"';
    }
	public function add_pdf_meta_boxes() {
        add_meta_box(
            'wp_pdf_attachment',
            'PDF',
            array( $this, 'wp_pdf_attachment' ),
            $this->post_type,
            'side'
        );
    }
    public function wp_pdf_attachment($post) {
        wp_nonce_field(plugin_basename(__FILE__), 'wp_pdf_attachment_nonce');
		$param = array(
            'post_parent' => $post->ID,
			'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null
        );
		echo '<input type="file" id="wp_pdf_attachment" name="wp_pdf_attachment" value="" /><br/>';
        if ( $attachments = get_children($param)){
			foreach ($attachments as $attachment) {
				$file = wp_get_attachment_url( $attachment->ID );
				$file_type = substr($file, strrpos($file, '.') + 1);
				$filename = basename ( get_attached_file( $attachment->ID ) );
				if($file_type == 'pdf'){
					echo '<a href="' . $file . '">'.$filename.'</a><br/>';
				}
			}
		}
    }
    
	
	public function save_pdf_data($pos_id) {
        if(!wp_verify_nonce($_POST['wp_pdf_attachment_nonce'], plugin_basename(__FILE__))) {
			return $pos_id;
        }
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $pos_id;
        }
        if('page' == $_POST['post_type']) {
            if(!current_user_can('edit_page', $pos_id)) {
                return $pos_id;
            }
        } else {
            if(!current_user_can('edit_page', $pos_id)) {
                return $pos_id;
            }
        }
        if(!empty($_FILES['wp_pdf_attachment']['name'])) {
            $types = array('application/pdf');
            $files = wp_check_filetype(basename($_FILES['wp_pdf_attachment']['name'])); // return array
            $uploaded_types = $files['type'];
            if(in_array($uploaded_type, $types)) {
                $upload = media_handle_upload("wp_pdf_attachment", $pos_id, file_get_contents($_FILES['wp_pdf_attachment']['tmp_name']));
                if(isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('Error: ' . $upload['error']);
                } else {
                    add_post_meta($pos_id, 'wp_pdf_attachment', $upload);
                    update_post_meta($pos_id, 'wp_pdf_attachment', $upload);
                }
            } else {
                wp_die("The file type that you've uploaded is not a PDF.");
            }
        }
    }
}
?>