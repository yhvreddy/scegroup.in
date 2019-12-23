<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Reviews extends BaseController {

	public function __construct(){
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Model_default');
    }
	
	public function index(){
		$data['userdata'] = $this->session->userdata('loginuserdata');
		$data['pagetitle']	=	'Products reviews';
		$data['reviews']	=	$this->Model_default->select_data('ks_products_reviews',array('status <='=>1),'updated ASC');
		$this->manualLoadView('cpanel/header','cpanel/reviews_page','cpanel/footer',$data);
	}

	public function publishReview(){
		$type = $this->uri->segment(5);
		$id   = $this->uri->segment(4);
		if(isset($type) && !empty($type) && $type == 'unpublish'){
			$update = $this->Model_default->update_data('ks_products_reviews',array('status'=>0,'updated'=>date('Y-m-d H:i:s')),array('id'=>$id));
			$message = 'unpublish';
		}else{
			$update = $this->Model_default->update_data('ks_products_reviews',array('status'=>1,'updated'=>date('Y-m-d H:i:s')),array('id'=>$id));
			$message = 'publish';
		}

		if($update != 0){
			$this->successalert('Successfully '.$message.' Review..!');
			redirect(base_url('cpanel/dashboard/reviews'));
		}else{
			$this->failedalert('Failed to '.$message.' Review');
			redirect(base_url('cpanel/dashboard/reviews'));
		} 
	}
	

	public function logout(){
		$this->logout();
	}
}
