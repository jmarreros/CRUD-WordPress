<?php

global $wpdb;

$sql  = $wpdb->prepare( "SELECT * FROM " . TABLE_NAME . " WHERE id = %d", $id );
$item = $wpdb->get_row( $sql );

if ( $item ):
	ob_start();
	?>
    <form method="post" action="<?= admin_url( 'admin-post.php' ) ?>" class="frm-detail-fruits">
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required value="<?= $item->name ?>">
        </div>
        <div>
            <label for="variety">Variedad:</label>
            <input type="text" name="variety" id="variety" required value="<?= $item->variety ?>">
        </div>
        <div>
            <label for="name">Tipo:</label>
            <select name="type" id="type">
                <option value="1" <?php selected( $item->type, 1 ); ?>>Tipo 1</option>
                <option value="2" <?php selected( $item->type, 2 ); ?>>Tipo 2</option>
                <option value="3" <?php selected( $item->type, 3 ); ?>>Tipo 3</option>
                <option value="4" <?php selected( $item->type, 4 ); ?>>Tipo 4</option>
            </select>
        </div>
        <div>
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" value="<?= date( 'Y-m-d', strtotime( $item->date ) ) ?>">
        </div>
        <div>
            <label for="comment">Comentarios:</label>
            <textarea name="comment" id="comment" cols="20" rows="5"><?= $item->comment ?></textarea>
        </div>

        <div>
            <input type="hidden" name="id" value="<?= $item->id ?>">
            <?php wp_nonce_field( 'fruits-nonce', 'nonce' ); ?>
            <input type="hidden" name="action" value="save_custom_fruit">
            <input type="submit" name="submit" value="Grabar">
        </div>
    </form>

	<?php
	$str_form = ob_get_contents();
	ob_end_clean();
else:
	$str_form = "No existe ese elemento";
endif;

return $str_form;

