<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Serviceproducts extends BaseController {

	public function __construct(){
        parent::__construct();
        $this->isAdminLoggedIn();
        $this->load->model('Model_default');
    }
	
	//services page
	public function services(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'Srvices add page';
        $data['services']	=	 $this->Model_default->select_data('ss_services_list',array('status'=>1),'updated DESC');
		$this->view('admin/services_page',$data);
	}

    public function uploadServiceDetails(){
        extract($_REQUEST);
        $path = 'uploads/services/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
        }
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('name'=>$category_name,'image'=>$uploadedfile,'information'=>$Information,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_services_list',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/services'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/services'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/services'));
        }
    }

    //services edit
    public function editServices(){
        $id = $this->uri->segment(3);
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']  =   'Edit Service details page';
        $data['servicedetails']   =    $this->Model_default->select_data('ss_services_list',array('id'=>$id),'updated DESC');
        $data['services']   =    $this->Model_default->select_data('ss_services_list',array('status'=>1,'id !='=>$id),'updated DESC');
        $this->view('admin/services_page',$data);
    }


    public function products(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'About us page';
        $data['products']	=	 $this->Model_default->select_data('ss_products_list',array('status'=>1),'updated DESC');
        $this->view('admin/products_page',$data);
    }

    public function uploadProductDetails(){
        extract($_REQUEST);
        // $this->print_r($_FILES);
        // $this->print_r($_REQUEST);
        // exit;
        $path = 'uploads/products/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
        }
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('name'=>$product_name,'image'=>$uploadedfile,'information'=>$Information,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_products_list',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/products'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/products'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/products'));
        }
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
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('image'=>$uploadedfile,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ks_banners',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('cpanel/dashboard/banners'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('cpanel/dashboard/banners'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('cpanel/dashboard/banners'));
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

    public function editBanners(){
        $id = $this->uri->segment(4);
        $data['userdata'] = $this->session->userdata('loginuserdata');
        $data['pagetitle']	=	'Banners Page';
        $data['banners']	=	$this->Model_default->select_data('ks_banners',array('status'=>1),'id DESC');
        $data['bannerdetails']	=	$this->Model_default->select_data('ks_banners',array('status'=>1,'id'=>$id),'id DESC');
        $this->manualLoadView('cpanel/header','cpanel/banners_page','cpanel/footer',$data);
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
        $insertdata = array('image'=>$uploadedfile,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
        $insertbanners = $this->Model_default->update_data('ks_banners',$insertdata,$conduction);
        if($insertbanners != 0){
            $this->successalert('Successfully Update Banner Details.','You have Update banner details sucessfully please check once..!');
            redirect(base_url('cpanel/dashboard/banners'));
        }else{
            $this->failedalert('Failed to Update Banner Details.','Unable to Update banner details or oops error..!');
            redirect(base_url('cpanel/dashboard/banners'));
        }

    }

	
}
