<?php

/**
 * List page handler
 *
 * This function renders our custom table
 * Notice how we display address about successfull deletion
 * Actualy this is very easy, and you can add as many features
 * as you want.
 *
 * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
 */
function manage_cv_page_handler()
{
    global $wpdb;

    $table = new Manage_CV_Page_List_Table();
    $table->prepare_items();

    $notice = '';
    $message_handler = '';

    if ('delete' === $table->current_action()) {
        $message_handler = '<div class="updated below-h2" id="address"><p>' . sprintf(__('Items deleted: %d', 'tpl_manage_cv'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Manage Manage CV', 'tpl_manage_cv')?>
        <!--<a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=tpl_manage_cv_form');?>"><?php _e('Add new', 'tpl_manage_cv')?></a>-->
    </h2>
    <?php echo $message_handler; ?>

    <form id="tpl_manage_cvs-table" method="GET">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php
}

/**
 * PART 4. Form for adding andor editing row
 * ============================================================================
 *
 * In this part you are going to add admin page for adding andor editing items
 * You cant put all form into this function, but in this example form will
 * be placed into meta box, and if you want you can split your form into
 * as many meta boxes as you want
 *
 * http://codex.wordpress.org/Data_Validation
 * http://codex.wordpress.org/Function_Reference/seletpl_manage_cvd
 */

/**
 * Form page handler checks is there some data posted and tries to save it
 * Also it renders basic wrapper in which we are callin meta box render
 */
function manage_cv_form_page_hanlder()
{
    global $wpdb;
    $table_name = 'tpl_manage_cv'; // do not forget about tables prefix

    $notice = '';
    $message_handler = '';

    // this is default $item which will be used for new records
    $default = array(
        'id' => 0,
        'name' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'status' => ''
    );

    // here we are verifying does this request is post back and have correct nonce
    if (wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);

        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        $item_valid = manage_cv_page_hanlder_validate($item);
        if ($item_valid === true) {

            if ($item['id'] == 0) {
            	$item['created_date'] = time();
                $result = $wpdb->insert($table_name, $item);
                $item['id'] = $wpdb->insert_id;
                if ($result) {
                    $message_handler = __('Item was successfully saved', 'tpl_manage_cv');
                } else {
                    //$notice = __('There was an error while saving item', 'tpl_manage_cv');
                }
            } else {

                $data_update = array(
                    'status' => $item['status'],
                );

                $result = $wpdb->update($table_name, $data_update, array('id' => $item['id']));
                //pr($data_update,1);
                if ($result) {

                } else {
                    //$notice = __('There was an error while updating item', 'tpl_manage_cv');
                }

                $message_handler = __('Item was successfully updated', 'tpl_manage_cv');
            }
        } else {
            // if $item_valid not true it contains error address(s)
            $notice = $item_valid;
        }
    }
    else {
        // if this is not post back we load item to edit or give new one to create
        $item = $default;
        if (isset($_REQUEST['id'])) {

            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'tpl_manage_cv');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('tpl_manage_cvs_form_meta_box', 'Manage CV data', 'manage_cv_form_meta_box_handler', 'tpl_manage_cv', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Manage CV', 'tpl_manage_cv')?>
    <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=tpl_manage_cv');?>"><?php _e('back to list', 'tpl_manage_cv')?></a>
    <!--<a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=tpl_manage_cv_form');?>"><?php _e('Add new', 'tpl_manage_cv')?></a>-->
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message_handler)): ?>
    <div id="address" class="updated"><p><?php echo $message_handler; ?></p></div>
    <?php endif;?>

    <form id="form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('tpl_manage_cv', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'tpl_manage_cv')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

/**
 * This function renders our custom meta box
 * $item is row
 *
 * @param $item
 */
function manage_cv_form_meta_box_handler($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="name"><?php _e('Name', 'tpl_manage_cv')?></label>
        </th>
        <td>
            <input id="name" name="name" type="text" style="width: 95%" value="<?php echo esc_attr($item['name'])?>"
                   size="50" class="code" placeholder="<?php _e('Name', 'tpl_manage_cv')?>" disabled>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('Email', 'tpl_manage_cv')?></label>
        </th>
        <td>
            <input id="email" name="email" type="text" style="width: 95%" value="<?php echo esc_attr($item['email'])?>"
                   size="50" class="code" placeholder="<?php _e('Email', 'tpl_manage_cv')?>" disabled>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="address"><?php _e('Phone', 'tpl_manage_cv')?></label>
        </th>
        <td>
            <input id="phone" name="phone" type="text" style="width: 95%" value="<?php echo esc_attr($item['phone'])?>"
                   size="50" class="code" placeholder="<?php _e('Phone', 'tpl_manage_cv')?>" disabled>
        </td>
    </tr>

    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="address"><?php _e('Address', 'tpl_manage_cv')?></label>
        </th>
        <td>
            <textarea id="address" name="address" placeholder="<?php _e('address', 'tpl_manage_cv')?>" rows="5" disabled><?php echo esc_attr($item['address'])?></textarea>
        </td>
    </tr>

    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="address"><?php _e('File CV', 'tpl_manage_cv')?></label>
        </th>
        <td>
            <a href="<?php echo wp_get_attachment_url(intval($item['file_id']));?>">Xem File</a>
        </td>
    </tr>

    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="status"><?php _e('Status', 'tpl_manage_cv')?></label>
        </th>
        <td>
            <select id="status" name="status" required>
                <option value="0" <?php print $item['status'] == 0 ? 'selected' : '';?>>Chưa duyệt</option>
            	<option value="1" <?php print $item['status'] == 1 ? 'selected' : '';?>>Đã duyệt</option>
            </select>
        </td>
    </tr>
    </tbody>
</table>
<?php
}

/**
 * Simple function that validates data and retrieve bool on success
 * and error address(s) on error
 *
 * @param $item
 * @return bool|string
 */
function manage_cv_page_hanlder_validate($item)
{
    /*$addresss = array();

    if (empty($item['name'])){
    	$addresss[] = __('Name is required', 'tpl_manage_cv');
    } 

    if (empty($item['email'])){
    	$addresss[] = __('Contact Description is required', 'tpl_manage_cv');
    }

    if (empty($item['phone'])){
    	$addresss[] = __('Contact Image is required', 'tpl_manage_cv');
    }

    if (empty($addresss)) return true;
    return implode('<br />', $addresss);*/

    return true;
}

