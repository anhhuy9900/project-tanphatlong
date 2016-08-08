<<<<<<< HEAD
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

=======
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

>>>>>>> 5e8b738e7437d36ce4598d8138e1f61019b3a423
<?php get_footer(); ?>