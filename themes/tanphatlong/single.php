<?php
global $post;
switch($post->post_type){
    case 'manage-projects':
        include_once TEMPLATEPATH . '/templates/project-detail.page.php';
        break;
    case 'post':
        include_once TEMPLATEPATH . '/templates/news-detail.page.php';
        break;
    case 'product-services':
        include_once TEMPLATEPATH . '/templates/product-detail.page.php';
        break;
    case 'abilities':
        include_once TEMPLATEPATH . '/templates/abilities-detail.page.php';
        break;
    case 'manage-recruitment':
        include_once TEMPLATEPATH . '/templates/recruitment-detail.page.php';
        break;
    default:
        print 'Single';
        break;
}
?>

<?php get_footer(); ?>