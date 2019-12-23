<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/DefaultController.php';
class AdminController extends DefaultController 
{

    /*
    *   Global Assign values or argiments in constructer
    * */
	public function __construct()
	{
        parent::__construct();
		$this->load->model('admin/AdminModel');
	}


    /*
    *   Dashboard Login Page : /
    * */
    public function index()
    {
        $data['title']  =   'Login : : Dashboard..!';
        $this->load->view('admin/login');
    }

    /*
    *   Login Access Code
    * */
    public function loginAccess()
    {
        $responce = $this->AdminModel->userLoginAccess($_REQUEST);
        if($responce['responce'] != 0){
            $this->session->set_flashdata('failed', $responce['message']);
			redirect(base_url('admin'));
        }else{
            $this->session->set_userdata('loginAdminData',$responce['data']);
            $this->session->set_userdata('isLoginAdmin',TRUE);
            $this->session->set_flashdata('success', 'Login success..!');
            redirect(base_url('admin/dashboard'));
        }
    }

    /*
    *   Welcome Dashboard access
    * */
    public function welcomePage(){
        $this->isAdminLoggedIn();
        $data['userdata']   =   $this->session->userdata('loginAdminData');
		$data['pagetitle']	=	'Dashboard Page';
		$this->load->view('admin/dashboard',$data);
	}

    /*
    *   Logout access
    * */
    function logoutAccess() {
        $this->session->sess_destroy();
        redirect(base_url('admin'));
    }

}
