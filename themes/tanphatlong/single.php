<?php get_header(); ?>

<?php
global $post;
switch($post->post_type){
    case 'manage-projects':
        include_once TEMPLATEPATH . '/templates/project-detail.page.php';
        break;
    case 'post':
        include_once TEMPLATEPATH . '/templates/news-detail.page.php';
        break;
    default:
        break;
}
?>

<?php get_footer(); ?>