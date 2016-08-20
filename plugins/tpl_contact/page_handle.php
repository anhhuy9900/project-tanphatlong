<?php

/**
 * List page handler
 *
 * This function renders our custom table
 * Notice how we display message about successfull deletion
 * Actualy this is very easy, and you can add as many features
 * as you want.
 *
 * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
 */
function page_handler()
{
    global $wpdb;

    $table = new Page_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'tpl_contact'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Manage Contacts', 'tpl_contact')?>
        <!--<a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=tpl_contact_form');?>"><?php _e('Add new', 'tpl_contact')?></a>-->
    </h2>
    <?php echo $message; ?>

    <form id="tpl_contacts-table" method="GET">
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
 * http://codex.wordpress.org/Function_Reference/seletpl_contactd
 */

/**
 * Form page handler checks is there some data posted and tries to save it
 * Also it renders basic wrapper in which we are callin meta box render
 */
function form_page_handler()
{
    global $wpdb;
    $table_name = 'tpl_contact'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'id' => 0,
        'name' => '',
        'email' => '',
        'phone' => '',
        'message' => '',
        'status' => ''
    );

    // here we are verifying does this request is post back and have correct nonce
    if (wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);

        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        $item_valid = page_hanlder_validate($item);
        if ($item_valid === true) {

            if ($item['id'] == 0) {
            	$item['created_date'] = time();
                $result = $wpdb->insert($table_name, $item);
                $item['id'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'tpl_contact');
                } else {
                    $notice = __('There was an error while saving item', 'tpl_contact');
                }
            } else {

                $data_update = array(
//                    'name' => $item['name'],
//                    'email' => $item['email'],
//                    'phone' => $item['phone'],
//                    'message' => $item['message'],
//                    'status' => $item['status'],
                    'updated_date' => time()
                );

                $result = $wpdb->update($table_name, $data_update, array('id' => $item['id']));
                if ($result) {
                    $message = __('Item was successfully updated', 'tpl_contact');
                } else {
                    $notice = __('There was an error while updating item', 'tpl_contact');
                }
            }
        } else {
            // if $item_valid not true it contains error message(s)
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
                $notice = __('Item not found', 'tpl_contact');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('tpl_contacts_form_meta_box', 'Contact data', 'form_meta_box_handler', 'tpl_contact', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Contact', 'tpl_contact')?> 
    <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=tpl_contact');?>"><?php _e('back to list', 'tpl_contact')?></a>
    <!--<a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=tpl_contact_form');?>"><?php _e('Add new', 'tpl_contact')?></a>-->
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('tpl_contact', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'tpl_contact')?>" id="submit" class="button-primary" name="submit">
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
function form_meta_box_handler($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="name"><?php _e('Contact Title', 'tpl_contact')?></label>
        </th>
        <td>
            <input id="name" name="name" type="text" style="width: 95%" value="<?php echo esc_attr($item['name'])?>"
                   size="50" class="code" placeholder="<?php _e('Contact Title', 'tpl_contact')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="email"><?php _e('Email', 'tpl_contact')?></label>
        </th>
        <td>
            <input id="email" name="email" type="text" style="width: 95%" value="<?php echo esc_attr($item['email'])?>"
                   size="50" class="code" placeholder="<?php _e('Email', 'tpl_contact')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="message"><?php _e('Phone', 'tpl_contact')?></label>
        </th>
        <td>
            <input id="phone" name="phone" type="text" style="width: 95%" value="<?php echo esc_attr($item['phone'])?>"
                   size="50" class="code" placeholder="<?php _e('Phone', 'tpl_contact')?>" required>
        </td>
    </tr>

    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="message"><?php _e('Message', 'tpl_contact')?></label>
        </th>
        <td>
            <textarea id="message" name="message" placeholder="<?php _e('Message', 'tpl_contact')?>" rows="5" required><?php echo esc_attr($item['message'])?></textarea>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="status"><?php _e('Status', 'tpl_contact')?></label>
        </th>
        <td>
            <select id="status" name="status" required>
                <option value="0" <?php print $item['status'] == 0 ? 'selected' : '';?>>UnPublish</option>
            	<option value="1" <?php print $item['status'] == 1 ? 'selected' : '';?>>Publish</option>
            </select>
        </td>
    </tr>
    </tbody>
</table>
<?php
}

/**
 * Simple function that validates data and retrieve bool on success
 * and error message(s) on error
 *
 * @param $item
 * @return bool|string
 */
function page_hanlder_validate($item)
{
    $messages = array();

    if (empty($item['name'])){
    	$messages[] = __('Contact title is required', 'tpl_contact');
    } 

    if (empty($item['email'])){
    	$messages[] = __('Contact Description is required', 'tpl_contact');
    }

    /*if (empty($item['phone'])){
    	$messages[] = __('Contact Image is required', 'tpl_contact');
    } */

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}

