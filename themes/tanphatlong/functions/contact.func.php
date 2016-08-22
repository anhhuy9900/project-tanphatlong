<?php
define('__MESSAGE_EMPTY_FILDS__', __('Please fill out  all fields','tanphatlong'));

#Success message
define('__SUCCESS_MESSAGE__', __('Your message has been sent. Thank you!','tanphatlong'));

function func_submit_contact(){

    if(!empty($_POST)){
        pr($_POST);
    }
}


add_action( 'wp_ajax_submit_contact', 'func_ajax_submit_contact' );
add_action( 'wp_ajax_nopriv_submit_contact', 'func_ajax_submit_contact' );
function func_ajax_submit_contact() {
    global $wpdb;
    $status = 0;
    $msg = '';
    $msg = validate_form_contact();
    if($msg == ''){
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $data = array(
            'name'          => _security_string($name),
            'email'         => _security_string($mail),
            'phone'         => _security_string($phone),
            'message'       => _security_string($message),
            'status'        => 0,
            'updated_date'  => time(),
            'created_date'  => time()
        );

        $wpdb->insert("tpl_contact" , $data);

        if($wpdb->insert_id > 0){
            $status = 1;
            $msg = __SUCCESS_MESSAGE__;
        }
    }

    $data = array(
        'status' => $status,
        'msg' => $msg
    );
    echo json_encode($data);
    die();
}


function validate_form_contact(){
    if($_POST['access_token'] != $_SESSION['access_token']){
        $msg = __('Sorry, access token not exists.','tanphatlong');
    }else if (!wp_verify_nonce($_POST['contact_form_field'],'contact_form_action') ) {
        $msg = __('Sorry, your nonce did not verify.','tanphatlong');
    }else if($_POST['name'] == '') {
        $msg = __('Please enter your name.','tanphatlong');
    } else if ($_POST['mail'] == '' or check_email($_POST['mail']) == false) {
        $msg = __('Please enter valid e-mail.','tanphatlong');
    } else if ($_POST['phone'] == '') {
        $msg = __('Please enter your phone.','tanphatlong');
    } else if ($_POST['message'] == '') {
        $msg = __('Please enter your message.','tanphatlong');
    }  else {
        $msg = '';
    }

    return $msg;
}


//Check e-mail validation
function check_email($email){
    if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
        return false;
    } else {
        return true;
    }
}