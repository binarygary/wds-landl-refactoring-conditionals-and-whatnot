<?php
/**
 * Echo a single category for a post.
 *
 * @author Gary Kovar
 */
function wds_wintellect_get_post_category() {
	$terms = get_the_category();

	if ( 1 === count( $terms ) ) {
		echo current( $terms )->category_nicename;
	} elseif ( count( $terms ) > 1 ) {
		$random = rand( 0, count( $terms ) - 1 );
		echo $terms[ $random ]->category_nicename;
	} else {
		echo 'devcenter';
	}
}