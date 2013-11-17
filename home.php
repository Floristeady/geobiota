<?php
/**
 * The Template for front page.
 *
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */

get_header(); ?>

<div id="content">

<div id="list-articles">


		<article id="the-logo" class="item img one_third">
		  <a href="<?php echo bloginfo('url'); ?>">
			<img src="<?php bloginfo('template_url') ?>/images/elements/imagen-geobiota.jpg"/>
		  </a>
		</article>
		
		
		<!---loop1-->
			<?php $args = array(
					'post_type'	=> 'page',
					'post_status' => 'publish',
					'posts_per_page' => 2,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'offset' => 0,
					'meta_query' => array(
						array( 'key' => 'custom_featured', 'value' => 'on')
					) );
				$page_featured = new WP_Query( $args );
			?>
			
			<?php $i = 1 ; ?>	
			<?php if ( $page_featured->have_posts() ) while ( $page_featured->have_posts() ) : $page_featured->the_post(); ?>
			
			<?php if ($i == 1): ?>
			<article id="article-1" class="post-1 item img-text two_thirds no-margin margin-30 post-<?php the_ID(); ?>">
				
				<div class="box-text one_half_margin">
					<div class="page-featured-content text">
						<?php 		
						 $content = $post->post_excerpt;
						 $content = strip_tags($content);
						 $content = substr($content, 0, 120);
						 echo '<h2>' . $content . '</h2>'; 
						?>
						<p class="entry-title"><span><?php the_title(); ?></span></p>
					</div><!-- .entry-content -->
				</div>

				 <?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)):
				?>
				<span class="img one_half">
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=368&h=226"/>
				</span>			
				<?php endif; //end ?>
				 
			</article><!-- #post-## -->
			
			<?php elseif ($i == 2) :?>
			
			<article id="article-2" class="post-2 item img one_third post-<?php the_ID(); ?>">

				<?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)):
				?>
				<span class="img">
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=368&h=480"/>
				</span>			
				<?php endif; //end ?>
				
			</article><!-- #post-## -->
			
			<?php endif; ?>
			
		<?php  $i++; endwhile; wp_reset_postdata(); ?>
		
		<!---loop2-->
		
		<?php $args = array(
					'post_type'	=> 'page',
					'post_status' => 'publish',
					'posts_per_page' => 2,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'offset' => 1,
					'meta_query' => array(
						array( 'key' => 'custom_featured', 'value' => 'on')
					) );
				$page_featured = new WP_Query( $args );
			?>
			
			<?php $i = 1 ; ?>	
			<?php if ( $page_featured->have_posts() ) while ( $page_featured->have_posts() ) : $page_featured->the_post(); ?>
			
			<?php if ($i == 1): ?>
			<article id="article-3" class="post-2 item text one_third margin-30 no-margin post-<?php the_ID(); ?>" >
				<div class="page-featured-content">
					<?php 		
					 $content = $post->post_excerpt;
					 $content = strip_tags($content);
					 $content = substr($content, 0, 120);
					 echo '<h2>' . $content . '</h2>'; 
					?>
					<p class="entry-title"><span><?php the_title(); ?></span></p>
				</div><!-- .entry-content -->
				 
			</article><!-- #post-## -->
			<?php elseif ($i == 2) :?>
				
		    <article id="article-4" class="post-3 item one_img one_third no-margin post-<?php the_ID(); ?>">
				
				 <?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)):
				?>
				<span class="img">
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=368&h=224"/>
				</span>			
				<?php endif; //end ?>


				 
			</article><!-- #post-## -->
						
			<?php endif; ?>
			
		<?php $i++; endwhile; wp_reset_postdata(); ?>
		
		<!---loop3-->
		
		<?php $args = array(
					'post_type'	=> 'page',
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'offset' => 2,
					'meta_query' => array(
						array( 'key' => 'custom_featured', 'value' => 'on')
					) );
				$page_featured = new WP_Query( $args );
			?>
				
			<?php if ( $page_featured->have_posts() ) while ( $page_featured->have_posts() ) : $page_featured->the_post(); ?>
			
			<article id="article-5" class="post-3 item text one_third post-<?php the_ID(); ?>">
				<div class="page-featured-content">
					<?php 		
					 $content = $post->post_excerpt;
					 $content = strip_tags($content);
					 $content = substr($content, 0, 120);
					 echo '<h2>' . $content . '</h2>'; 
					?>
					<p class="entry-title"><span><?php the_title(); ?></span></p>
				</div><!-- .entry-content -->
								
			</article><!-- #post-## -->

			
		<?php endwhile; wp_reset_postdata(); ?>
		
		
		
		<!---loop4-->
			<?php $args = array(
					'post_type'	=> 'page',
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'offset' => 3,
					'meta_query' => array(
						array( 'key' => 'custom_featured', 'value' => 'on')
					) );
				$page_featured = new WP_Query( $args );
			?>
			
			<?php if ( $page_featured->have_posts() ) while ( $page_featured->have_posts() ) : $page_featured->the_post(); ?>
			
			<article id="article-6" class="post-4 item img-text post-<?php the_ID(); ?>">
	
				 <?php //Obtenemos la url de la imagen destacada
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)):
				?>
				<span class="img one_third">
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=368&h=224"/>
				</span>			
				<?php endif; //end ?>

				
				<div class="box-text two_thirds no-margin">
					<div class="page-featured-content text">
						<?php 		
						 $content = $post->post_excerpt;
						 $content = strip_tags($content);
						 $content = substr($content, 0, 120);
						 echo '<h2>' . $content . '</h2>'; 
						?>
						<p class="entry-title"><span><?php the_title(); ?></span></p>
					</div><!-- .entry-content -->
				</div>
			 
			</article><!-- #post-## -->
			
		<?php endwhile; wp_reset_postdata(); ?>
		
	</div><!--#list article-->	

</div><!--#content-->

<?php get_footer(); ?>
