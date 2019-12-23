<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Banners extends BaseController {

	public function __construct(){
        parent::__construct();
        $this->isAdminLoggedIn();
        $this->load->model('Model_default');
    }
	
	//login page
	public function index()
	{
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'Banners Page';
        $data['banners']	=	 $this->Model_default->select_data('ss_banners',array('status'=>1),'updated DESC');
		$this->view('admin/banners_page',$data);
	}

    public function uplaodBanners(){
        extract($_REQUEST);
        $path = 'uploads/banners/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
        }
        //$this->print_r($uploadfile);
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('banner_title'=>$bannerTitle,'image'=>$uploadedfile,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_banners',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/banners'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/banners'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/banners'));
        }
    }

    public function deleteBanners(){
        $id = $this->uri->segment(3);
        if(isset($id) && !empty($id)){
            $conduction = 	array('id'=>$id);
            $updatedata	=	array('status'=>0);
            $updating	=	$this->Model_default->update_data('ss_banners',$updatedata,$conduction);
            if($updating != 0){
                $this->successalert('Successfully Delete Banner Details.','You have Delete Banner details sucessfully please check once..!');
                redirect(base_url('admin/banners'));
            }else{
                $this->failedalert('Failed to Delete Banner Details.','Unable to Delete Banner details or oops error..!');
                redirect(base_url('admin/banners'));
            }
        }else{
            $this->failedalert('Failed to Delete Banner Details.','Unable to Delete Banner details or Invalid oops error..!');
            redirect(base_url('admin/banners'));
        }
    }

    public function editBanners(){
        $id = $this->uri->segment(3);
        $data['userdata'] = $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'Banners Page';
        $data['banners']	=	$this->Model_default->select_data('ss_banners',array('status'=>1),'id DESC');
        $data['bannerdetails']	=	$this->Model_default->select_data('ss_banners',array('status'=>1,'id'=>$id),'id DESC');
        $this->view('admin/banners_page',$data);
    }

    public function saveEditdetails(){
        extract($_REQUEST);
        $path = 'uploads/banners/';
        $details = $this->Model_default->select_data('ss_banners',array('id'=>$edit_id),'id DESC');
        if(!empty($_FILES['BannersImages']['name'])){
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
            if($uploadfile['status'] == 1){
                @$unlink = unlink($details[0]->image);
                $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            }else{
                $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
                redirect(base_url('cpanel/dashboard/banners'));
            }
        }else{
            if(isset($Uploaded_image) && !empty($Uploaded_image)){
                $uploadedfile =  $Uploaded_image;
            }else{
                $uploadedfile = '';
            }
        }
        $conduction = array('id'=>$edit_id);
        $insertdata = array('image'=>$uploadedfile,'banner_title'=>$bannerTitle,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
        $insertbanners = $this->Model_default->update_data('ss_banners',$insertdata,$conduction);
        if($insertbanners != 0){
            $this->successalert('Successfully Update Banner Details.','You have Update banner details sucessfully please check once..!');
            redirect(base_url('admin/banners'));
        }else{
            $this->failedalert('Failed to Update Banner Details.','Unable to Update banner details or oops error..!');
            redirect(base_url('admin/banners'));
        }
    }

	
}
