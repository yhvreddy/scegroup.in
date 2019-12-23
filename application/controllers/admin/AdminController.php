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
		$this->admin = $this->load->model('admin/AdminModel');
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
        $this->print_r($_POST);
        
    }

}
