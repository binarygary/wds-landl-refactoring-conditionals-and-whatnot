<?php
/**
 * Checks whether the category has any public facing classes.
 *
 * @author Gary Kovar, Kellen Mace
 *
 * @param  int|WP_Term $course_category Term ID or term object.
 *
 * @return int $count count of how many public classes it has.
 */
function wds_wintellect_get_upcoming_public_classes_in_category_count( $course_category ) {

	$course_category = get_term( $course_category, 'wdswc-course-category' );

	if ( is_wp_error( $course_category ) ) {
		return 0;
	}

	global $wpdb;

	$courses = get_posts( array(
			'post_type' => 'wdswc-course',
			'tax_query' => array(
				array(
					'taxonomy' => 'wdswc-course-category',
					'field'    => 'id',
					'terms'    => $course_category,
				),
			),
		)
	);

	$count = 0;

	foreach ( $courses as $course ) {
		$count += absint( $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE post_id IN (SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='wds_public_class_course' AND meta_value='{$course->ID}' ) AND meta_key='wds_public_class_start' AND meta_value > NOW()" ) );
	}

	return $count;
}