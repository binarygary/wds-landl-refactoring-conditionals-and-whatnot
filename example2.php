<?php
function wds_eight_get_portfolio_posts() {

	static $portfolio_posts = null;

	// If value stored in static variable is valid, use it.
	if ( is_array( $portfolio_posts ) ) {
		return $portfolio_posts;
	}

	$portfolio_posts = get_transient( 'wds_portfolio_posts' );

	// If value stored in transient is valid and we're not busting the cache, use it.
	if ( is_array( $portfolio_posts ) && ! isset( $_GET['delete-transients'] ) ) {
		return $portfolio_posts;
	}

	$portfolio_posts = array();

	// Run a new query to fetch the data.
	$portfolio_query = new WP_Query( array(
		'posts_per_page'         => 500,
		'post_type'              => 'portfolio',
		'fields'                 => 'ids',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	) );

	if ( $portfolio_query->have_posts() ) {
		$portfolio_posts = $portfolio_query->get_posts();
	}

	set_transient( 'wds_portfolio_posts', $portfolio_posts, WEEK_IN_SECONDS );

	return $portfolio_posts;
}