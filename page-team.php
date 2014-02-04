<?php
/**
 * Template Name: P&aacute;gina Listado [Equipo]
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
		
		
		
		<div class="column_one_third_last only-img margin-30">	
			<div class="entry-content">
			<?php if( get_field('imagen_vertical_equipo') ): ?>
				<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('imagen_vertical_equipo'); ?>&w=370&h=482" alt="" />
			<?php endif;?>
			</div>
		</div>
		
		
		<div class="column_one_third">
		
			<h1 class="entry-title"><?php the_title(); ?><span></span></h1>
			
			<div class="entry-content">		
				<?php the_field('texto_columna_izquierda_equipo'); ?>			
			</div>
			
			<div class="entry-content">	
			<?php  $rows = get_field('personas_del_equipo_izquierda');  ?>
				
				<?php if($rows) { ?>
						
					<?php echo '<div id="team">';
					 
					foreach($rows as $row) { ?>

			 		<div class="person"> 
			 		    <?php if( $row['imagen_persona_izquierda'] ): ?> 
			 			<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_persona_izquierda'] ?>&w=370"/> 
			 			<?php endif;?>
			 			<h4><?php echo $row['nombre_persona_izquierda'] ?></h2>
			 			<p><?php echo $row['datos_persona_izquierda'] ?></p>
			 		</div>
	
				 	<?php } echo '</div>'; 
				
			} ?>
			</div>
		  
		</div>

	 
		<div class="column_two_thirds only-img margin-30">	
			<div class="entry-content">
			<?php if( get_field('imagen_horizontal_equipo') ): ?>
				<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('imagen_horizontal_equipo'); ?>&w=770&h=242" alt="" />
			<?php endif;?>
			</div>
			
		</div>
		
		
		<div class="column_one_third">	
			<div class="entry-content">	
			<?php  $rows = get_field('personas_del_equipo_central');  ?>
				
				<?php if($rows) { ?>
						
					<?php echo '<div id="team">';
					 
					foreach($rows as $row) { ?>

			 		<div class="person">
			 		 	<?php if( $row['imagen_persona_central'] ): ?> 
			 			<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_persona_central'] ?>&w=370"/> 
			 			<?php endif;?>
			 			<h4><?php echo $row['nombre_persona_central'] ?></h2>
			 			<p><?php echo $row['datos_persona_central'] ?></p>
			 		</div>
	
				 	<?php } echo '</div>'; 
				
			} ?>
			</div>
		</div>
		
		<div class="column_one_third_last">	
			<div class="entry-content">	
			<?php  $rows = get_field('personas_del_equipo_derecha');  ?>
				
				<?php if($rows) { ?>
						
					<?php echo '<div id="team">';
					 
					foreach($rows as $row) { ?>

			 		<div class="person"> 
			 		   <?php if( $row['imagen_persona_derecha']  ): ?>
			 				<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_persona_derecha'] ?>&w=370"/> 
			 			<?php endif;?>
			 			<h4><?php echo $row['nombre_persona_derecha'] ?></h2>
			 			<p><?php echo $row['datos_persona_derecha'] ?></p>
			 		</div>
	
				 	<?php } echo '</div>'; 
				
			} ?>
			</div>		</div>

			
		<?php edit_post_link( __( 'Editar', 'geobiota' ), '', '' ); ?>
	</article><!-- #post-## -->

<?php endwhile; ?>

</div><!--#content-->

<?php get_footer(); ?>