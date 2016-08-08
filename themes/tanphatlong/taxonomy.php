<?php get_header(); ?>

<?php
global $taxonomy,$term;

switch($taxonomy){
    case 'manage-menu-projects':
        include_once TEMPLATEPATH . '/templates/taxonomy/projects.taxonomy.page.php';
        break;
    default:
    	print 'Taxonomy';
        break;
}
?>

<?php get_footer(); ?>