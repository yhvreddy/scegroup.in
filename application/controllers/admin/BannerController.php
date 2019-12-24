<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/DefaultController.php';
class BannerController extends DefaultController{

	public function __construct(){
        parent::__construct();
        $this->isAdminLoggedIn();
        $this->load->model('admin/BannerModel');
    }
	
	
	public function index()
	{
        $data['userdata']   =   $this->session->userdata('loginAdminData');
        $data['pagetitle']	=	'Banners Page';
        $data['banners']	=	 $this->BannerModel->bannerdata();
		$this->load->view('admin/banners_page',$data);
	}

    public function uplaodBanners()
    {
        $this->create_dir('uploads/banners/');    
        $uplaodbannerimage = $this->uploadfiles('uploads/banners/','BannersImages','jpg|png|jpeg',TRUE);
        $_REQUEST['banners']   = $uplaodbannerimage;
        $uploadbanners = $this->BannerModel->uplaodBanners($_REQUEST);
        if($uploadbanners['responce'] != 0){
            $this->session->set_flashdata('failed', $responce['message']);
            redirect(base_url('admin/banners'));
        }else{
            $this->session->set_flashdata('success', $responce['message']);
            redirect(base_url('admin/banners'));
        }
    }

    public function deleteBanners()
    {
        $deleteId = $this->uri->segment(3);
        $delete   = $this->BannerModel->deleteBanner($deleteId);
        if($delete['responce'] != 0){
            $this->session->set_flashdata('failed', $responce['message']);
            redirect(base_url('admin/banners'));
        }else{
            $this->session->set_flashdata('success', $responce['message']);
            redirect(base_url('admin/banners'));
        } 
    }

    public function editBanners()
    {
        $id = $this->uri->segment(3);
        $data['userdata']   = $this->session->userdata('loginAdminData');
        $data['pagetitle']	=	'Edit Banners Page';
        $data['banners']	=	$this->BannerModel->bannerdata();
        $data['bannerdetails']	=	$this->BannerModel->bannerEditData($id);
        $this->load->view('admin/banners_page',$data);
    }

    public function saveEditdetails()
    {
        $bannerdetails = $this->BannerModel->bannerEditData($_REQUEST['edit_id']);
        if(!empty($_FILES['BannersImages']['name'])){
            @unlink($bannerdetails[0]->image);
            $uplaodlogo = $this->uploadfiles('uploads/banners/','BannersImages','jpg|png|jpeg',TRUE);
            $_REQUEST['banners']   = $uplaodlogo;
        }else{
            $_REQUEST['banners'] = array('status'=>1,'upload'=>'success','uploaddata'=>$this->input->post('Uploaded_image'));
        }
        $uploadbanners = $this->BannerModel->saveditdetails($_REQUEST);
        if($uploadbanners['responce'] != 0){
            $this->session->set_flashdata('failed', $responce['message']);
            redirect(base_url('admin/banners'));
        }else{
            $this->session->set_flashdata('success', $responce['message']);
            redirect(base_url('admin/banners'));
        }
    }
}
