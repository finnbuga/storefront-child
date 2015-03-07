<?php
/**
 * The template for displaying product availability.
 *
 * @author Florin Buga
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
?>

<?php if ( $term_list = get_the_term_list( $post->ID, 'disponibilitate', '', ', ', '' ) ) : ?>

	<div class="disponibilitate">
		<span><?php echo strip_tags( $term_list ); ?></span>
	</div>

<?php endif; ?>
