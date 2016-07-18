<?php 

/*
* Este archivo permite ordenar los posts mediante los siguientes parametros
*/

/*
* Post type = Productos dorita
*/
$post_type = "producto-dorita";


if(!function_exists('mbe_change_table_column_titles')){

    function mbe_change_table_column_titles($columns){
        $columns['cat-producto-dorita'] = 'Cat. Producto';
        return $columns;
    }
    add_filter("manage_".$post_type."_posts_columns", 'mbe_change_table_column_titles');
}

if(!function_exists('mbe_change_column_rows')){

    function mbe_change_column_rows($column_name, $post_id){
        if($column_name == 'cat-producto-dorita'){
            echo get_the_term_list($post_id, 'producto_category', '', ', ', '').PHP_EOL;
        }
    }
    add_action("manage_".$post_type."_posts_custom_column", 'mbe_change_column_rows', 10, 2);
}

if(!function_exists('mbe_change_sortable_columns')){

    function mbe_change_sortable_columns($columns){
			$columns['cat-producto-dorita'] = 'Cat. Producto';
			$columns['categories']          = 'categories';
        return $columns;
    }
    add_filter("manage_edit-".$post_type."_sortable_columns", 'mbe_change_sortable_columns');
}

if(!function_exists('mbe_sort_custom_column')){
	function mbe_sort_custom_column($clauses, $wp_query){
		global $wpdb;
		if(isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'categories')
		{
			$clauses['join'] .= "LEFT OUTER JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
			LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
			LEFT OUTER JOIN {$wpdb->terms} USING (term_id) ";
			
			$clauses['where']  .= "AND (taxonomy = 'category' OR taxonomy IS NULL)";
			
			$clauses['groupby'] = "object_id";
			
			$clauses['orderby'] = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC)";

			if(strtoupper($wp_query->get('order')) == 'ASC'){
				$clauses['orderby'] .= 'ASC';
			} else{
				$clauses['orderby'] .= 'DESC';
			}
		}	
		return $clauses;
	}
	add_filter('posts_clauses', 'mbe_sort_custom_column', 10, 2);
}



?>