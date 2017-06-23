<?php
function wds_wintellect_display_class_taxonomy_filter() {

	// Get the list of categories for courses.
	$course_categories = get_terms( array(
		'taxonomy' => 'wdswc-course-category',
		'orderby'  => 'order',
		'order'    => 'ASC',
	) );

	if ( ! is_array( $course_categories ) || is_wp_error( $course_categories ) ) {
		return;
	}

	// Start the filter markup. ?>
	<nav class="class-taxonomy-filter">
		<select class="course-category-list" placeholder="<?php esc_attr_e( 'All Technologies', 'wintellect' ); ?>" onchange="window.location.href = this.value;">

			<?php foreach ( $course_categories as $course_category ) : ?>

				<option value="<?php echo esc_url( wdswc_get_course_category_filter_url( $course_category ) ); ?>" <?php selected( $course_category->slug, wds_wintellect_get_topic_filter_get_param() ); ?>><?php echo esc_html( $course_category->name ); ?></option>

			<?php endforeach; ?>

		</select>
		<a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Private Onsite', 'wintellect' ); ?></a>
		<a href="<?php echo esc_html( add_query_arg( 'class-type', 'public-classes', get_permalink() ) ); ?>" class="button"><?php esc_html_e( 'Public Classes', 'wintellect' ); ?></a>
	</nav>

	<?php
}