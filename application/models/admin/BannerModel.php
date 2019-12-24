<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'models/ModelDefault.php';
class BannerModel extends ModelDefault{
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function bannerdata()
    {
        $bannerdata = $this->select_data('sceg_banners',array('status'=>1),'updated DESC');
        return $bannerdata;
    }

    public function uplaodBanners($request)
    {
        extract($request);
        $insertdata = array('banner_title'=>$bannerTitle,'image'=>$banners['uploaddata'],'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
        $insertbanners = $this->insert_data('sceg_banners',$insertdata);
        if($insertbanners != 0){
            return array('responce' => 1,'message'=>'Banner details as successfully saved.','data'=>$insertbanners);
        }else{
            return array('responce' => 0,'message'=>'Banner details as failed to save.','data'=>$insertbanners);
        }
    }

    public function deleteBanner($request)
    {
        $bannerdetails = $this->bannerEditData($request);
        @unlink($bannerdetails[0]->image);
        $delete = $this->delete_data('sceg_banners', array('id' => $request));
        if($delete != 0){
            return array('responce' => 1, 'message' => 'Banner details as successfully deleted.', 'data'=>$delete);
        }else{
            return array('responce' => 0, 'message' => 'Banner details as failed to delete.', 'data'=>$delete);
        }
    }

    public function bannerEditData($request)
    {
        $bannerdata = $this->select_data('sceg_banners',array('id'=>$request),'updated DESC');
        return $bannerdata;
    }

    public function saveditdetails($request)
    {
        extract($request);
        $conduction = array('id'=>$edit_id);
        $insertdata = array('image'=>$banners['uploaddata'],'banner_title'=>$bannerTitle,'information'=>$Information,'links'=>$BannerURl,'updated'=>date('Y-m-d H:i:s'));
        $insertbanners = $this->update_data('sceg_banners',$insertdata,$conduction);
        if($insertbanners != 0){
            return array('responce' => 1,'message'=>'Banner details as successfully updated.','data'=>$insertbanners);
        }else{
            return array('responce' => 0,'message'=>'Banner details as failed to update.','data'=>$insertbanners);
        }
    }
}
