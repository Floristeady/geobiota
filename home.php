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


<article style="float:left;">

<?php global $geobiota_options;
						$geobiota_settings = get_option( 'geobiota_options', $geobiota_options ); ?>
<?php if( $geobiota_settings['custom_logo'] ) : ?>
						<h1><a href="<?php echo bloginfo('url'); ?>" class="logo"><img src="<?php echo $geobiota_settings['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" /> </a></h1>
						<?php endif; ?>
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
	<article id="article-1" class="post-1 post-<?php the_ID(); ?> two_thirds">
		<p>page1</p>
		<div class="page-featured-content">
			<?php 		
			 $content = $post->post_excerpt;
			 $content = strip_tags($content);
			 $content = substr($content, 0, 120);
			 echo '<h2>' . $content . '<h2>'; 
			?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div><!-- .entry-content -->

		 <span class="img"><?php echo get_the_post_thumbnail( $post->ID, array(370,364), array('class' => 'product-image')); ?></span>
		 
	</article><!-- #post-## -->
	<?php elseif ($i == 2) :?>
	
	<article id="article-2" class="post-2 post-<?php the_ID(); ?> one_third">
	   <p>foto page2</p>
		<span class="img"><?php echo get_the_post_thumbnail( $post->ID, array(370,483), array('class' => 'product-image')); ?></span>
	</article><!-- #post-## -->
	
	<?php endif; ?>
	
<?php  $i++; endwhile; // end of the loop. ?>

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
	<article id="article-3" class="post-2 post-<?php the_ID(); ?> one_third" >
		<p>texto page2</p>
		<div class="page-featured-content">
			<?php 		
			 $content = $post->post_excerpt;
			 $content = strip_tags($content);
			 $content = substr($content, 0, 120);
			 echo '<h2>' . $content . '<h2>'; 
			?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div><!-- .entry-content -->
		 
	</article><!-- #post-## -->
	<?php elseif ($i == 2) :?>
	
	<article id="article-4" class="post-3 post-<?php the_ID(); ?> one_third">
		<p>foto page3</p>
		<span class="img"><?php echo get_the_post_thumbnail( $post->ID, array(370,364), array('class' => 'product-image')); ?></span>
	</article><!-- #post-## -->
	
	<?php endif; ?>
	
<?php $i++; endwhile; // end of the loop. ?>

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
	
	<article id="article-5" class="post-3 post-<?php the_ID(); ?> one_third">
		<p>texto page3</p>
		<div class="page-featured-content">
			<?php 		
			 $content = $post->post_excerpt;
			 $content = strip_tags($content);
			 $content = substr($content, 0, 120);
			 echo '<h2>' . $content . '<h2>'; 
			?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div><!-- .entry-content -->
		 
	</article><!-- #post-## -->
	
<?php endwhile; // end of the loop. ?>

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
	
	<article id="article-6" class="post-4 post-<?php the_ID(); ?>">
	
		<p>page4</p>	
		 <span class="img"><?php echo get_the_post_thumbnail( $post->ID, array(370,364), array('class' => 'product-image')); ?></span>
		
		<div class="page-featured-content">
			<?php 		
			 $content = $post->post_excerpt;
			 $content = strip_tags($content);
			 $content = substr($content, 0, 120);
			 echo '<h2>' . $content . '<h2>'; 
			?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div><!-- .entry-content -->
	 
	</article><!-- #post-## -->
	
<?php endwhile; // end of the loop. ?>



</div><!--#content-->

<?php get_footer(); ?>
