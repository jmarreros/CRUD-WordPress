<?php

global $wpdb;

$sql  = $wpdb->prepare( "SELECT name FROM " . TABLE_NAME . " WHERE id = %d", $id );
$name = $wpdb->get_var( $sql );

ob_start();
?>

<h3>¿Estas seguro de eliminar <?= $name ?>?</h3>

<form method="post" action="<?= admin_url( 'admin-post.php' ) ?>" class="frm-detail-fruits">
    <input type="hidden" name="id" value="<?= $id ?>">
	<?php wp_nonce_field( 'fruits-nonce', 'nonce' ); ?>
    <input type="hidden" name="action" value="delete_custom_fruit">
    <input type="submit" name="submit" value="Eliminar">
    <a href="<?= home_url( SLUG_PAGE ) ?>">Cancelar</a>
</form>

<?php
$str_form = ob_get_contents();
ob_end_clean();

return $str_form;