<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Gallery extends BaseController {

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
        $data['banners']	=	 $this->Model_default->select_data('ss_gallery',array('status'=>1),'updated DESC');
		$this->view('admin/gallery_page',$data);
	}

    public function uplaodGallery(){
        extract($_REQUEST);
        $path = 'uploads/gallery/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
        }
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('title'=>$Image_title,'image'=>$uploadedfile,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_gallery',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/gallery'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/gallery'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/gallery'));
        }
    }

    public function deleteBanners(){
        $id = $this->uri->segment(4);
        if(isset($id) && !empty($id)){
            $conduction = 	array('id'=>$id);
            $updatedata	=	array('status'=>0);
            $updating	=	$this->Model_default->update_data('ks_banners',$updatedata,$conduction);
            if($updating != 0){
                $this->successalert('Successfully Delete Banner Details.','You have Delete Banner details sucessfully please check once..!');
                redirect(base_url('cpanel/dashboard/banners'));
            }else{
                $this->failedalert('Failed to Delete Banner Details.','Unable to Delete Banner details or oops error..!');
                redirect(base_url('cpanel/dashboard/banners'));
            }
        }else{
            $this->failedalert('Failed to Delete Banner Details.','Unable to Delete Banner details or Invalid oops error..!');
            redirect(base_url('cpanel/dashboard/banners'));
        }
    }

    public function editGallery(){
        $id = $this->uri->segment(3);
        $data['userdata'] = $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'Gallery Edit Page';
        $data['banners']	=	$this->Model_default->select_data('ss_gallery',array('status'=>1),'id DESC');
        $data['bannerdetails']	=	$this->Model_default->select_data('ss_gallery',array('status'=>1,'id'=>$id),'id DESC');
        $this->view('admin/gallery_page',$data);
    }

    public function saveEditdetails(){
        extract($_REQUEST);
        
        $path = 'uploads/banners/';
        if(!empty($_FILES['BannersImages']['name'])){
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
            if($uploadfile['status'] == 1){
                $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            }else{
                $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
                redirect(base_url('admin/gallery'));
            }
        }else{
            if(isset($Uploaded_image) && !empty($Uploaded_image)){
                $uploadedfile =  $Uploaded_image;
            }else{
                $uploadedfile = '';
            }
        }

        $conduction = array('id'=>$edit_id);
        $insertdata = array('title'=>$Image_title,'image'=>$uploadedfile,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
        $insertbanners = $this->Model_default->update_data('ss_gallery',$insertdata,$conduction);
        if($insertbanners != 0){
            $this->successalert('Successfully Update Banner Details.','You have Update banner details sucessfully please check once..!');
            redirect(base_url('admin/gallery'));
        }else{
            $this->failedalert('Failed to Update Banner Details.','Unable to Update banner details or oops error..!');
            redirect(base_url('admin/gallery'));
        }
    }

	
}
