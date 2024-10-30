<?php
/*
Plugin Name: Link Blog
Plugin URI: http://wordpress.org/extend/plugins/link-blog/
Description: Allows you to create a simple link blog with WordPress.
Version: 1.2
Author: Milton Brian Jones
Author URI: http://www.miltonbjones.com
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA 
*/



/* fire meta box setup on edit post screen */
add_action( 'load-post.php', 'mbj_link_blog_meta_boxes_setup' );
add_action( 'load-post-new.php', 'mbj_link_blog_meta_boxes_setup' );

/* meta box setup function */
function mbj_link_blog_meta_boxes_setup() {
 
    /* add meta boxes */
    add_action( 'add_meta_boxes', 'mbj_link_blog_add_meta_boxes' );
   
	/* save the post meta */	
	add_action( 'save_post', 'mbj_link_blog_save_meta', 10, 2 );
	 }
	 
/* create a meta box for adding the link URL on the edit post screen */
function mbj_link_blog_add_meta_boxes() {
 
	add_meta_box(
		'mbj-link-blog-info',                           // unique id
	    esc_html__( 'Link Blog Info', 'example' ),      // title
        'mbj_link_blog_meta_box',     					// callback function
        'post',                 						// admin page (or post type)
        'normal',                 						// context
        'high'                   						// priority
    );
}


/* write the HTML and other stuff for displaying the meta box and display it */
function mbj_link_blog_meta_box( $object, $box ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'mbj_link_blog_nonce' ); ?>

<p>	        
<label for="mbj_link_blog_link_url">URL to link to:</label>
<br />
<input class="widefat" type="text" name="mbj_link_blog_link_url" id="mbj_link_blog_link_url" value="<?php echo esc_attr( get_post_meta( $object->ID, 'mbj_link_blog_link_url', true ) ); ?>" size="30" />
</p>

<?php
}
?>
<?php

/* save the post meta data */
	function mbj_link_blog_save_meta( $post_id, $post ) {	 
	  
	    /* verify the nonce */
	    if ( !isset( $_POST['mbj_link_blog_nonce'] ) || !wp_verify_nonce( $_POST['mbj_link_blog_nonce'], basename( __FILE__ ) ) )
	        return $post_id;
	 
        /* get post type object */
        $post_type = get_post_type_object( $post->post_type );
	 	
		    /* verify that the current user can edit the post */
	    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
	        return $post_id;
		
		
		foreach($_POST as $option=>$value) {		   
		   
		   if( in_array( $option, array('mbj_link_blog_link_url')))  {
			
				/* get the posted data and sanitize it for text field */
	    		$new_meta_value = ( isset($value) ? sanitize_text_field($value) : '' );
	 
		    	/* get the meta key */
	    		$meta_key = $option;
	 
	    		/* get the meta value for the custom field key */
	    		$meta_value = get_post_meta( $post_id, $meta_key, true );
	 
	    		/* if new meta value was added and there was no previous value, add it */
	    		if ( $new_meta_value && '' == $meta_value )
	       		 add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	 
	    		/* if the new meta value does not match the old value, update it */
	    		elseif ( $new_meta_value && $new_meta_value != $meta_value )
        		update_post_meta( $post_id, $meta_key, $new_meta_value );
	 
	    		/* if there is no new meta value but an old value exists, delete it. */
	    		elseif ( '' == $new_meta_value && $meta_value )
	        	delete_post_meta( $post_id, $meta_key, $meta_value );
		   }
		}
}

?>
<?php 

// build the function/template tag for displaying the exernal link URL (if thre is one)

function mbj_link_blog_link_url_display() {

global $post;


if (get_post_meta($post->ID, mbj_link_blog_link_url, true) != '') {

	$my_link_url = get_post_meta($post->ID, mbj_link_blog_link_url, true);

    }
	
else { $my_link_url = get_permalink($id); }	

echo $my_link_url;

}