<?php get_header(); ?>
<div class="frontblog">
	<div class="container">
		<div class="row">
			
			<div class="col-md-9">
				<h3 class="content_bar">•••<hr/></h3>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="post">
					<div class="row">
						<div class="col-md-5">
							<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>">
							<img src="<?php the_post_thumbnail_url(); ?>" class="center-block" width="100%"/>
							</a>
							<?php endif; ?>
						</div>
						<div class="col-md-7">
							<div class="content">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p style="margin-top: -10px; opacity: 0.9;"><em>
									<span class="glyphicon glyphicon-pencil" style="font-size: 14px"></span> <?php the_author_posts_link(); ?>
									— <?php echo the_time('l, F jS');?>, <?php the_category( ', ' ); ?>
								</em></p>
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
					<!--             <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a> -->
					<br>
				</article>
				<?php endwhile; ?>

				<div class="alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
				<div class="alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

				<?php else: ?>
				
				<div class="page-header">
					<h1>Oh no!</h1>
				</div>
				<p>No content is appearing for this page!</p>
				<?php endif; ?>
				<span class="content_bar">
				<hr/>
				</span>			
			</div>
			<div class="sidebar">
			<?php get_sidebar( 'blog' ); ?>
		</div>
		</div>
		<?php get_footer(); ?>
	</div>
</div>