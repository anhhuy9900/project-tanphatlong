<?php get_header(); ?>

<?php
global $taxonomy,$term;

switch($taxonomy){
    case 'manage-menu-projects':
        include_once TEMPLATEPATH . '/templates/taxonomy/projects.taxonomy.page.php';
        break;
    case 'list-menu-product-services':
        include_once TEMPLATEPATH . '/templates/taxonomy/products.taxonomy.page.php';
        break;
    default:
    	print 'Taxonomy';
        break;
}
?>

<?php get_footer(); ?>