<?php
/**
 * Migrate site-owned data away from retired presentation plugins.
 *
 * @package the9-store
 */

defined( 'ABSPATH' ) || exit;

/** Return a clean list of phone numbers stored one per line. */
function the9_store_phone_list( $value ) {
	return array_values( array_unique( array_filter( array_map( 'trim', preg_split( '/\R+/', (string) $value ) ) ) ) );
}

/** Convert a display phone number to a conservative tel: target. */
function the9_store_phone_url( $phone ) {
	$number = preg_replace( '/[^0-9+]/', '', (string) $phone );
	return $number ? 'tel:' . $number : '';
}

/** Read footer branches from theme settings only. */
function the9_store_footer_branches() {
	$branches = array();
	foreach ( array( 1, 2 ) as $index ) {
		$branch = array(
			'name'    => sanitize_text_field( get_theme_mod( "footer_branch_{$index}_name", '' ) ),
			'address' => sanitize_textarea_field( get_theme_mod( "footer_branch_{$index}_address", '' ) ),
			'phones'  => the9_store_phone_list( get_theme_mod( "footer_branch_{$index}_phones", '' ) ),
			'hours'   => sanitize_textarea_field( get_theme_mod( "footer_branch_{$index}_hours", '' ) ),
			'map'     => esc_url_raw( get_theme_mod( "footer_branch_{$index}_map", '' ) ),
		);
		if ( array_filter( $branch ) ) {
			$branches[] = $branch;
		}
	}
	return $branches;
}

/**
 * Copy existing saved shell data once. No plugin defaults or commercial facts
 * are imported; only values already owned by this WordPress installation.
 */
function the9_store_maybe_migrate_shell_data() {
	if ( get_option( 'the9_store_shell_data_migration', false ) ) {
		return;
	}

	$legacy = get_option( 'shams_global_shell_options', array() );
	if ( ! is_array( $legacy ) || ! $legacy ) {
		return;
	}

	$map = array(
		'footer_branch_1_name'    => 'downtown_name',
		'footer_branch_1_address' => 'downtown_address',
		'footer_branch_1_phones'  => 'downtown_phones',
		'footer_branch_1_hours'   => 'downtown_hours',
		'footer_branch_1_map'     => 'downtown_map',
		'footer_branch_2_name'    => 'heliopolis_name',
		'footer_branch_2_address' => 'heliopolis_address',
		'footer_branch_2_phones'  => 'heliopolis_phones',
		'footer_branch_2_hours'   => 'heliopolis_hours',
		'footer_branch_2_map'     => 'heliopolis_map',
	);

	foreach ( $map as $theme_key => $legacy_key ) {
		if ( '' === get_theme_mod( $theme_key, '' ) && ! empty( $legacy[ $legacy_key ] ) ) {
			$value = false !== strpos( $theme_key, '_map' ) ? esc_url_raw( $legacy[ $legacy_key ] ) : sanitize_textarea_field( $legacy[ $legacy_key ] );
			set_theme_mod( $theme_key, $value );
		}
	}

	if ( '' === get_theme_mod( 'header_contact_url', '' ) ) {
		$phones = the9_store_phone_list( $legacy['downtown_phones'] ?? '' );
		if ( $phones ) {
			set_theme_mod( '__dialogue', $phones[0] );
			set_theme_mod( 'header_contact_url', the9_store_phone_url( $phones[0] ) );
		}
	}

	update_option( 'the9_store_shell_data_migration', '1', false );
}
add_action( 'after_switch_theme', 'the9_store_maybe_migrate_shell_data' );
add_action( 'admin_init', 'the9_store_maybe_migrate_shell_data' );
