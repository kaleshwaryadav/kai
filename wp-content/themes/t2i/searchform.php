<?php
/**
 * Template for displaying search forms in T2i
 *
 * @package WordPress
 * @subpackage T2i
 * @since 1.0
 * @version 1.0
 */
if(ICL_LANGUAGE_CODE=='de'){ $search="Suche"; } else { $search="Search";} 
?>
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo $search; ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>
