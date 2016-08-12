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
    if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['phone']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        if ($name == '') {
            $msg = __('Please enter your name.','tanphatlong');
        } else if ($mail == '' or check_email($mail) == false) {
            $msg = __('Please enter valid e-mail.','tanphatlong');
        } else if ($phone == '') {
            $msg = __('Please enter your phone.','tanphatlong');
        } else if ($message == '') {
            $msg = __('Please enter your message.','tanphatlong');
        } else {
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
    } else {
        $msg = __MESSAGE_EMPTY_FILDS__;

    }

    $data = array(
        'status' => $status,
        'msg' => $msg
    );
    echo json_encode($data);
    die();
}



//Check e-mail validation
function check_email($email){
    if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
        return false;
    } else {
        return true;
    }
}