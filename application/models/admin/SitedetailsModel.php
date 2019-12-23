<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'models/ModelDefault.php';

class SitedetailsModel extends ModelDefault{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

   public function sitedetails()
   {
        $sitedeatils = $this->select_data('sceg_site_details',array('status'=>1),'updated DESC');
        return $sitedeatils;
   }  

   public function saveSiteDetails($request)
   {
        extract($request);
        //$this->print_r($request);
        $sitedeatils = array('site_name' => $site_name,'site_url' => $domain_name,'site_logo' => $logo['uploaddata'],'site_favicon' => $fav['uploaddata'],'address' => $address,'state' => $state_name,'city' => $city_name,'pincode' => $pincode,'mobile' => $mobile,'email_id' => $mail_id,'facebook' => $facebook_link,'twitter' => $twitter_link,'instagram' => $instagram_link,'linkedin' => $linkedin_link);
        $insertdata = $this->insert_data('sceg_site_details',$sitedeatils);
        if($insertdata != 0){
            return array('responce'=> 1,'message'=>'Successfully to saved data.','data'=>$insertdata);
        }else{
            return array('responce'=> 0,'message'=>'Failed to save data.','data'=>$insertdata);
        }
   }

   public function saveEditSiteDetails($request)
   {
       extract($request);
       $sitedeatils = array('site_name' => $site_name,'site_url' => $domain_name,'site_logo' => $logo['uploaddata'],'site_favicon' => $fav['uploaddata'],'address' => $address,'state' => $state_name,'city' => $city_name,'pincode' => $pincode,'mobile' => $mobile,'email_id' => $mail_id,'facebook' => $facebook_link,'twitter' => $twitter_link,'instagram' => $instagram_link,'linkedin' => $linkedin_link);
       $updatedata = $this->update_data('sceg_site_details',$sitedeatils,array('id'=>$edit_id));
        if($updatedata != 0){
            return array('responce'=> 1,'message'=>'Successfully to saved data.','data'=>$insertdata);
        }else{
            return array('responce'=> 0,'message'=>'Failed to save data.','data'=>$insertdata);
        }
   }

}
