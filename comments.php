<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 style="opacity: 0.6; text-align: center">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One Comment on &ldquo;%s&rdquo;', 'comments title', 'capracove' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Comment on &ldquo;%2$s&rdquo;',
							'%1$s Comments on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'capracove'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'callback'	  => 'capra_comment',
					'type'		  => 'comment',
					'avatar_size' => 42,
					'short_ping'  => true
					) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'capracove' ); ?></p>
	<?php endif; ?>
		<div class="comment-form">
		 <?php comment_form( array(
		 	'must_log_in'		 => '<p class="must-log-in" style="text-align: center">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'title_reply_before' => '<h3 style="opacity: 0.6; text-align: center">',
			'comment_field'		 => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="80" rows="8" aria-required="true"></textarea></p>',
			'title_reply_after'  => '</h3>',
			'logged_in_as'		 => '<p class="logged-in-as" style="text-align: center">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		) );
	?>
	</div>

</div><!-- .comments-area -->
