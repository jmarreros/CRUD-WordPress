<?php
	ob_start();
	?>
    <form method="post" action="<?= admin_url( 'admin-post.php' ) ?>" class="frm-detail-fruits">
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required value="">
        </div>
        <div>
            <label for="variety">Variedad:</label>
            <input type="text" name="variety" id="variety" required value="">
        </div>
        <div>
            <label for="name">Tipo:</label>
            <select name="type" id="type">
                <option value="1">Tipo 1</option>
                <option value="2">Tipo 2</option>
                <option value="3">Tipo 3</option>
                <option value="4">Tipo 4</option>
            </select>
        </div>
        <div>
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" value="">
        </div>
        <div>
            <label for="comment">Comentarios:</label>
            <textarea name="comment" id="comment" cols="20" rows="5"></textarea>
        </div>

        <div>
            <input type="hidden" name="id" value="0">
	        <?php wp_nonce_field( 'fruits-nonce', 'nonce' ); ?>
            <input type="hidden" name="action" value="save_custom_fruit">
            <input type="submit" name="submit" value="Grabar">
        </div>
    </form>

	<?php
	$str_form = ob_get_contents();
	ob_end_clean();

return $str_form;

