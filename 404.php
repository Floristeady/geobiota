<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */

get_header(); ?>
<div id="content" class="content-page">
			<article style="margin-bottom:60px;" id="post-0" class="post error404 not-found" role="main">
				<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'geobiota' ); ?></h1>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'geobiota' ); ?></p>

			</article>
</div>
<?php get_footer(); ?>
