<?php 
/**
** Archivo crea campos personalizados para las taxonomías especificadas
*/

/**
* TAXONOMIAS ESPECIFICADAS
*/

$taxonomies    = array();
$taxonomies[0] = 'servicio_category'; //categoría de servicio
$taxonomies[1] = 'producto_category'; //categoría de producto


function theme_taxonomy_add_custom_fields(){
?>

<!-- ##########################  -->
<!-- CAMPO PERSONALIZADO IMAGEN  -->
<!-- ##########################  -->
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="theme_tax_img"><?php _e('Agregar Imagen Destacada'); ?></label>  
    </th>  
    <td>  
        <input type="text" id="theme_tax_img" name="term_meta[theme_tax_img]" size="25" style="width:60%;" value="" />

        <!-- Separación --> <p></p>
        <!-- Contenedor Agregar Imagen Previa -->
        <div class="container-preview"> </div> 
        
        <!-- Separación --> <p></p>
        <!-- Botón agregar imágen --> 
        <button id="js-add-img-tax" class="button button-primary" data-input="term_meta[theme_tax_img_<?= $t_id; ?>]" >
            <?php _e( 'Agregar Imagen' , LANG ); ?>
        </button> 

        <!-- Botón remover Imagen Oculto -->
        <button id="js-remove-img-tax" class="button button-primary">
            <?php _e( 'Remover Imagen' , LANG ); ?>
        </button> 

        <!-- Separación --> <p></p>

        <!-- Descripcion -->
        <p class="description"><?php _e('Subir una imagen destacada medida: 980x659'); ?></p>
        <br/>  
    </td>  
</tr> 

<!-- ###################################  -->
<!-- CAMPO PERSONALIZADO COLOR TAXONOMIA  -->
<!-- ###################################  --> 
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="theme_tax_color"><?php _e('Asignar Color Destacado: '); ?></label> 
    </th>   <!-- /.scope="row" -->
    <td>
        <input type="text" class="js-add-theme-color" name="term_meta[theme_tax_color]" value="#000000" />
        <p class="description"> <?php _e( "Por defecto Negro", LANG ); ?></p>

        <!-- Separación--> <br />
    </td>
</tr> <!-- /.form-field -->


<?php
} // end of function

function theme_taxonomy_edit_custom_fields( $term  ) {  
   // Compruebe para el meta taxonomía existente para el término que está editando 
	$t_id      = $term->term_id; // Obtener el ID del término que está editando
	$term_meta = get_option( "taxonomy_$t_id" ); // Hacer el chequeo 
    
    #var_dump($term_meta);
   
?>  
  
<!-- ##########################  -->
<!-- CAMPO PERSONALIZADO IMAGEN  -->
<!-- ##########################  -->
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="term_meta[theme_tax_img]"><?php _e('Agregar Imagen Destacada'); ?></label>  
    </th>  
    <td>  
        <?php 
            /*** Url de Imagen *****/ 
            $input_img = $term_meta["theme_tax_img"];
        ?>
        <!-- -->
        <input type="text" id="theme_tax_img" name="term_meta[theme_tax_img]" size="25" style="width:60%;" value="<?= !empty($input_img) ? $input_img : ""; ?>">

        <!-- Separación --> <p></p>

        <!-- Imagen Previa -->
        <div class="container-preview">
            <?php if( !empty($input_img ) ) : ?>
                    <img src="<?= $input_img; ?>" style="width:150px;height:150px;" />
            <?php else: ?>
                <p> Archivo no Encontrado Elija nueva ruta </p>
            <?php endif ?>
        </div> <!-- /.container-preview  -->

        <!-- Separación --> <p></p>

        <!-- Botón agregar imágen --> 
        <button id="js-add-img-tax" class="button button-primary" data-input="term_meta[theme_tax_img_<?= $t_id; ?>]" >
            <?php _e( 'Agregar Imagen' , LANG ); ?>
        </button> 

        <!-- Botón remover Imagen Oculto -->
        <button id="js-remove-img-tax" class="button button-primary">
            <?php _e( 'Remover Imagen' , LANG ); ?>
        </button> 

        <!-- Separación --> <p></p>

        <p class="description"><?php _e('Subir una imagen destacada medida: 980x659'); ?></p> 
        <br/> 
        
    </td>  
</tr>  

<!-- ###################################  -->
<!-- CAMPO PERSONALIZADO COLOR TAXONOMIA  -->
<!-- ###################################  --> 
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="theme_tax_color"><?php _e('Asignar Color Destacado: '); ?></label> 
    </th>   <!-- /.scope="row" -->
    <td>
        <?php /*** Color taxonomía *****/ 
            $input_color = !empty($term_meta["theme_tax_color"]) ? $term_meta["theme_tax_color"] : "#000000" ;
        ?>
        <!-- -->
        <input type="text" class="js-add-theme-color" name="term_meta[theme_tax_color]" value="<?= $input_color; ?>" />
        <p class="description"> <?php _e( "Por defecto Negro", LANG ); ?></p>

        <!-- Separación--> <br />
    </td>
</tr> <!-- /.form-field -->


<?php  
}  

// Una función de devolución de llamada para salvar nuestro campo de la taxonomía extra (s)  
function save_taxonomy_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys  = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}  

/**
** Agregamos los hooks necesarios segun cuantas taxonomías hayamos seteado
*/
foreach( $taxonomies as $tax ){
    // Agregue hooks para mostrar en la página de seteo 
    add_action( $tax . "_add_form_fields", 'theme_taxonomy_add_custom_fields', 10, 2 );  
    
    // Agregue los campos de la taxonomía , utilizando nuestra función de devolución de llamada
    add_action( $tax . "_edit_form_fields", 'theme_taxonomy_edit_custom_fields', 10, 2 );  
  
    // Guarde los cambios realizados en la taxonomía , utilizando nuestra función de devolución de llamada 
    add_action( "edited_" . $tax , 'save_taxonomy_custom_fields', 10, 2 );  
    add_action( "create_" . $tax , 'save_taxonomy_custom_fields', 10, 2 );

}; /* end of foreach*/


