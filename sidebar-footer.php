<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
	)
		return;
	// If we get this far, we have widgets. Let's do this.
?>

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
					<ul class="widget-list column_big">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
					<ul class="widget-list column_small">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'three-footer-widget-area' ) ) : ?>
					<ul class="widget-list column_large">
						<?php dynamic_sidebar( 'three-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'four-footer-widget-area' ) ) : ?>
					<ul class="widget-list column_medium">
						<?php dynamic_sidebar( 'four-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>


