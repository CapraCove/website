<?php get_header(); ?>
<div class="goats">
	<div class="singlegoats">
		<div class="container">
			<div class="row">
				<?php if( have_posts() ) : ?>

    <?php  while( have_posts() ) :
            the_post();
            // $gallery  = get_post_gallery();

			// foreach( $ids as $id ) {

			//    $link   = wp_get_attachment_url( $id );

			//    $image_list . = '<li>' . $link . '</li>';

			// } 
           // $content  = split_content();                                        
 // = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
    ?>

					    <?php
					$morestring = '<!--more-->';
					$explode_content = explode( $morestring, $post->post_content );
					$content_before = apply_filters( 'the_content', $explode_content[0] );
					$content_after = apply_filters( 'the_content', $explode_content[1] );
					?>


 <!-- id="gallery" -->
					<div class="col-md-12">
						<div class = "title-card">
						<h2><?php the_title(); ?></h2>
						<p><em>
						See more from <?php

						$terms = get_the_terms( $post->ID , 'portfolio' );
						$c = 0;
						$goat_total = count($terms);
						foreach ( $terms as $term ) {
							$c++;
						// The $term is an object, so we don't need to specify the $taxonomy.
						    $term_link = get_term_link( $term );
						    
						    // If there was an error, continue to the next term.
						    if ( is_wp_error( $term_link ) ) {
						        continue;
						    }
						 
						    // We successfully got a link. Print it out.
						    echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
						    if ($c < $goat_total ) echo ', ';
						}

						?>, or head back to <a href="<?php bloginfo('url'); ?>/goat">all goats</a>.
						</em></p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 center-block">


						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_post_thumbnail_url(); ?>" id="picture">
							<img src="<?php the_post_thumbnail_url(); ?>" 
								class="center-block" 
								width="100%" 
								style="padding-top: 12px; margin-bottom: 4px">
							</a>
						<?php endif; ?>

						<?php if (!empty($content_after)) {
							echo '<div class="gallery">', $content_before, '</div>'; 
							}
						?>
					</div>
					<div class="col-md-4">
						<p>
						<div class="content-bar-mobile"><hr style="
						border-color: #9B9B9B; 
						border-width: 15px; 
						margin-bottom: 20px; 
						margin-top: 0px">
						</div>

						<?php if (!empty($content_after)) {
							echo '<div id="goatcontent">', $content_after, '</div>'; 
							}
							else {
								echo '<div id="goatcontent">', $content_before, '</div>';
							}
						?>
   						</p>
					</div>
				</div>
				<?php endwhile; else: ?>
					<div class="page-header">
			            <h1>Oh no!</h1>
		          	</div>
		          	<p>No content is appearing for this page!</p>
	         	<?php endif; ?>
	         	<br>
	         	<br>
	         	<?php get_footer(); ?>
         	</div>
     	</div>
 	</div>