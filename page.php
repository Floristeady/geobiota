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
		
			<a title="<?php _e('Ir al inicio') ?>" href="<?php echo bloginfo('url'); ?>">

				<?php $args = array(
						'post_type'	=> 'page',
						'posts_per_page' => 1,
						'meta_query' => array(
							array( 'key' => 'publicar_logotipos', 'value' => '1')
						) );
					$page_logo = new WP_Query( $args ); ?>
					
				<?php if ( $page_logo->have_posts() ) { ?>
				
				<?php while ( $page_logo->have_posts() ) : $page_logo->the_post(); ?>
				
				<?php  $rows = get_field('logotipos_geobiota');  ?>
				
						<?php if($rows) { ?>
						
						<?php echo '<div class="logo-slider flexslider"><ul class="slides">';
						 
							foreach($rows as $row) { ?>
		
					 		<li> <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_logotipo'] ?>&w=370&h=480"/> </li>
		
							<?php } echo '</ul></div>';  
							
						}  else  { ?>
									<img src="<?php bloginfo('template_url') ?>/images/elements/imagen-geobiota.jpg"/>  
											
						<?php } endwhile; ?>

				<?php  } else { ?>
				<img src="<?php bloginfo('template_url') ?>/images/elements/imagen-geobiota.jpg"/>  	<?php } ?>	
				
				<?php wp_reset_postdata();?>	
	
			</a>
		</div>
		
		
		<div class="column_one_third">	
		
			<h2 class="entry-excerpt"><?php the_excerpt(); ?><span></span></h2>
			
			<div class="entry-content no-padding">
				<?php the_content(); ?>
			</div>
		</div>
		
		<div class="column_one_third_last margin-30">	
			<?php if( get_field('imagen_vertical') ): ?>
				<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('imagen_vertical'); ?>&w=370&h=482" alt="" />
			<?php endif;?>
		</div>
		
		<div class="column_one_third">	

			<h1 class="entry-title"><?php the_title(); ?><span></span></h1>
			
			<div class="entry-content">		
				<?php the_field('columna_izquierda'); ?>			
			</div>
			
		</div>

	 
		<div class="column_two_thirds margin-30">	
		
			<?php if( get_field('imagen_horizontal') ): ?>
				<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('imagen_horizontal'); ?>&w=770&h=242" alt="" />
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