<?php

/**
 * Update the posts count to display in devcenter.
 *
 * @author Gary Kovar, Kellen Mace
 * @since  0.1.0
 * @param  WP_Query $query The current query.
 */
function wds_wintellect_blog_landing_posts_count( $query ) {

	if ( isset( $query->query['pagename'] ) && 'devcenter' == $query->query['pagename'] ) {

		// Get the sticky posts.
		$sticky = get_option( 'sticky_posts' );

		$sticky_count = 0;

		// Check if we have any.
		if ( count( $sticky ) ) {
			// Sort them in reverse order of when they were stuck, stickied, sticky'd.
			rsort( $sticky );

			// Unset all but the most recent.
			update_option( 'sticky_posts', array_slice( $sticky, 0, 1 ) );

			// Get the list of posts to not use in the loop.
			$sticky = array_slice( $sticky, 1, count( $sticky ) );

			// Set the offset.
			$sticky_count = 1;
		}

		$offset = ( $sticky_count <= 12 ) ? $sticky_count : 12;

		if ( ! $query->is_paged() ) {
			$query->set( 'posts_per_page', ( 12 - $offset ) );
			$query->set( 'post__not_in', $sticky );
		} else {
			$offset = ( ( $query->query_vars['paged'] - 1 ) * 12 ) - $offset;
			$query->set( 'posts_per_page', 12 );
			$query->set( 'offset', $offset );
		}
	}
}
add_action( 'pre_get_posts', 'wds_wintellect_blog_landing_posts_count', 1 );

?>