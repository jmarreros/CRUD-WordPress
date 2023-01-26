<?php

global $wpdb;

$items = $wpdb->get_results( "SELECT * FROM " . TABLE_NAME );

$html = '<div>
			<a href="?action=new">Nueva fruta</a>
		</div>';

if ( $result !== false ) {
	if ( $result >= 0 ) {
		$html .= '<div class="message">Los datos se guardaron correctamente</div>';
	} else {
		$html .= '<div class="message">Hubo un error al guardar los cambios</div>';
	}
}


// nombre de los campos de la tabla
foreach ( $items as $item ) {
	$html .= '<tr>
				<td>' . $item->id . '</td>
				<td>' . $item->name . '</td>
				<td>' . $item->variety . '</td>
				<td>' . $item->type . '</td>
				<td>' . date_format( date_create( $item->date ), 'd-m-Y' ) . '</td>
				<td>' . $item->comment . '</td>
				<td>
					<a href="?action=edit&id=' . $item->id . '">Editar</a>
					<a href="?action=delete&id=' . $item->id . '">Borrar</a>
				</td>
			</tr>';
}

$template = '<table class="table-data">
			          <tr>
			            <th>ID</th>
			            <th>Nombre</th>
			            <th>Variedad</th>
			            <th>Tipo</th>
			            <th>Fecha</th>
			            <th>Comentarios</th>
			            <th>Acciones</th>
			          </tr>
			          {data}
			        </table>';

return str_replace( '{data}', $html, $template );