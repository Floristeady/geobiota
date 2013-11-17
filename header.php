<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * boilerplate_filter_wp_title() in functions.php.
			 */
			wp_title( '|', true, 'right' );
		?></title>
			
	    <meta name="description" content="<?php echo '' . get_bloginfo ( 'description' );  ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css" />
	    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>
	
		<div id="content">
				
			<header role="banner">
			
			<?php global $geobiota_options;
						$geobiota_settings = get_option( 'geobiota_options', $geobiota_options ); ?>
			
				<div id="inner-header">

					<div id="site-title">
					
					<?php if( $geobiota_settings['custom_logo'] ) : ?>
						<h1><a href="<?php echo bloginfo('url'); ?>" class="logo"><img src="<?php echo $geobiota_settings['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" /> </a></h1>
					<?php  else : ?>
						<h1><a href="<?php echo bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						<?php endif; ?>
				  
						<h2><?php bloginfo( 'description' ); ?></h2>
					</div>
					
					
					<?php $args = array(
						'post_type'	=> 'page',
						'posts_per_page' => 1,
						'meta_query' => array(
							array( 'key' => 'contenido_encabezado', 'value' => '1')
						) );
					$page_featured = new WP_Query( $args );
				 ?>
				 
				 <?php if ( $page_featured->have_posts() ) while ( $page_featured->have_posts() ) : $page_featured->the_post(); ?>
				 
				 
					<div id="page-header">
						<div class="text-content">
						<?php the_content();?>
						</div>
						<a class="close" href="#">X</a>
					</div><!-- .entry-content -->
				
					</div>
					
					<?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)): ?>
						
				 	<div id="back-img">
						<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=1500&h=360"/>
					</div>
				
				<?php endif; endwhile; ?>
				
				<?php wp_reset_postdata();?>	
	
				<nav id="access" role="navigation" class="clearfix">
					<?php /* Our navigation menu.*/ ?>
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary','after'  => '<span></span>', ) ); ?>
				</nav><!-- #access -->

	
			</header>
			
			<div class="clearfix" id="container">

				<section id="main" role="main">
