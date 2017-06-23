<?php
class landlexampe {

	// Stuff happened.

	private function is_submenu_items_parent_a_new_menu_item( $parent_slug ) {

		$new_menu_item_slugs = array();

		foreach ( $this->new_menu_items_formatted as $new_menu_item_formatted ) {
			$new_menu_item_slugs[] = $new_menu_item_formatted->menu_slug;
		}

		foreach ( $new_menu_item_slugs as $menu_item_slug ) {
			if ( $parent_slug === $menu_item_slug ) {
				return true;
			}
		}

		return false;
	}
}
