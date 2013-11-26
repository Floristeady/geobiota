<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */

get_header(); ?>

<div id="content" style="margin-top:30px;">

<?php if ( have_posts() ) : ?>
				<h1><?php printf( __( 'Resultados para: %s', 'geobiota' ), '' . get_search_query() . '' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
					<h2><?php _e( 'No hemos encontrado lo que buscas.', 'geobiota' ); ?></h2>
					<p><?php _e( 'Disculpa, pero tu b&uacute;squeda no ha encontrado resultado, inténtalo nuevamente con otras palabras.', 'geobiota' ); ?></p>
					<?php get_search_form(); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>
