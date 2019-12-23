<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Sitedetails extends BaseController {

	public function __construct(){
        parent::__construct();
        $this->isAdminLoggedIn();
        $this->load->model('Model_default');
    }
	
	//about page
	public function aboutus(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'About us page';
        $data['aboutus']	=	 $this->Model_default->select_data('ss_about_us',array('status'=>1),'updated DESC');
		$this->view('admin/aboutus_page',$data);
	}

    public function uploadAboutusDetails(){
        extract($_REQUEST);
        $path = 'uploads/aboutus/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
        }
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('title'=>$About_title,'image'=>$uploadedfile,'information'=>$Information,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_about_us',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/aboutus'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/aboutus'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/aboutus'));
        }
    }

    public function uploadEditsAboutusDetails(){
        extract($_REQUEST);
        // $this->print_r($_REQUEST);
        // $this->print_r($_FILES);
        // exit;
        $path = 'uploads/banners/';
        if(!empty($_FILES['BannersImages']['name'])){
            $uploadfile = $this->uploadfiles($path,'BannersImages','jpg|png|jpeg',TRUE);
            if($uploadfile['status'] == 1){
                //unlink last upload file
                $details = $this->Model_default->select_data('ss_about_us',array('id'=>$edit_id));
                @unlink($details[0]->image);
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
        $insertdata = array('title'=>$About_title,'image'=>$uploadedfile,'information'=>$Information,'updated'=>date('Y-m-d H:i:s'));
        $insertbanners = $this->Model_default->update_data('ss_about_us',$insertdata,$conduction);
        if($insertbanners != 0){
            $this->successalert('Successfully Update Banner Details.','You have Update banner details sucessfully please check once..!');
            redirect(base_url('admin/aboutus'));
        }else{
            $this->failedalert('Failed to Update Banner Details.','Unable to Update banner details or oops error..!');
            redirect(base_url('admin/aboutus'));
        }
    }


    //sitedetails
    public function sitedetails(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'About us page';
        $data['sitedetails']=	 $this->Model_default->select_data('ss_site_details',array('status'=>1),'updated DESC');
        $this->view('admin/sitedetails_page',$data);
    }

    public function saveSiteDetails(){
        extract($_REQUEST);
        // $this->print_r($_REQUEST);
        // $this->print_r($_FILES);
        // exit;
        $path = 'uploads/sitedetails/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'SiteLogo','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'SiteLogo','jpg|png|jpeg',TRUE);
        }
        //$this->print_r($uploadfile);
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('site_name'=>$site_name,'site_url'=>$domain_name,'site_logo'=>$uploadedfile,'address'=>$address,'state'=>$state_name,'city'=>$city_name,'pincode'=>$pincode,'mobile'=>$mobile,'email_id'=>$mail_id,'facebook'=>$facebook_link,'twitter'=>$twitter_link,'instagram'=>$instagram_link,'linkedin'=>$linkedin_link,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_site_details',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/sitedetails'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/sitedetails'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/sitedetails'));
        }
    }

    public function saveEditSiteDetails(){
        extract($_REQUEST);
        // $this->print_r($_REQUEST);
        // $this->print_r($_FILES);
        // exit;
        $path = 'uploads/sitedetails/';
        if(!empty($_FILES['SiteLogo']['name'])){
            $uploadfile = $this->uploadfiles($path,'SiteLogo','jpg|png|jpeg',TRUE);
            if($uploadfile['status'] == 1){
                //unlink last upload file
                $sitedetails = $this->Model_default->select_data('ss_site_details',array('id'=>$edit_id));
                @unlink($sitedetails[0]->site_logo);
                $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            }else{
                $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
                redirect(base_url('admin/sitedetails'));
            }
        }else{
            if(isset($Uploaded_image) && !empty($Uploaded_image)){
                $uploadedfile =  $Uploaded_image;
            }else{
                $uploadedfile = '';
            }
        }
        
        $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
        $insertdata = array('site_name'=>$site_name,'site_url'=>$domain_name,'site_logo'=>$uploadedfile,'address'=>$address,'state'=>$state_name,'city'=>$city_name,'pincode'=>$pincode,'mobile'=>$mobile,'email_id'=>$mail_id,'facebook'=>$facebook_link,'twitter'=>$twitter_link,'instagram'=>$instagram_link,'linkedin'=>$linkedin_link,'updated'=>date('Y-m-d H:i:s'));
        $conduction = array('id'=>$edit_id);
        $insertbanners = $this->Model_default->update_data('ss_site_details',$insertdata,$conduction);
        if($insertbanners != 0){
            $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
            redirect(base_url('admin/sitedetails'));
        }else{
            $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
            redirect(base_url('admin/sitedetails'));
        }
    }

    //partners
    public function partners(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'About us page';
        $data['partners']	=	 $this->Model_default->select_data('ss_partners_details',array('status'=>1),'updated DESC');
        $this->view('admin/partners_page',$data);
    }

    public function SavepartnersDetails(){
        extract($_REQUEST);
        // $this->print_r($_FILES);
        // $this->print_r($_REQUEST);
        // exit;
        $path = 'uploads/partners/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'PartnersImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'PartnersImages','jpg|png|jpeg',TRUE);
        }
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('title'=>$title_name,'image'=>$uploadedfile,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_partners_details',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/partners'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/partners'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/partners'));
        }
    }

    //why choose us
    public function Whychooseus(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'why choose us page';
        $data['choosedata']	=	 $this->Model_default->select_data('ss_whychoose_us',array('status'=>1),'updated DESC');
        $this->view('admin/whychooseus_page',$data);
    }

    public function uploadWhychooseusDetails(){
        extract($_REQUEST);
        // $this->print_r($_REQUEST);
        // $this->print_r($_FILES);
        // exit;
        $path = 'uploads/whychooseus/';
        if(file_exists($path)){
            $uploadfile = $this->uploadfiles($path,'UploadedImages','jpg|png|jpeg',TRUE);
        }else{
            $this->createdir($path,$path);
            $uploadfile = $this->uploadfiles($path,'UploadedImages','jpg|png|jpeg',TRUE);
        }
        if($uploadfile['status'] == 1){
            $uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
            $insertdata = array('title'=>$title_name,'image'=>$uploadedfile,'information'=>$Information,'updated'=>date('Y-m-d H:i:s'));
            $insertbanners = $this->Model_default->insert_data('ss_whychoose_us',$insertdata);
            if($insertbanners != 0){
                $this->successalert('Successfully Saved Banner Details.','You have Save banner details sucessfully please check once..!');
                redirect(base_url('admin/whychooseus'));
            }else{
                $this->failedalert('Failed to save Banner Details.','Unable to save banner details or oops error..!');
                redirect(base_url('admin/whychooseus'));
            }
        }else{
            $this->failedalert('Image upload Failed. Try again..!','Unable to uload image file or oops error..!');
            redirect(base_url('admin/whychooseus'));
        }
    }


    //client reviews
    public function Clientreviews(){
        $data['userdata']   =   $this->session->userdata('loginadmindata');
        $data['pagetitle']	=	'why choose us page';
        $data['banners']	=	 $this->Model_default->select_data('ss_gallery',array('status'=>1),'updated DESC');
        $this->view('admin/clientreviews_page',$data);
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
