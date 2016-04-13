<?php get_header(); ?>
<div class="frontblog">
  <div class="singleblog">
    <div class="container">
      <div class="row">
        
        <div class="col-md-9">
        <h3 class="content-bar-desktop"> ••• <hr/></h3>

          <article class="post">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!--  <div class="page-header"> -->
            <br>
            <div class="postcontent">
            <h2><?php the_title(); ?></h2>
            <p style="margin-top: -10px; opacity: 0.9;"><em>
                  <span class="glyphicon glyphicon-pencil" style="font-size: 14px"></span> <?php the_author_posts_link(); ?>
                  — <?php echo the_time('l, F jS');?>, <?php the_category( ', ' ); ?>
                </em></p>
            <?php if ( has_post_thumbnail() ) : ?>
              
              <a href="<?php the_post_thumbnail_url(); ?>" id="picture">
              <img src="<?php the_post_thumbnail_url(); ?>" class="center-block" width="100%">
              </a>
              <?php endif; ?>

              <span><?php the_content(); ?></span>
            </div>
            <hr/>
                      <div class="commentstyle">
            <?php the_tags( 'Specialization tag: ', ', ', '.' ); ?>
<!--               <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a> -->
            </p>
          <!--   </div> -->

            <?php comments_template(); ?>
          </div>
          </article>
          <?php endwhile; else: ?>
          
          <div class="page-header">
            <h1>Oh no!</h1>
          </div>
          <p>No content is appearing for this page!</p>
          <?php endif; ?>
        </div>
        <div class="sidebar">
        <?php get_sidebar( 'blog' ); ?>
        </div>
      </div>
      <?php get_footer(); ?>
    </div>
  </div>
</div>