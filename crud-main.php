<?php
const SLUG_PAGE  = 'lista-frutas'; //slug de la página en donde se mostrará la tabla
const TABLE_NAME = 'custom_fruits'; // nombre de la tabla

// Show list or forms
add_filter( 'the_content', 'dcms_list_fruits_data' );

function dcms_list_fruits_data( $content ) {
	$custom = '';

	if ( is_page( SLUG_PAGE ) ) {
		$id     = $_GET['id'] ?? 0;
		$action = $_GET['action'] ?? '';

		if ( $action == 'new' ) {
			$custom = require( 'new.php' );
		} elseif ( $id && $action == 'edit' ) {
			$custom = require( 'edit.php' );
		} elseif ( $id && $action == 'delete' ) {
			$custom = require( 'delete.php' );
		} else {
			$result = $_GET['result'] ?? false;
			$custom = require( 'list.php' );
		}
	}

	return $content . $custom;
}

// Process Save
add_action( 'admin_post_nopriv_save_custom_fruit', 'process_save_custom_fruit' );
add_action( 'admin_post_save_custom_fruit', 'process_save_custom_fruit' );

function process_save_custom_fruit() {
	global $wpdb;

	verify_nonce();
	verify_user();

	$id              = intval( $_POST['id'] );
	$data            = [];
	$data['name']    = sanitize_text_field( $_POST['name'] );
	$data['variety'] = sanitize_text_field( $_POST['variety'] );
	$data['type']    = intval( $_POST['type'] );
	$data['date']    = date( 'Y-m-d', strtotime( $_POST['date'] ) );
	$data['comment'] = sanitize_textarea_field( $_POST['comment'] );

	$result = false;
	if ( $id > 0 ) {
		$result = $wpdb->update( TABLE_NAME, $data, [ 'id' => $id ] );
	} elseif ( $id === 0 ) {
		$result = $wpdb->insert( TABLE_NAME, $data );
	}

	wp_redirect( home_url( SLUG_PAGE ) . '?result=' . $result );
	exit;
}


// Process Save
add_action( 'admin_post_nopriv_delete_custom_fruit', 'process_delete_custom_fruit' );
add_action( 'admin_post_delete_custom_fruit', 'process_delete_custom_fruit' );

function process_delete_custom_fruit() {
	global $wpdb;

	verify_nonce();
	verify_user();

	$id = intval( $_POST['id'] );

	$result = false;
	if ( $id > 0 ) {
		$wpdb->delete( TABLE_NAME, [ 'id' => $id ] );
	}

	wp_redirect( home_url( SLUG_PAGE ) );
	exit;
}


function verify_nonce() {
	if ( ! wp_verify_nonce( $_POST['nonce'] ?? '', 'fruits-nonce' ) ) {
		wp_redirect( home_url( SLUG_PAGE ) . '?result=-1' );
		exit;
	}
}

function verify_user(){
	$user = wp_get_current_user();
	$allowed_roles = array( 'editor', 'administrator', 'author' );
	if ( count(array_intersect( $allowed_roles, $user->roles )) === 0  ) {
		wp_redirect( home_url( SLUG_PAGE ) . '?result=-1' );
		exit;
	}
}