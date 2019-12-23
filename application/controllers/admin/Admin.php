<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Admin extends BaseController {

	public function __construct(){
        parent::__construct();
        $this->load->model('Model_default');
    }
	
	//login page
	public function index()
	{
		$data['pagetitle'] =	'Admin Login'; 
		$this->load->view('admin/login',$data);
	}

	//login page access
	public function userLoginDetails(){
		extract($_REQUEST);
		$checkuser = $this->Model_default->select_data('ss_admin',array('mail_id'=>$login_id));
		//$this->print_r($checkuser);
		if(count($checkuser) != 0){
			$password = $login_password;
			$logindetails = $this->Model_default->select_data('ss_admin',array('mail_id'=>$login_id,'password'=>$password));
			if(count($logindetails) != 0){
				//$this->print_r($logindetails);
				$this->session->set_userdata('loginadmindata',$logindetails);
				$this->session->set_userdata('isloginadmin',TRUE);
				$this->session->set_flashdata('success', 'Login success..!');
				redirect(base_url('admin/dashboard'));
			}else{
				$this->session->set_flashdata('failed', 'Login id or Password Incorrect..!');
				redirect(base_url('admin'));
			}
		}else{
			$this->session->set_flashdata('failed', 'Login user id not found..!');
			redirect(base_url('admin'));
		}
	}

	public function welcomePage(){
        $this->isAdminLoggedIn();
        $data['userdata'] = $this->session->userdata('loginadmindata');
		$data['pagetitle']	=	'Dashboard Page';
		//$this->print_r($userdata);
		//echo "<a href='".$this->logout()."'>Logout</a>";
		$this->view('admin/dashboard',$data);
	}

    function logout() {
        $this->session->sess_destroy ();
        redirect(base_url('admin'));
    }
	
}
