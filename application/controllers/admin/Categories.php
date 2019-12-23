<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Categories extends BaseController {

	public function __construct(){
        parent::__construct();
        $this->isAdminLoggedIn();
        $this->load->model('Model_default');
    }
	
	public function Categories(){
		$data['userdata'] = $this->session->userdata('loginadmindata');
		$data['pagetitle']	=	'Categories Page';
		$data['categories']	=	$this->Model_default->select_data('ss_categories',array('status'=>1),'id DESC');
		$this->view('admin/categories_page',$data);
	}

	public function saveCategories(){
		extract($_REQUEST);
		$path = 'uploads/Categories/';
		if($_FILES['CategoryImages']['name'] != ''){
			if(file_exists($path)){
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}else{
				$this->createdir($path,$path);
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}
			if($uploadfile['status'] == 1){
				$uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
			}else{
				$uploadedfile = '';
			}
		}else{
			$uploadedfile = '';
		}


		$insertdata = array('image'=>$uploadedfile,'category_name'=>$category_name,'updated'=>date('Y-m-d H:i:s'));
		$insertbanners = $this->Model_default->insert_data('ks_categories',$insertdata);
		if($insertbanners != 0){
			$this->successalert('Successfully Saved Category Details.','You have Save Category details sucessfully please check once..!');
			redirect(base_url('cpanel/dashboard/categories'));
		}else{
			$this->failedalert('Failed to save Category Details.','Unable to save Category details or oops error..!');
			redirect(base_url('cpanel/dashboard/categories'));
		} 
	}

	public function editCategories(){
		$id = $this->uri->segment(4);
		$data['userdata'] = $this->session->userdata('loginuserdata');
		$data['pagetitle']	=	'Banners Page';
		$data['categories']	=	$this->Model_default->select_data('ks_categories',array('status'=>1),'id DESC');
		$data['categorydata']	=	$this->Model_default->select_data('ks_categories',array('status'=>1,'id'=>$id),'id DESC');
		$this->manualLoadView('cpanel/header','cpanel/categories_page','cpanel/footer',$data);
	}

	public function saveEditdetails(){
		extract($_REQUEST);
		// $this->print_r($_REQUEST);
		// $this->print_r($_FILES);
		// exit;
		$path = 'uploads/Categories/';
		if($_FILES['CategoryImages']['name'] != ''){
			if(file_exists($path)){
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}else{
				$this->createdir($path,$path);
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}
			if($uploadfile['status'] == 1){
				$uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
			}else{
				$uploadedfile = '';
			}
		}else{
			$uploadedfile = $uploaded_image;
		}


		$conduction	=	array('id'=>$edit_id);
		$insertdata = array('image'=>$uploadedfile,'category_name'=>$category_name,'updated'=>date('Y-m-d H:i:s'));
		$insertbanners = $this->Model_default->update_data('ks_categories',$insertdata,$conduction);
		if($insertbanners != 0){
			$this->successalert('Successfully Update Category Details.','You have Update Category details sucessfully please check once..!');
			redirect(base_url('cpanel/dashboard/categories'));
		}else{
			$this->failedalert('Failed to Update Category Details.','Unable to Update Category details or oops error..!');
			redirect(base_url('cpanel/dashboard/categories'));
		} 
	}

	public function SubCategories(){
		$data['userdata'] = $this->session->userdata('loginadmindata');
		$data['pagetitle']	=	'Sub Categories Page';
		$data['categories']	=	$this->Model_default->select_data('ss_categories',array('status'=>1),'id DESC');
		$data['subcategories']	=	$this->Model_default->select_data('ss_sub_categories',array('status'=>1),'id DESC');
		$this->view('admin/subcategories_page',$data);
	}

	public function editSubCategories(){
		$id = $this->uri->segment(4);
		$data['userdata'] = $this->session->userdata('loginuserdata');
		$data['pagetitle']	=	'Edit SubCategory Page';
		$data['categories']	=	$this->Model_default->select_data('ks_categories',array('status'=>1),'id DESC');
		$data['subcategories']	=	$this->Model_default->select_data('ks_sub_categories',array('status'=>1),'id DESC');
		$data['subcategoriesdata']	=	$this->Model_default->select_data('ks_sub_categories',array('status'=>1,'id'=>$id),'id DESC');
		$this->manualLoadView('cpanel/header','cpanel/subcategories_page','cpanel/footer',$data);
	}

	public function saveEditSubdetails(){
		extract($_REQUEST);
		// $this->print_r($_REQUEST);
		// $this->print_r($_FILES);
		// exit;
		$path = 'uploads/SubCategories/';
		if($_FILES['CategoryImages']['name'] != ''){
			if(file_exists($path)){
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}else{
				$this->createdir($path,$path);
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}
			if($uploadfile['status'] == 1){
				$uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
			}else{
				$uploadedfile = $uploaded_image;
			}
		}else{
			$uploadedfile = $uploaded_image;
		}

		$conduction	=	array('id'=>$edit_id);
		$insertdata = array('image'=>$uploadedfile,'category_id'=>$category_name,'sub_category_name'=>$subcategory_name,'price'=>$Price,'quantity'=>$Qunatity,'information'=>'','updated'=>date('Y-m-d H:i:s'));
		$insertbanners = $this->Model_default->update_data('ks_sub_categories',$insertdata,$conduction);
		if($insertbanners != 0){
			$this->successalert('Successfully Update SubCategory Details.','You have Update SubCategory details sucessfully please check once..!');
			redirect(base_url('cpanel/dashboard/subcategories'));
		}else{
			$this->failedalert('Failed to Update SubCategory Details.','Unable to Update SubCategory details or oops error..!');
			redirect(base_url('cpanel/dashboard/subcategories'));
		} 
	}

	public function deleteCategories(){
		$id = $this->uri->segment(4);
		if(isset($id) && !empty($id)){
			$conduction = 	array('id'=>$id);
			$updatedata	=	array('status'=>0);
			$updating	=	$this->Model_default->update_data('ks_categories',$updatedata,$conduction);
			if($updating != 0){
				$this->Model_default->update_data('ks_sub_categories',$updatedata,array('category_id'=>$id));
				$this->successalert('Successfully Delete Category Details.','You have Save SubCategory details sucessfully please check once..!');
				redirect(base_url('cpanel/dashboard/categories'));
			}else{
				$this->failedalert('Failed to Delete Category Details.','Unable to Delete SubCategory details or oops error..!');
				redirect(base_url('cpanel/dashboard/categories'));
			} 
		}else{
			$this->failedalert('Failed to Delete Category Details.','Unable to Delete Category details or Invalid oops error..!');
			redirect(base_url('cpanel/dashboard/categories'));
		}
	}

	public function saveSubCategories(){
		extract($_REQUEST);
		$path = 'uploads/SubCategories/';
		if($_FILES['CategoryImages']['name'] != ''){
			if(file_exists($path)){
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}else{
				$this->createdir($path,$path);
				$uploadfile = $this->uploadfiles($path,'CategoryImages','jpg|png|jpeg',TRUE);
			}
			if($uploadfile['status'] == 1){
				$uploadedfile = $path.$uploadfile['uploaddata']['file_name'];
			}else{
				$uploadedfile = '';
			}
		}else{
			$uploadedfile = '';
		}


		$insertdata = array('image'=>$uploadedfile,'category_id'=>$category_name,'sub_category_name'=>$subcategory_name,'price'=>$Price,'quantity'=>$Qunatity,'information'=>'','updated'=>date('Y-m-d H:i:s'));
		$insertbanners = $this->Model_default->insert_data('ks_sub_categories',$insertdata);
		if($insertbanners != 0){
			$this->successalert('Successfully Saved SubCategory Details.','You have Save SubCategory details sucessfully please check once..!');
			redirect(base_url('cpanel/dashboard/subcategories'));
		}else{
			$this->failedalert('Failed to save SubCategory Details.','Unable to save SubCategory details or oops error..!');
			redirect(base_url('cpanel/dashboard/subcategories'));
		} 
	}

	public function deleteSubCategories(){
		$id = $this->uri->segment(4);
		if(isset($id) && !empty($id)){
			$conduction = 	array('id'=>$id);
			$updatedata	=	array('status'=>0);
			$updating	=	$this->Model_default->update_data('ks_sub_categories',$updatedata,$conduction);
			if($updating != 0){
				$this->successalert('Successfully Updated SubCategory Details.','You have Save SubCategory details sucessfully please check once..!');
				redirect(base_url('cpanel/dashboard/subcategories'));
			}else{
				$this->failedalert('Failed to Update SubCategory Details.','Unable to Update SubCategory details or oops error..!');
				redirect(base_url('cpanel/dashboard/subcategories'));
			} 
		}else{
			$this->failedalert('Failed to Update SubCategory Details.','Unable to Update SubCategory details or Invalid oops error..!');
			redirect(base_url('cpanel/dashboard/subcategories'));
		}
	}

	public function logout(){
		$this->logout();
	}
}
