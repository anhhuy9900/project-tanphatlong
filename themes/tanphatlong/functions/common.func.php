<?php


if(!function_exists('is_url_exist')){
    function is_url_exist($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($code == 200){
           $status = true;
        }else{
          $status = false;
        }
        curl_close($ch);
       return $status;
    }
}

if (!function_exists('pr')) {
    function pr($data, $type = 0) {
        print '<pre>';
        print_r($data);
        print '</pre>';
        if ($type != 0) {
            exit();
        }
    }
}

if ( ! function_exists('_CutText')){
    function _CutText($text, $n=80 , $type = '') 
    { 
        // string is shorter than n, return as is
        if (strlen($text) <= $n) {
            return $text;}
        $text= substr($text, 0, $n);
        if ($text[$n-1] == ' ') {
            return trim($text)."...";
        }
        $x  = explode(" ", $text);
        $sz = sizeof($x);
        if ($sz <= 1)   {
            return $text."...";}
        $x[$sz-1] = '';
        return trim(implode(" ", $x)).(!$type?"...":"");
    }
}

function _security_string($value){
    $data = htmlspecialchars(strip_tags($value));

    return $data;
}


if ( ! function_exists('_toSlug'))
{
    function _toSlug($string) {
        $string= trim(_cutUnicode($string));
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $string);
        $string = strtolower(trim($string, '-'));
        $string = preg_replace("/[\/_|+ -]+/", '-', $string);
        return $string;
    }
}

if ( ! function_exists('cutUnicode'))
{
    function _cutUnicode($str){ //Cắt dấu tiếng việt
          if(!$str) return false;
           $unicode = array(
             'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
             'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
             'd'=>'đ',
             'D'=>'Đ',
             'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
             'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
             'i'=>'í|ì|ỉ|ĩ|ị',
             'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
             'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
             'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
             'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
             'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
             'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
             'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
           );
           foreach($unicode as $khongdau=>$codau) {
                $arr=explode("|",$codau);
                $str = str_replace($arr,$khongdau,$str);
           }
        return $str;
    }
}

if (!function_exists('_explode_textarea_array')) {

    function _explode_textarea_array($string = '') {
        $textarea = array();
        $str_replace = array("\r", "\r\n", "<p>&nbsp;</p>","<p>","</p>","<div>","</div>","<br>","<br />");
        $text = str_replace( $str_replace, "\n", str_replace( "\r\n", "\n", $string ) );
        $splitted = explode( "\n",  $text);
        if(!empty($splitted)){
            foreach($splitted as $split){
                if($split){
                    $textarea[] = $split;
                }
            }
        }
        return $textarea;
    }
}

if (!function_exists('__pagination')) {

    function __pagination($totalRows, $pageNum = 1, $pageSize, $limit = 3) {
        global $wp;
        $current_url = home_url( $wp->request );
        settype($totalRows, "int");
        settype($pageSize, "int");
        if ($totalRows <= 0)
            return "";
        $totalPages = ceil($totalRows / $pageSize);
        if ($totalPages <= 1)
            return "";
        $currentPage = $pageNum;
        if ($currentPage <= 0 || $currentPage > $totalPages)
            $currentPage = 1;

        //From to
        $form = $currentPage - $limit;
        $to = $currentPage + $limit;

        //Tinh toan From to
        if ($form <= 0) {
            $form = 1;
            $to = $limit * 2;
        };
        if ($to > $totalPages)
            $to = $totalPages;

        //Tinh toan nut first prev next last
        $first = '';
        $prev = '';
        $next = '';
        $last = '';
        $link = '';

        //Link URL
        $linkUrl = $current_url;

        $get = '';
        $querystring = '';
        if ($_GET) {
            foreach ($_GET as $k => $v) {
                if ($k != 'page')
                    $querystring = $querystring . "&{$k}={$v}";
            }
            $querystring = substr($querystring, 1);
            $get.='?' . $querystring;
        }
        $sep = (!empty($querystring)) ? '&' : '';
        $linkUrl = $linkUrl . '?' . $querystring . $sep . 'page=';

        if ($currentPage > $limit + 2) {
            /** first */
            //$first= "<a href='$linkUrl' class='first'>...</a>&nbsp;";
        }

        /*         * **** prev ** */
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $prev = "<li><a href='$linkUrl$prevPage' class='prev-pag'> PREV </a></li>";
        }

        /*         * *Next** */
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $next = "<li><a href='$linkUrl$nextPage' class='next-pag'> NEXT </a></li>";
        }

        /*         * *Last** */
        if ($currentPage < $totalPages - 4) {
            $lastPage = $totalPages;
            //$last= "<a href='$linkUrl$lastPage' class='last'>...</a>";
        }

        /*         * *Link** */
        for ($i = $form; $i <= $to; $i++) {
            if ($currentPage == $i)
                $link.= "<li><a href='javascript:;' class='active'>$i</a></li>";
            else
                $link.= "<li><a href='$linkUrl$i'>$i</a></li>";
        }

        $pagination = '<ul class="pagination-list">' . $first . $prev . $link . $next . $last . '</ul>';

        return $pagination;
    }

//pagelistLimited   
}

if (!function_exists('pagination_ajax')) {
    function pagination_ajax($totalRow, $pageNum = 1, $pageSize, $limit = 3) {
        global $wp;
        $current_url = home_url( $wp->request );
        settype($totalRow, "int"); settype($pageSize, "int");
        $totalPage = ceil($totalRow / $pageSize);
        if ($totalRow <= 0 || $totalPage <= 1) return "";
  
        $currentPage = $pageNum;
        if ($currentPage <= 0 || $currentPage > $totalPage) $currentPage = 1;

        $form = $currentPage - $limit;
        $to = $currentPage + $limit;

        if ($form <= 0) {
            $form = 1; $to = $limit * 2;
        };
        
        if ($to > $totalPage) $to = $totalPage;

        $first = '';$prev = '';$next = '';$last = '';$link = '';

        //Link URL
        $linkUrl = $current_url;

        $get = ''; $querystring = '';
        if ($_GET) {
            foreach ($_GET as $k => $v) {
                if ($k != 'page')
                    $querystring = $querystring . "&{$k}={$v}";
            }
            $querystring = substr($querystring, 1);
            $get.='?' . $querystring;
        }
        $sep = (!empty($querystring)) ? '&' : '';
        $linkUrl = $linkUrl . '?' . $querystring . $sep . 'page=';
        
        /* FIRST */
        if ($currentPage > $limit + 2) {
            //$first= "<a href='$linkUrl' class='first'>...</a>&nbsp;";
        }

        /* PREV */
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $prev = '<li class="pagingPrev"><a href="javascript:;" class="pagi_ajax" data-page="'.$prevPage.'" class="prev"> << </a></li>&nbsp;';
        }

        /* NEXT */
        if ($currentPage < $totalPage) {
            $nextPage = $currentPage + 1;
            $next = '&nbsp;<li class="pagingNext"><a href="javascript:;" class="pagi_ajax" data-page="'.$nextPage.'" class="next"> >> </a></li>';
        }

        /* LAST */
        if ($currentPage < $totalPage - 4) {
            $lastPage = $totalPage;
            //$last= "<a href='$linkUrl$lastPage' class='last'>...</a>";
        }

        /* LINK */
        for ($i = $form; $i <= $to; $i++) {
            if ($currentPage == $i)
                $link.= '<span>'.$i.'</span>&nbsp;';
            else
                $link.= '<li><a href="javascript:;" class="pagi_ajax" data-page="'.$i.'">'.$i.'</a></li>&nbsp;';
        }

        $pagination = '<div class="paging page_ajax_loaded"><ul>' . $first . $prev . $link . $next . $last . '</ul></div>';

        return $pagination;
    }
}

if (!function_exists('_array_delete')) {
    function _array_delete($del_val, $array) {
        if(is_array($del_val)) {
             foreach ($del_val as $del_key => $del_value) {
                foreach ($array as $key => $value){
                    if ($value == $del_value) {
                        unset($array[$key]);
                    }
                }
            }
        } else {
            foreach ($array as $key => $value){
                if ($value == $del_val) {
                    unset($array[$key]);
                }
            }
        }
        return array_values($array);
    }
}

if (!function_exists('func_get_list_pages_children')) {
    function func_get_list_pages_children($parent_ID) {
        $args = array(
            'post_parent' => $parent_ID,
            'post_type'   => 'page',
            'numberposts' => -1,
            'post_status' => 'publish'
        );

        $list_pages = get_children( $args );
        return $list_pages;
    }
}

if (!function_exists('func_get_list_menu_pages')) {
    function func_get_list_menu_pages() {

        $parent_slug = pll_current_language() == 'vi' ? 'gioi-thieu' : 'about-us';
        $parent_ID = func_get_id_by_slug($parent_slug);
        $args = array(
            'post_parent' => $parent_ID,
            'post_type'   => 'page',
            'numberposts' => -1,
            'post_status' => 'publish'
        );

        $list_pages = get_children( $args );
        return $list_pages;
    }
}

if (!function_exists('func_get_id_by_slug')) {
    function func_get_id_by_slug($page_slug)
    {
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }
}

if (!function_exists('func_nav_menu_object_tree')) {
    function func_nav_menu_object_tree( $nav_menu_items_array ) {
        foreach ( $nav_menu_items_array as $key => $value ) {
            $value->children = array();
            $nav_menu_items_array[ $key ] = $value;
        }
        $last_level_ids = array();
        $nav_menu_levels = array();
        $index = 0;
        if ( ! empty( $nav_menu_items_array ) ) do {
            if ( $index == 0 ) {
                foreach ( $nav_menu_items_array as $key => $obj ) {
                    if ( $obj->menu_item_parent == 0 ) {
                        $nav_menu_levels[ $index ][] = $obj;
                        unset( $nav_menu_items_array[ $key ] );
                    }
                }
            } else {
                foreach ( $nav_menu_items_array as $key => $obj ) {
                    if ( in_array( $obj->menu_item_parent, $last_level_ids ) ) {
                        $nav_menu_levels[ $index ][] = $obj;
                        unset( $nav_menu_items_array[ $key ] );
                    }
                }
            }
            $last_level_ids = wp_list_pluck( $nav_menu_levels[ $index ], 'db_id' );
            $index++;
        } while ( ! empty( $nav_menu_items_array ) );

        $nav_menu_levels_reverse = array_reverse( $nav_menu_levels );

        $nav_menu_tree_build = array();
        $index = 0;
        if ( ! empty( $nav_menu_levels_reverse ) ) do {
            if ( count( $nav_menu_levels_reverse ) == 1 ) {
                $nav_menu_tree_build = $nav_menu_levels_reverse;
            }
            $current_level = array_shift( $nav_menu_levels_reverse );
            if ( isset( $nav_menu_levels_reverse[ $index ] ) ) {
                $next_level = $nav_menu_levels_reverse[ $index ];
                foreach ( $next_level as $nkey => $nval ) {
                    foreach ( $current_level as $ckey => $cval ) {
                        if ( $nval->db_id == $cval->menu_item_parent ) {
                            $nval->children[] = $cval;
                        }
                    }
                }
            }
        } while ( ! empty( $nav_menu_levels_reverse ) );

        $nav_menu_object_tree = $nav_menu_tree_build[ 0 ];
        return $nav_menu_object_tree;
    }
}

if (!function_exists('func_showGalleryFooter')) {
    function func_showGalleryFooter($id)
    {
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itgallery_images where gallery_id = '%d' order by ordering ASC", $id);
        $images = $wpdb->get_results($query);
        return $images;
    }
}
