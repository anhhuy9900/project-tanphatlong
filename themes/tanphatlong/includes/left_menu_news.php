<?php
$cat = get_category( get_query_var( 'cat' ) );
$list_menu = get_list_menu_news();
if(!empty($list_menu)) :?>
    <div class="sidebar">

        <div class="category-widget widget">
            <h2><?php print __('Categories','tanphatlong');?></h2>
            <ul class="category-list">
                <?php foreach($list_menu as $menu) :?>
                    <li>
                        <a href="<?=get_term_link($menu->term_id);?>"<?=(!empty($cat) ? $menu->slug == $cat->slug ? ' class="active"' : '' : '');?>><?=$menu->name;?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
<?php endif;?>