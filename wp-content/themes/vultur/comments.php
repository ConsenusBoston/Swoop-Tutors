<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vultur
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="vultur_comment_form">
<div id="comments" class="comments-area">
<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'vultur' ),
					'<span>'.get_the_title().'</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( 'Comments (%1$s)', 'Comments (%1$s)', $comment_count, 'comments title', 'vultur' ) ),
					number_format_i18n( $comment_count ),
					'<span>'.get_the_title().'</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->
        <?php the_comments_navigation(); ?>
        <ol class="comment-list">
		    <?php 
                  wp_list_comments( array(
				    'callback'   => 'vultur_custom_comments',
					'short_ping' => true,
				  ) );
			    ?>
		</ol><!-- .comment-list -->
       <?php the_comments_navigation();
        // If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'vultur' ); ?></p>
    <?php
  endif;
endif; // Check for have_comments().
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$vultur_fields =  array(
	    'author' =>' <div class="row">
	                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					        <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ).'" placeholder="'.esc_attr__('Your Name','vultur').'"/></div>',
        'email' =>'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ).'" placeholder="'.esc_attr__('Your Email','vultur').'" /></div></div>',
		'url' =>'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ).'" size="30" placeholder="'.esc_attr__('Website URL','vultur').'"/>',
                    );
      $vultur_comments_args = array(
	          'fields' =>$vultur_fields,
		   'comment_field' => '<textarea name="comment" rows="5" placeholder="'.esc_attr__('Comment...','vultur').'"></textarea>',
			  'class_submit' => 'vultur_btn',
			  'label_submit' => esc_attr__( 'Submit Comment','vultur'),
			  );      
	comment_form($vultur_comments_args);
	?>
 </div>
</div><!-- #comments --> 