<!-- <?php
/*
  Template Name: Portfolio Grid Template
*/

?> -->
<?php get_header(); ?>

<div class="goats">

  <div class="container">   
    <div class="row">
      <br>
      <div class="col-md-12">
          <br>
          <h2>ENTER THE VOID. <br>FEEL THE RYTHYM.</h2>
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/bracket.png" class="center-block" width="90%"/>
      <div class="col-xs-4">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/placeholder.png" class="center-block" width="100%"/>
                <h2>ZOE</h2>
      </div>
      <div class="col-xs-4">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/placeholder.png" class="center-block" width="100%"/>
                <h2>EMMA</h2>
      </div>
      <div class="col-xs-4">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/placeholder.png" class="center-block" width="100%"/>
                <h2>KAYLA</h2>
      </div>
<!--           <?php the_content(); ?> -->          

      </div>      

    </div>

    <div class="row listings">
       <br><br>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="row">
            <div class="col-md-6 portfolio-piece">

          <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url(); ?>" class="center-block" width="100%"/>
              </a>
              <?php endif; ?>
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

      </div>

      <?php endwhile; else: ?>

      <div class="page-header">
          <h1>Oh no!</h1>
        </div>
        <p>No content is appearing for this page!</p>
        <?php endif; ?>
        <span class="content_bar">
        <hr/>
        </span> 

      


    </div>
    </div>











<?php get_footer(); ?>