<?php
include 'DefaultController.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteController extends DefaultController 
{

    /*
    *   Global Assign values or argiments in constructer
    * */
	public function __construct()
	{
        parent::__construct();
		$this->load->model('WebsiteModel');
	}


    /*
    *   Home Page : /
    * */
    public function index()
    {
        $data['page_title'] =   'Welcome to Scegroup';
        $this->load->view('home_page',$data);
    }

    /*
    *   Aboutus Page
    * */
    public function aboutusPage()
    {
        $data['page_title'] =   'About us';
        $this->load->view('aboutus_page',$data);
    }
    
    /*
    *   Services Page
    * */
    public function servicesPage()
    {
        $data['page_title'] =   'Services';
        $this->load->view('services_page',$data);
    }
    
    /*
    *   Projects Page
    * */
    public function projectsPage()
    {
        $data['page_title'] =   'Projects';
        $this->load->view('projects_page',$data);
    }
    
    /*
    *   contactus Page
    * */
    public function contactusPage()
    {
        $data['page_title'] =   'Contact us';
        $this->load->view('contactus_page',$data);
    }

}
