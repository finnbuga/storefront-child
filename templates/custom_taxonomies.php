<?php global $post; ?>

<?php if ( $term_list = get_the_term_list( $post->ID, 'atentionari', '', ', ', '' ) ) : ?>

	<div class="atentionari">
		<span><?php echo strip_tags( $term_list ); ?></span>
	</div>

<?php endif; ?>

<ul class="custom_taxonomies">

	<?php $custom_taxonomies = array( 'colectii' , 'stil', 'dimensiuni', 'materiale', 'sistem de inchidere', 
		'accesorii', 'culori', 'origine', 'metoda de fabricatie', 'instructiuni de intretinere' ); ?>
	<?php foreach ($custom_taxonomies as $taxonomy) : ?>
		<?php if ( $term_list = get_the_term_list( $post->ID, $taxonomy, '', ', ', '' ) ) : ?>
	
			<li>
				<label><?php echo ucfirst( $taxonomy ); ?>: </label>
				<span><?php echo strip_tags( $term_list ); ?></span>
			</li>
	
		<?php endif; ?>
	<?php endforeach; ?>

</ul>
