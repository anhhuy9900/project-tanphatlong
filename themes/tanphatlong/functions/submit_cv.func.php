<?php

function _func_submit_cv(){
    global $wpdb;
    $status = 0;
    $msg = '';
    $submit = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $submit = 1;
        if(isset($_POST['your_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])) {
            $name = $_POST['your_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $file = $_FILES;

            if ($name == '') {
                $msg = __('Please enter your name.','tanphatlong');
            } else if ($email == '' or check_email($email) == false) {
                $msg = __('Please enter valid e-mail.','tanphatlong');
            } else if ($phone == '') {
                $msg = __('Please enter your phone.','tanphatlong');
            } else if ($address == '') {
                $msg = __('Please enter your address.','tanphatlong');
            } else if (empty($file)) {
                $msg = __('Please choose file to apply.','tanphatlong');
            } else {
                /*$data = array(
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
                }*/
                $status = 1;
                $msg =  __('Apply CV success. We will contact you later.','tanphatlong');
            }
        } else {

            $msg = __MESSAGE_EMPTY_FILDS__;

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
