<?php
global $post;
$cat = get_category( get_query_var( 'cat' ) );
$list_menu = get_list_menu_news();
if(!empty($list_menu)) :?>
    <div class="sidebar">

        <div class="category-widget widget">
            <h2><?php print __('Categories','tanphatlong');?></h2>
            <ul class="category-list">
                <?php foreach($list_menu as $menu) :
                    $category_ids = array();
                    if(is_single()) :
                        $categories = get_the_category( $post->ID );
                        if($category) :
                            foreach($categories as $category) :
                                $category_ids[]=  $category->term_id;
                            endforeach;
                        endif;

                        $class = in_array($menu->term_id, $category_ids) ? 'class="active"' : '';
                    else :
                        $class = (!empty($cat)) ? $menu->term_id == $cat->term_id ? 'class="active"' : '' : '';
                    endif;
                    ?>
                    <li>
                        <a href="<?=get_term_link($menu->term_id);?>"<?=$class;?>><?=$menu->name;?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
<?php endif;?>