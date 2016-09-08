<?php
global $post;
$list_menu = func_get_list_menu_recruitment();

?>
<?php if(!empty($list_menu)) :?>
    <div class="services-tabs">
        <ul>
            <?php foreach($list_menu as $menu) :?>
                <li<?=$menu->ID == $post->ID ? ' class="active"' : '';?>>
                    <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>" title="<?=$menu->post_title;?>"><?=$menu->post_title;?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>