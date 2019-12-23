<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/DefaultController.php';
class SitedetailsController extends DefaultController{

	public function __construct(){
        parent::__construct();
        $this->isAdminLoggedIn();
        $this->load->model('admin/SitedetailsModel');
    }

    /*
    *   Site Details
    * */
    public function siteDetails()
    {
        $data['userdata']   =   $this->session->userdata('loginAdminData');
        $data['pagetitle']	=	'Site Details';
        $data['sitedetails']=	 $this->SitedetailsModel->sitedetails();
        $this->load->view('admin/sitedetails_page',$data);
    }
    
    /*
    * Save Site Details
    * */
    public function saveSiteDetails()
    {
        $this->create_dir('uploads/sitedetails/');
        $uplaodlogo = $this->uploadfiles('uploads/sitedetails/','SiteLogo','*',FALSE);
        $_REQUEST['logo']   = $uplaodlogo;
        $uplaodfav  = $this->uploadfiles('uploads/sitedetails/','SiteFavLogo','*',TRUE);
        $_REQUEST['fav']   = $uplaodfav; 
        $responce = $this->SitedetailsModel->saveSiteDetails($_REQUEST);
        if($responce['responce'] != 0){
            $this->session->set_flashdata('failed', $responce['message']);
			redirect(base_url('admin/sitedetails'));
        }else{
            $this->session->set_flashdata('success', $responce['message']);
            redirect(base_url('admin/sitedetails'));
        }   
    }

    /*
    *   Save Edit Site Details
    * */
    public function savEditsiteDetails()
    {
        $sitedetails = $this->SitedetailsModel->sitedetails();
        if(!empty($_FILES['SiteLogo']['name'])){
            @unlink($sitedetails[0]->site_logo);
            $uplaodlogo = $this->uploadfiles('uploads/sitedetails/','SiteLogo','*',FALSE);
            $_REQUEST['logo']   = $uplaodlogo;
        }else{
            $_REQUEST['logo'] = array('status'=>1,'upload'=>'success','uploaddata'=>$this->input->post('Uploadedlogo_image'));
        }

        if(!empty($_FILES['SiteFavLogo']['name'])){
            @unlink($sitedetails[0]->site_favicon);
            $uplaodfav  = $this->uploadfiles('uploads/sitedetails/','SiteFavLogo','*',TRUE);
            $_REQUEST['fav']   = $uplaodfav;
        }else{
            $_REQUEST['fav'] = array('status'=>1,'upload'=>'success','uploaddata'=>$this->input->post('Uploadedfav_image'));
        }
        
        $responce = $this->SitedetailsModel->saveEditSiteDetails($_REQUEST);
        if($responce['responce'] != 0){
            $this->session->set_flashdata('failed', $responce['message']);
			redirect(base_url('admin/sitedetails'));
        }else{
            $this->session->set_flashdata('success', $responce['message']);
            redirect(base_url('admin/sitedetails'));
        }
    }

}
