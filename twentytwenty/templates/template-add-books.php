<?php
/**
 * Template Name: Add Books Template
 */

get_header();
?>

<main id="site-content" role="main">
	<div class="section-inner">
		<h2>Add Books from front end</h2>
		
		<?php
		// Logic to insert book into book custom post type in backend
		if(isset($_POST['book_submit'])){
			$args = array(
				'post_type' => 'books',
				'post_title'    => $_POST['book_title'],			
				'post_status'   => 'publish'
			);

			$post_id = wp_insert_post($args);
			if(!is_wp_error($post_id)){
				//the post is valid
				echo "<h4>Book is added in backend</h4>";
				update_post_meta( $post_id, 'book_author', $_POST['book_author'] );
				update_post_meta( $post_id, 'number_of_copies', $_POST['number_of_copies'] );
				update_post_meta( $post_id, 'publish_date', $_POST['publish_date'] );
			} else {
				//there was an error in the post insertion, 
				echo $post_id->get_error_message();
			}
		}
		?>
			
		<form action="" method="POST" enctype="multipart/form-data">
			<label>Book Title</label>
			<input type="text" name="book_title" required>
			
			<label>Book Author</label>
			<input type="text" name="book_author" required>
			
			<label>Number of copies</label>
			<input type="number" name="number_of_copies" required>
			
			<label>Publish Date</label>
			<input type="date" name="publish_date" required>

			<p><input type="submit" name="book_submit" value="Save"></p>
		</form>
	</div>
	
</main><!-- #site-content -->

<?php get_footer(); ?>
