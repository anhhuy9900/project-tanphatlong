<?php
global $taxonomy,$post;
$list_menu = get_list_menu_abilities();
if(!empty($list_menu)) :?>
    <div class="services-tabs">
        <ul>
            <?php foreach($list_menu as $menu) :?>
                <li<?=$menu->post_name == $post->post_name ? ' class="active"' : '';?>>
                    <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>" title="<?=$menu->post_title;?>"><?=$menu->post_title;?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>