<?php

function _func_submit_cv(){
    ob_start();
    global $wpdb;
    $status = 0;
    $msg = '';
    $submit = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $submit = 1;
        $msg = validate_form_submit_cv();
        if($msg == ''){
            $rec_id = $_POST['rec_id'];
            $name = $_POST['your_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            //upload file
            $file_id = fileupload_process();

            $data = array(
                'rec_id'        => intval($rec_id),
                'name'          => _security_string($name),
                'email'         => _security_string($email),
                'phone'         => _security_string($phone),
                'address'       => _security_string($address),
                'file_id'        => $file_id,
                'status'        => 0,
                'created_date'  => time()
            );

            $wpdb->insert("tpl_manage_cv" , $data);

            if($wpdb->insert_id > 0){
                $status = 1;
                $msg = __SUCCESS_MESSAGE__;
                ob_end_clean();
            }
            $status = 1;
            $msg =  __('Apply CV success. We will contact you later.','tanphatlong');
        }

    }

    $data = array(
        'status' => $status,
        'submit' => $submit,
        'msg' => $msg
    );
    return $data;
    //die();
}

function validate_form_submit_cv(){
    if($_POST['access_token'] != $_SESSION['access_token']){
        $msg = __MESSAGE_EMPTY_FILDS__;
    }else if (!wp_verify_nonce($_POST['submit_cv_field'],'submit_cv_action') ) {
        $msg = __('Sorry, your nonce did not verify.','tanphatlong');
    }else if($_POST['your_name'] == '') {
        $msg = __('Please enter your name.','tanphatlong');
    } else if ($_POST['email'] == '' or check_email($_POST['email']) == false) {
        $msg = __('Please enter valid e-mail.','tanphatlong');
    } else if ($_POST['phone'] == '') {
        $msg = __('Please enter your phone.','tanphatlong');
    } else if ($_POST['address'] == '') {
        $msg = __('Please enter your address.','tanphatlong');
    } else if (empty($_FILES)) {
        $msg = __('Please choose file to apply.','tanphatlong');
    } else {
        $msg = '';
    }

    return $msg;
}

function fileupload_process() {
    $uploadfiles = $_FILES['file_cv'];
    $attach_id = 0;
    if ($uploadfiles) {

        // look only for uploded files
        if ($uploadfiles['error'] == 0) {

            $filetmp = $uploadfiles['tmp_name'];

            //clean filename and extract extension
            $filename = $uploadfiles['name'];

            // get file info
            // @fixme: wp checks the file extension....
            $filetype = wp_check_filetype( basename( $filename ), null );
            $filetitle = preg_replace('/\.[^.]+$/', '', basename( $filename ) );
            $filename = $filetitle . '.' . $filetype['ext'];
            $upload_dir = wp_upload_dir();

            /**
             * Check if the filename already exist in the directory and rename the
             * file if necessary
             */
            $i = 0;
            while ( file_exists( $upload_dir['path'] .'/' . $filename ) ) {
                $filename = $filetitle . '_' . $i . '.' . $filetype['ext'];
                $i++;
            }
            $filedest = $upload_dir['path'] . '/' . $filename;

            /**
             * Check write permissions
             */
            if ( !is_writeable( $upload_dir['path'] ) ) {
                $this->msg_e('Unable to write to directory %s. Is this directory writable by the server?');
                return;
            }

            /**
             * Save temporary file to uploads dir
             */
            if ( !@move_uploaded_file($filetmp, $filedest) ){
                $this->msg_e("Error, the file $filetmp could not moved to : $filedest ");
            }

            $attachment = array(
                'post_mime_type' => $filetype['type'],
                'post_title' => $filetitle,
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attach_id = wp_insert_attachment( $attachment, $filedest );

            require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $filedest );
            wp_update_attachment_metadata( $attach_id,  $attach_data );

        }
    }

    return $attach_id;
}
