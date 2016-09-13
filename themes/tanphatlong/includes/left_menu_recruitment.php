<?php
global $post;
$list_menu = func_get_list_menu_recruitment();

$parent_slug = pll_current_language() == 'vi' ? 'tuyen-dung' : 'recruitment';
$page_recruitment = get_page_by_path( $parent_slug );
?>
<?php if(!empty($list_menu)) :?>
    <div class="services-tabs">
        <ul>
            <li<?=$post->post_name == 'tuyen-dung' || $post->post_name == 'recruitment' ? ' class="active"' : '';?>>
                <a href="<?php echo esc_url( get_permalink($page_recruitment->ID) ); ?>" title="<?=$page_recruitment->post_title;?>"><?=$page_recruitment->post_title;?></a>
            </li>
            <?php foreach($list_menu as $menu) :
                $category_id = is_single() ? $menu->post_name == 'vi-tri-tuyen-dung' || $menu->post_name == 'career-opportunities' ? $menu->ID : 0 : $post->ID;
                ?>
                <li<?=$menu->ID == $category_id ? ' class="active"' : '';?>>
                    <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>" title="<?=$menu->post_title;?>"><?=$menu->post_title;?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>