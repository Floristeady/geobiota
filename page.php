<?php
/**
 * Template Name: P&aacute;gina General
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */

get_header(); ?>

<div id="content" class="content-page">


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="column_one_third">	
		
			<a href="<?php echo bloginfo('url'); ?>">
				<img src="<?php bloginfo('template_url') ?>/images/elements/imagen-geobiota.jpg"/>
			</a>
			
			<h1 class="entry-title"><?php the_title(); ?><span></span></h1>
			
			<div class="entry-content">		
				<?php the_field('columna_izquierda'); ?>			
			</div>
			
		</div>
		
		
		<div class="column_one_third">	
		
			<h2 class="entry-excerpt"><?php the_excerpt(); ?><span></span></h2>
			
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
		
		<div class="column_one_third_last margin-30">	
			<?php if( get_field('imagen_vertical') ): ?>
				<img src="<?php the_field('imagen_vertical'); ?>" alt="" />
			<?php endif;?>
		</div>

	 
		<div class="column_two_thirds margin-30">	
		
			<?php if( get_field('imagen_horizontal') ): ?>
				<img src="<?php the_field('imagen_horizontal'); ?>" alt="" />
			<?php endif;?>
			
		</div>
		
		
		<div class="column_one_third">	
			<div class="entry-content">
				<?php the_field('columna_central'); ?>
			</div>
		</div>
		
		<div class="column_one_third_last">	
			<div class="entry-content">
				<?php the_field('columna_derecha'); ?>
			</div>
		</div>

			
		<?php edit_post_link( __( 'Editar', 'geobiota' ), '', '' ); ?>
	</article><!-- #post-## -->

<?php endwhile; ?>

</div><!--#content-->

<?php get_footer(); ?>