<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'models/ModelDefault.php';

class AdminModel extends ModelDefault{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function userLoginAccess($requestdata)
    {
        extract($requestdata);
        $checkuserid = $this->select_data('sceg_admin',array('mail_id' => $login_id));
        if(count($checkuserid) != 0){
            $checkuseraccess = $this->select_data('sceg_admin',array('mail_id' => $login_id,'password' => $login_password));
            if(count($checkuseraccess) != 0){
                return array('responce'=>0,'message'=>'Access Generated.','data'=>$checkuseraccess);
            }else{
                return array('responce'=>0,'message'=>'Enter correct password.','data'=>$checkuseraccess);
            }
        }else{
            return array('responce'=>0,'message'=>'Enter correct userid.','data'=>$checkuserid);
        }
    }    

}
