<?php

// This is a dumb example.
function wds_what_letter_is_this( $letter ) {

	$description = '';

	switch ( $letter ) {
		case 'a':
			$description = 'It is A';
			break;
		case 'b':
			$description = 'It is B';
			break;
		case 'c':
		case 'd':
			$description = 'It is C or D';
			break;
		default:
			$description = 'It is another letter';
	}

	return $description;
}