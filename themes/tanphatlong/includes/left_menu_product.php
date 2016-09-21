<?php
//global $taxonomy,$term;
global $post;
//$list_menu = get_list_menu_products();
$list_menu = get_list_records_products();
if(!empty($list_menu['results'])) :?>
    <div class="sidebar">
        <div class="category-widget widget">
            <h2><?php print __('Categories','tanphatlong');?></h2>
            <ul class="category-list">
                <?php foreach($list_menu['results'] as $menu) :?>
                    <li>
                        <a href="<?php echo esc_url( get_permalink($menu->ID) ); ?>"<?=$menu->ID == $post->ID ? ' class="active"' : ''?>><?=$menu->post_title;?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
<?php endif;?>