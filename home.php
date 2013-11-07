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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-meta">
						<?php geobiota_posted_on(); ?>
					</div><!-- .entry-meta -->
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'geobiota' ), 'after' => '' ) ); ?>
					</div><!-- .entry-content -->
<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>

<?php endif; ?>
   				   <?php comments_template( '', true ); ?>
 					
					<footer class="entry-utility">
						<?php geobiota_posted_in(); ?>
					</footer><!-- .entry-utility -->
					   <?php edit_post_link( __( 'Edit', 'geobiota' ), '<span class="edit-link">', '</span>' ); ?>
				</article><!-- #post-## -->

<?php endwhile; // end of the loop. ?>

</div><!--#content-->

<?php get_footer(); ?>
