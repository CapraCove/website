<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- BEGIN IMPORTS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
        <link rel='stylesheet' type='text/css'
        href='http://fonts.googleapis.com/css?family=Hind|Open+Sans|Pathway+Gothic+One|Share+Tech+Mono'/>
        <!-- END IMPORTS -->
        <title><?php if (function_exists('is_tag') && is_tag()) { echo 'Tag Archive for &quot;'.$tag.'&quot; - '; } elseif (is_archive()) { wp_title(''); echo ' - Capra Archive'; } elseif (is_search()) { echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; } elseif (!(is_404()) && (is_single())) { wp_title('');} elseif (is_404()) { echo 'Not Found - '; } if (is_front_page() ) { bloginfo('name'); echo ' - '; bloginfo('description'); } elseif (is_home()) { echo 'Blog - Capra Cove'; } elseif (!is_single() && is_page()) { wp_title(''); echo ' - '; bloginfo('name'); } ?></title>

    <?php wp_head(); ?>

    </head>


    <!-- BEGIN JUMBOTRON -->
    <body <?php body_class(); ?>>
    <div class="header">
        <div class="jumbotron">
            <div class="container">
                <p>
                <a href="http://www.capracove.com/">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/images/goat.png" class="center-block" height="400" />
                </a></p>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- BEGIN NAVBAR -->
   <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
    
                <?php
                    $args = array(
 
                        'menu'          => 'header-menu',
                        'menu_class'    => 'nav navbar-nav',
                        'container'     => 'false'
                    );
                    wp_nav_menu( $args );
                ?>
                <!--     </ul> -->
                </div>
            </div>
        </nav>
        </div>